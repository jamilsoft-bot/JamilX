<section class="bg-slate-50 py-10">
    <div class="mx-auto max-w-5xl px-6">
        <header class="rounded-3xl bg-gradient-to-r from-fuchsia-600 via-purple-500 to-indigo-500 p-8 text-white shadow-lg">
            <h3 class="text-2xl font-semibold"> <?php echo $this->getTitle(); ?></h3>
            <p class="mt-2 text-sm text-purple-100">Create new promotional offers with clear calls-to-action.</p>
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
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Offer Name</label>
                    <input type="text" name="name" placeholder="Type Offer name" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200" required>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Offer Types</label>
                    <div class="mt-2 grid gap-4 md:grid-cols-2">
                        <select name="type" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200" required>
                            <option value="visitation">Visit Now</option>
                            <option value="call">Call Now</option>
                            <option value="email">Email Now</option>
                            <option value="apointment"> Make an Appointment</option>
                            <option value="apointment"> Install Now</option>
                            <option value="apointment"> Buy Now</option>
                            <option value="apointment"> Get Started</option>
                        </select>
                        <input type="text" name="link" placeholder="values" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200" required>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Brand</label>
                    <select name="parent" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200">
                        <option value="jamilsoft">Default</option>
                        <?php

                        global $db;
                        $sql = "SELECT *FROM `brands`";
                        $result =$db->Query($sql);

                        foreach($result as $r){
                            $name = $r['name'];
                            $brandcode = $r['code'];
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
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Offer Details</label>
                    <div class="mt-2 rounded-2xl border border-slate-200 bg-white">
                        <textarea name='content' id='pid' cols="60" rows="8" class="w-full rounded-2xl border-0 bg-transparent px-4 py-3 text-sm text-slate-700 focus:outline-none"></textarea>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Keywords</label>
                    <input type="text" name="keywords" placeholder="e.g product, service, computer" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200" required>
                </div>
                <div class="flex justify-end">
                    <input type="submit" name="oadd" class="inline-flex items-center justify-center rounded-2xl bg-purple-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-purple-700" value="Add Offer">
                </div>
            </form>
        </div>
    </div>
</section>





