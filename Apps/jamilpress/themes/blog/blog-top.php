<?php

$busname = null;
$buslogo = null;
$busfb = null;
$bustw = null;
$busins = null;
$busyout = null;
$buscode = $blogowner;

$sql = "SELECT *FROM `business` WHERE `code` ='$blogowner'";

$result = $JX_db->query($sql);
foreach($result as $r){
        $buslogo = $r['logo'];
        $json = json_decode($r['data']);
        $busname = $json->name;
        $busfb = $json->facebook;
        $busins = $json->instagram;
        $busyout = $json->youtube;
        $bustw = $json->twitter;
}

?>
<header class="w3-bar w3-blue">
<a href="#" class="w3-bar-item ">
        <img src="data/<?php echo $blog->getImage();?>" style="width: 25px; height:25px">
</a>
<li href="#" class="w3-bar-item  ">
        <?php echo $blog->getName();?>
</li>


        <div class="w3-right">
                   <a href="<?php echo $busfb;?>" class="w3-bar-item w3-btn w3-hover-green"><i class="fab fa-facebook-f w3-large"></i></a>
                    <a href="<?php echo $bustw;?>" class="w3-bar-item w3-btn w3-hover-green"><i class="fab fa-twitter w3-large"></i></a>
                    <a href="<?php echo $busins;?>" class="w3-bar-item w3-btn w3-hover-green"><i class="fab fa-instagram w3-large"></i></a>
                    <a href="<?php echo $busyout;?>" class="w3-bar-item  w3-btn w3-hover-green"><i class="fab fa-youtube w3-large"></i></a>
                
        </div>            
                    
</header>