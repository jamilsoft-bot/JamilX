<?php

interface JXP_Action{
    public function main();
    
    public function getTitle();
    public function getAction();
    public function getText();
}

class JP_Action{
    protected $title, $text;

    public function setTitle($text = ''){
        $this->title = $text;
    }

    public function getText(){
        return $this->text;
    }
    public function setText($text = ''){
        $this->text = $text;
    }

    public function getTitle(){
        return $this->title;
    }

    public function commingsoon(){
        echo "<h1>Action Comming Soon!</h1>";
    }
}