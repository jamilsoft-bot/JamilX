<?php
/**
 * Starts the built-in PHP development server.
 */
class JX_CommandServe extends JX_ConsoleCommand
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'serve';
        $this->description = 'Start the PHP development server (local only).';
        $this->usage = 'jamilx serve [--host <host>] [--port <port>]';
        $this->examples = ['jamilx serve', 'jamilx serve --port 8080'];
        $this->category = 'Development';
        $this->addOption('host', null, true, 'Host to bind.', '127.0.0.1');
        $this->addOption('port', null, true, 'Port to bind.', '8000');
    }

    /**
     * @param array $input Parsed input.
     * @param JX_ConsoleOutput $output Output helper.
     * @param JX_ConsoleApplication $app Application instance.
     * @return int
     */
    public function execute(array $input, JX_ConsoleOutput $output, JX_ConsoleApplication $app)
    {
        $host = $input['options']['host'];
        $port = $input['options']['port'];
        $router = $app->rootPath() . '/index.php';
        $docroot = $app->rootPath();

        if (!is_file($router)) {
            throw new JX_ConsoleException('index.php not found for router fallback.', 2);
        }

        $output->info('Starting server on http://' . $host . ':' . $port);
        $command = sprintf('%s -S %s:%s -t %s %s',
            escapeshellarg(PHP_BINARY),
            escapeshellarg($host),
            escapeshellarg($port),
            escapeshellarg($docroot),
            escapeshellarg($router)
        );
        passthru($command);
        return 0;
    }
}
