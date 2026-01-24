<?php
    global $Url;

$act = is_null($Url->get('action')) ? "home" : $Url->get('action');
$action = new $act();
include __DIR__ . '/../partials/ui-kit.php';

$currentAction = $Url->get('action') ?? 'home';
$navItemClass = function (string $action) use ($currentAction) {
    $base = 'flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition';
    if ($currentAction === $action) {
        return $base . ' bg-blue-50 text-blue-700';
    }
    return $base . ' text-slate-600 hover:bg-slate-100 hover:text-slate-900';
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="shortcut icon" href="assets/images/jslogobird.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/lib/font/css/all.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-900">
<div class="min-h-screen">
    <div class="sticky top-0 z-20 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6">
            <div class="flex items-center gap-3">
                <button class="rounded-lg border border-slate-200 bg-white p-2 text-slate-600 hover:bg-slate-50 lg:hidden" onclick="toggleAdminSidebar()">
                    <i class="fa fa-bars"></i>
                </button>
                <a href="?action=home" class="flex items-center gap-2">
                    <img src="assets/images/jsbn.png" alt="JamilX" class="h-8 w-auto">
                    <span class="text-sm font-semibold text-slate-700">Admin Console</span>
                </a>
            </div>
            <div class="hidden flex-1 px-6 lg:block">
                <label class="sr-only" for="admin-search">Search</label>
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                        <i class="fa fa-search"></i>
                    </span>
                    <input id="admin-search" type="search" placeholder="Search settings, users, apps..." class="<?php echo $ui['input']; ?> pl-9">
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button class="<?php echo $ui['btn_ghost']; ?>" aria-label="Notifications">
                    <i class="fa fa-bell"></i>
                </button>
                <button class="<?php echo $ui['btn_ghost']; ?>" aria-label="Help">
                    <i class="fa fa-question-circle"></i>
                </button>
                <div class="flex items-center gap-2 rounded-full border border-slate-200 bg-white px-2 py-1">
                    <img src="assets/images/user.png" alt="Admin" class="h-8 w-8 rounded-full">
                    <span class="hidden text-sm font-medium text-slate-600 sm:block">Admin</span>
                </div>
            </div>
        </div>
    </div>

    <div class="mx-auto flex max-w-7xl gap-6 px-4 py-6 sm:px-6">
        <aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-30 w-64 -translate-x-full border-r border-slate-200 bg-white px-4 py-6 transition lg:static lg:translate-x-0">
            <div class="flex items-center justify-between lg:hidden">
                <span class="text-sm font-semibold text-slate-700">Navigation</span>
                <button class="rounded-lg border border-slate-200 bg-white p-2 text-slate-600 hover:bg-slate-50" onclick="toggleAdminSidebar()">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="mt-6 flex flex-col gap-4">
                <a href="?action=createapp" class="<?php echo $ui['btn_primary']; ?>">
                    <i class="fa fa-plus"></i>
                    Create App
                </a>
                <nav class="flex flex-col gap-1 text-sm">
                    <a href="?action=home" class="<?php echo $navItemClass('home'); ?>">
                        <i class="fa fa-home"></i>
                        Dashboard
                    </a>
                    <a href="?action=createuser" class="<?php echo $navItemClass('createuser'); ?>">
                        <i class="fa fa-user-plus"></i>
                        Add User
                    </a>
                    <a href="?action=users" class="<?php echo $navItemClass('users'); ?>">
                        <i class="fa fa-users"></i>
                        Users
                    </a>
                    <a href="?action=createrole" class="<?php echo $navItemClass('createrole'); ?>">
                        <i class="fa fa-star"></i>
                        Roles
                    </a>
                    <a href="?action=readroles" class="<?php echo $navItemClass('readroles'); ?>">
                        <i class="fa fa-list"></i>
                        Role List
                    </a>
                    <a href="?action=applist" class="<?php echo $navItemClass('applist'); ?>">
                        <i class="fa fa-th"></i>
                        Apps
                    </a>
                    <a href="?action=createcat" class="<?php echo $navItemClass('createcat'); ?>">
                        <i class="fa fa-plus"></i>
                        Add Category
                    </a>
                    <a href="?action=readcats" class="<?php echo $navItemClass('readcats'); ?>">
                        <i class="fa fa-code-branch"></i>
                        Categories
                    </a>
                    <a href="?action=updatecomp" class="<?php echo $navItemClass('updatecomp'); ?>">
                        <i class="fa fa-cog"></i>
                        Settings
                    </a>
                    <a href="?action=about" class="<?php echo $navItemClass('about'); ?>">
                        <i class="fa fa-umbrella"></i>
                        About
                    </a>
                    <a href="jxdoc" class="<?php echo $navItemClass('help'); ?>">
                        <i class="fa fa-question"></i>
                        Help Docs
                    </a>
                </nav>
            </div>
        </aside>

        <main class="min-w-0 flex-1 lg:ml-0">
            <div class="rounded-3xl bg-white/70 p-4 shadow-sm sm:p-6">
                <?php $action->getAction(); ?>
            </div>
        </main>
    </div>
</div>

<script>
    function toggleAdminSidebar() {
        const sidebar = document.getElementById('admin-sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }
</script>
</body>
</html>
