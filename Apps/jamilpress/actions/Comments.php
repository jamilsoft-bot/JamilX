<?php

class Comments extends JP_Action implements JXP_Action{
   private $post_id;
   public function __construct()
   {  $this->post_id = isset($_GET['postid'])?$_GET['postid']:null;
      $ps = new JP_Post($this->post_id);
      $text =$ps->getName();
       $this->setTitle("Comment List <br>Post:");
       $this->setText($text);
   }
   public function main(){
      include "containers/main.php";
   }

   public function getAction(){
      if($this->post_id !== null){
         $plist = new JP_CommentList($this->post_id);
            $updatelink = null;
         include "containers/list.php";
      }else{
         JP_Alert("Record Not Found","Please Select Post to View its Comment list");
      }
       
    }

}
