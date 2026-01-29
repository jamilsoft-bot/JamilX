<?php
$currentStatus = isset($_GET['status']) ? $_GET['status'] : 'all';
?>
<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex flex-wrap gap-2">
        <a href="?action=emailqueue" class="rounded-full px-4 py-2 text-sm font-semibold <?php echo $currentStatus === 'all' ? 'bg-blue-600 text-white' : 'border border-slate-200 text-slate-600 hover:bg-slate-50'; ?>">All</a>
        <a href="?action=emailqueue&status=pending" class="rounded-full px-4 py-2 text-sm font-semibold <?php echo $currentStatus === 'pending' ? 'bg-blue-600 text-white' : 'border border-slate-200 text-slate-600 hover:bg-slate-50'; ?>">Pending</a>
        <a href="?action=emailqueue&status=sent" class="rounded-full px-4 py-2 text-sm font-semibold <?php echo $currentStatus === 'sent' ? 'bg-blue-600 text-white' : 'border border-slate-200 text-slate-600 hover:bg-slate-50'; ?>">Sent</a>
        <a href="?action=emailqueue&status=failed" class="rounded-full px-4 py-2 text-sm font-semibold <?php echo $currentStatus === 'failed' ? 'bg-blue-600 text-white' : 'border border-slate-200 text-slate-600 hover:bg-slate-50'; ?>">Failed</a>
    </div>

    <?php if (isset($queueView) && $queueView): ?>
        <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 p-5 text-sm text-slate-600">
            <h5 class="text-base font-semibold text-slate-900">Queue Payload: #<?php echo htmlspecialchars($queueView['id'], ENT_QUOTES, 'UTF-8'); ?></h5>
            <p class="mt-2"><strong>Recipient:</strong> <?php echo htmlspecialchars($queueView['recipient'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Subject:</strong> <?php echo htmlspecialchars($queueView['subject'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Template:</strong> <?php echo htmlspecialchars($queueView['template'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="mt-3 font-semibold text-slate-700">Options</p>
            <pre class="mt-2 rounded-lg bg-white p-3 text-xs text-slate-500"><?php echo htmlspecialchars($queueView['options'], ENT_QUOTES, 'UTF-8'); ?></pre>
            <p class="mt-3 font-semibold text-slate-700">HTML</p>
            <pre class="mt-2 rounded-lg bg-white p-3 text-xs text-slate-500"><?php echo htmlspecialchars($queueView['html'], ENT_QUOTES, 'UTF-8'); ?></pre>
            <p class="mt-3 font-semibold text-slate-700">Text</p>
            <pre class="mt-2 rounded-lg bg-white p-3 text-xs text-slate-500"><?php echo htmlspecialchars($queueView['text'], ENT_QUOTES, 'UTF-8'); ?></pre>
        </div>
    <?php endif; ?>

    <div class="mt-6 overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Recipient</th>
                    <th class="px-4 py-3">Subject</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Attempts</th>
                    <th class="px-4 py-3">Last Error</th>
                    <th class="px-4 py-3">Created</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
            <?php if (!$emailQueue || (is_array($emailQueue) && empty($emailQueue))): ?>
                <tr><td colspan="8" class="px-4 py-6 text-center text-slate-500">No queue entries found.</td></tr>
            <?php else: ?>
                <?php foreach ($emailQueue as $queue): ?>
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 font-semibold text-slate-900"><?php echo htmlspecialchars($queue['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="px-4 py-3 text-slate-600"><?php echo htmlspecialchars($queue['recipient'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="px-4 py-3 text-slate-600"><?php echo htmlspecialchars($queue['subject'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="px-4 py-3 text-slate-600"><?php echo htmlspecialchars($queue['status'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="px-4 py-3 text-slate-600"><?php echo htmlspecialchars($queue['attempts'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="px-4 py-3 text-slate-600"><?php echo htmlspecialchars($queue['last_error'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="px-4 py-3 text-slate-600"><?php echo htmlspecialchars($queue['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="px-4 py-3">
                            <div class="flex flex-wrap gap-2">
                                <a href="?action=emailqueue&view=<?php echo $queue['id']; ?>" class="rounded-lg border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-50">View</a>
                                <?php if ($queue['status'] === 'failed'): ?>
                                    <a href="?action=emailqueue&retry=<?php echo $queue['id']; ?>" class="rounded-lg bg-emerald-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-emerald-700">Retry</a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
