<?php
/**
 * Streams framework log output.
 */
class JX_CommandLogsTail extends JX_ConsoleCommand
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'logs:tail';
        $this->description = 'Tail the framework log file.';
        $this->usage = 'jamilx logs:tail [--lines <count>] [--follow]';
        $this->examples = ['jamilx logs:tail', 'jamilx logs:tail --follow'];
        $this->category = 'Development';
        $this->addOption('lines', 'n', true, 'Number of lines to show.', 50);
        $this->addOption('follow', 'f', false, 'Continue streaming new log lines.', false);
    }

    /**
     * @param array $input Parsed input.
     * @param JX_ConsoleOutput $output Output helper.
     * @param JX_ConsoleApplication $app Application instance.
     * @return int
     */
    public function execute(array $input, JX_ConsoleOutput $output, JX_ConsoleApplication $app)
    {
        $logPath = $app->rootPath() . '/logs/errors.log';
        if (!is_file($logPath)) {
            throw new JX_ConsoleException('Log file not found: ' . $logPath, 2);
        }

        $lines = max(1, (int) $input['options']['lines']);
        $output->writeln('Tailing ' . $logPath);
        $output->writeln('');

        $this->outputLastLines($logPath, $lines, $output);

        if ($input['options']['follow']) {
            $this->followFile($logPath, $output);
        }

        return 0;
    }

    /**
     * Outputs the last N lines of a file.
     *
     * @param string $path File path.
     * @param int $lines Number of lines.
     * @param JX_ConsoleOutput $output Output helper.
     * @return void
     */
    private function outputLastLines($path, $lines, JX_ConsoleOutput $output)
    {
        $data = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $slice = array_slice($data, -$lines);
        foreach ($slice as $line) {
            $output->writeln($line);
        }
    }

    /**
     * Continuously outputs new log lines.
     *
     * @param string $path File path.
     * @param JX_ConsoleOutput $output Output helper.
     * @return void
     */
    private function followFile($path, JX_ConsoleOutput $output)
    {
        $fp = fopen($path, 'r');
        if (!$fp) {
            throw new JX_ConsoleException('Unable to open log file for reading.', 2);
        }
        fseek($fp, 0, SEEK_END);
        while (true) {
            $line = fgets($fp);
            if ($line !== false) {
                $output->writeln(rtrim($line));
            } else {
                clearstatcache();
                usleep(500000);
            }
        }
    }
}
