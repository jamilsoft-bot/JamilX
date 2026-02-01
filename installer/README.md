# JamilX Installer Wizard

This directory contains the refreshed installer wizard UI built with TailwindCSS CDN. It preserves the legacy installation logic while providing a more modern experience.

## How the Wizard Works

1. **Welcome**: Intro screen with quick guidance.
2. **Requirements**: Verifies PHP version, required extensions, and directory permissions.
3. **Database**: Captures DB host, name, user, password, and optional port, then writes `.env` from `.env.example`.
4. **Install**: Executes `installer/sql.sql` to create tables.
5. **Company Info**: Stores organization details in the `options` table (`cprofile` entry).
6. **Admin Account**: Creates the primary admin user and writes the install lock file at `data/installed.lock`.

All installer logic lives in `installer/includes/installer_logic.php` and mirrors the original `/oldinstaller` behaviors.

## Branding

* Update the logo path and product name in `installer/index.php` and `installer/steps/layout.php`.
* Tailwind utility classes control the color scheme. The primary color is set via `bg-blue-*` and `text-blue-*` classes in the step templates.

## Step-to-Logic Mapping

| Step | View | Logic |
| --- | --- | --- |
| Welcome | `steps/welcome.php` | N/A |
| Requirements | `steps/requirements.php` | `installer_requirements()` |
| Database | `steps/database.php` | `installer_write_config()` |
| Install | `steps/install.php` | `installer_run_sql()` |
| Company | `steps/company.php` | `installer_save_company()` |
| Admin | `steps/admin.php` | `installer_save_admin()` |
| Success | `steps/success.php` | install lock creation |

## Notes

* The legacy installer was moved to `/oldinstaller` and remains unchanged for reference.
* The wizard creates `/data/installed.lock` to prevent re-running the installer.
