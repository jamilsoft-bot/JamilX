<?php
/**
 * Clears cached files used by the framework.
 */
class JX_CommandCacheClear extends JX_ConsoleCommand
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'cache:clear';
        $this->description = 'Clear framework cache directories.';
        $this->usage = 'jamilx cache:clear';
        $this->examples = ['jamilx cache:clear'];
        $this->category = 'Project';
    }

    /**
     * @param array $input Parsed input.
     * @param JX_ConsoleOutput $output Output helper.
     * @param JX_ConsoleApplication $app Application instance.
     * @return int
     */
    public function execute(array $input, JX_ConsoleOutput $output, JX_ConsoleApplication $app)
    {
        $candidates = [
            $app->rootPath() . '/cache',
            $app->rootPath() . '/storage/cache',
            $app->rootPath() . '/data/cache',
        ];

        $cleared = 0;
        foreach ($candidates as $path) {
            if (!is_dir($path)) {
                continue;
            }
            $cleared += $this->clearDirectory($path);
        }

        if ($cleared === 0) {
            $output->warning('No cache directories found or nothing to clear.');
            return 0;
        }

        $output->success('Cleared ' . $cleared . ' cached file(s).');
        return 0;
    }

    /**
     * Removes files from a directory without deleting the directory itself.
     *
     * @param string $path Directory path.
     * @return int Number of files removed.
     */
    private function clearDirectory($path)
    {
        $count = 0;
        $items = scandir($path);
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }
            $fullPath = $path . DIRECTORY_SEPARATOR . $item;
            if (is_file($fullPath)) {
                unlink($fullPath);
                $count++;
            }
        }
        return $count;
    }
}
