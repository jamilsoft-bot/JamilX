<?php

$actions = isset($_GET['action'])?$_GET['action']:"dashboardmain";
$getAction = new $actions();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $getAction->getTitle();?></title>
    <link rel="shortcut icon" href="assets/images/jslogobird.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/lib/bs5/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/lib/font/css/all.css">
    <link rel="stylesheet" href="assets/lib/w3/w3.css">
</head>
<body>
    
