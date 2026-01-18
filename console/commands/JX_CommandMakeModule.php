<?php
/**
 * Scaffolds a full module skeleton using Jamilx conventions.
 */
class JX_CommandMakeModule extends JX_CommandMakeBase
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'make:module';
        $this->description = 'Scaffold a full module with services, actions, containers, and prototypes.';
        $this->usage = 'jamilx make:module <name> [--force] [--dry-run] [--path <path>]';
        $this->examples = ['jamilx make:module Blog', 'jamilx make:module Billing --path Apps/Billing'];
        $this->category = 'Generators';
        $this->addArgument('name', true, 'Module name.');
        $this->addOption('force', 'f', false, 'Overwrite existing files.', false);
        $this->addOption('dry-run', null, false, 'Preview files without writing them.', false);
        $this->addOption('path', 'p', true, 'Override the base path.', null);
    }

    /**
     * @param array $input Parsed input.
     * @param JX_ConsoleOutput $output Output helper.
     * @param JX_ConsoleApplication $app Application instance.
     * @return int
     */
    public function execute(array $input, JX_ConsoleOutput $output, JX_ConsoleApplication $app)
    {
        $name = $input['arguments']['name'];
        $naming = $this->naming();
        $className = $naming->classify($name);
        $fileName = $naming->fileName($name);

        $basePath = $input['options']['path'] ?: $app->rootPath();
        $force = $input['options']['force'];
        $dryRun = $input['options']['dry-run'];

        $servicePath = rtrim($basePath, DIRECTORY_SEPARATOR) . '/services/' . $fileName . '.php';
        $actionPath = rtrim($basePath, DIRECTORY_SEPARATOR) . '/actions/' . $fileName . '.php';
        $prototypePath = rtrim($basePath, DIRECTORY_SEPARATOR) . '/prototypes/' . $fileName . '.php';
        $containerPath = rtrim($basePath, DIRECTORY_SEPARATOR) . '/containers/' . $fileName . '/index.php';

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
