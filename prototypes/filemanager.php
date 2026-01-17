<?php

class JX_FileManagerP extends JX_Prototype implements JX_PrototypeI
{
    public function __construct()
    {
        parent::__construct('file_manager');
    }
}

function filemanager_config()
{
    return [
        'requires_login' => true,
        'allow_overwrite' => false,
        'max_upload_size' => 10 * 1024 * 1024,
        'pagination' => [
            'per_page' => 50,
        ],
        'allowed_extensions' => [
            'jpg', 'jpeg', 'png', 'gif', 'webp',
            'pdf', 'txt', 'csv',
            'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx',
            'zip', 'rar', '7z',
            'mp4', 'mp3', 'wav',
        ],
        'allowed_mimes' => [
            'jpg' => ['image/jpeg'],
            'jpeg' => ['image/jpeg'],
            'png' => ['image/png'],
            'gif' => ['image/gif'],
            'webp' => ['image/webp'],
            'pdf' => ['application/pdf'],
            'txt' => ['text/plain'],
            'csv' => ['text/csv', 'text/plain', 'application/vnd.ms-excel'],
            'doc' => ['application/msword', 'application/vnd.ms-office'],
            'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
            'xls' => ['application/vnd.ms-excel'],
            'xlsx' => ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
            'ppt' => ['application/vnd.ms-powerpoint'],
            'pptx' => ['application/vnd.openxmlformats-officedocument.presentationml.presentation'],
            'zip' => ['application/zip', 'application/x-zip-compressed'],
            'rar' => ['application/vnd.rar', 'application/x-rar-compressed'],
            '7z' => ['application/x-7z-compressed'],
            'mp4' => ['video/mp4'],
            'mp3' => ['audio/mpeg'],
            'wav' => ['audio/wav', 'audio/x-wav'],
        ],
        'scopes' => [
            'public' => [
                'label' => 'Public',
                'path' => __DIR__ . '/../data/filemanager/public',
                'url' => 'data/filemanager/public',
                'enabled' => true,
            ],
            'private' => [
                'label' => 'Private',
                'path' => __DIR__ . '/../data/filemanager/private',
                'url' => null,
                'enabled' => true,
            ],
        ],
    ];
}

function filemanager_html($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function filemanager_is_admin()
{
    global $Me;
    $role = strtolower((string) $Me->role());
    return $role === 'admin';
}

function filemanager_scope_options()
{
    $config = filemanager_config();
    $scopes = [];
    foreach ($config['scopes'] as $key => $scope) {
        if (!empty($scope['enabled'])) {
            $scopes[$key] = $scope;
        }
    }
    return $scopes;
}

function filemanager_get_scope($scope)
{
    $scope = strtolower(trim((string) $scope));
    $scopes = filemanager_scope_options();
    if ($scope !== '' && isset($scopes[$scope])) {
        return $scope;
    }
    return array_key_first($scopes);
}

function filemanager_require_access($scope)
{
    $config = filemanager_config();
    if ($config['requires_login'] && !isset($_SESSION['uid'])) {
        Redirect('login&resume=filemanager');
        return false;
    }

    $scopes = filemanager_scope_options();
    if (!isset($scopes[$scope])) {
        http_response_code(404);
        include 'containers/common/error.php';
        return false;
    }

    return true;
}

function filemanager_user_prefix()
{
    if (filemanager_is_admin()) {
        return '';
    }
    if (isset($_SESSION['uid'])) {
        return 'users/' . (int) $_SESSION['uid'];
    }
    return 'users/guest';
}

function filemanager_root_path($scope)
{
    $config = filemanager_config();
    $scopes = $config['scopes'];
    $root = $scopes[$scope]['path'];
    if (!is_dir($root)) {
        mkdir($root, 0775, true);
    }

    $prefix = filemanager_user_prefix();
    if ($prefix !== '') {
        $root = rtrim($root, '/') . '/' . $prefix;
        if (!is_dir($root)) {
            mkdir($root, 0775, true);
        }
    }

    return $root;
}

function filemanager_public_base_url($scope)
{
    $config = filemanager_config();
    $scopeConfig = $config['scopes'][$scope] ?? null;
    if (!$scopeConfig || empty($scopeConfig['url'])) {
        return null;
    }
    $prefix = filemanager_user_prefix();
    $base = rtrim($scopeConfig['url'], '/');
    if ($prefix !== '') {
        $base .= '/' . $prefix;
    }
    return $base;
}

function filemanager_normalize_path($path)
{
    $path = str_replace("\0", '', (string) $path);
    $path = str_replace('\\', '/', $path);
    $path = trim($path);
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

function filemanager_resolve_path($root, $relative)
{
    $relative = filemanager_normalize_path($relative);
    if ($relative === null) {
        return [null, 'Invalid path provided.', null];
    }

    $root = rtrim($root, '/');
    $full = $relative === '' ? $root : $root . '/' . $relative;

    $rootReal = realpath($root);
    if ($rootReal === false) {
        $rootReal = $root;
    }

    $fullReal = realpath($full);
    if ($fullReal !== false) {
        if (strpos($fullReal, $rootReal) !== 0) {
            return [null, 'Access denied.', null];
        }
    } else {
        if (strpos($full, $rootReal) !== 0) {
            return [null, 'Access denied.', null];
        }
    }

    return [$full, null, $relative];
}

function filemanager_sanitize_filename($name)
{
    $name = trim((string) $name);
    $name = str_replace(["\0", '/', '\\'], '', $name);
    $name = preg_replace('/\s+/', '_', $name);
    $name = preg_replace('/[^A-Za-z0-9._-]/', '', $name);
    $name = trim($name, '._');
    return $name === '' ? 'file' : $name;
}

function filemanager_is_allowed_type($filename, $mime)
{
    $config = filemanager_config();
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    if ($ext === '' || !in_array($ext, $config['allowed_extensions'], true)) {
        return false;
    }

    $allowed = $config['allowed_mimes'][$ext] ?? [];
    if ($mime && !empty($allowed)) {
        return in_array($mime, $allowed, true);
    }

    return true;
}

function filemanager_mime_type($path)
{
    if (function_exists('finfo_open')) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        if ($finfo) {
            $mime = finfo_file($finfo, $path);
            finfo_close($finfo);
            return $mime ?: null;
        }
    }
    if (function_exists('mime_content_type')) {
        return mime_content_type($path) ?: null;
    }
    return null;
}

function filemanager_unique_name($directory, $filename)
{
    $name = pathinfo($filename, PATHINFO_FILENAME);
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $suffix = 1;
    $candidate = $filename;
    while (file_exists($directory . '/' . $candidate)) {
        $candidate = $name . '-' . $suffix;
        if ($ext !== '') {
            $candidate .= '.' . $ext;
        }
        $suffix++;
    }
    return $candidate;
}

function filemanager_format_bytes($bytes)
{
    $bytes = (int) $bytes;
    if ($bytes < 1024) {
        return $bytes . ' B';
    }
    $units = ['KB', 'MB', 'GB', 'TB'];
    $size = $bytes;
    foreach ($units as $unit) {
        $size /= 1024;
        if ($size < 1024) {
            return number_format($size, 1) . ' ' . $unit;
        }
    }
    return number_format($size, 1) . ' PB';
}

function filemanager_file_type($filename, $isDir)
{
    if ($isDir) {
        return 'folder';
    }
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $map = [
        'jpg' => 'image',
        'jpeg' => 'image',
        'png' => 'image',
        'gif' => 'image',
        'webp' => 'image',
        'pdf' => 'pdf',
        'txt' => 'text',
        'csv' => 'spreadsheet',
        'doc' => 'document',
        'docx' => 'document',
        'xls' => 'spreadsheet',
        'xlsx' => 'spreadsheet',
        'ppt' => 'presentation',
        'pptx' => 'presentation',
        'zip' => 'archive',
        'rar' => 'archive',
        '7z' => 'archive',
        'mp4' => 'video',
        'mp3' => 'audio',
        'wav' => 'audio',
    ];
    return $map[$ext] ?? 'file';
}

function filemanager_is_previewable($filename)
{
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    return in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf'], true);
}

function filemanager_list_directory($root, $relative)
{
    [$full, $error, $normalized] = filemanager_resolve_path($root, $relative);
    if ($error) {
        return ['entries' => [], 'error' => $error, 'path' => $normalized];
    }
    if (!is_dir($full)) {
        return ['entries' => [], 'error' => 'Folder not found.', 'path' => $normalized];
    }

    $entries = [];
    $items = scandir($full);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }
        $itemPath = $full . '/' . $item;
        $isDir = is_dir($itemPath);
        $entries[] = [
            'name' => $item,
            'path' => ltrim(($normalized ? $normalized . '/' : '') . $item, '/'),
            'is_dir' => $isDir,
            'type' => filemanager_file_type($item, $isDir),
            'size' => $isDir ? null : filesize($itemPath),
            'modified' => filemtime($itemPath),
        ];
    }

    return ['entries' => $entries, 'error' => null, 'path' => $normalized];
}

function filemanager_sort_entries(array $entries, $sort, $direction)
{
    $direction = strtolower($direction) === 'desc' ? 'desc' : 'asc';
    $sort = $sort ?: 'name';

    usort($entries, function ($a, $b) use ($sort, $direction) {
        if ($a['is_dir'] !== $b['is_dir']) {
            return $a['is_dir'] ? -1 : 1;
        }

        switch ($sort) {
            case 'date':
                $cmp = ($a['modified'] ?? 0) <=> ($b['modified'] ?? 0);
                break;
            case 'size':
                $cmp = ($a['size'] ?? 0) <=> ($b['size'] ?? 0);
                break;
            case 'type':
                $cmp = strcmp($a['type'], $b['type']);
                break;
            case 'name':
            default:
                $cmp = strcasecmp($a['name'], $b['name']);
                break;
        }

        return $direction === 'desc' ? -$cmp : $cmp;
    });

    return $entries;
}

function filemanager_paginate_entries(array $entries, $page, $perPage)
{
    $total = count($entries);
    $page = max(1, (int) $page);
    $perPage = max(1, (int) $perPage);
    $totalPages = max(1, (int) ceil($total / $perPage));
    $page = min($page, $totalPages);
    $offset = ($page - 1) * $perPage;

    return [
        'entries' => array_slice($entries, $offset, $perPage),
        'page' => $page,
        'total_pages' => $totalPages,
        'total' => $total,
    ];
}

function filemanager_build_breadcrumbs($path)
{
    $path = filemanager_normalize_path($path);
    if ($path === null || $path === '') {
        return [];
    }
    $segments = explode('/', $path);
    $breadcrumbs = [];
    $current = '';
    foreach ($segments as $segment) {
        $current = $current === '' ? $segment : $current . '/' . $segment;
        $breadcrumbs[] = [
            'label' => $segment,
            'path' => $current,
        ];
    }
    return $breadcrumbs;
}

function filemanager_recursive_delete($path)
{
    if (is_file($path) || is_link($path)) {
        return unlink($path);
    }
    if (!is_dir($path)) {
        return false;
    }
    $items = scandir($path);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }
        filemanager_recursive_delete($path . '/' . $item);
    }
    return rmdir($path);
}

function filemanager_copy_recursive($src, $dst)
{
    if (is_dir($src)) {
        if (!is_dir($dst)) {
            mkdir($dst, 0775, true);
        }
        $items = scandir($src);
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }
            filemanager_copy_recursive($src . '/' . $item, $dst . '/' . $item);
        }
        return true;
    }

    return copy($src, $dst);
}

function filemanager_search_directory($root, $relative, $query, $limit = 200)
{
    [$full, $error, $normalized] = filemanager_resolve_path($root, $relative);
    if ($error) {
        return ['entries' => [], 'error' => $error, 'path' => $normalized];
    }
    if (!is_dir($full)) {
        return ['entries' => [], 'error' => 'Folder not found.', 'path' => $normalized];
    }

    $query = strtolower(trim((string) $query));
    if ($query === '') {
        return ['entries' => [], 'error' => null, 'path' => $normalized];
    }

    $results = [];
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($full, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($iterator as $info) {
        $name = $info->getFilename();
        if (stripos($name, $query) === false) {
            continue;
        }
        $relativePath = trim(str_replace($full, '', $info->getPathname()), '/');
        $isDir = $info->isDir();
        $results[] = [
            'name' => $name,
            'path' => ($normalized ? $normalized . '/' : '') . $relativePath,
            'is_dir' => $isDir,
            'type' => filemanager_file_type($name, $isDir),
            'size' => $isDir ? null : $info->getSize(),
            'modified' => $info->getMTime(),
        ];
        if (count($results) >= $limit) {
            break;
        }
    }

    return ['entries' => $results, 'error' => null, 'path' => $normalized];
}

function filemanager_page_url($base, array $params = [])
{
    $query = http_build_query(array_filter($params, function ($value) {
        return $value !== null && $value !== '';
    }));
    if ($query === '') {
        return $base;
    }
    return $base . '?' . $query;
}
