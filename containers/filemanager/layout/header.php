<?php
$pageTitle = $pageTitle ?? 'JamilX File Manager';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo filemanager_html($pageTitle); ?></title>
    <script src="assets/tailwindcss.js"></script>
</head>
<body class="bg-slate-50 text-slate-900">
<header class="border-b border-slate-200 bg-white">
    <div class="mx-auto flex max-w-6xl flex-col gap-4 px-4 py-6 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">JamilX Service</p>
            <h1 class="text-2xl font-semibold">File Manager</h1>
            <p class="text-sm text-slate-500">Manage files across public and private storage.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="dashboard" class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100">Dashboard</a>
            <a href="filemanager" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Browse Files</a>
        </div>
    </div>
</header>
<main class="mx-auto max-w-6xl space-y-6 px-4 py-8">
