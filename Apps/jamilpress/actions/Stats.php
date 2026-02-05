<?php

class Stats extends JP_Action implements JXP_Action{
   public function __construct()
   {
      global $BLOG_NAME;
     $this->setTitle("Statistics");
     $this->setText($BLOG_NAME." Analysis");
   }
   public function main(){
   }
   public function getAction(){
       include "containers/blog-stats.php";
    }
}
