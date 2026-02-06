<section class="space-y-6">
    <div class="rounded-2xl bg-white p-6 shadow-sm">
        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Post</p>
        <h1 class="mt-2 text-3xl font-semibold text-slate-900"><?php echo $post->getName(); ?></h1>
        <div class="mt-6 overflow-hidden rounded-2xl bg-slate-100">
            <img class="h-72 w-full object-cover" src="<?php
                $image = $post->getImage();
                if($image == null){
                    echo "../Apps/jamilpress/assets/images/blogpost.png";
                }else{
                    echo "../data/$image";
                }
                ?>" alt="<?php echo $post->getName();?>">
        </div>
    </div>
    <div class="rounded-2xl bg-white p-6 text-base leading-7 text-slate-700 shadow-sm">
        <?php echo $post->getContent();?>
    </div>
    <div class="rounded-2xl bg-white p-6 shadow-sm">
        <?php include "comment-list.php";?>
    </div>
</section>
