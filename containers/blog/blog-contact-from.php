<?php
 if(isset($_POST['send'])){
     $name = htmlspecialchars($_POST['name']);
     $email = htmlspecialchars($_POST['email']);
     $subject = htmlspecialchars($_POST['subject']);
     $json = [
         "name" => $name,
         "email" => $email
     ];
     $data = json_encode($json);
     $from_id = "guest";
     $to_id = $blogowner;
     $copyto = $blogauthor;
     $message = htmlspecialchars($_POST['text']);
$sql = "INSERT INTO `feedbacks`(`sender`,`to_id`,`subject`,`email`,`message`)VALUES('$name','$to_id','$subject','$email','$message')";

    global $db;

     if($db->Query($sql)){
         echo "<script> alert('Contact message sent success')</script>";
     }else{
         echo "<script> alert('message not added! input error')</script>";
     }
 }


?>

<h1>Leave a Message  </h1>
<form action="" method="post">
<div class="w3-container w3-light-grey w3-padding">
    <div class="row">
        <div class="col-md-6 w3-margin-bottom">
            <input type="text" class="w3-input" name="name" placeholder="Your Full name">
        </div>
        <div class="col-md-6 w3-margin-bottom">
            <input type="Email" class="w3-input" name="email" placeholder="Your Email Address">
        </div>
        <div class="col-md-12 w3-margin-bottom">
            <input type="text" class="w3-input" maxlength="150" name="subject" placeholder="Your Contact summary">
        </div>
        <div class="col-md-12 w3-white">
            <textarea name="text"  id="pid" cols="30" rows="10"></textarea>
        </div>
        <div class="col-7">
            <input type="submit" class="w3-input w3-btn w3-blue w3-margin-top" name="send" value="Send A Message">
        </div>
    </div>
</div>
</form>