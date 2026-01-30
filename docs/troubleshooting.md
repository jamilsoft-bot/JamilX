# Troubleshooting

## What it is
Common issues and fixes when running JamilX.

## Where it lives (folder)
- Bootstrap checks: `bootstrap/`
- Error pages: `containers/needs/`
- Installer lock: `data/installed.lock`

## Minimal example
```text
Missing .env → required.php?need=n001
```

## How to run / test
Run the CLI doctor check:
```bash
php jamilx doctor
```

Source: bootstrap/development.php, required.php, console/commands/JX_CommandDoctor.php.

---

## Issue: .env is Missing

**Symptoms**: Redirect to `required.php?need=n001`.

**Fix**:
- Create `.env` in the root.
- There is no `.env.example` in this repo, so create it manually.

Source: bootstrap/development.php, containers/needs/n001.php.

---

## Issue: Rewrite Rules Not Working

**Symptoms**: Routes return 404 or show file structure.

**Fix**:
- Enable Apache `mod_rewrite`.
- Ensure `.htaccess` is loaded by your host.

Source: .htaccess.

---

## Issue: conf.php Not Generated

**Symptoms**: DB errors or missing config paths.

**Fix**:
- Run the installer at `/installer`.
- Or create `conf.php` manually (see [Configuration](configuration.md)).

Source: installer/includes/installer_logic.php, conf.php.

---

## Issue: Database Connection Failed

**Symptoms**: CLI doctor reports DB failure or app errors.

**Fix**:
- Verify `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME` in `.env`.

Source: console/JX_ConsoleDatabase.php, core/configs/databases.php.

---

## Issue: Installer Says Already Installed

**Symptoms**: Installer shows “Already Installed”.

**Fix**:
- Remove `data/installed.lock` if you want to reinstall.

Source: installer/index.php, installer/steps/already-installed.php.
