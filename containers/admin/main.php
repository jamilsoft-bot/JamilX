<section class="space-y-6">
    <header class="rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-5 text-white shadow-sm">
        <h3 class="text-xl font-semibold">Welcome to Admin</h3>
        <p class="text-sm text-blue-100">Quickly access user and app administration tools.</p>
    </header>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Users</p>
                    <h2 class="mt-2 text-3xl font-semibold text-slate-900">
                        <i class="fa fa-users text-blue-500"></i>
                        <?php echo JX_get_total_users(); ?>
                    </h2>
                </div>
                <div class="flex gap-2">
                    <a href="?action=createuser" class="rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-600 hover:border-blue-200 hover:text-blue-600"><i class="fa fa-plus"></i></a>
                    <a href="?action=users" class="rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-600 hover:border-blue-200 hover:text-blue-600"><i class="fa fa-eye"></i></a>
                    <a class="rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-600 hover:border-blue-200 hover:text-blue-600"><i class="fa fa-recycle"></i></a>
                </div>
            </div>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Apps</p>
                    <h2 class="mt-2 text-3xl font-semibold text-slate-900">
                        <i class="fas fa-th text-indigo-500"></i>
                        <?php echo JX_get_total_apps(); ?>
                    </h2>
                </div>
                <div class="flex gap-2">
                    <a class="rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-600 hover:border-blue-200 hover:text-blue-600"><i class="fa fa-plus"></i></a>
                    <a class="rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-600 hover:border-blue-200 hover:text-blue-600"><i class="fa fa-eye"></i></a>
                    <a class="rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-600 hover:border-blue-200 hover:text-blue-600"><i class="fa fa-recycle"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <a href="?action=createuser" class="group rounded-2xl border border-slate-200 bg-white p-5 text-center shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:shadow-md">
            <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-blue-50 text-blue-600">
                <i class="fa fa-user-plus"></i>
            </div>
            <p class="text-sm font-semibold text-slate-900">Add New User</p>
        </a>
        <a href="" class="group rounded-2xl border border-slate-200 bg-white p-5 text-center shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:shadow-md">
            <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-600">
                <i class="fa fa-cog"></i>
            </div>
            <p class="text-sm font-semibold text-slate-900">Settings</p>
        </a>
        <a href="" class="group rounded-2xl border border-slate-200 bg-white p-5 text-center shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:shadow-md">
            <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-amber-50 text-amber-600">
                <i class="fa fa-info"></i>
            </div>
            <p class="text-sm font-semibold text-slate-900">System Status</p>
        </a>
        <a href="?action=about" class="group rounded-2xl border border-slate-200 bg-white p-5 text-center shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:shadow-md">
            <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-indigo-50 text-indigo-600">
                <i class="fas fa-umbrella"></i>
            </div>
            <p class="text-sm font-semibold text-slate-900">About</p>
        </a>
        <a href="" class="group rounded-2xl border border-slate-200 bg-white p-5 text-center shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:shadow-md">
            <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">
                <i class="fa fa-question"></i>
            </div>
            <p class="text-sm font-semibold text-slate-900">Help</p>
        </a>
    </div>
</section>
