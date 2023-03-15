<?php


class business extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('Business Creation tool');
    }
    public function main(){
        //$SessionMe = $_SESSION['uid'];
        include('containers/bus/new.php');

       //echo "business";

       
    }

    public function  business_update($key,$value,$code){
        return $sql = "UPDATE `business` SET `$key`='$value'  WHERE code = '$code'";
     }

    public function getMeta(){
        
        echo "<meta name='description' content='Business Creation tool'>";

       

       
    }

}