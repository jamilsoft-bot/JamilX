<?php
/**
 * Generates zsh completion script for Jamilx CLI.
 */
class JX_CommandCompletionZsh extends JX_ConsoleCommand
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'completion:zsh';
        $this->description = 'Generate zsh completion script.';
        $this->usage = 'jamilx completion:zsh';
        $this->examples = ['jamilx completion:zsh > _jamilx'];
        $this->category = 'Development';
    }

    /**
     * @param array $input Parsed input.
     * @param JX_ConsoleOutput $output Output helper.
     * @param JX_ConsoleApplication $app Application instance.
     * @return int
     */
    public function execute(array $input, JX_ConsoleOutput $output, JX_ConsoleApplication $app)
    {
        $commands = array_keys($app->allCommands());
        sort($commands);
        $list = implode(' ', $commands);

        $script = <<<SCRIPT
#compdef jamilx
_arguments "1: :(${list})"
SCRIPT;

        $output->writeln($script);
        return 0;
    }
}
