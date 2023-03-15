<?php
class aboutjx extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('Business List');
    }
    public function main(){
        include "containers/about/aboutjx.php";
    }

}

class contactjx extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('Business List');
    }
    public function main(){
        include "containers/about/contactjx.php";
    }

}


// class demo extends JX_Serivce implements JX_service{
//     public function __construct()
//     {
//         $this->setTitle('Business List');
//     }
//     public function main(){
//         JX_get_container('sp.php');
//     }

// }
class dhome extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('Jamilsoft official Homepage');
    }
    public function main(){
        global $Url;

     $me = is_null($Url->get('action'))?'home':$Url->get('action');
     
        JX_get_container('home.php');
    }

}

class campaign extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('Jamilsoft official Homepage');
    }
    public function main(){
        global $Url;

     $me = is_null($Url->get('action'))?'home':$Url->get('action');
     
        JX_get_container('home.php');
    }

    public function posts(){
        global $Url;

        //echo "post center";
        JX_get_container('dashboard/post-add.php');
    }

}
class buslist extends JX_Serivce implements JX_service{
    public function __construct()
    {
        global $Url;
        $b = $Url->get('b');
        if(isset($_SESSION['uid'])){

        }else{
        echo "<script>";
        echo "location.assign('login&resume=buslist')";
        echo "</script>";
        }
        $this->setTitle('Business List');
    }
    public function main(){
        JX_get_container('buslist.php');
    }

}

class about extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('About');
    }
    public function main(){
        //$SessionMe = $_SESSION['uid'];
        include('containers/about/about.php');

       
    }

}
// class admin extends JX_Serivce implements JX_service{
//     public function __construct()
//     {
//         $this->setTitle('Admin Panel');
//     }
//     public function main(){
//         //$SessionMe = $_SESSION['uid'];
//         include('containers/admin/admin.php');
//     }

// }


class index extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('Jamilsoft official Homepage');
    }
    public function main(){
        //$SessionMe = $_SESSION['uid'];
        include('containers/search/sc.php');
    }

}

