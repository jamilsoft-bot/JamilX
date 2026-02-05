<div class="w3-margin-top w3-blue-grey w3-container w3-bar">
                <span class="w3-bar-item w3-large"><?php echo $this->getText();?></span>
                <div class="w3-right w3-light-gray">
                    <button name="create" type="submit" class="w3-button w3-bar-item " ><i class="fas fa-plus w3-margin-right"></i>
                    <?php
                             if(isset($update)){
                                
                                echo "Update";
                            }else{
                                echo "Create";
                            }
                    ?>
                </button>
                    <!-- <a class="w3-button w3-bar-item " onclick="swal.fire('Blog Alert','The blog was Saved to Draft','info')"><i class="fas fa-check w3-margin-right"></i>Save</a> -->
                    <a href="jamilpress" class="w3-button w3-bar-item " ><i class="fas fa-times w3-margin-right"></i>Discard</a>
                
                </div>
            </div>
           <div class="w3-container w3-margin-top">
                    <h3>Blog Name</h3>
                    <input type="text" name="title" placeholder="Name how your Blog Should be called" value="<?php
                        if(isset($update)){
                            global $BLOG_NAME;
                            echo $BLOG_NAME;
                        }
                    ?>" class="w3-input w3-border w3-border-blue w3-leftbar" required>
                    <label class="w3-text-red" id="nameerror"><?php echo $this->nameError;?></label>
           </div>
           <div class="w3-container w3-margin-top">
                    <h3>Blog Url</h3>
                    <input type="text" name="url" value="<?php
                     if(isset($update)){
                        global $BLOG_URL;
                        echo $BLOG_URL;
                    }
                    ?>" placeholder="Choose your Blog address (in small caps)" class="w3-input w3-border w3-border-blue w3-leftbar" required>
                    <label class="w3-text-red" id="urlerror"><?php echo $this->urlError;?></label>
            </div>
           <div class="w3-container w3-margin-top">
                    <h3>Blog Summary</h3>
                    <span>max-length = 200 - <i class="w3-text-green">Recommended = 150</i></span>
                    <textarea name="summary" maxlength="200" cols="30" rows="5" class="w3-input w3-border w3-border-blue w3-leftbar">
                    <?php
                    if(isset($update)){
                        global $BLOG_SUM;
                        echo $BLOG_SUM;
                    }else{
                        echo "Summarize what your Blog is all about";
                    }
                    ?>
                    </textarea>
                    <label class="w3-text-red" id="summaryerror"><?php echo $this->summaryError;?></label>
            </div>
            <div class="w3-container w3-margin-top">
                <h3>Blog Logo</h3>
                <input type="file" name="logo" class="w3-input w3-border w3-border-blue w3-leftbar" required>
                <label class="w3-text-red" id="logoerror"><?php echo $this->logoError;?></label>
            </div>
            <div class="w3-container w3-margin-top">
                <h3>Blog Category</h3>
                <select name="cat" class="w3-input w3-border w3-border-blue w3-leftbar" required>
                <?php

                        global $JX_db, $BLOG_CAT;
                        $sql = "SELECT *FROM `categories`";
                        $result =$JX_db->query($sql);

                        foreach($result as $r){
                            $name = $r['name'];
                        
                            if($name == $BLOG_CAT){
                                echo "<option value='$name' selected>$name</option>";
                            }else{
                                echo "<option value='$name'>$name</option>";
                            }
                        
                        }


                        ?>
                </select>
                <label class="w3-text-red" id="caterror"><?php echo $this->catError;?></label>
            </div>
            <div class="w3-container w3-margin-top">
                <h3>Blog Details</h3>
                <textarea name="content" id="ct" cols="30" rows="5" class="w3-input w3-border w3-border-blue w3-leftbar">
                    <?php global $BLOG_DESC; 
                     if(isset($update)){
                        
                        echo $BLOG_DESC;
                    }else{
                        echo "Tell in full detail what your Blog is all about";
                    }
                    ?>
                </textarea>
                <label class="w3-text-red" id="contenterror"><?php echo $this->contentError;?></label>
        </div>
        
        <div class="w3-container w3-margin-top">
            <h3>Blog Keywords</h3>
            <input type="text" id="keywords" name="keywords" placeholder="Add keywords with comma saperated" value="<?php
                if(isset($update)){
                   global  $BLOG_KEWORDS;
                    echo $BLOG_KEWORDS;
                }
            ?>" class="w3-input w3-border w3-border-blue w3-leftbar" required>
        </div>
        <div class="w3-container w3-margin-top">
            <div class="w3-bar">
                
                    <button type="submit" name="create"  class="w3-button w3-bar-item w3-blue"><i class="fas fa-plus w3-margin-right"></i>
                    <?php
                             if(isset($update)){
                                
                                 echo "Update";
                             }else{
                                 echo "Create";
                             }
                    ?>
                    </button>
                    <!-- <a class="w3-button w3-bar-item w3-green" onclick="swal.fire('Blog Alert','The blog was Saved to Draft','info')"><i class="fas fa-check w3-margin-right"></i>Save</a> -->
                    <a href="jamilpress" class="w3-button w3-bar-item w3-red"><i class="fas fa-times w3-margin-right"></i>Discard</a>
                
            </div>
        </div>
