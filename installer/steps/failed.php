<?php
// Failure step for installation errors.
?>
<div>
    <div class="flex items-start gap-4">
        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-rose-50 text-rose-600">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
        </div>
        <div>
            <h2 class="text-2xl font-semibold text-slate-900">Installation Failed</h2>
            <p class="mt-2 text-slate-600">Something went wrong during setup. Review the details and retry once the issue is resolved.</p>
        </div>
    </div>

    <?php if ($flash && !empty($flash['details'])) : ?>
        <div class="mt-6 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-rose-700">
            <p class="font-medium">Error details</p>
            <ul class="mt-2 list-disc pl-5 text-sm">
                <?php foreach ($flash['details'] as $detail) : ?>
                    <li><?php echo installer_escape((string) $detail); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="mt-6 rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600">
        <p class="font-medium text-slate-800">Next steps</p>
        <ul class="mt-2 list-disc pl-5">
            <li>Confirm your database credentials are correct.</li>
            <li>Ensure the database user has permission to create tables.</li>
            <li>Review server logs for additional context.</li>
        </ul>
    </div>

    <div class="mt-6 flex flex-wrap gap-3">
        <a href="?step=install" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2 font-medium text-white shadow-sm hover:bg-blue-700">Retry Installation</a>
        <a href="?step=database" class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-slate-600 hover:bg-slate-50">Back to Database</a>
    </div>
</div>
