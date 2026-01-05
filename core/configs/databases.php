<?php
$DB_Data  = parse_ini_file(".env");
$global_connect = array(
    "dbHost" => $DB_Data['DB_HOST'],
    "dbUser" => $DB_Data['DB_USER'],
    "dbPass" => $DB_Data['DB_PASS'],
    "dbName" => $DB_Data['DB_NAME']
);
 