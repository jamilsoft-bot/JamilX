<?php

class JS_System{

    public function get_cur_url()
    {
        //return $_SERVER['PHP_SELF']	;
        return $_SERVER['PHP_SELF']."?". $_SERVER['QUERY_STRING'];
        
    }
}



?>