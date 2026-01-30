# Database

## What it is
JamilX connects to MySQL/MariaDB using credentials from `.env`. It supports installer SQL, migrations, and seeders.

## Where it lives (folder)
- `.env` (DB credentials)
- `installer/sql.sql`
- `database/migrations/`
- `database/seeders/`
- `database/blog.sql`

## Minimal example
```bash
php jamilx db:migrate
```

## How to run / test
1. Set `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME` in `.env`.
2. Run:
   ```bash
   php jamilx db:migrate
   ```

Source: core/configs/databases.php, console/commands/JX_CommandDbMigrate.php.

---

## Installer SQL

The installer uses `installer/sql.sql` to create core tables when you run the wizard.

Source: installer/includes/installer_logic.php, installer/sql.sql.

---

## Migrations

- Location: `database/migrations/`
- Each file returns `['up' => [...], 'down' => [...]]`
- Migration history is stored in `jx_migrations`

Source: console/commands/JX_CommandDbMigrate.php, console/JX_ConsoleDatabase.php, database/migrations/2025_09_01_000001_invoice_billing_forum.php.

---

## Seeders

Seeders return a callable or array of SQL statements.

Source: database/seeders/README.md, console/commands/JX_CommandDbSeed.php.

---

## Blog SQL

`database/blog.sql` contains table definitions used by the blog prototype.

Source: database/blog.sql, prototypes/blog.php.
