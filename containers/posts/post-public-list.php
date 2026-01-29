<?php

addHit("visitor",'posts');
        global $db;
        //$code = $_GET['b'];
        $sql = "SELECT * FROM `posts`";

        $row = $db->Query($sql);
        echo "<div class='row'>";
        foreach($row as $r){
            
             $id = $r['id'];
             
            $title =  $r['title'];
                $tcontent =$r['content'];
                $image = $r['image'];
                $authur = $r['author'];
                $rdate = new DateTime($r['date_created']);
                $date = $rdate->format("M d, Y");
                $rcontent = strip_tags($tcontent);
                $content = substr($rcontent,0,200);
               
             include("containers/posts/post-card.php");
             
        
        }
        echo "</div>";                          
?>