<?php

/**
 * API keys management action.
 */
class apikeys extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('API Keys');
        $this->setText('');
    }

    public function getAction()
    {
        $maskedKeys = $this->maskKeys($this->getConfiguredApiKeys());
        $generatedKey = null;

        if (isset($_POST['generate_key'])) {
            $generatedKey = $this->generateKey();
        }

        include 'containers/api/keys.php';
    }

    /**
     * Read API keys from .env for display.
     */
    private function getConfiguredApiKeys()
    {
        $env = parse_ini_file('.env');
        $raw = isset($env['API_KEYS']) ? trim((string) $env['API_KEYS']) : '';
        if ($raw === '') {
            return [];
        }
        return array_values(array_filter(array_map('trim', explode(',', $raw))));
    }

    /**
     * Mask API keys for UI display.
     */
    private function maskKeys(array $keys)
    {
        $masked = [];
        foreach ($keys as $key) {
            $length = strlen($key);
            if ($length <= 8) {
                $masked[] = str_repeat('*', $length);
                continue;
            }
            $masked[] = substr($key, 0, 4) . str_repeat('*', $length - 8) . substr($key, -4);
        }
        return $masked;
    }

    /**
     * Generate a secure random API key.
     */
    private function generateKey()
    {
        return bin2hex(random_bytes(24));
    }
}
