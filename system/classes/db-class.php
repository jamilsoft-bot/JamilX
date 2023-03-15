<?php

class JX_Database extends mysqli{
    function __construct(){
        global $DB_Data;
       parent::__construct($DB_Data['DB_Host'],$DB_Data['DB_User'],$DB_Data['DB_Pass'],$DB_Data['DB_Name']);
   }
}
class JS_Database{
    public $message, $Host, $User, $Pass, $Name;
    public $DB,$DBError;
    public function Open()
    {
        //parent::__construct($this->Host,$this->User,$this->Pass,$this->Name);
       $this->DB = new mysqli($this->Host,$this->User,$this->Pass,$this->Name) ;
       $this->DBError = $this->DB->error;
    }
    

    
    public function Query($sql)
    {
        return $this->DB->query($sql);
    }
}

class JX_Record{
    private $_table;
    public function set_table($table){
        $this->_table = $table;
    }
    private function get_record(){

    }
}

class JS_Table{
    public $Name;

    public function Create($fields,$name){
        $sql = "CREATE TABLE `".$name."`(".$fields .")";
        return $sql;
    }
}