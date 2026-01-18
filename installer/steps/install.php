<?php
// Install step to execute SQL migration.
?>
<div>
    <h2 class="text-2xl font-semibold text-slate-900">Install Database</h2>
    <p class="mt-2 text-slate-600">We're ready to create the required tables. This step mirrors the legacy installer SQL import.</p>

    <div class="mt-6 rounded-lg border border-slate-200 bg-slate-50 p-4 text-sm text-slate-600">
        <p class="font-medium text-slate-800">What happens next</p>
        <ul class="mt-2 list-disc pl-5">
            <li>Run <code>installer/sql.sql</code> against your database.</li>
            <li>Prepare the system for company and admin setup.</li>
        </ul>
    </div>

    <form method="post" class="mt-6" data-validate-form>
        <input type="hidden" name="action" value="run_install">
        <div class="flex flex-wrap gap-3">
            <a href="?step=database" class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-slate-600 hover:bg-slate-50">Back</a>
            <button type="submit" data-submit class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2 font-medium text-white shadow-sm hover:bg-blue-700">
                Run Installation
            </button>
        </div>
    </form>
</div>
