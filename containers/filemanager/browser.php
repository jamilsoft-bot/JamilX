<?php
$entries = $pagination['entries'] ?? [];
if (empty($entries)) {
    include 'containers/filemanager/empty_state.php';
    return;
}

function filemanager_sort_link($column, $label, $sort, $direction, $baseUrl, $scope, $currentPath, $isSearch, $searchQuery)
{
    $nextDir = ($sort === $column && $direction === 'asc') ? 'desc' : 'asc';
    $params = [
        'scope' => $scope,
        'path' => $currentPath,
        'sort' => $column,
        'dir' => $nextDir,
    ];
    if ($isSearch && $searchQuery) {
        $params['q'] = $searchQuery;
    }
    $url = filemanager_page_url($baseUrl, $params);
    echo '<a class="inline-flex items-center gap-1 text-sm font-semibold text-slate-600 hover:text-slate-900" href="' . filemanager_html($url) . '">' . filemanager_html($label) . '</a>';
}
?>
<div class="rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-slate-100 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 py-3"><?php filemanager_sort_link('name', 'Name', $sort, $direction, $baseUrl, $scope, $currentPath, $isSearch, $searchQuery); ?></th>
                    <th class="px-4 py-3"><?php filemanager_sort_link('type', 'Type', $sort, $direction, $baseUrl, $scope, $currentPath, $isSearch, $searchQuery); ?></th>
                    <th class="px-4 py-3"><?php filemanager_sort_link('size', 'Size', $sort, $direction, $baseUrl, $scope, $currentPath, $isSearch, $searchQuery); ?></th>
                    <th class="px-4 py-3"><?php filemanager_sort_link('date', 'Modified', $sort, $direction, $baseUrl, $scope, $currentPath, $isSearch, $searchQuery); ?></th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                <?php foreach ($entries as $entry): ?>
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <span class="rounded-full bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-600">
                                    <?php echo filemanager_html($entry['type']); ?>
                                </span>
                                <?php if ($entry['is_dir']): ?>
                                    <a class="font-semibold text-indigo-600 hover:text-indigo-700" href="<?php echo filemanager_page_url('filemanager/browse', ['scope' => $scope, 'path' => $entry['path']]); ?>">
                                        <?php echo filemanager_html($entry['name']); ?>
                                    </a>
                                <?php else: ?>
                                    <span class="font-semibold text-slate-800"><?php echo filemanager_html($entry['name']); ?></span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-slate-500"><?php echo filemanager_html($entry['type']); ?></td>
                        <td class="px-4 py-3 text-slate-500"><?php echo $entry['size'] !== null ? filemanager_html(filemanager_format_bytes($entry['size'])) : '--'; ?></td>
                        <td class="px-4 py-3 text-slate-500"><?php echo filemanager_html(date('M d, Y H:i', $entry['modified'] ?? time())); ?></td>
                        <td class="px-4 py-3">
                            <details class="group">
                                <summary class="cursor-pointer text-sm font-semibold text-indigo-600 hover:text-indigo-700">Manage</summary>
                                <div class="mt-2 space-y-2 rounded-lg border border-slate-200 bg-slate-50 p-3">
                                    <?php if (!$entry['is_dir']): ?>
                                        <div class="flex flex-wrap gap-2">
                                            <a class="text-sm font-semibold text-slate-700 underline" href="<?php echo filemanager_page_url('filemanager/download', ['scope' => $scope, 'path' => $entry['path']]); ?>">Download</a>
                                            <?php if (filemanager_is_previewable($entry['name'])): ?>
                                                <a class="text-sm font-semibold text-slate-700 underline" href="<?php echo filemanager_page_url('filemanager/preview', ['scope' => $scope, 'path' => $entry['path']]); ?>" target="_blank" rel="noopener">Preview</a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <form action="filemanager/rename" method="post" class="flex flex-wrap items-center gap-2">
                                        <input type="hidden" name="scope" value="<?php echo filemanager_html($scope); ?>">
                                        <input type="hidden" name="path" value="<?php echo filemanager_html($entry['path']); ?>">
                                        <input type="text" name="name" value="<?php echo filemanager_html($entry['name']); ?>" class="w-40 rounded border border-slate-300 px-2 py-1 text-sm">
                                        <button type="submit" class="rounded bg-slate-800 px-3 py-1 text-xs font-semibold text-white">Rename</button>
                                    </form>
                                    <form action="filemanager/move" method="post" class="flex flex-wrap items-center gap-2">
                                        <input type="hidden" name="scope" value="<?php echo filemanager_html($scope); ?>">
                                        <input type="hidden" name="path" value="<?php echo filemanager_html($entry['path']); ?>">
                                        <input type="text" name="target" placeholder="Target folder/path" class="w-48 rounded border border-slate-300 px-2 py-1 text-sm">
                                        <button type="submit" class="rounded bg-slate-700 px-3 py-1 text-xs font-semibold text-white">Move</button>
                                    </form>
                                    <form action="filemanager/copy" method="post" class="flex flex-wrap items-center gap-2">
                                        <input type="hidden" name="scope" value="<?php echo filemanager_html($scope); ?>">
                                        <input type="hidden" name="path" value="<?php echo filemanager_html($entry['path']); ?>">
                                        <input type="text" name="target" placeholder="Target folder/path" class="w-48 rounded border border-slate-300 px-2 py-1 text-sm">
                                        <button type="submit" class="rounded bg-slate-700 px-3 py-1 text-xs font-semibold text-white">Copy</button>
                                    </form>
                                    <form action="filemanager/delete" method="post" class="flex items-center gap-2" onsubmit="return confirm('Delete this item?');">
                                        <input type="hidden" name="scope" value="<?php echo filemanager_html($scope); ?>">
                                        <input type="hidden" name="path" value="<?php echo filemanager_html($entry['path']); ?>">
                                        <button type="submit" class="rounded bg-rose-600 px-3 py-1 text-xs font-semibold text-white">Delete</button>
                                    </form>
                                </div>
                            </details>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if ($pagination['total_pages'] > 1): ?>
    <div class="flex flex-wrap items-center justify-between gap-2">
        <div class="text-sm text-slate-500">
            Page <?php echo $pagination['page']; ?> of <?php echo $pagination['total_pages']; ?>
        </div>
        <div class="flex gap-2">
            <?php if ($pagination['page'] > 1): ?>
                <a class="rounded border border-slate-300 bg-white px-3 py-1 text-sm" href="<?php echo filemanager_page_url($baseUrl, ['scope' => $scope, 'path' => $currentPath, 'page' => $pagination['page'] - 1, 'sort' => $sort, 'dir' => $direction, 'q' => $searchQuery]); ?>">Previous</a>
            <?php endif; ?>
            <?php if ($pagination['page'] < $pagination['total_pages']): ?>
                <a class="rounded border border-slate-300 bg-white px-3 py-1 text-sm" href="<?php echo filemanager_page_url($baseUrl, ['scope' => $scope, 'path' => $currentPath, 'page' => $pagination['page'] + 1, 'sort' => $sort, 'dir' => $direction, 'q' => $searchQuery]); ?>">Next</a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
