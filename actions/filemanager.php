<?php

function filemanager_request_wants_json()
{
    $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
    if (strpos($accept, 'application/json') !== false) {
        return true;
    }
    return isset($_GET['format']) && $_GET['format'] === 'json';
}

function filemanager_json_response(array $payload, $status = 200)
{
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($payload);
}

function filemanager_redirect_to_browser($scope, $path, $notice = null, $error = null)
{
    $params = [
        'scope' => $scope,
        'path' => $path,
        'notice' => $notice,
        'error' => $error,
    ];
    Redirect(filemanager_page_url('filemanager/browse', $params));
}

function filemanager_parent_path($path)
{
    $path = filemanager_normalize_path($path);
    if ($path === null || $path === '') {
        return '';
    }
    $pos = strrpos($path, '/');
    if ($pos === false) {
        return '';
    }
    return substr($path, 0, $pos);
}

function filemanager_collect_uploads($files)
{
    if (!isset($files['name'])) {
        return [];
    }

    $entries = [];
    if (is_array($files['name'])) {
        foreach ($files['name'] as $index => $name) {
            $entries[] = [
                'name' => $name,
                'type' => $files['type'][$index] ?? null,
                'tmp_name' => $files['tmp_name'][$index] ?? null,
                'error' => $files['error'][$index] ?? null,
                'size' => $files['size'][$index] ?? null,
            ];
        }
    } else {
        $entries[] = $files;
    }

    return $entries;
}

function filemanager_index()
{
    filemanager_browse();
}

function filemanager_browse()
{
    global $Url;
    $scope = filemanager_get_scope($Url->get('scope'));
    if (!filemanager_require_access($scope)) {
        return;
    }

    $path = $Url->get('path');
    $sort = $Url->get('sort') ?: 'name';
    $direction = $Url->get('dir') ?: 'asc';
    $page = max(1, (int) $Url->get('page'));

    $root = filemanager_root_path($scope);
    $listing = filemanager_list_directory($root, $path);
    $entries = [];
    $errors = [];

    if ($listing['error']) {
        $errors[] = $listing['error'];
    } else {
        $entries = filemanager_sort_entries($listing['entries'], $sort, $direction);
    }

    $config = filemanager_config();
    $pagination = filemanager_paginate_entries($entries, $page, $config['pagination']['per_page']);
    $currentPath = $listing['path'];
    $breadcrumbs = filemanager_build_breadcrumbs($listing['path']);

    $notice = $Url->get('notice');
    $errorNotice = $Url->get('error');
    if ($errorNotice) {
        $errors[] = $errorNotice;
    }

    $scopeOptions = filemanager_scope_options();
    $isSearch = false;
    $searchQuery = '';
    $baseUrl = 'filemanager/browse';

    include 'containers/filemanager/index.php';
}

function filemanager_search()
{
    global $Url;
    $scope = filemanager_get_scope($Url->get('scope'));
    if (!filemanager_require_access($scope)) {
        return;
    }

    $path = $Url->get('path');
    $query = trim((string) $Url->get('q'));
    $sort = $Url->get('sort') ?: 'name';
    $direction = $Url->get('dir') ?: 'asc';
    $page = max(1, (int) $Url->get('page'));

    $root = filemanager_root_path($scope);
    $listing = filemanager_search_directory($root, $path, $query);
    $entries = [];
    $errors = [];

    if ($listing['error']) {
        $errors[] = $listing['error'];
    } else {
        $entries = filemanager_sort_entries($listing['entries'], $sort, $direction);
    }

    $config = filemanager_config();
    $pagination = filemanager_paginate_entries($entries, $page, $config['pagination']['per_page']);
    $currentPath = $listing['path'];
    $breadcrumbs = filemanager_build_breadcrumbs($listing['path']);

    $notice = $Url->get('notice');
    $errorNotice = $Url->get('error');
    if ($errorNotice) {
        $errors[] = $errorNotice;
    }

    $scopeOptions = filemanager_scope_options();
    $isSearch = true;
    $searchQuery = $query;
    $baseUrl = 'filemanager/search';

    include 'containers/filemanager/index.php';
}

function filemanager_upload()
{
    global $Url;
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        return;
    }

    $scope = filemanager_get_scope($Url->post('scope') ?? $Url->get('scope'));
    if (!filemanager_require_access($scope)) {
        return;
    }

    $root = filemanager_root_path($scope);
    $path = $Url->post('path');
    [$target, $error, $normalized] = filemanager_resolve_path($root, $path);
    if ($error || !is_dir($target)) {
        filemanager_redirect_to_browser($scope, $normalized, null, $error ?: 'Upload folder not found.');
        return;
    }

    $uploads = filemanager_collect_uploads($_FILES['files'] ?? $_FILES['file'] ?? []);
    if (empty($uploads)) {
        filemanager_redirect_to_browser($scope, $normalized, null, 'No files were uploaded.');
        return;
    }

    $config = filemanager_config();
    $saved = 0;
    $failed = 0;
    $errors = [];

    foreach ($uploads as $upload) {
        if (($upload['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            $failed++;
            $errors[] = 'Upload failed for ' . filemanager_html($upload['name'] ?? 'file');
            continue;
        }

        if (($upload['size'] ?? 0) > $config['max_upload_size']) {
            $failed++;
            $errors[] = 'File too large: ' . filemanager_html($upload['name']);
            continue;
        }

        $safeName = filemanager_sanitize_filename($upload['name']);
        $mime = filemanager_mime_type($upload['tmp_name']);
        if (!filemanager_is_allowed_type($safeName, $mime)) {
            $failed++;
            $errors[] = 'File type not allowed: ' . filemanager_html($safeName);
            continue;
        }

        if (!$config['allow_overwrite']) {
            $safeName = filemanager_unique_name($target, $safeName);
        }

        $destination = $target . '/' . $safeName;
        if (!move_uploaded_file($upload['tmp_name'], $destination)) {
            $failed++;
            $errors[] = 'Unable to save ' . filemanager_html($safeName);
            continue;
        }

        $saved++;
    }

    $notice = $saved > 0 ? "Uploaded {$saved} file(s)." : null;
    $errorMessage = $failed > 0 ? implode(' ', $errors) : null;

    if (filemanager_request_wants_json()) {
        filemanager_json_response([
            'success' => $failed === 0,
            'saved' => $saved,
            'failed' => $failed,
            'errors' => $errors,
        ], $failed === 0 ? 200 : 422);
        return;
    }

    filemanager_redirect_to_browser($scope, $normalized, $notice, $errorMessage);
}

function filemanager_create_folder()
{
    global $Url;
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        return;
    }

    $scope = filemanager_get_scope($Url->post('scope') ?? $Url->get('scope'));
    if (!filemanager_require_access($scope)) {
        return;
    }

    $root = filemanager_root_path($scope);
    $path = $Url->post('path');
    [$target, $error, $normalized] = filemanager_resolve_path($root, $path);
    if ($error || !is_dir($target)) {
        filemanager_redirect_to_browser($scope, $normalized, null, $error ?: 'Folder not found.');
        return;
    }

    $name = filemanager_sanitize_filename($Url->post('name'));
    if ($name === '') {
        filemanager_redirect_to_browser($scope, $normalized, null, 'Folder name is required.');
        return;
    }

    $newPath = $target . '/' . $name;
    if (file_exists($newPath)) {
        filemanager_redirect_to_browser($scope, $normalized, null, 'Folder already exists.');
        return;
    }

    if (!mkdir($newPath, 0775, true)) {
        filemanager_redirect_to_browser($scope, $normalized, null, 'Unable to create folder.');
        return;
    }

    filemanager_redirect_to_browser($scope, $normalized, 'Folder created.', null);
}

function filemanager_rename()
{
    global $Url;
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        return;
    }

    $scope = filemanager_get_scope($Url->post('scope') ?? $Url->get('scope'));
    if (!filemanager_require_access($scope)) {
        return;
    }

    $root = filemanager_root_path($scope);
    $path = $Url->post('path');
    [$source, $error, $normalized] = filemanager_resolve_path($root, $path);
    if ($error || !file_exists($source)) {
        filemanager_redirect_to_browser($scope, filemanager_parent_path($normalized), null, $error ?: 'Item not found.');
        return;
    }

    $name = filemanager_sanitize_filename($Url->post('name'));
    if ($name === '') {
        filemanager_redirect_to_browser($scope, filemanager_parent_path($normalized), null, 'New name is required.');
        return;
    }

    $destination = dirname($source) . '/' . $name;
    if (file_exists($destination)) {
        filemanager_redirect_to_browser($scope, filemanager_parent_path($normalized), null, 'An item with that name already exists.');
        return;
    }

    if (!rename($source, $destination)) {
        filemanager_redirect_to_browser($scope, filemanager_parent_path($normalized), null, 'Unable to rename item.');
        return;
    }

    filemanager_redirect_to_browser($scope, filemanager_parent_path($normalized), 'Item renamed.', null);
}

function filemanager_delete()
{
    global $Url;
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        return;
    }

    $scope = filemanager_get_scope($Url->post('scope') ?? $Url->get('scope'));
    if (!filemanager_require_access($scope)) {
        return;
    }

    $root = filemanager_root_path($scope);
    $path = $Url->post('path');
    [$target, $error, $normalized] = filemanager_resolve_path($root, $path);
    if ($error || !file_exists($target)) {
        filemanager_redirect_to_browser($scope, filemanager_parent_path($normalized), null, $error ?: 'Item not found.');
        return;
    }

    $deleted = filemanager_recursive_delete($target);
    if (!$deleted) {
        filemanager_redirect_to_browser($scope, filemanager_parent_path($normalized), null, 'Unable to delete item.');
        return;
    }

    filemanager_redirect_to_browser($scope, filemanager_parent_path($normalized), 'Item deleted.', null);
}

function filemanager_move()
{
    global $Url;
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        return;
    }

    $scope = filemanager_get_scope($Url->post('scope') ?? $Url->get('scope'));
    if (!filemanager_require_access($scope)) {
        return;
    }

    $root = filemanager_root_path($scope);
    $path = $Url->post('path');
    $targetPath = $Url->post('target');

    [$source, $error, $normalized] = filemanager_resolve_path($root, $path);
    if ($error || !file_exists($source)) {
        filemanager_redirect_to_browser($scope, filemanager_parent_path($normalized), null, $error ?: 'Item not found.');
        return;
    }

    $targetPath = filemanager_normalize_path($targetPath);
    if ($targetPath === null || $targetPath === '') {
        filemanager_redirect_to_browser($scope, filemanager_parent_path($normalized), null, 'Target path is required.');
        return;
    }

    [$target, $targetError] = filemanager_resolve_path($root, $targetPath);
    if ($targetError) {
        filemanager_redirect_to_browser($scope, filemanager_parent_path($normalized), null, $targetError);
        return;
    }

    if (is_dir($target)) {
        $target = rtrim($target, '/') . '/' . basename($source);
    }

    if (file_exists($target)) {
        filemanager_redirect_to_browser($scope, filemanager_parent_path($normalized), null, 'Target already exists.');
        return;
    }

    if (!rename($source, $target)) {
        filemanager_redirect_to_browser($scope, filemanager_parent_path($normalized), null, 'Unable to move item.');
        return;
    }

    filemanager_redirect_to_browser($scope, filemanager_parent_path($normalized), 'Item moved.', null);
}

function filemanager_copy()
{
    global $Url;
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        return;
    }

    $scope = filemanager_get_scope($Url->post('scope') ?? $Url->get('scope'));
    if (!filemanager_require_access($scope)) {
        return;
    }

    $root = filemanager_root_path($scope);
    $path = $Url->post('path');
    $targetPath = $Url->post('target');

    [$source, $error, $normalized] = filemanager_resolve_path($root, $path);
    if ($error || !file_exists($source)) {
        filemanager_redirect_to_browser($scope, filemanager_parent_path($normalized), null, $error ?: 'Item not found.');
        return;
    }

    $targetPath = filemanager_normalize_path($targetPath);
    if ($targetPath === null || $targetPath === '') {
        filemanager_redirect_to_browser($scope, filemanager_parent_path($normalized), null, 'Target path is required.');
        return;
    }

    [$target, $targetError] = filemanager_resolve_path($root, $targetPath);
    if ($targetError) {
        filemanager_redirect_to_browser($scope, filemanager_parent_path($normalized), null, $targetError);
        return;
    }

    if (is_dir($target)) {
        $target = rtrim($target, '/') . '/' . basename($source);
    }

    if (file_exists($target)) {
        filemanager_redirect_to_browser($scope, filemanager_parent_path($normalized), null, 'Target already exists.');
        return;
    }

    if (!filemanager_copy_recursive($source, $target)) {
        filemanager_redirect_to_browser($scope, filemanager_parent_path($normalized), null, 'Unable to copy item.');
        return;
    }

    filemanager_redirect_to_browser($scope, filemanager_parent_path($normalized), 'Item copied.', null);
}

function filemanager_download()
{
    global $Url;
    $scope = filemanager_get_scope($Url->get('scope'));
    if (!filemanager_require_access($scope)) {
        return;
    }

    $root = filemanager_root_path($scope);
    $path = $Url->get('path');
    [$file, $error] = filemanager_resolve_path($root, $path);
    if ($error || !is_file($file)) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }

    $filename = basename($file);
    $mime = filemanager_mime_type($file) ?: 'application/octet-stream';
    header('Content-Type: ' . $mime);
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Length: ' . filesize($file));
    readfile($file);
}

function filemanager_preview()
{
    global $Url;
    $scope = filemanager_get_scope($Url->get('scope'));
    if (!filemanager_require_access($scope)) {
        return;
    }

    $root = filemanager_root_path($scope);
    $path = $Url->get('path');
    [$file, $error] = filemanager_resolve_path($root, $path);
    if ($error || !is_file($file)) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }

    $filename = basename($file);
    if (!filemanager_is_previewable($filename)) {
        filemanager_download();
        return;
    }

    $mime = filemanager_mime_type($file) ?: 'application/octet-stream';
    header('Content-Type: ' . $mime);
    header('Content-Disposition: inline; filename="' . $filename . '"');
    header('Content-Length: ' . filesize($file));
    readfile($file);
}

function filemanager_api_list()
{
    global $Url;
    $scope = filemanager_get_scope($Url->get('scope'));
    if (!filemanager_require_access($scope)) {
        return;
    }

    $path = $Url->get('path');
    $sort = $Url->get('sort') ?: 'name';
    $direction = $Url->get('dir') ?: 'asc';
    $page = max(1, (int) $Url->get('page'));

    $root = filemanager_root_path($scope);
    $listing = filemanager_list_directory($root, $path);
    if ($listing['error']) {
        filemanager_json_response(['success' => false, 'error' => $listing['error']], 400);
        return;
    }

    $entries = filemanager_sort_entries($listing['entries'], $sort, $direction);
    $config = filemanager_config();
    $pagination = filemanager_paginate_entries($entries, $page, $config['pagination']['per_page']);

    filemanager_json_response([
        'success' => true,
        'path' => $listing['path'],
        'entries' => $pagination['entries'],
        'pagination' => [
            'page' => $pagination['page'],
            'total_pages' => $pagination['total_pages'],
            'total' => $pagination['total'],
        ],
    ]);
}

function filemanager_api_upload()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        return;
    }

    $_GET['format'] = 'json';
    filemanager_upload();
}

class filemanagerhome extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Welcome to JamilX File Manager service');
        $this->setText('');
    }

    public function getAction()
    {
        filemanager_index();
    }
}
