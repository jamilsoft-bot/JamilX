<?php
/**
 * Coordinates command resolution, input validation, and execution.
 */
class JX_ConsoleApplication
{
    /**
     * @var string
     */
    private $rootPath;

    /**
     * @var JX_ConsoleCommandRegistry
     */
    private $registry;

    /**
     * @var JX_ConsoleOutput
     */
    private $output;

    /**
     * @var JX_ConsoleEnvironment
     */
    private $environment;

    /**
     * @param string $rootPath Project root path.
     */
    public function __construct($rootPath)
    {
        $this->rootPath = rtrim($rootPath, DIRECTORY_SEPARATOR);
        $this->registry = new JX_ConsoleCommandRegistry();
        $this->output = new JX_ConsoleOutput();
        $this->environment = new JX_ConsoleEnvironment();
    }

    /**
     * Registers a command instance.
     *
     * @param JX_ConsoleCommand $command Command instance.
     * @return void
     */
    public function register(JX_ConsoleCommand $command)
    {
        $this->registry->register($command);
    }

    /**
     * Returns the output helper.
     *
     * @return JX_ConsoleOutput
     */
    public function output()
    {
        return $this->output;
    }

    /**
     * Returns a command by name or alias.
     *
     * @param string $name Command name.
     * @return JX_ConsoleCommand|null
     */
    public function getCommand($name)
    {
        return $this->registry->get($name);
    }

    /**
     * Returns all registered commands.
     *
     * @return array
     */
    public function allCommands()
    {
        return $this->registry->all();
    }

    /**
     * Returns the project root path.
     *
     * @return string
     */
    public function rootPath()
    {
        return $this->rootPath;
    }

    /**
     * Returns environment data.
     *
     * @return JX_ConsoleEnvironment
     */
    public function environment()
    {
        return $this->environment;
    }

    /**
     * Executes the CLI application.
     *
     * @param array $argv Raw argv tokens.
     * @return int Exit code.
     */
    public function run(array $argv)
    {
        $input = new JX_ConsoleInput($argv);
        $globals = $this->globalOptions();
        $resolvedGlobals = $this->resolveOptions($globals, $input->getRawLongOptions(), $input->getRawShortOptions(), 'global');

        if (!empty($resolvedGlobals['errors'])) {
            foreach ($resolvedGlobals['errors'] as $error) {
                $this->output->error($error);
            }
            return 2;
        }

        if (!empty($resolvedGlobals['options']['quiet'])) {
            $this->output->setQuiet(true);
        }
        if (!empty($resolvedGlobals['options']['no-color'])) {
            $this->output->setUseColor(false);
        }

        $envOverride = $resolvedGlobals['options']['env'] ?? null;
        $this->environment->load($this->rootPath, $envOverride);

        if (!empty($resolvedGlobals['options']['version'])) {
            $this->renderVersion();
            return 0;
        }

        $commandName = $input->getCommandName();
        if ($commandName === null) {
            $commandName = 'list';
        }

        if ($commandName === 'help') {
            $commandName = 'help';
        }

        $command = $this->registry->get($commandName);
        if ($command === null) {
            $suggestion = $this->suggestCommand($commandName);
            $message = "Unknown command: {$commandName}.";
            if ($suggestion !== null) {
                $message .= " Did you mean {$suggestion}?";
            }
            throw new JX_ConsoleException($message, 2);
        }

        $resolved = $this->resolveCommandInput($command, $input);
        if (!empty($resolved['errors'])) {
            foreach ($resolved['errors'] as $error) {
                $this->output->error($error);
            }
            $this->renderCommandUsage($command);
            return 2;
        }

        if (!empty($resolvedGlobals['options']['debug'])) {
            $resolved['options']['debug'] = true;
        }
        if (!empty($resolvedGlobals['options']['help'])) {
            $resolved['options']['help'] = true;
        }
        if (!empty($resolved['options']['help'])) {
            $this->renderCommandHelp($command);
            return 0;
        }

        return (int) $command->execute($resolved, $this->output, $this);
    }

    /**
     * Returns global CLI option definitions.
     *
     * @return array
     */
    private function globalOptions()
    {
        return [
            ['name' => 'help', 'shortcut' => 'h', 'hasValue' => false, 'description' => 'Display help output', 'default' => false],
            ['name' => 'version', 'shortcut' => 'V', 'hasValue' => false, 'description' => 'Display CLI version', 'default' => false],
            ['name' => 'quiet', 'shortcut' => 'q', 'hasValue' => false, 'description' => 'Suppress non-error output', 'default' => false],
            ['name' => 'debug', 'shortcut' => 'd', 'hasValue' => false, 'description' => 'Enable debug output', 'default' => false],
            ['name' => 'env', 'shortcut' => null, 'hasValue' => true, 'description' => 'Override environment', 'default' => null],
            ['name' => 'no-color', 'shortcut' => null, 'hasValue' => false, 'description' => 'Disable ANSI colors', 'default' => false],
        ];
    }

    /**
     * Resolves command-specific arguments and options.
     *
     * @param JX_ConsoleCommand $command Command instance.
     * @param JX_ConsoleInput $input Parsed input.
     * @return array
     */
    private function resolveCommandInput(JX_ConsoleCommand $command, JX_ConsoleInput $input)
    {
        $rawArgs = $input->getRawArguments();
        $rawLong = $input->getRawLongOptions();
        $rawShort = $input->getRawShortOptions();

        $resolved = $this->resolveOptions(array_merge($this->globalOptions(), $command->getOptions()), $rawLong, $rawShort, $command->getName());

        $errors = $resolved['errors'];
        $arguments = [];
        foreach ($command->getArguments() as $index => $definition) {
            if (isset($rawArgs[$index])) {
                $arguments[$definition['name']] = $rawArgs[$index];
            } elseif ($definition['required']) {
                $errors[] = 'Missing required argument: ' . $definition['name'];
            } else {
                $arguments[$definition['name']] = $definition['default'];
            }
        }

        if (count($rawArgs) > count($command->getArguments())) {
            $errors[] = 'Too many arguments provided.';
        }

        return [
            'arguments' => $arguments,
            'options' => $resolved['options'],
            'errors' => $errors,
        ];
    }

    /**
     * Resolves options based on definitions and raw input.
     *
     * @param array $definitions Option definitions.
     * @param array $rawLong Raw long options.
     * @param array $rawShort Raw short options.
     * @param string $scope Option scope for errors.
     * @return array
     */
    private function resolveOptions(array $definitions, array $rawLong, array $rawShort, $scope)
    {
        $options = [];
        $errors = [];
        $known = [];
        $shortMap = [];

        foreach ($definitions as $definition) {
            $options[$definition['name']] = $definition['default'];
            $known[] = $definition['name'];
            if (!empty($definition['shortcut'])) {
                $shortMap[$definition['shortcut']] = $definition['name'];
            }
        }

        foreach ($rawLong as $name => $value) {
            if (!in_array($name, $known, true)) {
                $suggestion = $this->suggestOption($name, $known);
                $message = "Unknown option --{$name} for {$scope}.";
                if ($suggestion !== null) {
                    $message .= " Did you mean --{$suggestion}?";
                }
                $errors[] = $message;
                continue;
            }
            $definition = $this->findDefinition($definitions, $name);
            if ($definition['hasValue'] && $value === true) {
                $errors[] = "Option --{$name} expects a value.";
                continue;
            }
            $options[$name] = $definition['hasValue'] ? $value : true;
        }

        foreach ($rawShort as $short => $value) {
            if (!isset($shortMap[$short])) {
                $errors[] = "Unknown option -{$short} for {$scope}.";
                continue;
            }
            $name = $shortMap[$short];
            $definition = $this->findDefinition($definitions, $name);
            if ($definition['hasValue'] && $value === true) {
                $errors[] = "Option -{$short} expects a value.";
                continue;
            }
            $options[$name] = $definition['hasValue'] ? $value : true;
        }

        return ['options' => $options, 'errors' => $errors];
    }

    /**
     * Finds the definition array for a given option name.
     *
     * @param array $definitions Option definitions.
     * @param string $name Option name.
     * @return array
     */
    private function findDefinition(array $definitions, $name)
    {
        foreach ($definitions as $definition) {
            if ($definition['name'] === $name) {
                return $definition;
            }
        }
        return ['name' => $name, 'hasValue' => false, 'default' => null];
    }

    /**
     * Suggests a close command name.
     *
     * @param string $commandName Unknown command.
     * @return string|null
     */
    private function suggestCommand($commandName)
    {
        $closest = null;
        $distance = null;
        foreach ($this->registry->all() as $name => $command) {
            $current = levenshtein($commandName, $name);
            if ($distance === null || $current < $distance) {
                $distance = $current;
                $closest = $name;
            }
        }
        return $distance !== null && $distance <= 3 ? $closest : null;
    }

    /**
     * Suggests a close option name.
     *
     * @param string $name Unknown option.
     * @param array $known Known options.
     * @return string|null
     */
    private function suggestOption($name, array $known)
    {
        $closest = null;
        $distance = null;
        foreach ($known as $option) {
            $current = levenshtein($name, $option);
            if ($distance === null || $current < $distance) {
                $distance = $current;
                $closest = $option;
            }
        }
        return $distance !== null && $distance <= 3 ? $closest : null;
    }

    /**
     * Renders the CLI version information.
     *
     * @return void
     */
    private function renderVersion()
    {
        $version = 'unknown';
        if (class_exists('Jamilsoft')) {
            $platform = new Jamilsoft();
            $version = $platform->get_version();
        }
        $this->output->writeln('Jamilx CLI version ' . $version);
    }

    /**
     * Renders usage information for a command.
     *
     * @param JX_ConsoleCommand $command Command to render.
     * @return void
     */
    public function renderCommandUsage(JX_ConsoleCommand $command)
    {
        $usage = $command->getUsage();
        if ($usage === '') {
            $usage = 'jamilx ' . $command->getName();
        }
        $this->output->writeln('Usage: ' . $usage, 'muted');
    }

    /**
     * Renders detailed help for a command.
     *
     * @param JX_ConsoleCommand $command Command to render.
     * @return void
     */
    public function renderCommandHelp(JX_ConsoleCommand $command)
    {
        $this->output->writeln('Command: ' . $command->getName(), 'bold');
        $this->output->writeln($command->getDescription());
        $this->output->writeln('');

        $this->renderCommandUsage($command);

        if ($command->getArguments()) {
            $this->output->writeln('');
            $this->output->writeln('Arguments:', 'bold');
            foreach ($command->getArguments() as $argument) {
                $label = $argument['name'];
                $note = $argument['required'] ? 'required' : 'optional';
                $this->output->writeln("  {$label} ({$note}) - {$argument['description']}");
            }
        }

        if ($command->getOptions()) {
            $this->output->writeln('');
            $this->output->writeln('Options:', 'bold');
            foreach ($command->getOptions() as $option) {
                $short = $option['shortcut'] ? '-' . $option['shortcut'] . ', ' : '';
                $value = $option['hasValue'] ? ' <value>' : '';
                $this->output->writeln("  {$short}--{$option['name']}{$value} - {$option['description']}");
            }
        }

        if ($command->getExamples()) {
            $this->output->writeln('');
            $this->output->writeln('Examples:', 'bold');
            foreach ($command->getExamples() as $example) {
                $this->output->writeln('  ' . $example);
            }
        }
    }
}
