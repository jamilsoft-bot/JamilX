<?php

class medialist extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        include 'containers/media/image-list.php';
    }
}

class addmedia extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        global $JX_db;
        $filename = null;
        $filesize = null;
        $summary = null;
        $fileowner = intval($_SESSION['uid']);
        if (isset($_POST['upload'])) {
            $summary = $_POST['text'];
            $file = $_FILES['nfile'];
            $filename = $file['name'];
            $filesize = $file['size'];
            $filetype = $file['type'];
            if (UploadpostImage($file)) {
                $sql = "INSERT INTO `media`(`name`,`type`,`summary`,`size`,`owner`)VALUES('$filename','$filetype','$summary','$filesize','$fileowner')";
                if ($JX_db->query($sql)) {
                    echo "<div class='alert w3-green alert-dismissible fade show' role='alert'>";
                    echo "<strong>Media Alert!</strong> the Image was successfully Uploaded.<br>";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                } else {
                    echo "<div class='alert w3-green alert-dismissible fade show' role='alert'>";
                    echo "<strong>Media Alert!</strong> " . $JX_db->error . ".<br>";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            } else {
                echo "<div class='alert w3-green alert-dismissible fade show' role='alert'>";
                echo "<strong>Media Alert!</strong> the Image was not Uploaded.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
        echo "<form action='' method='post' enctype='multipart/form-data'>";
        include 'containers/media/fileuploader.php';
        echo "</form>";
    }
}
