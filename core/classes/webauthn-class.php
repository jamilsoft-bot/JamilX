<?php

class JX_WebAuthn
{
    public static function b64urlEncode($data)
    {
        return rtrim(strtr(base64_encode((string) $data), '+/', '-_'), '=');
    }

    public static function b64urlDecode($data)
    {
        $data = (string) $data;
        $remainder = strlen($data) % 4;
        if ($remainder) {
            $data .= str_repeat('=', 4 - $remainder);
        }

        return base64_decode(strtr($data, '-_', '+/'));
    }

    public static function randomChallenge($bytes = 32)
    {
        return self::b64urlEncode(random_bytes((int) $bytes));
    }

    public static function json($payload, $status = 200)
    {
        if (!headers_sent()) {
            http_response_code((int) $status);
            header('Content-Type: application/json; charset=utf-8');
        }

        echo json_encode($payload);
        return null;
    }

    public static function getJsonBody()
    {
        $raw = file_get_contents('php://input');
        if (!$raw) {
            return [];
        }

        $decoded = json_decode($raw, true);
        return is_array($decoded) ? $decoded : [];
    }

    public static function rpId()
    {
        $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
        return preg_replace('/:\\d+$/', '', $host);
    }

    public static function origin()
    {
        $https = isset($_SERVER['HTTPS']) ? $_SERVER['HTTPS'] : '';
        $scheme = (!empty($https) && strtolower($https) !== 'off') ? 'https' : 'http';
        $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';

        return $scheme . '://' . $host;
    }
}
