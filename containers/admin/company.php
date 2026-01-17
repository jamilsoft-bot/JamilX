<style>
  label{
    color: blue;
    margin: 5px;
  }
</style>
<div class="container">
<div class="w3-card">

<header class="w3-container w3-blue">
    <h3>Company Information</h3>
</header>

<div class="w3-container row">
  <div class="col md">
      <label>Company Name</label>
      <input type="text" name="name" class="w3-input w3-border w3-border-blue w3-bottombar" value="<?php echo $info->name; ?>" placeholder="Company name">
      <label>Company Description</label>
      <input type="text" name="summary" value="<?php echo $info->summary; ?>" class="w3-input w3-border w3-border-blue w3-bottombar" placeholder="Company Description">
      <label>Company Industry</label>
      <input type="text" name="industry" value="<?php echo $info->industry; ?>" class="w3-input w3-border w3-border-blue w3-bottombar" placeholder="E.g ICT, Agriculture etc.">
      <label>Country</label>
      <input type="text" name="country" value="<?php echo $info->country; ?>" class="w3-input w3-border w3-border-blue w3-bottombar" placeholder="Company headquarter">
      <label>Company City</label>
      <input type="text" name="city" value="<?php echo $info->city; ?>" class="w3-input w3-border w3-border-blue w3-bottombar" placeholder="City/State">
      
  </div>

  <div class="col md">
      <label>Company street Address</label>
      <input type="text" name="street" value="<?php echo $info->street; ?>" class="w3-input w3-border w3-border-blue w3-bottombar" placeholder="Company location">
      <label>Company website</label>
      <input type="text" name="website" value="<?php echo $info->website; ?>" class="w3-input w3-border w3-border-blue w3-bottombar" placeholder="www.mycompany.com">
      <label>Company Email Address</label>
      <input type="text" name="email" value="<?php echo $info->email; ?>" class="w3-input w3-border w3-border-blue w3-bottombar" placeholder="info@mycompany.com">
      <label>Company phone</label>
      <input type="text" name="phone" value="<?php echo $info->phone; ?>" class="w3-input w3-border w3-border-blue w3-bottombar" placeholder="international format ">
      <label>RC Code or Equivalent (optional)</label>
      <input type="text" name="rc" value="<?php echo $info->rc; ?>" class="w3-input w3-border w3-border-blue w3-bottombar" placeholder="RC, BN etc">
</div>
</div>
<div class="w3-center w3-bar">
 
  <!-- <input type="button" id='bk' name="button" value="Back" class="w3-button w3-light-blue w3-input w3-bar-item w3-margin-top" style="width: 50%;"> -->
  <input type="submit" name="submit" value="Complete" class="w3-button w3-blue w3-input w3-bar-item w3-margin">

</div>
</div>
</div>



