<?php

if(!file_exists("conf.php")){
    echo "<script>";
    echo "location.assign('installer')";
    echo "</script>";
}else{
    require_once 'session.php';
    require 'conf.php';
    require 'loader.php';
    include 'route/http.php';
}

