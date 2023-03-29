<?php



if($program == "AddService"){
     echo "\nOpening AddService Program ...";
    if($service_path !== null){

        $output =  <<<END

class $service_name extends JX_Serivce implements JX_service{
    public function main(){
        
        include "Apps/$service_path/containers/$service_name.php";

    }

    
}


END;

        echo "\nadded $service_name in $service_path";
        $handle = fopen("Apps/$service_path/service.php", "a+");
        $handle2 = fopen("Apps/$service_path/containers/$service_name.php", "a+");
        fwrite($handle, $output);

        echo "\nService was Created sucess in $service_path/services";
        echo "\n$service_name 's Container was Created sucess in $service_path/containers";

    }else{
        $output =  <<<END
        <?php
        class $service_name extends JX_Serivce implements JX_service{
            public function main(){
                
                include "containers/$service_name.php";
        
            }
        
            
        }
        
        
        END;
        
                echo "\nadded $service_name in Service Directory";
                $handle = fopen("serivces/$service_name.php", "a+");
                $handle2 = fopen("containers/$service_name.php", "a+");
                fwrite($handle, $output);
                fwrite($handle2, "This is Your $service_name's Container \nBuild Something Amazing Here");
        
                echo "\nService was Created sucess in $service_path/services";
                echo "\n$service_name 's Container was Created sucess in $service_path/containers";
                
    }
}else{
    // echo "Program not found \n". $argv[2];
}
