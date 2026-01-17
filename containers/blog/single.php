<?php
$pageTitle = $post['seo_title'] ?: $post['title'];
$pageDescription = $post['seo_description'] ?: $post['excerpt'];
$searchQuery = '';
include __DIR__ . '/layout/header.php';
?>
<article class="space-y-6">
    <header class="space-y-3">
        <p class="text-xs uppercase tracking-widest text-slate-500">
            <a href="/blog/category/<?php echo blog_html($post['category_slug'] ?? ''); ?>" class="hover:text-indigo-600">
                <?php echo blog_html($post['category_name'] ?? 'Uncategorized'); ?>
            </a>
        </p>
        <h1 class="text-3xl font-semibold text-slate-900"><?php echo blog_html($post['title']); ?></h1>
        <p class="text-sm text-slate-500">Published <?php echo blog_html(date('M d, Y', strtotime($post['published_at'] ?: $post['created_at']))); ?></p>
    </header>

    <?php if (!empty($post['featured_image'])): ?>
        <img src="/<?php echo blog_html($post['featured_image']); ?>" alt="<?php echo blog_html($post['title']); ?>" class="w-full rounded-xl border border-slate-200 object-cover">
    <?php endif; ?>

    <div class="prose prose-slate max-w-none">
        <?php echo nl2br(blog_html($post['content'])); ?>
    </div>

    <?php if (!empty($tags)): ?>
        <div class="flex flex-wrap gap-2 text-xs">
            <?php foreach ($tags as $tag): ?>
                <a href="/blog/tag/<?php echo blog_html($tag['slug']); ?>" class="rounded-full bg-slate-100 px-3 py-1 text-slate-600 hover:bg-slate-200">
                    <?php echo blog_html($tag['name']); ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($relatedPosts)): ?>
        <section class="border-t border-slate-200 pt-6">
            <h2 class="text-lg font-semibold">Related posts</h2>
            <div class="mt-4 grid gap-4 md:grid-cols-3">
                <?php foreach ($relatedPosts as $related): ?>
                    <a href="/blog/post/<?php echo blog_html($related['slug']); ?>" class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm hover:border-indigo-200">
                        <p class="text-xs uppercase tracking-wide text-slate-500"><?php echo blog_html($related['category_name'] ?? ''); ?></p>
                        <h3 class="mt-2 font-semibold text-slate-800"><?php echo blog_html($related['title']); ?></h3>
                        <p class="mt-2 text-xs text-slate-400"><?php echo blog_html(date('M d, Y', strtotime($related['published_at'] ?: $related['created_at']))); ?></p>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
</article>

<section class="mt-10 rounded-xl border border-slate-200 bg-white p-6">
    <h3 class="text-lg font-semibold">Subscribe for updates</h3>
    <p class="mt-2 text-sm text-slate-500">Get new posts straight to your inbox.</p>
    <?php if (!empty($subscribeNotice)): ?>
        <div class="mt-3 rounded-lg border px-3 py-2 text-xs <?php echo $subscribeNotice['success'] ? 'border-emerald-200 bg-emerald-50 text-emerald-700' : 'border-rose-200 bg-rose-50 text-rose-700'; ?>">
            <?php echo blog_html($subscribeNotice['message']); ?>
        </div>
    <?php endif; ?>
    <form action="/blog/post/<?php echo blog_html($post['slug']); ?>" method="post" class="mt-4 flex flex-col gap-3 md:flex-row md:items-center">
        <input type="email" name="subscribe_email" required placeholder="you@example.com" class="flex-1 rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none">
        <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Subscribe</button>
    </form>
</section>
<?php include __DIR__ . '/layout/footer.php'; ?>
