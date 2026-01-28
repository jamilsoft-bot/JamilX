<?php

class updatesetting extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Setting');
    }

    public function getAction()
    {
        global $JX_db, $Me, $Url;
        $code = $Url->get('b');

        if (isset($_POST['submit'])) {
            $lg = $_FILES['logo'];
            $f = $lg['name'];
            $data = json_encode($_POST);
            $sql = business_update_with_logo($f, 'data', $data, $code);

            if (UploadpostImage($lg)) {
                if ($JX_db->query($sql)) {
                    echo "<div class='alert w3-green alert-dismissible fade show' role='alert'>";
                    echo "<strong>Business Alert!</strong> the Business was successfully updated.<br>";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                } else {
                    echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                    echo "<strong>Business Alert!</strong> " . $JX_db->error . "<br>";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            } else {
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Business Alert!</strong> Image Was Not Upload<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
        echo "<form action='' enctype='multipart/form-data' method='post'>";
        include 'containers/dashboard/update-bus.php';
        echo "</form>";
    }
}

class setting extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Setting');
    }

    public function getAction()
    {
        include 'containers/dashboard/update-bus.php';
    }
}
