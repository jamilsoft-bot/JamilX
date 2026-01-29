<?php

$title = null;
$content = null;
$image = null;
$date = null;

global $db;
//$code = $_GET['b'];
$id = $_GET['pid'];
$sql = "SELECT * FROM `products` WHERE  `id`='$id'";

$row = $db->Query($sql);

foreach($row as $r){
        $name =  $r['name'];
        $content = $r['content'];
}



?>
<section class="bg-slate-50 py-10">
    <div class="mx-auto max-w-5xl px-6">
        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <header class="border-b border-slate-100 pb-6">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-blue-600">Product</p>
                <h1 class="mt-2 text-3xl font-semibold text-slate-900"><?php echo $name; ?></h1>
            </header>
            <div class="prose mt-6 max-w-none text-slate-600">
                <?php echo $content;?>
            </div>
        </div>
    </div>
</section>
