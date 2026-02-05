<section class="bg-slate-50 py-10">
    <div class="mx-auto max-w-6xl px-6">
        <header class="rounded-3xl bg-gradient-to-r from-indigo-600 via-blue-600 to-sky-500 p-8 text-white shadow-lg">
            <h3 class="text-2xl font-semibold"> <?php echo $this->getTitle(); ?></h3>
            <p class="mt-2 text-sm text-blue-100">Manage all posts and publishing activity.</p>
        </header>
        <div class="mt-8 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-wrap items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-600">
                <a href="#" class="rounded-full bg-white px-4 py-2 text-slate-700 shadow-sm">Create</a>
                <a href="#" class="rounded-full px-4 py-2 text-slate-500 transition hover:bg-white hover:text-slate-700">List</a>
            </div>
            <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-4 py-3 text-left">Id</th>
                            <th class="px-4 py-3 text-left">Title</th>
                            <th class="px-4 py-3 text-left">Blog</th>
                            <th class="px-4 py-3 text-left">Comments</th>
                            <th class="px-4 py-3 text-left">Date created</th>
                            <th class="px-4 py-3 text-left">Operation</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        <?php
                            
                            global $db;
                                $code = $_GET['b'];
                                $sql = "SELECT * FROM `posts` WHERE `type`='post' AND `owner`='$code'";

                                $row = $db->Query($sql);

                                foreach($row as $r){
                                    
                                    $id = $r['id'];
                                    $code = $_GET['b'];
                                    $blog = $r['blog'];
                                    $sql2 = "SELECT *FROM `comments` WHERE `post_id`=$id";
                                    $re = $db->Query($sql2);
                                    $count = $re->num_rows;
                                    echo "<tr class='hover:bg-slate-50'>";
                                    echo "<td class='px-4 py-3 text-slate-600'>". $r['id'] . "</td>";
                                    echo "<td class='px-4 py-3 font-semibold text-slate-800'>". $r['title']. "</td>";
                                    echo "<td class='px-4 py-3 text-slate-600'>". $r['blog'] . "</td>";
                                    echo "<td class='px-4 py-3 text-slate-600'>$count</td>";
                                    echo "<td class='px-4 py-3 text-slate-600'>". get_default_date($r['date_created']) . "</td>";
                                    echo "<td class='px-4 py-3'>
                                        <div class='flex items-center gap-2'>
                                            <a href='$blog?action=postview&pid=$id' class='inline-flex items-center justify-center rounded-full border border-blue-200 bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700'><i class='fa fa-eye'></i></a>
                                            <a href='dashboard?b=$code&action=postupdate&pid=$id' class='inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-semibold text-slate-600'><i class='fa fa-edit'></i></a>
                                            <a href='dashboard?b=$code&action=posts&del=$id' class='inline-flex items-center justify-center rounded-full border border-rose-200 bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-600'><i class='fa fa-trash'></i></a>
                                        </div>
                                    </td>";
                                }
                                
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
