<?php

function js_head(){
    global $APP;
    echo "<title> ".$APP->AppName."</title>";
    echo "<link rel='shortcut icon'  href='data/images/".$APP->AppLogo."'>";

}

function JX_Alert($title =null, $message = null,$color = "blue"){
  echo "<div class='alert w3-$color alert-dismissible fade show' role='alert'>";
          echo "<strong>$title!</strong> $message.<br>";
          echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
         echo "</div>";
}
 function  business_update($key,$value,$code){
  return $sql = "UPDATE `business` SET `$key`='$value'  WHERE code = '$code';";
}
function  business_update_with_logo($logo,$key,$value,$code){
  return $sql = "UPDATE `business` SET `$key`='$value' ,`logo` ='$logo' WHERE code = '$code';";
}

function Redirect($path){
  echo "<script>";
  echo "location.assign('$path')";
  echo "</script>";
}
function get_default_date($date){
 return format_date($date,"M d, Y");
}
function  format_date($input,$format){
  $rdate = new DateTime($input);
  $date = $rdate->format($format);

  return $date;
}

function check_nav($active = "w3-blue",$link = ''){
  global $Url;
  $action = $Url->get('action');
  if($action == $link){
    echo $active;
  }
}

function is_admin(){
    global $Me;

    if($Me->role() == "Admin") {
        return true;
      }else{
        return false;
      }
}
function Input_test($input){
  global $Url;
  $a = $Url->post($input);
  $b = stripslashes($a);
  $c = htmlspecialchars($b);
  $d = strip_tags($b);
  return $d;
}
function is_theme($name =""){
  global $Me, $CONF_THEME;

  //return $CONF_THEME;
  if($CONF_THEME == $name) {
      return true;
    }else{
      return false;
    }
}

function JX_get_total_users(){
  global $JX_db;
  $res = $JX_db->query("SELECT *FROM `users`");
  return $res->num_rows;
}

function JX_get_total_apps(){
  global $JX_db;
  $res = $JX_db->query("SELECT *FROM `apps`");
  return $res->num_rows;
}

function JX_delete_item($table){
  global $Url, $JX_db;
  if($Url->get('del') !== null){
      $id = $Url->get('del');
          $code = $Url->get('b');
          $link = "?action=".$Url->get('action');
      echo "<div class='w3-margin-top'>";
      echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
          echo "<strong>Delete Alert!</strong><br> Are you Sure, You want to delete this Item?.<br>";
          echo "<br><a href='$link&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
          echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
      echo "</div></div>";
      
  }
      if($Url->get('yesdel') !== null){
          $id = $Url->get('yesdel');

          $sql ="DELETE FROM `$table` WHERE `id`=$id";
          if($JX_db->query($sql)){
              echo "<div class='w3-margin-top'>";
              echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
              echo "<strong>Delete Alert!</strong> the Item was successfully deleted.<br>";
              echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
              echo "</div></div>";
          }
        }
}