<?php
// Welcome step with intro and CTA.
?>
<div class="grid gap-8 md:grid-cols-[1.2fr_0.8fr] items-center">
    <div>
        <h2 class="text-3xl font-semibold text-slate-900">Welcome to <?php echo installer_escape($productName); ?></h2>
        <p class="mt-4 text-slate-600">
            This wizard will guide you through configuring your database, verifying server requirements, and setting up your administrator account.
        </p>
        <ul class="mt-6 space-y-3 text-slate-600">
            <li class="flex items-center gap-2">
                <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                Verify server readiness
            </li>
            <li class="flex items-center gap-2">
                <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                Configure your database connection
            </li>
            <li class="flex items-center gap-2">
                <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                Create your admin account
            </li>
        </ul>
        <a href="?step=requirements" class="mt-8 inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-3 text-white font-medium shadow-sm hover:bg-blue-700">
            Get Started
        </a>
    </div>
    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
        <p class="text-sm uppercase text-slate-500">Before you begin</p>
        <h3 class="mt-3 text-xl font-semibold text-slate-900">What you'll need</h3>
        <p class="mt-2 text-slate-600">Database credentials, server access, and an admin email address.</p>
        <div class="mt-6 rounded-xl bg-white p-4 text-sm text-slate-500">
            <p class="font-medium text-slate-700">Branding note</p>
            <p class="mt-1">You can update the logo or colors in <code class="text-slate-700">installer/steps/layout.php</code>.</p>
        </div>
    </div>
</div>
