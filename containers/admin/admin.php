<?php
    global $Url;

$act = is_null($Url->get('action'))?"home":$Url->get('action');

$action = new $act();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/jamilpress.css">
    <link rel="stylesheet" href="assets/lib/w3/w3.css">
    <link rel="shortcut icon" href="assets/images/jslogobird.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/lib/bs5/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/lib/font/css/all.css">
</head>
<body>
<div class="w3-container w3-border">
    <div class="w3-bar w3-margin-top w3-large">
        <!-- <a href="#" class="w3-bar-item w3-button"><i class="fa fa-bars"></i> </a> -->
        <a href="#" class="w3-bar-item w3-left" style="width: 150pt;">
            <img src="assets/images/jsbn.png" class="" style="width: 120pt;height:25pt">
        </a> 
        <input type="text"  class="w3-input w3-bar-item w3-hide-medium   w3-hide-small w3-round-large w3-light-gray " style="width: 600pt;" placeholder="Search here">
        <div class="w3-right">
            <a href="" class="w3-bar-item w3-button"><i class="fa fa-question-circle"></i></a>
            <a href="" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
            <a href="" class="w3-bar-item w3-button"><i class="fas fa-th"></i></a>
            <a href="#" class="w3-bar-item">
                <img src="assets/images/user.png" class="w3-circle" style="width: 25pt;">
            </a>
        </div>
    </div>
</div>

<div class="w3-container">
    <div class="row">
        <div class="col-md-2 w3-hide-medium w3-hide-small" id="sidebar">
            <!-- <div class="w3-margin">
                <strong class="w3-large">Business Name</strong>
            </div> -->
           <div class="w3-margin">
               <a href="?action=createapp" class="w3-button w3-card w3-round-xxlarge"><i class="fa fa-cog"></i> Create App</a>
           </div>
           <hr>
            <div class="w3-bar-block ">
                <a href="?action=home" class="w3-bar-item w3-hover-blue w3-round-xxlarge w3-text-black" style="text-decoration: none;"><i class="fa fa-home w3-margin-right"></i> Home</a>
                <a href="" class="w3-bar-item w3-hover-blue w3-round-xxlarge w3-text-black" style="text-decoration: none;"><i class="fas fa-user-alt w3-margin-right"></i> Profile</a>
                <a href="#" onclick="jsShow('usermenu')" class="w3-bar-item w3-hover-blue w3-round-xxlarge w3-text-black" style="text-decoration: none;"><i class="fa fa-users w3-margin-right"></i> Users</a>
                <div class="w3-container w3-hide" id="usermenu">
                    <a href="?action=createuser" class="w3-bar-item w3-hover-blue w3-round-xxlarge w3-text-black" style="text-decoration: none;"><i class="fa fa-user-plus w3-margin-right"></i> Add New</a>
                    <a href="?action=users" class="w3-bar-item w3-hover-blue w3-round-xxlarge w3-text-black" style="text-decoration: none;"><i class="fa fa-user-friends w3-margin-right"></i> All Users</a>
                </div>
                <a href="#" onclick="jsShow('rolemenu')" class="w3-bar-item w3-hover-blue w3-round-xxlarge w3-text-black" style="text-decoration: none;"><i class="fa fa-star w3-margin-right"></i> Roles</a>
                <div class="w3-container w3-hide" id="rolemenu">
                    <a href="?action=createrole" class="w3-bar-item w3-hover-blue w3-round-xxlarge w3-text-black" style="text-decoration: none;"><i class="fa fa-plus w3-margin-right"></i> Add New</a>
                    <a href="?action=readroles" class="w3-bar-item w3-hover-blue w3-round-xxlarge w3-text-black" style="text-decoration: none;"><i class="fa fa-list w3-margin-right"></i> All Roles</a>
                </div>
                <a href="?action=applist"  class="w3-bar-item w3-hover-blue w3-round-xxlarge w3-text-black" style="text-decoration: none;"><i class="fa fa-th w3-margin-right"></i> Apps</a>
                <a href="#" onclick="jsShow('catmenu')" class="w3-bar-item w3-hover-blue w3-round-xxlarge w3-text-black" style="text-decoration: none;"><i class="fa fa-code-branch w3-margin-right"></i> Categories</a>
                <div class="w3-container w3-hide" id="catmenu">
                    <a href="?action=createcat" class="w3-bar-item w3-hover-blue w3-round-xxlarge w3-text-black" style="text-decoration: none;"><i class="fa fa-plus w3-margin-right"></i> Add New</a>
                    <a href="?action=readcats" class="w3-bar-item w3-hover-blue w3-round-xxlarge w3-text-black" style="text-decoration: none;"><i class="fa fa-list w3-margin-right"></i> All Categories</a>
                </div>
                <a href="?action=updatecomp" class="w3-bar-item w3-hover-blue w3-round-xxlarge w3-text-black" style="text-decoration: none;"><i class="fa fa-cog w3-margin-right"></i> Setting</a>
                <a href="?action=about" class="w3-bar-item w3-hover-blue w3-round-xxlarge w3-text-black" style="text-decoration: none;"><i class="fa fa-umbrella w3-margin-right"></i> About</a>
                <a href="jxdoc" class="w3-bar-item w3-hover-blue w3-round-xxlarge w3-text-black" style="text-decoration: none;"><i class="fa fa-question w3-margin-right"></i> Help</a>
    
            </div>
        </div>
        <div class="col-md-10 ">
            <div class="w3-container w3-margin-top">
            <?php
        
        $action->getAction();

    ?>
            </div>
        </div>
    </div>
</div>




    <!-- <script src="assets/lib/bs5/js/bootstrap.bundle.min.js"></script> -->
    <script src="assets/lib/w3/w3.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/lib/jq/jq.js"></script>
    <script src="assets/js/jamilpress-chart.js"></script>
      <script>
          function jsShow(id) {
                var x = document.getElementById(id);
                if (x.className.indexOf("w3-show") == -1) {
                    x.className += " w3-show";
                } else {
                    x.className = x.className.replace(" w3-show", "");
                }
            }
      function showNav() {
          var x = document.getElementById("nav");
          if (x.className.indexOf("w3-show") == -1) { 
              x.className += " w3-show";
          } else {
              x.className = x.className.replace(" w3-show", "");
          }
      }
      </script>
</body>
</html>