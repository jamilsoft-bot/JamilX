<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JamilX Login Page</title>
    <link href='assets/style.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/lib/w3/w3.css">
    <link rel="stylesheet" href="assets/lib/font/css/all.css">
    <link rel="stylesheet" href="assets/lib/bs5/css/bootstrap.min.css">
    
</head>
<body>
<?php

$resume = isset($_GET['resume'])?$_GET['resume']:'saller';




?>
<form action="passgate?action=login" method="post" enctype="multipart/form-data">

<div class="login-container " >
    <div>
      <img src="assets/images/lg.png" class="w3-margin-bottom"  style="width: 100pt;">
      <div class="w3-border w3-border-blue w3-leftbar w3-card w3-container w3-padding-24" style="width: 300pt;">
      <h3 class="login-header">Login</h3>
      <!-- <form method="post" action="?loginPass=login"> -->
      <input type="text" class="w3-border w3-border-blue w3-bottombar w3-input input-text" name="username" id="userid" placeholder="User Name" required>
      <input type="hidden" name="resume" value="<?php global $Url; echo $resume?>">

      <br>
      <input type="password" class="w3-border w3-border-blue w3-bottombar w3-input input-text" name="password" id="passwordid" placeholder="User password" required>
      <br>
      <input class="login-btn w3-button w3-blue" type="submit"  name="submit" id="submitid">
      <a href="signup" class="w3-btn w3-blue">sign up</a>
      <!-- </form> -->
      </div>
    </div>
    
  </div>

</form>
</body>
</html>