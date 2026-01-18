<?php
/**
 * Represents a CLI error with a specific exit code.
 */
class JX_ConsoleException extends Exception
{
    /**
     * CLI exit code to use when this exception is thrown.
     *
     * @var int
     */
    private $exitCode;

    /**
     * @param string $message Error message for the CLI user.
     * @param int $exitCode Exit code to return.
     */
    public function __construct($message, $exitCode = 1)
    {
        parent::__construct($message, $exitCode);
        $this->exitCode = $exitCode;
    }

    /**
     * Returns the exit code associated with this exception.
     *
     * @return int
     */
    public function getExitCode()
    {
        return $this->exitCode;
    }
}
