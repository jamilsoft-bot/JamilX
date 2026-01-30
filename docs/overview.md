# Overview

## What it is
JamilX is a PHP SaaS framework with a simple request lifecycle and a Service/Action/Container/Prototype architecture.

## Where it lives (folder)
- Core runtime: `core/`
- Runtime entry: `index.php`, `session.php`, `init.php`

## Minimal example
```text
Request → index.php → session.php → init.php → route/http.php → Service → Container
```

## How to run / test
1. Ensure `.env` is in the root.
2. Start the local server:
   ```bash
   php jamilx serve
   ```
3. Visit `http://127.0.0.1:8000/`.

## Request Lifecycle (high level)

1. **Entry**: `index.php` loads `session.php`, then `init.php`.
2. **Bootstrap**: `init.php` loads `core/system.php`, then `bootstrap.php`.
3. **Autoload**: `autoload.php` scans `prototypes/`, `services/`, and `actions/`.
4. **Hooks/Scripts**: `core/hooks/*` and `scripts/*` are included.
5. **Apps**: Installed apps are loaded from DB via `Apps->Get_Installed_Apps()`.
6. **Routing**: `route/http.php` resolves the Service class from the URL.

Source: index.php, session.php, init.php, core/system.php, bootstrap.php, autoload.php, core/hooks/init.php, scripts/, core/classes/apps-class.php, route/http.php.

## Autoloading Behavior

JamilX does not use Composer. It includes PHP files by scanning these folders:
- `prototypes/`
- `services/`
- `actions/`

Source: autoload.php.

## Environment Modes

`MODE` in `.env` selects a bootstrap class:
- `development` → `Development`
- `production` → `Production`
- `maintainance` → `Maintainance`

Source: core/hooks/init.php, bootstrap/*.php.
