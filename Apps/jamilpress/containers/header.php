<?php
$act = null;
$message = null;

$actions = isset($_GET['action'])?$_GET['action']:"postlist";

if(class_exists($actions)){
    $act = new $actions();
}else{
    $message = "Nothing was found";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Jamilpress
        <?php if($act !== null){
            echo " - " . $act->getTitle();
        }?>
    </title>
    <link rel="shortcut icon" href="Apps/jamilpress/assets/images/jamilpress.png" type="image/x-icon">
    <link rel="stylesheet" href="Apps/jamilpress/assets/lib/w3/w3.css">
    <link rel="stylesheet" href="Apps/jamilpress/assets/lib/font/css/all.css">
    <link rel="stylesheet" href="Apps/jamilpress/assets/lib/bs5/css/bootstrap.min.css">
    <link rel="stylesheet" href="Apps/jamilpress/assets/lib/sum/summernote-lite.css">
    
</head>