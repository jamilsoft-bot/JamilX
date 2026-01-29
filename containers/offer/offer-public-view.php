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
<div class=" w3-pale-blue w3-border w3-leftbar w3-border-blue">
            <header class="w3-container w3-margin w3-blue">
                    <h1><?php echo $title; ?></h1>
            </header>
            <div class="w3-container" style="min-height: 300pt;">
                    <?php echo $content;?>
            </div>
        </div>