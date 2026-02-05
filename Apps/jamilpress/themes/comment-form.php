<?php
 if(isset($_POST['comment'])){
     
     $name = htmlspecialchars($_POST['name']);
     $email = htmlspecialchars($_POST['email']);
     $post_id = $id;
     $owner = "";
     $message = htmlspecialchars($_POST['text']);
$sql = "INSERT INTO `comments`(`author`,`message`,`email`,`post_id`,`owner`)VALUES('$name','$message','$email','$id','$owner')";

    global $db;

     if($db->Query($sql)){
         echo "<script> alert('Comment added success')</script>";
     }else{
         echo "<script> alert('Comment not added! input error')</script>";
     }
 }


?>

<h1>Leave a Comment </h1>
<form action="" method="post">
<div class="w3-container  w3-padding w3-margin">
    <div class="row">
        <div class="col-md-12 w3-margin-bottom">
            <input type="text" class="w3-input w3-border" name="name" placeholder="Your Full name">
        </div>
        <div class="col-md-12 w3-margin-bottom">
            <input type="Email" class="w3-input w3-border" name="email" placeholder="Your Email Address">
        </div>
        <div class="col-md-12 w3-white">
            <textarea name="text"  id="cid" cols="30" rows="10"></textarea>
        </div>
        <div class="col-7">
            <input type="submit" class="w3-input w3-btn w3-blue w3-margin-top" name="comment" value="Post comment">
        </div>
    </div>
</div>
</form>

<script src="../Apps/jamilpress/assets/lib/jq/jq.js"></script>
<script src="../Apps/jamilpress/assets/lib/sum/summernote-lite.js"></script>
<script>
$(document).ready(function (){
        $('#cid').summernote({
		
        tabsize: 2,
        height: 300
  })
})
</script>