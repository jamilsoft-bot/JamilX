<div class="rounded-lg border border-slate-200 bg-white px-4 py-3 shadow-sm">
    <div class="flex flex-wrap items-center gap-2 text-sm text-slate-500">
        <a href="<?php echo filemanager_page_url('filemanager/browse', ['scope' => $scope]); ?>" class="font-semibold text-slate-700">Root</a>
        <?php foreach ($breadcrumbs as $crumb): ?>
            <span>/</span>
            <a href="<?php echo filemanager_page_url('filemanager/browse', ['scope' => $scope, 'path' => $crumb['path']]); ?>" class="text-slate-600 hover:text-slate-900">
                <?php echo filemanager_html($crumb['label']); ?>
            </a>
        <?php endforeach; ?>
    </div>
    <?php if (!empty($currentPath)): ?>
        <p class="mt-2 text-xs text-slate-400">Current: <?php echo filemanager_html($currentPath); ?></p>
    <?php endif; ?>
</div>
