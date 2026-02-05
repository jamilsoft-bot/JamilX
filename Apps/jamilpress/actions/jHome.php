<?php

class jHome extends JP_Action implements JXP_Action{
   private $blog;
   public function __construct()
   {
     $this->setTitle("Jamilpress");
     if(isset($_SESSION['blog'])){
      $this->blog = $_SESSION['blog'];
      $this->setText("Manage  $this->blog");
     }else{
      $this->setText("Choose Your Blog");
      $this->blog = null;
     }
     
   }
   public function main(){
      include "containers/main.php";
   }

   public function getAction(){
       if($this->blog !== null){
         include "containers/menu.php";
          include "containers/quickstats.php";
         
       }else{
         $plist = new JP_Bloglist();
         include "containers/blog-list.php";

       }
    }
  

}
