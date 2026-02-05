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
     // include "containers/main.php";
     echo "welcome to api center";
   }

   public function is_multi_Url()
   {
      return true;
   }

}

class Postlist extends JP_Action implements JXP_Action{
   private $filter;
    public function __construct()
    {
      $this->filter = isset($_GET['filter'])?$_GET['filter']:null;
        $this->setTitle("Post List");
        $this->setText("Manage Your Posts");
    }
    public function main(){
       include "containers/main.php";
    }

    public function getAction(){
       delete_item('posts');
       if($this->filter !== null){
         $plist = new JP_Postlist($this->filter);
         $updatelink = "updatepost";
         include "containers/list.php";
       }else{
         $plist = new JP_Postlist();
         $updatelink = "updatepost";
         include "containers/list.php";
       }
        
     }

}

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
         // $customBtn = JP_listBtns([
         //    JP_NavBtn("#","","fa fa-eye"),
         //    JP_NavBtn("#","","fa fa-trash")
         // ]);
            $updatelink = null;
         include "containers/list.php";
      }else{
         
         
         JP_Alert("Record Not Found","Please Select Post to View its Comment list");
      }
       
    }

}

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
         // $customBtn = JP_listBtns([
         //    JP_NavBtn("?action=updatepage&id$id","","fa fa-edit"),
         //    JP_NavBtn("#","","fa fa-trash")
         // ]);
         $updatelink = "updatepage";
         include "containers/list.php";
       }else{
         // $customBtn = JP_listBtns([
         //    JP_NavBtn("?action=updatepage&id$id","","fa fa-edit"),
         //    JP_NavBtn("#","","fa fa-trash")
         // ]);
         $plist = new JP_Pagelist();
         $updatelink = "updatepage";
         include "containers/list.php";
       }
        
     }
   

}

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
      //  $customBtn = JP_listBtns([
      //    JP_NavBtn("#","","fa fa-eye"),
      //    JP_NavBtn("#","","fa fa-trash")
      // ]);
      $updatelink = "updatecat";
       include "containers/list.php";
    }
  

}

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

// class Createcat extends JP_Action implements JXP_Action{
//    public function __construct()
//    {
//      $this->setTitle("Create Category");
//      $this->setText("Create new Category");
//    }
//    public function main(){
//       include "containers/main.php";
//    }
//    public function getAction(){
//        //include "containers/post-add.php";
//     }
// }



// class Createpage extends JP_Action implements JXP_Action{
//    public function __construct()
//    {
//      $this->setTitle("Create Page");
//      $this->setText("Page creation Form");
//    }
//    public function main(){
//       include "containers/main.php";
//    }
//    public function getAction(){
//        include "containers/post-add.php";
//     }
// }

class Stats extends JP_Action implements JXP_Action{
   public function __construct()
   {
      global $BLOG_NAME;
     $this->setTitle("Statistics");
     $this->setText($BLOG_NAME." Analysis");
   }
   public function main(){
     // include "containers/main.php";
   }
   public function getAction(){
       include "containers/blog-stats.php";
    }
}


// class Session extends JP_Action implements JXP_Action{
//    public function __construct()
//    {
//      $this->setTitle("Category List");
//      $this->setText("Manage Your Categories");
//    }
//    public function main(){
//       include "containers/main.php";
//    }

//    public function getAction(){
//        echo "session area";
//     }
  

// }