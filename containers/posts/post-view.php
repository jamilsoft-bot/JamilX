<?php

$title;
$content;
$image;
$date;

global $db;
$code = $_GET['b'];
$id = $_GET['pid'];
$sql = "SELECT * FROM `posts` WHERE `type`='post' AND `id`='$id'";

$row = $db->Query($sql);

foreach($row as $r){
   
    $title = $r['title'];
    $content = $r['content'];
    $image = file_exists("data/".$r['image'])?"data/".$r['image']:"data/pimage.png";




?>

<section class="bg-slate-50 py-10">
    <div class="mx-auto max-w-5xl px-6">
        <header class="rounded-3xl bg-gradient-to-r from-indigo-600 via-blue-600 to-sky-500 p-8 text-white shadow-lg">
            <h3 id='tt' class="text-2xl font-semibold"> <?php echo $title; ?></h3>
            <p class="mt-2 text-sm text-blue-100">Post details and full content.</p>
        </header>
        <div class="mt-8 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
        <?php
                                 
                                
                                            echo "<img src='$image' class='mb-6 h-40 w-40 rounded-2xl object-cover shadow-sm'>";
                                            echo "<div class='prose max-w-none text-slate-600'>".$content."</div>";

                                        // echo "<tr>";
                                        // echo "<td>". $r['id'] . "</td>";
                                        // echo "<td>". $d . "</td>";
                                        // echo "<td>". $r['owner'] . "</td>";
                                        // echo "<td>". $r['data_created'] . "</td>";
                                        // echo "<td> <a href='#' class='btn btn-primary'>View</a><a href='#' class='btn btn-secondary w3-margin-left'>Update</a><a href='#' class='btn btn-danger w3-margin-left'>Delete</a> </td>";
                                    
                                    }
                                    
                                ?>
        </div>
    </div>
</section>

