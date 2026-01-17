<?php
class filemanager extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('File Manager Page');
    }
    public function main(){
        // file manager entry point
        global $Url;
        
        $action = is_null($Url->get('action'))?'home':$Url->get('action');
       $ac = new $action();
       $ac->getAction();
    }

}