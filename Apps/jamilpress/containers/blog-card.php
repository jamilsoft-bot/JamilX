<div class="col-md-3 w3-margin-top">
    <div class="w3-border w3-border-blue w3-leftbar w3-padding">
        <div class="d-flex  justify-content-center">
            <img src="<?php
                        if($image == null){
                            echo "Apps/jamilpress/assets/images/jamilpress.png";
                        }else{
                            echo "data/$image";
                        }
                    
                        
                        ?>" style="width: 80px;height:80px" class="w3-circle ">
        </div>
        <div class="w3-bar w3-center">
            <strong><?php echo $name;?></strong><br>
            <small><?php echo $summary;?></small><br>
            <a href="?blog=<?php echo $url;?>" class="w3-button w3-block w3-blue">Choose</a>
        </div>
    </div>
</div> 