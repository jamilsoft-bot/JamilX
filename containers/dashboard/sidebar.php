<?php
global $JXD_sidebar;
$dslist = $JXD_sidebar->get_list();

?>
<div class="col-md-2 w3-border w3-animate-left" id="sidebar" style="min-height: 400pt;">
                <div class="w3-margin">
                    <strong class="w3-large">Business Name</strong>
                </div>
               <div class="w3-margin">
                   <a href="" class="w3-button w3-card w3-round-xxlarge">Change Business</a>
               </div>
               <hr>
                <div class="w3-bar-block">
                    <a href="?action=dashboardmain" class="w3-bar-item" style="text-decoration: none;"><i class="fa fa-home w3-margin-right"></i> Home</a>
                    <a href="invoice" class="w3-bar-item" style="text-decoration: none;"><i class="fa fa-file-invoice-dollar w3-margin-right"></i> Invoices</a>
                    <a href="billing" class="w3-bar-item" style="text-decoration: none;"><i class="fa fa-receipt w3-margin-right"></i> Billing</a>
                    <a href="forum" class="w3-bar-item" style="text-decoration: none;"><i class="fa fa-comments w3-margin-right"></i> Forum</a>
                    <?php

                    if(count($dslist) !== 0){
                        foreach($dslist as $list){
                            echo $list;
                        }
                    }

                    ?>
                    <!-- <a href="?action=dashboardmain" class="w3-bar-item" style="text-decoration: none;"><i class="fas fa-th w3-margin-right"></i> App Menu</a> -->
                    <!-- <a href="" class="w3-bar-item" style="text-decoration: none;"><i class="fa fa-edit w3-margin-right"></i> Customize</a> -->
                    <!-- <a href="" class="w3-bar-item" style="text-decoration: none;"><i class="fa fa-business-time w3-margin-right"></i> Services</a> -->
                    <a href="#" onclick="showprofile()" class="w3-bar-item" style="text-decoration: none;"><i class="fa fa-user w3-margin-right"></i> My Profile</a>
                    <div class="w3-container w3-hide" id="profile">
                        <a href="?action=myprofile" class="w3-bar-item" style="text-decoration: none;"><i class="fa fa-user w3-margin-right"></i> My Profile</a>
                        <a href="?action=updatemyprofilepic" class="w3-bar-item" style="text-decoration: none;"><i class="fa fa-camera w3-margin-right"></i> Change Profile Pic</a>
                        <a href="?action=editmyprofile" class="w3-bar-item" style="text-decoration: none;"><i class="fa fa-user-edit w3-margin-right"></i>Update Profile</a>
                    </div>
                    <!-- <a href="" class="w3-bar-item" style="text-decoration: none;"><i class="fa fa-code-branch w3-margin-right"></i> Extensions</a> -->
                    <a href="" class="w3-bar-item" style="text-decoration: none;"><i class="fa fa-cog w3-margin-right"></i> Setting</a>
                    <a href="" class="w3-bar-item" style="text-decoration: none;"><i class="fa fa-umbrella w3-margin-right"></i> About</a>
                    <a href="" class="w3-bar-item" style="text-decoration: none;"><i class="fa fa-question w3-margin-right"></i> Help</a>

                </div>
            </div>

<script>
function showprofile() {
    var x = document.getElementById("profile");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
