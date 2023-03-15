<?php global $db;?>
<div class=" w3-white">
  <header class="w3-container w3-blue">
    <h3>Post List</h3>
  </header>
  <div class="w3-container">
  <?php
   $sql = "SELECT *FROM `posts`";
   $result = $db->Query($sql);

   foreach($result as $r){
       
       $name = $r['title'];
      // $username = $r['username'];
      // $type = $r['role'];

       $des1 = $r['content'];
       $des = substr($des1,0,150) . "...";

      // $city = $r['city'];
       $logo = $r['image'];
      // $country = $r['country'];
       $date_d = new DateTime($r['date_created']);
       $date = $date_d->format("D d,M Y");
       echo "<ul class='w3-ul'>";
       include "post-card.php";
       echo "</ul>";
   }

?>
  </div>
</div>
                  
                  
              
              