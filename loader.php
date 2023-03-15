<?php
include("system/global.php");
$systemApps = $Apps->Get_Installed_Apps();
foreach($systemApps as $apps){
    $appname = $apps['app_name'];
    include("Apps/".$appname."/".$appname.".php");
}
include('services/custom.php');