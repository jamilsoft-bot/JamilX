<?php
$pageTitle = $pageTitle ?? 'JamilX Blog';
$pageDescription = $pageDescription ?? 'News and updates from the JamilX community.';
$navLinks = [
    ['label' => 'Home', 'href' => 'blog'],
    ['label' => 'Categories', 'href' => 'blog/category'],
    ['label' => 'Tags', 'href' => 'blog/tag'],
    ['label' => 'Search', 'href' => 'blog/search'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo blog_html($pageTitle); ?></title>
    <meta name="description" content="<?php echo blog_html($pageDescription); ?>">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-900">
<header class="bg-white border-b border-slate-200">
    <div class="max-w-6xl mx-auto px-4 py-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-sm uppercase tracking-widest text-slate-500">JamilX Blog</p>
            <h1 class="text-2xl font-semibold">Stories, updates, and product releases</h1>
        </div>
        <form action="blog/search" method="get" class="flex gap-2">
            <input type="text" name="q" value="<?php echo blog_html($searchQuery ?? ''); ?>" placeholder="Search posts" class="w-48 md:w-64 rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none">
            <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Search</button>
        </form>
    </div>
    <nav class="border-t border-slate-200 bg-slate-100">
        <div class="max-w-6xl mx-auto px-4 py-3 flex flex-wrap gap-4 text-sm font-medium">
            <?php foreach ($navLinks as $link): ?>
                <a href="<?php echo blog_html($link['href']); ?>" class="text-slate-600 hover:text-slate-900">
                    <?php echo blog_html($link['label']); ?>
                </a>
            <?php endforeach; ?>
            <a href="admin/blog" class="text-slate-600 hover:text-slate-900">Admin</a>
        </div>
    </nav>
</header>
<main class="max-w-6xl mx-auto px-4 py-10">
