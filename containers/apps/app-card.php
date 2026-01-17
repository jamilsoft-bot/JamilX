<li class="w3-bar w3-hover-light-blue w3-border w3-border-blue w3-card w3-padding w3-margin-top w3-margin-bottom">
            <span class="w3-bar-item  w3-xlarge w3-right">
                <span class="w3-bar">
                <?php include "app-card-btns.php";?>

                </span>
        </span>
            <img src="<?php
                        if($logo == null){
                            echo "assets/images/lg.png";
                        }else{
                            echo "Apps/$appdir/$logo";
                        }
                        //echo $logo;
                        
                        ?>" class="w3-bar-item w3-round" style="width:85px">
                        
            <div class="w3-bar-item">
              <span class="w3-large"><?php echo $appname ;?></span><br>
              <span class="w3-small"><?php echo $info->Summary ;?></span><br>
              <span><?php echo implode(",",$tags);;?></span>
            </div>
 </li>