<?php
// Determine current action for active state
global $Url;
$currentAction = $Url->get('action') ?? 'emailhome';

function navClass($actionName, $currentAction)
{
    if ($actionName === $currentAction) {
        return "bg-blue-50 text-blue-700 group flex items-center px-3 py-2 text-sm font-medium rounded-md w-full transition-colors";
    }
    return "text-slate-700 hover:bg-slate-50 hover:text-slate-900 group flex items-center px-3 py-2 text-sm font-medium rounded-md w-full transition-colors";
}

function iconClass($actionName, $currentAction)
{
    if ($actionName === $currentAction) {
        return "text-blue-500 mr-3 flex-shrink-0 h-5 w-5";
    }
    return "text-slate-400 group-hover:text-slate-500 mr-3 flex-shrink-0 h-5 w-5";
}
?>

<!-- Top Navbar (Mobile/Tablet) -->
<div class="lg:hidden border-b border-slate-200 bg-white px-4 py-3 flex justify-between items-center">
    <a href="dashboard" class="flex items-center gap-2">
        <img src="assets/images/jsbn.png" alt="JamilX" class="h-8 w-auto">
        <span class="font-semibold text-slate-900">Email Service</span>
    </a>
    <button type="button" class="-mr-2 h-10 w-10 inline-flex items-center justify-center rounded-md p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
        <span class="sr-only">Open menu</span>
        <i class="fas fa-bars"></i>
    </button>
</div>

<!-- Mobile Menu -->
<div class="hidden lg:hidden bg-white border-b border-slate-200 px-4 py-2" id="mobile-menu">
    <nav class="space-y-1">
        <a href="?action=emailhome" class="<?php echo navClass('emailhome', $currentAction); ?>">
            <i class="fas fa-home <?php echo iconClass('emailhome', $currentAction); ?>"></i>
            Overview
        </a>
        <a href="?action=emailconfig" class="<?php echo navClass('emailconfig', $currentAction); ?>">
            <i class="fas fa-cog <?php echo iconClass('emailconfig', $currentAction); ?>"></i>
            Configuration
        </a>
        <a href="?action=emailtest" class="<?php echo navClass('emailtest', $currentAction); ?>">
            <i class="fas fa-paper-plane <?php echo iconClass('emailtest', $currentAction); ?>"></i>
            Send Test
        </a>
        <a href="?action=emaillogs" class="<?php echo navClass('emaillogs', $currentAction); ?>">
            <i class="fas fa-list-alt <?php echo iconClass('emaillogs', $currentAction); ?>"></i>
            Logs
        </a>
        <!-- Add more links here -->
        <a href="dashboard" class="text-slate-600 hover:bg-slate-50 group flex items-center px-3 py-2 text-sm font-medium rounded-md w-full mt-4 border-t border-slate-100 pt-4">
            <i class="fas fa-arrow-left mr-3 text-slate-400"></i> Back to Dashboard
        </a>
    </nav>
</div>

<!-- Sidebar (Desktop) -->
<div class="hidden lg:flex lg:flex-col lg:w-64 lg:fixed lg:inset-y-0 lg:border-r lg:border-slate-200 lg:bg-white lg:pt-5 lg:pb-4">
    <div class="flex items-center flex-shrink-0 px-6 mb-6">
        <img class="h-8 w-auto" src="assets/images/jslogobird.png" alt="JamilX Logo">
        <span class="ml-3 text-lg font-bold text-slate-900">Email Service</span>
    </div>
    <div class="flex-1 flex flex-col overflow-y-auto">
        <nav class="flex-1 px-4 space-y-1">
            <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-2">Manage</p>

            <a href="?action=emailhome" class="<?php echo navClass('emailhome', $currentAction); ?>">
                <i class="fas fa-home <?php echo iconClass('emailhome', $currentAction); ?>"></i>
                Overview
            </a>

            <a href="?action=emailconfig" class="<?php echo navClass('emailconfig', $currentAction); ?>">
                <i class="fas fa-cog <?php echo iconClass('emailconfig', $currentAction); ?>"></i>
                Configuration
            </a>

            <a href="?action=queue" class="<?php echo navClass('emailqueue', $currentAction); ?>">
                <i class="fas fa-layer-group <?php echo iconClass('emailqueue', $currentAction); ?>"></i>
                Queue
            </a>

            <a href="?action=emaillogs" class="<?php echo navClass('emaillogs', $currentAction); ?>">
                <i class="fas fa-list-alt <?php echo iconClass('emaillogs', $currentAction); ?>"></i>
                Delivery Logs
            </a>

            <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-6">Actions</p>

            <a href="?action=emailtest" class="<?php echo navClass('emailtest', $currentAction); ?>">
                <i class="fas fa-paper-plane <?php echo iconClass('emailtest', $currentAction); ?>"></i>
                Send Test Email
            </a>

            <a href="?action=emailselftest" class="<?php echo navClass('emailselftest', $currentAction); ?>">
                <i class="fas fa-vial <?php echo iconClass('emailselftest', $currentAction); ?>"></i>
                Diagnostics
            </a>

        </nav>
    </div>
    <div class="flex-shrink-0 flex border-t border-slate-200 p-4">
        <a href="dashboard" class="flex-shrink-0 w-full group block">
            <div class="flex items-center">
                <div class="ml-3">
                    <p class="text-sm font-medium text-slate-700 group-hover:text-slate-900">Back to Dashboard</p>
                    <p class="text-xs font-medium text-slate-500 group-hover:text-slate-700">Exit Email Service</p>
                </div>
                <i class="fas fa-sign-out-alt ml-auto text-slate-400 group-hover:text-slate-500"></i>
            </div>
        </a>
    </div>
</div>