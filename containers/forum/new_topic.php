<?php
$pageTitle = 'New Topic';
include __DIR__ . '/layout/header.php';
?>
<section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold">Start a New Topic</h2>
            <p class="text-sm text-slate-500">Post your question or idea in <?php echo forum_html($category['name']); ?>.</p>
        </div>
        <a href="forum/category/<?php echo forum_html($category['slug']); ?>" class="text-sm text-slate-600 hover:text-slate-900">Back to category</a>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="mt-4 rounded-lg border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700">
            <ul class="list-disc pl-4">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo forum_html($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" class="mt-6 space-y-4">
        <input type="hidden" name="csrf_token" value="<?php echo forum_html($csrf ?? ''); ?>">
        <div>
            <label class="text-sm font-semibold">Title</label>
            <input type="text" name="title" value="<?php echo forum_html($_POST['title'] ?? ''); ?>" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" required>
        </div>
        <div>
            <label class="text-sm font-semibold">Message</label>
            <textarea name="body" rows="6" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" required><?php echo forum_html($_POST['body'] ?? ''); ?></textarea>
        </div>
        <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Create Topic</button>
    </form>
</section>
<?php include __DIR__ . '/layout/footer.php'; ?>
