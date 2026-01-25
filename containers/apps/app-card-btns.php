<?php
$install =  "<a href='?action=applist&install=$appdir' class='inline-flex items-center justify-center rounded-md px-2 py-1 text-gray-600 transition hover:bg-blue-50 hover:text-blue-600'> <i class='fa fa-plus-circle '></i></a>";
$active =  "<a href='#' class='inline-flex items-center justify-center rounded-md px-2 py-1 text-red-600'> <i class='fa fa-check-double'></i></a>";
$view = "<a href='?action=applist&view=$appdir' class='inline-flex items-center justify-center rounded-md px-2 py-1 text-gray-600 transition hover:bg-blue-50 hover:text-blue-600'>  <i class='fa fa-eye '></i></a>";
$delete = "<a href='?action=applist&uninstall=$appdir' class='inline-flex items-center justify-center rounded-md px-2 py-1 text-gray-600 transition hover:bg-blue-50 hover:text-blue-600'> <i class='fa fa-archive '></i></a>";
    
if($Apps->installed($appdir)){
    echo $active;
    echo $view;
    echo $delete;
}else{
    echo $install;
    
    echo $view;
   // echo $delete;
}
