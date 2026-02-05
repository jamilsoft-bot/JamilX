<?php
$action = isset($_GET['action'])?$_GET['action']:null;
$draftlink = "?action=$action&filter=draft";
$publink = "?action=$action&filter=published";
$trashlink = "?action=$action&filter=trash";
$newlink = null;


?>
<div class="w3-container w3-margin-top">
    <?php 
    
    // $ds = $_SERVER['QUERY_STRING'];
    
    // $rr =str_getcsv($ds,"&");
    // unset($rr[0]);
    // echo "?" .implode("&",$rr) . "&del=23";
    ?>
                <div class="w3-bar <?php
                    if($action == "comments" || $action == "catlist" ){
                        echo "w3-hide";
                    }
                ?>">
                    <div class="w3-card w3-blue">
                        <a href="#" class="w3-button w3-light-grey w3-bar-item  w3-border w3-border-blue"><i class="fas fa-plus-circle w3-margin-right"></i>Filter</a>
                        <a href="<?php echo $publink;?>" class="w3-button w3-bar-item <?php JP_check_nav("w3-white","published","filter"); ?> w3-border w3-border-blue"><i class="fas fa-globe w3-margin-right"></i>Published</a>
                        <a href="<?php echo $draftlink;?>" class="w3-button w3-bar-item <?php JP_check_nav("w3-white","draft","filter"); ?> w3-border w3-border-blue"><i class="fas fa-drafting-compass w3-margin-right"></i>Drafts</a>
                        <a href="<?php echo $trashlink;?>" class="w3-button w3-bar-item <?php JP_check_nav("w3-white","trash","filter"); ?> w3-border w3-border-blue"><i class="fas fa-recycle w3-margin-right"></i>Trashes</a>

                    
                    </div>
                    <!-- <div class="w3-right">
                        <a class="w3-button w3-bar-item w3-blue"><i class="fas fa-plus w3-margin-right"></i>Create</a>
                        <a class="w3-button w3-bar-item w3-green"><i class="fas fa-check w3-margin-right"></i>Save</a>
                        <a class="w3-button w3-bar-item w3-red"><i class="fas fa-times w3-margin-right"></i>Discard</a>
                        <a class="w3-button w3-bar-item"><i class="fas fa-cog w3-margin-right"></i></a>
                    </div> -->
                </div>
            </div>