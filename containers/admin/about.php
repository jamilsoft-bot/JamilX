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
<div class="w3-container ">
    <header class="w3-container w3-center w3-blue" >
            <h3>Thank You For Choosing Jamilx</h3>
    </header>
        
        <div class="flex-containerx w3-sand">
            <div class="w3-center">
                <img src="assets/images/jslogobird.png" style="height: 150px;width: 150px;" >
                <h1>Jamilx</h1>
                <h3>PHP Framework for Everyone</h3>
                <a href="https://paystack.com/pay/jamilsoft" class="w3-button w3-blue w3-round-xlarge">Donate</a>
            </div>
        </div>
        
        <footer class="w3-container w3-center w3-blue" >
            <h4>&copy; <span id="copyr"></span> Jamilsoft All Right Researved</h4>
        </footer>
</div>
    
<script>
    var x = document.getElementById("copyr")
    var dt = new Date();
    x.innerHTML = "2021-" + dt.getFullYear()
</script>