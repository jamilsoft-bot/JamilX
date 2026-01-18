<?php
/**
 * Provides help output for commands.
 */
class JX_CommandHelp extends JX_ConsoleCommand
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'help';
        $this->description = 'Display help for a command.';
        $this->usage = 'jamilx help <command>';
        $this->examples = ['jamilx help make:service', 'jamilx help db:migrate'];
        $this->category = 'General';
        $this->addArgument('command', false, 'Command name to describe.');
    }

    /**
     * @param array $input Parsed input.
     * @param JX_ConsoleOutput $output Output helper.
     * @param JX_ConsoleApplication $app Application instance.
     * @return int
     */
    public function execute(array $input, JX_ConsoleOutput $output, JX_ConsoleApplication $app)
    {
        $commandName = $input['arguments']['command'] ?? null;
        if ($commandName === null) {
            $listCommand = $app->output();
            $listCommand->info('Use "jamilx list" to see all commands.');
            return 0;
        }
        $command = $app->getCommand($commandName);
        if ($command === null) {
            throw new JX_ConsoleException('Unknown command: ' . $commandName, 2);
        }
        $app->renderCommandHelp($command);
        return 0;
    }
}
