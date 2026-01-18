<?php
// Step shown if an installed lock is detected.
?>
<div class="text-center">
    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-amber-50 text-amber-600">
        <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="8" x2="12" y2="12"></line>
            <line x1="12" y1="16" x2="12.01" y2="16"></line>
        </svg>
    </div>
    <h2 class="mt-6 text-2xl font-semibold text-slate-900">Installer Disabled</h2>
    <p class="mt-2 text-slate-600">An installation lock file was detected. Setup is already complete.</p>
    <p class="mt-4 text-sm text-slate-500">If you need to reinstall, remove <code><?php echo installer_escape($installedFlagPath); ?></code> and reload this page.</p>

    <div class="mt-8 flex flex-wrap justify-center gap-3">
        <a href="../login&resume=admin" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2 font-medium text-white shadow-sm hover:bg-blue-700">Go to Admin</a>
        <a href="/" class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-slate-600 hover:bg-slate-50">Return Home</a>
    </div>
</div>
