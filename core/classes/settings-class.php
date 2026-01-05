<?php
class JS_Settings{
    private $_data = [],$_filename,$_App;

    public function __construct(){
        global $CONF_SETTING, $CONF_THEME,$Apps; 
        $this->_filename = $CONF_SETTING; 

        $file = parse_ini_file(".env");
        $this->_data = [
            "AppName" =>$file['SITENAME'],
            "AppDescription" =>$file['SITE_DESCRIPTION'],
            "AppEmail" => $file['SITE_MAIL'],
            "AppTheme" => $file['SITE_THEME'],
            "AppLogo" =>$file['SITE_LOGO'],
            "AppAuthor" => $file['SITE_OWNER'],
            "AppAddress" => $file['SITENAME'],
            "Apps" => "",
            

        ];

        
        
    }


    public function LoadApps(){
        global $Apps;

        $this->_data['Apps'] = $Apps->Get_Installed_Apps();
    }

    public function SetApplogo($AppLogo){
        $this->_data['AppLogo'] = $AppLogo;
    }

    public function SetAppAddress($AppAddress){
        $this->_data['AppAddress'] = $AppAddress;
    }

    public function SetAppEmail($email){
        $this->_data['AppEmail'] = $email;
    }
    public function SetAppAuthur($authur){
        $this->_data['AppAuthor'] = $authur;
    }
    public function SetAppTheme($theme){
        $this->_data['AppTheme'] = $theme;
    }
    public function SetAppName($name){
        $this->_data['AppName'] = $name;
    }
    public function SetAppDescription($description){
        $this->_data['AppDescription'] = $description;
    }

    public function GetAppTheme(){
        return $this->_App->AppTheme;

    }
    
    public function GetAppName(){
        return $this->_App->AppName;

    }


    public function GetAppDescription(){
        
        return $this->_App->AppDescription;
    }

    public function GetAppAddress(){
        
        return $this->_App->AppAddress;
    }

    public function GetAppAuthor(){
        
        return $this->_App->AppAuthor;
    }

    public function GetAppEmail(){
        
        return $this->_App->AppEmail;
    }

    public function GetApps(){
        return $this->_App->Apps;
    }
}