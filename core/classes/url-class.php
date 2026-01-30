<?php
declare(strict_types=1);

final class JX_URL
{
    private ?string $_serve;
    private ?string $_action;

    public function __construct()
    {
        $serve = $_GET['serve'] ?? ($_GET['route'] ?? null);
        $action = $_GET['action'] ?? null;

        $this->_serve  = $this->normalizeServe($serve);
        $this->_action = $this->normalizeAction($action);
    }

    /**
     * Split the service/route into path segments.
     * Example: "admin/users/list" => ["admin","users","list"]
     */
    public function get_paths(): array
    {
        if ($this->_serve === null || $this->_serve === '') {
            return [];
        }

        // Split by "/" and remove empty parts (handles // or leading/trailing /)
        $parts = preg_split('~/+~', $this->_serve) ?: [];
        return array_values(array_filter($parts, static fn($p) => $p !== ''));
    }

    /**
     * Returns the raw service string, e.g. "admin/users".
     */
    public function get_service(): ?string
    {
        return $this->_serve;
    }

    /**
     * Returns a specific segment by index (0-based). Null if missing.
     */
    public function segment(int $index): ?string
    {
        $paths = $this->get_paths();
        return $paths[$index] ?? null;
    }

    /**
     * Accept HTTP POST provided by HTML Form
     * @param string $name input name of the form
     */
    public function post(string $name): mixed
    {
        return $_POST[$name] ?? null;
    }

    public function get(string $key): mixed
    {
        return $_GET[$key] ?? null;
    }

    public function get_action(): ?string
    {
        return $this->_action;
    }

    public function isPost(): bool
    {
        return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
    }

    public function isGet(): bool
    {
        return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'GET';
    }

    /**
     * -----------------------------
     * URL helpers (blended from JX_System)
     * -----------------------------
     */

    /**
     * Returns the current URI (path + query), e.g. "/dashboard?page=2".
     */
    public function getCurrentUri(): string
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '';

        // Fallback if REQUEST_URI is unavailable
        if ($uri === '') {
            $path  = $_SERVER['SCRIPT_NAME'] ?? ($_SERVER['PHP_SELF'] ?? '');
            $query = $_SERVER['QUERY_STRING'] ?? '';
            return $query !== '' ? ($path . '?' . $query) : $path;
        }

        return $uri;
    }

    /**
     * Returns only the current path (no query), e.g. "/dashboard".
     */
    public function getCurrentPath(): string
    {
        $uri = $this->getCurrentUri();
        $qPos = strpos($uri, '?');
        return $qPos === false ? $uri : substr($uri, 0, $qPos);
    }

    /**
     * Returns the full current URL, e.g. "https://example.com/dashboard?page=2".
     */
    public function getCurrentUrl(): string
    {
        $scheme = $this->getScheme();
        $host   = $this->getHost();
        $port   = $this->getPort();

        $defaultPort = ($scheme === 'https') ? 443 : 80;
        $portPart = ($port !== null && $port !== $defaultPort) ? (':' . $port) : '';

        return $scheme . '://' . $host . $portPart . $this->getCurrentUri();
    }

    /**
     * Backward-compatible method name with your earlier snippet.
     * Returns path + query string (relative URL).
     */
    public function get_cur_url(): string
    {
        return $this->getCurrentUri();
    }

    /**
     * Debug helper.
     */
    public function help(): void
    {
        echo "<p> Service: <b>" . htmlspecialchars((string)$this->_serve, ENT_QUOTES, 'UTF-8') . "</b></p>";
        echo "<p> Action: <b>" . htmlspecialchars((string)$this->_action, ENT_QUOTES, 'UTF-8') . "</b></p>";
        echo "<p> Current URI: <b>" . htmlspecialchars($this->getCurrentUri(), ENT_QUOTES, 'UTF-8') . "</b></p>";
        echo "<p> Current URL: <b>" . htmlspecialchars($this->getCurrentUrl(), ENT_QUOTES, 'UTF-8') . "</b></p>";
    }

    /**
     * -----------------------------
     * Internal helpers
     * -----------------------------
     */

    private function normalizeServe(?string $serve): ?string
    {
        if ($serve === null) return null;

        $serve = trim($serve);

        if ($serve === '') return null;

        // Normalize backslashes and repeated slashes
        $serve = str_replace('\\', '/', $serve);
        $serve = preg_replace('~/+~', '/', $serve) ?? $serve;

        // Remove leading/trailing slashes
        $serve = trim($serve, '/');

        return $serve === '' ? null : $serve;
    }

    private function normalizeAction(?string $action): ?string
    {
        if ($action === null) return null;

        $action = trim($action);
        return $action === '' ? null : $action;
    }

    private function getScheme(): string
    {
        // Reverse proxy support
        $forwardedProto = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '';
        if ($forwardedProto !== '') {
            $proto = strtolower(trim(explode(',', $forwardedProto)[0]));
            if ($proto === 'https' || $proto === 'http') {
                return $proto;
            }
        }

        $https = $_SERVER['HTTPS'] ?? '';
        if ($https !== '' && strtolower($https) !== 'off') {
            return 'https';
        }

        return 'http';
    }

    private function getHost(): string
    {
        $host = $_SERVER['HTTP_HOST'] ?? ($_SERVER['SERVER_NAME'] ?? 'localhost');

        // Strip port if included
        $host = preg_replace('/:\d+$/', '', $host);
        // Basic sanitization
        $host = preg_replace('/[^a-z0-9.\-]/i', '', (string)$host);

        return $host !== '' ? $host : 'localhost';
    }

    private function getPort(): ?int
    {
        $port = $_SERVER['SERVER_PORT'] ?? null;
        if ($port === null) return null;

        $portInt = (int)$port;
        return ($portInt > 0) ? $portInt : null;
    }
}

class JS_URL{
    private $_serve, $_action;

    public function __construct()
    {
        $this->_serve = isset($_GET['route'])? $_GET['route']: 'index';
        $this->_action = isset($_GET['action'])? $_GET['action']: null;
       // $this->_serve = "";
    }

    public function get_paths()
    {
        return str_getcsv($this->_serve,'/');
    }

    public function get_service()
    {
        return $this->_serve;
    }

/***
 * Acept HTTP Post provided by HTML Form
 * @param $name $_POST['name'] the input name of the form
 */
    public function post($name)
    {
        $uri = isset($_POST[$name])?$_POST[$name]:null;
        return $uri;
    }

    public function get($get)
    {
        $uri = isset($_GET[$get])?$_GET[$get]:null;
        return $uri;
    }

    public function get_action()
    {
        return $this->_action;
    }

   

    public function help(){
        
        echo "<p> Service: <b>". $this->_serve . "</b></p>";
        echo "<p> action: <b>". $this->_action . "</b></p>";
        //echo "<p> method parameter: <b>". $this->_uri[2] . "</b></p>";



    }
}
