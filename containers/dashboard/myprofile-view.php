<div class="w3-container">
    <div class="w3-container">
        <div class="d-flex flex-row justify-content-center p-3">
            <div class="p-3 w3-center">
                <img src="<?php
                        global $Me;
                        $logo = $Me->pic();
                        if($logo == null){
                            echo "assets/images/user.png";
                        }else{
                            echo "data/$logo";
                        }
                        //echo $logo;
                        
                        ?>" class="w3-circle" style="width: 150pt;">
                <h3><?php global $Me; echo $Me->Fullname();?></h3>
                <h4><?php global $Me; echo $Me->role();?></h4>
                <h5 class=" w3-opacity">Born 
                <?php 
                global $Me; 
                $dt = new DateTime($Me->DoB());
                echo $dt->format("M, Y");
                
                ?>
                </h5>
                <h1>
                    <span class="w3-button"><i class="fas fa-video"></i> </span>
                    <span class="w3-button"><i class="fas fa-phone"></i> </span>
                    <span class="w3-button"><i class=" fas fa-envelope"></i> </span>

                </h1>
            </div>
        </div>
    </div>
    <div class="w3-container  w3-margin-top">
        <header class="w3-container">
            <h3>Biography</h3>
        </header>
        <div class="w3-container" style="text-align: justify;">
            <p>
            <?php global $Me; echo $Me->bio();?>
            </p>
        </div>
    </div>
    <div class="w3-container">
        <header class="w3-container">
            <h3>Personal Information</h3>
        </header>
        <div class="w3-container">
            <div class="table-responsive">
                <table class="table ">
                    <tr>
                        <td>Name</td>
                        <td><?php global $Me; echo $Me->Fullname();?></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><?php global $Me; echo $Me->username();?></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>************</td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td><?php global $Me; echo $Me->gender();?></td>
                    </tr>
                    <tr>
                        <td>Role</td>
                        <td><?php global $Me; echo $Me->role();?></td>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td><?php global $Me; echo $Me->DOB();?></td>
                    </tr>
                </table>
            </div>
        </div>
        <header class="w3-container">
            <h3>Contact Information</h3>
        </header>
        <div class="w3-container">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td>Email Address</td>
                        <td><?php global $Me; echo $Me->email();?></td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td><?php global $Me; echo $Me->phone();?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php global $Me; echo $Me->address();?></td>
                    </tr>
                    <tr>
                        <td>City/State</td>
                        <td><?php global $Me; echo $Me->city();?>,<?php global $Me; echo $Me->state();?></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><?php global $Me; echo $Me->country();?></td>
                    </tr>
                </table>
            </div>
        </div>
</div>