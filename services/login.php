<?php

class login extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('Login/Signup Page');
    }
    public function main(){
        JX_get_container('users/login.php');
    }

}

class logout extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('Login/Signup Page');
    }
    public function main(){
        echo "<script>";
        echo "location.assign('passgate?action=logout&resume=login')";
        echo "</script>";
    }

}


class passgate extends JX_Serivce implements JX_service{
   
    public function __construct()
    {
        $this->setTitle('Login/Signup Page');
    }
    public function main(){
        global $Url;
        $action = is_null($Url->get('action'))?'none':$Url->get('action');

        $this->$action();

    }

    public function none(){
        echo "404 not found";
    }

    public function uploadpic(){
        echo "<div class='login-container'>";
        echo "<div class=''>";
        echo "<form action='' method='post'>";
        echo "<input type='file' name='avatar' class='w3-input'>";
        echo "<input type='submit' name='submit' class='w3-btn w3-blue'>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }
    public function session(){
        global $Url;
        $uid = $Url->get('uid');
        $resume = isset($_GET['resume'])?$_GET['resume']:'me';
        //$rsm = is_null($resume)?$_SERVER['HOST']:$resume;
       
        echo "<script>";
        echo "location.assign('?session=on&uid=$uid&resume=$resume')";
        echo "</script>";
    }
    public function logout(){
        global $Url;
        $uid = $Url->get('uid');
        $resume = is_null($Url->get('resume'))?"login":$Url->get('resume');
        
        echo "<script>";
        echo "location.assign('?session=off&resume=$resume')";
        echo "</script>";
    }
    public function login(){
            global $Url, $db,$users,$JX_db;
            $user = $Url->post('username');
            $pass = $Url->post('password');
            $resume = isset($_POST['resume'])?$_POST['resume']:'dashboard';
            
            $npass = null;
            $uid = null;

            $record = $users->SelectByUser($user);

            $result = $JX_db->query($record);


            foreach($result as $r){
                $npass =  $r['password'];
                $uid = $r['id'];
            }

            if(password_verify($pass,$npass)){
                echo "<script>";
                echo "location.assign('passgate?action=session&uid=$uid&resume=$resume')";
                echo "</script>";
            }else{
                $msg = "Username and Password doesnt matched";
                echo "<script>";
                echo "location.assign('login?&msg=2')";
                echo "</script>";
            }
            
            //echo $npass;
        
        
    }

    public function reg(){
        global $Url,$users,$db;
        $Pages = new JS_Pages();
        $pass = password_hash($Url->post('password'),PASSWORD_DEFAULT);
 
        $users->username =  Input_test('username');;
       $users->password = $pass;// Input_test('password'); ;
       $users->role =  Input_test('usertype'); ;
       $users->bio =  Input_test('bio'); ;
       $users->nick =  Input_test('nick'); ;
      // $users->avatar =  Input_test('city'); ;
       $users->name =  Input_test('name'); ;
       $users->country = Input_test('country');;
       $users->city = Input_test('city');
       $users->dob = Input_test('dob');
       $users->phone = Input_test('phone');
       $users->email = Input_test('email');// isset($_POST['email'])? $_POST['email']: null;
       $users->gender = Input_test('gender');//isset($_POST['gender'])? $_POST['gender']: null;
       $users->address = Input_test('address');//isset($_POST['address'])? $_POST['address']: null;
       $users->state = Input_test('state');

       if($db->Query($users->Insert())){
        echo $Pages->alert("User Operation","Registration success<br><a href='login'>Login</a>");
        $msg = "Username and Password doesnt matched";
                echo "<script>";
                echo "location.assign('login')";
                echo "</script>";
    }else{
        echo $Pages->alert("User Operation","Something went wrong");

    }
       
        
        
    }

}

class signup extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('Login/Signup Page');
    }
    public function main(){
        
        JX_get_container('users/signup.php');
    }

}
