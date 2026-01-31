<?php
$pageTitle = 'Delete Post';
include __DIR__ . '/header.php';
?>
<div class="rounded-xl border border-rose-200 bg-white p-6">
    <h2 class="text-xl font-semibold text-rose-700">Confirm Delete</h2>
    <p class="mt-2 text-sm text-slate-600">Are you sure you want to delete "<?php echo blog_html($post['title']); ?>"? This action cannot be undone.</p>
    <form action="admin/blog?action=delete&id=<?php echo blog_html($post['id']); ?>" method="post" class="mt-6 flex gap-3">
        <a href="admin/blog?action=index" class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">Cancel</a>
        <button type="submit" class="rounded-lg bg-rose-600 px-4 py-2 text-sm font-semibold text-white hover:bg-rose-700">Delete Post</button>
    </form>
</div>
<?php include __DIR__ . '/footer.php'; ?>
