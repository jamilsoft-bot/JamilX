<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Access</title>
    <link rel="stylesheet" href="assets/lib/w3/w3.css">
    <link rel="stylesheet" href="assets/lib/bs5/css/bootstrap.min.css">

<style>
        .flex-containerx {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 400pt;
    
  }
  
  .flex-containerx > div {   
    margin: 5px;
    text-align: center;
    min-width: 400pt;
    overflow: auto;
    
  }
    </style>
</head>
<body>    
  <div class="flex-containerx">
      <div class="">
      <img src="assets/images/js-offline.png" style="width: 400pt;height:300pt">
      </div>
      <div class="">
            <h1 class="w3-border-blue w3-bottombar w3-margin-bottom"> Resource Not Found</h1>
            <h3>The resource you're looking was not found on the server</h3>
            <a href="dashboard" class="w3-button w3-blue">Go to Dashboard</a>
      </div>
  </div>

<div class="w3-center">
    <p class="w3-opacity">&copy; 2022 Powered by Jamilsoft</p>
</div>


<?php
    get_main_scripts();
?>
</body>
</html>