<?php
$config = Email::config();
$driver = $config['driver'];
?>

<!-- Overview Stats -->
<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 mb-8">
    <!-- Active Driver Card -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                        <i class="fas fa-server text-xl"></i>
                    </span>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-slate-500 truncate">Active Driver</dt>
                        <dd>
                            <div class="text-lg font-medium text-slate-900 capitalize"><?php echo htmlspecialchars($driver, ENT_QUOTES, 'UTF-8'); ?></div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-slate-50 px-5 py-3">
            <div class="text-sm">
                <a href="?action=emailconfig" class="font-medium text-blue-600 hover:text-blue-500">Configure driver</a>
            </div>
        </div>
    </div>

    <!-- From Address Card -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                        <i class="fas fa-at text-xl"></i>
                    </span>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-slate-500 truncate">Sending From</dt>
                        <dd>
                            <div class="text-lg font-medium text-slate-900 truncate" title="<?php echo htmlspecialchars($config['from_email'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars($config['from_name'], ENT_QUOTES, 'UTF-8'); ?>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-slate-50 px-5 py-3">
            <div class="text-sm text-slate-500 truncate">
                <?php echo htmlspecialchars($config['from_email'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        </div>
    </div>

    <!-- Status Card -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="h-12 w-12 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600">
                        <i class="fas fa-heartbeat text-xl"></i>
                    </span>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-slate-500 truncate">System Status</dt>
                        <dd>
                            <div class="text-lg font-medium text-slate-900">Operational</div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-slate-50 px-5 py-3">
            <div class="text-sm">
                <a href="?action=emailselftest" class="font-medium text-blue-600 hover:text-blue-500">Run Diagnostics</a>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Area: Quick Links or recent activity could go here -->
<div class="bg-white shadow sm:rounded-lg">
    <div class="px-4 py-5 sm:p-6">
        <h3 class="text-base font-semibold leading-6 text-slate-900">Email Service Dashboard</h3>
        <div class="mt-2 max-w-xl text-sm text-slate-500">
            <p>Select an action to manage your email infrastructure.</p>
        </div>
        <div class="mt-5 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <a href="?action=emailtest" class="relative block w-full rounded-lg border-2 border-dashed border-slate-300 p-6 text-center hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 hover:bg-slate-50 transition">
                <i class="fas fa-paper-plane text-3xl text-slate-400 mx-auto mb-2"></i>
                <span class="block text-sm font-semibold text-slate-900">Send Test Email</span>
            </a>
            <a href="?action=emaillogs" class="relative block w-full rounded-lg border-2 border-dashed border-slate-300 p-6 text-center hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 hover:bg-slate-50 transition">
                <i class="fas fa-list-ul text-3xl text-slate-400 mx-auto mb-2"></i>
                <span class="block text-sm font-semibold text-slate-900">View Logs</span>
            </a>
            <a href="?action=emailqueue" class="relative block w-full rounded-lg border-2 border-dashed border-slate-300 p-6 text-center hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 hover:bg-slate-50 transition">
                <i class="fas fa-tasks text-3xl text-slate-400 mx-auto mb-2"></i>
                <span class="block text-sm font-semibold text-slate-900">Manage Queue</span>
            </a>
        </div>
    </div>
</div>