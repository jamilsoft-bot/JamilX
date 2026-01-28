<?php
// Determine current action for active state
global $Url;
$currentAction = $Url->get('action') ?? 'dashboardmain';

function dashboardNavClass($actionName, $currentAction)
{
    if ($actionName === $currentAction) {
        return "bg-blue-50 text-blue-700 group flex items-center px-3 py-2 text-sm font-medium rounded-md w-full transition-colors border-l-4 border-blue-600";
    }
    return "text-slate-700 hover:bg-slate-50 hover:text-slate-900 group flex items-center px-3 py-2 text-sm font-medium rounded-md w-full transition-colors border-l-4 border-transparent";
}

function dashboardIconClass($actionName, $currentAction)
{
    if ($actionName === $currentAction) {
        return "text-blue-500 mr-3 flex-shrink-0 h-5 w-5";
    }
    return "text-slate-400 group-hover:text-slate-500 mr-3 flex-shrink-0 h-5 w-5";
}
?>

<!-- Mobile Top Bar -->
<div class="lg:hidden border-b border-slate-200 bg-white px-4 py-3 flex justify-between items-center sticky top-0 z-30">
    <a href="dashboard" class="flex items-center gap-2">
        <img src="assets/images/jsbn.png" alt="JamilX" class="h-8 w-auto">
    </a>
    <button type="button" class="-mr-2 h-10 w-10 inline-flex items-center justify-center rounded-md p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
        <span class="sr-only">Open menu</span>
        <i class="fas fa-bars"></i>
    </button>
</div>

<!-- Mobile Menu -->
<div class="hidden lg:hidden bg-white border-b border-slate-200 px-4 py-2 fixed w-full z-20 shadow-lg" id="mobile-menu">
    <nav class="space-y-1">
        <a href="?action=dashboardmain" class="<?php echo dashboardNavClass('dashboardmain', $currentAction); ?>">
            <i class="fas fa-home <?php echo dashboardIconClass('dashboardmain', $currentAction); ?>"></i>
            Overview
        </a>
        <a href="?action=emails" class="<?php echo dashboardNavClass('emails', $currentAction); ?>">
            <i class="fas fa-envelope <?php echo dashboardIconClass('emails', $currentAction); ?>"></i>
            Email Campaigns
        </a>
        <a href="?action=pages" class="<?php echo dashboardNavClass('pages', $currentAction); ?>">
            <i class="fas fa-file-alt <?php echo dashboardIconClass('pages', $currentAction); ?>"></i>
            Pages
        </a>
        <a href="?action=cats" class="<?php echo dashboardNavClass('cats', $currentAction); ?>">
            <i class="fas fa-tags <?php echo dashboardIconClass('cats', $currentAction); ?>"></i>
            Categories
        </a>
        <a href="?action=products" class="<?php echo dashboardNavClass('products', $currentAction); ?>">
            <i class="fas fa-box <?php echo dashboardIconClass('products', $currentAction); ?>"></i>
            Products
        </a>
        <a href="?action=posts" class="<?php echo dashboardNavClass('posts', $currentAction); ?>">
            <i class="fas fa-pen-nib <?php echo dashboardIconClass('posts', $currentAction); ?>"></i>
            Posts
        </a>
        <a href="?action=myprofile" class="<?php echo dashboardNavClass('myprofile', $currentAction); ?>">
            <i class="fas fa-user <?php echo dashboardIconClass('myprofile', $currentAction); ?>"></i>
            My Profile
        </a>
        <a href="?action=updatesetting" class="<?php echo dashboardNavClass('updatesetting', $currentAction); ?>">
            <i class="fas fa-cog <?php echo dashboardIconClass('updatesetting', $currentAction); ?>"></i>
            Business Settings
        </a>
        <a href="login?action=logout" class="text-red-600 hover:bg-red-50 group flex items-center px-3 py-2 text-sm font-medium rounded-md w-full mt-4 border-t border-slate-100 pt-4">
            <i class="fas fa-sign-out-alt mr-3 text-red-400"></i> Logout
        </a>
    </nav>
</div>

<!-- Desktop Sidebar -->
<div class="hidden lg:flex lg:flex-col lg:w-64 lg:fixed lg:inset-y-0 lg:border-r lg:border-slate-200 lg:bg-white lg:pt-5 lg:pb-4">
    <div class="flex items-center flex-shrink-0 px-6 mb-8">
        <img class="h-8 w-auto" src="assets/images/jslogobird.png" alt="JamilX Logo">
        <span class="ml-3 text-lg font-bold text-slate-900 tracking-tight">JamilX</span>
    </div>

    <div class="flex-1 flex flex-col overflow-y-auto px-4">
        <nav class="flex-1 space-y-1">
            <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-2">Core</p>

            <a href="?action=dashboardmain" class="<?php echo dashboardNavClass('dashboardmain', $currentAction); ?>">
                <i class="fas fa-home <?php echo dashboardIconClass('dashboardmain', $currentAction); ?>"></i>
                Overview
            </a>

            <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-6">Content</p>

            <a href="?action=pages" class="<?php echo dashboardNavClass('pages', $currentAction); ?>">
                <i class="fas fa-file-alt <?php echo dashboardIconClass('pages', $currentAction); ?>"></i>
                Pages
            </a>
            <a href="?action=posts" class="<?php echo dashboardNavClass('posts', $currentAction); ?>">
                <i class="fas fa-pen-nib <?php echo dashboardIconClass('posts', $currentAction); ?>"></i>
                Posts
            </a>
            <a href="?action=cats" class="<?php echo dashboardNavClass('cats', $currentAction); ?>">
                <i class="fas fa-tags <?php echo dashboardIconClass('cats', $currentAction); ?>"></i>
                Categories
            </a>
            <a href="?action=medialist" class="<?php echo dashboardNavClass('medialist', $currentAction); ?>">
                <i class="fas fa-images <?php echo dashboardIconClass('medialist', $currentAction); ?>"></i>
                Media Library
            </a>

            <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-6">Marketing</p>

            <a href="?action=emails" class="<?php echo dashboardNavClass('emails', $currentAction); ?>">
                <i class="fas fa-envelope <?php echo dashboardIconClass('emails', $currentAction); ?>"></i>
                Email Campaigns
            </a>
            <a href="?action=products" class="<?php echo dashboardNavClass('products', $currentAction); ?>">
                <i class="fas fa-box <?php echo dashboardIconClass('products', $currentAction); ?>"></i>
                Products
            </a>
            <a href="?action=offers" class="<?php echo dashboardNavClass('offers', $currentAction); ?>">
                <i class="fas fa-percent <?php echo dashboardIconClass('offers', $currentAction); ?>"></i>
                Offers
            </a>

            <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-6">Settings</p>

            <a href="?action=updatesetting" class="<?php echo dashboardNavClass('updatesetting', $currentAction); ?>">
                <i class="fas fa-cog <?php echo dashboardIconClass('updatesetting', $currentAction); ?>"></i>
                Business Settings
            </a>
            <a href="?action=myprofile" class="<?php echo dashboardNavClass('myprofile', $currentAction); ?>">
                <i class="fas fa-user <?php echo dashboardIconClass('myprofile', $currentAction); ?>"></i>
                My Profile
            </a>
        </nav>
    </div>

    <div class="flex-shrink-0 flex border-t border-slate-200 p-4">
        <a href="login?action=logout" class="flex-shrink-0 w-full group block">
            <div class="flex items-center">
                <div class="ml-3">
                    <p class="text-sm font-medium text-slate-700 group-hover:text-slate-900">Sign Out</p>
                </div>
                <i class="fas fa-sign-out-alt ml-auto text-slate-400 group-hover:text-red-500"></i>
            </div>
        </a>
    </div>
</div>