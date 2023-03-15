<?php

$title;
$content;
$image;
$date;

global $db;
$code = $_GET['b'];
$id = $_GET['pid'];
$sql = "SELECT * FROM `categories` WHERE  `id`='$id'";

$row = $db->Query($sql);

foreach($row as $r){
   
    $title = $r['name'];
    $content = $r['description'];
    $image = file_exists("data/".$r['image'])?"data/".$r['image']:"data/pimage.png";




?>

<style>
    .image{
        width:100pt;
        height:100pt;
        float:left;
    }
</style>
<header class="w3-container w3-blue ">
                    <h3 id='tt'> <?php echo $title; ?></h3>
</header>
                <div class="w3-container content">
                <?php
                                 
                                
                                            echo "<img src='$image' class='image'>";
                                            echo $content;

                                        // echo "<tr>";
                                        // echo "<td>". $r['id'] . "</td>";
                                        // echo "<td>". $d . "</td>";
                                        // echo "<td>". $r['owner'] . "</td>";
                                        // echo "<td>". $r['data_created'] . "</td>";
                                        // echo "<td> <a href='#' class='btn btn-primary'>View</a><a href='#' class='btn btn-secondary w3-margin-left'>Update</a><a href='#' class='btn btn-danger w3-margin-left'>Delete</a> </td>";
                                    
                                    }
                                    
                                ?>
                     
                </div>


