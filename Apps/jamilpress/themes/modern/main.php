<section class="flex flex-col gap-6">
    <div class="flex flex-col gap-4 rounded-2xl bg-white p-6 shadow-sm md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400"><?php
                if(isset($_GET['search'])){
                    echo "Search Result";
                }else{
                    echo "Latest Posts";
                }
            ?></p>
            <h2 class="mt-2 text-2xl font-semibold text-slate-900">Discover new stories</h2>
        </div>
        <form action="" method="get" class="flex w-full max-w-md items-center gap-2">
            <input type="text" class="w-full rounded-full border border-slate-200 px-4 py-2 text-sm text-slate-600 focus:border-slate-400 focus:outline-none" name="search" placeholder="Search posts...">
            <button type="submit" class="rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">Search</button>
        </form>
    </div>

    <div class="grid gap-6">
       <?php
            if(isset($_GET['search'])){
                global $Url;
                $xt = $Url->get_paths();
                $posts = getPosts2($xt[1]);
                $link = $xt[1];
                $posts = searchPosts($_GET['search']);
                foreach($posts as $p){
                    $title = $p['title'];
                    $summary = $p['content'];
                    $image = $p['image'];
                    $id = $p['id'];
                    $date = get_default_date($p['date_created']);
                    include "item.php";
                }
            }else{
                global $Url;
                $xt = $Url->get_paths();
                $posts = getPosts2($xt[1]);
                $link = $xt[1];

            foreach($posts as $p){
                $title = $p['title'];
                $summary = $p['content'];
                $image = $p['image'];
                $id = $p['id'];
                $date = get_default_date($p['date_created']);
                include "item.php";
            }
            }
       ?>
    </div>
</section>
