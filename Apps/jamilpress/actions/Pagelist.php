<?php

class Pagelist extends JP_Action implements JXP_Action{
   private $filter;
    public function __construct()
    {
       $this->filter = isset($_GET['filter'])?$_GET['filter']:null;
      $this->setTitle("Page List");
      $this->setText("Manage Your Pages");
    }
    public function main(){
       include "containers/main.php";
    }

    public function getAction(){
       if($this->filter !==null){
         $plist = new JP_Pagelist($this->filter);
         $updatelink = "updatepage";
         include "containers/list.php";
       }else{
         $plist = new JP_Pagelist();
         $updatelink = "updatepage";
         include "containers/list.php";
       }
        
     }
   

}
