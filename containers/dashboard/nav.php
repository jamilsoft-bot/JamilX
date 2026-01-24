<?php
    global $Me;
    $avatar = $Me->pic();
    $avatarPath = $avatar == null ? 'assets/images/user.png' : "data/$avatar";
?>
<div class="sticky top-0 z-20 border-b border-slate-200 bg-white/95 backdrop-blur">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6">
        <div class="flex items-center gap-3">
            <button class="rounded-lg border border-slate-200 bg-white p-2 text-slate-600 hover:bg-slate-50 lg:hidden" onclick="toggleDashboardSidebar()">
                <i class="fa fa-bars"></i>
            </button>
            <a href="?action=dashboardmain" class="flex items-center gap-2">
                <img src="assets/images/jsbn2.png" alt="JamilX" class="h-6 w-auto">
                <span class="text-sm font-semibold text-slate-700">User Dashboard</span>
            </a>
        </div>
        <div class="hidden flex-1 px-6 lg:block">
            <label class="sr-only" for="dashboard-search">Search</label>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                    <i class="fa fa-search"></i>
                </span>
                <input id="dashboard-search" type="search" placeholder="Search apps, pages, emails..." class="<?php echo $ui['input']; ?> pl-9">
            </div>
        </div>
        <div class="flex items-center gap-3">
            <button class="<?php echo $ui['btn_ghost']; ?>" aria-label="Notifications">
                <i class="fa fa-bell"></i>
            </button>
            <div class="relative">
                <button class="flex items-center gap-2 rounded-full border border-slate-200 bg-white px-2 py-1 text-sm font-medium text-slate-600" onclick="toggleDashboardMenu()">
                    <img src="<?php echo $avatarPath; ?>" alt="User" class="h-8 w-8 rounded-full">
                    <span class="hidden sm:block">Account</span>
                    <i class="fa fa-chevron-down text-xs"></i>
                </button>
                <div id="dashboard-menu" class="absolute right-0 mt-2 hidden w-48 rounded-xl border border-slate-200 bg-white p-2 text-sm shadow-lg">
                    <a href="?action=myprofile" class="block rounded-lg px-3 py-2 text-slate-600 hover:bg-slate-100">My Profile</a>
                    <a href="?action=editmyprofile" class="block rounded-lg px-3 py-2 text-slate-600 hover:bg-slate-100">Settings</a>
                    <a href="about" class="block rounded-lg px-3 py-2 text-slate-600 hover:bg-slate-100">Help Center</a>
                    <a href="logout" class="block rounded-lg px-3 py-2 text-slate-600 hover:bg-slate-100">Sign out</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleDashboardMenu() {
        const menu = document.getElementById('dashboard-menu');
        menu.classList.toggle('hidden');
    }
</script>
