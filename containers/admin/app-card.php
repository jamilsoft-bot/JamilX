<div class="mt-4 rounded-lg border border-blue-500 border-l-4 p-4">
                    <div class="flex flex-col gap-4 md:flex-row md:items-center">
                        <div class="shrink-0">
                            <img class="h-32 w-32 rounded-xl object-cover" src="<?php
                        if($logo == null){
                            echo "assets/images/lg.png";
                        }else{
                            echo "Apps/$appdir/$logo";
                        }
                        //echo $logo;
                        
                        ?>" alt="<?php echo $appname ;?>">
                        </div>
                        <div class="flex-1">
                          <div class="grid gap-4 md:grid-cols-[1fr_auto] md:items-start">
                              <div>
                                  <h3 class="text-xl font-semibold text-gray-900"><?php echo $appname ;?></h3>
                                  <p class="text-gray-600"><?php echo $info->Summary ;?></p>
                                  <div class="mt-2 flex flex-wrap items-center gap-3 text-sm text-gray-600">
                                      <span class="inline-flex items-center gap-1"> <i class="fa fa-user"></i> <?php echo $author ;?></span>
                                      <span class="inline-flex items-center gap-1"> <i class="fa fa-globe"></i> <?php echo $website;?></span>
                                      <span class="inline-flex items-center gap-1"> <i class="fa fa-arrow-alt-circle-right"></i> <?php echo $version;?></span>
                                  </div>
                              </div>
                              <div class="flex md:justify-end">
                                  <div class="flex items-center text-xl">
                                     <div class="flex items-center gap-2 rounded-full bg-gray-100 px-2 py-1">
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
