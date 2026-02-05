<?php

class view{
    public function getpage($id){
        echo "get single page";
    }

    public function getpost($id){
        $post = new JP_Post($id);
        include "single.php";
    }

    public function getcat($id){
        echo "get single category";
    }
}