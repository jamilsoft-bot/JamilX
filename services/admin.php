<?php

class admin extends JX_Serivce implements JX_service
{
    public function __construct()
    {
        global $Url;
        $this->setTitle($Url->get('serve') . " - " . $Url->get('action'));

        if (isset($_SESSION['uid'])) {
        } else {
            echo "<script>";
            echo "location.assign('login&resume=admin')";
            echo "</script>";
        }
    }
    public function main()
    {
        global $Me;
        if ($Me->role() == "admin") {
            include('containers/admin/admin.php');
        } else {
            $message = "You are not an Admin, please goto <a href='dashboard'>Dashboard</a> to continue";
            $linkback = "dashboard";
            include('containers/admin/errorpage.php');
        }
    }



    public function viewbusiness()
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

        include('containers/admin/view-bus.php');
    }
}
