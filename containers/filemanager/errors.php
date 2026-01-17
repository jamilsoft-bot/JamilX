<?php if (!empty($notice)): ?>
    <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
        <?php echo filemanager_html($notice); ?>
    </div>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <div class="space-y-2">
        <?php foreach ($errors as $error): ?>
            <div class="rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                <?php echo filemanager_html($error); ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
