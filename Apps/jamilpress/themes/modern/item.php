<article class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-md">
    <div class="flex flex-col gap-6 p-6 md:flex-row md:items-center">
        <div class="h-40 w-full overflow-hidden rounded-xl bg-slate-100 md:h-32 md:w-56">
            <img class="h-full w-full object-cover" src="<?php
                if($image == null){
                    echo "../Apps/jamilpress/assets/images/blogpost.png";
                }else{
                    echo "../data/$image";
                }
                ?>" alt="<?php echo $title;?>">
        </div>
        <div class="flex-1 space-y-3">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Latest post</p>
            <h3 class="text-xl font-semibold text-slate-900"><?php echo $title;?></h3>
            <p class="text-sm text-slate-600"><?php echo substr(strip_tags($summary),0,250);?>...</p>
            <div class="flex flex-wrap items-center gap-4">
                <a href="<?php global $BLOG_URL; echo $link; ?>?view=post&id=<?php echo $id;?>" class="inline-flex items-center rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-white transition hover:bg-slate-800">Read more</a>
                <p class="text-xs text-slate-400">Created on <?php echo $date;?></p>
            </div>
        </div>
    </div>
</article>
