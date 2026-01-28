<?php
class Platform{
    private function get_option($name){
        global $JX_db;
        $sql = "SELECT *FROM `options` WHERE `name` = '$name'";
        $re = $JX_db->query($sql);

        return $re;

    }
    
}

