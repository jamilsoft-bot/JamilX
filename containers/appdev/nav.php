<?php
global $Url;
$currentAction = $Url->get('action') ?? 'home';

function appdevNavClass($actionName, $currentAction)
{
    $base = "flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all";
    if ($actionName === $currentAction) {
        return $base . " bg-blue-50 text-blue-700 border-l-4 border-blue-600";
    }
    return $base . " text-slate-600 hover:bg-slate-50 hover:text-slate-900 border-l-4 border-transparent";
}
?>

<!-- Mobile Header -->
<div class="lg:hidden border-b border-slate-200 bg-white px-4 py-3 flex justify-between items-center sticky top-0 z-30">
    <div class="flex items-center gap-2">
        <img src="assets/images/jslogobird.png" alt="JamilX" class="h-8 w-8">
        <span class="font-bold text-slate-900">App Dev</span>
    </div>
    <button type="button" class="p-2 rounded-lg hover:bg-slate-100" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
        <i class="fas fa-bars text-slate-600"></i>
    </button>
</div>

<!-- Mobile Menu -->
<div class="hidden lg:hidden bg-white border-b border-slate-200 px-4 py-2 shadow-lg" id="mobile-menu">
    <nav class="space-y-1 py-2">
        <a href="?serve=appdev&action=home" class="<?php echo appdevNavClass('home', $currentAction); ?>">
            <i class="fas fa-home"></i> Overview
        </a>
        <a href="?serve=appdev&action=studio" class="<?php echo appdevNavClass('studio', $currentAction); ?>">
            <i class="fas fa-layer-group"></i> Studio
        </a>
        <a href="?serve=appdev&action=editor" class="<?php echo appdevNavClass('editor', $currentAction); ?>">
            <i class="fas fa-code"></i> Code Editor
        </a>
        <a href="?serve=appdev&action=list" class="<?php echo appdevNavClass('list', $currentAction); ?>">
            <i class="fas fa-th-large"></i> My Apps
        </a>
        <a href="?serve=appdev&action=create" class="<?php echo appdevNavClass('create', $currentAction); ?>">
            <i class="fas fa-plus-circle"></i> Create App
        </a>
        <a href="dashboard" class="text-slate-600 hover:bg-slate-50 flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium mt-4 border-t border-slate-100 pt-4">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
    </nav>
</div>

<!-- Desktop Sidebar -->
<div class="hidden lg:flex lg:flex-col lg:w-64 lg:fixed lg:inset-y-0 lg:border-r lg:border-slate-200 lg:bg-white">
    <!-- Logo -->
    <div class="flex items-center gap-3 px-6 py-5 border-b border-slate-200">
        <div class="bg-gradient-to-br from-blue-600 to-indigo-600 p-2 rounded-xl">
            <i class="fas fa-rocket text-white text-xl"></i>
        </div>
        <div>
            <h2 class="font-bold text-slate-900">App Development</h2>
            <p class="text-xs text-slate-500">Build & Manage</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
        <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Main</p>

        <a href="?serve=appdev&action=home" class="<?php echo appdevNavClass('home', $currentAction); ?>">
            <i class="fas fa-home w-5"></i>
            <span>Overview</span>
        </a>

        <a href="?serve=appdev&action=studio" class="<?php echo appdevNavClass('studio', $currentAction); ?>">
            <i class="fas fa-layer-group w-5"></i>
            <span>Studio</span>
        </a>

        <a href="?serve=appdev&action=editor" class="<?php echo appdevNavClass('editor', $currentAction); ?>">
            <i class="fas fa-code w-5"></i>
            <span>Code Editor</span>
        </a>

        <a href="?serve=appdev&action=list" class="<?php echo appdevNavClass('list', $currentAction); ?>">
            <i class="fas fa-th-large w-5"></i>
            <span>My Applications</span>
        </a>

        <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider mt-6 mb-3">Actions</p>

        <a href="?serve=appdev&action=create" class="<?php echo appdevNavClass('create', $currentAction); ?>">
            <i class="fas fa-plus-circle w-5"></i>
            <span>Create New App</span>
        </a>

        <a href="?serve=appdev&action=settings" class="<?php echo appdevNavClass('settings', $currentAction); ?>">
            <i class="fas fa-cog w-5"></i>
            <span>Settings</span>
        </a>

        <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider mt-6 mb-3">Resources</p>

        <a href="jxdoc" class="<?php echo appdevNavClass('docs', $currentAction); ?>">
            <i class="fas fa-book w-5"></i>
            <span>Documentation</span>
        </a>
    </nav>

    <!-- Footer -->
    <div class="border-t border-slate-200 p-4">
        <a href="dashboard" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors">
            <i class="fas fa-arrow-left w-5"></i>
            <span>Back to Dashboard</span>
        </a>
    </div>
</div>
