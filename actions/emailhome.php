<?php

class emailhome extends JX_Action implements JX_ActionI{
     public function __construct()
    {
        $this->setTitle("Welcome to JamilX email service");
        $this->setText("");
    }

    public function getAction()
    {
        include "containers/email/home.php";
    }
}