<?php include "header.php";?>
<body>
<?php include "nav.php";?>

<div class="w3-container ">
    <div class="row">
        <div class="col-md-3">
            <?php include "sidebar.php";?>
        </div>
        <div class="col-md">
            
          <div class="container">
              <?php include "top-header.php";?>
            <?php
           if($act !== null){
               $act->getAction();
           }

           
            ?>
          </div>
        </div> 
        
    </div>
</div>

<?php include "footer.php";?>