<?php
global $Apps;

// Get app statistics
$totalApps = 0;
$activeApps = 0;
$installedApps = 0;

if (class_exists('Apps')) {
    $appList = $Apps->getAll();
    $totalApps = count($appList);
    foreach ($appList as $app) {
        if (isset($app['status']) && $app['status'] === 'active') $activeApps++;
        if ($Apps->isInstalled($app['Nick'])) $installedApps++;
    }
}
?>

<!-- Welcome Section -->
<div class="mb-8">
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-8 text-white shadow-xl relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-3xl font-bold mb-2">Welcome to App Development</h2>
            <p class="text-blue-100 text-lg">Build, manage, and deploy your applications with ease</p>
        </div>
        <div class="absolute right-0 top-0 opacity-10">
            <i class="fas fa-rocket text-[200px]"></i>
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Apps -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-blue-100 text-blue-600 w-12 h-12 rounded-lg flex items-center justify-center">
                <i class="fas fa-boxes text-xl"></i>
            </div>
            <span class="text-3xl font-bold text-slate-900"><?php echo $totalApps; ?></span>
        </div>
        <h3 class="text-sm font-medium text-slate-600">Total Applications</h3>
        <p class="text-xs text-slate-400 mt-1">All registered apps</p>
    </div>

    <!-- Active Apps -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-green-100 text-green-600 w-12 h-12 rounded-lg flex items-center justify-center">
                <i class="fas fa-check-circle text-xl"></i>
            </div>
            <span class="text-3xl font-bold text-slate-900"><?php echo $activeApps; ?></span>
        </div>
        <h3 class="text-sm font-medium text-slate-600">Active Apps</h3>
        <p class="text-xs text-slate-400 mt-1">Currently running</p>
    </div>

    <!-- Installed -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-purple-100 text-purple-600 w-12 h-12 rounded-lg flex items-center justify-center">
                <i class="fas fa-download text-xl"></i>
            </div>
            <span class="text-3xl font-bold text-slate-900"><?php echo $installedApps; ?></span>
        </div>
        <h3 class="text-sm font-medium text-slate-600">Installed</h3>
        <p class="text-xs text-slate-400 mt-1">Ready to use</p>
    </div>

    <!-- In Development -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-orange-100 text-orange-600 w-12 h-12 rounded-lg flex items-center justify-center">
                <i class="fas fa-code text-xl"></i>
            </div>
            <span class="text-3xl font-bold text-slate-900"><?php echo $totalApps - $installedApps; ?></span>
        </div>
        <h3 class="text-sm font-medium text-slate-600">In Development</h3>
        <p class="text-xs text-slate-400 mt-1">Work in progress</p>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <h3 class="text-lg font-bold text-slate-900 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-2 gap-4">
            <a href="?serve=appdev&action=create" class="flex flex-col items-center p-4 border-2 border-slate-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition group">
                <div class="bg-blue-100 group-hover:bg-blue-200 text-blue-600 w-12 h-12 rounded-lg flex items-center justify-center mb-3">
                    <i class="fas fa-plus text-xl"></i>
                </div>
                <span class="font-semibold text-slate-700 group-hover:text-blue-700">Create App</span>
            </a>

            <a href="?serve=appdev&action=list" class="flex flex-col items-center p-4 border-2 border-slate-200 rounded-lg hover:border-green-500 hover:bg-green-50 transition group">
                <div class="bg-green-100 group-hover:bg-green-200 text-green-600 w-12 h-12 rounded-lg flex items-center justify-center mb-3">
                    <i class="fas fa-list text-xl"></i>
                </div>
                <span class="font-semibold text-slate-700 group-hover:text-green-700">View All Apps</span>
            </a>

            <a href="jxdoc" class="flex flex-col items-center p-4 border-2 border-slate-200 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition group">
                <div class="bg-purple-100 group-hover:bg-purple-200 text-purple-600 w-12 h-12 rounded-lg flex items-center justify-center mb-3">
                    <i class="fas fa-book text-xl"></i>
                </div>
                <span class="font-semibold text-slate-700 group-hover:text-purple-700">Documentation</span>
            </a>

            <a href="?serve=appdev&action=settings" class="flex flex-col items-center p-4 border-2 border-slate-200 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition group">
                <div class="bg-orange-100 group-hover:bg-orange-200 text-orange-600 w-12 h-12 rounded-lg flex items-center justify-center mb-3">
                    <i class="fas fa-cog text-xl"></i>
                </div>
                <span class="font-semibold text-slate-700 group-hover:text-orange-700">Settings</span>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <h3 class="text-lg font-bold text-slate-900 mb-4">Getting Started</h3>
        <div class="space-y-4">
            <div class="flex items-start gap-3">
                <div class="bg-blue-100 text-blue-600 w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <span class="text-sm font-bold">1</span>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-900">Create Your First App</h4>
                    <p class="text-sm text-slate-500">Use the Create App wizard to set up your application</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="bg-green-100 text-green-600 w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <span class="text-sm font-bold">2</span>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-900">Configure Your App</h4>
                    <p class="text-sm text-slate-500">Set up routes, models, and controllers</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="bg-purple-100 text-purple-600 w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <span class="text-sm font-bold">3</span>
                </div>
                <div>
                    <h4 class="font-semibold text-slate-900">Install & Deploy</h4>
                    <p class="text-sm text-slate-500">Install your app and make it available to users</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Apps Preview -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-bold text-slate-900">Recent Applications</h3>
        <a href="?serve=appdev&action=list" class="text-sm font-semibold text-blue-600 hover:text-blue-700">
            View all <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>

    <?php if ($totalApps > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <?php
            $recentApps = array_slice($appList, 0, 3);
            foreach ($recentApps as $app):
            ?>
                <div class="border-2 border-slate-200 rounded-lg p-4 hover:border-blue-500 hover:shadow-md transition">
                    <div class="flex items-start justify-between mb-3">
                        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 w-12 h-12 rounded-lg flex items-center justify-center text-white font-bold text-lg">
                            <?php echo strtoupper(substr($app['Nick'] ?? 'A', 0, 1)); ?>
                        </div>
                        <?php if ($Apps->isInstalled($app['Nick'])): ?>
                            <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full font-semibold">
                                Installed
                            </span>
                        <?php else: ?>
                            <span class="bg-slate-100 text-slate-600 text-xs px-2 py-1 rounded-full font-semibold">
                                Draft
                            </span>
                        <?php endif; ?>
                    </div>
                    <h4 class="font-bold text-slate-900 mb-1"><?php echo htmlspecialchars($app['Name'] ?? $app['Nick']); ?></h4>
                    <p class="text-xs text-slate-500 line-clamp-2"><?php echo htmlspecialchars($app['Summary'] ?? 'No description'); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-12">
            <div class="bg-slate-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-box-open text-4xl text-slate-400"></i>
            </div>
            <h4 class="font-semibold text-slate-900 mb-2">No Applications Yet</h4>
            <p class="text-slate-500 mb-4">Get started by creating your first application</p>
            <a href="?serve=appdev&action=create" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                <i class="fas fa-plus"></i> Create Your First App
            </a>
        </div>
    <?php endif; ?>
</div>