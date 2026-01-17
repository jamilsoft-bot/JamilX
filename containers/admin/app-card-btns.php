<?php
$install =  "<a href='?action=applist&install=$appdir' class='w3-bar-item w3-button '> <i class='fa fa-plus-circle '></i></a>";
$active =  "<a href='#' class='w3-bar-item w3-button w3-text-red'> <i class='fa fa-check-double'></i></a>";
$view = "<a href='?action=applist&view=$appdir' class='w3-bar-item w3-button '>  <i class='fa fa-eye '></i></a>";
$delete = "<a href='?action=applist&uninstall=$appdir' class='w3-bar-item w3-button '> <i class='fa fa-archive '></i></a>";
    
if($Apps->installed($appdir)){
    echo $active;
    echo $view;
    echo $delete;
}else{
    echo $install;
    
    echo $view;
   // echo $delete;
}

