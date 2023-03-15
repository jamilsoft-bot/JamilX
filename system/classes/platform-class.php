<?php


class Jamilsoft{
    private $_name, $_version, $_summary, $_developer;
   
    public function __construct()
    {
        $this->_developer = "Muhammad Jamil";
        $this->_version = "0.1";
        
    }
    public function get_version(){
        return $this->_version;
    }

    public function get_developer(){
        return $this->_developer;
    }

}

class Platform{
    private function get_option($name){
        global $JX_db;
        $sql = "SELECT *FROM `options` WHERE `name` = '$name'";
        $re = $JX_db->query($sql);

        return $re;

    }
    
}