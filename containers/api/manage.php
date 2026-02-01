<?php
// API management layout for apiservice.
global $Url;

$act = is_null($Url->get('action')) ? 'apimanage' : $Url->get('action');
$action = new $act();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($action->getTitle(), ENT_QUOTES, 'UTF-8'); ?></title>
    <script src="assets/tailwindcss.js"></script>
</head>
<body class="bg-white text-slate-900">
    <div class="max-w-6xl mx-auto px-6 py-10">
        <header class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-700">API Management</span>
                <h1 class="mt-3 text-3xl font-semibold text-blue-700">JamilX API Console</h1>
                <p class="mt-2 text-slate-600">Manage API keys, review usage guidelines, and keep integrations secure.</p>
            </div>
            <a href="/api" class="rounded-lg border border-blue-200 px-4 py-2 text-sm font-semibold text-blue-700 hover:bg-blue-50">View API Docs</a>
        </header>

        <nav class="mt-8 flex flex-wrap gap-3">
            <a href="?action=apimanage" class="rounded-full border border-blue-200 px-4 py-2 text-sm font-semibold text-blue-700 hover:bg-blue-50">Overview</a>
            <a href="?action=apikeys" class="rounded-full border border-blue-200 px-4 py-2 text-sm font-semibold text-blue-700 hover:bg-blue-50">API Keys</a>
        </nav>

        <main class="mt-8 rounded-2xl border border-blue-100 bg-white p-6 shadow-sm">
            <?php $action->getAction(); ?>
        </main>
    </div>
</body>
</html>
