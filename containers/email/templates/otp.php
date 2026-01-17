<?php include __DIR__ . '/../partials/header.php'; ?>
<p style="margin-top: 0;">Hi <?php echo isset($name) ? $name : 'there'; ?>,</p>
<p>Your verification code is:</p>
<p style="font-size: 24px; font-weight: bold; letter-spacing: 4px;"><?php echo isset($code) ? $code : '000000'; ?></p>
<p>This code expires in 10 minutes. If you did not request it, please contact support.</p>
<?php include __DIR__ . '/../partials/footer.php'; ?>
