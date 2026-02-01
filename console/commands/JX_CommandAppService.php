<?php
/**
 * Generates a service class inside an app package.
 */
class JX_CommandAppService extends JX_CommandAppBase
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'App:service';
        $this->description = 'Create a service class in Apps/<app>/services/.';
        $this->usage = 'jamilx App:service <app> <name> [--force] [--dry-run]';
        $this->examples = ['jamilx App:service Blog Billing', 'jamilx App:service ADK Reports --force'];
        $this->category = 'Apps';
        $this->addArgument('app', true, 'App nickname (folder in Apps/).');
        $this->addArgument('name', true, 'Service class name.');
        $this->addOption('force', 'f', false, 'Overwrite existing files.', false);
        $this->addOption('dry-run', null, false, 'Preview files without writing them.', false);
    }

    /**
     * @param array $input Parsed input.
     * @param JX_ConsoleOutput $output Output helper.
     * @param JX_ConsoleApplication $app Application instance.
     * @return int
     */
    public function execute(array $input, JX_ConsoleOutput $output, JX_ConsoleApplication $app)
    {
        $appNick = $input['arguments']['app'];
        $name = $input['arguments']['name'];
        $appPath = $this->resolveAppPath($appNick, $app, $output);
        if ($appPath === null) {
            return 1;
        }

        $naming = $this->naming();
        $className = $naming->classify($name);
        $fileName = $naming->fileName($name);
        $path = rtrim($appPath, DIRECTORY_SEPARATOR) . '/services/' . $fileName . '.php';

        $contents = $this->stub($app)->render('service.stub', [
            'class' => $className,
            'container' => $fileName,
        ]);

        $result = $this->fileSystem()->writeFile($path, $contents, $input['options']['force'], $input['options']['dry-run']);
        $this->reportResult($output, $result);
        return 0;
    }
}
