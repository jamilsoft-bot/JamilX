# Deployment

## What it is
Deployment steps for hosting JamilX on a PHP/Apache server.

## Where it lives (folder)
- Webroot: repository root
- Rewrite rules: `.htaccess`
- Logs: `logs/errors.log`

## Minimal example
```text
DocumentRoot = /path/to/JamilX
```

## How to run / test
- Upload the repository root to your server.
- Visit `/` in the browser.

Source: index.php, .htaccess.

---

## Webroot Rules

The repository root is the public webroot. Do **not** move files to a `public/` folder.

Source: .htaccess, index.php.

---

## Apache Rewrite

Ensure `mod_rewrite` is enabled and `.htaccess` is respected by your host.

Source: .htaccess.

---

## File Permissions

Make sure these paths are writable:
- `logs/`
- `data/`

Source: console/commands/JX_CommandDoctor.php.

---

## Production Checklist

- Set `MODE="production"` in `.env`
- Verify database connectivity
- Remove or protect `/installer`

Source: .env, bootstrap/production.php, installer/steps/success.php.
