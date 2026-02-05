<?php

class bloghome extends JX_Action implements JX_ActionI{
     public function __construct()
    {
        $this->setTitle("Welcome to JamilX blog service");
        $this->setText("");
    }

    public function getAction()
    {
        include "containers/blog/home.php";
    }
}