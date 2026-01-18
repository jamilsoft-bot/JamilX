<?php
/**
 * Generates a prototype file for the framework.
 */
class JX_CommandMakePrototype extends JX_CommandMakeBase
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'make:prototype';
        $this->description = 'Create a prototype file in prototypes/.';
        $this->usage = 'jamilx make:prototype <name> [--force] [--dry-run] [--path <path>]';
        $this->examples = ['jamilx make:prototype Blog', 'jamilx make:prototype UserProfile --force'];
        $this->category = 'Generators';
        $this->addArgument('name', true, 'Prototype name.');
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

        $basePath = $input['options']['path'] ?: $app->rootPath() . '/prototypes';
        $path = rtrim($basePath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $fileName . '.php';

        $contents = $this->stub($app)->render('prototype.stub', [
            'name' => $name,
        ]);

        $result = $this->fileSystem()->writeFile($path, $contents, $input['options']['force'], $input['options']['dry-run']);
        $this->reportResult($output, $result);
        return 0;
    }
}
