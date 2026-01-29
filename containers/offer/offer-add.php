<header class="w3-container w3-blue ">
                    <h3> <?php echo $this->getTitle(); ?></h3>
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
                    <label class="w3-text-blue w3-margin-top">Offer Name</label>
                    <input type="text" name="name" placeholder="Type Offer name" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                    <!-- <label class="w3-text-blue w3-margin-top">Link</label>
                    <input type="text" name="link" placeholder="http://" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                     -->
                    <label class="w3-text-blue w3-margin-top">Offer Types</label>
                    <div class="row">
                        <div class="col-md-6">
                    <!-- <input type="text" name="type" placeholder="regular price without Currency " class="w3-border w3-bottombar w3-border-blue w3-input" required> -->
                    <select name="type" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                        <option value="visitation">Visit Now</option>
                        <option value="call">Call Now</option>
                        <option value="email">Email Now</option>
                        <option value="apointment"> Make an Appointment</option>
                        <option value="apointment"> Install Now</option>
                        <option value="apointment"> Buy Now</option>
                        <option value="apointment"> Get Started</option>
                    </select>
                        </div>
                        <div class="col-md-6">
                    <input type="text" name="link" placeholder="values " class="w3-border w3-bottombar w3-border-blue w3-input" required>
                    
                        </div>
                    </div>
                    
                    <label class="w3-text-blue w3-margin-top">Brand</label>
                    <!-- <input type="text" name="title" placeholder="post Title" class="w3-border w3-bottombar w3-border-blue w3-input" required> -->
                    
                    <select name="parent" class="w3-border w3-bottombar w3-border-blue w3-input">
                        <option value="jamilsoft">Default</option>
                        <?php

                        global $db;
                        $sql = "SELECT *FROM `brands`";
                        $result =$db->Query($sql);

                        foreach($result as $r){
                            $name = $r['name'];
                            $brandcode = $r['code'];
                            echo "<option value='$brandcode'>$name</option>";
                        }
                        

                        ?>
                    </select>
                   
                    <label class="w3-text-blue w3-margin-top">Featured Image</label>
                    <input type="file" name="image" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                    <label class="w3-text-blue w3-margin-top">Offer Details</label>
                    <div class="w3-border w3-leftbar w3-border-blue w3-input">
                        <textarea name='content' id='pid' cols="60" rows="15" class="w3-input "></textarea>
                    </div>
                    <label class="w3-text-blue w3-margin-top">Keywords</label>
                    <input type="text" name="keywords" placeholder="e.g product, service, computer" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                    
                    <input type="submit" name="oadd" class="w3-input w3-margin-top w3-blue" value="add">
                </div>
           </form>
                
         </div>






