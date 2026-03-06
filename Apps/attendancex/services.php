<?php
class attendancex extends JX_Serivce implements JX_service{
    public function main(){
        
        include "Apps/attendancex/containers/dashboard.php";

    }

    
}

class atlogin extends JX_Serivce implements JX_service{
    public function main(){
        
        include "Apps/attendancex/containers/login.php";

    }

    
}

class atreg extends JX_Serivce implements JX_service{
    public function main(){
        
        include "Apps/attendancex/containers/signup.php";

    }

    
}


