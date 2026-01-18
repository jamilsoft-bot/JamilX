<?php
/**
 * Provides a minimal autoloader for Jamilx CLI classes.
 */
class JX_ConsoleAutoload
{
    /**
     * Registers the autoloader against the provided console root path.
     *
     * @param string $consoleRoot Path to the console directory.
     * @return void
     */
    public static function register($consoleRoot)
    {
        spl_autoload_register(function ($className) use ($consoleRoot) {
            $className = ltrim($className, '\\');
            $paths = [
                $consoleRoot . '/' . $className . '.php',
                $consoleRoot . '/commands/' . $className . '.php',
            ];
            foreach ($paths as $path) {
                if (is_file($path)) {
                    require_once $path;
                    return;
                }
            }
        });
    }
}
