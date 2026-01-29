<section class="bg-slate-50 py-10">
    <div class="mx-auto max-w-6xl px-6">
        <header class="rounded-3xl bg-gradient-to-r from-blue-600 via-sky-500 to-cyan-400 p-8 text-white shadow-lg">
            <h2 class="text-2xl font-semibold">Gallery</h2>
            <p class="mt-2 text-sm text-blue-100">Review, preview, and manage uploaded assets.</p>
        </header>
        <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
    <?php
    global $JX_db;
    $own = intval($_SESSION['uid']);
    $sql = "SELECT *FROM  `media` WHERE `owner`= $own";

    $result = $JX_db->query($sql);

    foreach($result as $r){
        $image = $r['name'];
        $intsize = intval($r['size']);
        $text = $r['summary'];
        $name = $image;
        $size = $intsize / 1000;
        $date = get_default_date($r['date']);
        include "image-card.php";
    } 
    ?>
        </div>
    </div>
</section>
