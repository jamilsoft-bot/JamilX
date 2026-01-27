<?php 

class admin extends JX_Serivce implements JX_service{
    public function __construct()
    {
        global $Url;
        $this->setTitle($Url->get('serve') ." - ".$Url->get('action'));

        if(isset($_SESSION['uid'])){
        }else{
        echo "<script>";
        echo "location.assign('login&resume=admin')";
        echo "</script>";
        }
        
    }
    public function main(){
        global $Me;
        if($Me->role() == "admin"){
            include('containers/admin/admin.php');

        }else{
            $message = "You are not an Admin, please goto <a href='dashboard'>Dashboard</a> to continue";
            $linkback = "dashboard";
            include('containers/admin/errorpage.php');

        }
}

    

    public function viewbusiness(){
        global $JX_db, $Me, $Url;
        
        $code = $Url->get('b');
        
        
        if(isset($_POST['submit'])){
            $lg = $_FILES['logo'];
             $f = $lg['name'];
             $data = json_encode($_POST);
             $sql = business_update_with_logo($f,'data',$data,$code);
            
            if(UploadpostImage($lg)){
                if($JX_db->query($sql)){

                    echo "<div class='alert w3-green alert-dismissible fade show' role='alert'>";
                        echo "<strong>Business Alert!</strong> the Business was successfully updated.<br>";
                        echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                       echo "</div>";
                }else{
                    echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                        echo "<strong>Business Alert!</strong> ".$JX_db->error."<br>";
                        echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                       echo "</div>";
                }
            }else{
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                        echo "<strong>Business Alert!</strong> Image Was Not Upload<br>";
                        echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                       echo "</div>";
            }
        }
        
        include('containers/admin/view-bus.php');
        
    }
}

class home extends JX_Action implements JX_ActionI{
    public function getAction()
    {
        include "containers/admin/home.php";
    }

    public function addAction()
    {

        include "containers/admin/home.php";
    }


}



class updatecomp extends JX_Action implements JX_ActionI{
    public function getAction()
    {
        global $JX_db;
        $data = null;
        $data2 = null;
        //$sql2 = "INSERT INTO `options`(`name`,`value`)VALUES('cprofile','$data')";

        if(isset($_POST['submit'])){
            $data = json_encode($_POST);
            $sql2 = "UPDATE `options` SET `value`='$data' WHERE `name`='cprofile'";
            if($JX_db->query($sql2)){
                JX_Alert("Business Profile set");
            }else{
                // JX_Alert($JX_db->error);
               
            }
           
        }else{
            $sql1 =  "SELECT *FROM `options` WHERE `name`='cprofile'";
             $r = $JX_db->query($sql1);
                foreach($r as $t){
                    $data2 = $t['value'];
                }
        }
        $info = json_decode($data2);
        echo "<form action='' method='post'>";
        include('containers/admin/company.php');
        echo "</form>";
    }

    public function addAction()
    {

        include "containers/admin/home.php";
    }


}

class users extends JX_Action implements JX_ActionI{
    public function getAction()
    {
        $this->setTitle("User List");
        JX_delete_item('users');
        include('containers/admin/user-list.php'); 
    }

    

    public function addAction()
    {

        include "containers/admin/home.php";
    }


}

class applist extends JX_Action implements JX_ActionI{
    public function getAction()
    {
        global $JX_db, $Url, $Apps;
        $insall = $Url->get('install');
        $uninsall = $Url->get('uninstall');
        if($insall !== null){
          JX_Alert($Apps->Install($insall));
        }

        if($uninsall !== null){
            JX_Alert($Apps->Uninstall($uninsall));
          }
        include "containers/apps/app-list.php";
	//echo "am i here";
    }

    // public function applist(){
        
    // }

    public function addAction()
    {

        include "containers/admin/home.php";
    }


}

class createuser extends JX_Action implements JX_ActionI{
    public function getAction()
    {
         $users = new Userserve();
        if(isset($_POST['submit'])){
            $users->reg();
        }
        include('containers/admin/userform.php');
    
    }

    public function addAction()
    {

        include "containers/admin/home.php";
    }

    // public function createuser(){
       
    // }


}