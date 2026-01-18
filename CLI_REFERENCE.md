# Jamilx CLI Reference

This document describes the available `jamilx` CLI commands.

## Global Options

- `-h, --help` Show help for a command.
- `-V, --version` Show CLI version.
- `-q, --quiet` Suppress non-error output.
- `-d, --debug` Show debug output on errors.
- `--env <name>` Override the environment (sets `MODE`).
- `--no-color` Disable ANSI colors.

## Project & Diagnostics

### `about`
Show framework version, PHP version, root path, and loaded `.env` keys.

```
php jamilx about
```

### `doctor`
Check PHP version, permissions, and database connectivity.

```
php jamilx doctor
```

### `cache:clear`
Clear known cache directories (`cache/`, `storage/cache/`, `data/cache/`).

```
php jamilx cache:clear
```

## Generators

### `make:service <name>`
Create a service class in `services/`.

Options:
- `-f, --force` Overwrite files.
- `--dry-run` Preview without writing files.
- `-p, --path <path>` Override the base path.

### `make:action <name>`
Create an action class in `actions/`.

Options:
- `-f, --force`
- `--dry-run`
- `-p, --path <path>`

### `make:container <name>`
Create a container view in `containers/`.

Options:
- `-s, --service <service>` Place container under `containers/<service>/`.
- `-f, --force`
- `--dry-run`
- `-p, --path <path>`

### `make:prototype <name>`
Create a prototype in `prototypes/`.

Options:
- `-f, --force`
- `--dry-run`
- `-p, --path <path>`

### `make:module <name>`
Scaffold a module (service, action, prototype, container).

Options:
- `-f, --force`
- `--dry-run`
- `-p, --path <path>`

## Database

### `db:status`
Show migration status from `database/migrations`.

```
php jamilx db:status
```

### `db:migrate`
Run pending migrations.

Options:
- `-p, --path <path>` Override migrations path.

### `db:rollback`
Rollback the latest migration batch.

Options:
- `-p, --path <path>` Override migrations path.

### `db:seed`
Run seeders from `database/seeders`.

Options:
- `-p, --path <path>` Override seeders path.

## Development Utilities

### `serve`
Start the PHP built-in server for local development.

Options:
- `--host <host>` Host to bind (default `127.0.0.1`).
- `--port <port>` Port to bind (default `8000`).

### `logs:tail`
Tail the framework log file at `logs/errors.log`.

Options:
- `-n, --lines <count>` Number of lines (default 50).
- `-f, --follow` Keep streaming.

### `completion:bash`
Generate bash completion script.

### `completion:zsh`
Generate zsh completion script.

## Legacy Commands (Backward Compatible)

These commands retain the original CLI usage:

- `AddAction <name> [path]`
- `AddService <name> [path]`
- `CreateApp`
- `DB:Make table`
- `DB:Insert <table>`
- `DB:Delete <table>`

Use `php jamilx help <command>` for details.
