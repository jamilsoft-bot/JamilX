<?php
    // if(isset($_SESSION['uid'])){

    // }else{
    //     global $logged_areas, $Url;
    //     foreach($logged_areas as $rpage){
    //         if($Url->get('serve') == $rpage){
    //             echo "<script>";
    //             echo "location.assign('login?resume=$rpage')";
    //             echo "</script>";
    //         }
    //     }
    // }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php global $b; echo $b->getTitle();?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="title" content="Jamilsoft Business Solution">
        <meta name="description" content="Online Business Solution">
        <meta name="keywords" content="Business,Marketing,Jamilsoft,Online">
        <meta name="author" content="Muhammad Jamil">
        <?php
        global $b; //echo $b->getMeta()."\n";
        $uri = isset($_GET['serve'])?$_GET['serve']:null;
        
        if($uri == null | $uri == "index"){
     echo  "<link href='assets/css/search.css' rel='stylesheet'>\n";

        }else{
            get_main_styles();
           // admin_styles();
            about_styles();
            //bus_styles();
        }

        ?>
        
        <link rel='shortcut icon'  href='assets/images/lg.png'>
        <?php js_head();?>
    </head>

<body>