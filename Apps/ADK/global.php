<?php
$classes = scandir("Apps/ADK/classes/");
unset($classes[0]);
unset($classes[1]);

foreach($classes as $gets){
    include "classes/$gets";
}

$actions = scandir("Apps/ADK/actions/");
unset($actions[0]);
unset($actions[1]);

foreach($actions as $gets){
    include "actions/$gets";
}

