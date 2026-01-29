<div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
    <?php $qr = "?";?>
    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Quick Links</p>
    <div class="mt-4 flex flex-col gap-1 text-sm">
        <a href="?action=home" class="flex items-center gap-3 rounded-lg px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 <?php check_nav('bg-blue-50 text-blue-700','home'); ?>">
            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600"><i class="fas fa-business-time"></i></span>
            Dashboard
        </a>
        <a href="?action=users" class="flex items-center gap-3 rounded-lg px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 <?php check_nav('bg-blue-50 text-blue-700','users'); ?>">
            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600"><i class="fas fa-users"></i></span>
            Users
        </a>
        <a href="?action=applist" class="flex items-center gap-3 rounded-lg px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 <?php check_nav('bg-blue-50 text-blue-700','applist'); ?>">
            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-50 text-purple-600"><i class="fas fa-th"></i></span>
            Apps
        </a>
        <a href="" class="flex items-center gap-3 rounded-lg px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 <?php check_nav('bg-blue-50 text-blue-700','setting'); ?>">
            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-slate-500"><i class="fa fa-cogs"></i></span>
            Settings
        </a>
        <a href="?action=about" class="flex items-center gap-3 rounded-lg px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 <?php check_nav('bg-blue-50 text-blue-700','about'); ?>">
            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-50 text-amber-600"><i class="fa fa-umbrella"></i></span>
            About
        </a>
    </div>
</div>
