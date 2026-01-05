<?php

class Public_App{
    private $is_public = false;

    public function is_public(){
        return $this->is_public = true;
    
    }

    public function help(){
       echo "this is your app public interface";
    }

}
