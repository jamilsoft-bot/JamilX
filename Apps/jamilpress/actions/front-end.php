<?php
class Jblogs extends JX_Serivce implements JX_service{
    private $blog, $burl;
   public function __construct()
   { global $Url; 
        $this->burl = $Url->get_paths();
       $this->blog = new JP_Blog($this->burl[1]);
   }

   private function check_blog(){
        global $JX_db;
        $blog  = $this->burl[1];
        $sql = "SELECT *FROM `blogs` WHERE `url`='$blog'";
        $res = $JX_db->query($sql);
        if($res->num_rows < 1){
            return false;
        }else{
            return true;
        }
   }
   public function main(){
     if($this->check_blog() == true){
         $blog = $this->blog;
         $theme = $blog->getTheme();
         $themeIndex = "Apps/jamilpress/themes/modern/index.php";
         if(!is_null($theme)){
             $candidate = "Apps/jamilpress/themes/{$theme}/index.php";
             if(file_exists($candidate)){
                 $themeIndex = $candidate;
             }
         }
         include $themeIndex;
     }else{
         echo "blog not found";
     }
     //echo "welcome to blog front end -". $this->burl[1];
   }

   public function getPage()
   {
      return true;
   }

   public function is_multi_Url()
   {
      return true;
   }

}
