
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Apps/jamilpress/assets/lib/w3/w3.css">
    <link rel="stylesheet" href="Apps/jamilpress/assets/lib/font/css/all.css">
    <link rel="stylesheet" href="Apps/jamilpress/assets/lib/bs5/css/bootstrap.min.css">
    <link rel="stylesheet" href="Apps/jamilpress/assets/lib/sum/summernote-lite.css">
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
    
     <!-- <header class="w3-container w3-center w3-blue" >
         <h3>Welcome</h3>
     </header> -->
    
    <div class="flex-container">
        <div class="w3-center" style="width: 50%;">
            <div class="w3-container w3-center w3-margin">
                <img src="Apps/jamilpress/assets/images/jamilpress.png" style="height: 150px;width: 150px;" >
                <h1>Jamilsoft</h1>
            </div>
            <div class="w3-card-4 w3-margin-bottom">
                    <div class="w3-container w3-blue" id="jqt">
                        <h2>Incorrect Access</h2>
                    </div>
                    <div class="w3-container" style="overflow: auto;">
                        <?php echo $message;?>
                    </div>
                    <div class="w3-container w3-center">
                        <a id="btn" href="<?php echo $linkback;?>" class="w3-button w3-blue w3-round-xlarge w3-margin " style="width: 90pt;">Next</a>
                    </div>
            </div>
        </div>
      </div>
      
      <footer class="w3-container w3-center " >
        <h4 class="w3-opacity">&copy; 2021 Microteams All Right Researved</h4>
    </footer>
    
    

</body>
</html>