<?php
/**
 * Rolls back the latest batch of migrations.
 */
class JX_CommandDbRollback extends JX_ConsoleCommand
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'db:rollback';
        $this->description = 'Rollback the latest migration batch.';
        $this->usage = 'jamilx db:rollback [--path <path>]';
        $this->examples = ['jamilx db:rollback'];
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
        $dbManager->ensureMigrationsTable($db);

        $batchResult = $db->query('SELECT MAX(batch) AS batch FROM jx_migrations');
        $batchRow = $batchResult ? $batchResult->fetch_assoc() : null;
        $batch = $batchRow ? (int) $batchRow['batch'] : 0;
        if ($batch === 0) {
            $output->warning('No migrations have been run.');
            return 0;
        }

        $migrationPath = $input['options']['path'] ?: $app->rootPath() . '/database/migrations';
        if (!is_dir($migrationPath)) {
            throw new JX_ConsoleException('Migrations directory not found: ' . $migrationPath, 2);
        }

        $result = $db->query('SELECT migration FROM jx_migrations WHERE batch = ' . $batch . ' ORDER BY id DESC');
        $migrations = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $migrations[] = $row['migration'];
            }
        }

        if (!$migrations) {
            $output->warning('No migrations found for the latest batch.');
            return 0;
        }

        $progress = new JX_ConsoleProgress($output);
        $progress->start('Rolling back migrations');

        foreach ($migrations as $migrationName) {
            $file = $migrationPath . '/' . $migrationName;
            if (!is_file($file)) {
                $progress->finish('Rollback failed');
                throw new JX_ConsoleException('Migration file missing: ' . $migrationName, 2);
            }
            $definition = $this->loadMigration($file);
            $statements = $this->normalizeStatements($definition['down']);
            foreach ($statements as $statement) {
                if (!$db->query($statement)) {
                    $progress->finish('Rollback failed');
                    throw new JX_ConsoleException('Rollback failed: ' . $migrationName . ' (' . $db->error . ')', 1);
                }
            }
            $progress->tick();
        }

        $dbManager->removeBatch($db, $batch);
        $progress->finish('Rollback complete');
        return 0;
    }

    /**
     * Loads a migration definition.
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
