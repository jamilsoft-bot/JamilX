<?php
$st = isset($_GET['action'])?$_GET['action']:"apphome";
$action = new $st();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/font/css/all.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/w3.css">
    <link href='assets/lib/sum/summernote-lite.css' rel='stylesheet'>


<script src='assets/lib/jq/jq.js'></script>
<script src='assets/js/swt.js'></script>

<script src="assets/lib/sum/summernote-lite.js"></script>
</head>
<body>
<style>
    body{
        background-color: whitesmoke;
    }
    a{
        text-decoration: none;
    }
    .content{
        min-height: 100pt;
        background-color: white;
    }
</style>
<?php
                 
                 $action->addAction();
?>   
<div class="w3-display-container" style="height:600px;">
  
  <div class="w3-padding  w3-display-middle">
      <h1>Welcome to JamilX Application Development Kit</h1>
      <div class="w3-bar">
          <a href="sdkservice" class="w3-bar-item w3-hover-blue" style="text-decoration: none;">Sample Service</a>
          <a href="?action=sdkaction" class="w3-bar-item w3-hover-blue" style="text-decoration: none;">Sample Action</a>
          <a href="jxdoc" class="w3-bar-item w3-hover-blue" style="text-decoration: none;">Documentations</a>
      </div>

  </div>
  
</div>

















<script>
function quickNavs() {
    var x = document.getElementById("Demo");
    if (x.className.indexOf("w3-show") == -1) { 
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
</body>
</html>