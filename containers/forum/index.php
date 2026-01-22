<?php
$pageTitle = 'Forum Home';
include __DIR__ . '/layout/header.php';
?>
<section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold">Categories</h2>
            <p class="text-sm text-slate-500">Browse discussions by topic.</p>
        </div>
        <?php if (isset($_SESSION['uid'])): ?>
            <a href="forum/search" class="text-sm text-slate-600 hover:text-slate-900">Search topics</a>
        <?php endif; ?>
    </div>

    <?php if (empty($categories)): ?>
        <div class="mt-4 rounded-lg border border-dashed border-slate-300 p-6 text-center text-sm text-slate-500">
            No categories available yet.
        </div>
    <?php else: ?>
        <div class="mt-4 grid gap-4 md:grid-cols-2">
            <?php foreach ($categories as $category): ?>
                <a href="forum/category/<?php echo forum_html($category['slug']); ?>" class="rounded-lg border border-slate-200 p-4 hover:border-indigo-300 hover:shadow-sm">
                    <h3 class="text-lg font-semibold"><?php echo forum_html($category['name']); ?></h3>
                    <p class="mt-2 text-sm text-slate-500"><?php echo forum_html($category['description']); ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
<?php include __DIR__ . '/layout/footer.php'; ?>
