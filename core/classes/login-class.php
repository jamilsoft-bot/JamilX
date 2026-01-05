<?php


class reg{
    public function checkuser(){
        global $db;
    global $users;

    $result = $db->Query($users->SelectByUser($users->username));

    if ($result->num_rows > 0) {
        return true;
    }else{
        return false;
        
    }

    }
    public function checkEmail(){

        global $db;
        global $users;
    
        $result = $db->Query($users->SelectByEmail($users->email));
    
        if ($result->num_rows > 0) {
            return true;
        }else{
            return false;
            
        }

    }

    public function valided(){
        if($this->checkEmail()){
                return false;
        }else{
            return true;
        }
    }
    public function main(){
        include "containers/users/signup.php";
    }

    public function regPass(){
        global $db,$Pages,$Url;
        $users = new JS_Users();
        $DB = new JS_Database();

       $users->username =  Input_test('username');
       $users->password =  Input_test('password');
       $users->role =  Input_test('role');
       $users->bio =  htmlspecialchars($Url->post('bio'));
       $users->nick =  Input_test('nick');
       $users->avatar = isset($_POST['avatar'])? "user.png": "user.png";
       $users->name =  Input_test('name');
       $users->country = Input_test('country');
       $users->city = Input_test('city');
       $users->dob = Input_test('dob');
       $users->phone = Input_test('phone');
       $users->email = Input_test('email');// isset($_POST['email'])? $_POST['email']: null;
       $users->gender = Input_test('gender');//isset($_POST['gender'])? $_POST['gender']: null;
       $users->address = Input_test('address');//isset($_POST['address'])? $_POST['address']: null;
       $users->state = Input_test('state');//isset($_POST['state'])? $_POST['state']: null;



                // $users->username = isset($_POST['username'])? $_POST['username']: null;
                // $users->password = isset($_POST['password'])? $_POST['password']: null;
                // $users->role = isset($_POST['role'])? $_POST['role']: null;
                // $users->bio = isset($_POST['bio'])? $_POST['bio']: null;
                // $users->nick = isset($_POST['nick'])? $_POST['nick']: null;
                // //$this->_avatar = isset($_FILES['avatar'])? $_FILES['avatar']: null;
                // $users->name = isset($_POST['name'])? $_POST['name']: null;
                // $users->country = isset($_POST['country'])? $_POST['country']: null;
                // $users->city = isset($_POST['city'])? $_POST['city']: null;
                // $users->dob = isset($_POST['dob'])? $_POST['dob']: null;
                // $users->phone = isset($_POST['phone'])? $_POST['phone']: null;
                // $users->email = isset($_POST['email'])? $_POST['email']: null;
                // $users->gender = isset($_POST['gender'])? $_POST['gender']: null;
                // $users->address = isset($_POST['address'])? $_POST['address']: null;
                // $users->avatar = isset($_POST['avatar'])? "user.png": "user.png";
                // $users->state = isset($_POST['state'])? $_POST['state']: null;
                $user_id = isset($_POST['uid'])? $_POST['uid']: null;;
        //include "services/users/signup.php";
        //echo $users->avatar;
         $add = $db->Query($users->Insert());
        //$t = $db->Query("INSERT INTO `users`(`username`,`role`,`password`) VALUES('kabiru','user','kabiru123')");
        
        if($add)
        {
            echo $Pages->alert("User Activation","Successfully Registered <a href='?action=login'>click here</a> to login");
        }else{
            echo $Pages->alert("User Activation","Unable to Register please change your email or username <a href='?action=reg'>go back</a>");
        }
    }

}