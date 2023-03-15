<?php


class apptest extends JX_Serivce implements JX_service{
    public function main(){
        
        include "main.php";

    }

    
}

class appconsole extends JX_Serivce implements JX_service{
    public function main(){
        
      

        $application = new Application();

        // ... register commands

        $application->run();

    }

    
}



class appservice extends JX_Serivce implements JX_service{
    public function main(){
        include "containers/service-sample.php";
    }
}
