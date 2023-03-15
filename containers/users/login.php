<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
     get_main_styles();?>
</head>
<body>
<?php

$resume = isset($_GET['resume'])?$_GET['resume']:'kani';




?>
<form action="passgate?action=login" method="post" enctype="multipart/form-data">

<div class="login-container " >
    <div style="background:none;" >
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