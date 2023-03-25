<?php
$program = isset($argv[1])?$argv[1]:null;
$service_name = isset($argv[2])?$argv[2]:null;
$service_path = isset($argv[3])?$argv[3]:null;


// echo "Program not found \n". $argv[1];




if($program == "AddAction"){
     echo "\nOpening AddAction Program ...";
    if($service_path !== null){

        $output =  <<<END
<?php
class $service_name extends JX_Action implements JX_ActionI{
    public function getAction()
    {
        include "Apps/$service_path/containers/$service_name.php";
    }

    public function addAction()
    {

        include "Apps/$service_path/containers/$service_name.php";
    }

}

END;

        echo "\nadded $service_name in $service_path";
        file_put_contents("Apps/$service_path/services/$service_name.php",$output);
        file_put_contents("Apps/$service_path/containers/$service_name.php","This is Your $service_name's Container \nBuild Something Amazing Here");
        echo "\nAction was Created sucess in $service_path/services";
        echo "\n$service_name 's Container was Created sucess in $service_path/containers";

    }else{
        $output =  <<<END
        <?php
        class $service_name extends JX_Action implements JX_ActionI{
            public function getAction()
            {
                include "containers/$service_name.php";
            }
        
            public function addAction()
            {
        
                include "containers/$service_name.php";
            }
        
        }
        
        END;
        echo "\nadded $service_name in Actions Directory";
        file_put_contents("actions/$service_name.php",$output);
        file_put_contents("containers/$service_name.php","This is Your $service_name's Container \nBuild Something Amazing Here");
        echo "\nAction was Created sucess in services Directory";
        echo "\n$service_name 's Container was Created sucess in containers Directory";
        
    }
}else{
    // echo "Program not found \n". $argv[2];
}
