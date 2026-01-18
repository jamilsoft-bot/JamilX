<?php
/**
 * Verifies runtime requirements and configuration health.
 */
class JX_CommandDoctor extends JX_ConsoleCommand
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'doctor';
        $this->description = 'Check requirements, permissions, and database connectivity.';
        $this->usage = 'jamilx doctor';
        $this->examples = ['jamilx doctor'];
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
        $checks = [];
        $checks[] = $this->checkPhpVersion();
        $checks[] = $this->checkEnvFile($app);
        $checks[] = $this->checkWritable($app, 'logs');
        $checks[] = $this->checkWritable($app, 'data');
        $checks[] = $this->checkDatabase($app);

        $table = new JX_ConsoleTable($output);
        $rows = [];
        $hasFailures = false;

        foreach ($checks as $check) {
            $rows[] = [$check['label'], $check['status'], $check['details']];
            if ($check['status'] === 'FAIL') {
                $hasFailures = true;
            }
        }

        $table->render(['Check', 'Status', 'Details'], $rows);

        if ($hasFailures) {
            $output->warning('Some checks failed. Review the details above.');
            return 1;
        }

        $output->success('All checks passed.');
        return 0;
    }

    /**
     * Checks the PHP version requirement.
     *
     * @return array
     */
    private function checkPhpVersion()
    {
        $required = '7.4.0';
        $ok = version_compare(PHP_VERSION, $required, '>=');
        return [
            'label' => 'PHP Version',
            'status' => $ok ? 'OK' : 'FAIL',
            'details' => PHP_VERSION . ' (required >= ' . $required . ')',
        ];
    }

    /**
     * Checks for .env presence.
     *
     * @param JX_ConsoleApplication $app Application instance.
     * @return array
     */
    private function checkEnvFile(JX_ConsoleApplication $app)
    {
        $path = $app->rootPath() . '/.env';
        $exists = is_file($path);
        return [
            'label' => '.env file',
            'status' => $exists ? 'OK' : 'WARN',
            'details' => $exists ? 'Found at ' . $path : 'Missing - create for environment settings.',
        ];
    }

    /**
     * Checks if a directory is writable.
     *
     * @param JX_ConsoleApplication $app Application instance.
     * @param string $dir Directory name.
     * @return array
     */
    private function checkWritable(JX_ConsoleApplication $app, $dir)
    {
        $path = $app->rootPath() . '/' . $dir;
        if (!is_dir($path)) {
            return [
                'label' => $dir . ' writable',
                'status' => 'WARN',
                'details' => 'Directory not found.',
            ];
        }
        $writable = is_writable($path);
        return [
            'label' => $dir . ' writable',
            'status' => $writable ? 'OK' : 'FAIL',
            'details' => $writable ? 'Writable' : 'Not writable',
        ];
    }

    /**
     * Checks database connectivity when configuration is available.
     *
     * @param JX_ConsoleApplication $app Application instance.
     * @return array
     */
    private function checkDatabase(JX_ConsoleApplication $app)
    {
        $env = $app->environment()->all();
        $requiredKeys = ['DB_HOST', 'DB_USER', 'DB_PASS', 'DB_NAME'];
        foreach ($requiredKeys as $key) {
            if (!isset($env[$key]) || $env[$key] === '') {
                return [
                    'label' => 'Database',
                    'status' => 'WARN',
                    'details' => 'Missing database configuration in .env.',
                ];
            }
        }

        $db = @new mysqli($env['DB_HOST'], $env['DB_USER'], $env['DB_PASS'], $env['DB_NAME']);
        if ($db->connect_error) {
            return [
                'label' => 'Database',
                'status' => 'FAIL',
                'details' => 'Connection failed: ' . $db->connect_error,
            ];
        }
        $db->close();
        return [
            'label' => 'Database',
            'status' => 'OK',
            'details' => 'Connection successful.',
        ];
    }
}
