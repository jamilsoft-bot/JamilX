<?php
class createuser extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        $users = new Userserve();
        if (isset($_POST['submit'])) {
            $users->reg();
        }
        include('containers/admin/userform.php');
    } 

    public function addAction()
    {

        include "containers/admin/home.php";
    }

    // public function createuser(){

    // }


}
