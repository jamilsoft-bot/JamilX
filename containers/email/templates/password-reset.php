<?php include __DIR__ . '/../partials/header.php'; ?>
<p style="margin-top: 0;">Hi <?php echo isset($name) ? $name : 'there'; ?>,</p>
<p>We received a request to reset your password.</p>
<p>Use the button below to reset it securely:</p>
<p><a href="<?php echo isset($action_url) ? $action_url : '#'; ?>" style="display: inline-block; padding: 10px 16px; background: #dc2626; color: #fff; text-decoration: none; border-radius: 4px;">Reset password</a></p>
<p>If you did not request this, you can safely ignore this email.</p>
<?php include __DIR__ . '/../partials/footer.php'; ?>
