<?php
class api extends JX_Serivce implements JX_service{
    public function __construct()
    {
        
        
    }

    public function main(){
        // the main api entry
        if($this->getAccess()){
             global $Url;
        
        $action = is_null($Url->get('action'))?'apihome':$Url->get('action');
        $action->getApi();
        }
    }
    public function getAccess(){
        // other validation can occur here and return boolean base on the condition
        return false;
    }
    public function getkey(){
        // api key validation
        if($this->requestValidation()){
            // validate the api key here
        }
    }

    public function requestValidation(){
        // validate http/https headers
        return false;
    }
   
}


//UI interface to manage User API Operation, such as creating the api key, etc
class apiservice extends JX_Serivce implements JX_service{
    public function __construct()
    {
        
        
    }

    public function main(){
        // the main api service  entry
         global $Url;
        
        $action = is_null($Url->get('action'))?'home':$Url->get('action');
        $action->getAction();
    }

    
   
}