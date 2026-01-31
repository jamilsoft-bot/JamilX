<?php
$pageTitle = 'Manage Tags';
include __DIR__ . '/header.php';
?>
<?php if (!empty($notice)): ?>
    <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700"><?php echo blog_html($notice['message']); ?></div>
<?php endif; ?>
<?php if (!empty($errors)): ?>
    <div class="mb-6 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
        <ul class="list-disc pl-4">
            <?php foreach ($errors as $error): ?>
                <li><?php echo blog_html($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="grid gap-6 lg:grid-cols-3">
    <div class="rounded-xl border border-slate-200 bg-white p-6">
        <h2 class="text-lg font-semibold"><?php echo $editTag ? 'Edit Tag' : 'New Tag'; ?></h2>
        <form action="blog?action=admin-tags" method="post" class="mt-4 space-y-4">
            <input type="hidden" name="tag_id" value="<?php echo blog_html($editTag['id'] ?? ''); ?>">
            <div>
                <label class="text-sm font-semibold">Name</label>
                <input type="text" name="name" value="<?php echo blog_html($editTag['name'] ?? ''); ?>" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="text-sm font-semibold">Slug</label>
                <input type="text" name="slug" value="<?php echo blog_html($editTag['slug'] ?? ''); ?>" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" placeholder="auto-generated-if-empty">
            </div>
            <button type="submit" name="save_tag" value="1" class="w-full rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                <?php echo $editTag ? 'Update Tag' : 'Create Tag'; ?>
            </button>
        </form>
    </div>

    <div class="lg:col-span-2 rounded-xl border border-slate-200 bg-white">
        <div class="border-b border-slate-200 px-6 py-4">
            <h2 class="text-lg font-semibold">All Tags</h2>
        </div>
        <div class="divide-y divide-slate-200">
            <?php if (empty($tags)): ?>
                <div class="px-6 py-8 text-center text-sm text-slate-500">No tags yet.</div>
            <?php else: ?>
                <?php foreach ($tags as $tag): ?>
                    <div class="flex items-center justify-between px-6 py-4">
                        <div>
                            <p class="font-semibold text-slate-800"><?php echo blog_html($tag['name']); ?></p>
                            <p class="text-xs text-slate-500">/<?php echo blog_html($tag['slug']); ?></p>
                        </div>
                        <div class="flex gap-3 text-sm">
                            <a href="blog?action=admin-tags&edit=<?php echo blog_html($tag['id']); ?>" class="text-indigo-600 hover:text-indigo-700">Edit</a>
                            <a href="blog?action=admin-tags&delete=<?php echo blog_html($tag['id']); ?>" class="text-rose-600 hover:text-rose-700">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php include __DIR__ . '/footer.php'; ?>
