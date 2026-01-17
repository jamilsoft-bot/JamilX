<?php include "header.php";?>
    <?php include "nav.php";?>
    <div class="w3-container">
        <div class="row">
            <?php //include "sidebar.php";?>
            <div class="col-md">
                <div class="w3-container w3-margin-top">
                        <header class="w3-container w3-border-blue w3-bottombar">
                            <h3><?php echo $getAction->getTitle();?></h3>
                        </header>
                        <div class="w3-container">
                            <?php $getAction->getAction();?>
                        </div>
                </div>
                
            </div>
        </div>
    </div>

    <script src="assets/lib/bs5/js/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/w3/w3.js"></script>
      <script>
      function showNav() {
          var x = document.getElementById("nav");
          if (x.className.indexOf("w3-show") == -1) { 
              x.className += " w3-show";
          } else {
              x.className = x.className.replace(" w3-show", "");
          }
      }
      </script>
</body>
</html>