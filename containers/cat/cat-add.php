<header class="w3-container w3-blue ">
                    <h3> Create Category</h3>
</header>
    <div class="w3-container content">
<?php



?>
                <div class="w3-bar w3-border  w3-margin-top w3-light-grey">
                    <a href="#" class="w3-bar-item  w3-border-right w3-mobile w3-button">Create</a>
                    <a href="#" class="w3-bar-item  w3-border-right w3-mobile w3-button">List</a>
                    <!-- <a href="#" class="w3-bar-item w3-btn">Create</a> -->
                </div>
           <form action="" method="post" enctype="multipart/form-data">
                <div class="container">
                    <label class="w3-text-blue w3-margin-top">Category Title</label>
                    <input type="text" name="title" placeholder="Category Title" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                    <label class="w3-text-blue w3-margin-top">Parent</label>
                    <!-- <input type="text" name="title" placeholder="Category Title" class="w3-border w3-bottombar w3-border-blue w3-input" required> -->
                    <select name="parent" class="w3-border w3-bottombar w3-border-blue w3-input">
                        <option value="uncategorized">Uncategorized</option>
                        <?php

                        global $db;
                        $sql = "SELECT *FROM `categories`";
                        $result =$db->Query($sql);
                        $name = null;
                        $brandcode = null;
                        foreach($result as $r){
                            $name = $r['name'];
                            $brandcode = $r['id'];
                            echo "<option value='$brandcode'>$name</option>";
                        }
                        

                        ?>
                    </select>
                   
                    <label class="w3-text-blue w3-margin-top">Featured Image</label>
                    <input type="file" name="image" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                    <label class="w3-text-blue w3-margin-top">Category Body</label>
                    <div class="w3-border w3-leftbar w3-border-blue w3-input">
                        <textarea name='content' id='pid' cols="60" rows="15" class="w3-input "></textarea>
                    </div>
                    <label class="w3-text-blue w3-margin-top">Keywords</label>
                    <input type="text" name="keywords" placeholder="Keywords" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                    
                    <input type="submit" name="padd" class="w3-input w3-margin-top w3-blue" value="add">
                </div>
           </form>
                
         </div>






