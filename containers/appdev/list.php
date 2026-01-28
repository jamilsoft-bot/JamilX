<?php
global $Apps, $Url;

$insall = $Url->get('install');
$uninsall = $Url->get('uninstall');
$delete = $Url->get('delete');

if ($insall !== null) {
    $result = $Apps->Install($insall);
    echo "<div class='mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg' role='alert'>
            <strong class='font-bold'>Success!</strong>
            <span class='block sm:inline'>App installed successfully.</span>
          </div>";
}

if ($uninsall !== null) {
    $result = $Apps->Uninstall($uninsall);
    echo "<div class='mb-4 bg-orange-100 border border-orange-400 text-orange-700 px-4 py-3 rounded-lg' role='alert'>
            <strong class='font-bold'>Success!</strong>
            <span class='block sm:inline'>App uninstalled.</span>
          </div>";
}

$appList = $Apps->getAll();
$hasApps = !empty($appList);
?>

<!-- Header Section -->
<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-bold text-slate-900">My Applications</h2>
        <p class="text-slate-500 mt-1">Manage and monitor your applications</p>
    </div>
    <div class="flex items-center gap-3">
        <div class="relative">
            <input type="search" placeholder="Search apps..." class="pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <i class="fas fa-search absolute left-3 top-3 text-slate-400"></i>
        </div>
        <button class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-lg font-medium transition">
            <i class="fas fa-filter mr-2"></i> Filter
        </button>
    </div>
</div>

<?php if ($hasApps): ?>
    <!-- Apps Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($appList as $app):
            $isInstalled = $Apps->isInstalled($app['Nick']);
            $appNick = htmlspecialchars($app['Nick']);
            $appName = htmlspecialchars($app['Name'] ?? $appNick);
            $appSummary = htmlspecialchars($app['Summary'] ?? 'No description available');
            $appVersion = htmlspecialchars($app['Version'] ?? '1.0.0');
            $appAuthor = htmlspecialchars($app['author'] ?? 'Unknown');
        ?>
            <div class="bg-white rounded-xl shadow-sm border-2 border-slate-200 hover:border-blue-500 hover:shadow-lg transition-all group">
                <!-- App Header -->
                <div class="p-6 border-b border-slate-100">
                    <div class="flex items-start justify-between mb-4">
                        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 w-16 h-16 rounded-xl flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                            <?php echo strtoupper(substr($appNick, 0, 2)); ?>
                        </div>
                        <div class="flex gap-2">
                            <?php if ($isInstalled): ?>
                                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-semibold flex items-center gap-1">
                                    <i class="fas fa-check-circle"></i> Active
                                </span>
                            <?php else: ?>
                                <span class="bg-slate-100 text-slate-600 text-xs px-3 py-1 rounded-full font-semibold">
                                    Draft
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-slate-900 mb-1"><?php echo $appName; ?></h3>
                    <p class="text-sm text-slate-500 mb-3 line-clamp-2"><?php echo $appSummary; ?></p>

                    <div class="flex items-center gap-4 text-xs text-slate-500">
                        <span class="flex items-center gap-1">
                            <i class="fas fa-code-branch"></i> <?php echo $appVersion; ?>
                        </span>
                        <span class="flex items-center gap-1">
                            <i class="fas fa-user"></i> <?php echo $appAuthor; ?>
                        </span>
                    </div>
                </div>

                <!-- App Actions -->
                <div class="p-4 bg-slate-50 flex items-center justify-between gap-2">
                    <?php if ($isInstalled): ?>
                        <a href="?serve=appdev&action=list&uninstall=<?php echo $appNick; ?>"
                            class="flex-1 bg-orange-100 hover:bg-orange-200 text-orange-700 px-4 py-2 rounded-lg font-semibold text-sm transition text-center">
                            <i class="fas fa-times-circle mr-1"></i> Uninstall
                        </a>
                    <?php else: ?>
                        <a href="?serve=appdev&action=list&install=<?php echo $appNick; ?>"
                            class="flex-1 bg-green-100 hover:bg-green-200 text-green-700 px-4 py-2 rounded-lg font-semibold text-sm transition text-center">
                            <i class="fas fa-download mr-1"></i> Install
                        </a>
                    <?php endif; ?>

                    <a href="?serve=appdev&action=edit&app=<?php echo $appNick; ?>"
                        class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-2 rounded-lg font-semibold text-sm transition">
                        <i class="fas fa-edit"></i>
                    </a>

                    <a href="?serve=appdev&action=details&app=<?php echo $appNick; ?>"
                        class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-4 py-2 rounded-lg font-semibold text-sm transition">
                        <i class="fas fa-info-circle"></i>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php else: ?>
    <!-- Empty State -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
        <div class="bg-slate-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-box-open text-5xl text-slate-400"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-900 mb-2">No Applications Found</h3>
        <p class="text-slate-500 mb-6 max-w-md mx-auto">
            You haven't created any applications yet. Get started by creating your first app!
        </p>
        <a href="?serve=appdev&action=create"
            class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all">
            <i class="fas fa-plus-circle"></i>
            <span>Create Your First App</span>
        </a>
    </div>
<?php endif; ?>