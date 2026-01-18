<?php
/**
 * Generates bash completion script for Jamilx CLI.
 */
class JX_CommandCompletionBash extends JX_ConsoleCommand
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'completion:bash';
        $this->description = 'Generate bash completion script.';
        $this->usage = 'jamilx completion:bash';
        $this->examples = ['jamilx completion:bash > jamilx.bash'];
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
_jamilx_complete() {
  local cur="${COMP_WORDS[COMP_CWORD]}"
  local commands="{$list}"
  COMPREPLY=( $(compgen -W "${commands}" -- "$cur") )
}
complete -F _jamilx_complete jamilx
SCRIPT;

        $output->writeln($script);
        return 0;
    }
}
