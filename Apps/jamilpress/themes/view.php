<?php
$view = new view();

$gview = $_GET['view'];

switch ($gview) {
    case 'post':

    $view->getpost($_GET['id']);
        break;
    case 'page':
        $view->getpage(12);
        break;
    case 'cat':
        $view->getcat(12);
        break;
    
    default:
        echo "Unkown View";
        break;
}
