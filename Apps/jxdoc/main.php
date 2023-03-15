<?php

$st = isset($_GET['action'])?$_GET['action']:"dochome";
$action = new $st();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/lib/w3/w3.css">
    <link rel="stylesheet" href="assets/lib/font/css/all.css">
    <link rel="stylesheet" href="assets/lib/bs5/css/bootstrap.min.css">
</head>
<body>
    <div class="row">
        <div class="col-md-2 ">
            <div class="w3-sidebar w3-bar-block w3-border w3-rightbar w3-border-blue">
                    <a href="#" class="w3-bar-item w3-bottombar w3-border-blue w3-margin-top" style="text-decoration: none;">
                        <img src="assets/images/bn.png" style="width: 100%">
                    </a>
                    <a href="#" class="w3-bar-item w3-button w3-margin-top">Home</a>
                    <a href="#" class="w3-bar-item w3-button">Overview</a>
                    <a href="#" class="w3-bar-item w3-button">Features List</a>
                    <a href="#" class="w3-bar-item w3-button">Installation</a>
                    <a href="#" class="w3-bar-item w3-button">Registration</a>
                    <a href="#" class="w3-bar-item w3-button">Admin</a>
                    <a href="#" class="w3-bar-item w3-button">Apps and SDK</a>
                    <a href="#" class="w3-bar-item w3-button">Database</a>
                    <a href="#" class="w3-bar-item w3-button">Routing</a>
                    <a href="#" class="w3-bar-item w3-button">Security</a>
            </div>
        </div>
        <div class="col-md">
        <?php
                    // $st = isset($_GET['action'])?$_GET['action']:"home";
                    // $action = new $st();
                    $action->addAction();
                ?>
        </div>
    </div>
</body>
</html>