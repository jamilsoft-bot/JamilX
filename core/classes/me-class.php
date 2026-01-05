<?php

class JS_Me{
    private $default = array();
    private $_data =[];
    private $users,$uid;
    public function __construct()
    {
        
        
        // $this->default = array(
        //     'username' => ''
        // );
        
    }

    public function role(){
        global $db,$users,$JX_db;
        
        //$uid = isset($_SESSION['uid'])? $_SESSION['uid']:null;
        if(isset($_SESSION['uid'])){
            $s = $users->SelectById($_SESSION['uid']);
            $d = $JX_db->query($s);
        foreach($d as $n){
            return $n['role'];
        }
        }else{
            
                return null;
            
        }
    }

    public function password(){
        global $db,$users, $JX_db;
        
        if(isset($_SESSION['uid'])){
            $s = $users->SelectById($_SESSION['uid']);
            $d = $JX_db->query($s);
        foreach($d as $n){
            return $n['password'];
        }
        }else{
            
                return null;
            
        }
        
    }
    public function id(){
        global $db,$users, $JX_db;
        
        if(isset($_SESSION['uid'])){
           return $_SESSION['uid'];
        }else{
            
                return null;
            
        }
        
    }

    public function gender(){
        global $db,$users, $JX_db;
        
        //$uid = isset($_SESSION['uid'])? $_SESSION['uid']:null;
        if(isset($_SESSION['uid'])){
            $s = $users->SelectById($_SESSION['uid']);
            $d = $JX_db->query($s);
        foreach($d as $n){
            return $n['gender'];
        }
        }else{
            
                return null;
            
        }
        
    }
    
    public function username(){
        global $db,$users, $JX_db;
        
        //$uid = isset($_SESSION['uid'])? $_SESSION['uid']:null;
        if(isset($_SESSION['uid'])){
            $s = $users->SelectById($_SESSION['uid']);
            $d = $JX_db->query($s);
        foreach($d as $n){
            return $n['username'];
        }
        }else{
            
                return null;
            
        }
        
    }

    public function email(){
        global $db,$users, $JX_db;
        
        //$uid = isset($_SESSION['uid'])? $_SESSION['uid']:null;
        if(isset($_SESSION['uid'])){
            $s = $users->SelectById($_SESSION['uid']);
            $d = $JX_db->query($s);
        foreach($d as $n){
            return $n['email'];
        }
        }else{
            
                return "No Email";
            
        }
        
    }
    public function pic(){
        global $db,$users, $JX_db;
                if(isset($_SESSION['uid'])){
            $s = $users->SelectById($_SESSION['uid']);
            $d = $JX_db->query($s);
        foreach($d as $n){
            return  $n['avatar'];
        }
        }else{
            
                return "user.png";
            
        }
        
    }
    public function Fullname(){
        global $db,$users, $JX_db;
                if(isset($_SESSION['uid'])){
            $s = $users->SelectById($_SESSION['uid']);
            $d = $JX_db->query($s);
        foreach($d as $n){
            return  $n['name'];
        }
        }else{
            
                return null;
            
        }
        
    }
    public function DoB(){
        global $db,$users, $JX_db;
                if(isset($_SESSION['uid'])){
            $s = $users->SelectById($_SESSION['uid']);
            $d = $JX_db->query($s);
        foreach($d as $n){
            return  $n['dob'];
        }
        }else{
            
                return null;
            
        }
        
    }

    public function state(){
        global $db,$users, $JX_db;
                if(isset($_SESSION['uid'])){
            $s = $users->SelectById($_SESSION['uid']);
            $d = $JX_db->query($s);
        foreach($d as $n){
            return  $n['state'];
        }
        }else{
            
                return null;
            
        }
        
    }

    public function country(){
        global $db,$users, $JX_db;
                if(isset($_SESSION['uid'])){
            $s = $users->SelectById($_SESSION['uid']);
            $d = $JX_db->query($s);
        foreach($d as $n){
            return  $n['country'];
        }
        }else{
            
                return null;
            
        }
        
    }

    public function city(){
        global $db,$users, $JX_db;
                if(isset($_SESSION['uid'])){
            $s = $users->SelectById($_SESSION['uid']);
            $d = $JX_db->query($s);
        foreach($d as $n){
            return  $n['city'];
        }
        }else{
            
                return null;
            
        }
        
    }

    public function phone(){
        global $db,$users, $JX_db;
                if(isset($_SESSION['uid'])){
            $s = $users->SelectById($_SESSION['uid']);
            $d = $JX_db->query($s);
        foreach($d as $n){
            return  $n['phone'];
        }
        }else{
            
                return null;
            
        }
        
    }

    public function bio(){
        global $db,$users,$JX_db;
                if(isset($_SESSION['uid'])){
            $s = $users->SelectById($_SESSION['uid']);
            $d = $JX_db->query($s);
        foreach($d as $n){
            return  $n['bio'];
        }
        }else{
            
                return null;
            
        }
        
    }

    public function address(){
        global $db,$users, $JX_db;
                if(isset($_SESSION['uid'])){
            $s = $users->SelectById($_SESSION['uid']);
            $d = $JX_db->query($s);
        foreach($d as $n){
            return  $n['address'];
        }
        }else{
            
                return null;
            
        }
        
    }
}