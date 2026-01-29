<?php

$title;
$content;
$image;
$date;

global $db;
//$code = $_GET['b'];
$id = $_GET['pid'];
$sql = "SELECT * FROM `campaigns` WHERE `type`='post' AND `id`='$id'";

$row = $db->Query($sql);

foreach($row as $r){
   
    $title = $r['title'];
    $content = $r['content'];
    $image = file_exists("data/".$r['image'])?"data/".$r['image']:"data/pimage.png";

}



?>
<section class="bg-slate-50 py-10">
    <div class="mx-auto max-w-5xl px-6">
        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <header class="border-b border-slate-100 pb-6">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-purple-500">Offer</p>
                <h1 class="mt-2 text-3xl font-semibold text-slate-900"><?php echo $title; ?></h1>
            </header>
            <div class="prose mt-6 max-w-none text-slate-600">
                <?php echo $content;?>
            </div>
        </div>
    </div>
</section>
