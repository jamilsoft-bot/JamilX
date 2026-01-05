
<?php

class JX_Route{
    private $_serve,$_urls, $_action, $_code;

    public function __construct()
    {
        global $Url, $INDEX;
        $this->_urls = $Url->get_paths();
        $this->_serve = isset($_GET['route'])? $_GET['route']: "freelancer";
        $this->_action = isset($_GET['action'])? $_GET['action']: 'main';
        
     
    }
    public function getmultiUrl(){
        return $this->_urls;
    }
    public function Get($url,$code){

        if($this->_serve == $url){
         $code();
        }

    }
    public function Get_content($url,$code){

        if($this->_urls[1] == $url){
       return  $code();
        }

    }

    public function Get_multi($url,$code){

        if($this->_urls[0] == $url){
       return  $code();
        }

    }
    public function Get_data($type,$code){

        if($this->_urls[0] == $type){
         $code();
        }

    }
    public function home(){
        $this->Get("index",function (){
            $ds = new index();

            $ds->main();
        });
    }

   

    public function dashboard(){
        $this->Get("dashboard",function (){
            $ds = new Dashboard();

            $ds->main();
        });
    }

    // public function index(){
    //     $cls = $this->_serve;

    //       $ds = new $cls();

    //         $ds->main();
      
    // }

    public function index(){
        $cls = $this->_serve;
        if(class_exists($cls)){
            $ds = new $cls();

            $ds->main();
        }else{
            include "containers/admin/error.php";
        }
    }
    
}