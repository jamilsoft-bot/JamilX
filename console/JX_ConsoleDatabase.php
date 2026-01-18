<?php
/**
 * Provides database connectivity and migration utilities for CLI.
 */
class JX_ConsoleDatabase
{
    /**
     * @var array
     */
    private $config;

    /**
     * @param array $config Database configuration from .env.
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Opens a mysqli connection.
     *
     * @return mysqli
     * @throws JX_ConsoleException When configuration is missing or connection fails.
     */
    public function connect()
    {
        $required = ['DB_HOST', 'DB_USER', 'DB_PASS', 'DB_NAME'];
        foreach ($required as $key) {
            if (!isset($this->config[$key]) || $this->config[$key] === '') {
                throw new JX_ConsoleException('Database configuration missing: ' . $key, 2);
            }
        }

        $db = @new mysqli(
            $this->config['DB_HOST'],
            $this->config['DB_USER'],
            $this->config['DB_PASS'],
            $this->config['DB_NAME']
        );

        if ($db->connect_error) {
            throw new JX_ConsoleException('Database connection failed: ' . $db->connect_error, 2);
        }

        return $db;
    }

    /**
     * Ensures the migrations table exists.
     *
     * @param mysqli $db Database connection.
     * @return void
     */
    public function ensureMigrationsTable(mysqli $db)
    {
        $sql = "CREATE TABLE IF NOT EXISTS jx_migrations (" .
            "id INT AUTO_INCREMENT PRIMARY KEY," .
            "migration VARCHAR(255) NOT NULL," .
            "batch INT NOT NULL," .
            "ran_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP" .
            ")";
        $db->query($sql);
    }

    /**
     * Returns the list of executed migrations.
     *
     * @param mysqli $db Database connection.
     * @return array
     */
    public function executedMigrations(mysqli $db)
    {
        $this->ensureMigrationsTable($db);
        $result = $db->query('SELECT migration, batch FROM jx_migrations ORDER BY id ASC');
        $migrations = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $migrations[$row['migration']] = (int) $row['batch'];
            }
        }
        return $migrations;
    }

    /**
     * Records a migration run.
     *
     * @param mysqli $db Database connection.
     * @param string $migration Migration name.
     * @param int $batch Batch number.
     * @return void
     */
    public function recordMigration(mysqli $db, $migration, $batch)
    {
        $stmt = $db->prepare('INSERT INTO jx_migrations (migration, batch) VALUES (?, ?)');
        if ($stmt) {
            $stmt->bind_param('si', $migration, $batch);
            $stmt->execute();
            $stmt->close();
        }
    }

    /**
     * Removes migration entries for a batch.
     *
     * @param mysqli $db Database connection.
     * @param int $batch Batch number.
     * @return void
     */
    public function removeBatch(mysqli $db, $batch)
    {
        $stmt = $db->prepare('DELETE FROM jx_migrations WHERE batch = ?');
        if ($stmt) {
            $stmt->bind_param('i', $batch);
            $stmt->execute();
            $stmt->close();
        }
    }
}
