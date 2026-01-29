<style>
.flip-card {
  background-color: transparent;
  width: 100%;
  padding: 0pt;
  height: 300px;
  perspective: 500px;
  
}

.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.6s;
  transform-style: preserve-3d;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}

.flip-card:hover .flip-card-inner {
  transform: rotateY(180deg);
}

.flip-card-front, .flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
}

.flip-card-front {
  background-color: #bbb;
  color: black;
  z-index: 2;
}

.flip-card-back {
  background-color: #2980b9;
  color: white;
  transform: rotateY(180deg);
  z-index: 1;
}
</style>
<header class="w3-container w3-blue">
    <h2>Gallary</h2>
</header>
<div class="row w3-margin-top">
    <?php
    global $JX_db;
    $own = intval($_SESSION['uid']);
    $sql = "SELECT *FROM  `media` WHERE `owner`= $own";

    $result = $JX_db->query($sql);

    foreach($result as $r){
        $image = $r['name'];
        $intsize = intval($r['size']);
        $text = $r['summary'];
        $name = $image;
        $size = $intsize / 1000;
        $date = get_default_date($r['date']);
        include "image-card.php";
    } 
    ?>
    
</div>