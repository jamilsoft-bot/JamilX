<?php

class updatemyprofilepic extends JX_Action implements JX_ActionI
{


    public function getAction()
    {
        if (isset($_POST['submit'])) {
            $this->process();
        }
        echo "<form action='' method='post' enctype='multipart/form-data'>";
        include "containers/dashboard/profile-pic-update.php";
        echo "</form>";
    }

    public function addAction()
    {
        if (isset($_POST['submit'])) {
            $this->process();
        }
        echo "<form action='' method='post' enctype='multipart/form-data'>";
        include "containers/dashboard/profile-pic-update.php";
        echo "</form>";
    }

    private function process()
    {
        global $JX_db;
        $id = intval($_SESSION['uid']);
        $image = $_FILES['myfile'];
        $avatar = $image['name'];
        $sql = "UPDATE `users` SET `avatar`= '$avatar' WHERE `id`=$id";
        if (UploadpostImage($image)) {
            if ($JX_db->query($sql)) {
                JX_Alert("Image Saved Sucess", "", "green");
            } else {
                JX_Alert($JX_db->error, "", "green");
            }
        } else {
            JX_Alert("Could not upload the image", "", "green");
        }
    }
}
