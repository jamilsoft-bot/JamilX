<?php
$pageTitle = $category['name'] ?? 'Category';
$searchQuery = $search ?? '';
include __DIR__ . '/layout/header.php';
?>
<section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs uppercase text-slate-400">Category</p>
            <h2 class="text-2xl font-semibold"><?php echo forum_html($category['name']); ?></h2>
            <p class="text-sm text-slate-500"><?php echo forum_html($category['description']); ?></p>
        </div>
        <?php if (isset($_SESSION['uid'])): ?>
        <a href="forum?action=new&slug=<?php echo forum_html($category['slug']); ?>" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">New Topic</a>
        <?php endif; ?>
    </div>

    <?php if (empty($topics)): ?>
        <div class="mt-4 rounded-lg border border-dashed border-slate-300 p-6 text-center text-sm text-slate-500">
            No topics yet. Start the conversation.
        </div>
    <?php else: ?>
        <div class="mt-4 space-y-3">
            <?php foreach ($topics as $topic): ?>
                <div class="rounded-lg border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <a href="forum?action=topic&slug=<?php echo forum_html($topic['slug']); ?>" class="text-lg font-semibold text-slate-800 hover:text-indigo-600">
                                <?php echo forum_html($topic['title']); ?>
                            </a>
                            <div class="text-xs text-slate-400">By <?php echo forum_html($topic['username'] ?? 'Unknown'); ?> • Replies <?php echo forum_html($topic['reply_count']); ?></div>
                        </div>
                        <div class="text-xs text-slate-400">
                            <?php echo forum_html($topic['last_post_at'] ?? $topic['created_at']); ?>
                        </div>
                    </div>
                    <div class="mt-2 flex gap-2 text-xs">
                        <?php if (!empty($topic['is_pinned'])): ?>
                            <span class="rounded-full bg-amber-100 px-2 py-1 text-amber-700">Pinned</span>
                        <?php endif; ?>
                        <?php if (!empty($topic['is_locked'])): ?>
                            <span class="rounded-full bg-slate-100 px-2 py-1 text-slate-600">Locked</span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($pagination['total_pages'] > 1): ?>
        <div class="mt-4 flex gap-2">
            <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                <a href="forum?action=category&slug=<?php echo forum_html($category['slug']); ?>&page=<?php echo $i; ?>" class="rounded-lg px-3 py-2 text-sm <?php echo $i === $pagination['page'] ? 'bg-indigo-600 text-white' : 'bg-white text-slate-600 border border-slate-200'; ?>">
                    <?php echo forum_html($i); ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</section>
<?php include __DIR__ . '/layout/footer.php'; ?>
