<?php
// Success step shown after installation completes.
?>
<div class="text-center">
    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">
        <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M20 6 9 17l-5-5"></path>
        </svg>
    </div>
    <h2 class="mt-6 text-2xl font-semibold text-slate-900">Installation Complete</h2>
    <p class="mt-2 text-slate-600">Your platform is ready. You can now log in to the admin dashboard.</p>

    <div class="mt-6 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-amber-700 text-sm">
        <p class="font-medium">Security recommendation</p>
        <p class="mt-1">Delete or restrict access to the <code>/installer</code> directory now that setup is complete.</p>
    </div>

    <div class="mt-8 flex flex-wrap justify-center gap-3">
        <a href="../login&resume=admin" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2 font-medium text-white shadow-sm hover:bg-blue-700">Go to Admin</a>
        <a href="?step=welcome" class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-slate-600 hover:bg-slate-50">Back to Start</a>
    </div>
</div>
