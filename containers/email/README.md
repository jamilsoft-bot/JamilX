# JamilX Email Module

## Architecture Overview
JamilX services are resolved by the router (`route/http.php` + `core/classes/route-class.php`) using the service class name, and services render UI by including container files inside `containers/`. Actions are lightweight classes that extend `JX_Action` and are instantiated based on the `action` query string (see the Dashboard and Admin patterns). This module follows that same pattern, with the Email service acting as the entry point, delegating to action classes, which then render container views. The Email API lives in `core/classes/email-class.php` so it is autoloaded alongside other core classes.

## Request Lifecycle
1. **Request** → `route/http.php` resolves the service class (e.g., `email`).
2. **Service** → `services/email.php` renders the email layout container (`containers/email/email.php`).
3. **Action** → the layout resolves `?action=...` into an action class (`emailhome`, `emailconfig`, etc.).
4. **Container/View** → action includes the matching container file under `containers/email/`.

## Naming & Folder Conventions
- **Service class**: lowercase service name in `services/<service>.php` (e.g., `class email extends JX_Serivce`).
- **Action classes**: in `actions/` or a service file, extending `JX_Action` with `getAction()` to include a container view.
- **Containers**: `containers/<module>/` holds the view and layout files, and its subfolders hold templates/partials/assets.
- **Templates**: `containers/email/templates/*.php` for HTML email bodies; partials live in `containers/email/partials/`.
- **Config**: JamilX reads `.env` via `parse_ini_file()`, so email settings follow the same approach.

## Patterns Followed
- Service → action → container lifecycle (matching `services/dashboard.php` and `containers/dashboard/*`).
- Action classes in the JamilX style (`extends JX_Action implements JX_ActionI`).
- UI uses W3/Bootstrap utility classes and simple PHP includes for layout.
- Configuration via `.env` + sensible defaults for missing keys.
- DB access via global `$JX_db` (as used across the framework).

## Checklist (Implementation Plan)
- [x] Use `services/email.php` as the entry point and render a layout container.
- [x] Implement action classes for Email Home, Config Status, Send Test, Logs, Queue, and Self-Test.
- [x] Create `core/classes/email-class.php` for driver-based sending API (`Email::send`, `Email::sendText`, `Email::queue`).
- [x] Add template rendering under `containers/email/templates/` with partials.
- [x] Add UI views under `containers/email/` for admin screens.
- [x] Add log + queue persistence using JamilX DB conventions.
- [x] Provide a CLI-safe `containers/email/selftest.php` to validate config and template rendering.

## Self-Test (CLI)
Run the email self-test from the repo root:

```
php containers/email/selftest.php
```

## Queue Worker (CLI)
Process queued emails from the database:

```
php containers/email/queue-worker.php 10
```
