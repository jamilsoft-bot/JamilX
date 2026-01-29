<section class="bg-slate-50 py-10">
    <div class="mx-auto max-w-5xl px-6">
        <header class="rounded-3xl bg-gradient-to-r from-blue-600 via-sky-500 to-cyan-400 p-8 text-white shadow-lg">
            <h3 class="text-2xl font-semibold">Create Category</h3>
            <p class="mt-2 text-sm text-blue-100">Organize content with structured categories and tags.</p>
        </header>
        <div class="mt-8 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
<?php



?>
            <div class="flex flex-wrap items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-600">
                <a href="#" class="rounded-full bg-white px-4 py-2 text-slate-700 shadow-sm">Create</a>
                <a href="#" class="rounded-full px-4 py-2 text-slate-500 transition hover:bg-white hover:text-slate-700">List</a>
            </div>
            <form action="" method="post" enctype="multipart/form-data" class="mt-6 space-y-6">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Category Title</label>
                    <input type="text" name="title" placeholder="Category Title" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Parent</label>
                    <select name="parent" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        <option value="uncategorized">Uncategorized</option>
                        <?php

                        global $db;
                        $sql = "SELECT *FROM `categories`";
                        $result =$db->Query($sql);
                        $name = null;
                        $brandcode = null;
                        foreach($result as $r){
                            $name = $r['name'];
                            $brandcode = $r['id'];
                            echo "<option value='$brandcode'>$name</option>";
                        }
                        

                        ?>
                    </select>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Featured Image</label>
                    <input type="file" name="image" class="mt-2 w-full rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-500" required>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Category Body</label>
                    <div class="mt-2 rounded-2xl border border-slate-200 bg-white">
                        <textarea name='content' id='pid' cols="60" rows="8" class="w-full rounded-2xl border-0 bg-transparent px-4 py-3 text-sm text-slate-700 focus:outline-none"></textarea>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Keywords</label>
                    <input type="text" name="keywords" placeholder="Keywords" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
                </div>
                <div class="flex justify-end">
                    <input type="submit" name="padd" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700" value="Add Category">
                </div>
            </form>
        </div>
    </div>
</section>





