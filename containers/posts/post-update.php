<header class="w3-container w3-blue ">
                    <h3> Post Update</h3>
</header>
    <div class="w3-container content">
<?php
global $Url, $db;
$title = null;
$id = $Url->get('pid');
$blog = null;
$body = null;
$keywords = null;

$sql = "SELECT *FROM `posts` WHERE `id`='$id'";

$result = $db->Query($sql);

foreach($result as $r){
    $title = $r['title'];
    $keywords = $r['keywords'];
    $blog = $r['blog'];
    $body = $r['content'];
    $cat = $r['cat'];
}


?>
                <div class="w3-bar w3-border  w3-margin-top w3-light-grey">
                    <a href="#" class="w3-bar-item  w3-border-right w3-mobile w3-button">Create</a>
                    <a href="#" class="w3-bar-item  w3-border-right w3-mobile w3-button">List</a>
                    <!-- <a href="#" class="w3-bar-item w3-btn">Create</a> -->
                </div>
           <form action="" method="post" enctype="multipart/form-data">
                <div class="container">
                    <label class="w3-text-blue w3-margin-top">Post Title</label>
                    <input type="text" value="<?php echo $title;?>" name="title" placeholder="post Title" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                    <div class="row">
                        <div class="col-md-6">
                        <label class="w3-text-blue w3-margin-top">Category</label>
                    <select name="cat"  class="w3-border w3-bottombar w3-border-blue w3-input">
                        <option value="uncategorized">Uncategorized</option>
                        <?php

                        global $db;
                        $sql = "SELECT *FROM `categories`";
                        $result =$db->Query($sql);

                        foreach($result as $r){
                            $name = $r['name'];
                            $blogcode = $r['code'];
                            if($name == $cat){
                                echo "<option value='$name' selected>$name</option>";
                            }else{
                                echo "<option value='$name'>$name</option>";
                            }
                           
                        }
                        

                        ?>
                    </select>
                        </div>
                        <div class="col-md-6">
                        <label class="w3-text-blue w3-margin-top">blog</label>
                    <select name="parent"  class="w3-border w3-bottombar w3-border-blue w3-input">
                        <option value="none" disabled>none</option>
                        <?php

                        global $db;
                        $sql = "SELECT *FROM `blogs`";
                        $result =$db->Query($sql);

                        foreach($result as $r){
                            $name = $r['name'];
                            $blogcode = $r['code'];
                            if($blogcode == $blog){
                                echo "<option value='$blogcode' selected>$name</option>";
                            }else{
                                echo "<option value='$blogcode'>$name</option>";
                            }
                           
                        }
                        

                        ?>
                    </select>
                        </div>
                    </div>
                    
                   
                    <label class="w3-text-blue w3-margin-top">Featured Image</label>
                    <input type="file" name="image" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                    <label class="w3-text-blue w3-margin-top">Post Body</label>
                    <div class="w3-border w3-leftbar w3-border-blue w3-input">
                        <textarea name='content' id='pid' cols="60" rows="15" class="w3-input ">
                        <?php echo $body;?>
                        </textarea>
                    </div>
                    
                    <label class="w3-text-blue w3-margin-top">Keywords</label>
                    <input type="text" value="<?php echo $keywords;?>" name="keywords" placeholder="post Title" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                    

                    <input type="submit" name="update" class="w3-input w3-margin-top w3-blue" value="update">
                </div>
           </form>
                
         </div>






