<div class="border-b border-slate-200 bg-white">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3">
        <div class="flex items-center gap-3">
            <button class="rounded-lg border border-slate-200 bg-white p-2 text-slate-600 hover:bg-slate-50 lg:hidden" onclick="w3.toggleShow('#navbar')">
                <i class="fa fa-bars"></i>
            </button>
            <a class="flex items-center gap-2 text-slate-800" style="text-decoration: none;font-weight: bolder;">
                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-600 text-white">
                    <i class="fa fa-home"></i>
                </span>
                <span class="text-sm font-semibold">Jamilsoft Admin</span>
            </a>
        </div>
        <div class="hidden items-center gap-2 text-slate-500 lg:flex">
            <button class="rounded-lg p-2 hover:bg-slate-100"><i class="fa fa-globe"></i></button>
            <button class="rounded-lg p-2 hover:bg-slate-100"><i class="fa fa-envelope"></i></button>
            <button class="rounded-lg p-2 hover:bg-slate-100"><i class="fa fa-users"></i></button>
        </div>
        <div class="hidden items-center gap-2 lg:flex">
            <button class="rounded-lg border border-slate-200 bg-white p-2 text-slate-600 hover:bg-slate-50"><i class="fas fa-comments"></i></button>
            <button class="rounded-lg border border-slate-200 bg-white p-2 text-slate-600 hover:bg-slate-50"><i class="fa fa-bell"></i></button>
            <button class="rounded-lg border border-slate-200 bg-white p-2 text-slate-600 hover:bg-slate-50"><i class="fa fa-user"></i></button>
            <button class="rounded-lg border border-slate-200 bg-white p-2 text-slate-600 hover:bg-slate-50"><i class="fa fa-cog"></i></button>
            <button class="rounded-lg border border-slate-200 bg-white p-2 text-slate-600 hover:bg-slate-50"><i class="fas fa-sign-out-alt"></i></button>
        </div>
    </div>
    <div class="hidden border-t border-slate-200 bg-slate-50 px-4 py-3 lg:hidden" id="navbar">
        <div class="grid gap-2 text-sm text-slate-700">
            <a class="flex items-center gap-2 rounded-lg px-3 py-2 hover:bg-white"><i class="fa fa-user"></i> Profile</a>
            <a class="flex items-center gap-2 rounded-lg px-3 py-2 hover:bg-white"><i class="fa fa-envelope"></i> Message</a>
            <a class="flex items-center gap-2 rounded-lg px-3 py-2 hover:bg-white"><i class="fa fa-bell"></i> Notification</a>
        </div>
    </div>
</div>
