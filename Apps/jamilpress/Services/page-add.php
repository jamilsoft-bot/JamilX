<?php
class CreatePage extends JP_Action implements JXP_Action{
    private $passed, $nameError,$urlError,$contentError,$stepper=[], $summaryError,$logoError,$catError;
    public function __construct()
    {
        $this->setTitle("Create Page");
     $this->setText("Page creation Form");
      $this->passed = false;
      $this->stepper = [
          'empty' => false,
          'url' => false,
          'cat' => false
      ];
    }
    public function main(){
       include "containers/main.php";
    }
    public function getAction(){
        $this->getData();
        echo "<form action='' enctype='multipart/form-data' method='post'>";
        include "Apps/jamilpress/containers/post-add.php";
        echo "</form>";
     }

    private function checkurl(){
        $url = $_POST['url'];
        $blog = new JP_Blog($url);
        if($blog->check() == true){
            $this->urlError = "Blog Url is Already Taken";
            $this->passed = false;
        }else{
            $this->passed = true;
            unset($this->stepper['url']);
            }
        
    }
    private function checklogo(){

    }
    private function checkcat(){
        if(!isset($_POST['cat'])){
            $this->catError = "Category Should Selected";
            $this->passed = false;
        }else{
            $this->passed = true;
            unset($this->stepper['cat']);
        }
    }
     private function checkempty(){
         
            if(empty($_POST['content'])){
                $this->contentError = "post Content cannot be Empty";
                $this->passed = false;
                
            }else{
                // $this->passed = true;
                // unset($this->stepper['empty']);
                return true;
            }
            
        
     }
     private function uploadimage(){
         if(UploadpostImage($_FILES['image'])){
             return $_FILES['image']['name'];
         }else{
           return  null;
         }
     }
     private function process(){
         global $JX_db, $BLOG_OWNER,$BLOG_AUTHOR, $BLOG_URL;
            $name = $_POST['title'];
            $content = $_POST['content'];
            $summary = $_POST['summary'];
            $cat = $_POST['cat'];
            $keywords = $_POST['tags'];
            $privacy = $_POST['pri'];
            $status = $_POST['status'];
            $owner = $BLOG_OWNER;
            $author = $BLOG_AUTHOR;
            $logo = $this->uploadimage();
            if($logo !== null){
                $sql = "INSERT INTO `posts`(`title`,`type`,`cat`,`owner`,`author`,`content`,`summary`,`keywords`,`privacy`,`status`,`image`,`blog`)VALUES('$name','page','$cat','$owner','$author','$content','$summary','$keywords','$privacy','$status','$logo','$BLOG_URL')";
                if($JX_db->query($sql)){
                    JP_Alert("Blog Alert","Your Page was Successfully Created","light-blue");
                }else{
                    JP_Alert("Blog Alert","We cannot create your Page at the right moment please try again later","light-blue");
                }
            }
     }
     private function getData(){
            if(isset($_POST['create'])){
               
                $steps = count($this->stepper);
                if(empty($_POST['content'])){
                    $this->contentError = "Post Content Cannot be empty";
                    
                   
                }else{
                    $this->process();
                }
               
            }
     }
 }