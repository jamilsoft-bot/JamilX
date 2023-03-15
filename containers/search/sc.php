
<?php

include "header.php";
    if(isset($_COOKIE['visited'])){
        
    }else{
        
        echo "<script>";
        echo "location.assign('about')";
        echo "</script>";
    }

    addHit("visitor",'search');  
?>
<style>
    .body{
        background: repeating-linear-gradient(24deg,cyan,white, coral,white,cyan, white ,lightgreen);;
       
    }
    a{
        text-decoration: none;
        color: black;
    }
    a:visited{
      color: grey;
    }
    
</style>
<div class="s004 body">
      <form action="search" method="post">
        <center>
        <img src="assets/images/lg.png" style="width: 100pt;">
        </center>
        <fieldset>
          <!-- <legend style="letter-spacing: 6px;font-size:34pt;color:black">Jamilsoft</legend> -->
          <div class="inner-form">
            <div class="input-field">
              <input class="form-control" name='q' id="q"  type="text" placeholder="Type to search..." />
              <button class="btn-search" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                </svg>
              </button>
            </div>
          </div>
          <center>
          <div class="suggestion-wrap" style="color:black">
            <span><a href="about">About us</a></span>
            <span><a href="addbus">Add Business</a></span>
            <span><a href="about#contact">Contact us</a></span>
            <!-- <span>Accessories</span>
            <span>Sale</span> -->
          </div>
          <?php
           
           //echo session_status();
          global $Me, $SUID;

          echo "<a href='me'>". $Me->username() ."</a>";
           
          if(isset($_SESSION['uid'])){
                echo "<br><a href='passgate?action=logout'>Sign out</a>";
               // echo $_SESSION['uid'];
          }else{
            echo "<a href='login'>Sign in</a>";
          }

          ?>
          <!-- <a href="login">Sign in</a> -->
          <hr style="margin-top: 76pt;">
          <p id="cp">&copy;2021 Jamilsoft Technologies</p>

          </center>

        </fieldset>
      </form>
    </div>

    
    <script src="assets/js/choices.js"></script>
    <script>
      dc = document.getElementById('cp');
      dat = new Date();
      dc.innerHTML = "&copy; 2020-" + dat.getFullYear() + " Jamilsoft Technologies";
      var textPresetVal = new Choices('#q',
      {
        removeItemButton: true,
      });

    </script>

    <?php 

include "footer.php";?>