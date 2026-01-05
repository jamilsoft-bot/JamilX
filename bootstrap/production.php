<?php

class Production extends Bootstrap{
    public function __construct()
    {
        parent::__construct("production");
    }

    public function init(){
        Mute_Error();

        if(!file_exists(".env")){
            echo "<script>";
            echo "location.assign('required.php?need=n001')";
            echo "</script>";
        }
        
        if(!file_exists("session.php")){
            echo "<script>";
            echo "location.assign('required.php?need=n002')";
            echo "</script>";
        }
    }
}