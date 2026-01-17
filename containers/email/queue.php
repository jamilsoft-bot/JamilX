<?php
$currentStatus = isset($_GET['status']) ? $_GET['status'] : 'all';
?>
<div class="w3-card w3-padding">
    <div class="w3-bar w3-margin-bottom">
        <a href="?action=emailqueue" class="w3-bar-item w3-button <?php echo $currentStatus === 'all' ? 'w3-blue' : ''; ?>">All</a>
        <a href="?action=emailqueue&status=pending" class="w3-bar-item w3-button <?php echo $currentStatus === 'pending' ? 'w3-blue' : ''; ?>">Pending</a>
        <a href="?action=emailqueue&status=sent" class="w3-bar-item w3-button <?php echo $currentStatus === 'sent' ? 'w3-blue' : ''; ?>">Sent</a>
        <a href="?action=emailqueue&status=failed" class="w3-bar-item w3-button <?php echo $currentStatus === 'failed' ? 'w3-blue' : ''; ?>">Failed</a>
    </div>

    <?php if (isset($queueView) && $queueView): ?>
        <div class="w3-panel w3-light-grey w3-border w3-round-large w3-margin-bottom">
            <h5>Queue Payload: #<?php echo htmlspecialchars($queueView['id'], ENT_QUOTES, 'UTF-8'); ?></h5>
            <p><strong>Recipient:</strong> <?php echo htmlspecialchars($queueView['recipient'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Subject:</strong> <?php echo htmlspecialchars($queueView['subject'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Template:</strong> <?php echo htmlspecialchars($queueView['template'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Options:</strong></p>
            <pre><?php echo htmlspecialchars($queueView['options'], ENT_QUOTES, 'UTF-8'); ?></pre>
            <p><strong>HTML:</strong></p>
            <pre><?php echo htmlspecialchars($queueView['html'], ENT_QUOTES, 'UTF-8'); ?></pre>
            <p><strong>Text:</strong></p>
            <pre><?php echo htmlspecialchars($queueView['text'], ENT_QUOTES, 'UTF-8'); ?></pre>
        </div>
    <?php endif; ?>

    <div class="w3-responsive">
        <table class="w3-table w3-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Recipient</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Attempts</th>
                    <th>Last Error</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!$emailQueue || (is_array($emailQueue) && empty($emailQueue))): ?>
                <tr><td colspan="8">No queue entries found.</td></tr>
            <?php else: ?>
                <?php foreach ($emailQueue as $queue): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($queue['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($queue['recipient'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($queue['subject'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($queue['status'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($queue['attempts'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($queue['last_error'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($queue['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <a href="?action=emailqueue&view=<?php echo $queue['id']; ?>" class="w3-button w3-small w3-light-grey">View</a>
                            <?php if ($queue['status'] === 'failed'): ?>
                                <a href="?action=emailqueue&retry=<?php echo $queue['id']; ?>" class="w3-button w3-small w3-green">Retry</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
