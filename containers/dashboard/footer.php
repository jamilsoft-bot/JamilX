<div id="id01" class="w3-modal w3-animate-zoom">
  <div class="w3-modal-content">

    <header class="w3-container w3-blue">
      <span onclick="document.getElementById('id01').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      <h2>Switch Business</h2>
    </header>

    <div class="w3-container">
      <?php include "containers/dashboard/buslist.php" ?>
    </div>

    <footer class="w3-container w3-blue">
      <p>&copy; Jamilsoft Technologies</p>
    </footer>

  </div>
</div>
<?php
get_main_scripts();

?>
<script src="assets/sum/summernote-lite.js"></script>
<script>
  $(document).ready(function() {
  $('#pid').summernote({
		
        tabsize: 2,
        height: 300
  });
});
var modal = document.getElementById('id01');

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
     loadCountries("cid","Nigeria");
</script>
</body>
</html>