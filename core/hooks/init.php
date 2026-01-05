<?php

function get_state(){
    //return STATE;
}
function JX_State(){
        $st = parse_ini_file(".env");
        $target = $st['MODE'];
        $state = new $target();
        $state->init();
}

