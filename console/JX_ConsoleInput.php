<?php
/**
 * Parses raw argv tokens into structured command, arguments, and options.
 */
class JX_ConsoleInput
{
    /**
     * @var array
     */
    private $rawArguments = [];

    /**
     * @var array
     */
    private $rawLongOptions = [];

    /**
     * @var array
     */
    private $rawShortOptions = [];

    /**
     * @var string|null
     */
    private $commandName;

    /**
     * @param array $argv Raw argv tokens from CLI.
     */
    public function __construct(array $argv)
    {
        $this->parse($argv);
    }

    /**
     * Returns the command name, if provided.
     *
     * @return string|null
     */
    public function getCommandName()
    {
        return $this->commandName;
    }

    /**
     * Returns positional arguments following the command name.
     *
     * @return array
     */
    public function getRawArguments()
    {
        return $this->rawArguments;
    }

    /**
     * Returns raw long options like --env or --force.
     *
     * @return array
     */
    public function getRawLongOptions()
    {
        return $this->rawLongOptions;
    }

    /**
     * Returns raw short options like -f or -q.
     *
     * @return array
     */
    public function getRawShortOptions()
    {
        return $this->rawShortOptions;
    }

    /**
     * Parses raw CLI arguments into command name, args, and options.
     *
     * @param array $argv Raw argv tokens from CLI.
     * @return void
     */
    private function parse(array $argv)
    {
        $tokens = $argv;
        array_shift($tokens);

        $commandFound = false;
        $stopOptionParsing = false;

        while ($tokens) {
            $token = array_shift($tokens);

            if ($token === '--') {
                $stopOptionParsing = true;
                continue;
            }

            if (!$commandFound && !$stopOptionParsing && $token !== '' && $token[0] !== '-') {
                $this->commandName = $token;
                $commandFound = true;
                continue;
            }

            if (!$stopOptionParsing && $token !== '' && $token[0] === '-') {
                if (strpos($token, '--') === 0) {
                    $this->parseLongOption($token, $tokens);
                } else {
                    $this->parseShortOption($token, $tokens);
                }
                continue;
            }

            $this->rawArguments[] = $token;
        }
    }

    /**
     * Parses a long option token.
     *
     * @param string $token Current token.
     * @param array $tokens Remaining tokens.
     * @return void
     */
    private function parseLongOption($token, array &$tokens)
    {
        $option = substr($token, 2);
        $value = true;

        if (strpos($option, '=') !== false) {
            list($option, $value) = explode('=', $option, 2);
        } elseif (isset($tokens[0]) && $tokens[0] !== '' && $tokens[0][0] !== '-') {
            $value = array_shift($tokens);
        }

        $this->rawLongOptions[$option] = $value;
    }

    /**
     * Parses a short option token.
     *
     * @param string $token Current token.
     * @param array $tokens Remaining tokens.
     * @return void
     */
    private function parseShortOption($token, array &$tokens)
    {
        $shorts = substr($token, 1);
        $chars = str_split($shorts);
        $lastIndex = count($chars) - 1;

        foreach ($chars as $index => $char) {
            $value = true;
            if ($index === $lastIndex && isset($tokens[0]) && $tokens[0] !== '' && $tokens[0][0] !== '-') {
                $value = array_shift($tokens);
            }
            $this->rawShortOptions[$char] = $value;
        }
    }
}
