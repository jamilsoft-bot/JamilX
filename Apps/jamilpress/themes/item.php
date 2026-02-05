<div class="row w3-margin">
        <div class="col-md-2">
            <img  src="<?php
                        if($image == null){
                            echo "../Apps/jamilpress/assets/images/blogpost.png";
                        }else{
                            echo "../data/$image";
                        }
                        //echo $logo;
                        
                        ?>" style="width: 200pt;height: 150pt;">
        </div>
        <div class="col-md-8" style="margin-left: 35pt;">
            <h2><?php echo $title;?></h2>
            <h4><?php echo substr(strip_tags($summary),0,250);?>...</h4>
            <a href="<?php global $BLOG_URL; echo $link; ?>?view=post&id=<?php echo $id;?>" class="w3-button w3-blue">Read More</a>
            <p class="text-muted">Created on <?php echo $date;?></p>
        </div>
    </div>

    