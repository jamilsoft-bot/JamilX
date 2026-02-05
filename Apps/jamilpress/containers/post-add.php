<div class="w3-margin-top w3-light-grey w3-container w3-bar">
                <span class="w3-bar-item w3-large"><?php echo $this->getTitle();?></span>
                <div class="w3-right">
                    <button type="submit" name="create" class="w3-button w3-bar-item  w3-green"><i class="fas fa-check w3-margin-right"></i></button>
                    <a href="jamilpress" class="w3-button w3-bar-item w3-red"><i class="fas fa-times w3-margin-right"></i></a>
                    <!-- <a class="w3-button w3-bar-item w3-red"><i class="fas fa-times w3-margin-right"></i></a> -->
                    <a class="w3-button w3-bar-item w3-white" onclick="w3.toggleShow('#ppanel')"><i class="fas fa-cog w3-margin-right"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                        <div class="w3-container w3-margin-top">
                            <h3>Title</h3>
                            <input type="text"  name="title" placeholder="Type the title of the post here" class="w3-input w3-border w3-border-blue w3-leftbar" value="<?php
                            if(isset($data)){
                                echo $data->getName();
                            }
                            ?>" required>
                        </div>
                        <div class="w3-container w3-margin-top">
                            <h3>Summary</h3>
                            <input type="text" name="summary" placeholder="Type the summary of the post here" class="w3-input w3-border w3-border-blue w3-leftbar" value="<?php 
                                    if(isset($data)){
                                        echo $data->getSummary();
                                    }
                            
                            ?>" required>
                        </div>
                        <div class="w3-container w3-margin-top">
                            <h3>Content</h3>
                            <textarea name="content" id="ct" class="w3-input w3-border w3-border-blue w3-leftbar" cols="30" rows="10">
                            <?php
                                if(isset($data)){
                                    echo $data->getContent();
                                }else{
                                    echo "Tell in full detail what your Post is all about";
                                }
                            ?>
                            
                            </textarea>
                            <label class="w3-text-red" id="contenterror"><?php echo $this->contentError;?></label>
                        </div>
                </div>
                <div class="col-md-3" id="ppanel" style="display: none;">
                    <?php include "settingbar.php";?>
                </div>
            </div>
            <div class="w3-container w3-margin-top">
                <div class="w3-bar">
                    
                        <button name="create" type="submit" class="w3-button w3-bar-item w3-blue"><i class="fas fa-plus w3-margin-right"></i>Create</button>
                        <!-- <a class="w3-button w3-bar-item w3-green"><i class="fas fa-check w3-margin-right"></i>Save</a> -->
                        <a href="jamilpress" class="w3-button w3-bar-item w3-red"><i class="fas fa-times w3-margin-right"></i>Discard</a>
                    
                </div>
            </div>