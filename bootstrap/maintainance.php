<?php
class Maintainance extends Bootstrap{
    public function __construct()
    {
        parent::__construct("maintainance");
    }

    public function init(){
        Mute_Error();
        include "containers/common/maintainance.php";
        die();
    }
    
}