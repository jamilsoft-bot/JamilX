<?php global $db;?>
<div class=" w3-white">
  <header class="w3-container w3-blue">
    <h3>Blog List</h3>
  </header>
  <div class="w3-container">
  <?php

$sql = "SELECT *FROM `brands`";
$result = $db->Query($sql);

foreach($result as $r){
    
    $name = $r['name'];
    $author = $r['author'];
    $type = $r['type'];
    $des = substr($r['description'],0,80);
    $bus = $r['owner'];
    
    $logo = $r['logo'];
   // $country = $r['country'];
    $date_d = new DateTime($r['date_reg']);
    $date = $date_d->format("D d,M Y");
    echo "<ul class='w3-ul'>";
    include "blog-card.php";
    echo "</ul>";
}

?>
  </div>
</div>
                  
                  
              
              