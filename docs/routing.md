# Routing

## What it is
Routing maps URLs to Service classes using a `route` query string and (optionally) an `action` query string.

## Where it lives (folder)
- Rewrite rules: `.htaccess`
- Router logic: `route/http.php`, `core/classes/route-class.php`, `core/classes/url-class.php`

## Minimal example
```text
/dashboard?action=home
```

## How to run / test
1. Ensure Apache rewrite is enabled.
2. Visit `/dashboard` or `/dashboard?action=home` in the browser.

Source: .htaccess, route/http.php, core/classes/route-class.php, core/classes/url-class.php.

---

## Rewrite Rule

Apache rewrites all non-file, non-directory requests into:

```text
index.php?route=<path>
```

Source: .htaccess.

---

## Service Resolution

The first URL segment becomes the Service class name:

- `route=dashboard` → `class Dashboard`
- `route=blog` → `class blog`

When only one segment exists, the router falls back to `JX_Route::index()`.

Source: route/http.php, core/classes/route-class.php.

---

## Action Query Param

Services often look for `action` to decide which Action to run.

Example:
```text
/dashboard?action=home
```

Source: core/classes/url-class.php, services/dashboard.php.

---

## Special Case: /admin/blog

`/admin/blog` is treated as the `blog` Service instead of `admin`.

Source: route/http.php.
