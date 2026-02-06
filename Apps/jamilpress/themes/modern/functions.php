<?php

function getPosts(){
    global $BLOG_URL, $JX_db;
    
    $sql = "SELECT *FROM `posts` WHERE `type`='post' AND `blog`= '$BLOG_URL'";

    return $JX_db->query($sql);
    
}
function getPosts2($url){
    global $BLOG_URL, $JX_db;
    
    $sql = "SELECT *FROM `posts` WHERE `type`='post' AND `blog`= '$url'";

    return $JX_db->query($sql);
    
}

function searchPosts($q){
    global $BLOG_URL, $JX_db;
    
    $sql = "SELECT *FROM `posts` WHERE `title` LIKE '%$q%'  AND `type`='post' AND `blog`= '$BLOG_URL'";

    return $JX_db->query($sql);
    
}
