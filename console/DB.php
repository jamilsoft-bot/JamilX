<?php

if($program == "DB:Make"){
    echo "Welcome to Database Wizard";
    if($service_name == "table"){
        echo "\n\n";
        $name = readline("Type your table name:  ");
        echo "\n\n";
        $fields = readline("Type your column names e.g usernames varchar(20). ( seprate each field with comma):  ");
        if(Create_db_table($fields,$name)){
            echo "\n$name table was created ";
        }else{
        }
    }
}

if($program == "DB:Insert"){
    echo "Welcome to Database Wizard";
    if($service_name !== null){
        echo "\n\n";
        $names = readline("Type field names(seprated by comma):  ");
        echo "\n\n";
        echo "\n\n";
        $values = readline("Type field values respectively(seprated by comma):  ");
        echo "\n\n";
        if(JXdb_insert($service_name,$names,$values)){
            echo "Record inserted";
        }
    }

}