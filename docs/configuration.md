# Configuration

## What it is
JamilX reads configuration from `.env` and `conf.php` (installer-generated).

## Where it lives (folder)
- `.env` in the repository root
- `conf.php` in the repository root
- Core configs in `core/configs/`

## Minimal example
```ini
MODE = "development"
DB_HOST = "localhost"
DB_USER = "root"
DB_PASS = ""
DB_NAME = "jx"
```

## How to run / test
After editing `.env`, run:
```bash
php jamilx doctor
```

Source: core/etc/vars.php, core/configs/databases.php, console/commands/JX_CommandDoctor.php.

---

## .env Keys

JamilX reads `.env` with `parse_ini_file()` and uses these keys:

### App & Site
- `SITENAME`
- `SITE_DESCRIPTION`
- `SITE_MAIL`
- `SITE_THEME`
- `SITE_LOGO`
- `SITE_OWNER`
- `SITE_OWNER_ADDRESS`

### Database
- `DB_HOST`
- `DB_USER`
- `DB_PASS`
- `DB_NAME`

### Environment Mode
- `MODE` (`development`, `production`, or `maintainance`)

### Mail
- `MAIL_DRIVER`
- `MAIL_HOST`
- `MAIL_PORT`
- `MAIL_USERNAME`
- `MAIL_PASSWORD`
- `MAIL_ENCRYPTION`
- `MAIL_FROM_EMAIL`
- `MAIL_FROM_NAME`
- `MAIL_REPLY_TO`
- `MAIL_DEBUG`

### API
- `API_KEYS`
- `API_CORS_ALLOWLIST`
- `API_RATE_LIMIT`
- `API_RATE_WINDOW`

Source: .env, core/etc/vars.php, core/classes/settings-class.php, core/classes/email-class.php, services/api.php.

---

## MODE Behavior

`MODE` selects a bootstrap class from `bootstrap/`:
- `development` → `Development`
- `production` → `Production`
- `maintainance` → `Maintainance`

Source: core/hooks/init.php, bootstrap/*.php.

---

## conf.php (Installer Output)

The installer writes `conf.php` with DB settings and config paths. Paths like `system/configs` are **legacy references**; the current folder is `core/configs/`.

Source: installer/includes/installer_logic.php, conf.php, core/configs/.

---

## Missing Files

There is no `.env.example` in the repository. Create `.env` manually if it is missing.

Source: repository root, containers/needs/n001.php.
