<?php
global $Apps;

$appList = [];
$totalApps = 0;
$installedApps = 0;
$draftApps = 0;

if (isset($Apps)) {
    $appList = $Apps->getAll();
    $totalApps = count($appList);
    foreach ($appList as $app) {
        if (!empty($app['Nick']) && $Apps->isInstalled($app['Nick'])) {
            $installedApps++;
        } else {
            $draftApps++;
        }
    }
}

$recentApps = array_slice($appList, 0, 4);
?>

<div class="space-y-8">
    <section class="relative overflow-hidden rounded-3xl border border-slate-200 bg-gradient-to-br from-slate-900 via-indigo-900 to-slate-950 px-8 py-10 text-white shadow-2xl">
        <div class="absolute -top-24 right-0 h-72 w-72 rounded-full bg-indigo-500/30 blur-3xl"></div>
        <div class="absolute -bottom-24 left-0 h-72 w-72 rounded-full bg-blue-500/20 blur-3xl"></div>

        <div class="relative z-10 flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
            <div class="max-w-2xl space-y-5">
                <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-indigo-100">
                    <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                    Studio Workspace
                </div>
                <h2 class="text-3xl font-bold leading-tight sm:text-4xl">
                    App Development Studio
                </h2>
                <p class="text-base text-indigo-100/90 sm:text-lg">
                    Design, build, and ship apps with a premium workflow. Keep architecture, UI, and deployment steps aligned inside one focused workspace.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="?serve=appdev&action=create" class="inline-flex items-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-semibold text-slate-900 shadow-lg transition hover:-translate-y-0.5 hover:shadow-2xl">
                        <i class="fas fa-plus-circle text-indigo-600"></i>
                        Start a New App
                    </a>
                    <a href="?serve=appdev&action=list" class="inline-flex items-center gap-2 rounded-xl border border-white/30 bg-white/10 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/20">
                        <i class="fas fa-grid-2"></i>
                        View Portfolio
                    </a>
                </div>
            </div>
            <div class="grid w-full max-w-sm grid-cols-2 gap-4">
                <div class="rounded-2xl border border-white/10 bg-white/10 p-4 text-left shadow-lg">
                    <p class="text-xs uppercase text-indigo-200">Total Apps</p>
                    <p class="mt-2 text-3xl font-bold"><?php echo $totalApps; ?></p>
                    <p class="text-xs text-indigo-100/80">All projects</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/10 p-4 text-left shadow-lg">
                    <p class="text-xs uppercase text-indigo-200">Installed</p>
                    <p class="mt-2 text-3xl font-bold"><?php echo $installedApps; ?></p>
                    <p class="text-xs text-indigo-100/80">Live apps</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/10 p-4 text-left shadow-lg">
                    <p class="text-xs uppercase text-indigo-200">Drafts</p>
                    <p class="mt-2 text-3xl font-bold"><?php echo $draftApps; ?></p>
                    <p class="text-xs text-indigo-100/80">In progress</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/10 p-4 text-left shadow-lg">
                    <p class="text-xs uppercase text-indigo-200">Next Step</p>
                    <p class="mt-2 text-lg font-semibold">Ship + Install</p>
                    <p class="text-xs text-indigo-100/80">Make it live</p>
                </div>
            </div>
        </div>
    </section>

    <section class="grid gap-6 lg:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-slate-900">Studio Blueprint</h3>
                <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-600">Workflow</span>
            </div>
            <ul class="mt-4 space-y-4 text-sm text-slate-600">
                <li class="flex gap-3">
                    <span class="mt-0.5 h-6 w-6 rounded-full bg-indigo-600 text-center text-xs font-bold text-white">1</span>
                    Define the app scope, UI modules, and data sources in one plan.
                </li>
                <li class="flex gap-3">
                    <span class="mt-0.5 h-6 w-6 rounded-full bg-indigo-600 text-center text-xs font-bold text-white">2</span>
                    Scaffold services, actions, and containers for each experience.
                </li>
                <li class="flex gap-3">
                    <span class="mt-0.5 h-6 w-6 rounded-full bg-indigo-600 text-center text-xs font-bold text-white">3</span>
                    Validate data with prototypes, then install and deploy.
                </li>
            </ul>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-slate-900">Studio Toolkit</h3>
                <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-600">Tools</span>
            </div>
            <div class="mt-4 grid gap-3 text-sm text-slate-600">
                <div class="flex items-center justify-between rounded-xl border border-slate-100 px-4 py-3">
                    <span class="flex items-center gap-2"><i class="fas fa-layer-group text-indigo-600"></i> Service Orchestration</span>
                    <span class="text-xs text-slate-400">Routing</span>
                </div>
                <div class="flex items-center justify-between rounded-xl border border-slate-100 px-4 py-3">
                    <span class="flex items-center gap-2"><i class="fas fa-bolt text-amber-500"></i> Action Automation</span>
                    <span class="text-xs text-slate-400">Logic</span>
                </div>
                <div class="flex items-center justify-between rounded-xl border border-slate-100 px-4 py-3">
                    <span class="flex items-center gap-2"><i class="fas fa-window-maximize text-blue-500"></i> Container UI</span>
                    <span class="text-xs text-slate-400">Layout</span>
                </div>
                <div class="flex items-center justify-between rounded-xl border border-slate-100 px-4 py-3">
                    <span class="flex items-center gap-2"><i class="fas fa-database text-emerald-500"></i> Prototypes</span>
                    <span class="text-xs text-slate-400">Data</span>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-slate-900">Studio Signals</h3>
                <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-600">Status</span>
            </div>
            <div class="mt-4 space-y-4 text-sm text-slate-600">
                <div class="flex items-start gap-3">
                    <span class="mt-1 h-2 w-2 rounded-full bg-emerald-500"></span>
                    Service registry is active and ready to route new apps.
                </div>
                <div class="flex items-start gap-3">
                    <span class="mt-1 h-2 w-2 rounded-full bg-emerald-500"></span>
                    Action handlers available for app workflows.
                </div>
                <div class="flex items-start gap-3">
                    <span class="mt-1 h-2 w-2 rounded-full bg-amber-500"></span>
                    Draft apps are waiting for installation.
                </div>
            </div>
            <a href="?serve=appdev&action=settings" class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                <i class="fas fa-sliders"></i>
                Studio Settings
            </a>
        </div>
    </section>

    <section class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h3 class="text-2xl font-bold text-slate-900">Recent Studio Builds</h3>
                <p class="mt-1 text-sm text-slate-500">Keep an eye on the latest apps in your studio pipeline.</p>
            </div>
            <a href="?serve=appdev&action=list" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg transition hover:bg-indigo-500">
                <i class="fas fa-th-large"></i>
                Manage All Apps
            </a>
        </div>

        <?php if (!empty($recentApps)) : ?>
            <div class="mt-6 grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                <?php foreach ($recentApps as $app) : ?>
                    <?php
                    $appNick = $app['Nick'] ?? 'APP';
                    $appName = $app['Name'] ?? $appNick;
                    $appSummary = $app['Summary'] ?? 'Define the next milestone to move this app forward.';
                    $appVersion = $app['Version'] ?? '1.0.0';
                    $installed = !empty($app['Nick']) && $Apps->isInstalled($app['Nick']);
                    ?>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 transition hover:-translate-y-1 hover:border-indigo-300 hover:bg-white">
                        <div class="flex items-start justify-between">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-sm font-bold text-white">
                                <?php echo strtoupper(substr($appNick, 0, 1)); ?>
                            </div>
                            <span class="rounded-full px-2 py-1 text-xs font-semibold <?php echo $installed ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600'; ?>">
                                <?php echo $installed ? 'Installed' : 'Draft'; ?>
                            </span>
                        </div>
                        <h4 class="mt-4 text-sm font-semibold text-slate-900"><?php echo htmlspecialchars($appName); ?></h4>
                        <p class="mt-2 text-xs text-slate-500 line-clamp-3"><?php echo htmlspecialchars($appSummary); ?></p>
                        <div class="mt-4 flex items-center justify-between text-xs text-slate-400">
                            <span>v<?php echo htmlspecialchars($appVersion); ?></span>
                            <a href="?serve=appdev&action=details&app=<?php echo urlencode($appNick); ?>" class="font-semibold text-indigo-600 hover:text-indigo-500">Open</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="mt-8 rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-8 text-center">
                <h4 class="text-lg font-semibold text-slate-800">No studio builds yet</h4>
                <p class="mt-2 text-sm text-slate-500">Create your first app to populate the studio dashboard.</p>
                <a href="?serve=appdev&action=create" class="mt-4 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white">
                    <i class="fas fa-plus-circle"></i>
                    Launch New Build
                </a>
            </div>
        <?php endif; ?>
    </section>
</div>
