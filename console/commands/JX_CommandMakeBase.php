<?php
/**
 * Base class for file generator commands.
 */
abstract class JX_CommandMakeBase extends JX_ConsoleCommand
{
    /**
     * Returns the filesystem helper.
     *
     * @return JX_ConsoleFileSystem
     */
    protected function fileSystem()
    {
        return new JX_ConsoleFileSystem();
    }

    /**
     * Returns the stub renderer.
     *
     * @param JX_ConsoleApplication $app Application instance.
     * @return JX_ConsoleStub
     */
    protected function stub(JX_ConsoleApplication $app)
    {
        return new JX_ConsoleStub($app->rootPath() . '/console/stubs');
    }

    /**
     * Returns the naming helper.
     *
     * @return JX_ConsoleNaming
     */
    protected function naming()
    {
        return new JX_ConsoleNaming();
    }

    /**
     * Emits generator output based on write results.
     *
     * @param JX_ConsoleOutput $output Output helper.
     * @param array $result Result from filesystem write.
     * @return void
     */
    protected function reportResult(JX_ConsoleOutput $output, array $result)
    {
        $message = sprintf('%s: %s', $result['status'], $result['path']);
        if ($result['status'] === 'created') {
            $output->success($message);
        } elseif ($result['status'] === 'dry-run') {
            $output->info($message . ' (dry-run)');
        } else {
            $output->warning($message . ' (' . $result['message'] . ')');
        }
    }
}
