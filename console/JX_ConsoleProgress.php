<?php
/**
 * Displays a simple progress spinner for long-running tasks.
 */
class JX_ConsoleProgress
{
    /**
     * @var JX_ConsoleOutput
     */
    private $output;

    /**
     * @var array
     */
    private $frames = ['-', '\\', '|', '/'];

    /**
     * @var int
     */
    private $index = 0;

    /**
     * @var bool
     */
    private $running = false;

    /**
     * @param JX_ConsoleOutput $output Output helper.
     */
    public function __construct(JX_ConsoleOutput $output)
    {
        $this->output = $output;
    }

    /**
     * Starts the progress indicator.
     *
     * @param string $message Initial message.
     * @return void
     */
    public function start($message)
    {
        $this->running = true;
        $this->output->write($message . ' ');
        $this->tick();
    }

    /**
     * Advances the progress indicator.
     *
     * @return void
     */
    public function tick()
    {
        if (!$this->running) {
            return;
        }
        $frame = $this->frames[$this->index % count($this->frames)];
        $this->index++;
        $this->output->write("\r" . $frame . ' ');
    }

    /**
     * Finishes the progress indicator.
     *
     * @param string $message Completion message.
     * @return void
     */
    public function finish($message)
    {
        if (!$this->running) {
            return;
        }
        $this->running = false;
        $this->output->write("\r" . $message . PHP_EOL);
    }
}
