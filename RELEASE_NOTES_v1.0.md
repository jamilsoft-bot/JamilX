# JamilX Framework v1.0 Release Notes

**Release date:** 2026-03-01

## Highlights
- Expanded CLI tooling with generators, app-aware scaffolding, cache utilities, and shell completion scripts.
- Modular Apps and module scaffolding for organizing multi-feature SaaS deployments.
- API service with API-key authentication, CORS controls, rate limiting, and health checks.
- Static documentation site shipped in `docs/`.

## Developer Experience
- Use `php jamilx make:*` commands to scaffold services, actions, containers, prototypes, or a full module.
- Use `php jamilx App:*` commands to scaffold components inside an App package.
- Use `php jamilx completion:bash` or `completion:zsh` to enable shell completions.
- Use `php jamilx cache:clear` to remove cached files.

## Platform Capabilities
- Modular Apps loaded from `Apps/<app>/` with config-driven metadata.
- Installer wizard that creates `.env` and locks the install.
- Database migrations and seeders via the CLI.
- API endpoints under `/api/v1` with a JSON response envelope and health check.

## Requirements
- PHP 7.4+
- Extensions: `mysqli`, `json`, `mbstring`
- Apache rewrite enabled
- MySQL/MariaDB

## Upgrade Notes
- Run `php jamilx doctor` to validate environment readiness.
- Regenerate CLI autoloaded commands if you customized console scripts.
