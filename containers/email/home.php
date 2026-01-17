<?php
$config = Email::config();
$driver = $config['driver'];
?>
<div class="w3-card w3-padding">
    <h4>Email Service Overview</h4>
    <p>The JamilX Email module provides SMTP, PHP mail, and log drivers with a unified API. Use the navigation to configure, test, and monitor email delivery.</p>
    <div class="row">
        <div class="col-md-6">
            <div class="w3-panel w3-border w3-round-large">
                <p><strong>Active Driver:</strong> <?php echo htmlspecialchars($driver, ENT_QUOTES, 'UTF-8'); ?></p>
                <p><strong>From:</strong> <?php echo htmlspecialchars($config['from_name'], ENT_QUOTES, 'UTF-8'); ?> &lt;<?php echo htmlspecialchars($config['from_email'], ENT_QUOTES, 'UTF-8'); ?>&gt;</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="w3-panel w3-border w3-round-large">
                <p><strong>Quick Links</strong></p>
                <ul>
                    <li><a href="?action=emailconfig">View configuration status</a></li>
                    <li><a href="?action=emailtest">Send a test email</a></li>
                    <li><a href="?action=emaillogs">Review email logs</a></li>
                    <li><a href="?action=emailqueue">Check the queue</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
