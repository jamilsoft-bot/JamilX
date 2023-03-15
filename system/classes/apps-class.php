<?php

class JS_APPS{
    private $_app = [];
    private $_data = [];
    
    public function __construct()
    {
        global $APP,$CONF_APPS_DIR,$AppSetting,$db;
    }

    public function installed($name){
        global $JX_db;
        $sql = "SELECT *FROM `apps` WHERE `app_name` = '$name'";

        $result = $JX_db->query($sql);

        if($result->num_rows < 1){
            return false;
        }else{
            return true;
        }
    }
    public function Install($name){
      global $CONF_APPS_DIR, $db;
      $file = file_get_contents("$CONF_APPS_DIR$name/conf.json") or die("could not open the file");
      $app = json_decode($file) or die("something went wrong") ;
        
        $appname = isset($app->Nick) ?$app->Nick: null;
        $appfullname = isset($app->Name) ?$app->Name: null;
        $summary = isset($app->Summary) ?$app->Summary: null;
        $tags = isset($app->Tags) ?$app->Tags: null;
        $cat = isset($app->Category) ?$app->Category: null;
        $email = isset($app->Email) ?$app->Email: null;
        $website = isset($app->Website) ?$app->Website: null;
        $others = isset($app->others) ?$app->others: null;
        $authur = isset($app->Authur) ?$app->Authur: null;
        !is_null($appname) or die("app name cannot be null");

      $sql = "INSERT INTO `apps`( `app_name`,`app_fullname`, `app_summary`, `app_category`, `app_tags`, `app_authur`, `app_email`, `app_website`, `app_others`) VALUES ('$appname','$appfullname','$summary','$cat','$tags','$authur','$email','$website','$others')";
        if($db->Query($sql)){
         return "Install Succes";
        }else{
            return  "App may be Already installed or contact the administrator";
        }
    }

    public function Uninstall($name){
        global $CONF_APPS_DIR, $db;
      
      $app = json_decode(file_get_contents("$CONF_APPS_DIR$name/conf.json")) or die("could not open the file");
       
        $sql = "DELETE FROM `apps` WHERE app_name = '$name'";

         if($db->Query($sql)){
         return "uninstalled success";
        }else{return false;}
    }

    public function saveApps(){
        

    }
    public function Get_Installed_Apps(){
        global $CONF_APPS_DIR, $db;
        //$data = [];
        $sql = "SELECT * FROM `apps`";
        $r = $db->Query($sql);

       

        return $this->_data = $r;
           
    }
    public function Total(){
        global $CONF_APPS_DIR, $db;

        $sql = "SELECT * FROM `apps`";
        $r = $db->Query($sql);
        $c = $r->num_rows;
        return $c;
    }

    public function getApp($name){
        global $APP,$CONF_APPS_DIR;
        $data = json_decode(file_get_contents("$CONF_APPS_DIR/$name/conf.json"));
        return $data;
    }
}





?>