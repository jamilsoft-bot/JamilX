<?php

if (php_sapi_name() !== 'cli') {
    echo "This worker is intended to run via CLI.\n";
    exit(1);
}

require_once __DIR__ . '/../../core/index.php';

$limit = isset($argv[1]) ? (int) $argv[1] : 10;
$result = Email::processQueue($limit);

echo "Processed: {$result['processed']}\n";
echo "Failed: {$result['failed']}\n";
