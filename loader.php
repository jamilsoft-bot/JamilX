<?php
include "system/global.php";

$services = scandir("services/");
unset($services[0]);
unset($services[1]);

foreach($services as $gets){
    include "services/$gets";
}

$systemApps = $Apps->Get_Installed_Apps();
foreach($systemApps as $apps){
    $appname = $apps['app_name'];
    include("Apps/".$appname."/".$appname.".php");
}
