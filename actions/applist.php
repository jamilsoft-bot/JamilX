<?php
class applist extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        global $JX_db, $Url, $Apps;
        $insall = $Url->get('install');
        $uninsall = $Url->get('uninstall');
        if ($insall !== null) {
            JX_Alert($Apps->Install($insall));
        }

        if ($uninsall !== null) {
            JX_Alert($Apps->Uninstall($uninsall));
        }
        include "containers/apps/app-list.php";
        //echo "am i here";
    }

    // public function applist(){

    // }

    public function addAction()
    {

        include "containers/admin/home.php";
    }
}
