<?php
$pageTitle = 'Forum Categories';
include __DIR__ . '/../layout/header.php';
?>
<section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <h2 class="text-xl font-semibold">Manage Categories</h2>
    <p class="text-sm text-slate-500">Create and organize forum boards.</p>

    <form method="post" action="admin/forum?action=categories-save" class="mt-6 grid gap-4 md:grid-cols-2">
        <input type="hidden" name="csrf_token" value="<?php echo forum_html($csrf ?? ''); ?>">
        <div>
            <label class="text-sm font-semibold">Name</label>
            <input type="text" name="name" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" required>
        </div>
        <div>
            <label class="text-sm font-semibold">Slug</label>
            <input type="text" name="slug" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" placeholder="auto-generated if blank">
        </div>
        <div class="md:col-span-2">
            <label class="text-sm font-semibold">Description</label>
            <textarea name="description" rows="3" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></textarea>
        </div>
        <div>
            <label class="text-sm font-semibold">Position</label>
            <input type="number" name="position" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" value="0">
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_active" value="1" checked class="h-4 w-4">
            <label class="text-sm text-slate-600">Active</label>
        </div>
        <div class="md:col-span-2">
            <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Add Category</button>
        </div>
    </form>
</section>

<section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <h3 class="text-lg font-semibold">Existing Categories</h3>
    <?php if (empty($categories)): ?>
        <div class="mt-4 rounded-lg border border-dashed border-slate-300 p-6 text-center text-sm text-slate-500">No categories yet.</div>
    <?php else: ?>
        <div class="mt-4 space-y-3">
            <?php foreach ($categories as $category): ?>
                <div class="rounded-lg border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-lg font-semibold"><?php echo forum_html($category['name']); ?></h4>
                            <p class="text-sm text-slate-500"><?php echo forum_html($category['description']); ?></p>
                        </div>
                        <span class="text-xs text-slate-400">Position <?php echo forum_html($category['position']); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
<?php include __DIR__ . '/../layout/footer.php'; ?>
