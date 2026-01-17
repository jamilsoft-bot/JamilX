<?php include __DIR__ . '/../partials/header.php'; ?>
<p style="margin-top: 0;">Hello <?php echo isset($name) ? $name : 'there'; ?>,</p>
<p><?php echo isset($message) ? $message : 'You have a new notification from ' . $appName . '.'; ?></p>
<?php if (isset($action_url) && $action_url !== ''): ?>
    <p><a href="<?php echo $action_url; ?>" style="color: #1d4ed8;">View details</a></p>
<?php endif; ?>
<?php include __DIR__ . '/../partials/footer.php'; ?>
