<?php include "installer.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to JamilX</title>
    <link rel="stylesheet" href="../assets/lib/w3/w3.css">
    <link rel="stylesheet" href="../assets/lib/font/css/all.css">
    <link rel="stylesheet" href="../assets/lib/bs5/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/lib/sum/summernote-lite.css"> -->
    <style>
        .flex-container {
          display: flex;
          justify-content: center;
          align-items: center;
          min-height: 400pt;
        }
        
        .flex-container > div {
          width: 100%;
          margin: 10px;
          text-align: center;
          line-height: 30px;
          
        }
        </style>
</head>
<body>
    
     <header class="w3-container w3-center w3-blue" >
         <h3>Welcome</h3>
     </header>
    
    <div class="flex-container">
    <?php

          $install = new installer();
            

            $url = isset($_GET['action'])?$_GET['action']:null;
            $action = is_null($url)?"home":$url;

            if(function_exists($install->$action())){
              $install->$action();
            }

 



    ?>
      </div>
      
      <footer class="w3-container w3-center w3-blue" >
        <h4>&copy; 2021-2022 Jamilsoft All Right Researved</h4>
    </footer>
      
</body>
</html>