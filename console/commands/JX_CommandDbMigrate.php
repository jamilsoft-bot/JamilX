<?php
/**
 * Runs pending database migrations.
 */
class JX_CommandDbMigrate extends JX_ConsoleCommand
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'db:migrate';
        $this->description = 'Run pending database migrations.';
        $this->usage = 'jamilx db:migrate [--path <path>]';
        $this->examples = ['jamilx db:migrate'];
        $this->category = 'Database';
        $this->addOption('path', 'p', true, 'Override migrations path.', null);
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
        $migrationPath = $input['options']['path'] ?: $app->rootPath() . '/database/migrations';

        if (!is_dir($migrationPath)) {
            throw new JX_ConsoleException('Migrations directory not found: ' . $migrationPath, 2);
        }

        $executed = $dbManager->executedMigrations($db);
        $files = glob($migrationPath . '/*.php');
        sort($files);

        $pending = [];
        foreach ($files as $file) {
            $name = basename($file);
            if (!isset($executed[$name])) {
                $pending[] = $file;
            }
        }

        if (!$pending) {
            $output->success('No pending migrations.');
            return 0;
        }

        $batch = empty($executed) ? 1 : (max($executed) + 1);
        $progress = new JX_ConsoleProgress($output);
        $progress->start('Running migrations');

        foreach ($pending as $file) {
            $migrationName = basename($file);
            $definition = $this->loadMigration($file);
            $statements = $this->normalizeStatements($definition['up']);
            foreach ($statements as $statement) {
                if (!$db->query($statement)) {
                    $progress->finish('Migration failed');
                    throw new JX_ConsoleException('Migration failed: ' . $migrationName . ' (' . $db->error . ')', 1);
                }
            }
            $dbManager->recordMigration($db, $migrationName, $batch);
            $progress->tick();
        }

        $progress->finish('Migrations completed');
        return 0;
    }

    /**
     * Loads a migration file definition.
     *
     * @param string $file Migration file path.
     * @return array
     */
    private function loadMigration($file)
    {
        $definition = include $file;
        if (!is_array($definition) || !isset($definition['up'], $definition['down'])) {
            throw new JX_ConsoleException('Invalid migration file: ' . basename($file), 2);
        }
        return $definition;
    }

    /**
     * Normalizes migration SQL statements to an array.
     *
     * @param mixed $statements SQL string or array.
     * @return array
     */
    private function normalizeStatements($statements)
    {
        if (is_array($statements)) {
            return $statements;
        }
        if (is_string($statements) && trim($statements) !== '') {
            return [$statements];
        }
        return [];
    } 
}
