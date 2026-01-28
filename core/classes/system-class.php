<?php
declare(strict_types=1);

final class JX_System
{
    /**
     * Returns the current URI (path + query), e.g. "/dashboard?page=2".
     * This is usually the closest to what appears after the domain in the address bar.
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
     * Handles HTTPS and common reverse proxy header (X-Forwarded-Proto).
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
     * Backward-compatible with your original method name/intent:
     * returns script path + query string (relative URL).
     *
     * NOTE: Uses REQUEST_URI for accuracy, but keeps the same goal.
     */
    public function get_cur_url(): string
    {
        return $this->getCurrentUri();
    }

    private function getScheme(): string
    {
        // Reverse proxy support (optional but common)
        $forwardedProto = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '';
        if ($forwardedProto !== '') {
            // Can be "https" or "http", or "https,http" - take the first
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
        // Prefer HTTP_HOST; fallback to SERVER_NAME
        $host = $_SERVER['HTTP_HOST'] ?? ($_SERVER['SERVER_NAME'] ?? 'localhost');

        // HTTP_HOST might include port; strip it (we handle port separately)
        // Also remove any illegal characters to be safe.
        $host = preg_replace('/:\d+$/', '', $host);
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

class JS_System{

    public function get_cur_url()
    {
        //return $_SERVER['PHP_SELF']	;
        return $_SERVER['PHP_SELF']."?". $_SERVER['QUERY_STRING'];
        
    }
}





