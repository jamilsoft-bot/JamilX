<?php

class JS_Users 
{
    public $name, $password, $role,$city,$country,$bio,$username,$nick,$avatar,$dob,$phone,$email,$gender,$address,$state,$id;
    
    public function Insert()
    {
       
       return "INSERT INTO `users`( `username`, `password`, `role`, `city`, `country`, `email`, `phone`, `gender`, `address`, `state`, `bio`, `avatar`, `name`,`dob`) VALUES ('$this->username','$this->password','$this->role','$this->city','$this->country','$this->email','$this->phone','$this->gender','$this->address','$this->state','$this->bio','$this->avatar','$this->name','$this->dob')";
        
    }

    public function SelectAll()
    {
       
        return "SELECT * FROM `users`";

    }
    public function SelectById($id)
    {
       
        return "SELECT * FROM `users` WHERE id=$id";

    }
    public function get_username($id)
    {
        global $db;

        $s = $this->SelectById($id);
        $d = $db->Query($s);
        foreach($d as $n){
            return $n['username'];
        }


       

    }
    public function delete($id)
    {
       
        return "DELETE  FROM `users` WHERE id='". $id. "'";

    }

    public function SelectByEmail($email)
    {
       
        return "SELECT * FROM `users` WHERE email='". $email. "'";

    }

    public function SelectByUser($user)
    {
       
        return "SELECT * FROM `users` WHERE username='". $user. "'";

    }

    public function update($id){
       return "UPDATE `users` SET `username`='$this->username',`password`='$this->password',`role`='$this->role',`city`='$this->city',`country`='$this->country',`email`='$this->email',`phone`='$this->phone',`gender`='$this->gender',`address`='$this->address',`state`='$this->state',`bio`='$this->bio',`avatar`='$this->avatar',`name`='$this->name',`dob`='$this->dob' WHERE id=$id";
        //return "UPDATE `users` SET `username`='".$this->username."' WHERE id=".$id;
    }

    public function welcome()
    {
       
        return "Welcome to User Service";

    }

}



class JX_User{
    private $db, $id;

    public function __construct($id = null)
    {   global $JX_db;
        $this->db = $JX_db;
        if(!is_null($id)){
            $this->id =intval($id);
        }
    }
    public function setID($id){
        $this->id = $id;
    }
    public function getField($field_name = null){
        if($field_name !== null){
            $uid = $this->id;
            $sql = "SELECT $field_name FROM users WHERE id=$uid";
            $row = $this->db->query($sql);
            //$field = $row->fetch_assoc();
            foreach($row as $r){
                return $r[$field_name];
            }
        }
    }
}