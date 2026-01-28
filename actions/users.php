<?php
class users extends JX_Action implements JX_ActionI{
    public function getAction()
    {
        $this->setTitle("User List");
        JX_delete_item('users');
        include('containers/admin/user-list.php'); 
    }

    



}