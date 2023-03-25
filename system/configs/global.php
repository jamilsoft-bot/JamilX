<?php
include "databases.php";

$APP = json_decode(file_get_contents($CONF_DIR."/setting.json"));


$CONF_THEME = $APP->AppTheme;


