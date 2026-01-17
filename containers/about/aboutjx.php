<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
    <link rel="stylesheet" href="assets/css/jamilpress.css">
    <link rel="stylesheet" href="assets/lib/w3/w3.css">
    <link rel="shortcut icon" href="assets/images/kamallogo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/lib/font/css/all.css">
    <link rel="stylesheet" href="assets/lib/bs5/css/bootstrap.min.css">
</head>
<body class="w3-sand">
<style>
        .flex-containerx {
          display: flex;
          justify-content: center;
          align-items: center;
          min-height: 400pt;
        }
        
        .flex-containerx > div {
          width: 100%;
          margin: 10px;
          text-align: center;
          line-height: 30px;
          
        }
</style>
<div class="w3-containerx ">
    <header class="w3-container w3-center w3-blue" >
            <h3>Thank You For Choosing JamilX</h3>
    </header>
        
        <div class="flex-containerx ">
            <div class="w3-center">
                <img src="assets/images/jslogobird.png" style="height: 150px;width: 150px;" >
                <h1>Jamilsoft</h1>
                <h3>PHP Framework for Everyone</h3>
                <a href="https://paystack.com/pay/jamilsoft" class="w3-button w3-blue w3-round-xlarge">Donate</a>
            </div>
        </div>
        
        <footer class="w3-container w3-bottom w3-center w3-blue" >
            <h4>&copy; <span id="copyr"></span> Jamilsoft All Right Researved</h4>
        </footer>
</div>
    
<script>
    var x = document.getElementById("copyr")
    var dt = new Date();
    x.innerHTML = "2021-" + dt.getFullYear()
</script>
</body>
</html>