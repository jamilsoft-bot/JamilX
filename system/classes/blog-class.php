<?php

class JX_Blog{
    public function get_name(){
        global $Url;

        $p =  $Url->get_paths();
        if($p[0] == "blogs"){
            return $p[1];
        }
        
    }
}
