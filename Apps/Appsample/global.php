<?php
$classes = scandir("Apps/Appsample/classes/");
unset($classes[0]);
unset($classes[1]);

foreach($classes as $gets){
    include "classes/$gets";
}

$services = scandir("Apps/Appsample/services/");
unset($services[0]);
unset($services[1]);

foreach($services as $gets){
    include "classes/$gets";
}

