<?php
/**
 * Stores and resolves CLI commands by name and alias.
 */
class JX_ConsoleCommandRegistry
{
    /**
     * @var array
     */
    private $commands = [];

    /**
     * @var array
     */
    private $aliases = [];

    /**
     * Registers a command instance.
     *
     * @param JX_ConsoleCommand $command Command to register.
     * @return void
     */
    public function register(JX_ConsoleCommand $command)
    {
        $this->commands[$command->getName()] = $command;
        foreach ($command->getAliases() as $alias) {
            $this->aliases[$alias] = $command->getName();
        }
    }

    /**
     * Returns a command by name or alias.
     *
     * @param string $name Command name.
     * @return JX_ConsoleCommand|null
     */
    public function get($name)
    {
        $key = isset($this->aliases[$name]) ? $this->aliases[$name] : $name;
        return isset($this->commands[$key]) ? $this->commands[$key] : null;
    }

    /**
     * Returns all registered commands.
     *
     * @return array
     */
    public function all()
    {
        return $this->commands;
    }
}
