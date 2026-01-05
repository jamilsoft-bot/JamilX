<?php
$db->Host = $global_connect['dbHost'];
$db->User = $global_connect['dbUser'];  
$db->Pass = $global_connect['dbPass'];
$db->Name = $global_connect['dbName']; 

$db->open();
if(!$db->DB){
    echo "connection not made";
}
 