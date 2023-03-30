<?php
function JXdb_insert($tableName,$names,$values){
    global $JX_db;
    $sql = "INSERT INTO `$tableName`($names)VALUES($values)";
    if($JX_db->query($sql)){
        return true;
    }else{
      error_log("\n".$JX_db->error , 3, "logs/db-error.log");
    }
}

function JXdb_readRow($tableName,$id){
    global $JX_db;
    $sql ="SELECT *FROM `$tableName` WHERE `id`=$id";
    return $JX_db->query($sql);
}

function JXdb_readtable($tableName){
    global $JX_db;
    $sql ="SELECT *FROM `$tableName`";
    return $JX_db->query($sql);
}
function Create_db_table($fields,$name){
    global $JX_db;
    $sql = "CREATE TABLE `$name`(id int(11) PRIMARY KEY AUTO_INCREMENT, $fields, `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP )";
    if($JX_db->query($sql)){
      return true;
    }else{
      error_log("\n".$JX_db->error , 3, "logs/db-error.log");
    }
  }
  function JXdb_deleteRow($id,$tableName){
    global $JX_db;
    $sql = "DELETE FROM `".$tableName."` WHERE `id` = '".$id."'";
    if($JX_db->query($sql)){
      return true;
    }else{
      error_log("\n".$JX_db->error , 3, "logs/db-error.log");
    }
  }