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
<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
    <form method="post" class="space-y-6">
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <label class="text-sm font-semibold text-slate-700">To</label>
                <input type="email" name="to" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" required value="<?php echo $toValue; ?>">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">Reply-To (optional)</label>
                <input type="email" name="reply_to" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" value="<?php echo $replyValue; ?>">
            </div>
        </div>
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <label class="text-sm font-semibold text-slate-700">Subject</label>
                <input type="text" name="subject" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" required value="<?php echo $subjectValue; ?>">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">Mode</label>
                <select name="mode" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    <option value="send" <?php echo $modeValue === 'send' ? 'selected' : ''; ?>>Send now</option>
                    <option value="queue" <?php echo $modeValue === 'queue' ? 'selected' : ''; ?>>Queue for delivery</option>
                </select>
            </div>
        </div>
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <label class="text-sm font-semibold text-slate-700">Template</label>
                <select name="template" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    <?php foreach ($templates as $value => $label): ?>
                        <option value="<?php echo $value; ?>" <?php echo $templateValue === $value ? 'selected' : ''; ?>><?php echo $label; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">Message (for custom template)</label>
                <textarea name="message" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" rows="4"><?php echo $messageValue; ?></textarea>
            </div>
        </div>
        <button type="submit" name="send_test" class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">Send Test Email</button>
    </form>
</div>
