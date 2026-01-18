<?php
/**
 * Displays migration status for the database.
 */
class JX_CommandDbStatus extends JX_ConsoleCommand
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'db:status';
        $this->description = 'Show database migration status.';
        $this->usage = 'jamilx db:status';
        $this->examples = ['jamilx db:status'];
        $this->category = 'Database';
    }

    /**
     * @param array $input Parsed input.
     * @param JX_ConsoleOutput $output Output helper.
     * @param JX_ConsoleApplication $app Application instance.
     * @return int
     */
    public function execute(array $input, JX_ConsoleOutput $output, JX_ConsoleApplication $app)
    {
        $db = (new JX_ConsoleDatabase($app->environment()->all()))->connect();
        $migrationPath = $app->rootPath() . '/database/migrations';
        if (!is_dir($migrationPath)) {
            $output->warning('No migrations directory found at database/migrations.');
            return 0;
        }

        $executed = (new JX_ConsoleDatabase($app->environment()->all()))->executedMigrations($db);
        $files = glob($migrationPath . '/*.php');
        sort($files);

        $rows = [];
        foreach ($files as $file) {
            $name = basename($file);
            $status = isset($executed[$name]) ? 'Ran (batch ' . $executed[$name] . ')' : 'Pending';
            $rows[] = [$name, $status];
        }

        $table = new JX_ConsoleTable($output);
        $table->render(['Migration', 'Status'], $rows);
        return 0;
    }
}
