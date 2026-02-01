<?php
global $Me, $Apps;
$fullname = $Me->Fullname() ?? 'User';
$role = $Me->role() ?? 'User';
$email = $Me->email() ?? '';

$installedApps = [];
if (isset($Apps)) {
    $allApps = $Apps->getAll();
    foreach ($allApps as $app) {
        $nick = $app['Nick'] ?? null;
        if ($nick && $Apps->isInstalled($nick)) {
            $installedApps[] = $app;
        }
    }
}
?>

<section class="relative overflow-hidden rounded-3xl bg-slate-950 p-8 text-white shadow-xl sm:p-10">
    <div class="absolute inset-0 opacity-25">
        <div class="absolute -left-20 -top-20 h-64 w-64 rounded-full bg-indigo-500 blur-3xl"></div>
        <div class="absolute bottom-0 right-0 h-72 w-72 rounded-full bg-fuchsia-500 blur-3xl"></div>
    </div>
    <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-indigo-200">SaaS Command Center</p>
            <h1 class="mt-3 text-3xl font-semibold leading-tight sm:text-4xl">Welcome back, <?php echo htmlspecialchars($fullname); ?></h1>
            <p class="mt-3 max-w-2xl text-sm text-slate-200">
                Stay in control of your product suite, installed apps, and essential services from one unified dashboard built for speed and clarity.
            </p>
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="appdev" class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm transition hover:bg-slate-200">
                    <i class="fas fa-rocket"></i>
                    Open AppDev
                </a>
                <a href="profile" class="inline-flex items-center gap-2 rounded-full border border-white/40 px-4 py-2 text-sm font-semibold text-white transition hover:border-white">
                    <i class="fas fa-user-circle"></i>
                    View Profile
                </a>
                <div class="flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-4 py-2 text-xs text-white/80">
                    <i class="fas fa-id-badge"></i>
                    <?php echo htmlspecialchars($role); ?> · <?php echo htmlspecialchars($email); ?>
                </div>
            </div>
        </div>
        <div class="rounded-2xl border border-white/20 bg-white/10 p-6 backdrop-blur">
            <p class="text-xs uppercase tracking-[0.25em] text-indigo-200">Today</p>
            <p class="mt-2 text-2xl font-semibold">Your SaaS Stack</p>
            <p class="mt-2 text-sm text-slate-200">Jump into your most important services and keep momentum.</p>
            <div class="mt-4 flex flex-wrap gap-2">
                <a href="billing" class="rounded-full bg-emerald-500/20 px-3 py-1 text-xs font-semibold text-emerald-100">Billing</a>
                <a href="forum" class="rounded-full bg-indigo-500/20 px-3 py-1 text-xs font-semibold text-indigo-100">Forum</a>
                <a href="filemanager" class="rounded-full bg-amber-500/20 px-3 py-1 text-xs font-semibold text-amber-100">File Manager</a>
            </div>
        </div>
    </div>
</section>

<section class="mt-10">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-semibold text-slate-900">Services</h2>
            <p class="mt-1 text-sm text-slate-500">Core services ready for immediate access.</p>
        </div>
    </div>
    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
        <a href="?action=myprofile" class="group flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-lg">
            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                <i class="fas fa-user"></i>
            </span>
            <div>
                <p class="text-sm font-semibold text-slate-900">Profile</p>
                <p class="text-xs text-slate-500">Manage your account details.</p>
            </div>
            <i class="fas fa-arrow-right ml-auto text-slate-300 group-hover:text-indigo-500"></i>
        </a>
        <a href="appdev" class="group flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-cyan-200 hover:shadow-lg">
            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-cyan-50 text-cyan-600">
                <i class="fas fa-code"></i>
            </span>
            <div>
                <p class="text-sm font-semibold text-slate-900">AppDev</p>
                <p class="text-xs text-slate-500">Build and ship new apps.</p>
            </div>
            <i class="fas fa-arrow-right ml-auto text-slate-300 group-hover:text-cyan-500"></i>
        </a>
        <a href="blog" class="group flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-purple-200 hover:shadow-lg">
            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-50 text-purple-600">
                <i class="fas fa-blog"></i>
            </span>
            <div>
                <p class="text-sm font-semibold text-slate-900">Blog</p>
                <p class="text-xs text-slate-500">Publish updates and stories.</p>
            </div>
            <i class="fas fa-arrow-right ml-auto text-slate-300 group-hover:text-purple-500"></i>
        </a>
        <a href="filemanager" class="group flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-amber-200 hover:shadow-lg">
            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-600">
                <i class="fas fa-folder-open"></i>
            </span>
            <div>
                <p class="text-sm font-semibold text-slate-900">File Manager</p>
                <p class="text-xs text-slate-500">Organize assets and files.</p>
            </div>
            <i class="fas fa-arrow-right ml-auto text-slate-300 group-hover:text-amber-500"></i>
        </a>
        <a href="billing" class="group flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-lg">
            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                <i class="fas fa-credit-card"></i>
            </span>
            <div>
                <p class="text-sm font-semibold text-slate-900">Billing</p>
                <p class="text-xs text-slate-500">Track invoices and payments.</p>
            </div>
            <i class="fas fa-arrow-right ml-auto text-slate-300 group-hover:text-emerald-500"></i>
        </a>
        <a href="forum" class="group flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-lg">
            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                <i class="fas fa-comments"></i>
            </span>
            <div>
                <p class="text-sm font-semibold text-slate-900">Forum</p>
                <p class="text-xs text-slate-500">Engage with your community.</p>
            </div>
            <i class="fas fa-arrow-right ml-auto text-slate-300 group-hover:text-indigo-500"></i>
        </a>
    </div>
</section>

<section class="mt-12">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-semibold text-slate-900">Shortcut Actions</h2>
            <p class="mt-1 text-sm text-slate-500">Move fast with the most-used actions across your platform.</p>
        </div>
    </div>
    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
        <a href="appdev?action=create" class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-indigo-200 hover:shadow-lg">
            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                    <i class="fas fa-plus"></i>
                </span>
                <div>
                    <p class="text-sm font-semibold text-slate-900">Create App</p>
                    <p class="text-xs text-slate-500">Start a new SaaS app.</p>
                </div>
            </div>
        </a>
        <a href="?action=editmyprofile" class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-emerald-200 hover:shadow-lg">
            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                    <i class="fas fa-user-edit"></i>
                </span>
                <div>
                    <p class="text-sm font-semibold text-slate-900">Edit Profile</p>
                    <p class="text-xs text-slate-500">Update personal information.</p>
                </div>
            </div>
        </a>
        <a href="admin/blog?action=new" class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-purple-200 hover:shadow-lg">
            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-50 text-purple-600">
                    <i class="fas fa-pen-nib"></i>
                </span>
                <div>
                    <p class="text-sm font-semibold text-slate-900">New Blog Post</p>
                    <p class="text-xs text-slate-500">Draft a new article.</p>
                </div>
            </div>
        </a>
        <a href="?action=pageadd" class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-blue-200 hover:shadow-lg">
            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                    <i class="fas fa-file-alt"></i>
                </span>
                <div>
                    <p class="text-sm font-semibold text-slate-900">Add New Page</p>
                    <p class="text-xs text-slate-500">Create a new page quickly.</p>
                </div>
            </div>
        </a>
        <a href="?action=postadd" class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-amber-200 hover:shadow-lg">
            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                    <i class="fas fa-feather-alt"></i>
                </span>
                <div>
                    <p class="text-sm font-semibold text-slate-900">Dashboard Post</p>
                    <p class="text-xs text-slate-500">Post in the legacy CMS.</p>
                </div>
            </div>
        </a>
        <a href="?action=productadd" class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-rose-200 hover:shadow-lg">
            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-50 text-rose-600">
                    <i class="fas fa-box-open"></i>
                </span>
                <div>
                    <p class="text-sm font-semibold text-slate-900">Add Product</p>
                    <p class="text-xs text-slate-500">Expand your catalog.</p>
                </div>
            </div>
        </a>
    </div>
</section>

<section class="mt-12">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-semibold text-slate-900">Installed Apps</h2>
            <p class="mt-1 text-sm text-slate-500">Launch installed apps directly from your workspace.</p>
        </div>
        <a href="apps" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">Manage apps</a>
    </div>
    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
        <?php if (!empty($installedApps)) : ?>
            <?php foreach ($installedApps as $app) : ?>
                <?php
                $nick = $app['Nick'] ?? '';
                $name = $app['Name'] ?? $nick;
                $logo = $app['logo'] ?? null;
                $logoPath = $logo ? "Apps/{$nick}/{$logo}" : null;
                $hasLogo = $logoPath && file_exists($logoPath);
                ?>
                <a href="<?php echo strtolower($nick); ?>" class="group flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-lg">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-50 text-slate-600">
                        <?php if ($hasLogo) : ?>
                            <img src="<?php echo $logoPath; ?>" alt="<?php echo htmlspecialchars($name); ?> logo" class="h-10 w-10 rounded-xl object-cover" />
                        <?php else : ?>
                            <span class="text-sm font-semibold uppercase text-slate-500">
                                <?php echo htmlspecialchars(substr($name, 0, 2)); ?>
                            </span>
                        <?php endif; ?>
                    </span>
                    <div>
                        <p class="text-sm font-semibold text-slate-900"><?php echo htmlspecialchars($name); ?></p>
                        <p class="text-xs text-slate-500">Launch the app workspace.</p>
                    </div>
                    <i class="fas fa-arrow-right ml-auto text-slate-300 group-hover:text-indigo-500"></i>
                </a>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-6 text-center text-sm text-slate-500">
                No installed apps yet. Visit AppDev to create and install your first app.
            </div>
        <?php endif; ?>
    </div>
</section>
