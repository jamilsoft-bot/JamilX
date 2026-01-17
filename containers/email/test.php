<?php
$templates = [
    'custom' => 'Custom message',
    'welcome' => 'Welcome Email',
    'password-reset' => 'Password Reset',
    'otp' => 'OTP / Verification',
    'notification' => 'Notification',
];
$toValue = isset($_POST['to']) ? htmlspecialchars($_POST['to'], ENT_QUOTES, 'UTF-8') : '';
$subjectValue = isset($_POST['subject']) ? htmlspecialchars($_POST['subject'], ENT_QUOTES, 'UTF-8') : '';
$messageValue = isset($_POST['message']) ? htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8') : '';
$replyValue = isset($_POST['reply_to']) ? htmlspecialchars($_POST['reply_to'], ENT_QUOTES, 'UTF-8') : '';
$modeValue = isset($_POST['mode']) ? $_POST['mode'] : 'send';
$templateValue = isset($_POST['template']) ? $_POST['template'] : 'custom';
?>
<div class="w3-card w3-padding">
    <form method="post">
        <div class="row">
            <div class="col-md-6 w3-margin-bottom">
                <label class="w3-text-grey">To</label>
                <input type="email" name="to" class="w3-input w3-border" required value="<?php echo $toValue; ?>">
            </div>
            <div class="col-md-6 w3-margin-bottom">
                <label class="w3-text-grey">Reply-To (optional)</label>
                <input type="email" name="reply_to" class="w3-input w3-border" value="<?php echo $replyValue; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 w3-margin-bottom">
                <label class="w3-text-grey">Subject</label>
                <input type="text" name="subject" class="w3-input w3-border" required value="<?php echo $subjectValue; ?>">
            </div>
            <div class="col-md-6 w3-margin-bottom">
                <label class="w3-text-grey">Mode</label>
                <select name="mode" class="w3-select w3-border">
                    <option value="send" <?php echo $modeValue === 'send' ? 'selected' : ''; ?>>Send now</option>
                    <option value="queue" <?php echo $modeValue === 'queue' ? 'selected' : ''; ?>>Queue for delivery</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 w3-margin-bottom">
                <label class="w3-text-grey">Template</label>
                <select name="template" class="w3-select w3-border">
                    <?php foreach ($templates as $value => $label): ?>
                        <option value="<?php echo $value; ?>" <?php echo $templateValue === $value ? 'selected' : ''; ?>><?php echo $label; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6 w3-margin-bottom">
                <label class="w3-text-grey">Message (for custom template)</label>
                <textarea name="message" class="w3-input w3-border" rows="4"><?php echo $messageValue; ?></textarea>
            </div>
        </div>
        <button type="submit" name="send_test" class="w3-button w3-blue">Send Test Email</button>
    </form>
</div>
