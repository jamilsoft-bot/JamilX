<?php
include "system/global.php";

$services = scandir("services/");
unset($services[0]);
unset($services[1]);

foreach($services as $gets){
    include "services/$gets";
}

$actions = scandir("actions/");
unset($actions[0]);
unset($actions[1]);

foreach($actions as $gets){
    include "actions/$gets";
}

$systemApps = $Apps->Get_Installed_Apps();
foreach($systemApps as $apps){
    $appname = $apps['app_name'];
    include("Apps/".$appname."/".$appname.".php");
}
