<div class="w3-border">
        <div class="w3-container w3-bar w3-large " style="margin-top: 5pt;">
            <div class="row ">
                <div class="col-md-2">
                    <!-- <a href="#" class="w3-button w3-bar-item" onclick="w3.toggleShow('#sidebar')"><i class="fa fa-bars"></i> </a> -->
                    <a href="?action=dashboardmain" class="w3-bar-item">
                    <img src="assets/images/jsbn2.png" class="" style="width: 100pt;height:16pt">
                    </a>                
                </div>
                <div class="col-md-7 ">
                    <input type="text" class="w3-input w3-round-xlarge w3-light-grey w3-bar-item" placeholder="Search Apps" style="width: 600pt;">
                </div>
                <div class="col-md-2 ">
                    <div class="w3-right">
                        <a href="#" class="w3-bar-item w3-button"><i class="fa fa-question-circle"></i></a>
                        <!-- <a href="" class="w3-bar-item w3-button"><i class="fas fa-th"></i></a> -->
                        <div class="w3-dropdown-click">
                        <button class="w3-bar-item w3-button" onclick="shownav()"><i class="fas fa-th"></i></button>
                            <div id="nav" class="w3-dropdown-content  w3-bar-block w3-border w3-border-blue" style="right:20pt;top:40pt;width:200pt">
                                    <div class="w3-container w3-small">
                                        <a href="#" class="w3-bar-item w3-text-blue" style="text-decoration: none;">Sections</a>
                                        <a href="admin" class="w3-bar-item" style="text-decoration: none;">Admin</a>
                                        <a href="dashboard" class="w3-bar-item " style="text-decoration: none;">Dashboard</a>
                                        <a href="about" class="w3-bar-item" style="text-decoration: none;">About</a>
                                        <a href="about" class="w3-bar-item" style="text-decoration: none;">Feedback</a>
                                        
                                    </div>
                            </div>
                        </div>
                        <div class="w3-dropdown-click">
                        <button class="w3-bar-item w3-button" onclick="shownavpic()">                            
                                <img src="<?php
                                    global $Me;
                                    $logo = $Me->pic();
                                    if($logo == null){
                                        echo "assets/images/user.png";
                                    }else{
                                        echo "data/$logo";
                                    }
                        
                        ?>" class="w3-circle" style="width: 25pt;">
                        </button>
                            <div id="navpic" class="w3-dropdown-content  w3-bar-block w3-border w3-border-blue" style="right:20pt;top:40pt;width:200pt">
                                    <div class="w3-container w3-small">
                                        <!-- <a href="#" class="w3-bar-item w3-text-blue" style="text-decoration: none;">Sections</a> -->
                                        <a href="?action=myprofile" class="w3-bar-item" style="text-decoration: none;">My Profile</a>
                                        <a href="?action=editmyprofile" class="w3-bar-item " style="text-decoration: none;">Setting</a>
                                        <a href="about" class="w3-bar-item" style="text-decoration: none;">Help</a>
                                        <a href="logout" class="w3-bar-item" style="text-decoration: none;">Sign out</a>
                                        
                                    </div>
                            </div>
                        </div>
                        <!-- <a href="#" class="w3-bar-item">
                        </a> -->
                    </div>  
                </div>
            </div>
        </div>
    
</div>
    <script>
function shownav() {
    var x = document.getElementById("nav");
    if (x.className.indexOf("w3-show") == -1) { 
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
function shownavpic() {
    var x = document.getElementById("navpic");
    if (x.className.indexOf("w3-show") == -1) { 
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>