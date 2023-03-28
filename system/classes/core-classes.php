<?php
interface JX_PrototypeI{
    public function createTable();
    public function delete();
    public function read();
    public function create();
    public function insert();
}
class JX_Prototype{
    private $name,$fields;
    public function __construct($_name){
        $this->name = $_name;
    }

    public function setfields($_fields){
        
    }
    
    public function createTable($fields){

        if(Create_db_table($fields,$this->name)){
            return true;
        }else{
            return false;
        }
    }
}
interface JX_service{
    public function main();
    }

interface JX_serviceI{
    public function main();
    }
class JX_Serivce{
    private $title;

    public function setTitle($text = ''){
        $this->title = $text;
    }

    public function getTitle(){
        return $this->title;
    }

    public function is_multi_Url(){
        return false;
    }

    public function commingsoon(){
        echo "<h1>Action Comming Soon!</h1>";
    }
}

interface JX_ActionI{
    public function getTitle();
    public function getAction();
    public function getText();
}

class JX_Action{
    protected $title, $text;

    public function setTitle($text = ''){
        $this->title = $text;
    }
    public function addAction(){}

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

