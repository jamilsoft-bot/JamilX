# Security

## What it is
This section highlights built-in security behaviors and safe defaults.

## Where it lives (folder)
- Sessions: `session.php`
- API checks: `services/api.php`
- Installer lock: `data/installed.lock`
- Error logging: `logs/errors.log`

## Minimal example
```text
session_start();
```

## How to run / test
- Verify sessions by logging in and checking `$_SESSION` values.
- Use `php jamilx logs:tail` to watch errors.

Source: session.php, console/commands/JX_CommandLogsTail.php.

---

## Sessions

Sessions are started in `session.php` on every request.

Source: session.php.

---

## Admin Checks

Some features check for admin roles before allowing actions.

Source: core/classes/email-class.php.

---

## API Access

API requests require valid keys (from `.env`) and respect CORS allowlists and rate limits.

Source: services/api.php.

---

## Installer Lock

After installation, `data/installed.lock` prevents re-running the installer. Delete it only if you intentionally want to reinstall.

Source: installer/index.php.
