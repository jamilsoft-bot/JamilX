# JamilX Framework v1.1 Release Notes

**Release date:** 2026-02-23

## Highlights
- Added the AppDev editor module with `editor` and `editor-api` actions under the `appdev` service.
- Added secure editing primitives with admin-only access checks, CSRF protection, and path normalization safeguards.
- Added rich docs updates including a Jamilsoft commercial landing page and updated framework docs references.
- Added MIT licensing for open-source distribution.

## AppDev Editor (New)
- UI endpoint: `?serve=appdev&action=editor`
- JSON API endpoint: `?serve=appdev&action=editor-api&op=<operation>`
- Supported operations: `bootstrap`, `list`, `read`, `save`, `create`, `rename`, `delete`
- Supports global and app scopes for Actions, Prototypes, Containers, and Services categories.

## Security & Guardrails
- Requires authenticated session and admin role for editor access.
- Uses CSRF token verification for mutating operations.
- Restricts editable extensions and blocks binary or oversized files (1MB limit).
- Enforces safe path resolution to prevent traversal and out-of-scope access.

## Documentation & Commercial Packaging
- Updated docs navigation and pages to reflect current editor capabilities.
- Added `docs/commercial.html` for Jamilsoft online SaaS builder positioning.
- Added bundle positioning for Personal, Enterprise, and Education/School deployments.

## Upgrade Notes
- No migration required for existing projects.
- Ensure admin users are available for AppDev editor access workflows.
- Review and publish updated docs from `docs/` with your standard deployment process.
