# Bolsa Empleo UNIOC Ajustes — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:executing-plans (inline). Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Aplicar en `main/` los ajustes UNIOC de correos, branding, footer, menú, perfil, validación de contraseña y selects de vacantes.

**Architecture:** Cambios puntuales sobre listeners/mailables, vistas Blade y helper de perfil; sin tocar `main/copy/` ni el error de registrar empresa.

**Tech Stack:** Laravel (PHP), Blade, jQuery/Select2, SMTP.

## Global Constraints

- Solo `main/` (no `main/copy/`, no árbol raíz duplicado salvo assets en `/images` si aplica).
- Admin mail: `bolsadeempleo@unioc.edu.co`.
- Fuera de alcance: error “Registrar empresa”.

---

### Task 1: Correos registro y marca mail

**Files:**
- Modify: `main/app/Providers/EventServiceProvider.php`
- Modify: `main/app/Mail/UserRegisteredMailable.php`
- Modify: `main/config/mail.php`
- Modify: `main/app/Providers/CustomConfigServiceProvider.php` (from/name si aplica)
- Modify: `main/resources/views/emails/revision.blade.php`
- Modify: `main/resources/views/emails/user_registered_message.blade.php` (UNIOC)
- Modify: hardcodeados `bolsadeempleo@iescinoc.edu.co` / `IES CINOC` en controladores activos de `main/app`

- [ ] Quitar `UserNotifyRegisterdListener` del evento `UserRegistered`
- [ ] Corregir `to(address, name)` en `UserRegisteredMailable`; subject UNIOC
- [ ] Actualizar from/recieve_to a bolsadeempleo@unioc.edu.co / Bolsa de Empleo UNIOC
- [ ] Corregir “revizar” → “revisar” y marca en revision.blade.php
- [ ] Commit

### Task 2: Footer logos + redes

**Files:**
- Modify: `main/resources/views/includes/footer.blade.php`
- Modify: `main/resources/views/includes/footer_social.blade.php`

- [ ] Quitar logo-egresados y Logo-bolsa-de-empleo; dejar logo.jpeg; agregar logo_principal_SPE.jpg
- [ ] Redes: FB, X, Instagram UNIOC, LinkedIn, YouTube
- [ ] Commit

### Task 3: Menú + campos pendientes + password UI

**Files:**
- Modify: `main/resources/views/includes/user_dashboard_menu.blade.php`
- Modify: `main/resources/views/includes/user_dashboard_stats.blade.php` / `home.blade.php` (quitar seguimientos visibles si aplica)
- Modify: `main/app/Helpers/ProfileCompletionHelper.php`
- Modify: `main/resources/views/auth/register.blade.php` (JS password match candidato + empleador)

- [ ] Quitar My Job Alerts y My Followings del menú
- [ ] Remover checks listados del helper
- [ ] Bloquear avance/submit si password ≠ confirmation (cliente); servidor ya tiene `confirmed`
- [ ] Commit

### Task 4: Vacante ocupaciones + municipio

**Files:**
- Modify: `main/resources/views/job/inc/job.blade.php`

- [ ] Inicializar Select2 AJAX en `.selected-remote` hacia `/api/proffesions` (como experience.blade.php)
- [ ] Asegurar reinicio select2 tras reemplazo AJAX de state/city
- [ ] Commit

### Task 5: Rebranding textual restante activo

**Files:** textos “IES CINOC” / from hardcodeados en `main/` (excl. copy)

- [ ] Reemplazar remitentes y textos de marca visibles críticos
- [ ] Commit final
