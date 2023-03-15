<?php

class sdkhome extends JX_Action implements JX_ActionI{
    public function getAction()
    {
        include "Apps/eclass/containers/home.php";
    }

    public function addAction()
    {

        include "Apps/sdk/containers/home.php";
    }

}

class sdkaction extends JX_Action implements JX_ActionI{
    public function getAction()
    {
        //include "Apps/eclass/containers/home.php";
    }

    public function addAction()
    {
        // echo "home";
        include "Apps/sdk/containers/action-sample.php";
    }

   



}
