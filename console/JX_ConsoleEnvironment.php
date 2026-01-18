<?php
/**
 * Loads environment configuration for CLI commands.
 */
class JX_ConsoleEnvironment
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * Loads .env data from the project root.
     *
     * @param string $rootPath Project root path.
     * @param string|null $overrideEnv Optional environment override.
     * @return void
     */
    public function load($rootPath, $overrideEnv = null)
    {
        $envPath = rtrim($rootPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . '.env';
        if (is_file($envPath)) {
            $this->data = parse_ini_file($envPath, false, INI_SCANNER_TYPED) ?: [];
        }
        if ($overrideEnv !== null) {
            $this->data['MODE'] = $overrideEnv;
        }
        foreach ($this->data as $key => $value) {
            $_ENV[$key] = $value;
            putenv($key . '=' . $value);
        }
    }

    /**
     * Returns the loaded environment data.
     *
     * @return array
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * Returns a single environment value.
     *
     * @param string $key Key to retrieve.
     * @param mixed $default Default value when missing.
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return array_key_exists($key, $this->data) ? $this->data[$key] : $default;
    }
}
