<?php
global $Url, $Apps;

$appNick = $Url->get('app');
$appData = null;

if ($appNick && class_exists('Apps')) {
    $allApps = $Apps->getAll();
    foreach ($allApps as $app) {
        if ($app['Nick'] === $appNick) {
            $appData = $app;
            break;
        }
    }
}

if (!$appData) {
    echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg'>
            <strong class='font-bold'>Error:</strong> App not found.
          </div>";
    return;
}

$isInstalled = $Apps->isInstalled($appNick);
?>

<!-- Back Button -->
<div class="mb-6">
    <a href="?serve=appdev&action=list" class="inline-flex items-center gap-2 text-slate-600 hover:text-slate-900">
        <i class="fas fa-arrow-left"></i> Back to Apps
    </a>
</div>

<!-- App Header -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 mb-6">
    <div class="flex items-start justify-between">
        <div class="flex items-start gap-6">
            <div class="bg-gradient-to-br from-blue-500 to-indigo-600 w-20 h-20 rounded-2xl flex items-center justify-center text-white font-bold text-3xl shadow-xl">
                <?php echo strtoupper(substr($appNick, 0, 2)); ?>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-900 mb-2"><?php echo htmlspecialchars($appData['Name'] ?? $appNick); ?></h1>
                <p class="text-slate-600 mb-4"><?php echo htmlspecialchars($appData['Summary'] ?? 'No description'); ?></p>
                <div class="flex items-center gap-4 text-sm">
                    <span class="flex items-center gap-2 text-slate-500">
                        <i class="fas fa-code-branch text-blue-600"></i>
                        Version <?php echo htmlspecialchars($appData['Version'] ?? '1.0.0'); ?>
                    </span>
                    <span class="flex items-center gap-2 text-slate-500">
                        <i class="fas fa-user text-blue-600"></i>
                        <?php echo htmlspecialchars($appData['author'] ?? 'Unknown'); ?>
                    </span>
                    <?php if ($isInstalled): ?>
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full font-semibold flex items-center gap-1">
                            <i class="fas fa-check-circle"></i> Installed
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <a href="?serve=appdev&action=edit&app=<?php echo $appNick; ?>"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
            <i class="fas fa-edit mr-2"></i> Edit App
        </a>
    </div>
</div>

<!-- Details Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Info -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-bold text-slate-900 mb-4">App Information</h2>
            <dl class="grid grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-slate-500">Nickname</dt>
                    <dd class="text-base font-semibold text-slate-900 mt-1"><?php echo htmlspecialchars($appNick); ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-slate-500">Display Name</dt>
                    <dd class="text-base font-semibold text-slate-900 mt-1"><?php echo htmlspecialchars($appData['Name'] ?? 'N/A'); ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-slate-500">Version</dt>
                    <dd class="text-base font-semibold text-slate-900 mt-1"><?php echo htmlspecialchars($appData['Version'] ?? 'N/A'); ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-slate-500">Author</dt>
                    <dd class="text-base font-semibold text-slate-900 mt-1"><?php echo htmlspecialchars($appData['author'] ?? 'N/A'); ?></dd>
                </div>
                <?php if (!empty($appData['Email'])): ?>
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Email</dt>
                        <dd class="text-base font-semibold text-slate-900 mt-1">
                            <a href="mailto:<?php echo htmlspecialchars($appData['Email']); ?>" class="text-blue-600 hover:underline">
                                <?php echo htmlspecialchars($appData['Email']); ?>
                            </a>
                        </dd>
                    </div>
                <?php endif; ?>
                <?php if (!empty($appData['Website'])): ?>
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Website</dt>
                        <dd class="text-base font-semibold text-slate-900 mt-1">
                            <a href="<?php echo htmlspecialchars($appData['Website']); ?>" target="_blank" class="text-blue-600 hover:underline">
                                <?php echo htmlspecialchars($appData['Website']); ?>
                            </a>
                        </dd>
                    </div>
                <?php endif; ?>
            </dl>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-lg font-bold text-slate-900 mb-4">Description</h2>
            <p class="text-slate-600 leading-relaxed">
                <?php echo htmlspecialchars($appData['Summary'] ?? 'No description available for this application.'); ?>
            </p>
        </div>
    </div>

    <!-- Actions Sidebar -->
    <div class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h3 class="font-bold text-slate-900 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <?php if ($isInstalled): ?>
                    <a href="?serve=appdev&action=list&uninstall=<?php echo $appNick; ?>"
                        class="block w-full bg-orange-100 hover:bg-orange-200 text-orange-700 px-4 py-3 rounded-lg font-semibold transition text-center">
                        <i class="fas fa-times-circle mr-2"></i> Uninstall
                    </a>
                <?php else: ?>
                    <a href="?serve=appdev&action=list&install=<?php echo $appNick; ?>"
                        class="block w-full bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-lg font-semibold transition text-center">
                        <i class="fas fa-download mr-2"></i> Install App
                    </a>
                <?php endif; ?>

                <a href="?serve=appdev&action=edit&app=<?php echo $appNick; ?>"
                    class="block w-full bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-3 rounded-lg font-semibold transition text-center">
                    <i class="fas fa-edit mr-2"></i> Edit Details
                </a>

                <button onclick="if(confirm('Delete this app?')) window.location='?serve=appdev&action=list&delete=<?php echo $appNick; ?>'"
                    class="block w-full bg-red-100 hover:bg-red-200 text-red-700 px-4 py-3 rounded-lg font-semibold transition text-center">
                    <i class="fas fa-trash mr-2"></i> Delete App
                </button>
            </div>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
            <h4 class="font-bold text-blue-900 mb-2 flex items-center gap-2">
                <i class="fas fa-folder"></i> File Location
            </h4>
            <p class="text-sm text-blue-800 font-mono bg-white px-3 py-2 rounded border border-blue-200">
                /Apps/<?php echo $appNick; ?>
            </p>
        </div>
    </div>
</div>