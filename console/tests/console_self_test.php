<?php
/**
 * Minimal self-test for the CLI argument parser.
 */
require_once __DIR__ . '/../JX_ConsoleAutoload.php';
JX_ConsoleAutoload::register(dirname(__DIR__));

$tests = [
    [
        'argv' => ['jamilx', 'make:service', 'User', '--force', '--path', 'services'],
        'command' => 'make:service',
        'args' => ['User'],
        'options' => ['force' => true, 'path' => 'services'],
    ],
    [
        'argv' => ['jamilx', 'db:migrate', '-p', 'database/migrations'],
        'command' => 'db:migrate',
        'args' => [],
        'options' => ['p' => 'database/migrations'],
    ],
];

$failed = false;
foreach ($tests as $test) {
    $input = new JX_ConsoleInput($test['argv']);
    if ($input->getCommandName() !== $test['command']) {
        $failed = true;
        echo "Command mismatch: expected {$test['command']}, got {$input->getCommandName()}\n";
    }
    if ($input->getRawArguments() !== $test['args']) {
        $failed = true;
        echo "Arguments mismatch for {$test['command']}\n";
    }
    foreach ($test['options'] as $key => $value) {
        $long = $input->getRawLongOptions();
        $short = $input->getRawShortOptions();
        $current = $long[$key] ?? $short[$key] ?? null;
        if ($current !== $value) {
            $failed = true;
            echo "Option mismatch for {$test['command']} ({$key})\n";
        }
    }
}

if ($failed) {
    exit(1);
}

echo "CLI self-test passed.\n";
