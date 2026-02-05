<?php
$isEditing = isset($post);
$pageTitle = $isEditing ? 'Edit Post' : 'New Post';
include __DIR__ . '/header.php';

function blog_field($key, $default = '')
{
    global $post, $values;
    if (isset($post) && isset($post[$key])) {
        return $post[$key];
    }
    if (isset($values[$key])) {
        return $values[$key];
    }
    return $default;
}

$tagValue = $postTagNames ?? ($values['tags'] ?? '');
?>
<?php if (!empty($_GET['saved'])): ?>
    <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">Post saved successfully.</div>
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

<form action="<?php echo $isEditing ? 'admin/blog?action=edit&id=' . blog_html($post['id']) : 'admin/blog?action=new'; ?>" method="post" enctype="multipart/form-data" class="space-y-6">
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <div class="rounded-xl border border-slate-200 bg-white p-6">
                <label class="text-sm font-semibold">Title</label>
                <input type="text" name="title" value="<?php echo blog_html(blog_field('title')); ?>" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" required>

                <label class="mt-4 block text-sm font-semibold">Slug</label>
                <input type="text" name="slug" value="<?php echo blog_html(blog_field('slug')); ?>" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" placeholder="auto-generated-if-empty">

                <label class="mt-4 block text-sm font-semibold">Excerpt</label>
                <textarea name="excerpt" rows="3" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"><?php echo blog_html(blog_field('excerpt')); ?></textarea>

                <label class="mt-4 block text-sm font-semibold">Content</label>
                <textarea name="content" rows="12" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" required><?php echo blog_html(blog_field('content')); ?></textarea>
                <p class="mt-2 text-xs text-slate-500">Use plain text or light HTML. Preview updates below.</p>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-6">
                <h3 class="text-sm font-semibold">Live Preview</h3>
                <div id="preview" class="mt-4 rounded-lg border border-dashed border-slate-200 bg-slate-50 p-4 text-sm text-slate-600"></div>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-6">
                <h3 class="text-sm font-semibold">SEO Metadata</h3>
                <label class="mt-4 block text-sm font-semibold">SEO Title</label>
                <input type="text" name="seo_title" value="<?php echo blog_html(blog_field('seo_title')); ?>" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">

                <label class="mt-4 block text-sm font-semibold">SEO Description</label>
                <textarea name="seo_description" rows="3" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"><?php echo blog_html(blog_field('seo_description')); ?></textarea>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="rounded-xl border border-slate-200 bg-white p-6">
                <label class="text-sm font-semibold">Status</label>
<?php $currentStatus = blog_field('status', 'draft'); ?>
<?php $publishedValue = blog_field('published_at'); ?>
<?php $publishedValue = $publishedValue ? date('Y-m-d\\TH:i', strtotime($publishedValue)) : ''; ?>
                <select name="status" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <option value="draft" <?php echo $currentStatus === 'draft' ? 'selected' : ''; ?>>Draft</option>
                    <option value="published" <?php echo $currentStatus === 'published' ? 'selected' : ''; ?>>Published</option>
                    <option value="scheduled" <?php echo $currentStatus === 'scheduled' ? 'selected' : ''; ?>>Scheduled</option>
                </select>

                <label class="mt-4 block text-sm font-semibold">Publish Date</label>
                <input type="datetime-local" name="published_at" value="<?php echo blog_html($publishedValue); ?>" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                <p class="mt-2 text-xs text-slate-500">Leave blank to publish immediately.</p>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-6">
                <label class="text-sm font-semibold">Category</label>
                <select name="category_id" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <option value="">Uncategorized</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo blog_html($category['id']); ?>" <?php echo (string) blog_field('category_id') === (string) $category['id'] ? 'selected' : ''; ?>><?php echo blog_html($category['name']); ?></option>
                    <?php endforeach; ?>
                </select>

                <label class="mt-4 block text-sm font-semibold">Tags</label>
                <input type="text" name="tags" value="<?php echo blog_html($tagValue); ?>" placeholder="news, release, update" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                <p class="mt-2 text-xs text-slate-500">Comma-separated list.</p>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-6">
                <label class="text-sm font-semibold">Featured Image</label>
                <input type="file" name="featured_image" class="mt-2 w-full text-sm text-slate-500">
                <?php if ($isEditing && !empty($post['featured_image'])): ?>
                    <img src="/<?php echo blog_html($post['featured_image']); ?>" alt="Featured" class="mt-4 w-full rounded-lg border border-slate-200">
                <?php endif; ?>
            </div>

            <button type="submit" class="w-full rounded-lg bg-indigo-600 px-4 py-3 text-sm font-semibold text-white hover:bg-indigo-700">
                <?php echo $isEditing ? 'Update Post' : 'Create Post'; ?>
            </button>
        </aside>
    </div>
</form>

<script>
    const textarea = document.querySelector('textarea[name="content"]');
    const preview = document.getElementById('preview');
    const updatePreview = () => {
        const value = textarea.value || 'Start writing to see a preview.';
        preview.textContent = value;
    };
    textarea.addEventListener('input', updatePreview);
    updatePreview();
</script>
<?php include __DIR__ . '/footer.php'; ?>
