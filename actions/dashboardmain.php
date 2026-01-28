<?php

class dashboardmain extends JX_Action implements JX_ActionI
{

    public function __construct()
    {
        $this->setTitle("Welcome to JamilX Dashboard");
        $this->setText("");
    }

    public function getAction()
    {
        include "containers/dashboard/home.php";
    }
}
