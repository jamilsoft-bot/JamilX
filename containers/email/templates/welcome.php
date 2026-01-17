<?php include __DIR__ . '/../partials/header.php'; ?>
<p style="margin-top: 0;">Hi <?php echo isset($name) ? $name : 'there'; ?>,</p>
<p>Welcome to <?php echo $appName; ?>! We're excited to have you on board.</p>
<p>Use the link below to explore your dashboard and get started:</p>
<p><a href="<?php echo isset($action_url) ? $action_url : '#'; ?>" style="display: inline-block; padding: 10px 16px; background: #1d4ed8; color: #fff; text-decoration: none; border-radius: 4px;">Visit your account</a></p>
<p>If you have any questions, just reply to this email.</p>
<?php include __DIR__ . '/../partials/footer.php'; ?>
