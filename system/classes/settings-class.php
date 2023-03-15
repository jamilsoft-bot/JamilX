<?php
class JS_Settings{
    private $_data = [],$_filename,$_App;

    public function __construct(){
        global $CONF_SETTING, $CONF_THEME,$Apps; 
        $this->_filename = $CONF_SETTING; 

        $file = file_get_contents($this->_filename);
        $this->_App = json_decode($file);
        $this->_data = [
            "AppName" =>$this->_App->AppName,
            "AppDescription" =>$this->_App->AppDescription,
            "AppEmail" => $this->_App->AppEmail,
            "AppTheme" => $CONF_THEME,
            "AppLogo" =>$this->_App->AppLogo,
            "AppAuthor" => $this->_App->AppAuthor,
            "AppAddress" => $this->_App->AppAddress,
            "Apps" => $this->_App->Apps,
            

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


    public function Save(){
         
         file_put_contents($this->_filename, json_encode($this->_data));

        //echo "check";

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