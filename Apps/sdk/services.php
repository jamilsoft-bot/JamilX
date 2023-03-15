<?php

class sdk extends JX_Serivce implements JX_service{
    public function main(){
        
        include "main.php";

    }

    
}



class sdkservice extends JX_Serivce implements JX_service{
    public function main(){
        include "containers/service-sample.php";
    }
}
