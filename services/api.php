<?php
 
/**
 * API service entry and management UI.
 *
 * api: handles JSON API requests under /api.
 * apiservice: provides the UI for managing API operations.
 */
class api extends JX_Serivce implements JX_service
{
    public function __construct()
    {
        $this->setTitle('JamilX API');
    }

    /**
     * Main entry for all API requests.
     */
    public function main()
    {
        global $Url;

        $paths = $Url->get_paths();
        $this->applyCorsHeaders();

        if ($this->handleCorsPreflight()) {
            return;
        }

        $version = $paths[1] ?? null;
        if ($version === null || $version === '') {
            $this->renderDocs();
            return;
        }

        if ($version !== 'v1') {
            $this->respond(404, false, 'API version not found.', null, ['version' => 'Unsupported version.']);
            return;
        }

        $resource = $paths[2] ?? null;
        $resourceId = $paths[3] ?? null;

        if ($resource == 'health') {
            $this->respond(200, true, 'Service healthy.', [
                'service' => 'api',
                'version' => 'v1',
                'timestamp' => gmdate('c'),
            ]);
            return;
        } else if (!$this->authorizeRequest()) {
            return;
        } else {
            // $act = is_null($Url->get('action')) ? "apihome" : $Url->get('action');
            if (class_exists($resource)) {
                $action = new $resource();

                $action->getApi();
            } else {
                $this->respond(404, false, 'Endpoint not found.', null, ['resource' => 'Unknown endpoint.']);
            }
        }
    }

    /**
     * UI documentation for the API service.
     */
    private function renderDocs()
    {
        include 'containers/api/api.php';
    }

    /**
     * Ensure the request is authorized with an API key and within rate limits.
     */
    private function authorizeRequest()
    {
        $apiKey = $this->getApiKeyFromRequest();
        if ($apiKey === null) {
            $this->respond(401, false, 'API key required.', null, ['auth' => 'Provide a valid API key.']);
            return false;
        }

        $keys = $this->getConfiguredApiKeys();
        if (empty($keys)) {
            $this->respond(403, false, 'API keys are not configured.', null, ['auth' => 'Configure API_KEYS in .env.']);
            return false;
        }

        if (!in_array($apiKey, $keys, true)) {
            $this->respond(403, false, 'Invalid API key.', null, ['auth' => 'API key is not recognized.']);
            return false;
        }

        if (!$this->checkRateLimit($apiKey)) {
            $this->respond(429, false, 'Rate limit exceeded.', null, ['rate_limit' => 'Try again later.']);
            return false;
        }

        return true;
    }

    /**
     * Simple CRUD sample resource: notes.
     */
    private function handleNotes($resourceId)
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');

        switch ($method) {
            case 'GET':
                if ($resourceId !== null) {
                    $this->showNote($resourceId);
                    return;
                }
                $this->listNotes();
                return;
            case 'POST':
                $this->createNote();
                return;
            case 'PUT':
            case 'PATCH':
                if ($resourceId === null) {
                    $this->respond(400, false, 'Note ID is required.', null, ['id' => 'Provide a note ID in the URL.']);
                    return;
                }
                $this->updateNote($resourceId);
                return;
            case 'DELETE':
                if ($resourceId === null) {
                    $this->respond(400, false, 'Note ID is required.', null, ['id' => 'Provide a note ID in the URL.']);
                    return;
                }
                $this->deleteNote($resourceId);
                return;
            default:
                $this->respond(405, false, 'Method not allowed.', null, ['method' => 'Unsupported HTTP method.']);
                return;
        }
    }

    /**
     * List all notes.
     */
    private function listNotes()
    {
        $store = $this->readNotesStore();
        $this->respond(200, true, 'Notes retrieved.', $store['items'], [], [
            'total' => count($store['items']),
        ]);
    }

    /**
     * Show a single note.
     */
    private function showNote($resourceId)
    {
        $id = (int) $resourceId;
        if ($id <= 0) {
            $this->respond(400, false, 'Invalid note ID.', null, ['id' => 'Note ID must be a positive integer.']);
            return;
        }

        $store = $this->readNotesStore();
        foreach ($store['items'] as $note) {
            if ((int) $note['id'] === $id) {
                $this->respond(200, true, 'Note retrieved.', $note);
                return;
            }
        }

        $this->respond(404, false, 'Note not found.', null, ['id' => 'No note matches this ID.']);
    }

    /**
     * Create a new note.
     */
    private function createNote()
    {
        $payload = $this->getRequestPayload();
        if ($payload === null) {
            return;
        }

        $errors = $this->validateNotePayload($payload, false);
        if (!empty($errors)) {
            $this->respond(422, false, 'Validation failed.', null, $errors);
            return;
        }

        $store = $this->readNotesStore();
        $note = [
            'id' => $store['next_id'],
            'title' => $this->sanitizeText($payload['title']),
            'body' => $this->sanitizeText($payload['body']),
            'created_at' => gmdate('c'),
            'updated_at' => gmdate('c'),
        ];

        $store['items'][] = $note;
        $store['next_id']++;

        if (!$this->writeNotesStore($store)) {
            $this->respond(500, false, 'Unable to save note.', null, ['storage' => 'Write failed.']);
            return;
        }

        $this->respond(201, true, 'Note created.', $note);
    }

    /**
     * Update an existing note.
     */
    private function updateNote($resourceId)
    {
        $id = (int) $resourceId;
        if ($id <= 0) {
            $this->respond(400, false, 'Invalid note ID.', null, ['id' => 'Note ID must be a positive integer.']);
            return;
        }

        $payload = $this->getRequestPayload();
        if ($payload === null) {
            return;
        }

        $errors = $this->validateNotePayload($payload, true);
        if (!empty($errors)) {
            $this->respond(422, false, 'Validation failed.', null, $errors);
            return;
        }

        $store = $this->readNotesStore();
        foreach ($store['items'] as $index => $note) {
            if ((int) $note['id'] === $id) {
                if (isset($payload['title'])) {
                    $note['title'] = $this->sanitizeText($payload['title']);
                }
                if (isset($payload['body'])) {
                    $note['body'] = $this->sanitizeText($payload['body']);
                }
                $note['updated_at'] = gmdate('c');
                $store['items'][$index] = $note;

                if (!$this->writeNotesStore($store)) {
                    $this->respond(500, false, 'Unable to update note.', null, ['storage' => 'Write failed.']);
                    return;
                }

                $this->respond(200, true, 'Note updated.', $note);
                return;
            }
        }

        $this->respond(404, false, 'Note not found.', null, ['id' => 'No note matches this ID.']);
    }

    /**
     * Delete a note.
     */
    private function deleteNote($resourceId)
    {
        $id = (int) $resourceId;
        if ($id <= 0) {
            $this->respond(400, false, 'Invalid note ID.', null, ['id' => 'Note ID must be a positive integer.']);
            return;
        }

        $store = $this->readNotesStore();
        foreach ($store['items'] as $index => $note) {
            if ((int) $note['id'] === $id) {
                array_splice($store['items'], $index, 1);
                if (!$this->writeNotesStore($store)) {
                    $this->respond(500, false, 'Unable to delete note.', null, ['storage' => 'Write failed.']);
                    return;
                }

                $this->respond(200, true, 'Note deleted.', ['id' => $id]);
                return;
            }
        }

        $this->respond(404, false, 'Note not found.', null, ['id' => 'No note matches this ID.']);
    }

    /**
     * Validate note payload for required fields and size constraints.
     */
    private function validateNotePayload(array $payload, $isUpdate)
    {
        $errors = [];
        $title = isset($payload['title']) ? trim((string) $payload['title']) : null;
        $body = isset($payload['body']) ? trim((string) $payload['body']) : null;

        if (!$isUpdate || $title !== null) {
            if ($title === null || $title === '') {
                $errors['title'] = 'Title is required.';
            } elseif (mb_strlen($title) > 120) {
                $errors['title'] = 'Title must be 120 characters or fewer.';
            }
        }

        if (!$isUpdate || $body !== null) {
            if ($body === null || $body === '') {
                $errors['body'] = 'Body is required.';
            } elseif (mb_strlen($body) > 2000) {
                $errors['body'] = 'Body must be 2000 characters or fewer.';
            }
        }

        return $errors;
    }

    /**
     * Parse JSON or form payloads with validation.
     */
    private function getRequestPayload()
    {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $payload = null;

        if (stripos($contentType, 'application/json') !== false) {
            $raw = file_get_contents('php://input');
            $payload = json_decode($raw, true);
            if ($payload === null && json_last_error() !== JSON_ERROR_NONE) {
                $apic = new JX_API(400, false, 'Invalid JSON payload.', null, ['payload' => json_last_error_msg()]);
                $apic->Respond();
                return null;
            }
        } else {
            $payload = $_POST;
        }

        if (!is_array($payload)) {
            $this->respond(400, false, 'Invalid payload.', null, ['payload' => 'Payload must be an object.']);
            return null;
        }

        return $payload;
    }

    /**
     * Respond with a consistent JSON envelope.
     */
    private function respond($status, $success, $message, $data = null, $errors = [], $meta = [])
    {
        http_response_code($status);
        header('Content-Type: application/json');

        echo json_encode([
            'success' => (bool) $success,
            'message' => $message,
            'data' => $data,
            'errors' => $errors,
            'meta' => $meta,
        ]);
    }

    /**
     * Read API keys from .env.
     */
    private function getConfiguredApiKeys()
    {
        $raw = trim((string) $this->env('API_KEYS', ''));
        if ($raw === '') {
            return [];
        }
        $keys = array_filter(array_map('trim', explode(',', $raw)));
        return array_values($keys);
    }

    /**
     * Extract API key from the request headers or query string.
     */
    private function getApiKeyFromRequest()
    {
        $headers = function_exists('getallheaders') ? getallheaders() : [];
        $auth = $headers['Authorization'] ?? ($_SERVER['HTTP_AUTHORIZATION'] ?? $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] ?? null);

        if ($auth && stripos($auth, 'Bearer ') === 0) {
            return trim(substr($auth, 7));
        }

        $apiKey = $headers['X-API-Key'] ?? ($_SERVER['HTTP_X_API_KEY'] ?? null);
        if ($apiKey) {
            return trim($apiKey);
        }

        $apiKey = $_GET['api_key'] ?? null;
        if ($apiKey) {
            return trim($apiKey);
        }

        return null;
    }

    /**
     * Apply CORS headers based on .env allowlist.
     */
    private function applyCorsHeaders()
    {
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        $allowed = $this->getAllowedOrigins();

        if (in_array('*', $allowed, true)) {
            header('Access-Control-Allow-Origin: *');
        } elseif ($origin && in_array($origin, $allowed, true)) {
            header('Access-Control-Allow-Origin: ' . $origin);
            header('Vary: Origin');
        }

        header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-API-Key');
    }

    /**
     * Handle CORS preflight requests.
     */
    private function handleCorsPreflight()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD'] ?? '') !== 'OPTIONS') {
            return false;
        }
        http_response_code(204);
        return true;
    }

    /**
     * Enforce a simple per-key rate limit.
     */
    private function checkRateLimit($apiKey)
    {
        $limit = (int) $this->env('API_RATE_LIMIT', 60);
        $window = (int) $this->env('API_RATE_WINDOW', 60);
        if ($limit <= 0 || $window <= 0) {
            return true;
        }

        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $bucketKey = hash('sha256', $apiKey . '|' . $ip);
        $path = $this->rateLimitPath();
        $data = $this->readJsonFile($path, []);
        $now = time();

        if (!isset($data[$bucketKey]) || ($now - $data[$bucketKey]['start']) >= $window) {
            $data[$bucketKey] = ['start' => $now, 'count' => 1];
        } else {
            $data[$bucketKey]['count']++;
        }

        $allowed = $data[$bucketKey]['count'] <= $limit;
        $this->writeJsonFile($path, $data);

        return $allowed;
    }

    /**
     * Read notes from storage.
     */
    private function readNotesStore()
    {
        $path = $this->notesPath();
        $data = $this->readJsonFile($path, [
            'next_id' => 1,
            'items' => [],
        ]);

        if (!isset($data['next_id']) || !isset($data['items'])) {
            $data = ['next_id' => 1, 'items' => []];
        }

        return $data;
    }

    /**
     * Write notes to storage.
     */
    private function writeNotesStore(array $store)
    {
        return $this->writeJsonFile($this->notesPath(), $store);
    }

    /**
     * Read JSON data from a file.
     */
    private function readJsonFile($path, $default)
    {
        if (!file_exists($path)) {
            return $default;
        }

        $contents = file_get_contents($path);
        if ($contents === false) {
            return $default;
        }

        $data = json_decode($contents, true);
        if (!is_array($data)) {
            return $default;
        }

        return $data;
    }

    /**
     * Write JSON data to a file safely.
     */
    private function writeJsonFile($path, array $data)
    {
        $directory = dirname($path);
        if (!is_dir($directory)) {
            mkdir($directory, 0775, true);
        }

        $payload = json_encode($data, JSON_PRETTY_PRINT);
        $tempPath = $path . '.tmp';

        if (file_put_contents($tempPath, $payload, LOCK_EX) === false) {
            return false;
        }

        return rename($tempPath, $path);
    }

    /**
     * Sanitize input text for storage.
     */
    private function sanitizeText($value)
    {
        return trim(strip_tags((string) $value));
    }

    /**
     * Resolve the notes storage path.
     */
    private function notesPath()
    {
        return __DIR__ . '/../data/api_notes.json';
    }

    /**
     * Resolve the rate limit storage path.
     */
    private function rateLimitPath()
    {
        return __DIR__ . '/../data/api_rate_limit.json';
    }

    /**
     * Get allowed CORS origins from .env.
     */
    private function getAllowedOrigins()
    {
        $raw = trim((string) $this->env('API_CORS_ALLOWLIST', ''));
        if ($raw === '') {
            return [];
        }
        if ($raw === '*') {
            return ['*'];
        }
        return array_values(array_filter(array_map('trim', explode(',', $raw))));
    }

    /**
     * Read an environment value from .env.
     */
    private function env($key, $default = '')
    {
        static $env = null;
        if ($env === null) {
            $env = parse_ini_file('.env');
        }

        if (isset($env[$key]) && $env[$key] !== '') {
            return $env[$key];
        }

        return $default;
    }
}

// UI interface to manage User API operations, such as creating the API key, etc.
class apiservice extends JX_Serivce implements JX_service
{
    public function __construct()
    {
        $this->setTitle('API Management');
    }

    public function main()
    {
        include 'containers/api/manage.php';
    }
}
