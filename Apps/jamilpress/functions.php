<?php
function JP_get_last($interval,$format){
    $dt =  new DateTime();
    $dt->sub(new DateInterval($interval));
    return $dt->format($format);
}
function get_total_visits(){
    global $JX_db,$BLOG_URL;

    $sql = "SELECT* FROM `statistics` WHERE `blog` = '$BLOG_URL'";
    $re = $JX_db->query($sql);
    return $re->num_rows;
}
function get_Tv($dates){
    global $JX_db,$BLOG_URL;

    $sql = "SELECT* FROM `statistics` WHERE `blog` = '$BLOG_URL' AND `date`='$dates'";
    $re = $JX_db->query($sql);
    return $re->num_rows;
}
function get_total_pages(){
    global $JX_db,$BLOG_URL;

    $sql = "SELECT* FROM `posts` WHERE `type`='page' AND `blog` = '$BLOG_URL'";
    $re = $JX_db->query($sql);
    return $re->num_rows;
}
function get_total_posts(){
    global $JX_db,$BLOG_URL;

    $sql = "SELECT* FROM `posts` WHERE `type`='post' AND `blog` = '$BLOG_URL'";
    $re = $JX_db->query($sql);
    return $re->num_rows;
}

function JP_Alert($title =null, $message = null,$color = "blue"){
    echo "<div class='alert w3-$color alert-dismissible fade show' role='alert'>";
            echo "<strong>$title!</strong> $message.<br>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
           echo "</div>";
}
function deletor($table){
    global $Url;
    if($Url->get('del') !== null){
        echo "<div class='w3-margin-top'>";
        delete_item($table);
        echo "</div>";
    }
}
function JP_NavBtn($link,$text,$icon){
    return "<a href='$link' class='w3-bar-item w3-button '> <i class='$icon '></i>$text</a>";
}
function httpQuery($string =null){
    $ds = $_SERVER['QUERY_STRING'];
    
    $rr =str_getcsv($ds,"&");
    unset($rr[0]);
    return "?" .implode("&",$rr) . "&$string";
    
}

function JP_listBtns($btns = []){
    return $btns;
}
function JP_check_nav($active = "w3-blue",$link = '',$type = null){
    global $Url;
    $action = isset($_GET[$type])?$_GET[$type]:"";
    if($action == $link){
      echo $active;
    }else{

    }
  }
function JP_check_nav2($active = "w3-blue",$link = ''){
    global $Url;
    $action = $Url->get('filter');
    if($action == $link){
      echo $active;
    }
  }

function delete_item($table){
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

