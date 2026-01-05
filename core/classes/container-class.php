<?php

class JS_Container
{
    public function welcome()
    {
        $pg = new JS_Pages();
        $f = get_class($this);
        echo $pg->h1("welcome to  the main page of ". $f);
        echo $pg->h1("Class Url: ".$this->Get_base_url());
    }

    public function Get_base_url()
    {
        $sys = new JS_system();
        return  $sys->get_cur_url();
    }
    public function help()
    {
        $pg = new JS_Pages();
        $f = get_class($this);
        echo $pg->h1("welcome to the help page of ". $f);
    }

    public function error($text)
    {
        $pg = new JS_Pages();
        //$f = get_class($this);
        echo $pg->h1($text);
    }
}



?>