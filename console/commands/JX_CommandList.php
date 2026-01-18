<?php
/**
 * Lists all available CLI commands grouped by category.
 */
class JX_CommandList extends JX_ConsoleCommand
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'list';
        $this->description = 'List available commands.';
        $this->usage = 'jamilx list';
        $this->examples = ['jamilx list'];
        $this->category = 'General';
    }

    /**
     * @param array $input Parsed input.
     * @param JX_ConsoleOutput $output Output helper.
     * @param JX_ConsoleApplication $app Application instance.
     * @return int
     */
    public function execute(array $input, JX_ConsoleOutput $output, JX_ConsoleApplication $app)
    {
        $commands = $app->allCommands();
        $grouped = [];

        foreach ($commands as $command) {
            $grouped[$command->getCategory()][] = $command;
        }

        ksort($grouped);
        $output->writeln('Jamilx CLI Commands', 'bold');
        $output->writeln('');

        foreach ($grouped as $category => $items) {
            $output->writeln($category . ':', 'info');
            foreach ($items as $command) {
                $output->writeln(sprintf('  %-20s %s', $command->getName(), $command->getDescription()));
            }
            $output->writeln('');
        }
        $output->writeln('Use "jamilx help <command>" for command details.', 'muted');
        return 0;
    }
}
