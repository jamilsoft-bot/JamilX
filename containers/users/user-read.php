<div class=" row container-fluid">
        
        </div>
        <div class="row w3-container w3-margin-top">
            <div class="col-4 md-4">
                <div class="w3-card-4 ">
                    <img src="data/<?php echo $users->avatar;?>" style="width: 100%; height: 200pt;" id="prid" alt="Norway">
                    <div class="w3-container w3-center">
                        <br>
                        <p class="w3-input w3-btn"><?php echo $users->username;?></p>
                   <br>
                    </div>
                  </div> 
                
            </div>
            <div class="col-8 md-8">
                <div class="w3-card ">
                    <header class="Title-color w3-container">
                        <h3><?php echo $users->username;?> </h3>
                    </header>
                    <br>
                    <div class="w3-container">
                        
                        <div class="row">
                            <div class="col-4 md-4 w3-margin-top">
                                <label class="w3-text-blue">Full Name</label>
                                <p class="w3-input"><?php echo $users->name;?></p>
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                            <label class="w3-text-blue">Username</label>
                            <p class="w3-input"><?php echo $users->username;?></p>
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                            <label class="w3-text-blue">Password</label>
                            <p class="w3-input">*****</p>
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                            <label class="w3-text-blue">Email</label>
                            <p class="w3-input"><?php echo $users->email;?></p>
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                            <label class="w3-text-blue">Phone Number</label>
                            <p class="w3-input"><?php echo $users->phone;?></p>
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                            <label class="w3-text-blue">Date of Birth</label>
                            <p class="w3-input"><?php echo $users->dob;?></p>
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                            <label class="w3-text-blue">Gender</label>
                            <p class="w3-input"><?php echo $users->gender;?></p>
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                            <label class="w3-text-blue">Home Address</label>
                            <p class="w3-input"><?php echo $users->address;?></p>
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                            <label class="w3-text-blue">State</label>
                            <p class="w3-input"><?php echo $users->state;?></p>
                            </div>
                            <div class="col-4 md-4 w3-margin-top"> 
                            <label class="w3-text-blue">Country</label>
                            <p class="w3-input"><?php echo $users->country;?></p>
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                            <label class="w3-text-blue">City/Hometown</label>
                            <p class="w3-input"><?php echo $users->city;?></p>
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                            <label class="w3-text-blue">User Role</label>
                            <p class="w3-input"><?php echo $users->role;?></p>

                            </div>
                            
                            <div class="col-4 md-4 w3-margin-top">
                                <a href="?action=update&id=<?php echo $row['id'];?>" class="w3-margin-bottom w3-blue w3-input w3-btn">Update </a>
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                                <a href="/" class="w3-input w3-green w3-btn"> Done</a>
                            </div>
                            <div class="col-4 md-4 w3-margin-top">
                                <a onclick="alert('comming soon!')" class="w3-input w3-red w3-btn">Delete</a>
                            </div>
                            
                        </div>
                    </div>
                    
                
                </div>
                
            </div>
        </div>
        
        
          