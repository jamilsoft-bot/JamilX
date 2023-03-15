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
                    <label class="w3-text-blue w3-margin-top">Email Subject</label>
                    <input type="text" name="subject" placeholder="Type product or service name or whatever" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                    <label class="w3-text-blue w3-margin-top">CC/BCC</label>
                    <input type="text" name="cc" placeholder="Copy to...." class="w3-border w3-bottombar w3-border-blue w3-input" required>
                    
                    <label class="w3-text-blue w3-margin-top">Email Contents</label>
                    <div class="w3-border w3-leftbar w3-border-blue w3-input">
                        <textarea name='content' id='pid' cols="60" rows="15" class="w3-input" ></textarea>
                    </div>
                    <label class="w3-text-blue w3-margin-top">Keywords</label>
                    <input type="text" name="keywords" placeholder="e.g product, service, computer" class="w3-border w3-bottombar w3-border-blue w3-input" required>
                    
                    <input type="submit" name="add" class="w3-input w3-margin-top w3-blue" value="Submit">
                </div>
           </form>
                
         </div>






