<h1>Comments List</h1>
<?php

global $JX_db, $Url;

$id = $_GET['id'];

$sql = "SELECT *FROM `comments` WHERE `post_id` = $id";

$resultx = $JX_db->query($sql);

if($resultx){
    foreach($resultx as $rx){
        $author = $rx['author'];
        $message = $rx['message'];
        $date = get_default_date($rx['date']);
        $email = $rx['email'];
        include "comment-card.php";
    }
}else{
    echo $JX_db->error;
}




?>
<div style="width: 70%;">
<?php include "comment-form.php";?>
</div>
