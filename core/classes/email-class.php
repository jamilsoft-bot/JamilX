<?php

class Email
{
    private static function rootPath($path = '')
    {
        $root = dirname(__DIR__, 2);
        if ($path !== '') {
            return $root . '/' . ltrim($path, '/');
        }
        return $root;
    }

    public static function config()
    {
        $env = parse_ini_file('.env');
        $defaultFrom = isset($env['SITENAME']) ? $env['SITENAME'] : 'JamilX';

        return [
            'driver' => self::envValue($env, 'MAIL_DRIVER', 'smtp'),
            'host' => self::envValue($env, 'MAIL_HOST', 'localhost'),
            'port' => (int) self::envValue($env, 'MAIL_PORT', 587),
            'username' => self::envValue($env, 'MAIL_USERNAME', ''),
            'password' => self::envValue($env, 'MAIL_PASSWORD', ''),
            'encryption' => self::envValue($env, 'MAIL_ENCRYPTION', 'tls'),
            'from_email' => self::envValue($env, 'MAIL_FROM_EMAIL', self::envValue($env, 'SITE_MAIL', 'no-reply@localhost')),
            'from_name' => self::envValue($env, 'MAIL_FROM_NAME', $defaultFrom),
            'reply_to' => self::envValue($env, 'MAIL_REPLY_TO', ''),
            'debug' => self::envBool($env, 'MAIL_DEBUG', self::envValue($env, 'MODE', 'development') === 'development'),
        ];
    }

    private static function envValue($env, $key, $default)
    {
        if (isset($env[$key]) && $env[$key] !== '') {
            return $env[$key];
        }
        return $default;
    }

    private static function envBool($env, $key, $default)
    {
        if (!isset($env[$key]) || $env[$key] === '') {
            return (bool) $default;
        }
        $value = strtolower(trim($env[$key]));
        return in_array($value, ['1', 'true', 'yes', 'on'], true);
    }

    public static function isAdmin()
    {
        global $Me;
        if (!isset($_SESSION['uid'])) {
            return false;
        }
        $role = $Me->role();
        return $role === 'admin' || $role === 'Admin';
    }

    public static function send($to, $subject, $html, $options = [])
    {
        $config = self::config();
        $toList = self::normalizeRecipients($to);
        if (empty($toList)) {
            return self::result(false, 'Recipient is required.');
        }
        if (!self::validateRecipients($toList)) {
            return self::result(false, 'Invalid recipient email address.');
        }

        $template = isset($options['template']) ? $options['template'] : null;
        if ($template && $html === '') {
            $html = self::renderTemplate($template, isset($options['vars']) ? $options['vars'] : []);
        }

        $text = isset($options['text']) ? $options['text'] : self::toText($html);
        $message = self::buildMessage($toList, $subject, $html, $text, $options, $config);

        $driver = isset($options['driver']) ? $options['driver'] : $config['driver'];
        $result = self::sendWithDriver($driver, $message, $config);

        self::logAttempt([
            'to' => implode(', ', $toList),
            'subject' => $subject,
            'template' => $template ?: 'custom',
            'driver' => $driver,
            'status' => $result['success'] ? 'sent' : 'failed',
            'error' => $result['error'],
            'meta' => [
                'cc' => $message['headers']['Cc'] ?? null,
                'bcc' => $message['headers']['Bcc'] ?? null,
            ],
        ]);

        return $result;
    }

    public static function sendText($to, $subject, $text, $options = [])
    {
        $options['text'] = $text;
        return self::send($to, $subject, '', $options);
    }

    public static function queue($to, $subject, $html, $options = [])
    {
        $config = self::config();
        $toList = self::normalizeRecipients($to);
        if (empty($toList)) {
            return self::result(false, 'Recipient is required.');
        }
        if (!self::validateRecipients($toList)) {
            return self::result(false, 'Invalid recipient email address.');
        }

        $template = isset($options['template']) ? $options['template'] : null;
        if ($template && $html === '') {
            $html = self::renderTemplate($template, isset($options['vars']) ? $options['vars'] : []);
        }

        $text = isset($options['text']) ? $options['text'] : self::toText($html);
        $queueData = [
            'to' => implode(', ', $toList),
            'subject' => $subject,
            'html' => $html,
            'text' => $text,
            'options' => json_encode($options),
            'template' => $template ?: 'custom',
            'status' => 'pending',
            'attempts' => 0,
        ];

        $result = self::insertQueue($queueData);
        if (!$result['success']) {
            return $result;
        }

        self::logAttempt([
            'to' => $queueData['to'],
            'subject' => $subject,
            'template' => $queueData['template'],
            'driver' => $config['driver'],
            'status' => 'queued',
            'error' => null,
            'meta' => null,
        ]);

        return self::result(true, null, ['queue_id' => $result['id']]);
    }

    public static function processQueue($limit = 10)
    {
        $db = self::db();
        if (!$db) {
            return ['processed' => 0, 'failed' => 0];
        }
        self::ensureQueueTable();

        $limit = (int) $limit;
        $result = $db->query("SELECT * FROM `email_queue` WHERE `status`='pending' ORDER BY `id` ASC LIMIT $limit");
        if (!$result) {
            return ['processed' => 0, 'failed' => 0];
        }

        $processed = 0;
        $failed = 0;
        foreach ($result as $row) {
            $processed++;
            $options = json_decode($row['options'], true);
            if (!is_array($options)) {
                $options = [];
            }
            $options['text'] = $row['text'];
            $sendResult = self::send($row['recipient'], $row['subject'], $row['html'], $options);
            if ($sendResult['success']) {
                self::markQueueSent((int) $row['id']);
            } else {
                $failed++;
                self::markQueueFailed((int) $row['id'], $sendResult['error']);
            }
        }

        return ['processed' => $processed, 'failed' => $failed];
    }

    public static function retryQueue($id)
    {
        $db = self::db();
        if (!$db) {
            return false;
        }
        $id = (int) $id;
        return (bool) $db->query("UPDATE `email_queue` SET `status`='pending', `last_error`=NULL WHERE `id`=$id");
    }

    public static function getQueueItems($status = null, $limit = 200)
    {
        $db = self::db();
        if (!$db) {
            return [];
        }
        self::ensureQueueTable();
        $limit = (int) $limit;
        $where = '';
        if ($status) {
            $status = self::escape($status);
            $where = "WHERE `status`='$status'";
        }
        $result = $db->query("SELECT * FROM `email_queue` $where ORDER BY `id` DESC LIMIT $limit");
        if (!$result) {
            return [];
        }
        return $result;
    }

    public static function getQueueItem($id)
    {
        $db = self::db();
        if (!$db) {
            return null;
        }
        self::ensureQueueTable();
        $id = (int) $id;
        $result = $db->query("SELECT * FROM `email_queue` WHERE `id`=$id LIMIT 1");
        if (!$result) {
            return null;
        }
        return $result->fetch_assoc();
    }

    public static function getLogs($limit = 200)
    {
        $db = self::db();
        if ($db && self::ensureLogTable()) {
            $limit = (int) $limit;
            $result = $db->query("SELECT * FROM `email_logs` ORDER BY `id` DESC LIMIT $limit");
            if ($result) {
                return $result;
            }
        }
        return self::readLogFile($limit);
    }

    public static function renderTemplate($template, $vars = [])
    {
        $path = self::templatePath($template);
        if (!file_exists($path)) {
            return '';
        }
        $safeVars = self::sanitizeVars($vars);
        foreach ($safeVars as $key => $value) {
            ${$key} = $value;
        }
        $config = self::config();
        $appName = $config['from_name'];
        $supportEmail = $config['reply_to'] !== '' ? $config['reply_to'] : $config['from_email'];

        ob_start();
        include $path;
        return ob_get_clean();
    }

    public static function toText($html)
    {
        return trim(html_entity_decode(strip_tags($html)));
    }

    public static function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private static function validateRecipients($recipients)
    {
        foreach ($recipients as $recipient) {
            if (!self::validateEmail($recipient)) {
                return false;
            }
        }
        return true;
    }

    private static function normalizeRecipients($recipients)
    {
        if (is_array($recipients)) {
            $list = $recipients;
        } else {
            $list = preg_split('/,\s*/', (string) $recipients);
        }
        $clean = [];
        foreach ($list as $recipient) {
            $value = trim($recipient);
            if ($value !== '') {
                $clean[] = $value;
            }
        }
        return array_values(array_unique($clean));
    }

    private static function buildMessage($toList, $subject, $html, $text, $options, $config)
    {
        $fromEmail = isset($options['from_email']) ? $options['from_email'] : $config['from_email'];
        $fromName = isset($options['from_name']) ? $options['from_name'] : $config['from_name'];
        $replyTo = isset($options['reply_to']) ? $options['reply_to'] : $config['reply_to'];
        $cc = isset($options['cc']) ? self::normalizeRecipients($options['cc']) : [];
        $bcc = isset($options['bcc']) ? self::normalizeRecipients($options['bcc']) : [];
        $attachments = isset($options['attachments']) ? $options['attachments'] : [];
        $headers = [];
        $headers['From'] = $fromName !== '' ? $fromName . " <{$fromEmail}>" : $fromEmail;
        if ($replyTo !== '') {
            $headers['Reply-To'] = $replyTo;
        }
        if (!empty($cc)) {
            $headers['Cc'] = implode(', ', $cc);
        }
        $headers['MIME-Version'] = '1.0';

        $encodedSubject = self::encodeHeader($subject);
        $body = '';
        if (!empty($attachments)) {
            $boundary = 'jx_mixed_' . md5(uniqid((string) mt_rand(), true));
            $altBoundary = 'jx_alt_' . md5(uniqid((string) mt_rand(), true));
            $headers['Content-Type'] = 'multipart/mixed; boundary="' . $boundary . '"';
            $body .= "--$boundary\r\n";
            $body .= "Content-Type: multipart/alternative; boundary=\"$altBoundary\"\r\n\r\n";
            $body .= self::buildAlternativeBody($html, $text, $altBoundary);
            foreach ($attachments as $attachment) {
                $body .= self::buildAttachmentPart($attachment, $boundary);
            }
            $body .= "--$boundary--";
        } elseif ($html !== '' && $text !== '') {
            $boundary = 'jx_alt_' . md5(uniqid((string) mt_rand(), true));
            $headers['Content-Type'] = 'multipart/alternative; boundary="' . $boundary . '"';
            $body = self::buildAlternativeBody($html, $text, $boundary);
        } elseif ($html !== '') {
            $headers['Content-Type'] = 'text/html; charset=UTF-8';
            $body = $html;
        } else {
            $headers['Content-Type'] = 'text/plain; charset=UTF-8';
            $body = $text;
        }

        if (!empty($bcc)) {
            $headers['Bcc'] = implode(', ', $bcc);
        }

        return [
            'to' => $toList,
            'subject' => $encodedSubject,
            'body' => $body,
            'headers' => $headers,
        ];
    }

    private static function buildAlternativeBody($html, $text, $boundary)
    {
        $part = "--$boundary\r\n";
        $part .= "Content-Type: text/plain; charset=UTF-8\r\n\r\n";
        $part .= $text . "\r\n";
        $part .= "--$boundary\r\n";
        $part .= "Content-Type: text/html; charset=UTF-8\r\n\r\n";
        $part .= $html . "\r\n";
        $part .= "--$boundary--\r\n";
        return $part;
    }

    private static function buildAttachmentPart($attachment, $boundary)
    {
        $path = isset($attachment['path']) ? $attachment['path'] : null;
        $name = isset($attachment['name']) ? $attachment['name'] : basename((string) $path);
        if (!$path || !is_readable($path)) {
            return '';
        }
        $content = chunk_split(base64_encode(file_get_contents($path)));
        $part = "--$boundary\r\n";
        $part .= "Content-Type: application/octet-stream; name=\"$name\"\r\n";
        $part .= "Content-Transfer-Encoding: base64\r\n";
        $part .= "Content-Disposition: attachment; filename=\"$name\"\r\n\r\n";
        $part .= $content . "\r\n";
        return $part;
    }

    private static function sendWithDriver($driver, $message, $config)
    {
        switch ($driver) {
            case 'smtp':
                return self::sendViaSmtp($message, $config);
            case 'php_mail':
                return self::sendViaPhpMail($message);
            case 'log':
            default:
                return self::sendViaLog($message, $config);
        }
    }

    private static function sendViaPhpMail($message)
    {
        $headers = self::flattenHeaders($message['headers']);
        $to = implode(', ', $message['to']);
        $subject = self::decodeHeader($message['subject']);
        $success = mail($to, $subject, $message['body'], $headers);
        if ($success) {
            return self::result(true, null);
        }
        return self::result(false, 'mail() failed to send.');
    }

    private static function sendViaLog($message, $config)
    {
        $logPath = self::rootPath('logs/email.log');
        $entry = [
            'timestamp' => date('c'),
            'to' => implode(', ', $message['to']),
            'subject' => self::decodeHeader($message['subject']),
            'headers' => $message['headers'],
            'body' => $message['body'],
            'driver' => $config['driver'],
        ];
        error_log(json_encode($entry) . PHP_EOL, 3, $logPath);
        return self::result(true, null);
    }

    private static function sendViaSmtp($message, $config)
    {
        $host = $config['host'];
        $port = (int) $config['port'];
        $encryption = $config['encryption'];
        $timeout = 10;

        $remote = $host . ':' . $port;
        if ($encryption === 'ssl') {
            $remote = 'ssl://' . $remote;
        }

        $fp = stream_socket_client($remote, $errno, $errstr, $timeout, STREAM_CLIENT_CONNECT);
        if (!$fp) {
            return self::result(false, "SMTP connect failed: $errstr ($errno)");
        }

        $response = self::smtpRead($fp);
        if (!self::smtpOk($response, [220])) {
            fclose($fp);
            return self::result(false, 'SMTP handshake failed.');
        }

        $hostname = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost';
        $response = self::smtpCommand($fp, 'EHLO ' . $hostname);
        if (!self::smtpOk($response, [250])) {
            $response = self::smtpCommand($fp, 'HELO ' . $hostname);
            if (!self::smtpOk($response, [250])) {
                fclose($fp);
                return self::result(false, 'SMTP HELO failed.');
            }
        }

        if ($encryption === 'tls') {
            $response = self::smtpCommand($fp, 'STARTTLS');
            if (!self::smtpOk($response, [220])) {
                fclose($fp);
                return self::result(false, 'SMTP STARTTLS failed.');
            }
            if (!stream_socket_enable_crypto($fp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
                fclose($fp);
                return self::result(false, 'SMTP TLS negotiation failed.');
            }
            $response = self::smtpCommand($fp, 'EHLO ' . $hostname);
            if (!self::smtpOk($response, [250])) {
                fclose($fp);
                return self::result(false, 'SMTP EHLO after TLS failed.');
            }
        }

        if ($config['username'] !== '') {
            $response = self::smtpCommand($fp, 'AUTH LOGIN');
            if (!self::smtpOk($response, [334])) {
                fclose($fp);
                return self::result(false, 'SMTP AUTH not accepted.');
            }
            $response = self::smtpCommand($fp, base64_encode($config['username']));
            if (!self::smtpOk($response, [334])) {
                fclose($fp);
                return self::result(false, 'SMTP username rejected.');
            }
            $response = self::smtpCommand($fp, base64_encode($config['password']));
            if (!self::smtpOk($response, [235])) {
                fclose($fp);
                return self::result(false, 'SMTP password rejected.');
            }
        }

        $fromHeader = $message['headers']['From'];
        preg_match('/<(.+)>/', $fromHeader, $matches);
        $fromEmail = $matches ? $matches[1] : $fromHeader;
        $response = self::smtpCommand($fp, 'MAIL FROM:<' . $fromEmail . '>');
        if (!self::smtpOk($response, [250])) {
            fclose($fp);
            return self::result(false, 'SMTP MAIL FROM failed.');
        }

        $recipients = $message['to'];
        if (isset($message['headers']['Cc'])) {
            $recipients = array_merge($recipients, self::normalizeRecipients($message['headers']['Cc']));
        }
        if (isset($message['headers']['Bcc'])) {
            $recipients = array_merge($recipients, self::normalizeRecipients($message['headers']['Bcc']));
        }

        foreach ($recipients as $recipient) {
            $response = self::smtpCommand($fp, 'RCPT TO:<' . $recipient . '>');
            if (!self::smtpOk($response, [250, 251])) {
                fclose($fp);
                return self::result(false, 'SMTP RCPT TO failed for ' . $recipient . '.');
            }
        }

        $response = self::smtpCommand($fp, 'DATA');
        if (!self::smtpOk($response, [354])) {
            fclose($fp);
            return self::result(false, 'SMTP DATA command rejected.');
        }

        $headers = self::flattenHeaders($message['headers']);
        $payload = 'Subject: ' . self::decodeHeader($message['subject']) . "\r\n" . $headers . "\r\n\r\n" . $message['body'] . "\r\n.";
        fwrite($fp, $payload . "\r\n");
        $response = self::smtpRead($fp);
        if (!self::smtpOk($response, [250])) {
            fclose($fp);
            return self::result(false, 'SMTP message not accepted.');
        }

        self::smtpCommand($fp, 'QUIT');
        fclose($fp);

        return self::result(true, null);
    }

    private static function smtpRead($fp)
    {
        $data = '';
        while ($str = fgets($fp, 515)) {
            $data .= $str;
            if (substr($str, 3, 1) === ' ') {
                break;
            }
        }
        return $data;
    }

    private static function smtpCommand($fp, $command)
    {
        fwrite($fp, $command . "\r\n");
        return self::smtpRead($fp);
    }

    private static function smtpOk($response, $codes)
    {
        $code = (int) substr(trim($response), 0, 3);
        return in_array($code, $codes, true);
    }

    private static function sanitizeVars($vars)
    {
        $safe = [];
        foreach ($vars as $key => $value) {
            if (is_scalar($value) || $value === null) {
                $safe[$key] = htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
            } else {
                $safe[$key] = htmlspecialchars(json_encode($value), ENT_QUOTES, 'UTF-8');
            }
        }
        return $safe;
    }

    private static function flattenHeaders($headers)
    {
        $lines = [];
        foreach ($headers as $name => $value) {
            $lines[] = $name . ': ' . $value;
        }
        return implode("\r\n", $lines);
    }

    private static function encodeHeader($text)
    {
        if (function_exists('mb_encode_mimeheader')) {
            return mb_encode_mimeheader($text, 'UTF-8');
        }
        return $text;
    }

    private static function decodeHeader($text)
    {
        return $text;
    }

    private static function result($success, $error = null, $data = [])
    {
        return [
            'success' => $success,
            'error' => $error,
            'data' => $data,
        ];
    }

    private static function db()
    {
        global $JX_db;
        return $JX_db;
    }

    private static function escape($value)
    {
        $db = self::db();
        if ($db) {
            return $db->real_escape_string($value);
        }
        return addslashes($value);
    }

    private static function ensureLogTable()
    {
        $db = self::db();
        if (!$db) {
            return false;
        }
        $sql = "CREATE TABLE IF NOT EXISTS `email_logs` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `recipient` TEXT NOT NULL,
            `subject` VARCHAR(255) NOT NULL,
            `template` VARCHAR(120) DEFAULT NULL,
            `driver` VARCHAR(40) DEFAULT NULL,
            `status` VARCHAR(20) NOT NULL,
            `error_message` TEXT,
            `meta` TEXT,
            `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        )";
        return (bool) $db->query($sql);
    }

    private static function ensureQueueTable()
    {
        $db = self::db();
        if (!$db) {
            return false;
        }
        $sql = "CREATE TABLE IF NOT EXISTS `email_queue` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `recipient` TEXT NOT NULL,
            `subject` VARCHAR(255) NOT NULL,
            `html` LONGTEXT,
            `text` LONGTEXT,
            `options` LONGTEXT,
            `template` VARCHAR(120) DEFAULT NULL,
            `status` VARCHAR(20) NOT NULL DEFAULT 'pending',
            `attempts` INT NOT NULL DEFAULT 0,
            `last_error` TEXT,
            `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `sent_at` DATETIME DEFAULT NULL
        )";
        return (bool) $db->query($sql);
    }

    private static function insertQueue($queueData)
    {
        $db = self::db();
        if (!$db) {
            return self::result(false, 'Database not available.');
        }
        if (!self::ensureQueueTable()) {
            return self::result(false, 'Queue table not available.');
        }

        $recipient = self::escape($queueData['to']);
        $subject = self::escape($queueData['subject']);
        $html = self::escape($queueData['html']);
        $text = self::escape($queueData['text']);
        $options = self::escape($queueData['options']);
        $template = self::escape($queueData['template']);
        $status = self::escape($queueData['status']);
        $attempts = (int) $queueData['attempts'];

        $sql = "INSERT INTO `email_queue` (`recipient`, `subject`, `html`, `text`, `options`, `template`, `status`, `attempts`) VALUES ('$recipient', '$subject', '$html', '$text', '$options', '$template', '$status', $attempts)";
        if ($db->query($sql)) {
            return self::result(true, null, ['id' => $db->insert_id]);
        }
        return self::result(false, 'Unable to queue email.');
    }

    private static function markQueueSent($id)
    {
        $db = self::db();
        if (!$db) {
            return false;
        }
        $id = (int) $id;
        return (bool) $db->query("UPDATE `email_queue` SET `status`='sent', `sent_at`=CURRENT_TIMESTAMP WHERE `id`=$id");
    }

    private static function markQueueFailed($id, $error)
    {
        $db = self::db();
        if (!$db) {
            return false;
        }
        $id = (int) $id;
        $error = self::escape($error);
        return (bool) $db->query("UPDATE `email_queue` SET `status`='failed', `last_error`='$error', `attempts`=`attempts`+1 WHERE `id`=$id");
    }

    private static function logAttempt($data)
    {
        $db = self::db();
        $data['error'] = $data['error'] ?: null;
        if ($db && self::ensureLogTable()) {
            $recipient = self::escape($data['to']);
            $subject = self::escape($data['subject']);
            $template = self::escape($data['template']);
            $driver = self::escape($data['driver']);
            $status = self::escape($data['status']);
            $error = $data['error'] ? self::escape($data['error']) : null;
            $meta = $data['meta'] ? self::escape(json_encode($data['meta'])) : null;

            $sql = "INSERT INTO `email_logs` (`recipient`, `subject`, `template`, `driver`, `status`, `error_message`, `meta`) VALUES ('$recipient', '$subject', '$template', '$driver', '$status', " . ($error ? "'$error'" : 'NULL') . ', ' . ($meta ? "'$meta'" : 'NULL') . ')';
            $db->query($sql);
            return;
        }

        $logPath = self::rootPath('logs/email.log');
        $entry = [
            'timestamp' => date('c'),
            'to' => $data['to'],
            'subject' => $data['subject'],
            'template' => $data['template'],
            'driver' => $data['driver'],
            'status' => $data['status'],
            'error' => $data['error'],
            'meta' => $data['meta'],
        ];
        error_log(json_encode($entry) . PHP_EOL, 3, $logPath);
    }

    private static function readLogFile($limit)
    {
        $path = self::rootPath('logs/email.log');
        if (!file_exists($path)) {
            return [];
        }
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $lines = array_slice($lines, -$limit);
        $entries = [];
        foreach (array_reverse($lines) as $line) {
            $decoded = json_decode($line, true);
            if ($decoded) {
                $entries[] = $decoded;
            }
        }
        return $entries;
    }

    private static function templatePath($template)
    {
        $template = str_replace(['..', '/'], '', $template);
        return self::rootPath('containers/email/templates/' . $template . '.php');
    }
}
