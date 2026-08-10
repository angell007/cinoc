# Diseño: Ajustes Bolsa de Empleo UNIOC

Fecha: 2026-08-10  
Alcance: código activo en `main/`  
Estado: aprobado en brainstorming

## Objetivo

Completar el rebranding a UNIOC y corregir correos, branding del footer, menú de candidato, requisitos de perfil, validación de contraseña y carga de selects en publicación de vacantes.

## Fuera de alcance

- Error al pulsar “Registrar empresa” (aplazado a petición del usuario).
- Cambios en `main/copy/` y árbol raíz duplicado (no productivo).
- Renombrar el dominio `bolsaempleo.iescinoc.edu.co` (infraestructura).

## Enfoque

Paquete enfocado solo en `main/`: cambios puntuales sobre patrones existentes, sin refactor amplio.

---

## 1. Correos y marca UNIOC

### 1.1 Flujo de registro de candidato

| Destinatario | Correo | Acción |
|---|---|---|
| Candidato | Activación de cuenta – Bolsa de Empleo UNIOC | Mantener (`UserVerification::send`). Mismo formato/estructura del mail de verificación actual; textos CINOC → UNIOC. |
| Candidato | Mail de registro/bienvenida (`UserNotifyRegisteredMailable`) | Eliminar envío (quitar listener o dejar de registrar el listener). |
| Admin | Nuevo usuario registrado | Enviar solo a `bolsadeempleo@unioc.edu.co`. |

### 1.2 Bugs a corregir en mail admin

- `UserRegisteredMailable` hoy usa `config('mail.recieve_to.name')` como dirección `to` (incorrecto). Debe usar `config('mail.recieve_to.address')` (y name como nombre).
- Asegurar que `mail_to_address` / `recieve_to` y remitentes hardcodeados en `main/` queden en `bolsadeempleo@unioc.edu.co` con nombre “Bolsa de Empleo UNIOC” (o UNIOC según contexto).
- Actualizar `config/mail.php` `from` (hoy `noreply@iescinoc.edu.co` / `IES CINOC`) y referencias hardcodeadas restantes en controladores/mailables de `main/`.

### 1.3 Mail revisar hoja de vida

- Archivo: `resources/views/emails/revision.blade.php`
- Corregir “revizar” → “revisar”.
- Reemplazar IES CINOC / URLs de marca viejas por UNIOC donde aplique en ese template.

### 1.4 Rebranding textual

Reemplazar en vistas, mails y configs activos de `main/` las apariciones visibles de “IES CINOC”, “IES-CINOC” y equivalentes por **UNIOC** (o “Bolsa de Empleo UNIOC” / “Institución Universitaria Oriente de Caldas – UNIOC” cuando el contexto lo requiera). No tocar `main/copy/`.

---

## 2. UI: logos, redes, menú y formularios

### 2.1 Footer – logos

Ubicación: `resources/views/includes/footer.blade.php`

- Eliminar: `logo-egresados.png` (sello EGRESADO IES CINOC).
- Eliminar: `Logo-bolsa-de-empleo.png` (badge Bolsa de Empleo IES CINOC).
- Mantener: `logo.jpeg` (logo naranja UNIOC).
- Agregar: logo Servicio Público de Empleo (`images/logo_principal_SPE.jpg` o el asset SPE ya presente en el proyecto).

### 2.2 Redes sociales

| Red | URL |
|---|---|
| Facebook | https://www.facebook.com/ies.cinoc/ |
| X (Twitter) | https://twitter.com/IES_CINOC |
| Instagram | https://www.instagram.com/unioc_oficial |
| LinkedIn | https://www.linkedin.com/company/unioc/ |
| YouTube | https://youtube.com/@uniocedu |

Actualizar footer (y cualquier bloque de redes del sitio activo que liste estas redes). Añadir icono LinkedIn si no existe en el markup actual.

### 2.3 Menú candidato

En `resources/views/includes/user_dashboard_menu.blade.php` (y stats/home si enlazan lo mismo):

- Quitar “Mis alertas de trabajo” (`my-alerts`).
- Quitar “Mis seguimientos” (`my.followings`).

No eliminar rutas/backend salvo que sea trivial; basta con ocultar/quitar entradas de menú y enlaces visibles.

### 2.4 Campos pendientes (perfil candidato)

En `ProfileCompletionHelper` dejar de exigir (y por tanto dejar de listar en el aviso) estos campos:

- País / Departamento / Municipio de nacimiento
- Sexo
- Educación: título, nivel, fecha de finalización, estado, país
- Aspiración salarial

Mantener los demás checks existentes (p. ej. fecha de nacimiento y residencia si ya están). Actualizar umbral/porcentaje implícitamente al reducir el total de checks.

Vista relacionada: `user/inc/profile_completion_notice.blade.php` (consume `missing` del helper; no requiere cambio de copy si el helper ya no los incluye).

### 2.5 Validación contraseña ≠ confirmar

En formularios de registro de candidato y empleador:

- Servidor: regla `confirmed` en FormRequest (si falta, agregarla).
- Cliente: no permitir avanzar/enviar si no coinciden (mensaje claro).

### 2.6 Publicar vacante: ocupaciones y municipio

Diagnosticar y reparar la carga de:

- Lista de ocupaciones
- Municipio (dependiente de departamento/país)

Revisar endpoints AJAX, selects del formulario de publicación y respuestas JSON. Restaurar carga correcta sin cambiar el flujo de negocio.

---

## 3. Componentes / archivos clave (orientativos)

| Área | Archivos principales |
|---|---|
| Registro candidato | `app/Http/Controllers/Auth/RegisterController.php`, `EventServiceProvider`, listeners `UserRegisterdListener` / `UserNotifyRegisterdListener`, mailables |
| Mail admin registro | `app/Mail/UserRegisteredMailable.php`, `emails/user_registered_message.blade.php` |
| Mail revisión HV | `emails/revision.blade.php` |
| Config mail | `config/mail.php`, `CustomConfigServiceProvider.php`, settings DB `mail_to_*` / `mail_from_*` si se usan |
| Footer | `resources/views/includes/footer.blade.php` |
| Menú | `resources/views/includes/user_dashboard_menu.blade.php` |
| Perfil | `app/Helpers/ProfileCompletionHelper.php` |
| Registro forms | `auth/register.blade.php`, FormRequests Front, wizard empleador |
| Vacantes | Job form views + controllers/routes AJAX de ocupaciones/ciudades |

---

## 4. Criterios de aceptación

1. Registro candidato → usuario solo recibe activación UNIOC; admin recibe aviso en `bolsadeempleo@unioc.edu.co`; el usuario no recibe el mail de “registro nuevo”.
2. Textos/remitentes de notificación usan `bolsadeempleo@unioc.edu.co` y marca UNIOC.
3. Mail revisión HV dice “revisar” y marca UNIOC.
4. Footer: logo UNIOC + logo SPE; sin los dos logos marcados con X.
5. Redes: Facebook, X, Instagram, LinkedIn, YouTube con las URLs definidas.
6. Menú candidato sin alertas ni seguimientos.
7. Aviso de campos pendientes no lista los campos eliminados del helper.
8. Contraseñas distintas bloquean el registro.
9. En publicar vacante cargan ocupaciones y municipio.
10. No se introduce fix del error “Registrar empresa” en este paquete.

## 5. Verificación sugerida

- Registrar candidato de prueba y revisar bandeja usuario + admin.
- Inspeccionar footer y menú dashboard.
- Perfil incompleto: texto de pendientes.
- Intento de registro con confirmación distinta.
- Abrir formulario de nueva vacante y comprobar selects.
