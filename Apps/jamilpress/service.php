<?php

class jamilpress extends JX_Serivce implements JX_service{
    public function __construct()
    {
        
    }
    public function main(){
       if(!isset($_SESSION['uid'])){
            $message = "You ware not logged, please <a href='login'>login</a> to continue";
            $linkback = "login";
            include "containers/errorpage.php";
       }else{
         include "containers/main.php";
       }
    }

    public function postlist(){
        $post = new JP_Postlist();
        echo $post->getNames()[0];
     }

}
class Jp extends JX_Serivce implements JX_service{
   public function __construct()
   {
       
   }
   public function main(){
     echo "welcome to api center";
   }

   public function is_multi_Url()
   {
      return true;
   }

}
