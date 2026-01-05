<?php
global $JX_db, $Me, $Url;
$code2 = $Url->get('b');
$sql = "SELECT * FROM `business` WHERE `code` ='$code2'";

$result = $JX_db->query($sql);

$json = null;
$logo = null;

if($result){
    foreach($result as $r){
        $json = json_decode($r['data']);
        $logo = $r['logo'];
}
}else{
    echo $JX_db->error;
}


?>
<style>
    label{
        color:blue;
        font-weight: bold;
        margin-top: 12pt;
        margin-bottom: 12pt;
    }
    
</style>
<header class="w3-container text-center w3-blue">
    <h1>Business Updator </h1>
</header>
<div class="row">
    
    <div class="col-12 w3-card  w3-margin" >
        <div class="w3-bar w3-margin-top">
            <li class="w3-bar-item w3-right w3-button"><span class="fas fa-power-off"></span></li>
        </div>
        <div class="w3-margin w3-padding">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 text-center">
                <label>Business Logo</label>
            <input type="file" class="w3-input w3-center w3-border w3-border-blue w3-bottombar"  name="logo" id="blogo">
        
                </div>
                <div class="col-md-4"></div>
            </div>
           
        </div>
        <div class="row ">
            <div class="col-md-6 w3-container">
                <label>Business Name</label>
                <input type="text" value="<?php echo $json->name;?>" class="w3-border w3-border-blue w3-bottombar w3-input"   name="name" placeholder="e.g Jamilsoft Technologies">
            </div>
            <div class="col-md-6 w3-container">
                <label>Business Description</label>
                <input type="text" value="<?php echo $json->summary;?>" class="w3-border w3-border-blue w3-bottombar  w3-input"  name="summary" placeholder="Type Business Summary">
            </div>
            <div class="col-md-6 w3-container">
                <label>Business Industry</label>
                <select name="industry" class="w3-input w3-border w3-border-blue w3-bottombar ">
                    <option>Health </option>
                    <option>Education </option>
                    <option>Technology </option>
                    <option>Other </option>
                </select>
            </div>
            <div class="col-md-6 w3-container">
                <label>Business Street</label>
                <input type="text" value="<?php echo $json->street;?>" class="w3-input w3-border w3-border-blue w3-bottombar " name="street" placeholder="e.g Gwallaga Street">
            </div>
            <div class="col-md-6 w3-container">
                <label>Business Country</label>
                <select name="country" class="w3-input w3-border w3-border-blue w3-bottombar " id="cid"></select>
            </div>
            <div class="col-md-6 w3-container">
                <label>Business State/City</label>
                <input type="text" value="<?php echo $json->city;?>" class="w3-input w3-border w3-border-blue w3-bottombar " name="city" placeholder="e.g Alkaleri/Bauchi">
            </div>
            <div class="col-md-6 w3-container">
                <label>Business Phone</label>
                <input type="text" value="<?php echo $json->phone;?>" class="w3-input w3-border w3-border-blue w3-bottombar " name="phone" placeholder="with country code e.g +234">
            </div>
            <div class="col-md-6 w3-container">
                <label>Business Website</label>
                <input type="text" value="<?php echo $json->website;?>" class="w3-input w3-border w3-border-blue w3-bottombar " name="website" placeholder="https://.....">
            </div>
            <div class="col-md-6 w3-container">
                <label>Business Email</label>
                <input type="email" value="<?php echo $json->email;?>" class="w3-input w3-border w3-border-blue w3-bottombar " name="email" placeholder="someone@something.com">
            </div>
            <div class="col-md-6 w3-container">
                <label>Business RC Code (optional)</label>
                <input type="text" value="<?php echo $json->rc;?>" class="w3-input w3-border w3-border-blue w3-bottombar " name="rc" placeholder="RC, BN, Etc">
            </div>
            <div class="col-md-6 w3-container">
                <label><i class="fab fa-facebook"></i> Business facebook</label>
                <input type="text" value="<?php echo $json->facebook;?>" class="w3-input w3-border w3-border-blue w3-bottombar " name="facebook" placeholder="https://fb.me/someone">
            </div>
            <div class="col-md-6 w3-container">
                <label><i class="fab fa-twitter"></i> Business Twiter</label>
                <input type="text" value="<?php echo $json->twitter;?>" class="w3-input w3-border w3-border-blue w3-bottombar " name="twitter" placeholder="https://t.co/someone ">
            </div>
            <div class="col-md-6 w3-container">
                <label><i class="fab fa-youtube"></i> Business Youtube </label>
                <input type="text" value="<?php echo $json->youtube;?>" class="w3-input w3-border w3-border-blue w3-bottombar " name="youtube" placeholder="https://...">
            </div>
            <div class="col-md-6 w3-container">
                <label><i class="fab fa-instagram"></i> Business Instagram </label>
                <input type="text" value="<?php echo $json->instagram;?>" class="w3-input w3-border w3-border-blue w3-bottombar " name="instagram" placeholder="https://instagram.com/someone ">
            </div>
            <div class="w3-margin w3-padding">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <input type="submit" class="w3-input w3-button w3-blue"  name="submit" value="Update Now">
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        </div>
    </div>
    
</div>