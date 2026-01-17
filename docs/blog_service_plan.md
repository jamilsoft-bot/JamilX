# Blog Service Plan (JamilX)

## Framework Observations
- **Routing**: Requests are routed via `route/http.php` using `JS_URL::get_paths()` to decide service classes. Single-segment routes (e.g., `/dashboard`) resolve via `JX_Route::index()` and class names in `services/`. Multi-segment routes are parsed by `get_paths()` for service routing. `route=http` is supplied by `.htaccess`. 
- **Services & Actions**: Service classes live in `services/` and implement `JX_service`, then load containers. Action handlers are typically in `actions/` as functions or action classes that load containers. 
- **Containers**: PHP views in `containers/` render HTML directly; there is no global templating layer. Each service can define its own layout.
- **DB Access**: DB uses `JX_Database` (`mysqli`) via global `$JX_db` and helper functions in `core/functions/db-fun.php`. Queries are executed manually with SQL strings.
- **Naming Conventions**: Services are class names matching route segments (case-insensitive). Actions are plain PHP classes or functions named to reflect their purpose. Containers are grouped by feature.
- **Security/Auth**: Admin access checks generally rely on `$_SESSION['uid']` and `$Me->role()` with role `admin`.

## Blog Module Plan
- **Routing**: The blog service parses route segments (`/blog`, `/blog/post/{slug}`, `/blog/category/{slug}`, `/blog/tag/{slug}`, `/blog/search?q=`) and admin routes (`/admin/blog`, `/admin/blog/new`, `/admin/blog/edit/{id}`, `/admin/blog/delete/{id}`, `/admin/blog/categories`, `/admin/blog/tags`).
- **Actions**: `actions/blog.php` provides handlers for public and admin pages. Each handler prepares data (posts, tags, categories, pagination) and renders a container.
- **Containers**: Public containers live in `containers/blog/` with a Tailwind layout. Admin containers live in `containers/blog/admin/` with their own Tailwind layout.
- **Data**: `prototypes/blog.php` defines table names, slug/excerpt helpers, tag/category helpers, and blog-specific queries using `$JX_db`.
- **Uploads**: Featured image uploads are handled with file type checks, size limits, and storage in `data/blog/`.
- **Validation**: Input is trimmed, validated, and escaped before SQL usage; output is escaped via `blog_html()` to reduce XSS risk.
- **Testing**: Add a manual testing checklist to validate each route and CRUD flow.
