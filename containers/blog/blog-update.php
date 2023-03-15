<header class="w3-container w3-blue ">
                    <h3> Create Blog</h3>
</header>
    <div class="w3-container content">
<?php
    global $Me, $db;
    $owner = $_GET['b'];
    $bid = $_GET['bid'];
    $author =$Me->username();

    $name = null;
    $url = null;
    $des = null;
    $keys = null;

    $sql = "SELECT *FROM `blogs` WHERE `id`=$bid";

    $result = $db->Query($sql);

    foreach($result as $r){
        $name = $r['name'];
        $url = $r['url'];
        $des = $r['description'];
        $keys = $r['keywords'];
        $cat = $r['category'];
    }


?>
                <div class="w3-bar w3-border  w3-margin-top w3-light-grey">
                    <a href="#" class="w3-bar-item  w3-border-right w3-mobile w3-button">Create</a>
                    <a href="#" class="w3-bar-item  w3-border-right w3-mobile w3-button">List</a>
                    <!-- <a href="#" class="w3-bar-item w3-btn">Create</a> -->
                </div>
           <form action="" method="post" enctype="multipart/form-data">
                <div class="container">
                <input type="hidden" name="owner" value="<?php echo $owner;?>" placeholder="post Title" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                <input type="hidden" name="author" value="<?php echo $author;?>" placeholder="post Title" class="w3-border w3-bottombar w3-border-blue w3-input" required>

                    <label class="w3-text-blue w3-margin-top">Blog Name</label>
                    <input type="text" value="<?php echo $name; ?>" name="blogname" placeholder="title of the blog" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                    
                    <label class="w3-text-blue w3-margin-top">Blog url (no space)</label>
                    <input type="text" value="<?php echo $url; ?>" name="blogurl" placeholder="url to access the Blog from external sites" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                    <label class="w3-text-blue w3-margin-top">Category</label>
                    <select name="cat"  class="w3-border w3-bottombar w3-border-blue w3-input">
                        <option value="uncategorized">Uncategorized</option>
                        <?php

                        global $db;
                        $sql = "SELECT *FROM `categories`";
                        $result =$db->Query($sql);

                        foreach($result as $r){
                            $name = $r['name'];
                           // $blogcode = $r['code'];
                            if($name == $cat){
                                echo "<option value='$name' selected>$name</option>";
                            }else{
                                echo "<option value='$name'>$name</option>";
                            }
                           
                        }
                        

                        ?>
                    </select>
                    <label class="w3-text-blue w3-margin-top">Blog logo</label>
                    <input type="file" name="bloglogo" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                    <label class="w3-text-blue w3-margin-top">Blog Description</label>
                    <div class="w3-border w3-leftbar w3-border-blue w3-input">
                    <textarea name='blogDes' id='pid' cols="60" rows="10" class="w3-input "> <?php echo $des; ?></textarea>
                    <!-- <textarea name='blogDes' id='bid' cols="60" rows="10" class="w3-input ">
                        <?php //echo $des; ?>
                        </textarea> -->
                    </div>
                    <label class="w3-text-blue w3-margin-top">Blog keywords (sparated by commans)</label>
                    <input type="text" value="<?php echo $keys; ?>" name="keywords" placeholder="e.g store,blog, top 3, etc" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                    
                    <input type="submit" name="update" class="w3-input w3-margin-top w3-blue" value="Update">
                </div>
           </form>
                
         </div>






