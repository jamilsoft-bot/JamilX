<?php

$action = isset($_GET['action'])?$_GET['action']:null;
$del = isset($r['id'])?$r['id']:null;
$draftlink = "?action=$action&filter=draft";
$publink = "?action=$action&confirm=0&id=$del";
$trashlink = "?action=postlist&del=$del";
$newlink = null;

?>

    <a href="<?php echo $publink;?>" class=" w3-bar-item "><i class="fa fa-check"></i></a>
    <!-- <a href="<?php echo $trashlink;?>" class=" w3-bar-item "><i class="fa fa-trash w3-margin-right"></i></a> -->
