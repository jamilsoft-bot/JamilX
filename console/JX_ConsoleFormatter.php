<?php
/**
 * Handles ANSI color formatting and output styling decisions.
 */
class JX_ConsoleFormatter
{
    /**
     * @var bool
     */
    private $useColor = true;

    /**
     * @param bool $useColor Whether to enable ANSI colors.
     */
    public function __construct($useColor = true)
    {
        $this->useColor = $useColor;
    }

    /**
     * Enables or disables ANSI color output.
     *
     * @param bool $useColor Whether to enable ANSI colors.
     * @return void
     */
    public function setUseColor($useColor)
    {
        $this->useColor = $useColor;
    }

    /**
     * Returns a colorized string when color output is enabled.
     *
     * @param string $text Content to style.
     * @param string $style Style token (info|success|warning|error|muted|bold).
     * @return string
     */
    public function format($text, $style)
    {
        if (!$this->useColor) {
            return $text;
        }

        $styles = [
            'info' => "\033[36m",
            'success' => "\033[32m",
            'warning' => "\033[33m",
            'error' => "\033[31m",
            'muted' => "\033[90m",
            'bold' => "\033[1m",
        ];

        $prefix = isset($styles[$style]) ? $styles[$style] : '';
        $reset = $prefix !== '' ? "\033[0m" : '';

        return $prefix . $text . $reset;
    }

    /**
     * Determines if ANSI colors are supported on the current stream.
     *
     * @param resource $stream Output stream.
     * @return bool
     */
    public static function supportsColors($stream)
    {
        if (DIRECTORY_SEPARATOR === '\\') {
            return false;
        }
        if (function_exists('stream_isatty')) {
            return stream_isatty($stream);
        }
        if (function_exists('posix_isatty')) {
            return posix_isatty($stream);
        }
        return false;
    }
}
