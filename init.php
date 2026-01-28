<?php
/**
 * loading the naccessary files
 */
require_once "core/system.php";
require 'bootstrap.php';

$hooks = scandir("core/hooks/");
unset($hooks[0]);
unset($hooks[1]);

foreach($hooks as $gets){
    include "core/hooks/$gets";
}

JX_State();
$scripts = scandir("scripts/");
unset($scripts[0]);
unset($scripts[1]);

foreach($scripts as $gets){
    include "scripts/$gets/$gets.php";
}

$systemApps = $Apps->Get_Installed_Apps();
foreach($systemApps as $apps){
    $appname = $apps['app_name'];
    include("Apps/".$appname."/".$appname.".php");
} 

include 'route/http.php';




