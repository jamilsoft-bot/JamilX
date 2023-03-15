<?php global $db;?>
<div class=" w3-white">
  <header class="w3-container w3-blue">
    <h3>Business List</h3>
  </header>
  <div class="w3-container">
  <?php

                        $sql = "SELECT *FROM `products`";
                        $result = $db->Query($sql);

                        foreach($result as $r){
                            
                            $name = $r['name'];
                            
                            $price = "N".$r['price'] . " - N" . $r['sale'];
                            $des = substr(strip_tags($r['content']),0,100);
                            $logo = $r['pic'];
                            $date_d = new DateTime($r['date']);
                            $date = $date_d->format("D d,M Y");
                            echo "<ul class='w3-ul'>";
                            include "product-card.php";
                            echo "</ul>";
                        }

                    ?>
  </div>
</div>
                  
                  
              
              