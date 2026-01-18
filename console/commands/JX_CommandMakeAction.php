<?php
/**
 * Generates an action class for the framework.
 */
class JX_CommandMakeAction extends JX_CommandMakeBase
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'make:action';
        $this->description = 'Create an action class in actions/.';
        $this->usage = 'jamilx make:action <name> [--force] [--dry-run] [--path <path>]';
        $this->examples = ['jamilx make:action Blog', 'jamilx make:action Reports --force'];
        $this->category = 'Generators';
        $this->addArgument('name', true, 'Action class name.');
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

        $basePath = $input['options']['path'] ?: $app->rootPath() . '/actions';
        $path = rtrim($basePath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $fileName . '.php';

        $contents = $this->stub($app)->render('action.stub', [
            'class' => $className,
            'container' => $fileName,
        ]);

        $result = $this->fileSystem()->writeFile($path, $contents, $input['options']['force'], $input['options']['dry-run']);
        $this->reportResult($output, $result);
        return 0;
    }
}
