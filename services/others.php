<?php

class contactjx extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('Business List');
    }
    public function main(){
        include "containers/about/contactjx.php";
    }

}

class aboutjx extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('About');
    }
    public function main(){
        //$SessionMe = $_SESSION['uid'];
        include('containers/about/aboutjx.php');

       
    }

    public function getAction()
    {
        include "containers/admin/about.php";
    }

}

class about extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('About');
    }
    public function main(){
        //$SessionMe = $_SESSION['uid'];
        include('containers/about/about.php');

       
    }

    public function getAction()
    {
        include "containers/admin/about.php";
    }

}



class index extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('Jamilsoft official Homepage');
    }
    public function main(){
        //$SessionMe = $_SESSION['uid'];
        include('containers//admin/about.php');
    }

}

