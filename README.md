# Jamilx PHP Framework

Jamilx is a lightweight, explicit PHP framework designed for shared hosting and cPanel-friendly deployments.

## CLI Usage

The `jamilx` CLI is the primary developer tool for scaffolding, diagnostics, and database automation.

### Getting Started

```bash
php jamilx list
php jamilx help make:service
```

### Common Commands

```bash
# Framework info and diagnostics
php jamilx about
php jamilx doctor

# Scaffolding
php jamilx make:service Billing
php jamilx make:action Blog
php jamilx make:container Dashboard --service blog
php jamilx make:prototype UserProfile
php jamilx make:module Blog

# Database tooling
php jamilx db:status
php jamilx db:migrate
php jamilx db:rollback
php jamilx db:seed
```

### Help and Version

```bash
php jamilx --version
php jamilx help <command>
```

For a full command reference, see `CLI_REFERENCE.md`.
