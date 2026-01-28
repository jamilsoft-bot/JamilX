<?php
class updatecomp extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        global $JX_db;
        $data = null;
        $data2 = null;
        //$sql2 = "INSERT INTO `options`(`name`,`value`)VALUES('cprofile','$data')";

        if (isset($_POST['submit'])) {
            $data = json_encode($_POST);
            $sql2 = "UPDATE `options` SET `value`='$data' WHERE `name`='cprofile'";
            if ($JX_db->query($sql2)) {
                JX_Alert("Business Profile set");
            } else {
                // JX_Alert($JX_db->error);

            }
        } else {
            $sql1 =  "SELECT *FROM `options` WHERE `name`='cprofile'";
            $r = $JX_db->query($sql1);
            foreach ($r as $t) {
                $data2 = $t['value'];
            }
        }
        $info = json_decode($data2);
        echo "<form action='' method='post'>";
        include('containers/admin/company.php');
        echo "</form>";
    }

    public function addAction()
    {

        include "containers/admin/home.php";
    }
}
