<?php

class me extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('My Profile');
    }
   
    public function main(){
        global $Url;

        $action = is_null($Url->get('action'))?'read':$Url->get('action');

        $this->$action();
    }
    public function read()
    {
        $id = isset($_SESSION['uid'])? $_SESSION['uid']: null;

        global $db, $users,$Pages,$Me;
        $Userpro = $db->Query($users->SelectById($id));
        foreach($Userpro as $row){
            global $users;
            $users->name = $row['name'];
            $users->avatar = $row['avatar'];
            $users->role = $row['role'];
            $users->country = $row['country'];
            $users->city = $row['city'];
            $users->username = $row['username'];
            
            
            $users->dob = $row['dob'];
            $users->phone = $row['phone'];
            $users->email = $row['email'];
            $users->gender = $row['gender'];
            $users->address = $row['address'];
            $users->state = $row['state'];
          // $_SESSION['username'] = $users->username;
        }
        include "containers/users/user-read.php";

    }

    public function update()
    {
        $id = isset($_GET['id'])? $_GET['id']: null;

        global $db, $users,$Pages,$Url;
        
        if($id == null){
            if(isset($_POST['submit'])){
                $pass = password_hash($Url->post('password'),PASSWORD_DEFAULT);
                $users->username = isset($_POST['username'])? $_POST['username']: null;
                $users->password = $pass;
                $users->role = isset($_POST['role'])? $_POST['role']: null;
                $users->bio = isset($_POST['bio'])? $_POST['bio']: null;
                $users->nick = isset($_POST['nick'])? $_POST['nick']: null;
                $this->_avatar = isset($_FILES['avatar'])? $_FILES['avatar']: null;
                $users->name = isset($_POST['name'])? $_POST['name']: null;
                $users->country = isset($_POST['country'])? $_POST['country']: null;
                $users->city = isset($_POST['city'])? $_POST['city']: null;
                $users->dob = isset($_POST['dob'])? $_POST['dob']: null;
                $users->phone = isset($_POST['phone'])? $_POST['phone']: null;
                $users->email = isset($_POST['email'])? $_POST['email']: null;
                $users->gender = isset($_POST['gender'])? $_POST['gender']: null;
                $users->address = isset($_POST['address'])? $_POST['address']: null;
                $users->state = isset($_POST['state'])? $_POST['state']: null;
                $user_id = isset($_POST['uid'])? $_POST['uid']: null;;
                
                $users->avatar = $this->_avatar['name'];
                //$Userup = $db->Query($users->update($user_id));
                if(UploadpostImage($this->_avatar)){
                    global $Userup;
                    if($db->Query($users->update($user_id))){

                        echo $Pages->alert("User Operation","User updated success");
                        echo "<script>";
                        echo "location.assign('me')";
                        echo "</script>";
                    }else{
                        echo $Pages->alert("User Operation",$db->DBError);
            
                    }
                }
                   
              
            }

        }else{
            $Userpro = $db->Query($users->SelectById($id));
        foreach($Userpro as $row){
            global $users;
            $users->name = $row['name'];
            $users->avatar = $row['avatar'];
            $users->role = $row['role'];
            $users->country = $row['country'];
            $users->city = $row['city'];
            $users->username = $row['username'];
            
            
            $users->dob = $row['dob'];
            $users->phone = $row['phone'];
            $users->email = $row['email'];
            $users->gender = $row['gender'];
            $users->address = $row['address'];
            $users->state = $row['state'];
           
        }
        }

        
            
        $Formr = "?action=update";

        echo "<div class='row'>";
        include "containers/users/user-add.php";
        echo "</div>";

    }
}