<?php include "classes.php"?>
<?php include "functions.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $blog->getName();?></title>
    <link rel="stylesheet" href="../Apps/jamilpress/assets/lib/bs5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Apps/jamilpress/assets/lib/font/css/all.css">
    <link rel="stylesheet" href="../Apps/jamilpress/assets/lib/w3/w3.css">
    <link rel="stylesheet" href="../Apps/jamilpress/assets/lib/sum/summernote-lite.css">
    
</head>
<body>
<div class="w3-container w3-bar w3-blue w3-large">
    <a href="" class="w3-bar-item " style="text-decoration: none;font-weight: bold;">Logo</a>
    <div class="d-flex flex-row justify-content-center">
        <a href="" class="w3-bar-item w3-button">Home </a>
        <a href="" class="w3-bar-item w3-button">Posts </a>
        <a href="" class="w3-bar-item w3-button">About us</a>
        <a href="" class="w3-bar-item w3-button">Contact us</a>
    </div>
</div>

<div class="w3-container  w3-margin-top">
    <div class="row ">
        <div class="col-md-1 ">
            <a href="<?php global $BLOG_URL;echo $BLOG_URL;?>">
            <img src="<?php
            $logo = $blog->getImage();
                        if($logo == null){
                            echo "../Apps/jamilpress/assets/images/jslogobird.png";
                        }else{
                            echo "../data/$logo";
                        }
                        //echo $logo;
                        
                        ?>" style="width: 100pt;height: 100pt;">
            </a>
        </div>
        <div class=" w3-margin-left col-md-10">
            <h2><?php echo $blog->getName();?></h2>
            <h4><?php echo $blog->getSummary();?></h4>
            <p style="font-style: italic;">Created by <?php echo $blog->getAuthor();?></p>
            <!-- <i class="fa fa-info"></i><i class="fa fa-reply"></i> -->
        </div>
    </div>
    <hr>
</div>
<!-- <div class="w3-container">
    <div class="w3-bar d-inline-flex justify-content-center ">
        <div class="">
            <a href="#" class="w3-bar-item" >Home</a>
            <div class="w3-dropdown-hover">
                <a href="#"class="w3-button w3-hover-none" style="text-decoration: underline;">Categories</a>
                <div class="w3-dropdown-content w3-bar-block w3-border">
                  <a href="#" class="w3-bar-item ">Link 1</a>
                  <a href="#" class="w3-bar-item">Link 2</a>
                  <a href="#" class="w3-bar-item ">Link 3</a>
                </div>
              </div>
            <a href="#" class="w3-bar-item" >Page 2</a>
            <a href="#" class="w3-bar-item" >About</a>
            <a href="#" class="w3-bar-item" >Contact</a>
        </div>
    </div>
</div> -->
<?php
if(isset($_GET['view'])){
include "view.php";
}else{
    include "main.php";
}
?>
<div class="w3-container w3-center w3-margin-top">
    <p class="w3-opacity">Proudly Created By Jamilsoft &copy;Microteams 2021</p>
</div>
<script src="../Apps/jamilpress/assets/lib/w3/w3.js"></script>
</body>
</html>