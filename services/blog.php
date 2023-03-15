<?php

class blog extends JX_Serivce implements JX_service{
    
    public function main(){
        global $Url, $JX_db;
        $blogs = $Url->get_paths();
        $blog = $Url->get('name');
        $action = $Url->get('action');
        $blogowner = null;
        $blogauthor = null;

        $slq = "SELECT *FROM `blogs` WHERE `url`='$blog'";

        $result = $JX_db->query($slq);

        if($result->num_rows < 1){
                return null;
        }else{

           
        $blogname = $blog;
       
        include("containers/blog/blog.php");

        }
        
        

    }

    public function contact(){
        global $Url, $JX_db;
        $blog = $Url->get('serve');
        $action = $Url->get('action');
        $blogowner = null;
        $blogauthor = null;

        $slq = "SELECT *FROM `blogs` WHERE `code`='$blog'";

        $result = $JX_db->query($slq);

        foreach($result as $r){
        // $blogname = $r['name'];
        // $blogdes = substr(strip_tags($r['description']),0,150). "...";
        // $bloglogo =  $r['logo'];
        $blogowner = $r['owner'];
        $blogauthor = $r['author'];
        }

        include("containers/blog/blog-contact-from.php");

    }

    public function about(){
        
        global $JX_db,$Url, $Me;
$getBlog = new JX_Blog();
$blogname = null;
$blogdes = null;
$bloglogo = null;
$blogauthor = null;
$blogowner = null;
$jsarg = $Url->get('serve');
$action = $Url->get('action');

$slq = "SELECT *FROM `blogs` WHERE `code`='$jsarg'";

$result = $JX_db->query($slq);

foreach($result as $r){
  $blogname = $r['name'];
  $blogdes = $r['description'];
  $bloglogo =  $r['logo'];
  $blogowner = $r['owner'];
  $blogauthor = $r['author'];
}

    echo "<h1> About $blogname</h1>";
    echo "<img src='data/$bloglogo' class='w3-round w3-margin' style='float:left;width:100%;height:300pt'>";
    echo $blogdes;

}

    public function home(){
        
        include("containers/posts/post-public-list.php");

    }

    public function posts(){
        $this->setTitle('Latest Posts');
        include("containers/posts/post-public-list.php");
    }

    public function postview($blogowner = null){
        $bowner = $blogowner;
        include("containers/posts/post-public-view.php");
    }

    public function offers(){
        $this->setTitle('Latest offers');
        include("containers/offer/offer-public-list.php");
    }

    public function offerview(){
        $this->setTitle('Latest offers');
        include("containers/offer/offer-public-view.php");
    }

    public function products(){
        $this->setTitle('Latest products');
        include("containers/product/product-public-list.php");
    }

    public function productview(){
        $this->setTitle('Latest products');
        include("containers/product/product-public-view.php");
    }

}