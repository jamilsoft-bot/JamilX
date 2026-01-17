<?php


function savehit($name, $value, $owner){
    global $JX_db,$Url,$Me;
    $hitname = null;
    if(isset($_COOKIE['visitor'])){
        $hitname = $_COOKIE['visitor'];
    }

    $hitname .= $name;
    $sql = "INSERT INTO `hits`(`name`,`value`,`owner`)VALUES('$hitname','$value','$owner')";

    if($JX_db->query($sql)){

    }

}

function addHit($owner,$blog){
    global $JX_db,$Url,$Me;
    $action = is_null($Url->get('action'))?"home":$Url->get('action');
    $guest = isset($_SESSION['guest'])?$_SESSION['guest']:null;

    if(!is_null($guest)){
        $guest .= $action;
        $sql = "INSERT INTO `statistics`(`guest`,`view`,`blog`,`owner`)VALUES('$guest','$action','$blog','$owner')";

        if($JX_db->query($sql)){}
    }
}

function get_visits($owner){
    global $JX_db;

    $sql = "SELECT *FROM `statistics` WHERE `owner` = '$owner'";

    $r = $JX_db->query($sql);

    return $r->num_rows;

}