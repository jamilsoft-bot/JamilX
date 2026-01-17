<?php

function createApp(){
    
    if(isset($_POST['createappbtn'])){
        unset($_POST['createappbtn']);
        $appnick = $_POST['Nick'];
        $json = json_encode($_POST);
        
        $creatdata = new AppData($appnick);
        $creatdata->createdr();
        $creatdata->createData();
        file_put_contents("Apps/$appnick/conf.json",$json);
        JX_Alert("Your App Was Sucessfully Created!, Go to Apps to Activate it");
    }

}
createApp();
?>
<div class="w3-container w3-bottombar w3-border-blue">
    <h1 class="w3-text-blue">Create An App</h1>
</div>
<form action="" method="post">
    <div class="w3-container m-2 p-2">
        <div class="row">
            <div class="col-md-5  m-2">
                <label class="w3-text-blue">App Full Name</label>
                <input type="text" name="Name"  class="w3-input w3-border  w3-border-blue w3-leftbar">
            </div>
            <div class="col-md-5  m-2">
                <label class="w3-text-blue">App Nickname(no space)</label>
                <input type="text" name="Nick"  class="w3-input w3-border w3-border-blue w3-leftbar">
            </div>
            <div class="col-md-5  m-2">
                <label class="w3-text-blue">App Summary</label>
                <input type="text" name="Summary"  class="w3-input w3-border w3-border-blue w3-leftbar">
            </div>
            <div class="col-md-5  m-2">
                <label class="w3-text-blue">App Author</label>
                <input type="text" name="author"  class="w3-input w3-border w3-border-blue w3-leftbar">
            </div>
            <div class="col-md-5  m-2">
                <label class="w3-text-blue">App Website</label>
                <input type="text" name="website"  class="w3-input w3-border w3-border-blue w3-leftbar">
            </div>
            <div class="col-md-5  m-2">
                <label class="w3-text-blue">App Email</label>
                <input type="text" name="email"  class="w3-input w3-border w3-border-blue w3-leftbar">
            </div>
            <div class="col-md-5  m-2">
                <input type="hidden" name="version" value="0.1"  class="w3-input w3-border w3-border-blue w3-leftbar">
                <input type="hidden" name="logo" value="path/to/your/logo"  class="w3-input w3-border w3-border-blue w3-leftbar">

            </div>
            <div class="col-md-5  m-2">
                <input type="submit" name="createappbtn"  class="w3-button w3-hover-blue w3-white w3-input w3-border w3-border-blue w3-leftbar">
            </div>

        </div>
    </div>
</form>