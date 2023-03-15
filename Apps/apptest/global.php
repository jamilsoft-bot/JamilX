<?php
$actions = scandir("Apps/sdk/classes/");
unset($actions[0]);
unset($actions[1]);

foreach($actions as $gets){
    include "classes/$gets";
}

$actions = scandir("Apps/sdk/ext/");
unset($actions[0]);
unset($actions[1]);

foreach($actions as $gets){
    include "ext/$gets/main.php";
}

$actions = scandir("Apps/sdk/services/");
unset($actions[0]);
unset($actions[1]);

foreach($actions as $gets){
    include "services/$gets";
}

include "functions.php";
