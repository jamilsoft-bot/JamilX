<li class="flex flex-wrap items-center justify-between gap-4 rounded-lg border border-blue-500 p-4 shadow-sm transition hover:bg-blue-50">
            <div class="flex items-center gap-4">
            <img src="<?php
                        if($logo == null){
                            echo "assets/images/lg.png";
                        }else{
                            echo "Apps/$appdir/$logo";
                        }
                        //echo $logo;
                        
                        ?>" class="h-20 w-20 rounded object-cover" alt="<?php echo $appname ;?>">
                        
            <div>
              <span class="block text-lg font-semibold text-gray-900"><?php echo $appname ;?></span>
              <span class="block text-sm text-gray-600"><?php echo $info->Summary ;?></span>
              <span class="block text-sm text-gray-700"><?php echo implode(",",$tags);;?></span>
            </div>
            </div>
            <div class="flex items-center gap-2 text-xl">
                <?php include "app-card-btns.php";?>
            </div>
 </li>
