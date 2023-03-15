<?php

$Route = new  JX_Route();

$urls = $Url->get_paths();




$Route->Get("blogs",function (){
    $bg = new blog();

    $bg->main();
});


if(count($urls) > 1){
    $service = $urls[0];
    if(class_exists($service)){
        $ns = new $service();
        if($ns->is_multi_Url()){
            $ns->main();
        }else{
            echo "unknown service";
        }
    }
}else{

    $Route->index();
    
}

// $Route->Get_multi("count",function (){
//     //include "containers/cam.php";
//     global $urls;
//     echo count($urls);
// });

$Route->Get("demo",function (){
    include "containers/cam.php";
});






