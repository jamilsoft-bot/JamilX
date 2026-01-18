<?php
class AppData{
    private $appnick;
    public function __construct($_appnick){
        $this->appnick = $_appnick;
    }
    public function createdr(){
        $appnick = $this->appnick;
        try {
            mkdir("Apps/$appnick");
            mkdir("Apps/$appnick/classes");
            mkdir("Apps/$appnick/services");
            mkdir("Apps/$appnick/assets");
            mkdir("Apps/$appnick/containers");
            mkdir("Apps/$appnick/ext");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function createData(){
        $appnick = $this->appnick;
        $mainservice =  <<<END
        <?php
        class $appnick extends JX_Serivce implements JX_service{
            public function main(){
                
                include "Apps/$appnick/containers/$appnick.php";
        
            }
        
            
        }
        
        
        END;

        file_put_contents("Apps/$appnick/services.php",$mainservice);

        $mainaction =  <<<END
        <?php
        class {$appnick}home extends JX_Action implements JX_ActionI{
            public function getAction()
            {
                include "Apps/$appnick/containers/$appnick.php";
            }
        
            public function addAction()
            {
        
                include "Apps/$appnick/containers/$appnick.php";
            }
        
        }
        
        END;

        file_put_contents("Apps/$appnick/services/home.php",$mainaction);

        $global =  <<<END
        <?php
        \$classes = scandir("Apps/$appnick/classes/");
        unset(\$classes[0]);
        unset(\$classes[1]);

        foreach(\$classes as \$gets){
            include "classes/\$gets";
        }

        \$services = scandir("Apps/$appnick/services/");
        unset(\$services[0]);
        unset(\$services[1]);

        foreach(\$services as \$gets){
            include "classes/\$gets";
        }
        
        
        END;
        file_put_contents("Apps/$appnick/global.php",$global);

        $mainfile =  <<<END
        <?php
            include "global.php";
            include "services.php";
        
        
        END;
        file_put_contents("Apps/$appnick/$appnick.php",$mainfile);
    }
}