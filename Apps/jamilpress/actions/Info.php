<?php

class Info extends JP_Action implements JXP_Action{
   public function __construct()
   {
      global $BLOG_NAME,$BLOG_SUM;
     $this->setTitle("About ");
     $this->setText($BLOG_NAME);
   }
   public function main(){
      include "containers/about.php";
   }
   public function getAction(){
      include "containers/blog-info.php";
    }
}
