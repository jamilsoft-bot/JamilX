<?php

$title;
$content;
$image;
$date;
$bowner = $blogowner;
global $db;
//$code = $_GET['b'];
$id = $_GET['pid'];
$sql = "SELECT * FROM `categories` WHERE  `id`='$id'";

$row = $db->Query($sql);

foreach($row as $r){
   
    $title = $r['name'];
    $content = $r['description'];
    $author = $r['author'];
    $rdate = new DateTime($r['date_created']);
    $date = $rdate->format("M d, Y");
    $image = file_exists("data/".$r['image'])?"data/".$r['image']:"data/post.png";

}



// include "containers/blog/post-single.php";
?>
<section class="bg-slate-50 py-10">
    <div class="mx-auto max-w-5xl px-6">
        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <header class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-blue-600">Category</p>
                    <h1 class="mt-2 text-3xl font-semibold text-slate-900"><?php echo $title; ?></h1>
                    <p class="mt-2 text-sm text-slate-500">Updated <?php echo $date; ?> · <?php echo $author; ?></p>
                </div>
                <img src="<?php echo $image;?>" class="h-48 w-full rounded-2xl object-cover lg:w-72" alt="<?php echo $title; ?>">
            </header>
            <div class="prose mt-8 max-w-none text-slate-600">
                <?php echo $content;?>
            </div>
            <footer class="mt-10 border-t border-slate-100 pt-6">
                    <?php 
                    include "containers/comment/comment-public-list.php"
                    ?>
            </footer>
        </div>
    </div>
</section>
