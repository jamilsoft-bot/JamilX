# CLI

## What it is
The JamilX CLI is a PHP script (`jamilx`) used for generators, database tools, and diagnostics.

## Where it lives (folder)
- CLI entry: `jamilx`
- CLI implementation: `console/`

## Minimal example
```bash
php jamilx list
```

## How to run / test
Run any command from the repository root:
```bash
php jamilx doctor
```

Source: jamilx, console/JX_ConsoleKernel.php.

---

## Command Catalog

### General
- `list` — list all commands
- `help` — show command usage

### Project
- `about` — framework & environment info
- `doctor` — requirements and DB checks
- `cache:clear` — clear cache directories

### Development
- `serve` — start built-in PHP server
- `logs:tail` — tail `logs/errors.log`
- `completion:bash` — bash completion script
- `completion:zsh` — zsh completion script

### Generators
- `make:service`
- `make:action`
- `make:container`
- `make:prototype`
- `make:module`
- `create:app`

### Database
- `db:migrate`
- `db:seed`
- `db:status`
- `db:rollback`

### Legacy Commands
These are preserved for compatibility:
- `AddAction`
- `AddService`
- `CreateApp`
- `DB:Make`
- `DB:Insert`
- `DB:Delete`

Source: console/commands/*.php, console/JX_ConsoleKernel.php, console/DB.php.

---

## Examples

```bash
php jamilx serve --port 8080
php jamilx make:service Billing
php jamilx db:migrate
php jamilx logs:tail --follow
```

Source: console/commands/JX_CommandServe.php, console/commands/JX_CommandMakeService.php, console/commands/JX_CommandDbMigrate.php, console/commands/JX_CommandLogsTail.php.
