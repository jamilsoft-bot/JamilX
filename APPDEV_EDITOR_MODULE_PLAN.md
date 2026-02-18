# AppDev Code Editor Module Plan (Full-Featured)

## Goal
Build a production-ready **App Development Code Editor module** inside the existing JamilX architecture, with:

- A left navigation panel for app domains:
  - Actions
  - Prototypes
  - Containers
  - Services
- A central editing area for file content
- Safe file operations (open/save/rename/create/delete)
- Search/filter and basic developer ergonomics
- Tight alignment with JamilX Service/Action/Container/Prototype conventions

---

## Current Codebase Reality (what we must align with)

### 1) Request lifecycle and dynamic loading
- Apache rewrites all routes to `index.php?route=<path>`.
- `index.php` loads session/bootstrap/init.
- `init.php` loads hooks, scripts, installed apps, and route execution.
- `autoload.php` eagerly includes all prototypes, services, and actions from root folders.

**Implication for module:**
- New editor behavior should be introduced as an `appdev` feature via service + action route handling, while keeping compatibility with current loading conventions.

### 2) AppDev currently acts as a UI shell with static/partial pages
- `services/appdev.php` has `main`, `list`, `create` and inline app creation logic.
- `containers/appdev/appdev.php` switches by `action` and includes page fragments.
- `containers/appdev/nav.php` already provides a sidebar pattern and is the ideal base for a richer editor navigation.

**Implication for module:**
- We should avoid introducing a parallel architecture; instead extend `appdev` with a dedicated `editor` action and page.

### 3) Existing FileManager already solves many hard backend problems
- `services/filemanager.php` has action map dispatch and supports route-to-action adaptation.
- `actions/filemanager.php` exposes browse/search/upload/move/copy/delete/download/preview and JSON APIs.
- `prototypes/filemanager.php` already handles path normalization, directory traversal protection, scope roots, extension/mime allow-list logic.

**Implication for module:**
- The editor module should **reuse FileManager security and path helpers** instead of rolling its own filesystem logic.

### 4) App metadata and scaffolding exist
- `core/classes/apps-class.php` loads app metadata from `Apps/<name>/conf.json` and install status.
- `core/classes/app-data-class.php` already scaffolds app directory structures and starter files.

**Implication for module:**
- Editor navigation can be app-aware and scoped to selected app roots (`Apps/<nick>/actions`, `containers`, `services`, plus `prototypes` if app-specific).

---

## Proposed Module Architecture

## A) URL / Route model

Use `appdev` service with editor-focused actions:

- `?serve=appdev&action=editor` → editor shell
- `?serve=appdev&action=editor-api&op=list` → tree/list data
- `?serve=appdev&action=editor-api&op=read` → file content
- `?serve=appdev&action=editor-api&op=save` → save file
- `?serve=appdev&action=editor-api&op=create`
- `?serve=appdev&action=editor-api&op=rename`
- `?serve=appdev&action=editor-api&op=delete`

Add class-based action handlers under `actions/`:

- `appdeveditor` (renders shell container)
- `appdeveditorapi` (JSON endpoint)

This mirrors current framework style and keeps routing simple.

## B) File scope model (important)

Create explicit scope resolution:

- **Global scope**:
  - `actions/`
  - `containers/`
  - `services/`
  - `prototypes/`
- **App scope** (selected app `X`):
  - `Apps/X/actions/` (if exists)
  - `Apps/X/containers/`
  - `Apps/X/services/` (or root service file fallback)
  - `Apps/X/prototypes/` (if future-enabled)

All operations resolve through a single helper:

- `appdev_editor_resolve_path(scope, category, relativePath)`

And must enforce:

- normalization
- no `..`
- no absolute path breakout
- allowed extension list (`php`, `json`, `md`, `txt`, `js`, `css`, `html`, `sql`, etc.)

## C) Backend module boundaries

### 1. Prototype/helper layer
Create `prototypes/appdev-editor.php` with:

- Scope/category registry
- Path resolution and guards
- File read/write wrappers (locking, size limits)
- Directory listing builder (returns tree nodes)
- Optional `git diff` helper for preview changes

### 2. Action layer
Create `actions/appdev-editor.php` with:

- `class appdeveditor extends JX_Action implements JX_ActionI`
  - renders `containers/appdev/editor.php`
- `class appdeveditorapi extends JX_Action implements JX_ActionI`
  - checks auth/role
  - routes `op` to handlers
  - returns JSON

### 3. Service integration
Update `services/appdev.php`:

- Route `action=editor` to editor container/action
- Route `action=editor-api` to API action
- Keep existing `main/list/create` behavior intact

---

## D) Frontend editor UI (container)

Create `containers/appdev/editor.php` with a **3-region layout**:

1. **Left Nav (domain panel)**
   - Tabs/sections: Actions, Prototypes, Containers, Services
   - Search box to filter tree nodes
   - App selector (global vs specific app)

2. **Middle File Tree**
   - Hierarchical listing for chosen category
   - Context actions: new file/folder, rename, delete
   - Badges for modified/readonly

3. **Right Editor Pane**
   - Text editor (CodeMirror recommended lightweight path)
   - File header: path, save, revert, format
   - Dirty state tracking
   - Optional diff view

### Why CodeMirror first?
- Easier integration than Monaco in this PHP setup.
- Lower bundle complexity and fewer worker/path issues.
- Can still upgrade later to Monaco behind a feature flag.

---

## E) Security and permission model

Minimum enforcement:

- Must be logged in (`$_SESSION['uid']`)
- Admin-only by default (or role-gated)
- CSRF token for mutating ops (`save/create/rename/delete`)
- Server-side size cap for read/write (e.g., 1 MB default)
- Block binary files for editor read
- Audit log line on writes/deletes

Reuse existing filemanager-style safety patterns for path hygiene.

---

## F) UX behavior requirements

- Open file loads content and language mode by extension
- Save via Ctrl/Cmd+S
- Unsaved changes prompt on file switch/navigation
- Quick search (filename filter) in nav/tree
- Keyboard shortcuts:
  - Ctrl/Cmd+P: quick open
  - Ctrl/Cmd+S: save
  - Ctrl/Cmd+F: in-file find
- Friendly empty/error states

---

## G) Data contracts (JSON API)

### `op=list`
Request:

```json
{ "scope":"global|app", "app":"jamilpress", "category":"actions", "path":"" }
```

Response:

```json
{
  "success": true,
  "cwd": "actions",
  "entries": [
    {"name":"createapp.php","type":"file","path":"createapp.php","size":1290,"mtime":1735212121},
    {"name":"dashboard","type":"dir","path":"dashboard"}
  ]
}
```

### `op=read`
Response includes UTF-8 text content + metadata.

### `op=save`
Request includes content and optional `etag/hash` for optimistic concurrency.

---

## H) Phased implementation plan

## Phase 1 — Foundation (backend-safe)
1. Add `prototypes/appdev-editor.php` path/security helpers.
2. Add `actions/appdev-editor.php` with JSON list/read/save only.
3. Wire new actions from `services/appdev.php`.
4. Add basic container `containers/appdev/editor.php` with simple textarea + save button.

**Done criteria:** open + edit + save text files safely by category.

## Phase 2 — Navigation + tree UX
1. Add domain sidebar (Actions/Prototypes/Containers/Services).
2. Add tree panel with expand/collapse and search.
3. Add app selector and scope switching.
4. Add create/rename/delete endpoints and UI actions.

**Done criteria:** full file navigation and CRUD in allowed scope.

## Phase 3 — Editor ergonomics
1. Integrate CodeMirror.
2. Syntax highlighting, line numbers, bracket matching.
3. Dirty-state tracking and keyboard shortcuts.
4. Optional split diff for unsaved vs saved.

**Done criteria:** daily-usable coding experience.

## Phase 4 — Hardening
1. CSRF integration for mutations.
2. Rate limiting / debounce save.
3. Audit logging for write/delete.
4. File size and encoding handling improvements.

**Done criteria:** safe for multi-user admin environment.

## Phase 5 — Polishing and extension
1. Add command palette (quick open/actions).
2. Add template snippets for JamilX boilerplates.
3. Add “Generate module” button integrating CLI scaffolds.
4. Add plugin hook for lint/format.

---

## I) Suggested file-by-file change list

1. `services/appdev.php`
   - Introduce editor routing (`editor`, `editor-api`).

2. `actions/appdev-editor.php` (new)
   - Render + API handlers.

3. `prototypes/appdev-editor.php` (new)
   - Security + filesystem helpers.

4. `containers/appdev/editor.php` (new)
   - Panel/tree/editor UI.

5. `containers/appdev/nav.php`
   - Add “Code Editor” menu item.

6. `containers/appdev/header.php`
   - Include editor CSS/JS assets when `action=editor`.

7. `assets` (if needed)
   - Add editor JS module for API calls and keyboard shortcuts.

---

## J) Risks and mitigations

- **Risk:** path traversal / arbitrary write.
  - **Mitigation:** centralized resolver + deny `..` + root-prefix checks.
- **Risk:** editing massive/binary files.
  - **Mitigation:** extension allow-list + size cap + binary guard.
- **Risk:** accidental overwrite.
  - **Mitigation:** optimistic concurrency hash + unsaved warning + optional backups.
- **Risk:** coupling with legacy patterns.
  - **Mitigation:** isolate logic in dedicated prototype/action files and keep service glue thin.

---

## K) Validation checklist

- Can list files by each category.
- Can open and edit a PHP file and save changes.
- Cannot access files outside allowed roots.
- Can create/rename/delete within allowed roots.
- Editor warns on unsaved change.
- Works in both global and app scope.
- Role/auth checks enforced.

---

## L) Definition of done (v1)

- Navigation panel includes **Actions / Prototypes / Containers / Services**.
- Text editor supports read/write with syntax highlight.
- CRUD + search for files implemented.
- Security baseline complete (auth + path safety + CSRF for writes).
- Module integrated into `appdev` without breaking existing list/create flows.
