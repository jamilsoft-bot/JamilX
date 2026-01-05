<?php
function is_able(){
    global $Url;
    $paths = $Url->get_paths();
   if(isset($paths['1'])){
       if(isset($paths[2])){
           return "../..";
       }else{
        return "..";
       }
   }
}
function get_main_styles(){
    $asset = is_able();
    echo  "<link href='$asset/assets/css/style.css' rel='stylesheet'>\n";
    echo  "<link href='$asset/assets/css/w3-colors-flat.css' rel='stylesheet'>\n";

   // echo  "<script src='assets/js/choices.js'></script>\n";
    echo  "<link href='$asset/assets/sum/summernote-lite.css' rel='stylesheet'>\n";
   
   echo  "<link href='$asset/assets/css/bootstrap.css' rel='stylesheet'>\n";
    echo  "<link href='$asset/assets/css/w3.css' rel='stylesheet'>\n";
    //echo  "<link href='../assets2/style.css' rel='stylesheet'>\n";
    echo  "<link href='$asset/assets/font/css/all.css' rel='stylesheet'>\n";

}

function admin_styles(){
    global $Url;
    
    $about = $Url->get('serve');
    
    if($about == 'admin'){
        echo "<link href='containers/admin/assets/libs/flot/css/float-chart.css' rel='stylesheet' />";
        echo"<link href='containers/admin/dist/css/style.min.css' rel='stylesheet' />";
    
        }
       
    
    }

function admin_scripts(){
    global $Url;

$about = $Url->get('serve');

if($about == 'business'){
    echo "<script async defer src='containers/business/assets/js/buttons.js'></script>";
    echo "<script src='containers/business/assets/js/material-dashboard.min.js'></script>";
}
}

function bus_scripts(){
    global $Url;

$about = $Url->get('serve');

if($about == 'business'){
    echo "<script async defer src='containers/business/assets/js/buttons.js'></script>";
    echo "<script src='containers/business/assets/js/material-dashboard.min.js'></script>";
}
}

function bus_styles(){
    global $Url;
    
    $about = $Url->get('serve');
    
    if($about == 'business'){
        echo "<link href='containers/business/assets/css/nucleo-icons.css' rel='stylesheet' />";
        echo "<link href='containers/business/assets/css/nucleo-svg.css' rel='stylesheet' />";
         echo  "<script src='https://kit.fontawesome.com/42d5adcbca.js' crossorigin='anonymous'></script>";
          echo "<link href='https://fonts.googleapis.com/icon?family=Material+Icons+Round' rel='stylesheet'>";
          echo "<link id='pagestyle' href='containers/business/assets/css/material-dashboard.css' rel='stylesheet' />";
    }
       
    
    }

function about_scripts(){
    global $Url;

$about = $Url->get('serve');

if($about == 'about'){
    echo "<script src='containers/about/assets/vendor/aos/aos.js'></script>";
    echo "<script src='containers/about/assets/vendor/bootstrap/js/bootstrap.bundle.min.js'></script>";
    echo "<script src='containers/about/assets/vendor/glightbox/js/glightbox.min.js'></script>";
    echo "<script src='containers/about/assets/vendor/isotope-layout/isotope.pkgd.min.js'></script>";
    echo "<script src='containers/about/assets/vendor/swiper/swiper-bundle.min.js'></script>";
    echo "<script src='containers/about/assets/vendor/php-email-form/validate.js'></script>";
    echo "<script src='containers/about/assets/js/main.js'></script>";
}
}
function about_styles(){
global $Url;

$about = $Url->get('serve');

if($about == 'about'){
    echo "<link href='containers/about/assets/vendor/aos/aos.css' rel='stylesheet'>";
    echo "<link href='containers/about/assets/vendor/bootstrap/css/bootstrap.min.css' rel='stylesheet'>";
    echo "<link href='containers/about/assets/vendor/bootstrap-icons/bootstrap-icons.css' rel='stylesheet'>";
    echo "<link href='containers/about/assets/vendor/boxicons/css/boxicons.min.css' rel='stylesheet'>";
    echo "<link href='containers/about/assets/vendor/glightbox/css/glightbox.min.css' rel='stylesheet'>";
    echo "<link href='containers/about/assets/vendor/swiper/swiper-bundle.min.css' rel='stylesheet'>";
    echo "<link href='containers/about/assets/css/style.css' rel='stylesheet'>";
}
   

}

function get_main_scripts(){

    echo  "<script src='assets/jq/jq.js'></script>\n";
    echo  "<script src='assets/js/countries.js'></script>\n";

     echo  "<script src='assets/js/bootstrap.js'></script>\n";
     //echo  "<link href='../assets2/style.css' rel='stylesheet'>\n";
     
    
     echo  "<script src='assets/js/bootstrap.bundle.js'></script>\n";
     echo  "<script src='assets/js/popper.js'></script>\n";
 }
 function UploadpostImage($file){
    if(check_avatar($file)){
         
       // $path = get_dir($file);
        $path = "images";
        $uploaddir = "data/";
        $fname = $file['name'];
         
 $uploadfile = $uploaddir . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
        return "$uploadfile.";
    } else {
        return true;
    }

    }else{
        return false;
    }
}

function UploadFile($file){
    if(check_avatar($file)){
         
       // $path = get_dir($file);
        $path = "images";
        $uploaddir = 'data/' . $path . "/";
        $fname = $file['name'];
         
 $uploadfile = $uploaddir . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
        return "$uploadfile.";
    } else {
        return true;
    }

    }else{
        return false;
    }
}

function check_avatar($file){
    if ($file !== null) {
    $FileType = $file['type'];
    $csv = str_replace("/",",",$FileType);
    $ftype = str_getcsv($csv);
    $final = $ftype[0];
    if ( $final == "image") {
        return true;
    }else{
        return false;
    }
    }else{
        return false;
    }
    
}

function get_dir($file){
    $dirtype = "";
         $FileType = $_FILES[$file]['type'];
         $csv = str_replace("/",",",$FileType);
         $ftype = str_getcsv($csv);
        $f = $ftype[0];
        $t = $ftype[1];
         switch ($f) {
             case 'image':
                 global $dirtype;
                 $dirtype = "images";
                 break;
            case 'video':
            global $dirtype;
            $dirtype = "videos";
            break;
            
                
            
                
             
             default:
             global $dirtype;
             $dirtype = "others";
             break;
                 break;
         }

         return $dirtype;
}