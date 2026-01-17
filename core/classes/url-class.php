<?php

class JS_URL{
    private $_serve, $_action;

     public function __construct()
    {
        $this->_serve = isset($_GET['serve'])? $_GET['serve']: null;
        $this->_action = isset($_GET['action'])? $_GET['action']: null;
       // $this->_serve = "";
    }

    public function get_paths()
    {
        return str_getcsv($this->_serve,'/');
    }

    public function get_service()
    {
        return $this->_serve;
    }

/***
 * Acept HTTP Post provided by HTML Form
 * @param $name $_POST['name'] the input name of the form
 */
    public function post($name)
    {
        $uri = isset($_POST[$name])?$_POST[$name]:null;
        return $uri;
    }

    public function get($get)
    {
        $uri = isset($_GET[$get])?$_GET[$get]:null;
        return $uri;
    }

    public function get_action()
    {
        return $this->_action;
    }

   

    public function help(){
        
        echo "<p> Service: <b>". $this->_serve . "</b></p>";
        echo "<p> action: <b>". $this->_action . "</b></p>";
        //echo "<p> method parameter: <b>". $this->_uri[2] . "</b></p>";



    }
}