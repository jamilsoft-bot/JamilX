<?php
$pageTitle = isset($tag) ? ($tag['name'] . ' Tag') : 'Tags';
$pageDescription = isset($tag) ? ('Posts tagged with ' . $tag['name'] . '.') : 'Browse blog tags.';
$searchQuery = '';
include __DIR__ . '/layout/header.php';
?>
<?php if (!isset($tag)): ?>
    <section class="rounded-xl border border-slate-200 bg-white p-6">
        <h2 class="text-2xl font-semibold">Tags</h2>
        <p class="mt-2 text-sm text-slate-500">Find posts by tag.</p>
        <div class="mt-6 flex flex-wrap gap-2">
            <?php foreach ($tags as $item): ?>
                <a href="blog?action=tag&slug=<?php echo blog_html($item['slug']); ?>" class="rounded-full bg-slate-100 px-4 py-2 text-sm text-slate-600 hover:bg-slate-200">
                    <?php echo blog_html($item['name']); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </section>
<?php else: ?>
    <section class="space-y-6">
        <header>
            <p class="text-xs uppercase tracking-wide text-slate-500">Tag</p>
            <h2 class="text-2xl font-semibold"><?php echo blog_html($tag['name']); ?></h2>
        </header>
        <?php if (empty($posts)): ?>
            <div class="rounded-xl border border-dashed border-slate-300 bg-white p-8 text-center">
                <p class="text-sm text-slate-500">No posts yet for this tag.</p>
            </div>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <article class="rounded-xl border border-slate-200 bg-white p-6">
                    <h3 class="text-xl font-semibold">
                        <a href="blog?action=post&slug=<?php echo blog_html($post['slug']); ?>" class="hover:text-indigo-600"><?php echo blog_html($post['title']); ?></a>
                    </h3>
                    <p class="mt-2 text-sm text-slate-500"><?php echo blog_html($post['excerpt']); ?></p>
                    <div class="mt-3 flex flex-wrap gap-2 text-xs">
                        <?php foreach (($tagsMap[$post['id']] ?? []) as $tagItem): ?>
                            <a href="blog?action=tag&slug=<?php echo blog_html($tagItem['slug']); ?>" class="rounded-full bg-slate-100 px-3 py-1 text-slate-600 hover:bg-slate-200"><?php echo blog_html($tagItem['name']); ?></a>
                        <?php endforeach; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if ($pagination['total_pages'] > 1): ?>
            <div class="flex gap-2">
                <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                    <?php $url = blog_page_url($pagination['base'], ['page' => $i]); ?>
                    <a href="<?php echo blog_html($url); ?>" class="rounded-lg px-3 py-2 text-sm <?php echo $i === $pagination['page'] ? 'bg-indigo-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-100'; ?>">
                        <?php echo blog_html($i); ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </section>
<?php endif; ?>
<?php include __DIR__ . '/layout/footer.php'; ?>
