<?php

if (php_sapi_name() !== 'cli') {
    echo "This self-test is intended to run via CLI.\n";
    exit(1);
}

require_once __DIR__ . '/../../core/classes/email-class.php';

$config = Email::config();

function output_line($label, $status, $detail = '')
{
    $statusText = $status ? 'OK' : 'FAIL';
    echo "[$statusText] $label";
    if ($detail !== '') {
        echo " - $detail";
    }
    echo "\n";
}

output_line('Config load', !empty($config));

$templateHtml = Email::renderTemplate('welcome', [
    'name' => 'Self Test',
    'action_url' => 'https://example.com',
    'subject' => 'Welcome',
]);
output_line('Template render (welcome)', $templateHtml !== '');

$logResult = Email::send('selftest@example.com', 'JamilX Email Self-Test', '<p>Self-test log driver email.</p>', [
    'driver' => 'log',
]);
output_line('Log driver send', $logResult['success']);

$smtpHost = $config['host'];
$smtpPort = $config['port'];
$smtpStatus = false;
$smtpDetail = 'SMTP host not configured.';
if ($smtpHost !== '') {
    $remote = $smtpHost . ':' . $smtpPort;
    if ($config['encryption'] === 'ssl') {
        $remote = 'ssl://' . $remote;
    }
    $fp = @stream_socket_client($remote, $errno, $errstr, 5, STREAM_CLIENT_CONNECT);
    if ($fp) {
        stream_set_timeout($fp, 5);
        $response = fgets($fp, 515);
        if ($response !== false) {
            $smtpStatus = true;
            $smtpDetail = trim($response);
        }
        fclose($fp);
    } else {
        $smtpDetail = $errstr;
    }
}
output_line('SMTP connection', $smtpStatus, $smtpDetail);
