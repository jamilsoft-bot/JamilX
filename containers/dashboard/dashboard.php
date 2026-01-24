<?php include "header.php";?>
<?php include "nav.php";?>

<?php
$currentAction = $_GET['action'] ?? 'dashboardmain';
$dashboardNavClass = function (string $action) use ($currentAction) {
    $base = 'flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition';
    if ($currentAction === $action) {
        return $base . ' bg-blue-50 text-blue-700';
    }
    return $base . ' text-slate-600 hover:bg-slate-100 hover:text-slate-900';
};
?>

<div class="mx-auto flex max-w-7xl gap-6 px-4 py-6 sm:px-6">
    <aside id="dashboard-sidebar" class="fixed inset-y-0 left-0 z-30 w-64 -translate-x-full border-r border-slate-200 bg-white px-4 py-6 transition lg:static lg:translate-x-0">
        <div class="flex items-center justify-between lg:hidden">
            <span class="text-sm font-semibold text-slate-700">Menu</span>
            <button class="rounded-lg border border-slate-200 bg-white p-2 text-slate-600 hover:bg-slate-50" onclick="toggleDashboardSidebar()">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <div class="mt-6 space-y-4">
            <a href="?action=dashboardmain" class="<?php echo $dashboardNavClass('dashboardmain'); ?>">
                <i class="fa fa-home"></i>
                Overview
            </a>
            <a href="?action=emails" class="<?php echo $dashboardNavClass('emails'); ?>">
                <i class="fa fa-envelope"></i>
                Email Campaigns
            </a>
            <a href="?action=pages" class="<?php echo $dashboardNavClass('pages'); ?>">
                <i class="fa fa-file-alt"></i>
                Pages
            </a>
            <a href="?action=updatesetting" class="<?php echo $dashboardNavClass('updatesetting'); ?>">
                <i class="fa fa-cog"></i>
                Business Settings
            </a>
            <a href="?action=myprofile" class="<?php echo $dashboardNavClass('myprofile'); ?>">
                <i class="fa fa-user"></i>
                My Profile
            </a>
            <a href="about" class="<?php echo $dashboardNavClass('about'); ?>">
                <i class="fa fa-life-ring"></i>
                Support
            </a>
        </div>
        <div class="mt-8 rounded-2xl border border-blue-100 bg-blue-50 p-4 text-sm text-slate-600">
            <p class="font-semibold text-blue-700">Need help?</p>
            <p class="mt-1 text-xs text-blue-700">Visit the help center or reach out to support for quick answers.</p>
            <a href="about" class="mt-3 inline-flex text-xs font-semibold text-blue-700">Go to help →</a>
        </div>
    </aside>

    <main class="min-w-0 flex-1 lg:ml-0">
        <div class="rounded-3xl bg-white/70 p-4 shadow-sm sm:p-6">
            <header class="mb-6">
                <p class="text-xs font-semibold uppercase tracking-wide text-blue-600">Dashboard</p>
                <h1 class="text-2xl font-bold text-slate-900"><?php echo $getAction->getTitle();?></h1>
                <?php if ($getAction->getText() !== '') : ?>
                    <p class="mt-1 text-sm text-slate-500"><?php echo $getAction->getText();?></p>
                <?php endif; ?>
            </header>
            <div>
                <?php $getAction->getAction(); ?>
            </div>
        </div>
    </main>
</div>

<script>
    function toggleDashboardSidebar() {
        const sidebar = document.getElementById('dashboard-sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }
</script>
</body>
</html>
