<?php

    if(isset($_COOKIE['guest'])){
        echo "cookie is set";
    }else{
        setcookie("guest",uniqid());
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Apps/jamilpress/assets/lib/w3/w3.css">
</head>
<body class="w3-blue">
    <h1><?php echo __FILE__; ?>welcome to <?php echo $blog->getName();?></h1>
    <div style="overflow: scroll;">
        <p><?php echo $blog->getContent();?></p>
    </div>
</body>
</html>