<header class="w3-container w3-blue ">
                    <h3> <?php echo $this->getTitle(); ?></h3>
</header>
    <div class="w3-container content">
<?php
global $Url, $db;
$title = null;
$id = $Url->get('cid');
$blog = null;
$body = null;
$keywords = null;

$sql = "SELECT *FROM `categories` WHERE `id`='$id'";

$result = $db->Query($sql);

foreach($result as $r){
    $title = $r['name'];
    $keywords = $r['keywords'];
    $blog = $r['parent'];
    $body = $r['description'];
}


?>
                <div class="w3-bar w3-border  w3-margin-top w3-light-grey">
                    <a href="#" class="w3-bar-item  w3-border-right w3-mobile w3-button">Create</a>
                    <a href="#" class="w3-bar-item  w3-border-right w3-mobile w3-button">List</a>
                    <!-- <a href="#" class="w3-bar-item w3-btn">Create</a> -->
                </div>
           <form action="" method="post" enctype="multipart/form-data">
                <div class="container">
                    <label class="w3-text-blue w3-margin-top">Category Name</label>
                    <input type="text" value="<?php echo $title;?>" name="title" placeholder="Type the name of the Category" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                    
                    <label class="w3-text-blue w3-margin-top">Parent</label>
                    <!-- <input type="text" name="title" placeholder="post Title" class="w3-border w3-bottombar w3-border-blue w3-input" required> -->
                    <select name="parent"  class="w3-border w3-bottombar w3-border-blue w3-input">
                        <option value="uncategorized">Uncategorized</option>
                        <?php

                        global $db;
                        $sql = "SELECT *FROM `categories`";
                        $result =$db->Query($sql);

                        foreach($result as $r){
                            $name = $r['name'];
                            $blogcode = $r['id'];
                            if($blogcode == $blog){
                                echo "<option value='$blogcode' selected>$name</option>";
                            }else{
                                echo "<option value='$blogcode'>$name</option>";
                            }
                           
                        }
                        

                        ?>
                    </select>
                   
                    <label class="w3-text-blue w3-margin-top">Featured Image</label>
                    <input type="file" name="image" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                    <label class="w3-text-blue w3-margin-top">Category description </label>
                    <div class="w3-border w3-leftbar w3-border-blue w3-input">
                        <textarea name='content' id='pid' cols="60" rows="15" class="w3-input ">
                        <?php echo $body;?>
                        </textarea>
                    </div>
                    
                    <label class="w3-text-blue w3-margin-top">Keywords</label>
                    <input type="text" value="<?php echo $keywords;?>" name="keywords" placeholder="keywords" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                    

                    <input type="submit" name="update" class="w3-input w3-margin-top w3-blue" value="update">
                </div>
           </form>
                
         </div>






