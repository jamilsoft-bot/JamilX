<?php
include "core/index.php";
$prototypes = scandir("prototypes/");
unset($prototypes[0]);
unset($prototypes[1]);

foreach ($prototypes as $gets) {
    include "prototypes/$gets";
}

$services = scandir("services/");
unset($services[0]);
unset($services[1]);

foreach ($services as $gets) {
    include "services/$gets";
}

$actions = scandir("actions/");
unset($actions[0]);
unset($actions[1]);

foreach ($actions as $gets) {
    include "actions/$gets";
}
