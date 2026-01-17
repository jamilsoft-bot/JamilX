<?php
//Configurations

$configs= scandir("system/configs/");
unset($configs[0]);
unset($configs[1]);
unset($configs[4]);
foreach($configs as $gets){
    include "system/configs/$gets";
}




//classes
$classes = scandir("system/classes/");
unset($classes[0]);
unset($classes[1]);

foreach($classes as $gets){
    include "system/classes/$gets";
}
include "etc/global.php";
include "functions/global.php";



//databases
$databases = scandir("system/databases/");
unset($databases[0]);
unset($databases[1]);

foreach($databases as $gets){
    include "system/databases/$gets";
}









