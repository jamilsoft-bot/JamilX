<?php

class Catlist extends JP_Action implements JXP_Action{
   public function __construct()
   {
     $this->setTitle("Category List");
     $this->setText("Manage Your Categories");
   }
   public function main(){
      include "containers/main.php";
   }

   public function getAction(){
       $plist = new JP_Catlist();
      $updatelink = "updatecat";
       include "containers/list.php";
    }
  

}
