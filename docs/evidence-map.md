# Evidence Map (JamilX)

## Docs Site
- Docs root: `docs/` (static HTML pages such as `docs/index.html`).

## Runtime Entry + Lifecycle
- Entry point: `index.php` → `session.php` → `init.php`.
- Boot flow in `init.php`: load `core/system.php`, `bootstrap.php`, core hooks, scripts, installed Apps, then `route/http.php`.
- Environment mode: `core/hooks/init.php` reads `MODE` from `.env`, instantiates `Development`, `Production`, or `Maintainance` from `bootstrap/`.

## Routing
- Apache rewrite: `.htaccess` rewrites to `index.php?route=$1`.
- Request router: `route/http.php` uses `$Url->get_paths()` to determine the first segment Service class, with a legacy `admin/blog` remap to `blog`.
- Default route is resolved through `core/classes/route-class.php` (falls back to `about`).

## Autoloading
- `autoload.php` includes `core/index.php`, then scans `prototypes/`, `services/`, and `actions/` for PHP files.
- `core/index.php` scans `core/base/` and `core/classes/`, and loads `core/etc/global.php` + `core/functions/global.php`.

## Installer
- Installer entry: `installer/index.php`.
- `.env` generation: `installer/includes/installer_logic.php` writes from `.env.example`.
- Installer lock: `data/installed.lock` set in `installer/index.php`.
- Requirements: PHP 7.4+, `mysqli`, `json`, `mbstring`, writable root/data directory.

## CLI
- Entrypoint: `jamilx` (boots `console/JX_ConsoleKernel.php`).
- Command registry: `console/commands/`.
- Diagnostics: `JX_CommandDoctor`, `JX_CommandAbout`.
- Migrations/seeders: `JX_CommandDbMigrate`, `JX_CommandDbRollback`, `JX_CommandDbStatus`, `JX_CommandDbSeed`.

## Apps & Modules
- Apps: `core/classes/apps-class.php`, load from `Apps/<app>/conf.json` and include `Apps/<app>/<app>.php` in `init.php`.
- Module scaffolding: `console/commands/JX_CommandMakeModule.php`.

## Database & Migrations
- Migrations directory: `database/migrations/` (format documented in `database/migrations/README.md`).
- Tracking table: `jx_migrations` in `console/JX_ConsoleDatabase.php`.
- Seeders: `database/seeders/` loaded by `JX_CommandDbSeed`.

## API + Security
- API service: `services/api.php` (keys in `API_KEYS`, CORS via `API_CORS_ALLOWLIST`, rate limiting via `API_RATE_LIMIT`/`API_RATE_WINDOW`).
- Response envelope: `services/api.php` + `core/classes/api-class.php`.
- Sessions: `session.php`.
