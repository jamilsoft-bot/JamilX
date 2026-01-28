<?php
$base = scandir("core/base/");
unset($base[0]);
unset($base[1]);

foreach ($base as $gets) {
    include "base/$gets";
}


$classes = scandir("core/classes/");
unset($classes[0]);
unset($classes[1]);

foreach ($classes as $gets) {
    include "core/classes/$gets";
}

include "etc/global.php";
include "functions/global.php";
