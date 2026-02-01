<div class="mx-auto max-w-4xl px-6 py-8">
    <form action="" method="post" class="grid gap-6 md:grid-cols-2">
        <div>
            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Category Name</label>
            <input type="text" name="name" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        </div>
        <div>
            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Description</label>
            <input type="text" name="summary" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        </div>
        <div>
            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Parent Category</label>
            <select name="parent" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                <?php
                    echo "<option>root</option>";
                    global $JX_db;
                    $sql = "SELECT *FROM `categories`";
                    $ee = $JX_db->query($sql);
                    foreach($ee as $e){
                        $name = $e['name'];
                        echo "<option>$name</option>";
                    }
                ?>
            </select>
        </div>
        <div class="flex items-end">
            <input type="submit" name="catbtn" class="inline-flex w-full items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700" value="Add Category">
        </div>
    </form>
</div>
