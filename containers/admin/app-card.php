<div class="w3-container w3-border w3-leftbar w3-border-blue w3-margin-top w3-padding">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img class="w3-round-xlarge" src="<?php
                        if($logo == null){
                            echo "assets/images/lg.png";
                        }else{
                            echo "Apps/$appdir/$logo";
                        }
                        //echo $logo;
                        
                        ?>" style="width: 100pt;" alt="...">
                        </div>
                        <div class="flex-grow-1 ms-3">
                          <div class="row">
                              <div class="col-md-8">
                                  <h3><?php echo $appname ;?></h3>
                                  <p><?php echo $info->Summary ;?></p>
                                  <div class="w3-bar ">
                                      <span class="w3-bar-item"> <i class="fa fa-user"></i> <?php echo $author ;?></span>
                                      <span class="w3-bar-item"> <i class="fa fa-globe"></i> <?php echo $website;?></span>
                                      <span class="w3-bar-item"> <i class="fa fa-arrow-alt-circle-right"></i> <?php echo $version;?></span>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="w3-bar w3-xlarge">
                                     <div class="w3-right w3-light-gray w3-round-xxlarge">
                                     <?php include "app-card-btns.php";?>
                                        <!-- <a href="#" class="w3-bar-item w3-button w3-text-red"><i class="fa fa-check-double"></i> </a>
                                        <a href="#" class="w3-bar-item w3-button"><i class="fa fa-plus-circle"></i> </a>
                                        <a href="#" class="w3-bar-item w3-button"><i class="fa fa-trash"></i> </a>   -->
                                     </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>
                </div>