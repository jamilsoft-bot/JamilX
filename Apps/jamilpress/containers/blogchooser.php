<div id="id01" class="w3-modal w3-animate-zoom">
            <div class="w3-modal-content">
          
              <header class="w3-container w3-center w3-light-blue">
                <span onclick="document.getElementById('id01').style.display='none'"
                class="w3-button w3-display-topright">&times;</span>
                <h2>Blog Chooser</h2>
</header>
          
              <div class="w3-container w3-margin-bottom">
                    <!--==========================-->
                        <?php 
                         $plist = new JP_Bloglist();
                        include "blog-list.php";
                        
                        ?>
                    <!--===========================-->
              </div>
          
              <footer class="w3-container w3-center w3-light-gray">
                <p>&copy; Jamilsoft Technlogies 2022</p>
              </footer>
          
            </div>
          </div>