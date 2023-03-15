<?php

$title;
$content;
$image;
$date;
$bowner = $blogowner;
global $db;
//$code = $_GET['b'];
$id = $_GET['pid'];
$sql = "SELECT * FROM `posts` WHERE `type`='post' AND `id`='$id'";

$row = $db->Query($sql);

foreach($row as $r){
   
    $title = $r['title'];
    $content = $r['content'];
    $author = $r['author'];
    $rdate = new DateTime($r['date_created']);
    $date = $rdate->format("M d, Y");
    $image = file_exists("data/".$r['image'])?"data/".$r['image']:"data/post.png";

}



// include "containers/blog/post-single.php";
?>
<div class=" w3-container">
            <header class="w3-container ">
                    <h1><?php echo $title; ?></h1>
                    <img src="<?php echo $image;?>" style="max-width: 70%;max-height:200pt;float:left">
            </header>
            <div class="w3-container" style="min-height: 300pt;">
                    <?php echo $content;?>
            </div>
            <footer class="w3-container ">
                    <?php 
                    include "containers/comment/comment-public-list.php"
                    ?>
            </footer>
        </div>