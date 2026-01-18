<?php
/**
 * Provides filesystem helpers for CLI generators.
 */
class JX_ConsoleFileSystem
{
    /**
     * Ensures a directory exists.
     *
     * @param string $path Directory path.
     * @return void
     */
    public function ensureDirectory($path)
    {
        if (!is_dir($path)) {
            mkdir($path, 0775, true);
        }
    }

    /**
     * Writes a file with optional overwrite and dry-run support.
     *
     * @param string $path File path.
     * @param string $contents File contents.
     * @param bool $force Whether to overwrite.
     * @param bool $dryRun Whether to only simulate the write.
     * @return array Result data with status and message.
     */
    public function writeFile($path, $contents, $force, $dryRun)
    {
        if (file_exists($path) && !$force) {
            return ['status' => 'skipped', 'path' => $path, 'message' => 'File exists'];
        }
        if ($dryRun) {
            return ['status' => 'dry-run', 'path' => $path, 'message' => 'Dry run'];
        }
        $this->ensureDirectory(dirname($path));
        file_put_contents($path, $contents);
        return ['status' => 'created', 'path' => $path, 'message' => 'File written'];
    }
}
