<?php

class JX_Database extends mysqli{
    function __construct(){ 
        $DB_Data  = parse_ini_file(".env");
       parent::__construct($DB_Data['DB_HOST'],$DB_Data['DB_USER'],$DB_Data['DB_PASS'],$DB_Data['DB_NAME']);
   }
}
class JS_Database{
    public $message, $Host, $User, $Pass, $Name;
    public $DB,$DBError;
    public function Open()
    {
        $DB_Data  = parse_ini_file(".env");
        //parent::__construct($this->Host,$this->User,$this->Pass,$this->Name);
       $this->DB = new mysqli($DB_Data['DB_HOST'],$DB_Data['DB_USER'],$DB_Data['DB_PASS'],$DB_Data['DB_NAME']) ;
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