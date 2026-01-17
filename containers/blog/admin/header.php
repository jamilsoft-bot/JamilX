<?php
$pageTitle = $pageTitle ?? 'Blog Admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo blog_html($pageTitle); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-900">
<header class="border-b border-slate-200 bg-white">
    <div class="max-w-6xl mx-auto px-4 py-5 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-sm uppercase tracking-widest text-slate-500">Blog Admin</p>
            <h1 class="text-2xl font-semibold">Manage blog content</h1>
        </div>
        <div class="flex gap-2">
            <a href="/blog" class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">View Blog</a>
            <a href="/admin/blog/new" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">New Post</a>
        </div>
    </div>
    <nav class="border-t border-slate-200 bg-slate-50">
        <div class="max-w-6xl mx-auto px-4 py-3 flex flex-wrap gap-4 text-sm font-medium">
            <a href="/admin/blog" class="text-slate-600 hover:text-slate-900">Dashboard</a>
            <a href="/admin/blog/categories" class="text-slate-600 hover:text-slate-900">Categories</a>
            <a href="/admin/blog/tags" class="text-slate-600 hover:text-slate-900">Tags</a>
        </div>
    </nav>
</header>
<main class="max-w-6xl mx-auto px-4 py-8">
