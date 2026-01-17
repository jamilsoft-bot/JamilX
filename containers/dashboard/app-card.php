<div class="col-md-1">
    <a href="<?php echo strtolower($appname); ?>" data-toggle="tooltip" title="<?php echo $tooltip;?>"  target="_blank" class="w3-button w3-hover-light-grey">
    <img src="<?php
                        if($logo == null){
                            echo "assets/images/jslogobird.png";
                        }else{
                            echo "Apps/$appname/$logo";
                        }
                        //echo $logo;
                        
                        ?>" style="width: 50px;height: 50px;">
    <br><span><?php echo $appname;?></span>
    </a>
</div>

