<?php
include "header.php";
global $JX_db,$Url, $Me;

$blogname = null;
$blogdes = null;
$bloglogo = null;
$blogauthor = null;
$blogowner = null;
$jsarg = $Url->get('name');
$action = $Url->get('action');

$slq = "SELECT *FROM `blogs` WHERE `url`='$jsarg'";

$result = $JX_db->query($slq);

foreach($result as $r){
  $blogname = $r['name'];
  $blogdes = substr(strip_tags($r['description']),0,150). "...";
  $bloglogo =  $r['logo'];
  $blogowner = $r['owner'];
  $blogauthor = $r['author'];
}

addHit($blogowner,$jsarg);
?>
<style>
a{
    text-decoration: none;
}
.js-transbox{
  color:black;
  background-color: #ffffff;
  opacity: 0.6;
  filter: alpha(opacity=60);
}
.right {
  float: right;
  width: 2.5%;
}
.left {
  float: left;
  width: 2.5%;
}
.center{
  float: left;
  width: 95%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>

<div class="row">
    <div class="left"></div>
    <div class="center ">
        <div class="w3-card">
               <?php include "blog-top.php";?>
                <div class="w3-container">
                    <?php include "blog-nav.php";?>
                </div>
                <div class="w3-container">
                  
                    <div class="row">
                        <div class="col-md-9">
                            <?php

                              if(is_null($action)){
                              
                               // $this->home($blogowner);

                              }else{
                              
                            //  $this->$action($blogowner);
                              }


                              ?>
                        </div>
                        <div class="col-md-3">
                            <?php include "blog-sidebar.php";?>
                        </div>
                    </div>
                      
                </div>
                
                <?php include "blog-footer.php";?>
        </div>
    </div>
    <div class="right "></div>
</div>
<?php include "footer.php";