
            <div class="w3-bar w3-margin-top w3-container w3-blue">
                <strong class="w3-bar-item">Properties</strong>
            </div>
            <div class="w3-container">
                <div class="w3-container w3-margin-top">
                        <label class="w3-text-blue">Post Visibility</label>
                        <select name="pri" class="w3-input">
                        <?php

                                $result = ['private','public'];
                                $pri = null;
                                if(isset($data)){
                                $stats = $data->getPrivacy();
                                }

                                foreach ($result as $r) {
                                $name = $r;

                                if($name == $stats){
                                    echo "<option value='$name' selected>$name</option>";
                                }else{
                                    echo "<option value='$name'>$name</option>";
                                }
                                }


                                ?>

                            <!-- <option>Public</option>
                            <option>Private</option> -->
                        </select>
                </div>
                <div class="w3-container w3-margin-top">
                        <label class="w3-text-blue">Post Status</label>
                        <select name="status" class="w3-input">
                            <?php

                                $result = ['draft','published','trash'];
                                $stats = null;
                            if(isset($data)){
                                $stats = $data->getStatus();
                            }
                            
                            foreach ($result as $r) {
                                $name = $r;

                                if($name == $stats){
                                    echo "<option value='$name' selected>$name</option>";
                                }else{
                                    echo "<option value='$name'>$name</option>";
                                }
                            }

                            
                            ?>
                            <!-- <option>Draft</option>
                            <option>Published</option>
                            <option>Trash</option> -->
                        </select>
                </div>

                <div class="w3-container w3-margin-top">
                        <label class="w3-text-blue">Category</label>
                        <select name="cat" class="w3-input">
                        <?php

                                global $JX_db;
                                $sql = "SELECT *FROM `categories`";
                                $result =$JX_db->query($sql);
                                $cat =null;
                                if(isset($data)){
                                    $cat = $data->getCat();
                                }
                                
                                foreach($result as $r){
                                    $name = $r['name'];

                                    if($name == $cat){
                                        echo "<option value='$name' selected>$name</option>";
                                    }else{
                                        echo "<option value='$name'>$name</option>";
                                    }

                                }


                                ?>
                        </select>
                </div>
                <div class="w3-container w3-margin-top">
                        <label class="w3-text-blue">Featured Image</label>
                        <div class="d-flex p-3 justify-content-center flex-column">
                            <img src="
                            <?php
                            $image = null;
                            if(isset($data)){
                                $image = $data->getImage();
                            }
                        if($image == null){
                            echo "Apps/jamilpress/assets/images/jamilpress.png";
                        }else{
                            echo "data/$image";
                        }
                        
                        
                        ?>" class="p-2" style="width: 100px;height: 100px;">
                            <input type="file" class="p-2" name="image">
                        </div>
                </div>
               <div class="w3-container w3-margin-top">
                    <label class="w3-text-blue">Tags</label>
                    <input type="text" name="tags" placeholder="keywords saperated with comma" value="<?php
                    
                    if(isset($data)){
                        echo $data->getKeywords();
                    }
                    
                    ?>">
                    
               </div>
            </div>
        