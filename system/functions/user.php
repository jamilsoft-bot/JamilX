<?php
/**
 * checking user login before passing
 * 
 */
function check_Pass1($username){
echo "welcome ".$username;

}

function get_username(){
    global $users;
   // $users->username = "Hamisu Saadu";
}

function check_login(){
    global $db;
    global $users;

    $result = $db->Query($users->SelectByUser($users->username));

    if (!$result->num_rows > 0) {
        echo " UserName is unavailable";
    }else{
        
        foreach($result as $row){
            $pass = $row['password'];
            $uid = $row['id'];
    
            if($pass == $users->password){
                echo " The User Account is Available";
                header("location: session.php?switch=on&user=$users->username&uid=$uid");
            }else{
                echo " The Password is incorrect";
    
            }
            
        }
    }
}