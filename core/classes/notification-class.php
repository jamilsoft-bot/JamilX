<?php


class JX_Notification{
    private $list = [];

    public function __construct()
    {
        $this->list = [
            "samples",
            "sample 2"
        ];
    }
    public function add($item = ""){
        $this->list[] = $item;
    }

    public function getlist(){
        return $this->list;
    }
}

