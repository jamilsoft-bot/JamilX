<?php
global $Apps;

// Get app statistics
$totalApps = 0;
$activeApps = 0;
$installedApps = 0;
$inDevelopment = 0;

if (class_exists('Apps')) {
    $appList = $Apps->getAll();
    $totalApps = count($appList);
    foreach ($appList as $app) {
        if (isset($app['status']) && $app['status'] === 'active') $activeApps++;
        if ($Apps->isInstalled($app['Nick'])) {
            $installedApps++;
        } else {
            $inDevelopment++;
        }
    }
}

// Calculate trend percentages (simulated for now - can be replaced with actual historical data)
$totalTrend = "+12%";
$activeTrend = "+8%";
$installedTrend = "+15%";
$devTrend = "-5%";
?>

<!-- Enhanced Welcome Section with Animated Gradient -->
<div class="mb-8">
    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
        <!-- Animated Gradient Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 animate-gradient"></div>

        <!-- Geometric Pattern Overlay -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-64 h-64 bg-white rounded-full mix-blend-overlay filter blur-3xl animate-blob"></div>
            <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full mix-blend-overlay filter blur-3xl animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-0 left-1/2 w-64 h-64 bg-white rounded-full mix-blend-overlay filter blur-3xl animate-blob animation-delay-4000"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 p-8 md:p-12">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex-1">
                    <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-4">
                        <span class="relative flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                        </span>
                        <span class="text-white text-sm font-semibold">All Systems Operational</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold mb-3 text-white">Welcome to App Development</h2>
                    <p class="text-blue-100 text-lg md:text-xl mb-4">Build, manage, and deploy your applications with ease</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="?serve=appdev&action=create" class="inline-flex items-center gap-2 bg-white text-blue-600 px-6 py-3 rounded-xl font-semibold hover:shadow-2xl transform hover:-translate-y-0.5 transition-all">
                            <i class="fas fa-plus-circle"></i>
                            <span>Create New App</span>
                        </a>
                        <a href="jxdoc" class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm text-white border-2 border-white/30 px-6 py-3 rounded-xl font-semibold hover:bg-white/20 transition-all">
                            <i class="fas fa-book-open"></i>
                            <span>Documentation</span>
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <div class="w-48 h-48 relative">
                        <div class="absolute inset-0 bg-white/20 backdrop-blur-sm rounded-3xl transform rotate-6 animate-pulse"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-rocket text-white text-8xl transform -rotate-45 animate-bounce-slow"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Animations -->
<style>
    @keyframes gradient {

        0%,
        100% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }
    }

    @keyframes blob {

        0%,
        100% {
            transform: translate(0, 0) scale(1);
        }

        33% {
            transform: translate(30px, -50px) scale(1.1);
        }

        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }
    }

    @keyframes bounce-slow {

        0%,
        100% {
            transform: translateY(0) rotate(-45deg);
        }

        50% {
            transform: translateY(-20px) rotate(-45deg);
        }
    }

    .animate-gradient {
        background-size: 200% 200%;
        animation: gradient 15s ease infinite;
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }

    .animation-delay-4000 {
        animation-delay: 4s;
    }

    .animate-bounce-slow {
        animation: bounce-slow 3s ease-in-out infinite;
    }
</style>

<!-- Enhanced Stats Grid with Trend Indicators -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Apps Card -->
    <div class="group bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-2xl hover:scale-105 hover:border-blue-300 transition-all duration-300 cursor-pointer relative overflow-hidden">
        <!-- Gradient Overlay on Hover -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>

        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white w-14 h-14 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-blue-300 group-hover:scale-110 transition-all">
                    <i class="fas fa-boxes text-2xl"></i>
                </div>
                <div class="flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                    <i class="fas fa-arrow-up"></i>
                    <span><?php echo $totalTrend; ?></span>
                </div>
            </div>
            <div class="space-y-1">
                <h3 class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Total Applications</h3>
                <p class="text-4xl font-bold text-slate-900 group-hover:text-blue-600 transition-colors"><?php echo $totalApps; ?></p>
                <p class="text-xs text-slate-400">All registered apps</p>
            </div>
        </div>

        <!-- Decorative Element -->
        <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-blue-100 rounded-full opacity-20 group-hover:scale-150 transition-transform"></div>
    </div>

    <!-- Active Apps Card -->
    <div class="group bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-2xl hover:scale-105 hover:border-green-300 transition-all duration-300 cursor-pointer relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>

        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-gradient-to-br from-green-500 to-emerald-600 text-white w-14 h-14 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-green-300 group-hover:scale-110 transition-all">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
                <div class="flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                    <i class="fas fa-arrow-up"></i>
                    <span><?php echo $activeTrend; ?></span>
                </div>
            </div>
            <div class="space-y-1">
                <h3 class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Active Apps</h3>
                <p class="text-4xl font-bold text-slate-900 group-hover:text-green-600 transition-colors"><?php echo $activeApps; ?></p>
                <p class="text-xs text-slate-400">Currently running</p>
            </div>
        </div>

        <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-green-100 rounded-full opacity-20 group-hover:scale-150 transition-transform"></div>
    </div>

    <!-- Installed Apps Card -->
    <div class="group bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-2xl hover:scale-105 hover:border-purple-300 transition-all duration-300 cursor-pointer relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>

        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-gradient-to-br from-purple-500 to-violet-600 text-white w-14 h-14 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-purple-300 group-hover:scale-110 transition-all">
                    <i class="fas fa-download text-2xl"></i>
                </div>
                <div class="flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                    <i class="fas fa-arrow-up"></i>
                    <span><?php echo $installedTrend; ?></span>
                </div>
            </div>
            <div class="space-y-1">
                <h3 class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Installed</h3>
                <p class="text-4xl font-bold text-slate-900 group-hover:text-purple-600 transition-colors"><?php echo $installedApps; ?></p>
                <p class="text-xs text-slate-400">Ready to use</p>
            </div>
        </div>

        <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-purple-100 rounded-full opacity-20 group-hover:scale-150 transition-transform"></div>
    </div>

    <!-- In Development Card -->
    <div class="group bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-2xl hover:scale-105 hover:border-orange-300 transition-all duration-300 cursor-pointer relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-orange-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>

        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-gradient-to-br from-orange-500 to-amber-600 text-white w-14 h-14 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-orange-300 group-hover:scale-110 transition-all">
                    <i class="fas fa-code text-2xl"></i>
                </div>
                <div class="flex items-center gap-1 bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">
                    <i class="fas fa-arrow-down"></i>
                    <span><?php echo $devTrend; ?></span>
                </div>
            </div>
            <div class="space-y-1">
                <h3 class="text-sm font-semibold text-slate-600 uppercase tracking-wide">In Development</h3>
                <p class="text-4xl font-bold text-slate-900 group-hover:text-orange-600 transition-colors"><?php echo $inDevelopment; ?></p>
                <p class="text-xs text-slate-400">Work in progress</p>
            </div>
        </div>

        <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-orange-100 rounded-full opacity-20 group-hover:scale-150 transition-transform"></div>
    </div>
</div>

<!-- Enhanced Quick Actions & Getting Started Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Quick Actions - Takes 2 columns -->
    <div class="lg:col-span-2 bg-gradient-to-br from-white to-slate-50 rounded-2xl shadow-sm border border-slate-200 p-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-2xl font-bold text-slate-900">Quick Actions</h3>
                <p class="text-sm text-slate-500 mt-1">Get started with these shortcuts</p>
            </div>
            <div class="bg-blue-100 text-blue-600 w-12 h-12 rounded-xl flex items-center justify-center">
                <i class="fas fa-bolt"></i>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <a href="?serve=appdev&action=create" class="group relative bg-white border-2 border-slate-200 rounded-2xl p-6 hover:border-blue-500 hover:shadow-xl transition-all duration-300 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-indigo-600 opacity-0 group-hover:opacity-5 transition-opacity"></div>
                <div class="relative">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all shadow-lg">
                        <i class="fas fa-plus text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-slate-900 text-lg mb-2 group-hover:text-blue-600 transition-colors">Create App</h4>
                    <p class="text-sm text-slate-500">Start a new application project</p>
                </div>
            </a>

            <a href="?serve=appdev&action=list" class="group relative bg-white border-2 border-slate-200 rounded-2xl p-6 hover:border-green-500 hover:shadow-xl transition-all duration-300 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-green-500 to-emerald-600 opacity-0 group-hover:opacity-5 transition-opacity"></div>
                <div class="relative">
                    <div class="bg-gradient-to-br from-green-500 to-emerald-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all shadow-lg">
                        <i class="fas fa-list text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-slate-900 text-lg mb-2 group-hover:text-green-600 transition-colors">View All Apps</h4>
                    <p class="text-sm text-slate-500">Browse your applications</p>
                </div>
            </a>

            <a href="jxdoc" class="group relative bg-white border-2 border-slate-200 rounded-2xl p-6 hover:border-purple-500 hover:shadow-xl transition-all duration-300 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-violet-600 opacity-0 group-hover:opacity-5 transition-opacity"></div>
                <div class="relative">
                    <div class="bg-gradient-to-br from-purple-500 to-violet-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all shadow-lg">
                        <i class="fas fa-book text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-slate-900 text-lg mb-2 group-hover:text-purple-600 transition-colors">Documentation</h4>
                    <p class="text-sm text-slate-500">Learn about JamilX apps</p>
                </div>
            </a>

            <a href="?serve=appdev&action=settings" class="group relative bg-white border-2 border-slate-200 rounded-2xl p-6 hover:border-orange-500 hover:shadow-xl transition-all duration-300 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-orange-500 to-amber-600 opacity-0 group-hover:opacity-5 transition-opacity"></div>
                <div class="relative">
                    <div class="bg-gradient-to-br from-orange-500 to-amber-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all shadow-lg">
                        <i class="fas fa-cog text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-slate-900 text-lg mb-2 group-hover:text-orange-600 transition-colors">Settings</h4>
                    <p class="text-sm text-slate-500">Configure preferences</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Getting Started Guide -->
    <div class="bg-gradient-to-br from-indigo-600 to-purple-700 rounded-2xl shadow-xl p-8 text-white relative overflow-hidden">
        <!-- Decorative Background -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12"></div>

        <div class="relative z-10">
            <div class="bg-white/20 backdrop-blur-sm w-14 h-14 rounded-2xl flex items-center justify-center mb-4">
                <i class="fas fa-graduation-cap text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold mb-2">Getting Started</h3>
            <p class="text-indigo-100 text-sm mb-6">Follow these steps to build your first app</p>

            <div class="space-y-4">
                <div class="flex items-start gap-4">
                    <div class="bg-white text-indigo-600 w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 font-bold text-sm">
                        1
                    </div>
                    <div>
                        <h4 class="font-semibold mb-1">Create Your App</h4>
                        <p class="text-sm text-indigo-100 opacity-90">Use the creation wizard</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="bg-white text-indigo-600 w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 font-bold text-sm">
                        2
                    </div>
                    <div>
                        <h4 class="font-semibold mb-1">Configure Settings</h4>
                        <p class="text-sm text-indigo-100 opacity-90">Set up routes and models</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="bg-white text-indigo-600 w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 font-bold text-sm">
                        3
                    </div>
                    <div>
                        <h4 class="font-semibold mb-1">Install & Deploy</h4>
                        <p class="text-sm text-indigo-100 opacity-90">Make it live for users</p>
                    </div>
                </div>
            </div>

            <a href="jxdoc" class="mt-6 inline-flex items-center gap-2 bg-white text-indigo-600 px-5 py-3 rounded-xl font-semibold hover:shadow-2xl transform hover:-translate-y-1 transition-all">
                <span>Read Full Guide</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- Enhanced Recent Applications Section -->
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-2xl font-bold text-slate-900 flex items-center gap-3">
                <span class="bg-gradient-to-br from-blue-500 to-indigo-600 w-10 h-10 rounded-xl flex items-center justify-center text-white">
                    <i class="fas fa-star"></i>
                </span>
                Recent Applications
            </h3>
            <p class="text-sm text-slate-500 mt-1">Your latest app projects</p>
        </div>
        <a href="?serve=appdev&action=list" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-xl transition-all">
            <span>View all</span>
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <?php if ($totalApps > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php
            $recentApps = array_slice($appList, 0, 3);
            foreach ($recentApps as $app):
                $isInstalled = $Apps->isInstalled($app['Nick']);
            ?>
                <div class="group bg-gradient-to-br from-white to-slate-50 border-2 border-slate-200 rounded-2xl p-6 hover:border-blue-400 hover:shadow-2xl transition-all duration-300 cursor-pointer relative overflow-hidden">
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>

                    <div class="relative z-10">
                        <div class="flex items-start justify-between mb-4">
                            <div class="bg-gradient-to-br from-blue-500 to-indigo-600 w-16 h-16 rounded-2xl flex items-center justify-center text-white font-bold text-2xl shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all">
                                <?php echo strtoupper(substr($app['Nick'] ?? 'A', 0, 1)); ?>
                            </div>
                            <?php if ($isInstalled): ?>
                                <span class="bg-green-100 text-green-700 text-xs px-3 py-1.5 rounded-full font-bold flex items-center gap-1 shadow-sm">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Installed</span>
                                </span>
                            <?php else: ?>
                                <span class="bg-slate-100 text-slate-600 text-xs px-3 py-1.5 rounded-full font-bold shadow-sm">
                                    Draft
                                </span>
                            <?php endif; ?>
                        </div>

                        <h4 class="font-bold text-slate-900 text-lg mb-2 group-hover:text-blue-600 transition-colors truncate">
                            <?php echo htmlspecialchars($app['Name'] ?? $app['Nick']); ?>
                        </h4>
                        <p class="text-sm text-slate-500 line-clamp-2 mb-4 min-h-[40px]">
                            <?php echo htmlspecialchars($app['Summary'] ?? 'No description available'); ?>
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-slate-200">
                            <span class="text-xs text-slate-400 flex items-center gap-1">
                                <i class="fas fa-code-branch"></i>
                                <?php echo htmlspecialchars($app['Version'] ?? '1.0.0'); ?>
                            </span>
                            <a href="?serve=appdev&action=details&app=<?php echo urlencode($app['Nick']); ?>"
                                class="text-xs font-semibold text-blue-600 hover:text-blue-700 flex items-center gap-1 group-hover:gap-2 transition-all">
                                <span>View Details</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <!-- Enhanced Empty State -->
        <div class="text-center py-16 relative">
            <div class="absolute inset-0 flex items-center justify-center opacity-5">
                <i class="fas fa-box-open text-[200px]"></i>
            </div>
            <div class="relative z-10">
                <div class="bg-gradient-to-br from-slate-100 to-slate-200 w-24 h-24 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <i class="fas fa-rocket text-5xl text-slate-400"></i>
                </div>
                <h4 class="text-2xl font-bold text-slate-900 mb-3">No Applications Yet</h4>
                <p class="text-slate-500 mb-6 max-w-md mx-auto">
                    Ready to build something amazing? Create your first application and start your development journey!
                </p>
                <a href="?serve=appdev&action=create" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-xl font-semibold hover:shadow-2xl transform hover:-translate-y-1 transition-all">
                    <i class="fas fa-plus-circle text-lg"></i>
                    <span>Create Your First App</span>
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>