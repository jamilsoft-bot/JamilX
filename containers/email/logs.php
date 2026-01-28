<?php
$isArray = is_array($emailLogs);
?>
<div class="bg-white shadow-sm rounded-lg border border-slate-200 overflow-hidden">
    <div class="px-4 py-5 sm:px-6 bg-slate-50 border-b border-slate-200 flex justify-between items-center">
        <div>
            <h3 class="text-lg leading-6 font-medium text-slate-900">Recent Email Logs</h3>
            <p class="mt-1 max-w-2xl text-sm text-slate-500">History of all email delivery attempts.</p>
        </div>
        <button onclick="window.location.reload()" class="text-slate-400 hover:text-slate-600 transition">
            <i class="fas fa-sync-alt"></i>
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Date</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Recipient</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Subject</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Template</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Error</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                <?php if ($isArray && empty($emailLogs)): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-sm text-slate-500">
                            <i class="fas fa-inbox text-4xl text-slate-200 mb-3 block"></i>
                            No logs found.
                        </td>
                    </tr>
                <?php elseif ($isArray): ?>
                    <?php foreach ($emailLogs as $log): ?>
                        <?php
                        $status = isset($log['status']) ? strtolower($log['status']) : 'logged';
                        $statusColor = 'bg-slate-100 text-slate-800'; // Default
                        if (strpos($status, 'sent') !== false || strpos($status, 'success') !== false) $statusColor = 'bg-green-100 text-green-800';
                        if (strpos($status, 'fail') !== false || strpos($status, 'error') !== false) $statusColor = 'bg-red-100 text-red-800';
                        if (strpos($status, 'queued') !== false) $statusColor = 'bg-yellow-100 text-yellow-800';
                        ?>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                <?php echo htmlspecialchars(isset($log['timestamp']) ? $log['timestamp'] : '', ENT_QUOTES, 'UTF-8'); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                <?php echo htmlspecialchars(isset($log['to']) ? $log['to'] : '', ENT_QUOTES, 'UTF-8'); ?>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500 truncate max-w-xs" title="<?php echo htmlspecialchars(isset($log['subject']) ? $log['subject'] : '', ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars(isset($log['subject']) ? $log['subject'] : '', ENT_QUOTES, 'UTF-8'); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-800">
                                    <?php echo htmlspecialchars(isset($log['template']) ? $log['template'] : 'custom', ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $statusColor; ?>">
                                    <?php echo htmlspecialchars(isset($log['status']) ? $log['status'] : 'logged', ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-red-600 truncate max-w-xs" title="<?php echo htmlspecialchars(isset($log['error']) ? $log['error'] : '', ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars(isset($log['error']) ? $log['error'] : '', ENT_QUOTES, 'UTF-8'); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Database Model Fallback -->
                    <?php foreach ($emailLogs as $log): ?>
                        <?php
                        $status = strtolower($log['status']);
                        $statusColor = 'bg-slate-100 text-slate-800';
                        if (strpos($status, 'sent') !== false) $statusColor = 'bg-green-100 text-green-800';
                        if (strpos($status, 'fail') !== false) $statusColor = 'bg-red-100 text-red-800';
                        ?>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500"><?php echo htmlspecialchars($log['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900"><?php echo htmlspecialchars($log['recipient'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="px-6 py-4 text-sm text-slate-500 truncate max-w-xs"><?php echo htmlspecialchars($log['subject'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-800">
                                    <?php echo htmlspecialchars($log['template'], ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $statusColor; ?>">
                                    <?php echo htmlspecialchars($log['status'], ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-red-600 truncate max-w-xs"><?php echo htmlspecialchars($log['error_message'], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>