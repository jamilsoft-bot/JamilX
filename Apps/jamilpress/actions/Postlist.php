<?php

class Postlist extends JP_Action implements JXP_Action{
   private $filter;
    public function __construct()
    {
      $this->filter = isset($_GET['filter'])?$_GET['filter']:null;
        $this->setTitle("Post List");
        $this->setText("Manage Your Posts");
    }
    public function main(){
       include "Apps/jamilpress/containers/main.php";
    }

    public function getAction(){ 
       delete_item('posts');
       if($this->filter !== null){
         $plist = new JP_Postlist($this->filter);
         $updatelink = "updatepost";
         include "Apps/jamilpress/containers/list.php";
       }else{
         $plist = new JP_Postlist();
         $updatelink = "updatepost";
         include "Apps/jamilpress/containers/list.php";
       }
        
     }

}
