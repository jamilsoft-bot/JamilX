<?php




function JX_include($file = ''){
    if($file != ''){
        include 'includes/'.$file;
    }
}

function JX_get_container($file = ''){
    if($file != ''){
        include 'containers/'.$file;
    }
}