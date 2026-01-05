<?php

class Apps{
    public $title = "App center";

    
    public function hidden(){
        global $Me;

        include "containers/app/main.php";
        

    }
    public function applist(){
        if(is_admin()){
            global $APP;
        $path = "Apps/";
        $aps = scandir($path);
        unset($aps[0]);
        unset($aps[1]);
        $status = [
            "icon" => "",
            "link" => "",
        ];
        echo "<div class='w3-row'>";
        foreach($aps as $ap){
            $install_display_option = "";
            $uninstall_display_option = "display:none";
            $path = "Apps/$ap/conf.json";
            $info = json_decode(file_get_contents($path));
            $tags = str_getcsv($info->Tag);
            $appname = $ap;
            
            include "services/apps/applist.php";
        }

        echo "</div>";
       
            
        }else{
            echo "required admin access";
            
            
        }

        
   
    }

    public function installeds(){
        
        global $APP,$Apps;
        $aps = $Apps->Get_Installed_Apps();
        $status = [
            "icon" => "",
            "link" => "",
        ];
        echo "<div class='w3-row'>";
        foreach($aps as $ap){
            $install_display_option = "display:none";
            $uninstall_display_option = "";
            $app_name = $ap['app_name'];
            $appname = $ap['app_fullname'];
            $path = "Apps/".$app_name."/conf.json";
            $info = json_decode(file_get_contents($path));
            $tags = str_getcsv($info->Tag);
            
            include "services/apps/applist.php";
        }

        echo "</div>";
        
   
    }

    public function install(){
        global $Apps,$Url;
        $Apps->Install($Url->get('app'));
        //echo " i see you ".;
    }
    public function uninstall(){
        Global $Apps;
       if($Apps->Uninstall($_GET['app'])){
            echo $_GET['app'] . " was removed";
       }
    }
}