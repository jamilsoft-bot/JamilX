<?php
/**
 * Base class for App-scoped generators.
 */
abstract class JX_CommandAppBase extends JX_CommandMakeBase
{
    /**
     * Resolve the base path for an app package.
     *
     * @param string $appNick App nickname.
     * @param JX_ConsoleApplication $app Application instance.
     * @param JX_ConsoleOutput $output Output helper.
     * @return string|null
     */
    protected function resolveAppPath($appNick, JX_ConsoleApplication $app, JX_ConsoleOutput $output)
    {
        $appPath = $app->rootPath() . '/Apps/' . $appNick;
        if (!is_dir($appPath)) {
            $output->error(sprintf('App not found: %s. Create it first with "jamilx create:app %s".', $appNick, $appNick));
            return null;
        }

        return $appPath;
    }
}
