# JamilX Framework v0.1 Release Notes

**Release date:** 2026-01-31

## Highlights
- Introduced the core Service/Action/Container/Prototype architecture that powers routing, business logic, views, and data helpers.
- Added a lightweight, file-based autoloading system that scans framework directories without Composer.
- Included a browser-based installer wizard and CLI commands for setup, health checks, and local development.
- Implemented routing that funnels all requests through `index.php` using Apache rewrite rules.

## Core Capabilities
- **Services & Actions:** Organized URL-based controllers and handlers for request flow.
- **Containers:** Server-rendered templates for UI composition.
- **Prototypes:** Reusable data and database helpers.
- **CLI Utilities:** Environment diagnostics, local server, migrations, and seeding commands.
- **Configuration:** `.env`-based settings with multiple runtime modes (Development, Production, Maintainance).

## Requirements
- PHP 7.4+
- Extensions: `mysqli`, `json`, `mbstring`
- Apache rewrite enabled
- MySQL/MariaDB

## Known Limitations
- No Composer integration; class loading relies on framework directory scans.
- Apache rewrite rules required for routing.

## Upgrade Notes
- Fresh install recommended for new deployments.
- Ensure `.env` exists and matches database credentials before running CLI tools.
