<?php
class Development extends Bootstrap{
    public function __construct()
    {
        parent::__construct("development");
    }
 
    public function init(){
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