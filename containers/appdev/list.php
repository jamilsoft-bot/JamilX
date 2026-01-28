<?php
global $Apps, $Url;

$insall = $Url->get('install');
$uninsall = $Url->get('uninstall');
$delete = $Url->get('delete');

if ($insall !== null) {
    $result = $Apps->Install($insall);
    echo "<div class='mb-4 bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-400 text-green-700 px-6 py-4 rounded-2xl shadow-lg flex items-center gap-3' role='alert'>
            <i class='fas fa-check-circle text-2xl'></i>
            <div>
                <strong class='font-bold text-lg'>Success!</strong>
                <span class='block'>App installed successfully.</span>
            </div>
          </div>";
}

if ($uninsall !== null) {
    $result = $Apps->Uninstall($uninsall);
    echo "<div class='mb-4 bg-gradient-to-r from-orange-50 to-amber-50 border-2 border-orange-400 text-orange-700 px-6 py-4 rounded-2xl shadow-lg flex items-center gap-3' role='alert'>
            <i class='fas fa-info-circle text-2xl'></i>
            <div>
                <strong class='font-bold text-lg'>Success!</strong>
                <span class='block'>App uninstalled.</span>
            </div>
          </div>";
}

$appList = $Apps->getAll();
$hasApps = !empty($appList);
?>

<!-- Enhanced Header Section with Gradient -->
<div class="mb-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-8 shadow-sm border border-blue-100">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">My Applications</h2>
            <p class="text-slate-600 flex items-center gap-2">
                <i class="fas fa-layer-group text-blue-500"></i>
                <span>Manage and monitor your applications</span>
            </p>
        </div>
        <div class="flex items-center gap-3">
            <span class="bg-white px-4 py-2 rounded-xl shadow-sm border border-slate-200 font-semibold text-slate-700">
                <span class="text-blue-600"><?php echo count($appList); ?></span> Apps
            </span>
        </div>
    </div>
</div>

<!-- Enhanced Search, Filter, and View Controls -->
<div class="mb-6 bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
    <div class="flex flex-col lg:flex-row gap-4 items-center justify-between">
        <!-- Search Bar -->
        <div class="relative flex-1 w-full lg:w-auto">
            <input type="search"
                id="appSearch"
                placeholder="Search apps by name, author, or description..."
                class="w-full pl-12 pr-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                onkeyup="filterApps()">
            <i class="fas fa-search absolute left-4 top-4 text-slate-400 text-lg"></i>
        </div>

        <!-- Filter and Sort Controls -->
        <div class="flex flex-wrap items-center gap-3">
            <!-- Status Filter -->
            <select id="statusFilter" onchange="filterApps()" class="px-4 py-3 border-2 border-slate-200 rounded-xl bg-white hover:border-blue-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all font-medium text-slate-700">
                <option value="all">All Status</option>
                <option value="installed">Installed</option>
                <option value="draft">Draft</option>
            </select>

            <!-- Sort Options -->
            <select id="sortBy" onchange="sortApps()" class="px-4 py-3 border-2 border-slate-200 rounded-xl bg-white hover:border-blue-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all font-medium text-slate-700">
                <option value="name">Sort by Name</option>
                <option value="date">Sort by Date</option>
                <option value="status">Sort by Status</option>
            </select>

            <!-- View Toggle -->
            <div class="flex items-center gap-2 bg-slate-100 p-1 rounded-xl">
                <button onclick="setView('grid')" id="gridViewBtn" class="px-4 py-2 rounded-lg bg-white shadow-sm font-medium text-slate-700 transition-all">
                    <i class="fas fa-th-large"></i>
                </button>
                <button onclick="setView('list')" id="listViewBtn" class="px-4 py-2 rounded-lg font-medium text-slate-500 hover:text-slate-700 transition-all">
                    <i class="fas fa-list"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<?php if ($hasApps): ?>
    <!-- Apps Grid Container -->
    <div id="appsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($appList as $app):
            $isInstalled = $Apps->isInstalled($app['Nick']);
            $appNick = htmlspecialchars($app['Nick']);
            $appName = htmlspecialchars($app['Name'] ?? $appNick);
            $appSummary = htmlspecialchars($app['Summary'] ?? 'No description available');
            $appVersion = htmlspecialchars($app['Version'] ?? '1.0.0');
            $appAuthor = htmlspecialchars($app['author'] ?? 'Unknown');

            // Generate gradient colors based on first letter
            $gradientColors = [
                ['from-blue-500', 'to-indigo-600'],
                ['from-green-500', 'to-emerald-600'],
                ['from-purple-500', 'to-violet-600'],
                ['from-orange-500', 'to-amber-600'],
                ['from-pink-500', 'to-rose-600'],
                ['from-cyan-500', 'to-blue-600'],
            ];
            $colorIndex = ord(strtoupper($appNick[0])) % count($gradientColors);
            $gradient = $gradientColors[$colorIndex];
        ?>
            <div class="app-card group bg-white rounded-2xl shadow-sm border-2 border-slate-200 hover:border-blue-400 hover:shadow-2xl transition-all duration-300 overflow-hidden relative"
                data-name="<?php echo strtolower($appName); ?>"
                data-author="<?php echo strtolower($appAuthor); ?>"
                data-description="<?php echo strtolower($appSummary); ?>"
                data-status="<?php echo $isInstalled ? 'installed' : 'draft'; ?>">

                <!-- Gradient Top Bar -->
                <div class="h-2 bg-gradient-to-r <?php echo $gradient[0] . ' ' . $gradient[1]; ?>"></div>

                <!-- Card Content -->
                <div class="p-6">
                    <!-- App Header -->
                    <div class="flex items-start justify-between mb-5">
                        <div class="bg-gradient-to-br <?php echo $gradient[0] . ' ' . $gradient[1]; ?> w-20 h-20 rounded-2xl flex items-center justify-center text-white font-bold text-3xl shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                            <?php echo strtoupper(substr($appNick, 0, 2)); ?>
                        </div>
                        <div class="flex flex-col gap-2 items-end">
                            <?php if ($isInstalled): ?>
                                <span class="bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 text-xs px-4 py-2 rounded-full font-bold flex items-center gap-2 shadow-sm border border-green-200">
                                    <span class="relative flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                    </span>
                                    Active
                                </span>
                            <?php else: ?>
                                <span class="bg-slate-100 text-slate-600 text-xs px-4 py-2 rounded-full font-bold shadow-sm border border-slate-200">
                                    Draft
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- App Info -->
                    <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-blue-600 transition-colors truncate"><?php echo $appName; ?></h3>
                    <p class="text-sm text-slate-500 mb-4 line-clamp-2 min-h-[40px]"><?php echo $appSummary; ?></p>

                    <!-- Meta Information -->
                    <div class="flex items-center gap-4 text-xs text-slate-500 mb-5 pb-5 border-b border-slate-100">
                        <span class="flex items-center gap-1.5 bg-slate-50 px-3 py-1.5 rounded-lg">
                            <i class="fas fa-code-branch text-blue-500"></i>
                            <span class="font-semibold"><?php echo $appVersion; ?></span>
                        </span>
                        <span class="flex items-center gap-1.5 bg-slate-50 px-3 py-1.5 rounded-lg">
                            <i class="fas fa-user text-purple-500"></i>
                            <span class="font-semibold truncate max-w-[100px]"><?php echo $appAuthor; ?></span>
                        </span>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-2">
                        <?php if ($isInstalled): ?>
                            <a href="?serve=appdev&action=list&uninstall=<?php echo $appNick; ?>"
                                class="flex-1 bg-gradient-to-r from-orange-100 to-amber-100 hover:from-orange-200 hover:to-amber-200 text-orange-700 px-4 py-3 rounded-xl font-bold text-sm transition-all text-center border border-orange-200 hover:shadow-lg">
                                <i class="fas fa-times-circle mr-1"></i> Uninstall
                            </a>
                        <?php else: ?>
                            <a href="?serve=appdev&action=list&install=<?php echo $appNick; ?>"
                                class="flex-1 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white px-4 py-3 rounded-xl font-bold text-sm transition-all text-center shadow-md hover:shadow-xl">
                                <i class="fas fa-download mr-1"></i> Install
                            </a>
                        <?php endif; ?>

                        <a href="?serve=appdev&action=edit&app=<?php echo $appNick; ?>"
                            class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-3 rounded-xl font-bold text-sm transition-all border border-blue-200 hover:shadow-lg"
                            title="Edit App">
                            <i class="fas fa-edit"></i>
                        </a>

                        <a href="?serve=appdev&action=details&app=<?php echo $appNick; ?>"
                            class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-3 rounded-xl font-bold text-sm transition-all border border-slate-200 hover:shadow-lg"
                            title="View Details">
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php else: ?>
    <!-- Enhanced Empty State with Animation -->
    <div class="bg-gradient-to-br from-slate-50 to-blue-50 rounded-2xl shadow-sm border-2 border-slate-200 p-16 text-center relative overflow-hidden">
        <!-- Background Decoration -->
        <div class="absolute inset-0 flex items-center justify-center opacity-5">
            <i class="fas fa-rocket text-[300px] transform rotate-12"></i>
        </div>

        <div class="relative z-10">
            <div class="bg-gradient-to-br from-blue-100 to-indigo-100 w-32 h-32 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-xl">
                <i class="fas fa-box-open text-6xl text-blue-600"></i>
            </div>
            <h3 class="text-3xl font-bold text-slate-900 mb-3">No Applications Found</h3>
            <p class="text-slate-600 mb-8 max-w-lg mx-auto text-lg">
                You haven't created any applications yet. Get started by creating your first app and bring your ideas to life!
            </p>
            <div class="flex items-center justify-center gap-4">
                <a href="?serve=appdev&action=create"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all text-lg">
                    <i class="fas fa-plus-circle text-xl"></i>
                    <span>Create Your First App</span>
                </a>
                <a href="jxdoc"
                    class="inline-flex items-center gap-2 bg-white text-slate-700 px-8 py-4 rounded-xl font-bold shadow-sm hover:shadow-lg border-2 border-slate-200 hover:border-blue-300 transition-all text-lg">
                    <i class="fas fa-book"></i>
                    <span>View Documentation</span>
                </a>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- JavaScript for filtering, sorting, and view toggle -->
<script>
    // Filter apps based on search and status
    function filterApps() {
        const searchTerm = document.getElementById('appSearch').value.toLowerCase();
        const statusFilter = document.getElementById('statusFilter').value;
        const cards = document.querySelectorAll('.app-card');

        cards.forEach(card => {
            const name = card.getAttribute('data-name');
            const author = card.getAttribute('data-author');
            const description = card.getAttribute('data-description');
            const status = card.getAttribute('data-status');

            const matchesSearch = name.includes(searchTerm) ||
                author.includes(searchTerm) ||
                description.includes(searchTerm);

            const matchesStatus = statusFilter === 'all' || status === statusFilter;

            if (matchesSearch && matchesStatus) {
                card.style.display = '';
                // Add fade-in animation
                card.style.animation = 'fadeIn 0.3s ease-in';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Sort apps
    function sortApps() {
        const sortBy = document.getElementById('sortBy').value;
        const container = document.getElementById('appsContainer');
        const cards = Array.from(document.querySelectorAll('.app-card'));

        cards.sort((a, b) => {
            if (sortBy === 'name') {
                return a.getAttribute('data-name').localeCompare(b.getAttribute('data-name'));
            } else if (sortBy === 'status') {
                return a.getAttribute('data-status').localeCompare(b.getAttribute('data-status'));
            }
            // Default 'date' sorting - keep original order
            return 0;
        });

        // Re-append sorted cards
        cards.forEach(card => container.appendChild(card));
    }

    // Toggle between grid and list views
    function setView(viewType) {
        const container = document.getElementById('appsContainer');
        const gridBtn = document.getElementById('gridViewBtn');
        const listBtn = document.getElementById('listViewBtn');

        if (viewType === 'grid') {
            container.className = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6';
            gridBtn.className = 'px-4 py-2 rounded-lg bg-white shadow-sm font-medium text-slate-700 transition-all';
            listBtn.className = 'px-4 py-2 rounded-lg font-medium text-slate-500 hover:text-slate-700 transition-all';
        } else {
            container.className = 'grid grid-cols-1 gap-4';
            gridBtn.className = 'px-4 py-2 rounded-lg font-medium text-slate-500 hover:text-slate-700 transition-all';
            listBtn.className = 'px-4 py-2 rounded-lg bg-white shadow-sm font-medium text-slate-700 transition-all';
        }
    }

    // Add fade-in animation
    const style = document.createElement('style');
    style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
`;
    document.head.appendChild(style);
</script>