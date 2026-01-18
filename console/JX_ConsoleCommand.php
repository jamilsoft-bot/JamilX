<?php
/**
 * Base class for all Jamilx CLI commands.
 */
abstract class JX_ConsoleCommand
{
    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var string
     */
    protected $usage = '';

    /**
     * @var array
     */
    protected $examples = [];

    /**
     * @var array
     */
    protected $aliases = [];

    /**
     * @var string
     */
    protected $category = 'General';

    /**
     * @var array
     */
    protected $arguments = [];

    /**
     * @var array
     */
    protected $options = [];

    /**
     * Initializes the command definition.
     */
    public function __construct()
    {
        $this->configure();
    }

    /**
     * Defines command metadata, arguments, and options.
     *
     * @return void
     */
    abstract protected function configure();

    /**
     * Executes the command logic.
     *
     * @param array $input Parsed input arguments and options.
     * @param JX_ConsoleOutput $output Output helper.
     * @param JX_ConsoleApplication $app Application instance.
     * @return int Exit code.
     */
    abstract public function execute(array $input, JX_ConsoleOutput $output, JX_ConsoleApplication $app);

    /**
     * Registers a positional argument.
     *
     * @param string $name Argument name.
     * @param bool $required Whether the argument is required.
     * @param string $description Argument description.
     * @param mixed $default Default value if not provided.
     * @return void
     */
    protected function addArgument($name, $required, $description, $default = null)
    {
        $this->arguments[] = [
            'name' => $name,
            'required' => (bool) $required,
            'description' => $description,
            'default' => $default,
        ];
    }

    /**
     * Registers a named option.
     *
     * @param string $name Long option name.
     * @param string|null $shortcut Short option.
     * @param bool $hasValue Whether the option expects a value.
     * @param string $description Option description.
     * @param mixed $default Default value.
     * @return void
     */
    protected function addOption($name, $shortcut, $hasValue, $description, $default = null)
    {
        $this->options[] = [
            'name' => $name,
            'shortcut' => $shortcut,
            'hasValue' => (bool) $hasValue,
            'description' => $description,
            'default' => $default,
        ];
    }

    /**
     * Returns the command name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns command aliases.
     *
     * @return array
     */
    public function getAliases()
    {
        return $this->aliases;
    }

    /**
     * Returns command description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns usage string.
     *
     * @return string
     */
    public function getUsage()
    {
        return $this->usage;
    }

    /**
     * Returns examples for help output.
     *
     * @return array
     */
    public function getExamples()
    {
        return $this->examples;
    }

    /**
     * Returns command category.
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Returns argument definitions.
     *
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Returns option definitions.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }
}
