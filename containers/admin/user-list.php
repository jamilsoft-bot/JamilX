<?php global $db;?>
<div class=" w3-white">
  <header class="w3-container w3-blue">
    <h3>User List</h3>
  </header>
  <div class="w3-container">
  <?php

$sql = "SELECT *FROM `users`";
$result = $db->Query($sql);

foreach($result as $r){
    $id = $r['id'];
    $name = $r['name'];
    $username = $r['username'];
    $type = $r['role'];
    $des = $r['bio'];
    $city = $r['city'];
    $logo = $r['avatar'];
    $country = $r['country'];
    $date_d = new DateTime($r['date_reg']);
    $date = $date_d->format("D d,M Y");
    echo "<ul class='w3-ul'>";
    include "user-card.php";
    echo "</ul>";
}

?>
  </div>
</div>
                  
                  
              
              