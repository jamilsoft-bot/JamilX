<?php

$Route = new  JX_Route();

$urls = $Url->get_paths();



if(count($urls) > 1){
    $service = $urls[0];
    if ($service === 'admin' && isset($urls[1]) && $urls[1] === 'blog') {
        $service = 'blog';
    }
    if(class_exists($service)){
        $ns = new $service();
        if($ns->is_multi_Url()){
            $ns->main();
        }else{
            $ns->main();
        }
    }
}else{

    $Route->index();
    
}






