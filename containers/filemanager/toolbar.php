<div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <form action="filemanager/browse" method="get" class="flex flex-wrap items-end gap-3">
            <div>
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Scope</label>
                <select name="scope" class="mt-1 w-40 rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <?php foreach ($scopeOptions as $key => $scopeOption): ?>
                        <option value="<?php echo filemanager_html($key); ?>" <?php echo $key === $scope ? 'selected' : ''; ?>>
                            <?php echo filemanager_html($scopeOption['label']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="hidden" name="path" value="<?php echo filemanager_html($currentPath ?? ''); ?>">
            <button type="submit" class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100">Switch</button>
        </form>

        <div class="flex flex-wrap gap-3">
            <form action="filemanager/new-folder" method="post" class="flex flex-wrap items-end gap-2">
                <input type="hidden" name="scope" value="<?php echo filemanager_html($scope); ?>">
                <input type="hidden" name="path" value="<?php echo filemanager_html($currentPath ?? ''); ?>">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">New Folder</label>
                    <input type="text" name="name" placeholder="Folder name" class="mt-1 w-40 rounded-lg border border-slate-300 px-3 py-2 text-sm" required>
                </div>
                <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Create</button>
            </form>

            <form action="filemanager/upload" method="post" enctype="multipart/form-data" class="flex flex-wrap items-end gap-2">
                <input type="hidden" name="scope" value="<?php echo filemanager_html($scope); ?>">
                <input type="hidden" name="path" value="<?php echo filemanager_html($currentPath ?? ''); ?>">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Upload</label>
                    <input type="file" name="files[]" multiple class="mt-1 w-48 text-sm">
                </div>
                <button type="submit" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Upload</button>
            </form>
        </div>
    </div>

    <div class="mt-4 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
        <form action="filemanager/search" method="get" class="flex flex-wrap items-center gap-2">
            <input type="hidden" name="scope" value="<?php echo filemanager_html($scope); ?>">
            <input type="hidden" name="path" value="<?php echo filemanager_html($currentPath ?? ''); ?>">
            <input type="text" name="q" value="<?php echo filemanager_html($searchQuery ?? ''); ?>" placeholder="Search files" class="w-64 rounded-lg border border-slate-300 px-3 py-2 text-sm">
            <button type="submit" class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100">Search</button>
            <?php if ($isSearch): ?>
                <a href="<?php echo filemanager_page_url('filemanager/browse', ['scope' => $scope, 'path' => $currentPath]); ?>" class="text-sm text-slate-500 underline">Clear</a>
            <?php endif; ?>
        </form>

        <div class="text-sm text-slate-500">
            <?php echo $pagination['total']; ?> item(s) found
        </div>
    </div>
</div>
