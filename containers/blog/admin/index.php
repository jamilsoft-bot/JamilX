<?php
$pageTitle = 'Blog Dashboard';
include __DIR__ . '/header.php';
?>
<?php if (!empty($_GET['deleted'])): ?>
    <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">Post deleted successfully.</div>
<?php endif; ?>
<div class="grid gap-4 md:grid-cols-3">
    <div class="rounded-xl border border-slate-200 bg-white p-4">
        <p class="text-xs uppercase text-slate-500">Posts</p>
        <p class="mt-2 text-2xl font-semibold"><?php echo blog_html($stats['posts']); ?></p>
    </div>
    <div class="rounded-xl border border-slate-200 bg-white p-4">
        <p class="text-xs uppercase text-slate-500">Categories</p>
        <p class="mt-2 text-2xl font-semibold"><?php echo blog_html($stats['categories']); ?></p>
    </div>
    <div class="rounded-xl border border-slate-200 bg-white p-4">
        <p class="text-xs uppercase text-slate-500">Tags</p>
        <p class="mt-2 text-2xl font-semibold"><?php echo blog_html($stats['tags']); ?></p>
    </div>
</div>

<section class="mt-8 rounded-xl border border-slate-200 bg-white">
    <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
        <h2 class="text-lg font-semibold">Recent posts</h2>
        <a href="/admin/blog/new" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">Create post</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-6 py-3">Title</th>
                    <th class="px-6 py-3">Category</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Updated</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($posts)): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-6 text-center text-slate-500">No posts created yet.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($posts as $post): ?>
                        <tr class="border-t border-slate-200">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-800"><?php echo blog_html($post['title']); ?></div>
                                <div class="mt-1 flex flex-wrap gap-1 text-xs text-slate-500">
                                    <?php foreach (($tagsMap[$post['id']] ?? []) as $tag): ?>
                                        <span class="rounded-full bg-slate-100 px-2 py-0.5">#<?php echo blog_html($tag['name']); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600"><?php echo blog_html($post['category_name'] ?? 'Uncategorized'); ?></td>
                            <td class="px-6 py-4">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold <?php echo $post['status'] === 'published' ? 'bg-emerald-100 text-emerald-700' : ($post['status'] === 'scheduled' ? 'bg-amber-100 text-amber-700' : 'bg-slate-200 text-slate-600'); ?>">
                                    <?php echo blog_html(ucfirst($post['status'])); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-500">
                                <?php echo blog_html(date('M d, Y', strtotime($post['updated_at']))); ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="/admin/blog/edit/<?php echo blog_html($post['id']); ?>" class="text-indigo-600 hover:text-indigo-700">Edit</a>
                                    <a href="/admin/blog/delete/<?php echo blog_html($post['id']); ?>" class="text-rose-600 hover:text-rose-700">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if ($pagination['total_pages'] > 1): ?>
        <div class="border-t border-slate-200 px-6 py-4 flex gap-2">
            <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                <?php $url = blog_page_url($pagination['base'], ['page' => $i]); ?>
                <a href="<?php echo blog_html($url); ?>" class="rounded-lg px-3 py-2 text-sm <?php echo $i === $pagination['page'] ? 'bg-indigo-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-100'; ?>">
                    <?php echo blog_html($i); ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</section>
<?php include __DIR__ . '/footer.php'; ?>
