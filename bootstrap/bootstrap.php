<?php
class Bootstrap{
    private $_statecode = [
        "maintainance" => 1,
        "production" => 2,
        "development" => 3
    ];

    private $_state;

    public function __construct($state)
    {
        $this->_state = $this->_statecode[$state];
    }
    public function state(){
        return $this->_state;
    }

    public function init(){
        
    }
}


include "bootstrap/development.php";
include "bootstrap/maintainance.php";
include "bootstrap/production.php";