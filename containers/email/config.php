<?php
$host = $config['host'];
$maskedHost = $host !== '' ? substr($host, 0, 2) . str_repeat('*', max(strlen($host) - 4, 2)) . substr($host, -2) : 'Not configured';
$maskedUser = $config['username'] !== '' ? substr($config['username'], 0, 2) . '***' : 'Not configured';
$maskedPassword = $config['password'] !== '' ? str_repeat('*', 8) : 'Not configured';
?>
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">
        <h4 class="text-lg font-semibold text-slate-900">Configuration Status</h4>
        <p class="text-sm text-slate-500">View the current email configuration and masked credentials.</p>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <tbody class="divide-y divide-slate-100">
                <tr>
                    <td class="px-6 py-4 font-semibold text-slate-600">Driver</td>
                    <td class="px-6 py-4 text-slate-700"><?php echo htmlspecialchars($config['driver'], ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <td class="px-6 py-4 font-semibold text-slate-600">SMTP Host</td>
                    <td class="px-6 py-4 text-slate-700"><?php echo htmlspecialchars($maskedHost, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <td class="px-6 py-4 font-semibold text-slate-600">SMTP Port</td>
                    <td class="px-6 py-4 text-slate-700"><?php echo htmlspecialchars((string) $config['port'], ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <td class="px-6 py-4 font-semibold text-slate-600">Encryption</td>
                    <td class="px-6 py-4 text-slate-700"><?php echo htmlspecialchars($config['encryption'], ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <td class="px-6 py-4 font-semibold text-slate-600">SMTP Username</td>
                    <td class="px-6 py-4 text-slate-700"><?php echo htmlspecialchars($maskedUser, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <td class="px-6 py-4 font-semibold text-slate-600">SMTP Password</td>
                    <td class="px-6 py-4 text-slate-700"><?php echo htmlspecialchars($maskedPassword, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <td class="px-6 py-4 font-semibold text-slate-600">From</td>
                    <td class="px-6 py-4 text-slate-700"><?php echo htmlspecialchars($config['from_name'], ENT_QUOTES, 'UTF-8'); ?> &lt;<?php echo htmlspecialchars($config['from_email'], ENT_QUOTES, 'UTF-8'); ?>&gt;</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 font-semibold text-slate-600">Reply-To</td>
                    <td class="px-6 py-4 text-slate-700"><?php echo htmlspecialchars($config['reply_to'] !== '' ? $config['reply_to'] : 'Not configured', ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <td class="px-6 py-4 font-semibold text-slate-600">Debug Mode</td>
                    <td class="px-6 py-4 text-slate-700"><?php echo $config['debug'] ? 'Enabled' : 'Disabled'; ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="rounded-b-2xl border-t border-slate-200 bg-blue-50 px-6 py-4 text-sm text-blue-700">
        Configure these values in the <code>.env</code> file. SMTP passwords are never shown in the UI.
    </div>
</div>
