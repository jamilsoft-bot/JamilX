<?php
$pageTitle = 'Blog';
$pageDescription = 'Latest posts from the JamilX team.';
$searchQuery = '';
include __DIR__ . '/layout/header.php';
?>
<div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
    <section class="lg:col-span-2 space-y-6">
        <?php if (empty($posts)): ?>
            <div class="rounded-xl border border-dashed border-slate-300 bg-white p-8 text-center">
                <h2 class="text-lg font-semibold">No posts yet</h2>
                <p class="mt-2 text-sm text-slate-500">Once posts are published, they will appear here.</p>
            </div>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <article class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex flex-col gap-3">
                        <div class="text-xs uppercase tracking-wide text-slate-500">
                            <?php echo blog_html($post['category_name'] ?? 'Uncategorized'); ?>
                        </div>
                        <h2 class="text-2xl font-semibold">
                            <a href="blog?action=post&slug=<?php echo blog_html($post['slug']); ?>" class="hover:text-indigo-600">
                                <?php echo blog_html($post['title']); ?>
                            </a>
                        </h2>
                        <p class="text-sm text-slate-500">
                            <?php echo blog_html($post['excerpt']); ?>
                        </p>
                        <div class="flex flex-wrap gap-2 text-xs">
                            <?php foreach (($tagsMap[$post['id']] ?? []) as $tag): ?>
                                <a href="blog?action=tag&slug=<?php echo blog_html($tag['slug']); ?>" class="rounded-full bg-slate-100 px-3 py-1 text-slate-600 hover:bg-slate-200">
                                    <?php echo blog_html($tag['name']); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <div class="text-xs text-slate-400">
                            <?php echo blog_html(date('M d, Y', strtotime($post['published_at'] ?: $post['created_at']))); ?>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ($pagination['total_pages'] > 1): ?>
            <div class="flex gap-2">
                <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                    <?php
                    $url = blog_page_url($pagination['base'], array_merge($pagination['params'], ['page' => $i]));
                    $active = $i === $pagination['page'];
                    ?>
                    <a href="<?php echo blog_html($url); ?>" class="rounded-lg px-3 py-2 text-sm <?php echo $active ? 'bg-indigo-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-100'; ?>">
                        <?php echo blog_html($i); ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </section>

    <aside class="space-y-6">
        <div class="rounded-xl border border-slate-200 bg-white p-6">
            <h3 class="text-lg font-semibold">Categories</h3>
            <ul class="mt-4 space-y-2 text-sm text-slate-600">
                <?php foreach ($categories as $category): ?>
                    <li><a href="blog?action=category&slug=<?php echo blog_html($category['slug']); ?>" class="hover:text-indigo-600"><?php echo blog_html($category['name']); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="rounded-xl border border-slate-200 bg-white p-6">
            <h3 class="text-lg font-semibold">Tags</h3>
            <div class="mt-4 flex flex-wrap gap-2">
                <?php foreach ($tags as $tag): ?>
                    <a href="blog?action=tag&slug=<?php echo blog_html($tag['slug']); ?>" class="rounded-full bg-slate-100 px-3 py-1 text-xs text-slate-600 hover:bg-slate-200">
                        <?php echo blog_html($tag['name']); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="rounded-xl border border-slate-200 bg-white p-6">
            <h3 class="text-lg font-semibold">Subscribe</h3>
            <p class="mt-2 text-sm text-slate-500">Get fresh posts delivered to your inbox.</p>
            <?php if (!empty($subscribeNotice)): ?>
                <div class="mt-3 rounded-lg border px-3 py-2 text-xs <?php echo $subscribeNotice['success'] ? 'border-emerald-200 bg-emerald-50 text-emerald-700' : 'border-rose-200 bg-rose-50 text-rose-700'; ?>">
                    <?php echo blog_html($subscribeNotice['message']); ?>
                </div>
            <?php endif; ?>
            <form action="blog?action=home" method="post" class="mt-4 flex flex-col gap-3">
                <input type="email" name="subscribe_email" required placeholder="you@example.com" class="rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none">
                <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Subscribe</button>
            </form>
        </div>
    </aside>
</div>
<?php include __DIR__ . '/layout/footer.php'; ?>
