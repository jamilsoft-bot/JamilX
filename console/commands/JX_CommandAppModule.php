<?php
/**
 * Scaffolds a module inside an app package.
 */
class JX_CommandAppModule extends JX_CommandAppBase
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'App:module';
        $this->description = 'Scaffold a module inside Apps/<app>/ with service, action, container, and prototype.';
        $this->usage = 'jamilx App:module <app> <name> [--force] [--dry-run]';
        $this->examples = ['jamilx App:module Blog Billing', 'jamilx App:module ADK Reports --force'];
        $this->category = 'Apps';
        $this->addArgument('app', true, 'App nickname (folder in Apps/).');
        $this->addArgument('name', true, 'Module name.');
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
        $force = $input['options']['force'];
        $dryRun = $input['options']['dry-run'];

        $servicePath = rtrim($appPath, DIRECTORY_SEPARATOR) . '/services/' . $fileName . '.php';
        $actionPath = rtrim($appPath, DIRECTORY_SEPARATOR) . '/actions/' . $fileName . '.php';
        $prototypePath = rtrim($appPath, DIRECTORY_SEPARATOR) . '/prototypes/' . $fileName . '.php';
        $containerPath = rtrim($appPath, DIRECTORY_SEPARATOR) . '/containers/' . $fileName . '.php';

        $stub = $this->stub($app);
        $results = [];
        $results[] = $this->fileSystem()->writeFile($servicePath, $stub->render('service.stub', [
            'class' => $className,
            'container' => $fileName,
        ]), $force, $dryRun);

        $results[] = $this->fileSystem()->writeFile($actionPath, $stub->render('action.stub', [
            'class' => $className,
            'container' => $fileName,
        ]), $force, $dryRun);

        $results[] = $this->fileSystem()->writeFile($prototypePath, $stub->render('prototype.stub', [
            'name' => $name,
        ]), $force, $dryRun);

        $results[] = $this->fileSystem()->writeFile($containerPath, $stub->render('container.stub', [
            'name' => $name,
        ]), $force, $dryRun);

        foreach ($results as $result) {
            $this->reportResult($output, $result);
        }

        return 0;
    }
}
