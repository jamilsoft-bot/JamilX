<?php
      addHit("visitor",'offers');                            
        global $db;
        //$code = $_GET['b'];
        $sql = "SELECT * FROM `offers`";

        $row = $db->Query($sql);
        echo "<div class='grid gap-6 md:grid-cols-2 lg:grid-cols-3'>";

        foreach($row as $r){
            
            // $id = $r['id'];
            // $code = $_GET['b'];
            // echo "<tr>";
            // echo "<td>". $r['id'] . "</td>";
            // echo "<td>". $r['title']. "</td>";
            // echo "<td>". $r['owner'] . "</td>";
            // echo "<td>". $r['data_created'] . "</td>";
            // echo "<td> <a href='dashboard?b=$code&action=postview&pid=$id' class='btn btn-primary'>View</a><a href='dashboard?b=$code&action=postupdate&pid=$id' class='btn btn-secondary w3-margin-left'>Update</a><a href='dashboard?b=$code&action=posts&del=$id' class='btn btn-danger w3-margin-left'>Delete</a> </td>";
                $title =  $r['name'];
                $tcontent =$r['content'];
                $rcontent = strip_tags($tcontent);
                $content = substr($rcontent,0,50) . "...";
             include("containers/offer/offer-public-card.php");
        
        }
        echo "</div>";
                                    
?>              
