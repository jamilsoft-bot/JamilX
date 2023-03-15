<?php
         addHit("visitor",'products');                         
        global $db;
        //$code = $_GET['b'];
        $sql = "SELECT * FROM `products`";

        $row = $db->Query($sql);
        echo "<div class='row'>";
        foreach($row as $r){
            
              
                $name =  $r['name'];
                $image = $r['pic'];
                $id = $r['id'];
                $price =$r['price'];
                $sale = $r['sale'];
                $tc = $r['content'];
                $rcontent = strip_tags($tc);
                $content = substr($rcontent,0,50);
                echo "<div class='col-md-6'>";
             include("containers/product/product-card.php");
             echo "</div>";
        
        }
             echo "</div>";                       
?>