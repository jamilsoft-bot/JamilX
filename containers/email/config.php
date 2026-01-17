<?php
$host = $config['host'];
$maskedHost = $host !== '' ? substr($host, 0, 2) . str_repeat('*', max(strlen($host) - 4, 2)) . substr($host, -2) : 'Not configured';
$maskedUser = $config['username'] !== '' ? substr($config['username'], 0, 2) . '***' : 'Not configured';
$maskedPassword = $config['password'] !== '' ? str_repeat('*', 8) : 'Not configured';
?>
<div class="w3-card w3-padding">
    <h4>Configuration Status</h4>
    <table class="w3-table w3-bordered">
        <tr>
            <td><strong>Driver</strong></td>
            <td><?php echo htmlspecialchars($config['driver'], ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <tr>
            <td><strong>SMTP Host</strong></td>
            <td><?php echo htmlspecialchars($maskedHost, ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <tr>
            <td><strong>SMTP Port</strong></td>
            <td><?php echo htmlspecialchars((string) $config['port'], ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <tr>
            <td><strong>Encryption</strong></td>
            <td><?php echo htmlspecialchars($config['encryption'], ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <tr>
            <td><strong>SMTP Username</strong></td>
            <td><?php echo htmlspecialchars($maskedUser, ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <tr>
            <td><strong>SMTP Password</strong></td>
            <td><?php echo htmlspecialchars($maskedPassword, ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <tr>
            <td><strong>From</strong></td>
            <td><?php echo htmlspecialchars($config['from_name'], ENT_QUOTES, 'UTF-8'); ?> &lt;<?php echo htmlspecialchars($config['from_email'], ENT_QUOTES, 'UTF-8'); ?>&gt;</td>
        </tr>
        <tr>
            <td><strong>Reply-To</strong></td>
            <td><?php echo htmlspecialchars($config['reply_to'] !== '' ? $config['reply_to'] : 'Not configured', ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <tr>
            <td><strong>Debug Mode</strong></td>
            <td><?php echo $config['debug'] ? 'Enabled' : 'Disabled'; ?></td>
        </tr>
    </table>

    <div class="w3-panel w3-pale-blue w3-border w3-round-large w3-margin-top">
        <p>Configure these values in the <code>.env</code> file. SMTP passwords are never shown in the UI.</p>
    </div>
</div>
