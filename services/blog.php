<?php

class blogservice extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('blog Service');
    }
    public function main(){
       
        // blog entry point

         global $Url;

        $action = is_null($Url->get('action'))?'bloghome':$Url->get('action');

        $action->getAction();
    }

}
