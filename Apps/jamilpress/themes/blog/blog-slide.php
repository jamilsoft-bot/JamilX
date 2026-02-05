<?php

//$offerimage = null;

?>
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
  <?php 
    $sql = "SELECT *FROM `offers` WHERE `blog` = '$jsarg' LIMIT 1";
    $offerrecord = $JX_db->query($sql);
    $row = $offerrecord->fetch_array(MYSQLI_ASSOC);
        $active = "active";
        $offerimage = $row['image'];
        $offername1 = $row['name'];
        $offerbtn = $row['btnText'];
        $offervalue = $row['type'] .  $row['link'];
        
        $offersummary = substr(strip_tags($row['content']),0,200);
        echo "<div class='carousel-item active'>";
        echo "<img src='data/$offerimage' class='d-block  w-100' style='height: 300pt;' alt='Featured Image'>";
        echo "<div class='carousel-caption d-none d-md-block js-transbox'>";
        echo "<h2>$offername1</h2>";
        echo"<p>$offersummary</p>";
        echo"</div></div>";
    
?>
    <?php 
    $sql = "SELECT *FROM `offers` WHERE `blog` = '$jsarg'";
    $offerrecord = $JX_db->query($sql);
    foreach($offerrecord as $offer){
        $active = null;
        if($offer['name'] == $offername1){}else{
        $offerimage = $offer['image'];
        $offername = $offer['name'];
        $offerbtn = $offer['btnText'];
        $offervalue = $offer['link'];
        
        $offersummary = substr(strip_tags($offer['content']),0,200);
      include "blog-slide-card.php";
        }
        
    }
?>

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>