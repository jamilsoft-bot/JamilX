<?php


class Userserve extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('Login/Signup Page');
    }
    public function main(){
        
        include "containers/admin/userform.php";
    }

    public function reg(){
        global $Url,$users,$db;
        $Pages = new JS_Pages();
        $pass = password_hash($Url->post('password'),PASSWORD_DEFAULT);
        $users->username =  Input_test('username');;
       $users->password = $pass;// Input_test('password'); ;
       $users->role =  Input_test('role'); ;
       $users->bio =  Input_test('bio'); ;
       $users->nick =  Input_test('nick'); ;
      // $users->avatar =  Input_test('city'); ;
       $users->name =  Input_test('fullname'); ;
       $users->country = Input_test('country');;
       $users->city = Input_test('city');
       $users->dob = Input_test('dob');
       $users->phone = Input_test('phone');
       $users->email = Input_test('email');// isset($_POST['email'])? $_POST['email']: null;
       $users->gender = Input_test('gender');//isset($_POST['gender'])? $_POST['gender']: null;
       $users->address = Input_test('address');//isset($_POST['address'])? $_POST['address']: null;
       $users->state = Input_test('state');

       if($db->Query($users->Insert())){

            JX_alert("User Operation","Registration success<a href='login'>Login</a>");
        }else{
            JX_alert("User Operation","Something went wrong");

        }
       
        
        
    }



}