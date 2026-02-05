
    <div class="w3-margin-top  w3-container w3-bar w3-margin-bottom">
        <h1 class="w3-bar-item "><?php echo $post->getName(); ?></h1>
    </div>
    <div class="w3-container w3-center">
        <img src="<?php
                        $image = $post->getImage();
                        if($image == null){
                            echo "../Apps/jamilpress/assets/images/blogpost.png";
                        }else{
                            echo "../data/$image";
                        }
                        //echo $logo;
                        
                        ?>">
    </div>
    <div class="w3-container w3-margin">
        <div>
            <?php echo $post->getContent();?>
        </div>
    </div>
    <?php include "comment-list.php";?>
    <!-- <div class="w3-margin-top  w3-container w3-bar w3-margin-bottom">
        <h1 class="w3-bar-item ">Comments list</h1>
    </div>
    <div class="w3-container">
        <div class="media border p-3 w3-margin-top">
            <img src="assets/images/user.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
            <div class="media-body">
              <h4>John Doe <small><i>Posted on February 19, 2016</i></small></h4>
              <p>Lorem ipsum...</p>
            </div>
        </div>
        <div class="media border p-3 w3-margin-top">
            <img src="assets/images/user.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
            <div class="media-body">
              <h4>John Doe <small><i>Posted on February 19, 2016</i></small></h4>
              <p>Lorem ipsum...</p>
            </div>
        </div> <div class="media border p-3 w3-margin-top">
            <img src="assets/images/user.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
            <div class="media-body">
              <h4>John Doe <small><i>Posted on February 19, 2016</i></small></h4>
              <p>Lorem ipsum...</p>
            </div>
        </div>
    </div> -->
</body>
</html>