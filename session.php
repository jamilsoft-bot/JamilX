<?php
session_start();

if(isset($_GET['uid'])){
    
   // $uid = $_GET['uid'];
     // setcookie("stupid",$uid);
}

if(isset($_SESSION['guest'])){

}else{
    $_SESSION['guest'] = uniqid();
}
if(isset($_GET['session'])){
    switch ($_GET['session']) {
        case 'on':

$resume = isset($_GET['resume'])?$_GET['resume']:'dashboard';
$uid = isset($_GET['uid'])?$_GET['uid']:null;
$cid = isset($_GET['verify'])?$_GET['verify']:null;

if(isset($_GET["uid"])){
    setcookie("uid",$_GET["uid"]);
}

if(isset($_GET["uid"])){
    $_SESSION["uid"] = $_GET["uid"];
}




echo "<script>";
echo "location.assign('$resume')";
echo "</script>";
            
            break;
        case 'off':
            //echo "session unset area";
            session_destroy();
echo "<script>";
echo "location.assign('login')";
echo "</script>";
            //session_unset();
            break;
        
        default:
            # code...
            break;
    }
}




if(isset($_GET["verify"])){
    $dd = $_COOKIE['cid'];
    setcookie("cid",$_GET["verify"]);
    echo "<script>";
    echo "location.assign('ecologin?verified=')";
    echo "</script>";
}elseif(isset($_GET['distory'])){
    $dd = $_COOKIE['cid'];
    setcookie("cid",$_GET["distroy"], time() - 3600);
    echo "<script>";
    echo "location.assign('ecommerce')";
    echo "</script>";
}