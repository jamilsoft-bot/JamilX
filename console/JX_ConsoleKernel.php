<?php
/**
 * Boots and configures the Jamilx CLI application.
 */
class JX_ConsoleKernel
{
    /**
     * @var string
     */
    private $rootPath;

    /**
     * @param string $rootPath Project root path.
     */
    public function __construct($rootPath)
    {
        $this->rootPath = rtrim($rootPath, DIRECTORY_SEPARATOR);
    }

    /**
     * Handles CLI execution and error management.
     *
     * @param array $argv Raw argv tokens.
     * @return int Exit code.
     */
    public function handle(array $argv)
    {
        $app = new JX_ConsoleApplication($this->rootPath);
        $this->registerCommands($app);
        $debug = in_array('--debug', $argv, true) || in_array('-d', $argv, true);

        try {
            $this->bootstrapFramework();
            return $app->run($argv);
        } catch (JX_ConsoleException $exception) {
            $app->output()->error($exception->getMessage());
            if ($debug) {
                $app->output()->writeln($exception->getTraceAsString(), 'muted');
            }
            return $exception->getExitCode();
        } catch (Throwable $exception) {
            $app->output()->error('Unexpected error: ' . $exception->getMessage());
            if ($debug) {
                $app->output()->writeln($exception->getTraceAsString(), 'muted');
            }
            return 1;
        }
    }

    /**
     * Loads core framework files needed by legacy and database commands.
     *
     * @return void
     */
    private function bootstrapFramework()
    {
        $corePath = $this->rootPath . '/core/index.php';
        if (is_file($corePath)) {
            require_once $corePath;
        }
    }

    /**
     * Registers available CLI commands.
     *
     * @param JX_ConsoleApplication $app Application instance.
     * @return void
     */
    private function registerCommands(JX_ConsoleApplication $app)
    {
        $commandPath = $this->rootPath . '/console/commands';
        foreach (glob($commandPath . '/*.php') as $file) {
            $class = basename($file, '.php');
            if (strpos($class, 'JX_') !== 0) {
                continue;
            }
            if (!class_exists($class)) {
                require_once $file;
            }
            if (!class_exists($class)) {
                continue;
            }
            $reflection = new ReflectionClass($class);
            if ($reflection->isAbstract() || !$reflection->isSubclassOf('JX_ConsoleCommand')) {
                continue;
            }
            if ($reflection->getConstructor() && $reflection->getConstructor()->getNumberOfRequiredParameters() > 0) {
                continue;
            }
            $app->register($reflection->newInstance());
        }

        $app->register(new JX_CommandLegacyScript('AddAction', 'console/AddAction.php'));
        $app->register(new JX_CommandLegacyScript('AddService', 'console/JXService.php'));
        $app->register(new JX_CommandLegacyScript('CreateApp', 'console/CreateApp.php'));
        $app->register(new JX_CommandLegacyScript('DB:Make', 'console/DB.php'));
        $app->register(new JX_CommandLegacyScript('DB:Insert', 'console/DB.php'));
        $app->register(new JX_CommandLegacyScript('DB:Delete', 'console/DB.php'));
    }
}
