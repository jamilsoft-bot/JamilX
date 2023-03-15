<div class="w3-container">
    <header class="w3-container w3-blue">
        <h3>Create User</h3>
    </header>
    <div class="w3-container w3-white">
        <form action="" method="post" enctype="multipart/form-data" class="w3-margin-top">
            <div class="row">
                <div class="col-md-3">
                    <img src="assets/images/user.png" style="width: 180pt;height:140pt">
                    <input type="file" name="avatar" class="">
                </div>
                <div class="col-md">
                        <div class="w3-container">
                            <input type="text" name="fullname" placeholder="Full name" class="w3-input w3-border">
                            <label><?php //echo $fullnameErr; ?></label>
                        </div>
                        <div class="w3-container">
                            <select name="gender" class="w3-input w3-border">
                                <option disabled selected class="w3-opacity">Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                            <label><?php //echo $addressErr; ?></label>
                        </div>
                        <div class="w3-container">
                            <input type="text" name="username" placeholder="Username" class="w3-input w3-border">
                            <label><?php //echo $usernameErr; ?></label>
                        </div>
                        <div class="w3-container">
                            <select name="role" class="w3-input w3-border">
                                <option disabled selected class="w3-opacity">User Role</option>
                                <option>user</option>
                                <option>admin</option>
                            </select>
                            <label><?php //echo $roleErr; ?></label>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="w3-container">
                        <input type="password" name="password" placeholder="Password" class="w3-input w3-border">
                        <label><?php //echo $passwordErr; ?></label>
                </div>
                <div class="w3-container">
                        <input type="text" name="address" placeholder="Home Address" class="w3-input w3-border">
                        <label><?php //echo $emailErr; ?></label>
                </div>
                <div class="w3-container">
                        <input type="email" name="email" placeholder="Email Address" class="w3-input w3-border">
                        <label><?php //echo $emailErr; ?></label>
                </div>
                <div class="w3-container">
                        <div class="row">
                            <div class="col-md">
                                <input type="text" name="state" placeholder="State" class="w3-input w3-border">
                                <label><?php //echo $cityErr; ?></label>
                            </div>
                            <div class="col-md">
                                <input type="text" name="city" placeholder="City" class="w3-input w3-border">
                                <label><?php //echo $cityErr; ?></label>
                            </div>
                        </div>
                </div>
                <div class="w3-container">
                        <input type="text" name="country" placeholder="Country" class="w3-input w3-border">
                        <label><?php //echo $countryErr; ?></label>
                </div>
                <div class="w3-container">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" placeholder="Date of Birth" class="w3-input w3-border">
                        <label><?php //echo $dobErr; ?></label>
                </div>
                <div class="w3-container">
                        <input type="submit" name="submit" value="Submit" class="w3-button w3-blue">
                        <input type="reset" name="reset" value="Clear" class="w3-button w3-red">
                </div>
            </div>
        </form>
    </div>
</div>