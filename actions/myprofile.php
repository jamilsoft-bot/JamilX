<?php

class myprofile extends JX_Action implements JX_ActionI
{

    public function __construct()
    {
        $this->setTitle("My Profile");
    }

    public function getAction()
    {
        include "containers/dashboard/myprofile-view.php";
    }

    public function addAction()
    {
        include "containers/dashboard/myprofile-view.php";
    }
}
