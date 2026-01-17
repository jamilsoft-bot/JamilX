<?php

class email extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('Login/Signup Page');
    }
    public function main(){
        global $Url;
        $action = is_null($Url->get('action'))?'emailhome':$Url->get('action');
        $action->getAction();
    }

}