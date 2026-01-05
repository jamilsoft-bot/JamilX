
            <?php //$Formr = "";
            $draft = "?serve=users&action=create";?>
                
    <form action="<?php echo $Formr;?>" method="post" enctype="multipart/form-data">

    <div class=" row container-fluid">
        <div class="col-4 md-4">

        </div>
        <div class="col-4 md-4">
               
        </div>
        </div>
        <div class="row w3-container">
            <div class="col-4 md-4">
                <div class="w3-card-4 w3-margin">
                <?php $av = isset($users->avatar)?"data/".$users->avatar:'assets/images/user.png';

                ?>
                    <img src="<?php echo $av;?>" style="width: 100%; height: 200pt;" id="prid" alt="Profile Pic">
                    <div class="w3-container w3-center">
                        <br>
                        <input type="file" class="w3-input form-control w3-button" name="avatar" id='avatar' required>
                   <br>
                    </div>
                  </div> 
                
            </div>
            <div class="col-8 md-8">
                <div class="w3-card w3-margin">
                    <header class="Title-color w3-container">
                        <h3>User Registration Page</h3>
                    </header>
                    <br>
                    <div class="w3-container">
                        
                        <div class="row">
                            <div class="col-4 md-4 w3-margin-top">
                                <label class="w3-text-blue">Full Name</label>
                                <input type="hidden" name="uid" value="<?php echo $id;?>">
                                <input type="text" name="name" value="<?php echo $users->name;?>" class="w3-input" id="name" placeholder="Full name" required>
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                            <label class="w3-text-blue">Username</label>
                                <input type="text" name="username" value="<?php echo $users->username;?>" class="w3-input" id="username" placeholder="Username" required>
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                            <label class="w3-text-blue">Password</label>
                                <input type="password" name="password" value="<?php echo $users->password;?>" class="w3-input" id="password" placeholder="Password" required>
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                            <label class="w3-text-blue">Email</label>
                                <input type="email" name="email" value="<?php echo $users->email;?>" class="w3-input" id="email" placeholder="Email Address" required>
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                            <label class="w3-text-blue">Phone Number</label>
                                <input type="text" name="phone" value="<?php echo $users->phone;?>" class="w3-input" id="phone" placeholder="Phone Number">
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                            <label class="w3-text-blue">Date of Birth</label>
                                <input type="date" name="dob" class="w3-input" value="<?php echo $users->dob;?>" id="dob" placeholder="Date of Birth">
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                            <label class="w3-text-blue">Gender</label>
                                <input type="text" name="gender" class="w3-input" value="<?php echo $users->gender;?>" id="gender" placeholder="Gender">
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                            <label class="w3-text-blue">Home Address</label>
                                <input type="text" name="address" class="w3-input" value="<?php echo $users->address;?>" id="address" placeholder="Home Address">
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                            <label class="w3-text-blue">State</label>
                                <input type="text" name="state" class="w3-input" value="<?php echo $users->state;?>" id="state" placeholder="State">
                            </div>
                            <div class="col-4 md-4 w3-margin-top"> 
                            <label class="w3-text-blue">Country</label>
                            <?php $selected_Country= $users->country;?>
                           <select name="country" id="cn" class="w3-input"></select>
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                            <label class="w3-text-blue">City/Hometown</label>
                                <input type="text" name="city" class="w3-input" value="<?php echo $users->city;?>" placeholder="City">
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                            <label class="w3-text-blue">User Role</label>
                            <?php $selected_role= $users->role;?>
                                    <?php

                                        global $Me;

                                        if($Me->role() == "Admin"){
                                            echo "<select name='role' id='rl' class='w3-input'>";
                                        }
                                        else{
                                          echo  "<select name='role' class='w3-input'>";
                                          echo "<option> User</option>";
                                          echo "<option> Partner</option>";
                                          echo "<option> Customer</option>";
                                         echo "</select>";

                                        }

                                    ?>
                            </div>
                            
                            <div class="col-4 md-4 w3-margin-top">
                                <input type="submit" name="submit"  class="w3-margin-bottom w3-blue w3-input w3-btn" value="Submit">
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                                <input type="reset" name="reset" class="w3-input w3-green w3-btn"  value="Clear">
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                                <input type="button" name="cancel" class="w3-input w3-red w3-btn"  value="Cancel">
                            </div>
                            
                        </div>
                    </div>
                    
                
                </div>
                
            </div>
        </div>
        
        
          
                </form>

                <script src="assets/js/countries.js"></script>
<script>
loadCountries("cn","<?php echo $selected_Country;?>")
loadRoles("rl","<?php echo $selected_role;?>")
</script>