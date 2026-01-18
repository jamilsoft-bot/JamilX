<?php
/**
 * Runs database seeders.
 */
class JX_CommandDbSeed extends JX_ConsoleCommand
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'db:seed';
        $this->description = 'Run database seeders.';
        $this->usage = 'jamilx db:seed [--path <path>]';
        $this->examples = ['jamilx db:seed'];
        $this->category = 'Database';
        $this->addOption('path', 'p', true, 'Override seeders path.', null);
    }

    /**
     * @param array $input Parsed input.
     * @param JX_ConsoleOutput $output Output helper.
     * @param JX_ConsoleApplication $app Application instance.
     * @return int
     */
    public function execute(array $input, JX_ConsoleOutput $output, JX_ConsoleApplication $app)
    {
        $dbManager = new JX_ConsoleDatabase($app->environment()->all());
        $db = $dbManager->connect();
        $seedPath = $input['options']['path'] ?: $app->rootPath() . '/database/seeders';

        if (!is_dir($seedPath)) {
            $output->warning('Seeders directory not found: ' . $seedPath);
            return 0;
        }

        $seeders = glob($seedPath . '/*.php');
        sort($seeders);
        if (!$seeders) {
            $output->warning('No seeders found.');
            return 0;
        }

        foreach ($seeders as $file) {
            $result = include $file;
            if (is_callable($result)) {
                $result($db, $output);
                $output->success('Seeded: ' . basename($file));
                continue;
            }
            if (is_array($result)) {
                foreach ($result as $statement) {
                    if (!$db->query($statement)) {
                        throw new JX_ConsoleException('Seeder failed: ' . basename($file) . ' (' . $db->error . ')', 1);
                    }
                }
                $output->success('Seeded: ' . basename($file));
                continue;
            }
            $output->warning('Seeder skipped (invalid format): ' . basename($file));
        }

        return 0;
    }
}
