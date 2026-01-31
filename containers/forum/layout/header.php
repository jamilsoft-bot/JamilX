<?php
$pageTitle = $pageTitle ?? 'Forum';
$navLinks = [
    ['label' => 'Forum Home', 'href' => 'forum'],
    ['label' => 'Search', 'href' => 'forum?action=search'],
    ['label' => 'Invoices', 'href' => 'invoice'],
    ['label' => 'Billing', 'href' => 'billing'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo forum_html($pageTitle); ?></title>
    <script src="assets/tailwindcss.js"></script>
</head>
<body class="bg-slate-50 text-slate-900">
<header class="border-b border-slate-200 bg-white">
    <div class="mx-auto flex max-w-6xl flex-col gap-4 px-4 py-6 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">JamilX Community</p>
            <h1 class="text-2xl font-semibold">Forum</h1>
            <p class="text-sm text-slate-500">Start discussions, share ideas, and get help.</p>
        </div>
        <form action="forum" method="get" class="flex gap-2">
            <input type="hidden" name="action" value="search">
            <input type="text" name="q" value="<?php echo forum_html($searchQuery ?? ''); ?>" placeholder="Search forum" class="w-48 rounded-lg border border-slate-300 px-3 py-2 text-sm">
            <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Search</button>
        </form>
    </div>
    <nav class="border-t border-slate-200 bg-slate-100">
        <div class="mx-auto flex max-w-6xl flex-wrap gap-4 px-4 py-3 text-sm font-medium">
            <?php foreach ($navLinks as $link): ?>
                <a href="<?php echo forum_html($link['href']); ?>" class="text-slate-600 hover:text-slate-900">
                    <?php echo forum_html($link['label']); ?>
                </a>
            <?php endforeach; ?>
            <?php if (forum_is_moderator()): ?>
                <a href="admin/forum?action=categories" class="text-slate-600 hover:text-slate-900">Manage Categories</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
<main class="mx-auto max-w-6xl space-y-6 px-4 py-8">
