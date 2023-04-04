<?php
error_reporting(E_ALL); 

ini_set('ignore_repeated_errors', TRUE); 

ini_set('display_errors', FALSE); 

ini_set('log_errors', TRUE); 
ini_set('error_log', 'logs/errors.log'); 




include "vendor/autoload.php";
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

