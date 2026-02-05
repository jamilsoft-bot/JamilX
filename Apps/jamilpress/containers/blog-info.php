<div class="w3-margin-top w3-blue-grey w3-container w3-bar">
                <span class="w3-bar-item w3-large">Blog Information</span>
                <div class="w3-right">
                    <a href="?action=updateblog" class="w3-bar-item  w3-button w3-green">Update</a>
                    <span class="w3-bar-item  w3-button w3-red">Delete</span>

                </div>
            </div>
            <div class="w3-container">
                <div class="row w3-margin-top">
                    <div class="col-md-6">
                        <img src="<?php
                        global $BLOG_LOGO;
                        if($BLOG_LOGO == null){
                            echo "Apps/jamilpress/assets/images/jamilpress.png";
                        }else{
                            echo "data/$BLOG_LOGO";
                        }
                    
                        
                        ?>" style="width:100%;height:300pt">
                    </div>
                    <div class="col-md-6">
                        <div class="w3-table-responsive w3-margin-top">
                            <table class="w3-table w3-striped w3-hoverable">
                                <tr class="w3-blue">
                                    <th>Data</th>
                                    <th>Values</th>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td><?php global $BLOG_NAME; echo $BLOG_NAME;?></td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td><?php global $BLOG_SUM; echo $BLOG_SUM;?></td>
                                </tr>
                                <tr>
                                    <td>Author</td>
                                    <td><?php global $BLOG_AUTHOR; echo $BLOG_AUTHOR;?></td>
                                </tr>
                                <tr>
                                    <td>Active Theme</td>
                                    <td><?php global $BLOG_THEME; echo $BLOG_THEME;?></td>
                                </tr>
                                <tr>
                                    <td>Date Created</td>
                                    <td>
                                    <?php 
                                    
                                    global $BLOG_DATE;

                                    $dt = $BLOG_DATE['created'];
                                    echo get_default_date($dt);
                                    
                                    
                                    ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="w3-container">
                        <p>
                        <?php global $BLOG_DESC; echo $BLOG_DESC;?>
                        </p>
                    </div>
                </div>
            </div>
