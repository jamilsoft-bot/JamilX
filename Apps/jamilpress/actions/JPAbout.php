<?php

class JPAbout extends JP_Action implements JXP_Action{
   public function __construct()
   {
     $this->setTitle("Jamilpress");
     $this->setText("Free CMS Tool for Jamilsoft");
   }
   public function main(){
      include "containers/about.php";
   }
   public function getAction(){
      include "containers/about.php";
    }
}
