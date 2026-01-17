<?php
$isArray = is_array($emailLogs);
?>
<div class="w3-card w3-padding">
    <h4>Recent Email Logs</h4>
    <div class="w3-responsive">
        <table class="w3-table w3-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Recipient</th>
                    <th>Subject</th>
                    <th>Template</th>
                    <th>Status</th>
                    <th>Error</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($isArray && empty($emailLogs)): ?>
                <tr><td colspan="6">No logs found.</td></tr>
            <?php elseif ($isArray): ?>
                <?php foreach ($emailLogs as $log): ?>
                    <tr>
                        <td><?php echo htmlspecialchars(isset($log['timestamp']) ? $log['timestamp'] : '', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars(isset($log['to']) ? $log['to'] : '', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars(isset($log['subject']) ? $log['subject'] : '', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars(isset($log['template']) ? $log['template'] : 'custom', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars(isset($log['status']) ? $log['status'] : 'logged', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars(isset($log['error']) ? $log['error'] : '', ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <?php foreach ($emailLogs as $log): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($log['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($log['recipient'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($log['subject'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($log['template'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($log['status'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($log['error_message'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
