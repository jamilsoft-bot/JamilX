<?php
 if(isset($_POST['comment'])){
     
     $name = htmlspecialchars($_POST['name']);
     $email = htmlspecialchars($_POST['email']);
     $post_id = $id;
     $owner = $bowner;
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
<div class="w3-container w3-light-grey w3-padding">
    <div class="row">
        <div class="col-md-6 w3-margin-bottom">
            <input type="text" class="w3-input" name="name" placeholder="Your Full name">
        </div>
        <div class="col-md-6 w3-margin-bottom">
            <input type="Email" class="w3-input" name="email" placeholder="Your Email Address">
        </div>
        <div class="col-md-12 w3-white">
            <textarea name="text"  id="pid" cols="30" rows="10"></textarea>
        </div>
        <div class="col-7">
            <input type="submit" class="w3-input w3-btn w3-blue w3-margin-top" name="comment" value="Post comment">
        </div>
    </div>
</div>
</form>