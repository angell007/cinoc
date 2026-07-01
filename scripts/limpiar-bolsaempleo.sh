#!/usr/bin/env bash
#
# limpiar-bolsaempleo.sh — Remediación post-malware para bolsaempleo.iescinoc.edu.co
#
# Uso:
#   chmod +x scripts/limpiar-bolsaempleo.sh
#   ./scripts/limpiar-bolsaempleo.sh              # escaneo + acciones (pide confirmación)
#   ./scripts/limpiar-bolsaempleo.sh --dry-run    # solo informe, sin cambios
#   ./scripts/limpiar-bolsaempleo.sh --yes        # sin preguntas interactivas
#
# IMPORTANTE: Despliega antes el código limpio (git pull / rsync) desde tu repo local.

set -euo pipefail

# ─── Configuración ───────────────────────────────────────────────────────────
PROJECT_ROOT="${PROJECT_ROOT:-/home/iescinocedu/bolsaempleo.iescinoc.edu.co}"
BACKUP_DIR="${BACKUP_DIR:-${PROJECT_ROOT}/storage/security-backup-$(date +%Y%m%d-%H%M%S)}"
DRY_RUN=false
ASSUME_YES=false
SKIP_COMPOSER=false
LOG_FILE=""

# PHP / Composer (cPanel ea-php74)
PHP_BIN="${PHP_BIN:-$(command -v ea-php74 2>/dev/null || command -v php 2>/dev/null || echo 'php')}"
COMPOSER_BIN="${COMPOSER_BIN:-$(command -v composer 2>/dev/null || echo '/usr/local/bin/composer')}"

# ─── Patrones de detección (webshell dropper) ────────────────────────────────
PATTERN_DROPPER='if\s*(isset|!empty|array_key_exists|!is_null|in_array|filter_has_var).*\$_(REQUEST|POST|GET).*\\x[0-9a-f]{2}'
PATTERN_SALT_EXEC='abcdefghijklmnopqrstuvwxyz0123456789.*\$_(REQUEST|POST).*(file_put_contents|fwrite).*(include|require)'
PATTERN_IMAGEUPLOADER='move_uploaded_file\(\$_FILES\[images\]'
PATTERN_SALT_ONLY='abcdefghijklmnopqrstuvwxyz0123456789'

# ─── Colores ─────────────────────────────────────────────────────────────────
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
NC='\033[0m'

# ─── Utilidades ──────────────────────────────────────────────────────────────
log()  { echo -e "${CYAN}[INFO]${NC}  $*" | tee -a "${LOG_FILE}"; }
ok()   { echo -e "${GREEN}[OK]${NC}    $*" | tee -a "${LOG_FILE}"; }
warn() { echo -e "${YELLOW}[WARN]${NC}  $*" | tee -a "${LOG_FILE}"; }
fail() { echo -e "${RED}[ERROR]${NC} $*" | tee -a "${LOG_FILE}"; exit 1; }

usage() {
    cat <<'EOF'
Opciones:
  --dry-run          Solo escanea e informa (no modifica nada)
  --yes              Ejecuta sin confirmaciones interactivas
  --skip-composer    Omite regenerar vendor/
  --project-root=DIR Ruta del proyecto (default: /home/iescinocedu/bolsaempleo.iescinoc.edu.co)
  -h, --help         Muestra esta ayuda

Orden recomendado:
  1. git pull / subir código limpio al servidor
  2. ./scripts/limpiar-bolsaempleo.sh --dry-run
  3. ./scripts/limpiar-bolsaempleo.sh --yes
EOF
}

parse_args() {
    for arg in "$@"; do
        case "$arg" in
            --dry-run)       DRY_RUN=true ;;
            --yes)           ASSUME_YES=true ;;
            --skip-composer) SKIP_COMPOSER=true ;;
            --project-root=*) PROJECT_ROOT="${arg#*=}" ;;
            -h|--help)       usage; exit 0 ;;
            *)               fail "Opción desconocida: $arg (usa --help)" ;;
        esac
    done
}

confirm() {
    if $ASSUME_YES || $DRY_RUN; then
        return 0
    fi
    local msg="$1"
    read -r -p "$(echo -e "${YELLOW}[?]${NC} ${msg} [s/N]: ")" reply
    [[ "${reply,,}" == "s" || "${reply,,}" == "si" || "${reply,,}" == "y" || "${reply,,}" == "yes" ]]
}

run_cmd() {
    if $DRY_RUN; then
        log "[DRY-RUN] $*"
    else
        log "Ejecutando: $*"
        eval "$@"
    fi
}

# Escanea un directorio; informa por stderr y devuelve el conteo por stdout
scan_dir() {
    local dir="$1"
    local label="$2"
    local pattern="$3"
    local out_file="$4"

    if [[ ! -d "$dir" ]]; then
        echo "0"
        return 0
    fi

    grep -rlE "$pattern" --include="*.php" "$dir" 2>/dev/null > "$out_file" || true
    local count
    count=$(wc -l < "$out_file" | tr -d ' ')

    if [[ "$count" -gt 0 ]]; then
        warn "${label}: ${count} archivo(s) sospechoso(s)" >&2
        head -20 "$out_file" | while read -r f; do echo "         → $f" >&2; done
        [[ "$count" -gt 20 ]] && echo "         … y $((count - 20)) más (ver ${out_file})" >&2
    else
        ok "${label}: 0 coincidencias" >&2
    fi

    echo "$count"
}

check_line1_clean() {
    local file="$1"
    [[ -f "$file" ]] || return 0
    local first_line
    first_line=$(head -1 "$file")
    if echo "$first_line" | grep -qE 'abcdefghijklmnopqrstuvwxyz0123456789|\\x[0-9a-f]{2}.*\$_(REQUEST|POST)'; then
        return 1
    fi
    return 0
}

check_critical_app_files() {
    local infected=0
    local files=(
        "config/repository.php"
        "app/Http/Controllers/Admin/SalaryPeriodController.php"
        "ckeditor/plugins/imageuploader/pluginconfig.php"
    )

    log "Verificando archivos críticos de aplicación…" >&2

    for rel in "${files[@]}"; do
        local full="${PROJECT_ROOT}/${rel}"
        if [[ ! -f "$full" ]]; then
            warn "No existe: ${rel}" >&2
            continue
        fi

        if ! check_line1_clean "$full"; then
            warn "INFECTADO o no desplegado: ${rel}" >&2
            infected=$((infected + 1))
        elif [[ "$rel" == *pluginconfig.php* ]] && grep -q 'move_uploaded_file(\$_FILES\[images\]' "$full" 2>/dev/null; then
            warn "BACKDOOR activo en: ${rel}" >&2
            infected=$((infected + 1))
        else
            ok "Limpio: ${rel}" >&2
        fi
    done

    echo "$infected"
}

ensure_cron_token() {
    local env_file="${PROJECT_ROOT}/.env"
    if [[ ! -f "$env_file" ]]; then
        warn ".env no encontrado — configura CRON_TOKEN manualmente"
        return 0
    fi

    if grep -q '^CRON_TOKEN=.\+' "$env_file" 2>/dev/null; then
        ok "CRON_TOKEN ya existe en .env"
        return 0
    fi

    local token
    token=$("${PHP_BIN}" -r "echo bin2hex(random_bytes(32));")

    if $DRY_RUN; then
        log "[DRY-RUN] Añadiría CRON_TOKEN a .env"
        return 0
    fi

    echo "" >> "$env_file"
    echo "# Token para rutas cron (generado $(date -Iseconds))" >> "$env_file"
    echo "CRON_TOKEN=${token}" >> "$env_file"
    ok "CRON_TOKEN generado y añadido a .env"

    log "Actualiza los cron jobs en cPanel:"
    echo "  https://TU-DOMINIO/cronjob/send-alerts/${token}"
    echo "  https://TU-DOMINIO/check-package-validity/${token}"
}

regenerate_vendor() {
    local dir="$1"
    if [[ ! -f "${dir}/composer.json" ]]; then
        return 0
    fi

    log "Regenerando vendor en: ${dir}"

    if $DRY_RUN; then
        log "[DRY-RUN] rm -rf ${dir}/vendor && composer install --no-dev --optimize-autoloader"
        return 0
    fi

    cd "$dir"
    rm -rf vendor
    "${PHP_BIN}" "${COMPOSER_BIN}" clear-cache 2>/dev/null || true
    "${PHP_BIN}" "${COMPOSER_BIN}" install --no-dev --optimize-autoloader --no-interaction
    ok "vendor/ regenerado en ${dir}"
}

clear_laravel_cache() {
    if [[ ! -f "${PROJECT_ROOT}/artisan" ]]; then
        return 0
    fi

    log "Limpiando caché Laravel…"
    run_cmd "cd '${PROJECT_ROOT}' && '${PHP_BIN}' artisan config:clear"
    run_cmd "cd '${PROJECT_ROOT}' && '${PHP_BIN}' artisan cache:clear"
    run_cmd "cd '${PROJECT_ROOT}' && '${PHP_BIN}' artisan route:clear"
    run_cmd "cd '${PROJECT_ROOT}' && '${PHP_BIN}' artisan view:clear"
    ok "Caché Laravel limpiada"
}

write_report() {
    local report="${BACKUP_DIR}/informe.txt"
    {
        echo "Informe de seguridad — $(date)"
        echo "Proyecto: ${PROJECT_ROOT}"
        echo "Modo: $($DRY_RUN && echo 'DRY-RUN' || echo 'EJECUCIÓN')"
        echo ""
        echo "── Dropper webshell ──"
        cat "${BACKUP_DIR}/scan-dropper.txt" 2>/dev/null || echo "(ninguno)"
        echo ""
        echo "── Salt + exec ──"
        cat "${BACKUP_DIR}/scan-salt-exec.txt" 2>/dev/null || echo "(ninguno)"
        echo ""
        echo "── Imageuploader backdoor ──"
        cat "${BACKUP_DIR}/scan-imageuploader.txt" 2>/dev/null || echo "(ninguno)"
    } > "$report"
    log "Informe guardado en: ${report}"
}

# ─── Main ────────────────────────────────────────────────────────────────────
main() {
    parse_args "$@"

    echo ""
    echo "═══════════════════════════════════════════════════════════"
    echo "  Limpieza de seguridad — bolsaempleo.iescinoc.edu.co"
    echo "═══════════════════════════════════════════════════════════"
    echo ""

    [[ -d "$PROJECT_ROOT" ]] || fail "No existe PROJECT_ROOT: ${PROJECT_ROOT}"
    [[ -f "${PROJECT_ROOT}/artisan" ]] || warn "No se encontró artisan — verifica PROJECT_ROOT"

    if ! $DRY_RUN; then
        mkdir -p "$BACKUP_DIR"
        LOG_FILE="${BACKUP_DIR}/ejecucion.log"
        touch "$LOG_FILE"
    else
        LOG_FILE="/dev/null"
        BACKUP_DIR="/tmp/bolsaempleo-scan-$$"
        mkdir -p "$BACKUP_DIR"
    fi

    log "Proyecto: ${PROJECT_ROOT}"
    log "PHP: ${PHP_BIN} ($(${PHP_BIN} -v 2>/dev/null | head -1 || echo 'versión desconocida'))"
    log "Composer: ${COMPOSER_BIN}"

    # ── Escaneo previo ──
    echo ""
    log "═══ ESCANEO PREVIO ═══"

    count_dropper=$(scan_dir "$PROJECT_ROOT" "Dropper (app+config+ckeditor)" "$PATTERN_DROPPER" "${BACKUP_DIR}/scan-dropper.txt")
    scan_dir "$PROJECT_ROOT" "Salt+exec" "$PATTERN_SALT_EXEC" "${BACKUP_DIR}/scan-salt-exec.txt" > /dev/null
    scan_dir "$PROJECT_ROOT" "Imageuploader" "$PATTERN_IMAGEUPLOADER" "${BACKUP_DIR}/scan-imageuploader.txt" > /dev/null

    local critical_infected
    critical_infected=$(check_critical_app_files)

    if [[ "$critical_infected" -gt 0 ]]; then
        echo ""
        fail "$(cat <<EOF

Se detectaron ${critical_infected} archivo(s) crítico(s) aún infectados o sin desplegar.

Acción requerida ANTES de continuar:
  1. En tu máquina local: asegúrate de tener el repo limpio
  2. En el servidor:
       cd ${PROJECT_ROOT}
       git pull origin main    # o la rama que uses
     — o sube por FTP/rsync los archivos limpios

  3. Vuelve a ejecutar este script.

EOF
)"
    fi

    if [[ "$count_dropper" -gt 0 ]]; then
        warn "Quedan ${count_dropper} archivo(s) con patrón dropper en el proyecto"
        if ! confirm "¿Continuar de todos modos (regenerar vendor y configurar cron)?"; then
            fail "Abortado por el usuario"
        fi
    fi

    write_report

    # ── Acciones ──
    echo ""
    log "═══ ACCIONES DE REMEDIACIÓN ═══"

    if ! $SKIP_COMPOSER; then
        if confirm "¿Regenerar vendor/ (composer install --no-dev)?"; then
            regenerate_vendor "${PROJECT_ROOT}"
            regenerate_vendor "${PROJECT_ROOT}/main"
        else
            warn "Omitida regeneración de vendor"
        fi
    fi

    if confirm "¿Configurar CRON_TOKEN en .env (si falta)?"; then
        ensure_cron_token
    fi

    if confirm "¿Limpiar caché Laravel?"; then
        clear_laravel_cache
    fi

    # ── Escaneo posterior ──
    echo ""
    log "═══ ESCANEO POSTERIOR ═══"

    local post_dropper post_salt_exec post_img
    post_dropper=$(scan_dir "$PROJECT_ROOT" "Dropper (post)" "$PATTERN_DROPPER" "${BACKUP_DIR}/scan-dropper-post.txt")
    post_salt_exec=$(scan_dir "$PROJECT_ROOT" "Salt+exec (post)" "$PATTERN_SALT_EXEC" "${BACKUP_DIR}/scan-salt-exec-post.txt")
    post_img=$(scan_dir "$PROJECT_ROOT" "Imageuploader (post)" "$PATTERN_IMAGEUPLOADER" "${BACKUP_DIR}/scan-imageuploader-post.txt")

    echo ""
    echo "═══════════════════════════════════════════════════════════"
    if [[ "$post_dropper" -eq 0 && "$post_salt_exec" -eq 0 && "$post_img" -eq 0 ]]; then
        ok "Escaneo posterior: SIN coincidencias de webshell en ${PROJECT_ROOT}"
    else
        warn "Escaneo posterior: aún hay coincidencias — revisa ${BACKUP_DIR}/"
    fi
    echo "═══════════════════════════════════════════════════════════"
    echo ""

    log "Pendiente manual (no automatizable):"
    echo "  • Rotar contraseñas: cPanel, FTP, SSH, .env (DB, mail, pagos)"
    echo "  • Rotar contraseñas de administradores de la aplicación"
    echo "  • Actualizar cron jobs en cPanel con CRON_TOKEN"
    echo "  • Verificar 403 en: /ckeditor/filemanager/dialog.php"
    echo "  • Revisar otras cuentas del VPS (compromiso multi-sitio detectado)"
    echo ""

    if ! $DRY_RUN; then
        ok "Backup/informes en: ${BACKUP_DIR}"
    fi
}

main "$@"
