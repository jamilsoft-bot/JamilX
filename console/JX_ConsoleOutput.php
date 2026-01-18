<?php
/**
 * Writes formatted output to the console with standard log levels.
 */
class JX_ConsoleOutput
{
    /**
     * @var JX_ConsoleFormatter
     */
    private $formatter;

    /**
     * @var bool
     */
    private $quiet = false;

    /**
     * @var resource
     */
    private $stream;

    /**
     * @param resource|null $stream Stream to write output to.
     */
    public function __construct($stream = null)
    {
        $this->stream = $stream ?: STDOUT;
        $this->formatter = new JX_ConsoleFormatter(JX_ConsoleFormatter::supportsColors($this->stream));
    }

    /**
     * Sets quiet mode to suppress non-error output.
     *
     * @param bool $quiet Whether to suppress output.
     * @return void
     */
    public function setQuiet($quiet)
    {
        $this->quiet = (bool) $quiet;
    }

    /**
     * Enables or disables ANSI color output.
     *
     * @param bool $useColor Whether to use ANSI colors.
     * @return void
     */
    public function setUseColor($useColor)
    {
        $this->formatter->setUseColor($useColor);
    }

    /**
     * Writes a message to the console.
     *
     * @param string $message Message to output.
     * @param bool $newline Whether to append a newline.
     * @param string|null $style Optional style token for coloring.
     * @return void
     */
    public function write($message, $newline = false, $style = null)
    {
        if ($this->quiet && $style !== 'error') {
            return;
        }
        if ($style !== null) {
            $message = $this->formatter->format($message, $style);
        }
        if ($newline) {
            $message .= PHP_EOL;
        }
        fwrite($this->stream, $message);
    }

    /**
     * Writes a line to the console.
     *
     * @param string $message Message to output.
     * @param string|null $style Optional style token for coloring.
     * @return void
     */
    public function writeln($message, $style = null)
    {
        $this->write($message, true, $style);
    }

    /**
     * Outputs an info message.
     *
     * @param string $message Message to output.
     * @return void
     */
    public function info($message)
    {
        $this->writeln($message, 'info');
    }

    /**
     * Outputs a success message.
     *
     * @param string $message Message to output.
     * @return void
     */
    public function success($message)
    {
        $this->writeln($message, 'success');
    }

    /**
     * Outputs a warning message.
     *
     * @param string $message Message to output.
     * @return void
     */
    public function warning($message)
    {
        $this->writeln($message, 'warning');
    }

    /**
     * Outputs an error message.
     *
     * @param string $message Message to output.
     * @return void
     */
    public function error($message)
    {
        $this->writeln($message, 'error');
    }

    /**
     * Provides access to the formatter for table rendering.
     *
     * @return JX_ConsoleFormatter
     */
    public function formatter()
    {
        return $this->formatter;
    }
}
