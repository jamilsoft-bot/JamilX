<?php
// Database setup step.
$defaults = [
    'dbhost' => 'localhost',
    'dbport' => '3306',
    'dbname' => '',
    'dbuser' => '',
    'dbpass' => '',
];
$values = array_merge($defaults, $formValues);
?>
<div>
    <h2 class="text-2xl font-semibold text-slate-900">Database Setup</h2>
    <p class="mt-2 text-slate-600">Provide the database connection details for your JamilX installation.</p>

    <form method="post" class="mt-6 grid gap-4" data-validate-form>
        <input type="hidden" name="action" value="save_db">
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="text-sm font-medium text-slate-700">Database Host</label>
                <input type="text" name="dbhost" data-required class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-blue-500 focus:outline-none" placeholder="localhost" value="<?php echo installer_escape($values['dbhost']); ?>">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">Database Port</label>
                <input type="text" name="dbport" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-blue-500 focus:outline-none" placeholder="3306" value="<?php echo installer_escape($values['dbport']); ?>">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">Database Name</label>
                <input type="text" name="dbname" data-required class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-blue-500 focus:outline-none" placeholder="jamilx" value="<?php echo installer_escape($values['dbname']); ?>">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">Database Username</label>
                <input type="text" name="dbuser" data-required class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-blue-500 focus:outline-none" placeholder="root" value="<?php echo installer_escape($values['dbuser']); ?>">
            </div>
            <div class="md:col-span-2">
                <label class="text-sm font-medium text-slate-700">Database Password</label>
                <input type="password" name="dbpass" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-blue-500 focus:outline-none" placeholder="••••••••" value="<?php echo installer_escape($values['dbpass']); ?>">
            </div>
        </div>
        <div class="flex flex-wrap gap-3 pt-4">
            <a href="?step=requirements" class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-slate-600 hover:bg-slate-50">Back</a>
            <button type="submit" data-submit class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2 font-medium text-white shadow-sm hover:bg-blue-700">
                Save &amp; Continue
            </button>
        </div>
        <p class="text-sm text-slate-500">We do not display your credentials after submission.</p>
    </form>
</div>
