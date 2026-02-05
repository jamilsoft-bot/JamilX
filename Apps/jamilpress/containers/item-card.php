<li class="w3-bar w3-hover-light-blue w3-border w3-border-blue w3-card w3-padding w3-margin-top w3-margin-bottom">
            <span class="w3-bar-item  w3-xlarge w3-right">
                <span class="w3-bar">
                    <?php 
                        if(isset($customBtn)){
                            foreach($customBtn as $btn){
                                echo $btn;
                            }
                        }else{
                            $taction = isset($_GET['action'])?$_GET['action']:null;
                            $dellink = "?action=$taction&del=$id";
                         echo   "<a href='?action=comments&postid=$id' class='w3-bar-item w3-button '>  <i class='fa fa-comments '></i>$comment</a>";
                          echo  "<a href='$dellink' class='w3-bar-item w3-button '>  <i class='fa fa-trash '></i></a>";
                    
                        }

                        echo  "<a href='?action=$updatelink&id=$id' class='w3-bar-item w3-button '> <i class='fa fa-edit '></i></a>";
                    
                    ?>
                    
        </span>
        </span>
            <img src="<?php
                        if($image == null){
                            echo "Apps/jamilpress/assets/images/jamilpress.png";
                        }else{
                            echo "data/$image";
                        }
                        //echo $logo;
                        
                        ?>" class="w3-bar-item w3-round" style="width:85px">
                        
            <div class="w3-bar-item">
              <span class="w3-large" style="font-weight: bold;"><?php echo $name;?></span><br>
              <span><?php echo ucfirst($summary);?> ......</span><br>
              <span class="w3-small"><i> <?php echo $date;?> - <?php echo $author;?></i></span>
            </div>
        </li>