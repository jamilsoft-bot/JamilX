<?php

class editmyprofile extends JX_Action implements JX_ActionI
{
    private $users;
    public function __construct()
    {
        $this->setTitle("Update My Profile");
        $this->users = new JS_Users();
    }

    public function addAction()
    {
        global $JX_db, $Me;
        $this->update();
        $id = intval($_SESSION['uid']);
        $sql = "SELECT * FROM `users` WHERE `id`=$id";
        $row = $JX_db->query($sql);
        $username = null;
        $password = null;
        $email = null;
        foreach ($row as $r) {
            $username = $r['username'];
        }
        echo "<form action='' method='post'>";
        include "containers/dashboard/myprofile-edit.php";
        echo "</form";
    }

    public function getAction()
    {
        global $JX_db, $Me;
        $this->update();
        $id = intval($_SESSION['uid']);
        $sql = "SELECT * FROM `users` WHERE `id`=$id";
        $row = $JX_db->query($sql);
        $username = null;
        $password = null;
        $email = null;
        foreach ($row as $r) {
            $username = $r['username'];
        }
        echo "<form action='' method='post'>";
        include "containers/dashboard/myprofile-edit.php";
        echo "</form";
    }

    public function update()
    {
        global $db, $users, $Pages, $Url;

        if (isset($_POST['submit'])) {
            $pass = password_hash($Url->post('password'), PASSWORD_DEFAULT);
            $username = isset($_POST['username']) ? $_POST['username'] : null;
            $password = $pass;
            $role = isset($_POST['role']) ? $_POST['role'] : null;
            $bio = isset($_POST['mybio']) ? $_POST['mybio'] : null;
            $nick = isset($_POST['nick']) ? $_POST['nick'] : null;
            //$this->_avatar = isset($_FILES['avatar'])? $_FILES['avatar']: null;
            $name = isset($_POST['fullname']) ? $_POST['fullname'] : null;
            $country = isset($_POST['country']) ? $_POST['country'] : null;
            $city = isset($_POST['city']) ? $_POST['city'] : null;
            $dob = isset($_POST['dob']) ? $_POST['dob'] : null;
            $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
            $address = isset($_POST['address']) ? $_POST['address'] : null;
            $country = isset($_POST['country']) ? $_POST['country'] : null;
            $state = isset($_POST['state']) ? $_POST['state'] : null;
            //  $user_id = isset($_POST['uid'])? $_POST['uid']: null;;

            //$avatar = $this->_avatar['name'];
            global $Userup, $JX_db;
            $myid = intval($_SESSION['uid']);
            $sql = "UPDATE `users` SET `username`='$username',`password`='$password',`city`='$city',`country`='$country',`email`='$email',`phone`='$phone',`gender`='$gender',`address`='$address',`state`='$state',`bio`='$bio',`name`='$name',`dob`='$dob' WHERE id=$myid";
            if ($JX_db->query($sql)) {
                echo "<div class='w3-container w3-margin-top'>";
                JX_Alert("User Operation", "User updated success");
                echo "</div>";
            } else {
                echo "<div class='w3-container w3-margin-top'>";
                JX_Alert("User Operation", $JX_db->error);
                echo "</div>";
            }
        }
    }
}
