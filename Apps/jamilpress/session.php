<?php
$blog = isset($_GET['blog'])?$_GET['blog']:null;

if(!isset($_SESSION['uid'])){
   // echo "you ware not logged";
  // Redirect("login");
}
if($blog !== null){
    $_SESSION['blog'] = $blog;
}