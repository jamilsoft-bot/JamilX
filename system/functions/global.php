<?php

include "user.php";
include "session-fun.php";
include "app-fun.php";
include "stats-fun.php";
include "records-fun.php";
include "includes-fun.php";
include "media-fun.php";

function RemoveArray($needle,&$array = []){
    unset($array[array_search($needle,$array)]) ;
    
    }