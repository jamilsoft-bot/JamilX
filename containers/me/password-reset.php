
    <style>
input,select {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}
hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}
    </style>


<?php
$pag = isset($_GET['step'])?$_GET['step']: "";
?>


<?php 
    if($pag == "sentmail"){

    ?>
<form action="test.php"  method="post">
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 md-2"></div>
            <div class="col-7 md-7 w3-card w3-margin">
                <div class="row">
                    <div class="col-3 md-3 w3-green" style="text-align: center;">
                    <div class="container-fluid">
                        <span class="fa fa-walking w3-padding " style="font-size: 160pt;"></span>
                    </div>
                </div>
                    <div class="col-8 md-8">
                        <header class="js-container w3-border-green">
                            <h1> Password Reset</h1>
                            <p>Type A registered Email Address to recieve A password reset link</p>
                        </header>
                        <label>Email Address</label>
                        <input type="email" name="Email" id="email" placeholder="Email Address">
                     <input type="submit" class="w3-btn w3-brown" name="submit" id="submit">
    
                    </div>
                </div>
            </div>
            <div class="col-2 md-2"></div>
    
        </div>
    </div>
</form>
<?php }
elseif ($pag =="resetpass") {


?>
<form action="test.php"  method="post">
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 md-2"></div>
            <div class="col-7 md-7 w3-card w3-margin">
                <div class="row">
                    <div class="col-3 md-3 w3-green" style="text-align: center;">
                    <div class="container-fluid">
                        <span class="fa fa-walking w3-padding " style="font-size: 160pt;"></span>
                    </div>
    
                    </div>
                    <div class="col-8 md-8">
                        <header class="js-container w3-border-green">
                            <h1> Password Reset</h1>
                        </header>
                        <label>New Password</label>
                        <input type="password" name="password" id="email" placeholder="New Password">
                        
                    
                    
                
                <input type="submit" class="w3-btn w3-brown" name="submit" id="submit">
    
                    </div>
                </div>
            </div>
            <div class="col-2 md-2"></div>
    
        </div>
    </div>
</form>
<?php
}
else{}


?>
