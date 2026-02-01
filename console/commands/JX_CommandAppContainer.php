<?php
/**
 * Generates a container view inside an app package.
 */
class JX_CommandAppContainer extends JX_CommandAppBase
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'App:container';
        $this->description = 'Create a container view in Apps/<app>/containers/.';
        $this->usage = 'jamilx App:container <app> <name> [--force] [--dry-run]';
        $this->examples = ['jamilx App:container Blog Home', 'jamilx App:container ADK Main --force'];
        $this->category = 'Apps';
        $this->addArgument('app', true, 'App nickname (folder in Apps/).');
        $this->addArgument('name', true, 'Container name.');
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
        $fileName = $naming->fileName($name);
        $path = rtrim($appPath, DIRECTORY_SEPARATOR) . '/containers/' . $fileName . '.php';

        $contents = $this->stub($app)->render('container.stub', [
            'name' => $name,
        ]);

        $result = $this->fileSystem()->writeFile($path, $contents, $input['options']['force'], $input['options']['dry-run']);
        $this->reportResult($output, $result);
        return 0;
    }
}
