# AI and Coding Agent Instructions

This repository is JamilX, a lightweight, file-based PHP SaaS framework.

## Project Architecture

JamilX has four primary code concepts:

- `services/`: controller-like classes that own an HTTP route section.
- `actions/`: request handlers invoked by services or through `?action=` routes.
- `containers/`: PHP/HTML view templates and UI modules.
- `prototypes/`: data, database, and helper functions or classes.

Typical request flow:

```text
Apache rewrite
  -> index.php
  -> route/http.php
  -> Service from services/
  -> Action selected through ?action= or by the service
  -> Container rendered from containers/
  -> Prototype used for data access
```

Use `Apps/<app>/` for modular applications. Generated app modules should follow the same Service/Action/Container/Prototype structure.

Other important locations:

- `core/`: framework classes, configuration, database and bootstrap code.
- `bootstrap/`: environment bootstrap implementations.
- `console/`: CLI command implementation.
- `database/migrations/`: database migrations.
- `database/seeders/`: seed data.
- `installer/`: installation wizard and initial SQL setup.
- `route/`: routing implementation.
- `docs/`: static documentation site.
- `data/`: runtime state and locks.
- `logs/`: runtime logs.

## Core Runtime Rules

- JamilX does not use Composer. Do not introduce Composer dependencies unless the task explicitly calls for a framework migration.
- Classes are discovered by the file-based loader in `autoload.php`. Preserve existing filenames and discovery conventions.
- Apache is the documented web server. `.htaccess` rewrites paths into `index.php?route=<path>`.
- The first route segment identifies the service. Prefer `?action=<name>` for service sub-actions.
- Configuration is read through `.env` and `parse_ini_file()` in the existing bootstrap code.
- Database access primarily uses the framework's global and helper conventions, especially `$JX_db` and classes in `prototypes/`.
- Repository root is the web root. Do not reorganize framework files into `public/`.
- PHP 7.4+ compatibility is required unless a task explicitly changes the supported runtime.

## Change Rules

- Make the smallest change that satisfies the requested task.
- Match nearby naming, class, formatting, and file-layout conventions.
- Prefer existing service/action/container/prototype patterns over new abstractions.
- Keep public behavior backward-compatible unless the change explicitly requests a breaking change.
- Do not rewrite entire modules or directories without a separate, clearly scoped task.
- Do not assume that legacy code is unused. Inspect call sites before changing it.
- Treat `lagacy/`, misspellings, and old installer files as historical compatibility code unless the task names those areas.
- Do not move or rename files merely for cleanup in the same change as a feature or fix.
- Do not introduce framework dependencies that bypass JamilX autoloading.
- Keep comments limited to intent that is not obvious from the code.

## Routing and Module Rules

- A service should own the route entry point and delegate named operations to action classes where practical.
- Action classes should extend `JX_Action` and implement `JX_ActionI`, using `getAction()` for rendering or operation dispatch.
- Containers are views; keep business logic and persistence out of view templates.
- Prototypes own or centralize data access helpers. Avoid placing repeated SQL in containers.
- Generate new modules using the CLI conventions or copy the closest existing module as a template.
- Preserve existing links and redirects unless updating routing as part of the task.
- Unknown actions should fail predictably through existing framework error handling rather than being silently ignored.

## Database and Security Rules

- Prefer prepared statements for database input. Never concatenate untrusted input into SQL.
- Escape output at the presentation boundary appropriate to its context.
- Validate and normalize route parameters, form fields, and API input before use.
- Preserve authentication and authorization checks in services and state-changing actions.
- Use CSRF checks for state-changing web requests.
- Do not log secrets, passwords, API keys, database credentials, or session tokens.
- Never print or commit `.env` values or production credentials.
- Re-running the installer must remain prevented while `data/installed.lock` exists.
- Do not weaken file, API, CORS, rate-limit, or administrator protections.
- Treat WebAuthn and cryptographic authentication carefully. Do not claim passkey verification is complete unless the cryptographic assertions are actually validated.

## Installer and CLI Rules

- Keep the installer wizard and `installer/sql.sql` consistent for fresh installations.
- Database migrations should be paired with installer or rollback behavior where applicable.
- CLI commands must preserve `php jamilx <command>` compatibility.
- Generated files must work with the file-based loader and should not depend on Composer.
- `php jamilx doctor` should remain available for environment diagnostics.

## Validation Requirements

At minimum, for PHP changes:

```bash
find modified_php_paths -name '*.php' -print0 | xargs -0 -n1 php -l
php jamilx doctor
```

Use additional validation based on the change:

- Routing: exercise `/service` and `/service?action=<action>` in the local web server.
- Actions: verify the action class exists and `getAction()` is reached.
- Containers: compare desktop and relevant mobile rendering if UI changes affect layout.
- Database: run migrations and seeders only against a disposable local database.
- API: verify the JSON response, status code, authentication, and CORS behavior.
- Installer: test only in a disposable environment and restore or remove `data/installed.lock` appropriately.
- CLI: run `php jamilx list`, the changed command, and `php jamilx help <command>` when applicable.

Do not describe a change as tested unless the relevant command or browser check was actually run.

## Pull Request Requirements

Every pull request or completed agent task should include:

1. A short summary of changed behavior.
2. The exact files or modules affected.
3. Validation performed and commands run.
4. Known limitations or unverified areas.
5. No generated credentials, secrets, local `.env`, runtime logs, or lock files.

## Open-Ended Areas

Agents may help with documentation, tests, CLI scaffolding, routing consistency, security hardening, and framework cleanup. New features should begin with an issue or focused implementation plan.

Before changing authentication, billing, installer logic, database schemas, or core routing, trace the complete request flow and identify backward compatibility risks.

## Unclear Context

If repository evidence does not establish the expected behavior, state that it is unclear and add no speculative implementation. Ask a maintainer before making broad architectural decisions.
