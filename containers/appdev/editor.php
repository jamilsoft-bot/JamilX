<?php
$token = appdev_editor_csrf_token();
$categories = appdev_editor_categories();
$apps = appdev_editor_get_apps();
?>

<div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
    <div class="border-b border-slate-200 bg-slate-50 px-4 py-3 flex flex-wrap items-center gap-3 justify-between">
        <div class="flex items-center gap-2 text-sm">
            <span class="inline-flex items-center rounded-lg bg-blue-100 text-blue-700 px-2 py-1 font-semibold">
                <i class="fas fa-code mr-1"></i> Code Editor
            </span>
            <span id="editor-current-file" class="text-slate-600">No file open</span>
        </div>

        <div class="flex items-center gap-2">
            <button id="editor-new-file" class="rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm font-semibold text-slate-700 hover:bg-slate-100">New File</button>
            <button id="editor-new-folder" class="rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm font-semibold text-slate-700 hover:bg-slate-100">New Folder</button>
            <button id="editor-rename" class="rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm font-semibold text-slate-700 hover:bg-slate-100">Rename</button>
            <button id="editor-delete" class="rounded-lg border border-rose-300 bg-rose-50 px-3 py-1.5 text-sm font-semibold text-rose-700 hover:bg-rose-100">Delete</button>
            <button id="editor-save" class="rounded-lg bg-blue-600 px-3 py-1.5 text-sm font-semibold text-white hover:bg-blue-700">Save (Ctrl/Cmd+S)</button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 min-h-[680px]">
        <aside class="lg:col-span-3 border-r border-slate-200 p-4 space-y-4 bg-slate-50">
            <div>
                <label class="text-xs uppercase font-semibold text-slate-500">Scope</label>
                <select id="editor-scope" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <option value="global">Global</option>
                    <option value="app">App</option>
                </select>
            </div>

            <div>
                <label class="text-xs uppercase font-semibold text-slate-500">App</label>
                <select id="editor-app" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" disabled>
                    <option value="">Select app</option>
                    <?php foreach ($apps as $app): ?>
                        <option value="<?php echo appdev_editor_html($app['nick']); ?>"><?php echo appdev_editor_html($app['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="text-xs uppercase font-semibold text-slate-500">Area</label>
                <div class="mt-1 grid grid-cols-2 gap-2" id="editor-categories">
                    <?php foreach ($categories as $key => $label): ?>
                        <button data-category="<?php echo appdev_editor_html($key); ?>" class="editor-category-btn rounded-lg border border-slate-300 bg-white px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-100 <?php echo $key === 'actions' ? 'ring-2 ring-blue-500' : ''; ?>">
                            <?php echo appdev_editor_html($label); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <div>
                <label class="text-xs uppercase font-semibold text-slate-500">Filter</label>
                <input id="editor-filter" type="search" placeholder="Search files..." class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
            </div>

            <div>
                <p class="text-xs uppercase font-semibold text-slate-500 mb-2">Path</p>
                <div class="flex items-center gap-2">
                    <button id="editor-up" class="rounded-lg border border-slate-300 bg-white px-2.5 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-100">Up</button>
                    <code id="editor-path" class="text-xs text-slate-600 break-all">/</code>
                </div>
            </div>
        </aside>

        <section class="lg:col-span-4 border-r border-slate-200 p-3 overflow-auto" id="editor-tree-wrap">
            <div id="editor-tree" class="space-y-1"></div>
        </section>

        <section class="lg:col-span-5 p-3 flex flex-col">
            <div id="editor-status" class="text-xs text-slate-500 mb-2">Ready.</div>
            <textarea id="editor-textarea" class="w-full flex-1 min-h-[560px] rounded-lg border border-slate-300 px-3 py-2 font-mono text-sm" spellcheck="false" placeholder="Open a file from the tree to edit..."></textarea>
        </section>
    </div>
</div>

<script>
(() => {
    const state = {
        csrf: <?php echo json_encode($token); ?>,
        scope: 'global',
        app: '',
        category: 'actions',
        path: '',
        selected: null,
        openFile: null,
        contentHash: null,
        dirty: false,
        entries: []
    };

    const el = {
        scope: document.getElementById('editor-scope'),
        app: document.getElementById('editor-app'),
        path: document.getElementById('editor-path'),
        tree: document.getElementById('editor-tree'),
        filter: document.getElementById('editor-filter'),
        up: document.getElementById('editor-up'),
        textarea: document.getElementById('editor-textarea'),
        status: document.getElementById('editor-status'),
        currentFile: document.getElementById('editor-current-file'),
        save: document.getElementById('editor-save'),
        newFile: document.getElementById('editor-new-file'),
        newFolder: document.getElementById('editor-new-folder'),
        rename: document.getElementById('editor-rename'),
        del: document.getElementById('editor-delete')
    };

    function setStatus(message, bad = false) {
        el.status.textContent = message;
        el.status.className = bad ? 'text-xs text-rose-600 mb-2' : 'text-xs text-slate-500 mb-2';
    }

    function endpoint(query) {
        return `?serve=appdev&action=editor-api&${query}`;
    }

    async function apiGet(op, params = {}) {
        const qs = new URLSearchParams({ op, ...params });
        const res = await fetch(endpoint(qs.toString()), { headers: { 'Accept': 'application/json' } });
        return res.json();
    }

    async function apiPost(op, payload = {}) {
        const res = await fetch(endpoint(`op=${encodeURIComponent(op)}`), {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify({ ...payload, csrf: state.csrf })
        });
        return res.json();
    }

    function renderTree(entries) {
        const q = el.filter.value.trim().toLowerCase();
        el.tree.innerHTML = '';

        const filtered = entries.filter(item => !q || item.name.toLowerCase().includes(q));
        if (filtered.length === 0) {
            el.tree.innerHTML = '<div class="text-sm text-slate-500 px-2 py-4">No files found.</div>';
            return;
        }

        filtered.forEach(item => {
            const row = document.createElement('button');
            row.type = 'button';
            row.className = 'w-full text-left rounded-lg px-3 py-2 hover:bg-slate-100 border border-transparent';
            if (state.selected === item.path) {
                row.classList.add('bg-blue-50', 'border-blue-200');
            }

            row.innerHTML = `<div class="flex items-center justify-between gap-2">
                <span class="text-sm ${item.type === 'dir' ? 'font-semibold text-slate-800' : 'text-slate-700'}">
                    <i class="fas ${item.type === 'dir' ? 'fa-folder text-amber-500' : 'fa-file-code text-blue-500'} mr-2"></i>${item.name}
                </span>
                <span class="text-[11px] text-slate-400">${item.type}</span>
            </div>`;

            row.addEventListener('click', async () => {
                state.selected = item.path;
                if (item.type === 'dir') {
                    if (guardDirty()) {
                        state.path = item.path;
                        await loadList();
                    }
                } else {
                    await openFile(item.path);
                }
                renderTree(state.entries);
            });

            el.tree.appendChild(row);
        });
    }

    async function loadList() {
        setStatus('Loading directory...');
        const res = await apiGet('list', {
            scope: state.scope,
            category: state.category,
            app: state.app,
            path: state.path
        });

        if (!res.success) {
            setStatus(res.error || 'Failed to load list.', true);
            el.tree.innerHTML = '';
            return;
        }

        state.entries = res.entries || [];
        el.path.textContent = '/' + (res.path || '');
        renderTree(state.entries);
        setStatus(`Loaded ${state.entries.length} item(s).`);
    }

    async function openFile(path) {
        if (!guardDirty()) {
            return;
        }

        setStatus('Opening file...');
        const res = await apiGet('read', {
            scope: state.scope,
            category: state.category,
            app: state.app,
            path
        });

        if (!res.success) {
            setStatus(res.error || 'Failed to read file.', true);
            return;
        }

        state.openFile = res.path;
        state.contentHash = res.hash || null;
        state.dirty = false;

        el.textarea.value = res.content || '';
        el.currentFile.textContent = res.path;
        setStatus(`Opened ${res.path}`);
    }

    async function saveFile() {
        if (!state.openFile) {
            setStatus('Open a file first.', true);
            return;
        }

        setStatus('Saving...');
        const res = await apiPost('save', {
            scope: state.scope,
            category: state.category,
            app: state.app,
            path: state.openFile,
            content: el.textarea.value
        });

        if (!res.success) {
            setStatus(res.error || 'Save failed.', true);
            return;
        }

        state.contentHash = res.hash || null;
        state.dirty = false;
        setStatus(`Saved ${res.path}`);
        await loadList();
    }

    function guardDirty() {
        if (!state.dirty) {
            return true;
        }
        return window.confirm('You have unsaved changes. Continue without saving?');
    }

    function parentPath(path) {
        const parts = (path || '').split('/').filter(Boolean);
        parts.pop();
        return parts.join('/');
    }

    async function createItem(kind) {
        const label = kind === 'dir' ? 'folder' : 'file';
        const name = window.prompt(`Enter ${label} name:`);
        if (!name) return;

        const res = await apiPost('create', {
            scope: state.scope,
            category: state.category,
            app: state.app,
            path: state.path,
            name,
            kind
        });

        if (!res.success) {
            setStatus(res.error || `Unable to create ${label}.`, true);
            return;
        }

        setStatus(`${label} created.`);
        await loadList();
    }

    async function renameItem() {
        if (!state.selected) {
            setStatus('Select an item to rename.', true);
            return;
        }

        const current = state.selected.split('/').pop();
        const newName = window.prompt('New name:', current);
        if (!newName || newName === current) return;

        const res = await apiPost('rename', {
            scope: state.scope,
            category: state.category,
            app: state.app,
            path: state.selected,
            newName
        });

        if (!res.success) {
            setStatus(res.error || 'Rename failed.', true);
            return;
        }

        if (state.openFile === state.selected) {
            state.openFile = res.path;
            el.currentFile.textContent = res.path;
        }

        state.selected = res.path;
        setStatus('Item renamed.');
        await loadList();
    }

    async function deleteItem() {
        if (!state.selected) {
            setStatus('Select an item to delete.', true);
            return;
        }

        if (!window.confirm(`Delete ${state.selected}?`)) return;

        const res = await apiPost('delete', {
            scope: state.scope,
            category: state.category,
            app: state.app,
            path: state.selected
        });

        if (!res.success) {
            setStatus(res.error || 'Delete failed.', true);
            return;
        }

        if (state.openFile === state.selected) {
            state.openFile = null;
            state.dirty = false;
            el.textarea.value = '';
            el.currentFile.textContent = 'No file open';
        }

        state.selected = null;
        setStatus('Item deleted.');
        await loadList();
    }

    el.scope.addEventListener('change', async () => {
        if (!guardDirty()) {
            el.scope.value = state.scope;
            return;
        }

        state.scope = el.scope.value;
        el.app.disabled = state.scope !== 'app';
        if (state.scope !== 'app') {
            state.app = '';
            el.app.value = '';
        }
        state.path = '';
        state.selected = null;
        await loadList();
    });

    el.app.addEventListener('change', async () => {
        if (!guardDirty()) {
            el.app.value = state.app;
            return;
        }

        state.app = el.app.value;
        state.path = '';
        state.selected = null;
        await loadList();
    });

    document.querySelectorAll('.editor-category-btn').forEach(btn => {
        btn.addEventListener('click', async () => {
            if (!guardDirty()) return;

            document.querySelectorAll('.editor-category-btn').forEach(b => b.classList.remove('ring-2', 'ring-blue-500'));
            btn.classList.add('ring-2', 'ring-blue-500');

            state.category = btn.dataset.category;
            state.path = '';
            state.selected = null;
            await loadList();
        });
    });

    el.filter.addEventListener('input', () => renderTree(state.entries));

    el.up.addEventListener('click', async () => {
        if (!guardDirty()) return;
        state.path = parentPath(state.path);
        state.selected = null;
        await loadList();
    });

    el.textarea.addEventListener('input', () => {
        if (state.openFile) {
            state.dirty = true;
            el.currentFile.textContent = `${state.openFile} *`;
        }
    });

    el.save.addEventListener('click', saveFile);
    el.newFile.addEventListener('click', () => createItem('file'));
    el.newFolder.addEventListener('click', () => createItem('dir'));
    el.rename.addEventListener('click', renameItem);
    el.del.addEventListener('click', deleteItem);

    document.addEventListener('keydown', (event) => {
        if ((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === 's') {
            event.preventDefault();
            saveFile();
        }
    });

    window.addEventListener('beforeunload', (event) => {
        if (!state.dirty) return;
        event.preventDefault();
        event.returnValue = '';
    });

    loadList();
})();
</script>
