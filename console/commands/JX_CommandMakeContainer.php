<?php
/**
 * Generates a container file for the framework.
 */
class JX_CommandMakeContainer extends JX_CommandMakeBase
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'make:container';
        $this->description = 'Create a container view in containers/.';
        $this->usage = 'jamilx make:container <name> [--service <service>] [--force] [--dry-run] [--path <path>]';
        $this->examples = ['jamilx make:container Dashboard', 'jamilx make:container Index --service blog'];
        $this->category = 'Generators';
        $this->addArgument('name', true, 'Container name.');
        $this->addOption('service', 's', true, 'Service folder for the container.', null);
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
        $fileName = $naming->fileName($name);

        $basePath = $input['options']['path'] ?: $app->rootPath() . '/containers';
        $service = $input['options']['service'];
        if ($service) {
            $targetDir = rtrim($basePath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $naming->fileName($service);
            $path = $targetDir . DIRECTORY_SEPARATOR . $fileName . '.php';
        } else {
            $targetDir = rtrim($basePath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $fileName;
            $path = $targetDir . DIRECTORY_SEPARATOR . 'index.php';
        }

        $contents = $this->stub($app)->render('container.stub', [
            'name' => $name,
        ]);

        $result = $this->fileSystem()->writeFile($path, $contents, $input['options']['force'], $input['options']['dry-run']);
        $this->reportResult($output, $result);
        return 0;
    }
}
