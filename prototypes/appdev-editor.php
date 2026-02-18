<?php

function appdev_editor_is_admin(): bool
{
    global $Me;
    if (isset($Me) && method_exists($Me, 'role')) {
        return strtolower((string) $Me->role()) === 'admin';
    }
    return false;
}

function appdev_editor_require_access(): bool
{
    if (!isset($_SESSION['uid'])) {
        http_response_code(401);
        return false;
    }

    // Default policy: admin only for code editing.
    if (!appdev_editor_is_admin()) {
        http_response_code(403);
        return false;
    }

    return true;
}

function appdev_editor_csrf_token(): string
{
    if (!isset($_SESSION['appdev_editor_csrf']) || !is_string($_SESSION['appdev_editor_csrf'])) {
        $_SESSION['appdev_editor_csrf'] = bin2hex(random_bytes(24));
    }

    return $_SESSION['appdev_editor_csrf'];
}

function appdev_editor_verify_csrf(?string $token): bool
{
    if (!isset($_SESSION['appdev_editor_csrf']) || !is_string($_SESSION['appdev_editor_csrf'])) {
        return false;
    }

    if ($token === null || $token === '') {
        return false;
    }

    return hash_equals($_SESSION['appdev_editor_csrf'], $token);
}

function appdev_editor_html(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function appdev_editor_allowed_extensions(): array
{
    return [
        'php', 'json', 'md', 'txt', 'js', 'css', 'html', 'htm', 'sql', 'xml', 'yml', 'yaml', 'ini'
    ];
}

function appdev_editor_max_file_bytes(): int
{
    return 1024 * 1024; // 1MB
}

function appdev_editor_get_apps(): array
{
    global $Apps;

    if (!isset($Apps) || !method_exists($Apps, 'getAll')) {
        return [];
    }

    $raw = $Apps->getAll();
    $items = [];

    foreach ($raw as $app) {
        $nick = trim((string) ($app['Nick'] ?? ''));
        if ($nick === '') {
            continue;
        }

        $items[] = [
            'nick' => $nick,
            'name' => (string) ($app['Name'] ?? $nick),
        ];
    }

    return $items;
}

function appdev_editor_categories(): array
{
    return [
        'actions' => 'Actions',
        'prototypes' => 'Prototypes',
        'containers' => 'Containers',
        'services' => 'Services',
    ];
}

function appdev_editor_normalize_path(string $path): ?string
{
    $path = str_replace("\0", '', $path);
    $path = str_replace('\\', '/', trim($path));

    if ($path === '' || $path === '/') {
        return '';
    }

    if (strpos($path, ':') !== false) {
        return null;
    }

    $parts = explode('/', $path);
    $safe = [];
    foreach ($parts as $part) {
        $part = trim($part);
        if ($part === '' || $part === '.') {
            continue;
        }
        if ($part === '..') {
            return null;
        }
        $safe[] = $part;
    }

    return implode('/', $safe);
}

function appdev_editor_resolve_base(string $scope, string $category, ?string $app): array
{
    $categories = appdev_editor_categories();
    if (!isset($categories[$category])) {
        return [null, 'Invalid category.'];
    }

    $scope = strtolower(trim($scope));

    if ($scope === 'global') {
        $base = __DIR__ . '/../' . $category;
        return [rtrim($base, '/'), null];
    }

    if ($scope === 'app') {
        $app = trim((string) $app);
        if ($app === '') {
            return [null, 'App is required for app scope.'];
        }

        $app = preg_replace('/[^A-Za-z0-9_-]/', '', $app);
        if ($app === '') {
            return [null, 'Invalid app name.'];
        }

        $base = __DIR__ . '/../Apps/' . $app . '/' . $category;
        if (!is_dir($base)) {
            return [null, 'Directory does not exist for this app/category.'];
        }

        return [rtrim($base, '/'), null];
    }

    return [null, 'Invalid scope.'];
}

function appdev_editor_resolve_path(string $scope, string $category, ?string $app, string $relative): array
{
    [$base, $baseError] = appdev_editor_resolve_base($scope, $category, $app);
    if ($baseError !== null) {
        return [null, null, $baseError];
    }

    $safeRelative = appdev_editor_normalize_path($relative);
    if ($safeRelative === null) {
        return [null, null, 'Invalid path.'];
    }

    $target = $safeRelative === '' ? $base : ($base . '/' . $safeRelative);

    $baseReal = realpath($base);
    if ($baseReal === false) {
        return [null, null, 'Base path is not accessible.'];
    }

    $targetReal = realpath($target);
    if ($targetReal !== false) {
        if (strpos($targetReal, $baseReal) !== 0) {
            return [null, null, 'Access denied.'];
        }
    } else {
        if (strpos($target, $baseReal) !== 0) {
            return [null, null, 'Access denied.'];
        }
    }

    return [$baseReal, $target, null];
}

function appdev_editor_file_extension_allowed(string $filename): bool
{
    $ext = strtolower((string) pathinfo($filename, PATHINFO_EXTENSION));
    if ($ext === '') {
        return false;
    }

    return in_array($ext, appdev_editor_allowed_extensions(), true);
}

function appdev_editor_is_text_content(string $content): bool
{
    if ($content === '') {
        return true;
    }

    return strpos($content, "\0") === false;
}

function appdev_editor_list_entries(string $scope, string $category, ?string $app, string $path = ''): array
{
    [$base, $target, $error] = appdev_editor_resolve_path($scope, $category, $app, $path);
    if ($error !== null) {
        return ['success' => false, 'error' => $error];
    }

    if (!is_dir($target)) {
        return ['success' => false, 'error' => 'Path is not a directory.'];
    }

    $entries = scandir($target);
    if ($entries === false) {
        return ['success' => false, 'error' => 'Unable to read directory.'];
    }

    $items = [];
    foreach ($entries as $name) {
        if ($name === '.' || $name === '..') {
            continue;
        }

        $fullPath = $target . '/' . $name;
        $relative = ltrim(str_replace($base . '/', '', $fullPath), '/');
        $isDir = is_dir($fullPath);
        $isFile = is_file($fullPath);

        if ($isFile && !appdev_editor_file_extension_allowed($name)) {
            continue;
        }

        $items[] = [
            'name' => $name,
            'path' => $relative,
            'type' => $isDir ? 'dir' : 'file',
            'size' => $isFile ? (int) filesize($fullPath) : null,
            'mtime' => (int) filemtime($fullPath),
        ];
    }

    usort($items, static function ($a, $b) {
        if ($a['type'] !== $b['type']) {
            return $a['type'] === 'dir' ? -1 : 1;
        }
        return strcasecmp($a['name'], $b['name']);
    });

    return [
        'success' => true,
        'path' => appdev_editor_normalize_path($path) ?? '',
        'entries' => $items,
    ];
}

function appdev_editor_read_file(string $scope, string $category, ?string $app, string $path): array
{
    [$base, $target, $error] = appdev_editor_resolve_path($scope, $category, $app, $path);
    if ($error !== null) {
        return ['success' => false, 'error' => $error];
    }

    if (!is_file($target)) {
        return ['success' => false, 'error' => 'File not found.'];
    }

    $filename = basename($target);
    if (!appdev_editor_file_extension_allowed($filename)) {
        return ['success' => false, 'error' => 'File extension is not editable.'];
    }

    $size = (int) filesize($target);
    if ($size > appdev_editor_max_file_bytes()) {
        return ['success' => false, 'error' => 'File is too large to edit.'];
    }

    $content = file_get_contents($target);
    if ($content === false) {
        return ['success' => false, 'error' => 'Unable to read file.'];
    }

    if (!appdev_editor_is_text_content($content)) {
        return ['success' => false, 'error' => 'Binary content is not editable.'];
    }

    return [
        'success' => true,
        'path' => ltrim(str_replace($base . '/', '', $target), '/'),
        'content' => $content,
        'size' => $size,
        'mtime' => (int) filemtime($target),
        'hash' => sha1($content),
    ];
}

function appdev_editor_save_file(string $scope, string $category, ?string $app, string $path, string $content): array
{
    [$base, $target, $error] = appdev_editor_resolve_path($scope, $category, $app, $path);
    if ($error !== null) {
        return ['success' => false, 'error' => $error];
    }

    if (!is_file($target)) {
        return ['success' => false, 'error' => 'File not found.'];
    }

    if (!is_writable($target)) {
        return ['success' => false, 'error' => 'File is not writable.'];
    }

    if (!appdev_editor_file_extension_allowed(basename($target))) {
        return ['success' => false, 'error' => 'File extension is not editable.'];
    }

    if (strlen($content) > appdev_editor_max_file_bytes()) {
        return ['success' => false, 'error' => 'Content exceeds size limit.'];
    }

    if (!appdev_editor_is_text_content($content)) {
        return ['success' => false, 'error' => 'Binary content is not supported.'];
    }

    $result = file_put_contents($target, $content, LOCK_EX);
    if ($result === false) {
        return ['success' => false, 'error' => 'Unable to save file.'];
    }

    return [
        'success' => true,
        'path' => ltrim(str_replace($base . '/', '', $target), '/'),
        'size' => (int) filesize($target),
        'mtime' => (int) filemtime($target),
        'hash' => sha1($content),
    ];
}

function appdev_editor_create(string $scope, string $category, ?string $app, string $path, string $name, string $kind): array
{
    $path = appdev_editor_normalize_path($path);
    if ($path === null) {
        return ['success' => false, 'error' => 'Invalid path.'];
    }

    $name = trim(str_replace(['\\', '/', "\0"], '', $name));
    if ($name === '' || $name === '.' || $name === '..') {
        return ['success' => false, 'error' => 'Invalid name.'];
    }

    [$base, $targetDir, $error] = appdev_editor_resolve_path($scope, $category, $app, $path);
    if ($error !== null) {
        return ['success' => false, 'error' => $error];
    }

    if (!is_dir($targetDir)) {
        return ['success' => false, 'error' => 'Destination path must be a directory.'];
    }

    $target = $targetDir . '/' . $name;

    if (file_exists($target)) {
        return ['success' => false, 'error' => 'An item with this name already exists.'];
    }

    if ($kind === 'dir') {
        if (!mkdir($target, 0775, true)) {
            return ['success' => false, 'error' => 'Unable to create folder.'];
        }
    } else {
        if (!appdev_editor_file_extension_allowed($name)) {
            return ['success' => false, 'error' => 'File extension is not editable.'];
        }
        if (file_put_contents($target, "") === false) {
            return ['success' => false, 'error' => 'Unable to create file.'];
        }
    }

    return [
        'success' => true,
        'path' => ltrim(str_replace($base . '/', '', $target), '/'),
    ];
}

function appdev_editor_rename(string $scope, string $category, ?string $app, string $path, string $newName): array
{
    [$base, $target, $error] = appdev_editor_resolve_path($scope, $category, $app, $path);
    if ($error !== null) {
        return ['success' => false, 'error' => $error];
    }

    if (!file_exists($target)) {
        return ['success' => false, 'error' => 'Path not found.'];
    }

    $newName = trim(str_replace(['\\', '/', "\0"], '', $newName));
    if ($newName === '' || $newName === '.' || $newName === '..') {
        return ['success' => false, 'error' => 'Invalid name.'];
    }

    if (is_file($target) && !appdev_editor_file_extension_allowed($newName)) {
        return ['success' => false, 'error' => 'File extension is not editable.'];
    }

    $dir = dirname($target);
    $newPath = $dir . '/' . $newName;

    if (file_exists($newPath)) {
        return ['success' => false, 'error' => 'Target name already exists.'];
    }

    if (!rename($target, $newPath)) {
        return ['success' => false, 'error' => 'Unable to rename item.'];
    }

    return [
        'success' => true,
        'path' => ltrim(str_replace($base . '/', '', $newPath), '/'),
    ];
}

function appdev_editor_delete(string $scope, string $category, ?string $app, string $path): array
{
    [$base, $target, $error] = appdev_editor_resolve_path($scope, $category, $app, $path);
    if ($error !== null) {
        return ['success' => false, 'error' => $error];
    }

    if (!file_exists($target)) {
        return ['success' => false, 'error' => 'Path not found.'];
    }

    if (is_file($target)) {
        if (!unlink($target)) {
            return ['success' => false, 'error' => 'Unable to delete file.'];
        }
    } else {
        $entries = scandir($target);
        if ($entries === false) {
            return ['success' => false, 'error' => 'Unable to inspect folder.'];
        }
        $entries = array_values(array_diff($entries, ['.', '..']));
        if (!empty($entries)) {
            return ['success' => false, 'error' => 'Folder must be empty before deleting.'];
        }

        if (!rmdir($target)) {
            return ['success' => false, 'error' => 'Unable to delete folder.'];
        }
    }

    return ['success' => true];
}
