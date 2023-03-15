<?php

interface JX_service{
    public function main();
    }


class JX_Serivce{
    private $title;

    public function setTitle($text = ''){
        $this->title = $text;
    }

    public function getTitle(){
        return $this->title;
    }

    public function is_multi_Url(){
        return false;
    }

    public function commingsoon(){
        echo "<h1>Action Comming Soon!</h1>";
    }
}

interface JX_ActionI{
    public function getTitle();
    public function getAction();
    public function getText();
}

class JX_Action{
    protected $title, $text;

    public function setTitle($text = ''){
        $this->title = $text;
    }
    public function addAction(){}

    public function getText(){
        return $this->text;
    }
    public function setText($text = ''){
        $this->text = $text;
    }

    public function getTitle(){
        return $this->title;
    }

    public function commingsoon(){
        echo "<h1>Action Comming Soon!</h1>";
    }
}



// $users = new JS_Users();
// $Me = new JS_Me();
// $Pages = new JS_Pages();
// $sidebar = new JS_Sidebar();
// $db = new JS_Database();
// $Table = new JS_Table();
// $Url = new JS_URL();
// $jsys = new JS_System();
// $Apps = new JS_APPS();
// $AppSetting = new JS_Settings();
// $AppTheme = new JS_Themes();
// $Notification = new JX_Notification();


// $sidebar->add("home","Home","fa fa-home");
// $sidebar->add("me","Profile","fa fa-user");
// $sidebar->add("themes","Themes","fa fa-tshirt");
// $sidebar->add("users","Users","fa fa-user");
// $sidebar->add_special("settings","Settings","fa fa-cog");
// $sidebar->add_special("about","About","fa fa-crown");
// $sidebar->add_special("help","Help","fa fa-question");



// class NoClass {
//     public $title ="Unknown Service";

//     public function main()
//     {
//         $pg = new JS_Pages();
//         //$f = get_class($this);
//         echo $pg->alert("Unknown Service","The Service you're looking for is not available");
//     }

//     // public function NoAction()
//     // {
//     //     $pg = new JS_Pages();
//     //     //$f = get_class($this);
//     //     echo $pg->h1("this is the no service no action zone");
//     // }

    
// }

// class me extends JS_Container{
//     public $title = "My Profile";
//     public function main()
//     {
//         $id = isset($_SESSION['uid'])? $_SESSION['uid']: null;

//         global $db, $users,$Pages,$Me;
//         $Userpro = $db->Query($users->SelectById($id));
//         foreach($Userpro as $row){
//             global $users;
//             $users->name = $row['name'];
//             $users->avatar = $row['avatar'];
//             $users->role = $row['role'];
//             $users->country = $row['country'];
//             $users->city = $row['city'];
//             $users->username = $row['username'];
            
            
//             $users->dob = $row['dob'];
//             $users->phone = $row['phone'];
//             $users->email = $row['email'];
//             $users->gender = $row['gender'];
//             $users->address = $row['address'];
//             $users->state = $row['state'];
//           // $_SESSION['username'] = $users->username;
//         }
//         include "services/users/user-read.php";

//     }
// }
// class users extends JS_Container{
//     public $title = "Users ";

//     private $_formr;
//     private $_name, $_password, $_role,$_city,$_country,$_bio,$_username,$_nick,$_avatar;
//     private $_dob,$_phone,$_email,$_gender,$_address,$_state;



//     public function __construct()
//     {
       
//     }

//     private function formR(){
  

   
        
//     }

//     public function list()
//     {
//         global $db, $users,$Pages;
//         $Userlist = $db->Query($users->SelectAll());

//         foreach($Userlist as $row){
//         echo "<div class='container-fluid w3-margin'>";
//         include "services/users/user-list.php";
//         echo "</div>";

//         }

        
        
//     }
//     public function read(){
//         $id = isset($_GET['id'])? $_GET['id']: null;

//         global $db, $users,$Pages;
//         $Userpro = $db->Query($users->SelectById($id));
//         foreach($Userpro as $row){
//             global $users;
//             $users->name = $row['name'];
//             $users->avatar = $row['avatar'];
//             $users->role = $row['role'];
//             $users->country = $row['country'];
//             $users->city = $row['city'];
//             $users->username = $row['username'];
            
            
//             $users->dob = $row['dob'];
//             $users->phone = $row['phone'];
//             $users->email = $row['email'];
//             $users->gender = $row['gender'];
//             $users->address = $row['address'];
//             $users->state = $row['state'];
//            // echo $row['name'];
//         }

//         include "services/users/user-read.php";

//        // echo $id;
        
//     }

//     public function delete()
//     {
//         $id = isset($_GET['id'])? $_GET['id']: null;
//         global $db, $users,$Pages;
//         $delUser =$db->Query($users->delete($id));
//         if ($delUser) {
//             echo $Pages->alert("User Operation","User deleted success");

//         }else{
//             echo $Pages->alert("User Operation","Something went wrong");

//         }
//     }

//     public function update(){
//         $id = isset($_GET['id'])? $_GET['id']: null;

//         global $db, $users,$Pages;
        
//         if($id == null){
//             if(isset($_POST['submit'])){
//                 $users->username = isset($_POST['username'])? $_POST['username']: null;
//                 $users->password = isset($_POST['password'])? $_POST['password']: null;
//                 $users->role = isset($_POST['role'])? $_POST['role']: null;
//                 $users->bio = isset($_POST['bio'])? $_POST['bio']: null;
//                 $users->nick = isset($_POST['nick'])? $_POST['nick']: null;
//                 $this->_avatar = isset($_FILES['avatar'])? $_FILES['avatar']: null;
//                 $users->name = isset($_POST['name'])? $_POST['name']: null;
//                 $users->country = isset($_POST['country'])? $_POST['country']: null;
//                 $users->city = isset($_POST['city'])? $_POST['city']: null;
//                 $users->dob = isset($_POST['dob'])? $_POST['dob']: null;
//                 $users->phone = isset($_POST['phone'])? $_POST['phone']: null;
//                 $users->email = isset($_POST['email'])? $_POST['email']: null;
//                 $users->gender = isset($_POST['gender'])? $_POST['gender']: null;
//                 $users->address = isset($_POST['address'])? $_POST['address']: null;
//                 $users->state = isset($_POST['state'])? $_POST['state']: null;
//                 $user_id = isset($_POST['uid'])? $_POST['uid']: null;;
                
//                 $users->avatar = $this->_avatar['name'];
//                 //$Userup = $db->Query($users->update($user_id));
//                 if(UploadFile($this->_avatar)){
//                     global $Userup;
//                     if($db->Query($users->update($user_id))){

//                         echo $Pages->alert("User Operation","User updated success");
//                     }else{
//                         echo $Pages->alert("User Operation",$db->DBError);
            
//                     }
//                 }
                   
              
//             }

//         }else{
//             $Userpro = $db->Query($users->SelectById($id));
//         foreach($Userpro as $row){
//             global $users;
//             $users->name = $row['name'];
//             $users->avatar = $row['avatar'];
//             $users->role = $row['role'];
//             $users->country = $row['country'];
//             $users->city = $row['city'];
//             $users->username = $row['username'];
            
            
//             $users->dob = $row['dob'];
//             $users->phone = $row['phone'];
//             $users->email = $row['email'];
//             $users->gender = $row['gender'];
//             $users->address = $row['address'];
//             $users->state = $row['state'];
           
//         }
//         }

        
            
//         $Formr = "?serve=users&action=update";

//         echo "<div class='row'>";
//         include "services/users/user-add.php";
//         echo "</div>";

//     }

//     public function create()
//     {
//         global $db, $users,$Pages,$Url;

//         $this->_username = Input_test('username');
//         $this->_password = Input_test('password');
//         $this->_role = Input_test('role');
//         $this->_bio = htmlspecialchars($Url->post('bio'));
//         $this->_nick = Input_test('nick');
//         $this->_avatar = isset($_FILES['avatar'])? $_FILES['avatar']: null;
//         $this->_name = Input_test('name');
//         $this->_country = Input_test('country');

//         //$_dob,$_phone,$_email,$_gender,$_address,$_state;

//        $users->username =  $this->_username;
//        $users->password =  $this->_password ;
//        $users->role =  $this->_role ;
//        $users->bio =  $this->_bio ;
//        $users->nick =  $this->_nick ;
//        $users->avatar =  $this->_avatar['name'] ;
//        $users->name =  $this->_name ;
//        $users->country = $this->_country;
//        $users->city = Input_test('city');
//        $users->dob = Input_test('dob');
//        $users->phone = Input_test('phone');
//        $users->email = Input_test('email');// isset($_POST['email'])? $_POST['email']: null;
//        $users->gender = Input_test('gender');//isset($_POST['gender'])? $_POST['gender']: null;
//        $users->address = Input_test('address');//isset($_POST['address'])? $_POST['address']: null;
//        $users->state = Input_test('state');//isset($_POST['state'])? $_POST['state']: null;



      
      
//           if(UploadFile($this->_avatar)){
//         if($db->Query($users->Insert())){
//             echo $Pages->alert("User Operation","User added success");
//         }else{
//             echo $Pages->alert("User Operation","Something went wrong");

//         }

//        }

        
//         $Formr = "?serve=users&action=create";
//         echo "<div class='row'>";
//         include "services/users/user-add.php";
//         echo "</div>";
        
//     }

//     public function main()
//     {
//         global $Me;
        
//             if($Me->role() == "Admin"){
//                 include "services/users/user-service.php";


//             }else{
//                 echo "you must be login as admin to view this page";
//             }
            
        
//     }
   

    
// }

// class Themes extends JS_Container{
//     public $title =" Themes";

//     public function activate(){
//         global $CONF_THEME_DIR,$CONF_SERVICE_DIR,$Me,$AppSetting;
//         $t = isset($_GET['t'])?$_GET['t']:"advance";
//         $pg = new JS_Pages();
//         global $AppTheme;
//        if($Me->role() == "Admin"){
//         $AppSetting->SetAppTheme($t);
//         $AppSetting->save();
        
//        echo $pg->alert("Theme Operation","the salected theme was activated");
//        }else{
//         echo $pg->alert("Theme Operation","this section required admin access");

//        }
//     }

//     public function main(){
//         global $CONF_THEME_DIR,$CONF_SERVICE_DIR,$CONF_THEME;

//         global $AppTheme;
//         $list = $AppTheme->ThemesList();
//         echo "<div class='row w3-margin'>";
//         foreach($list as $themes){
//             $names = json_decode(file_get_contents("$CONF_THEME_DIR/".$themes ."/conf.json"));
//             //echo "<li>" . $names->snap . "</li>";
//             $icon = is_theme($names->ThemeName)?"fa fa-bookmark":"";
//             $stats_text = is_theme("lightblue")?"fa fa-bookmark":"";
//             $stats_color = is_theme("lightblue")?"fa fa-bookmark":"";
//             $text = null;
            
//            include "$CONF_SERVICE_DIR/themes/themes.php";
            
//         }
//         echo "</div>";
//     }
// }

// class Home extends JS_Container{
//     public $title = "Main";


//     public function main()
//     {
//         global $Me,$CONF_THEME,$Apps,$AppSetting, $Notification;
//         $sys = new JS_system();
//         $pg = new JS_Pages();
//         $appinfo = $Apps->getApp("payment");
//         echo $pg->alert("app system",$appinfo->Name);
//         echo $pg->alert("theme name",$CONF_THEME);

//         $nlist = $Notification->getlist();

//         foreach($nlist as $item){
//         echo $pg->alert("Alert",$item);

//         }


         
        
//     }

//     public function Rzone()
//     {
//         $sys = new JS_system();
//         $pg = new JS_Pages();
//         $data = $pg->h1("permission required");

       
//         return $data;
//     }


// }

// class Settings extends JS_Container{
//     public $title = "Settings";
   
    
// public function main()
// {       
//     global $AppSetting, $CONF_SERVICE_DIR,$APP;
    
//     include "$CONF_SERVICE_DIR/settings/settings.php";

    
// }


// public function save()
// {
//     global $AppSetting,$Url;

//      $AppSetting->SetAppName($Url->post('Appname'));
//      $AppSetting->SetAppEmail($Url->post('Appemail'));
//      $AppSetting->SetAppDescription($Url->post('Appdescription'));
//      $AppSetting->SetAppAddress($Url->post('Appaddress'));
//      $AppSetting->SetAppAuthur($Url->post('Appauthor'));
    
//      $lg = $_FILES['Applogo'];

//        // echo $_FILES['Applogo']['name'];
//      UploadFile($lg) or die("something went wrong");
//      $AppSetting->SetApplogo($_FILES['Applogo']['name']);
//     $AppSetting->save();
   

// }


// }

// class Apps{
//     public $title = "App center";

    
//     public function main(){
//         global $Me;

//         $pg = new JS_Pages();
//         if($Me->role() == "Admin"){
//             $HomePanel = "";
//      include "services/apps/main.php";
//         }else{
//             echo $pg->alert("Restricted area","This is section required Admin Access");
//         }
        

//     }
//     public function applist(){
//         if(is_admin()){
//             global $APP;
//         $path = "Apps/";
//         $aps = scandir($path);
//         unset($aps[0]);
//         unset($aps[1]);
//         $status = [
//             "icon" => "",
//             "link" => "",
//         ];
//         echo "<div class='w3-row'>";
//         foreach($aps as $ap){
//             $install_display_option = "";
//             $uninstall_display_option = "display:none";
//             $path = "Apps/$ap/conf.json";
//             $info = json_decode(file_get_contents($path));
//             $tags = str_getcsv($info->Tag);
//             $appname = $ap;
            
//             include "services/apps/applist.php";
//         }

//         echo "</div>";
       
            
//         }else{
//             echo "required admin access";
            
            
//         }

        
   
//     }

//     public function installeds(){
        
//         global $APP,$Apps;
//         $aps = $Apps->Get_Installed_Apps();
//         $status = [
//             "icon" => "",
//             "link" => "",
//         ];
//         echo "<div class='w3-row'>";
//         foreach($aps as $ap){
//             $install_display_option = "display:none";
//             $uninstall_display_option = "";
//             $app_name = $ap['app_name'];
//             $appname = $ap['app_fullname'];
//             $path = "Apps/".$app_name."/conf.json";
//             $info = json_decode(file_get_contents($path));
//             $tags = str_getcsv($info->Tag);
            
//             include "services/apps/applist.php";
//         }

//         echo "</div>";
        
   
//     }

//     public function install(){
//         global $Apps,$Url;
//         $Apps->Install($Url->get('app'));
//         //echo " i see you ".;
//     }
//     public function uninstall(){
//         Global $Apps;
//        if($Apps->Uninstall($_GET['app'])){
//             echo $_GET['app'] . " was removed";
//        }
//     }
// }

?>