<?php
$pageTitle = $topic['title'] ?? 'Topic';
include __DIR__ . '/layout/header.php';
?>
<section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs uppercase text-slate-400"><?php echo forum_html($topic['category_name']); ?></p>
            <h2 class="text-2xl font-semibold"><?php echo forum_html($topic['title']); ?></h2>
            <p class="text-sm text-slate-500">Started by <?php echo forum_html($topic['username'] ?? 'Unknown'); ?></p>
        </div>
        <div class="flex flex-wrap gap-2">
            <?php if (forum_is_moderator()): ?>
                <form method="post" action="forum/moderate-lock/<?php echo (int) $topic['id']; ?>" class="inline">
                    <input type="hidden" name="csrf_token" value="<?php echo forum_html($csrf ?? ''); ?>">
                    <input type="hidden" name="slug" value="<?php echo forum_html($topic['slug']); ?>">
                    <input type="hidden" name="value" value="<?php echo $topic['is_locked'] ? 0 : 1; ?>">
                    <button type="submit" class="rounded-lg border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-600">
                        <?php echo $topic['is_locked'] ? 'Unlock' : 'Lock'; ?>
                    </button>
                </form>
                <form method="post" action="forum/moderate-pin/<?php echo (int) $topic['id']; ?>" class="inline">
                    <input type="hidden" name="csrf_token" value="<?php echo forum_html($csrf ?? ''); ?>">
                    <input type="hidden" name="slug" value="<?php echo forum_html($topic['slug']); ?>">
                    <input type="hidden" name="value" value="<?php echo $topic['is_pinned'] ? 0 : 1; ?>">
                    <button type="submit" class="rounded-lg border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-600">
                        <?php echo $topic['is_pinned'] ? 'Unpin' : 'Pin'; ?>
                    </button>
                </form>
            <?php endif; ?>
            <a href="forum/category/<?php echo forum_html($topic['category_slug']); ?>" class="rounded-lg border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-600">Back</a>
        </div>
    </div>

    <div class="mt-6 space-y-4">
        <?php foreach ($posts as $post): ?>
            <div class="rounded-lg border border-slate-200 p-4">
                <div class="flex items-center justify-between">
                    <div class="text-sm font-semibold"><?php echo forum_html($post['username'] ?? 'User'); ?></div>
                    <div class="text-xs text-slate-400"><?php echo forum_html($post['created_at']); ?></div>
                </div>
                <div class="mt-3 text-sm text-slate-700">
                    <?php echo forum_render_text($post['body']); ?>
                </div>
                <?php if (forum_is_moderator()): ?>
                    <form method="post" action="forum/post-delete/<?php echo (int) $post['id']; ?>/<?php echo forum_html($topic['slug']); ?>" class="mt-3">
                        <input type="hidden" name="csrf_token" value="<?php echo forum_html($csrf ?? ''); ?>">
                        <button type="submit" class="text-xs text-rose-600 hover:text-rose-800">Remove</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if ($pagination['total_pages'] > 1): ?>
        <div class="mt-4 flex gap-2">
            <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                <a href="forum/topic/<?php echo forum_html($topic['slug']); ?>?page=<?php echo $i; ?>" class="rounded-lg px-3 py-2 text-sm <?php echo $i === $pagination['page'] ? 'bg-indigo-600 text-white' : 'bg-white text-slate-600 border border-slate-200'; ?>">
                    <?php echo forum_html($i); ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</section>

<?php if (isset($_SESSION['uid'])): ?>
    <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-semibold">Add a Reply</h3>
        <?php if (!empty($errors)): ?>
            <div class="mt-3 rounded-lg border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700">
                <ul class="list-disc pl-4">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo forum_html($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php if (!empty($topic['is_locked'])): ?>
            <p class="mt-2 text-sm text-slate-500">This topic is locked.</p>
        <?php else: ?>
            <form method="post" action="forum/reply/<?php echo forum_html($topic['slug']); ?>" class="mt-4 space-y-3">
                <input type="hidden" name="csrf_token" value="<?php echo forum_html($csrf ?? ''); ?>">
                <textarea name="body" rows="4" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" required></textarea>
                <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Post Reply</button>
            </form>
        <?php endif; ?>
    </section>
<?php endif; ?>
<?php include __DIR__ . '/layout/footer.php'; ?>
