
<?php
include "header.php";
    if(!isset($_SESSION['uid'])){
        echo "<script>";
        echo "location.assign('login')";
        echo "</script>";
    }
global $Url,$db;
$name = "Admin";
$detail = null;
$logo = null;
$data = null;
$cd =$Url->get('b');
//$sql = "SELECT * FROM `business` WHERE code='$cd'";

    //             $row = $db->Query($sql);
    
    // foreach($row as $r){
    //     $json =  $r['data'];
    //     $data= json_decode($json);
    //     $name = $data->Bname;
    // }
   


?>
<style>
    body{
        background-color: whitesmoke;
    }
    a{
        text-decoration: none;
    }
    .content{
        min-height: 100pt;
        background-color: white;
    }
</style>
<?php include "nav.php"; ?>


<header id="header" class="w3-flat-wet-asphalt w3-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h2><span class="fa fa-cog"></span> Dashboard <small class="text-muted">Manage <?php echo $name;?></small></h2>
            </div>
            <div class="col-md-2">
                <?php
                    $paddlink = "?action=posts";
                    $brandlink = "?action=brand";
                    $productlink = "?action=products";
                    $offerlink = "?action=offers";
                    $emaillink = "?action=emails";
                    $buslink = "?action=businesses";
                    $homelink = "?action=home";
                    $userlink = "?action=users";


                ?>
            <div class="w3-dropdown-click w3-right w3-white w3-margin-top">
                <button onclick="quickNavs()" class="w3-button w3-border w3-border-blue">Actions <span class="fa fa-arrow-down"></span></button>
                <div id="Demo" class="w3-dropdown-content w3-bar-block w3-border">
                    <a href="<?php echo $buslink;?>" class="w3-bar-item w3-button">Business</a>
                    <a href="<?php echo $paddlink;?>" class="w3-bar-item w3-button">Post</a>
                    <a href="<?php echo $brandlink;?>" class="w3-bar-item w3-button">Brands</a>
                    <a href="<?php echo $userlink;?>" class="w3-bar-item w3-button">Users</a>
                    <a href="<?php echo $offerlink;?>" class="w3-bar-item w3-button">Offer/Postcard</a>
                    <a href="<?php echo $emaillink;?>" class="w3-bar-item w3-button">Bulk Emails</a>


                </div>
            </div>
            </div>
        </div>
    </div>
</header>


<section id="main" class=" w3-margin-top">

    <div class="w3-container">
        <div class="row">
            <div class="col-md-3">
                <?php include "sidebar.php" ?>
            </div>
            <div class="col-md-9">
                    <?php

              


                $action = is_null($Url->get('action'))?"home":$Url->get('action');

                if(function_exists($this->$action())){
                    $this->$action();
                }
               
                 
              


                    ?>
            </div>
        </div>
    </div>
</section>

















<script>
function quickNavs() {
    var x = document.getElementById("Demo");
    if (x.className.indexOf("w3-show") == -1) { 
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

<?php
include "footer.php";
?>