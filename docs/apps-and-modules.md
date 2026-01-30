# Apps & Modules

## What it is
Apps are modular packages stored in `Apps/`. The framework loads installed apps from the database at runtime.

## Where it lives (folder)
- `Apps/` (each app has its own folder)
- `Apps/<app>/conf.json`

## Minimal example
```text
Apps/MyApp/conf.json
```

## How to run / test
1. Create an app directory and `conf.json`.
2. Install the app so it appears in the `apps` table.
3. Reload the site to include the app at runtime.

Source: core/classes/apps-class.php, init.php.

---

## Installed Apps Loading

At boot, JamilX loads installed apps from the database:
- `Apps->Get_Installed_Apps()`
- `init.php` includes each app by name

Source: core/classes/apps-class.php, init.php.

---

## CLI: Create an App

Use the CLI wizard to create a new app:
```bash
php jamilx create:app MyApp
```

This creates the app directory and writes `Apps/MyApp/conf.json`.

Source: console/commands/JX_CommandCreateApp.php, core/classes/app-data-class.php.

---

## CLI: Scaffold a Module

Use the module generator to create a Service, Action, Container, and Prototype:
```bash
php jamilx make:module Blog
```

Source: console/commands/JX_CommandMakeModule.php.
