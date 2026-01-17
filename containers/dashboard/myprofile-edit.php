<div class="w3-container">
    <header class="w3-container">
        <h3>Updating my Information</h3>
    </header>
    <div class="w3-container w3-margin-top">
        <label>Bio</label>
        <textarea cols="5" rows="10" name="mybio" class="w3-input w3-border"><?php echo  $Me->bio(); ?></textarea>
    </div>
    <div class="w3-container w3-margin-top">
        <label> User Name </label>
        <input type="text" name="username" value="<?php echo $username;?>" class="w3-input w3-border" placeholder="Username">
    </div>
    <div class="w3-container w3-margin-top">
        <label> Password</label>
        <input type="password" name="password" value="" class="w3-input w3-border" placeholder="Password">
    </div>
    <div class="w3-container w3-margin-top">
        <label> Full Name</label>
        <input type="text" name="fullname" value="<?php echo $Me->fullname();?>" class="w3-input w3-border" placeholder="FullName">
    </div>
    <div class="w3-container w3-margin-top">
        <label>Gender</label>
        <select name="gender"  class="w3-input w3-border">
            <option <?php if($Me->gender() == "Male"){echo "selected";} ?>>Male</option>
            <option <?php if($Me->gender() == "Female"){echo "selected";} ?>>Female</option>
        </select>
    </div>
    <div class="w3-container w3-margin-top">
        <label> Date of Birth</label>
        <input type="date" name="dob" value="<?php echo $Me->dob();?>" class="w3-input w3-border">
    </div>
    <div class="w3-container w3-margin-top">
        <label> Email Address</label>
        <input type="email" name="email" value="<?php echo $Me->email();?>" class="w3-input w3-border" placeholder="Email Address">
    </div>
    <div class="w3-container w3-margin-top">
        <label> Phone Number</label>
        <input type="text" name="phone" value="<?php echo $Me->phone();?>" class="w3-input w3-border" placeholder="Phone Number">
    </div>
    <div class="w3-container w3-margin-top">
        <label> Address</label>
        <input type="text" name="address" value="<?php echo $Me->address();?>" class="w3-input w3-border" placeholder="Address">
    </div>
    <div class="w3-container w3-margin-top">
        <label> City</label>
        <input type="text" name="city" value="<?php echo $Me->city();?>" class="w3-input w3-border" placeholder="City or Hometown">
    </div>
    <div class="w3-container w3-margin-top">
        <label> State</label>
        <input type="text" name="state" value="<?php echo $Me->state();?>" class="w3-input w3-border" placeholder="State">
    </div>
    <div class="w3-container w3-margin-top">
        <label> Country</label>
        <input type="text" name="country" value="<?php echo $Me->country();?>" class="w3-input w3-border" placeholder="Country" value="<?php ?>">
    </div>
    <div class="w3-container w3-margin-top w3-margin-bottom">
        <input type="submit" name="submit" class="w3-button w3-blue" value="Submit">
    </div>
</div>