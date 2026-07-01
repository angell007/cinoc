#!/usr/bin/env bash
#
# investigar-acceso-datos.sh — Busca indicios de exfiltración / acceso tras compromiso
#
# Uso:
#   chmod +x scripts/investigar-acceso-datos.sh
#   ./scripts/investigar-acceso-datos.sh
#   ./scripts/investigar-acceso-datos.sh --days 30
#
# NOTA: Un webshell con RCE no deja rastro garantizado. Este script busca INDICIOS.

set -euo pipefail

PROJECT_ROOT="${PROJECT_ROOT:-/home/iescinocedu/bolsaempleo.iescinoc.edu.co}"
DAYS="${DAYS:-30}"
DOMAIN="${DOMAIN:-bolsaempleo.iescinoc.edu.co}"
REPORT_DIR="${PROJECT_ROOT}/storage/security-investigation-$(date +%Y%m%d-%H%M%S)"

RED='\033[0;31m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
GREEN='\033[0;32m'
NC='\033[0m'

section() { echo -e "\n${CYAN}═══ $* ═══${NC}"; }
info()    { echo -e "${CYAN}[INFO]${NC} $*"; }
warn()    { echo -e "${YELLOW}[WARN]${NC} $*"; }
hit()     { echo -e "${RED}[HALLAZGO]${NC} $*"; }

while [[ $# -gt 0 ]]; do
    case "$1" in
        --days=*) DAYS="${1#*=}"; shift ;;
        --days)   DAYS="$2"; shift 2 ;;
        --project-root=*) PROJECT_ROOT="${1#*=}"; shift ;;
        --domain=*) DOMAIN="${1#*=}"; shift ;;
        *) shift ;;
    esac
done

mkdir -p "$REPORT_DIR"
REPORT="${REPORT_DIR}/informe-acceso-datos.txt"

exec > >(tee -a "$REPORT") 2>&1

echo "Informe de investigación — $(date)"
echo "Proyecto: ${PROJECT_ROOT}"
echo "Dominio: ${DOMAIN}"
echo "Ventana: últimos ${DAYS} días"
echo ""

# ─── 1. Logs de acceso web (Apache/cPanel) ───────────────────────────────────
section "1. Logs de acceso HTTP"

ACCESS_LOGS=(
    "/usr/local/apache/domlogs/${DOMAIN}"
    "/usr/local/apache/domlogs/${DOMAIN}-ssl_log"
    "/var/log/apache2/access.log"
    "/home/iescinocedu/access-logs/${DOMAIN}"
    "/home/iescinocedu/logs/${DOMAIN}.log"
)

FOUND_ACCESS=false
for log in "${ACCESS_LOGS[@]}"; do
    [[ -f "$log" ]] || continue
    FOUND_ACCESS=true
    info "Analizando: $log"

    echo "--- Peticiones a webshell / CKEditor / rutas sospechosas ---" >> "$REPORT"
    grep -E 'property_set|dchunk|\\x69tem|\\x6D\\x61\\x72ker|marker|flag|fcg|key=|item=|ckeditor/filemanager|imageuploader|\.env|phpmyadmin|adminer|shell|eval|base64' "$log" 2>/dev/null \
        | tail -500 >> "${REPORT_DIR}/access-sospechoso.log" || true

    SUSP_COUNT=$(wc -l < "${REPORT_DIR}/access-sospechoso.log" 2>/dev/null | tr -d ' ' || echo 0)
    if [[ "${SUSP_COUNT:-0}" -gt 0 ]]; then
        hit "${SUSP_COUNT} líneas sospechosas en access log → ${REPORT_DIR}/access-sospechoso.log"
    fi

    echo "--- POST a archivos PHP infectados conocidos ---" >> "$REPORT"
    grep -E 'repository\.php|SalaryPeriodController|ContactFormRequest|pluginconfig\.php' "$log" 2>/dev/null \
        | tail -100 >> "${REPORT_DIR}/access-archivos-infectados.log" || true

    echo "--- Descargas masivas (export, CV, .sql, .zip) ---" >> "$REPORT"
    grep -E 'download|export|\.xlsx|\.sql|\.zip|\.tar|mysqldump|datos-export|donwload-camara|download-cv' "$log" 2>/dev/null \
        | tail -200 >> "${REPORT_DIR}/access-descargas.log" || true

    echo "--- IPs con más POST (posible explotación) ---" >> "$REPORT"
    awk '$6 ~ /POST/ {print $1}' "$log" 2>/dev/null | sort | uniq -c | sort -rn | head -20 \
        >> "${REPORT_DIR}/ips-post-frecuentes.txt" || true
done

if ! $FOUND_ACCESS; then
    warn "No se encontraron access logs en rutas habituales de cPanel"
    warn "Revisa manualmente: cPanel → Metrics → Raw Access"
fi

# ─── 2. Logs Laravel ─────────────────────────────────────────────────────────
section "2. Logs de aplicación Laravel"

for log_path in "${PROJECT_ROOT}/storage/logs/laravel.log" "${PROJECT_ROOT}/main/storage/logs/laravel.log"; do
    [[ -f "$log_path" ]] || continue
    info "Analizando: $log_path"
    grep -iE 'error|exception|sql|unauthorized|failed|login|export|download' "$log_path" 2>/dev/null \
        | tail -300 >> "${REPORT_DIR}/laravel-relevante.log" || true
done

# ─── 3. Acceso a .env y archivos sensibles ───────────────────────────────────
section "3. Intentos de lectura de archivos sensibles"

if [[ -f "${REPORT_DIR}/access-sospechoso.log" ]]; then
    grep -E '\.env|composer\.json|config/database|storage/logs' "${REPORT_DIR}/access-sospechoso.log" 2>/dev/null \
        | head -50 >> "${REPORT_DIR}/acceso-archivos-sensibles.log" || true
    if [[ -s "${REPORT_DIR}/acceso-archivos-sensibles.log" ]]; then
        hit "Peticiones a archivos sensibles detectadas"
    fi
fi

# ─── 4. Archivos modificados recientemente ───────────────────────────────────
section "4. Archivos PHP modificados recientemente (últimos ${DAYS} días)"

find "$PROJECT_ROOT" -name "*.php" -mtime "-${DAYS}" \
    ! -path "*/vendor/*" ! -path "*/storage/framework/views/*" \
    2>/dev/null | head -100 >> "${REPORT_DIR}/php-modificados-recientes.txt" || true

MOD_COUNT=$(wc -l < "${REPORT_DIR}/php-modificados-recientes.txt" 2>/dev/null | tr -d ' ' || echo 0)
info "${MOD_COUNT} archivos PHP modificados (ver lista en informe)"

# ─── 5. Usuarios admin sospechosos (requiere MySQL) ──────────────────────────
section "5. Consultas SQL recomendadas (ejecutar manualmente en phpMyAdmin)"

cat >> "$REPORT" <<'SQL'

-- Copia y ejecuta en la BD de bolsaempleo:

-- Admins creados o modificados recientemente
SELECT id, name, email, created_at, updated_at
FROM admins
WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
   OR updated_at >= DATE_SUB(NOW(), INTERVAL 30 DAY);

-- Usuarios (candidatos) creados en masa
SELECT DATE(created_at) AS dia, COUNT(*) AS total
FROM users
WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
GROUP BY dia
ORDER BY total DESC;

-- Empresas modificadas recientemente
SELECT id, name, email, created_at, updated_at
FROM companies
WHERE updated_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
ORDER BY updated_at DESC
LIMIT 50;

-- Si existe tabla sessions (Laravel database driver)
-- SELECT * FROM sessions ORDER BY last_activity DESC LIMIT 50;

SQL

info "Consultas SQL guardadas en el informe"

# ─── 6. Datos sensibles expuestos por el webshell ───────────────────────────
section "6. Qué pudo leer el atacante (asumiendo RCE confirmado)"

cat >> "$REPORT" <<'EXPOSURE'

Con RCE confirmado, el atacante PUDO acceder a:

  [CRÍTICO] .env → credenciales DB, mail, Stripe, PayPal, APP_KEY
  [CRÍTICO] Base de datos completa vía mysqli/PDO o mysqldump
  [CRÍTICO] CVs en /public/cvs/ o /cvs/ (documentos personales)
  [CRÍTICO] Cartas, documentos de empresas, exports Excel del admin
  [ALTO]    Tabla users (cédulas, emails, teléfonos)
  [ALTO]    Tabla companies (datos empresariales)
  [MEDIO]   Sesiones, cookies, tokens de reset password

Sin logs de auditoría en la app, NO se puede probar al 100% qué descargó.
Solo se buscan INDICIOS en access logs e IPs.

EXPOSURE

# ─── 7. Resumen de hallazgos ─────────────────────────────────────────────────
section "7. Resumen"

echo ""
if [[ -f "${REPORT_DIR}/access-sospechoso.log" ]] && [[ -s "${REPORT_DIR}/access-sospechoso.log" ]]; then
    hit "Hay peticiones sospechosas en logs HTTP — revisar ${REPORT_DIR}/access-sospechoso.log"
else
    info "No se encontraron patrones obvios en access logs (o logs no disponibles / rotados)"
fi

if [[ -f "${REPORT_DIR}/access-descargas.log" ]] && [[ -s "${REPORT_DIR}/access-descargas.log" ]]; then
    warn "Hay descargas/export en logs — revisar ${REPORT_DIR}/access-descargas.log"
fi

echo ""
echo "Informe completo: ${REPORT}"
echo "Carpeta: ${REPORT_DIR}"
echo ""
echo "── Acciones si hubo acceso a datos personales (CVs, cédulas) ──"
echo "  • Notificación a titulares (Ley 1581 / Habeas Data Colombia)"
echo "  • Reporte a la SIC si aplica"
echo "  • Rotar TODAS las credenciales"
echo "  • Considerar restaurar BD desde backup pre-infección y comparar"
