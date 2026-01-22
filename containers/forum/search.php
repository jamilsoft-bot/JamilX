<?php
$pageTitle = 'Forum Search';
$searchQuery = $query ?? '';
include __DIR__ . '/layout/header.php';
?>
<section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <h2 class="text-xl font-semibold">Search Results</h2>
    <p class="text-sm text-slate-500">Results for "<?php echo forum_html($query); ?>"</p>

    <?php if (empty($topics)): ?>
        <div class="mt-4 rounded-lg border border-dashed border-slate-300 p-6 text-center text-sm text-slate-500">
            No results found.
        </div>
    <?php else: ?>
        <div class="mt-4 space-y-3">
            <?php foreach ($topics as $topic): ?>
                <a href="forum/topic/<?php echo forum_html($topic['slug']); ?>" class="block rounded-lg border border-slate-200 p-4 hover:border-indigo-300">
                    <h3 class="text-lg font-semibold"><?php echo forum_html($topic['title']); ?></h3>
                    <p class="text-xs text-slate-400">Category: <?php echo forum_html($topic['category_name']); ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($pagination['total_pages'] > 1): ?>
        <div class="mt-4 flex gap-2">
            <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                <a href="forum/search?q=<?php echo forum_html(urlencode($query)); ?>&page=<?php echo $i; ?>" class="rounded-lg px-3 py-2 text-sm <?php echo $i === $pagination['page'] ? 'bg-indigo-600 text-white' : 'bg-white text-slate-600 border border-slate-200'; ?>">
                    <?php echo forum_html($i); ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</section>
<?php include __DIR__ . '/layout/footer.php'; ?>
