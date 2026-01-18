<?php
/**
 * Displays framework and environment diagnostics.
 */
class JX_CommandAbout extends JX_ConsoleCommand
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'about';
        $this->description = 'Show framework and environment information.';
        $this->usage = 'jamilx about';
        $this->examples = ['jamilx about'];
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
        $version = 'unknown';
        $developer = 'unknown';
        if (class_exists('Jamilsoft')) {
            $platform = new Jamilsoft();
            $version = $platform->get_version();
            $developer = $platform->get_developer();
        }

        $env = $app->environment()->all();
        $output->writeln('Jamilx Framework', 'bold');
        $output->writeln('Version: ' . $version);
        $output->writeln('Developer: ' . $developer);
        $output->writeln('PHP: ' . PHP_VERSION);
        $output->writeln('Root: ' . $app->rootPath());
        $output->writeln('Environment: ' . ($env['MODE'] ?? 'default'));

        if (!empty($env)) {
            $output->writeln('');
            $output->writeln('Loaded .env keys:', 'info');
            $output->writeln('  ' . implode(', ', array_keys($env)));
        }

        return 0;
    }
}
