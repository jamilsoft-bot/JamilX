<?php
/**
 * Wraps legacy console scripts to preserve backward compatibility.
 */
class JX_CommandLegacyScript extends JX_ConsoleCommand
{
    /**
     * @var string
     */
    private $legacyName;

    /**
     * @var string
     */
    private $scriptPath;

    /**
     * @param string $legacyName Legacy command name.
     * @param string $scriptPath Script path relative to project root.
     */
    public function __construct($legacyName, $scriptPath)
    {
        $this->legacyName = $legacyName;
        $this->scriptPath = $scriptPath;
        parent::__construct();
    }

    /**
     * Defines metadata for legacy commands.
     *
     * @return void
     */
    protected function configure()
    {
        $this->name = $this->legacyName;
        $this->description = 'Legacy console command preserved for compatibility.';
        $this->usage = 'jamilx ' . $this->legacyName . ' [arguments]';
        $this->category = 'Legacy';
        $this->addArgument('name', false, 'Primary argument for legacy command.');
        $this->addArgument('path', false, 'Secondary argument for legacy command.');
    }

    /**
     * Executes the legacy script by setting expected globals.
     *
     * @param array $input Parsed input arguments and options.
     * @param JX_ConsoleOutput $output Output helper.
     * @param JX_ConsoleApplication $app Application instance.
     * @return int Exit code.
     */
    public function execute(array $input, JX_ConsoleOutput $output, JX_ConsoleApplication $app)
    {
        global $program, $service_name, $service_path;

        $program = $this->legacyName;
        $service_name = $input['arguments']['name'] ?? null;
        $service_path = $input['arguments']['path'] ?? null;

        $fullPath = $app->rootPath() . DIRECTORY_SEPARATOR . $this->scriptPath;
        if (!is_file($fullPath)) {
            throw new JX_ConsoleException('Legacy script not found: ' . $this->scriptPath, 2);
        }
        require $fullPath;
        return 0;
    }
}
