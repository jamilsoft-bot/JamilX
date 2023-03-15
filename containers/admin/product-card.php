<li class="w3-bar w3-card w3-padding w3-margin-top w3-margin-bottom">
            <span class="w3-bar-item  w3-xlarge w3-right">
           <a href="?serve=users&action=update&id=137"> <i class="fa fa-edit w3-button"></i></a>
           <a href="?serve=users&action=read&id=137">  <i class="fa fa-eye w3-button"></i></a>
           <a href="?serve=users&action=delete&id=137"> <i class="fa fa-archive w3-button"></i></a>
        </span>
            <img src="<?php
                        if($logo == null){
                            echo "assets/images/user.png";
                        }else{
                            echo "data/$logo";
                        }
                        //echo $logo;
                        
                        ?>" class="w3-bar-item " style="width:85px">
                        
            <div class="w3-bar-item">
              <span class="w3-large"><?php echo $name ;?></span><br>
              <span class="w3-small"><?php echo $des ;?></span><br>
              <span class="w3-tag w3-red"><?php echo $price;?></span>
            </div>
 </li>
 