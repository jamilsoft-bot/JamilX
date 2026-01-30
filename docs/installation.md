# Installation

## What it is
This guide shows how to install JamilX using the installer wizard or a manual CLI path.

## Where it lives (folder)
- Installer wizard: `installer/`
- CLI entry: `jamilx`
- Configuration files: `.env`, `conf.php`

## Minimal example
```text
Browser → /installer → writes conf.php + data/installed.lock
```

## How to run / test
Use either the installer or the CLI steps below.

---

## Option A: Installer Wizard (Recommended)

1. Open the installer in your browser:
   ```text
   http://your-domain/installer
   ```
2. Follow the steps (Requirements → Database → Install → Company → Admin → Success).
3. The installer writes:
   - `conf.php`
   - `data/installed.lock`
   - Base database tables via `installer/sql.sql`

Source: installer/index.php, installer/includes/installer_logic.php, installer/sql.sql.

### Installer Requirements

The installer checks:
- PHP 7.4+
- Extensions: `mysqli`, `json`, `mbstring`
- Writable root directory and `data/`

Source: installer/includes/installer_logic.php.

---

## Option B: Manual CLI Setup (No Composer)

JamilX does **not** use Composer. You should configure and run it directly.

1. Create or edit `.env` in the root (see [Configuration](configuration.md)).
2. Check environment health:
   ```bash
   php jamilx doctor
   ```
3. Start the local server:
   ```bash
   php jamilx serve
   ```
4. Run migrations (optional):
   ```bash
   php jamilx db:migrate
   ```
5. Run seeders (optional):
   ```bash
   php jamilx db:seed
   ```

Source: jamilx, console/commands/JX_CommandDoctor.php, console/commands/JX_CommandServe.php, console/commands/JX_CommandDbMigrate.php, console/commands/JX_CommandDbSeed.php.

---

## Webroot Decision (Important)

The repository root is the public webroot. Do not move files into a `public/` folder.

Source: .htaccess, index.php.

---

## Legacy Reference Notice

The installer writes `conf.php` with `system/configs` paths. These are **legacy references**; the current configs live in `core/configs/`.

Source: installer/includes/installer_logic.php, conf.php, core/configs/.
