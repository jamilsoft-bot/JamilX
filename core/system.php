<?php
function JX_error(){
    include "containers/common/error.php";
    die();
} 

// set_error_handler(JX_error());
function Mute_Error(){
    error_reporting(E_ALL); 

ini_set('ignore_repeated_errors', TRUE); 

ini_set('display_errors', FALSE); 

ini_set('log_errors', TRUE); 
ini_set('error_log', 'logs/errors.log');
}