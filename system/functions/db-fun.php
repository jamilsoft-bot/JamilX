<?php
function JXdb_insert($tableName,$names,$values){
    global $JX_db;
    $sql = "INSERT INTO `$tableName`($names)VALUES($values)";
    if($JX_db->query($sql)){
        return true;
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
    $sql = "CREATE TABLE `$name`(id int(11) PRIMARY KEY AUTO_INCREMENT, $fields )";
    if($JX_db->query($sql)){
      return true;
    }else{
      return $JX_db->error;
    }
  }
  function JXdb_deleteRow($id,$tableName){
    global $JX_db;
    $sql = "DELETE FROM `".$tableName."` WHERE `id` = '".$id."'";
    if($JX_db->query($sql)){
      return true;
    }
  }