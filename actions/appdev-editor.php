<?php

function appdev_editor_json(array $payload, int $status = 200): void
{
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($payload);
}

function appdev_editor_request_data(): array
{
    $body = file_get_contents('php://input');
    if (!is_string($body) || trim($body) === '') {
        return $_POST;
    }

    $json = json_decode($body, true);
    if (is_array($json)) {
        return $json;
    }

    return $_POST;
}

class appdeveditor extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Code Editor');
        $this->setText('Edit app files across actions, prototypes, containers and services.');
    }

    public function getAction()
    {
        include 'containers/appdev/editor.php';
    }
}

class appdeveditorapi extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Code Editor API');
    }

    public function getAction()
    {
        global $Url;

        if (!appdev_editor_require_access()) {
            appdev_editor_json(['success' => false, 'error' => 'Access denied.'], http_response_code() ?: 403);
            return;
        }

        $op = strtolower((string) ($Url->get('op') ?? ''));
        $method = strtoupper((string) ($_SERVER['REQUEST_METHOD'] ?? 'GET'));
        $data = appdev_editor_request_data();

        $scope = strtolower((string) ($Url->get('scope') ?? ($data['scope'] ?? 'global')));
        $category = strtolower((string) ($Url->get('category') ?? ($data['category'] ?? 'actions')));
        $app = $Url->get('app') ?? ($data['app'] ?? null);

        switch ($op) {
            case 'bootstrap':
                $categories = appdev_editor_categories();
                $apps = appdev_editor_get_apps();
                appdev_editor_json([
                    'success' => true,
                    'csrf' => appdev_editor_csrf_token(),
                    'categories' => $categories,
                    'apps' => $apps,
                    'defaults' => [
                        'scope' => 'global',
                        'category' => 'actions',
                        'path' => '',
                    ],
                ]);
                return;

            case 'list':
                $path = (string) ($Url->get('path') ?? ($data['path'] ?? ''));
                $result = appdev_editor_list_entries($scope, $category, is_string($app) ? $app : null, $path);
                appdev_editor_json($result, $result['success'] ? 200 : 400);
                return;

            case 'read':
                $path = (string) ($Url->get('path') ?? ($data['path'] ?? ''));
                $result = appdev_editor_read_file($scope, $category, is_string($app) ? $app : null, $path);
                appdev_editor_json($result, $result['success'] ? 200 : 400);
                return;

            case 'save':
            case 'create':
            case 'rename':
            case 'delete':
                if ($method !== 'POST') {
                    appdev_editor_json(['success' => false, 'error' => 'Method not allowed.'], 405);
                    return;
                }

                $csrf = (string) ($data['csrf'] ?? '');
                if (!appdev_editor_verify_csrf($csrf)) {
                    appdev_editor_json(['success' => false, 'error' => 'Invalid CSRF token.'], 419);
                    return;
                }

                if ($op === 'save') {
                    $path = (string) ($data['path'] ?? '');
                    $content = (string) ($data['content'] ?? '');
                    $result = appdev_editor_save_file($scope, $category, is_string($app) ? $app : null, $path, $content);
                    appdev_editor_json($result, $result['success'] ? 200 : 400);
                    return;
                }

                if ($op === 'create') {
                    $path = (string) ($data['path'] ?? '');
                    $name = (string) ($data['name'] ?? '');
                    $kind = strtolower((string) ($data['kind'] ?? 'file'));
                    $kind = $kind === 'dir' ? 'dir' : 'file';
                    $result = appdev_editor_create($scope, $category, is_string($app) ? $app : null, $path, $name, $kind);
                    appdev_editor_json($result, $result['success'] ? 200 : 400);
                    return;
                }

                if ($op === 'rename') {
                    $path = (string) ($data['path'] ?? '');
                    $newName = (string) ($data['newName'] ?? '');
                    $result = appdev_editor_rename($scope, $category, is_string($app) ? $app : null, $path, $newName);
                    appdev_editor_json($result, $result['success'] ? 200 : 400);
                    return;
                }

                $path = (string) ($data['path'] ?? '');
                $result = appdev_editor_delete($scope, $category, is_string($app) ? $app : null, $path);
                appdev_editor_json($result, $result['success'] ? 200 : 400);
                return;

            default:
                appdev_editor_json(['success' => false, 'error' => 'Unknown operation.'], 400);
                return;
        }
    }
}
