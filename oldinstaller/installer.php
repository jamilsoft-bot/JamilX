<?php

class installer {

    public function home(){
        if(file_exists("../Apps/")){
            //echo "File already exist";
        }else{
            mkdir("../Apps/");
        }
        include "main.php";
    }
    public function step1(){
        echo "<form action='?action=step2' method='post'";
        include "step1.php";
        echo "</form>";
    }

    private function dbform(){
        $dbname = $_POST['dbname'];
        $dbhost = $_POST['dbhost'];
        $dbpass = $_POST['dbpass'];
        $dbuser = $_POST['dbuser'];
$output =  <<<END
<?php
\$INDEX = "about";
\$CONF_DIR = "system/configs";
\$CONF_APPS_DIR = "Apps/";
\$CONF_SETTING = "system/configs/setting.json";
\$CONF_SERVICE_DIR = "services/";

\$DB_Data = [
    "DB_Host" => "$dbhost",
    "DB_User" => "$dbuser",
    "DB_Pass" => "$dbpass",
    "DB_Name" => "$dbname",

];
END;
        if(!file_put_contents("../conf.php",$output)){
            return "Could not create file";
        }else{
            return "Database Information all set, click install to begin installation";
        }
    }


    public function install(){
        if(file_exists("../conf.php")){
            include "../conf.php";
            $query = new mysqli($DB_Data['DB_Host'],$DB_Data['DB_User'],$DB_Data['DB_Pass'],$DB_Data['DB_Name']);

        $input = file_get_contents("sql.sql");
        if($query->multi_query($input)){
            $message = "Database tables create success";
            include "step3.php";
        }
        }else{
            $message = "Cannot access the conf.php file";
            include "step3.php";
        }
       
    }

    public function step2(){
        $message = null;
        if(isset($_POST['dbnext'])){
            $message = $this->dbform();
        }
        include "step2.php";
    }

    public function step4(){
        if(isset($_POST['submit'])){
            include "../conf.php";
            $query = new mysqli($DB_Data['DB_Host'],$DB_Data['DB_User'],$DB_Data['DB_Pass'],$DB_Data['DB_Name']);
            unset($_POST['submit']);
           $json = json_encode($_POST);
           $sql = "INSERT INTO `options`(`name`,`value`)VALUES('cprofile','$json')";
           if($query->query($sql)){
            echo "<script>";
            echo "location.assign('?action=step5')";
            echo "</script>";
           }
        }
        include "businfo.php";

        

    }
    public function step5(){
        if(isset($_POST['submit'])){
            include "../conf.php";
            $query = new mysqli($DB_Data['DB_Host'],$DB_Data['DB_User'],$DB_Data['DB_Pass'],$DB_Data['DB_Name']);
            unset($_POST['submit']);
           $json = json_encode($_POST);
           $username = $_POST['username'];
           $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
           $role = $_POST['role'];
           $city = $_POST['city'];
           $country = $_POST['country'];
           $email = $_POST['email'];
           $phone = $_POST['phone'];
           $gender = $_POST['gender'];
           $address = $_POST['address'];
           $name = $_POST['name'];
           $dob = $_POST['dob'];
           $state = $_POST['state'];
           $sql =  "INSERT INTO `users`( `username`, `password`, `role`, `city`, `country`, `email`, `phone`, `gender`, `address`, `state`, `name`,`dob`) VALUES ('$username','$password','$role','$city','$country','$email','$phone','$gender','$address','$state','$name','$dob')";
           if($query->query($sql)){
            echo "<script>";
            echo "location.assign('?action=final')";
            echo "</script>";
           }
        }
        include "step5.php";
    }
    public function main(){
        include "installer.php";
    }

    public function final(){
        include "final.php";
    }
}