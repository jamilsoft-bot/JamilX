# File Manager Service Plan (JamilX)

## Framework Observations

- **Routing**: Services are resolved from the first URL segment (`$Url->get_paths()`), and the service class name must match that segment. Routing is dispatched in `route/http.php`, which instantiates the service class and calls `main()`. `services/blog.php` demonstrates multi-path routing by inspecting `$paths[1]` and `$Url->get('action')`.【F:route/http.php†L1-L29】【F:services/blog.php†L1-L90】
- **Services → Actions**: Services typically switch on path segments and call handler functions (e.g., blog) or action classes (legacy). The file manager will follow the function-style action dispatch used in `services/blog.php`.【F:services/blog.php†L1-L90】
- **Containers/Views**: Containers are included directly from action handlers. The blog module uses Tailwind CDN with layout partials in `containers/blog/layout`. We'll mirror this style with `containers/filemanager/layout` and modular partials.【F:containers/blog/layout/header.php†L1-L40】
- **Auth**: Auth is session-based (`$_SESSION['uid']`) with role lookup via `$Me->role()`. `is_admin()` checks for the role string `"Admin"`, and `blog_require_admin()` checks for lowercase `"admin"`. The file manager will enforce login if configured and treat `admin` (case-insensitive) as a full-access role.【F:core/etc/vars.php†L1-L15】【F:core/functions/app-fun.php†L37-L53】【F:prototypes/blog.php†L340-L365】
- **Filesystem**: There is no shared filesystem helper, so the file manager will implement its own safe path resolution with traversal prevention in its prototype helpers.
- **Naming/Conventions**: Services are in `services/`, actions in `actions/`, prototypes in `prototypes/`, and containers in `containers/`. The existing file manager uses the `filemanager` service name, so the module follows that convention and adds a compatibility alias for `filemanger` (requested by spec).

## File Manager Module Plan

1. **Routing**
   - Service entry `services/filemanager.php` uses path segments to route to actions like `/filemanager/browse`, `/filemanager/upload`, `/filemanager/search`, and `api/*` endpoints.
   - Add `services/filemanger.php` as an alias for misspelled routes to reduce integration risk.

2. **Actions**
   - Implement handlers in `actions/filemanager.php`:
     - `filemanager_index`, `filemanager_browse`, `filemanager_search`
     - `filemanager_upload`, `filemanager_create_folder`, `filemanager_rename`, `filemanager_delete`, `filemanager_move`, `filemanager_copy`
     - `filemanager_download`, `filemanager_preview`
     - `filemanager_api_list`, `filemanager_api_upload`

3. **Containers/UI**
   - Tailwind CDN-based UI under `containers/filemanager/`:
     - `layout/header.php` + `layout/footer.php`
     - `index.php` (shell), `toolbar.php`, `breadcrumbs.php`, `browser.php`, `empty_state.php`, `errors.php`
   - UI includes scope switcher, upload, new folder, search, sort headers, and per-file actions.

4. **Prototype Helpers**
   - `prototypes/filemanager.php` will expose configuration and helpers:
     - storage scopes: `public` + `private`
     - safe path normalization, join/resolve checks
     - filename sanitation, MIME/extension validation
     - list, search, pagination, recursive copy/delete utilities

5. **Auth + Permissions**
   - `filemanager_config()['requires_login']` gates access (default on).
   - Admins (case-insensitive) can access the full scope root.
   - Non-admin users are restricted to a user-specific subfolder under each scope.

6. **Storage Paths**
   - `data/filemanager/public` (web accessible)
   - `data/filemanager/private` (served via download/preview actions)

7. **Security**
   - Path traversal checks, filename sanitization, and MIME validation.
   - Overwrite protection by default (unique filename generated).

8. **TODOs**
   - Note CSRF integration if framework adds shared CSRF helpers.
   - Verify role casing policy to align with global auth rules.
