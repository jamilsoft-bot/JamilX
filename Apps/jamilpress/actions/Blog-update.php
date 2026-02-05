<?php
class Updateblog extends JP_Action implements JXP_Action{
    private $passed, $nameError,$urlError,$contentError,$stepper=[], $summaryError,$logoError,$catError;
    public function __construct()
    {
        global $BLOG_NAME;
      $this->setTitle("Update");
      $this->setText($BLOG_NAME);
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
            $update = true;
        echo "<form action='' enctype='multipart/form-data' method='post'>";
        include "Apps/jamilpress/containers/blog-add.php";
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
         $x = null;
         $y = null;
            if(empty($_POST['summary'])){
                $this->summaryError = "Blog Summary cannot be Empty";
                $this->passed = false;
                $x = 1;
            }else{
                $this->passed = true;
            }
            if(empty($_POST['content'])){
                $this->contentError = "Blog Details cannot be Empty";
                $this->passed = false;
                $y = 1;
            }else{
                $this->passed = true;
            }
            if($x == null && $y == null){
                unset($this->stepper['empty']);
            }
        
     }
     private function uploadimage(){
         if(UploadpostImage($_FILES['logo'])){
             return $_FILES['logo']['name'];
         }else{
           return  null;
         }
     }
     private function process(){
         global $JX_db, $BLOG_OWNER,$BLOG_AUTHOR,$BLOG_ID;
            $name = $_POST['title'];
            $content = $_POST['content'];
            $summary = $_POST['summary'];
            $cat = $_POST['cat'];
            $keywords = $_POST['keywords'];
            $url = $_POST['url'];
            $owner = $BLOG_OWNER;
            $author = $BLOG_AUTHOR;
            $logo = $this->uploadimage();
            if($logo !== null){
                $sql = "UPDATE `blogs` SET `logo`='$logo',`url`='$url',`keywords`='$keywords',`summary`='$summary',`category`='$cat', `name`='$name',`description`='$content' WHERE `id`=$BLOG_ID";
                if($JX_db->query($sql)){
                    JP_Alert("Blog Alert","Your Blog was Successfully Update","light-blue");
                }else{
                    JP_Alert("Blog Alert","We cannot Update your blog at the right moment please try again later","light-blue");
                }
            }
     }
     private function getData(){
            if(isset($_POST['create'])){
                global $BLOG_URL;
                $this->checkempty();
                if($BLOG_URL == $_POST['url']){
                        unset($this->stepper['url']);
                }else{
                    $this->checkurl();
                }
                $this->checkcat();
                $steps = count($this->stepper);
                if($steps == 0){
                    $this->process();
                }
            }
     }

     private function fetchData(){
         
     }
 }