<?php

/**
 * Creates a new JamilX application.
 */
class JX_CommandCreateApp extends JX_ConsoleCommand
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->name = 'create:app';
        $this->description = 'Create a new JamilX application.';
        $this->usage = 'jamilx create:app [nick]';
        $this->examples = ['jamilx create:app myapp'];
        $this->category = 'Generators';
        $this->addArgument('nick', false, 'The nickname of the application.');
    }

    /**
     * @param array $input Parsed input.
     * @param JX_ConsoleOutput $output Output helper.
     * @param JX_ConsoleApplication $app Application instance.
     * @return int
     */
    public function execute(array $input, JX_ConsoleOutput $output, JX_ConsoleApplication $app)
    {
        $data = [];
        $appnick = $input['arguments']['nick'];

        $output->writeln("Welcome to App Creation Wizard", 'info');
        $output->writeln("");

        if (!$appnick) {
            $appnick = $this->ask($output, "Type your App Nick name (no Space): ");
        }
        $data['Nick'] = $appnick;

        $output->writeln("");
        $data['Name'] = $this->ask($output, "Type your App Full name:  ");
        $output->writeln("");

        $data['Summary'] = $this->ask($output, "Type your App Summary: ");
        $output->writeln("");

        $data['Version'] = $this->ask($output, "Type your App Version: ");
        $output->writeln("");

        $data['author'] = $this->ask($output, "Type Author to your App (your Name): ");
        $output->writeln("");

        $data['Website'] = $this->ask($output, "Type your app website: ");
        $output->writeln("");

        $data['Email'] = $this->ask($output, "Type Author email: ");
        $data['logo'] = null;
        $data['tag'] = 'jamilx, App, Saas';

        $output->writeln("");
        $output->writeln("Creating $appnick .....");

        // Logic from original CreateApp.php
        $json = json_encode($data);

        // Ensure AppData is available. It might be autoloaded, but let's be safe.
        // Assuming AppData handles directory creation logic.
        if (!class_exists('AppData')) {
            // Fallback or error if not loaded by kernel. 
            // Kernel loads core/index.php which hopefully loads AppData.
            // If not, we might need to require it.
            // Based on grep, it is in core/classes/app-data-class.php
            $corePath = $app->rootPath() . '/core/classes/app-data-class.php';
            if (file_exists($corePath)) {
                require_once $corePath;
            }
        }

        if (class_exists('AppData')) {
            $creatdata = new AppData($appnick);
            $creatdata->createdr();
            $output->writeln("Creating Directories for $appnick .....");
            $creatdata->createData();

            $output->writeln("Adding Necessary Data to $appnick .....");

            $confPath = $app->rootPath() . "/Apps/$appnick/conf.json";
            // Ensure Apps directory exists? AppData likely handles it but let's assume standard path.

            // The original script used file_put_contents("Apps/$appnick/conf.json",$json);
            // $app->rootPath() gives absolute path so we should use it.

            file_put_contents($confPath, $json);

            $output->success("Created $appnick .....");
            $output->writeln("Enjoy your App in Apps/$appnick");
        } else {
            $output->error("AppData class not found. Cannot proceed.");
            return 1;
        }

        return 0;
    }

    /**
     * Helper to ask a question.
     * JX_ConsoleCommand doesn't seem to have a helper for readline, so implementing simple one.
     */
    private function ask(JX_ConsoleOutput $output, $question)
    {
        $output->write($question);
        return trim(fgets(STDIN));
    }
}
