# JamilX Framework Documentation

JamilX is a lightweight PHP SaaS framework that uses a Service/Action/Container/Prototype structure and a simple, file-based autoloading system. It runs directly from the repository root (no `public/` folder) and uses Apache rewrite rules to route every request through `index.php`.

> **Important:** JamilX does **not** use Composer. The framework loads classes by scanning `prototypes/`, `services/`, and `actions/` from `autoload.php`.

Source: index.php, session.php, init.php, autoload.php, .htaccess.

## 1) What JamilX Is

JamilX uses four core building blocks:

| Term | What it is | Where it lives |
| --- | --- | --- |
| **Service** | Controller-like class that owns a URL section. | `services/` |
| **Action** | Handler class (or function) called by a Service. | `actions/` |
| **Container** | View template rendered by Services or Actions. | `containers/` |
| **Prototype** | Data helper / DB helper. | `prototypes/` |

Source: core/base/core-classes.php, services/, actions/, containers/, prototypes/.

## 2) Quick Start

### A) Installer Wizard (recommended)

1. Open the installer in your browser:
   ```bash
   http://your-domain/installer
   ```
2. Follow the steps. The wizard:
   - checks PHP 7.4+, `mysqli`, `json`, `mbstring`
   - writes `conf.php`
   - runs `installer/sql.sql`
   - creates `data/installed.lock`

Source: installer/index.php, installer/includes/installer_logic.php, installer/sql.sql.

### B) CLI Setup (manual path)

1. Ensure `.env` exists in the root and has DB settings.
2. Run environment checks:
   ```bash
   php jamilx doctor
   ```
3. Start local server:
   ```bash
   php jamilx serve
   ```
4. (Optional) Run migrations and seeders:
   ```bash
   php jamilx db:migrate
   php jamilx db:seed
   ```

Source: .env, console/commands/JX_CommandDoctor.php, console/commands/JX_CommandServe.php, console/commands/JX_CommandDbMigrate.php, console/commands/JX_CommandDbSeed.php.

## 3) Requirements

- PHP **7.4+**
- Extensions: `mysqli`, `json`, `mbstring`
- Apache rewrite enabled (see `.htaccess`)
- MySQL/MariaDB

Source: installer/includes/installer_logic.php, .htaccess.

## 4) Folder Structure Overview

| Path | Purpose |
| --- | --- |
| `index.php` | Entry point (loads `session.php` → `init.php`) |
| `core/` | Core framework classes and configs |
| `services/` | Service classes (routing targets) |
| `actions/` | Action handlers (often `JX_Action` classes) |
| `containers/` | View templates |
| `prototypes/` | Data/DB helper functions |
| `Apps/` | Modular apps (installed via DB) |
| `installer/` | Installer wizard |
| `database/` | Migrations, seeders, SQL |
| `logs/` | Error log output |
| `data/` | Runtime storage (lock, API data, etc.) |

Source: repository tree, index.php, init.php, services/, actions/, containers/, prototypes/.

## 5) Routing Basics

- Apache rewrites `/<path>` into `index.php?route=<path>`.
- `route` is split on `/` and the **first segment** becomes the Service class name.
- `action` is a query string parameter (e.g., `?route=dashboard&action=home`).

Examples:

```text
/                → index.php?route=
/dashboard       → index.php?route=dashboard
/dashboard?action=home
```

Special case: `/admin/blog` is routed to the `blog` Service.

Source: .htaccess, core/classes/route-class.php, core/classes/url-class.php, route/http.php.

## 6) Configuration

- `.env` is parsed with `parse_ini_file()`.
- `MODE` selects the bootstrap class (`Development`, `Production`, `Maintainance`).
- `conf.php` is created by the installer and stores DB credentials.

> **Legacy note:** `conf.php` still points to `system/configs`. Those paths are legacy references; the current folder is `core/configs/`.

Source: core/etc/vars.php, core/hooks/init.php, bootstrap/*.php, conf.php, installer/includes/installer_logic.php.

## 7) Core Concepts (with minimal examples)

### Service

**What it is:** A controller-like class for a URL entry.  
**Where it lives:** `services/`  
**Minimal example:**
```php
class Billing extends JX_Serivce implements JX_service
{
    public function main()
    {
        include "containers/billing/index.php";
    }
}
```
**How to run/test:** Visit `/billing` in the browser.

Source: core/base/core-classes.php, console/stubs/service.stub, services/.

### Action

**What it is:** A handler class invoked by a Service.  
**Where it lives:** `actions/`  
**Minimal example:**
```php
class apihome extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        include "containers/api/api.php";
    }
}
```
**How to run/test:** Trigger via a Service method or container that calls `$action->getAction()`.

Source: core/base/core-classes.php, actions/apihome.php.

### Container

**What it is:** A view template (HTML/PHP).  
**Where it lives:** `containers/`  
**Minimal example:**
```php
<div>
  <h1>My Container</h1>
</div>
```
**How to run/test:** Include it from a Service or Action.

Source: console/stubs/container.stub, containers/.

### Prototype

**What it is:** Data/DB helper functions or a helper class.  
**Where it lives:** `prototypes/`  
**Minimal example:**
```php
function blog_get_categories()
{
    return blog_db()->query("SELECT * FROM blog_categories");
}
```
**How to run/test:** Call the helper function from a Service or Action.

Source: prototypes/blog.php.

## 8) CLI Overview

The CLI entrypoint is `jamilx` (run with `php jamilx <command>`).

Common commands:

| Command | Description |
| --- | --- |
| `about` | Show framework and environment info |
| `doctor` | Check requirements, permissions, DB |
| `serve` | Start PHP built-in server |
| `make:service` | Generate a Service |
| `make:action` | Generate an Action |
| `make:container` | Generate a Container |
| `make:prototype` | Generate a Prototype |
| `make:module` | Scaffold Service/Action/Container/Prototype |
| `create:app` | Create an App under `Apps/` |
| `db:migrate` | Run migrations |
| `db:seed` | Run seeders |
| `db:status` | Migration status |
| `db:rollback` | Roll back latest batch |
| `logs:tail` | Tail `logs/errors.log` |

Source: jamilx, console/commands/*.

## 9) Database

- DB settings come from `.env` (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`).
- Installer runs `installer/sql.sql` to build base tables.
- Migrations live in `database/migrations`.
- Seeders live in `database/seeders`.

Source: core/configs/databases.php, installer/sql.sql, database/migrations, database/seeders/README.md.

## 10) Security Notes

- Sessions start in `session.php`.
- API keys and CORS allowlist are enforced in the API service.
- `installed.lock` blocks re-running the installer.

Source: session.php, services/api.php, installer/index.php.

## 11) Deployment Notes

- The **repository root is the webroot**. Do not move files into `public/`.
- Ensure `.htaccess` rewrite rules are active.
- Make `logs/` and `data/` writable.

Source: .htaccess, console/commands/JX_CommandDoctor.php.

## 12) Troubleshooting

- **Missing `.env`:** Create it manually (no `.env.example` in repo).
- **Rewrite not working:** Confirm Apache mod_rewrite + `.htaccess` are enabled.
- **`conf.php` missing:** Run installer or create the file manually.
- **`installed.lock` present:** Remove `data/installed.lock` to re-run installer.

Source: bootstrap/*.php, containers/needs/n001.php, installer/index.php.

## 13) Contributing / License

- Contributing guidelines: NOT FOUND
- License: NOT FOUND
