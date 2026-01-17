<?php

class filemanagerhome extends JX_Action implements JX_ActionI{
     public function __construct()
    {
        $this->setTitle("Welcome to JamilX File Manager service");
        $this->setText("");
    }

    public function getAction()
    {
        include "containers/filemanager/home.php";
    }
}