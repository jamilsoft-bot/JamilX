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
<div class=" w3-pale-blue w3-border w3-leftbar w3-border-blue">
            <header class="w3-container w3-margin w3-blue">
                    <h1><?php echo $name; ?></h1>
            </header>
            <div class="w3-container" style="min-height: 300pt;">
                    <?php echo $content;?>
            </div>
        </div>