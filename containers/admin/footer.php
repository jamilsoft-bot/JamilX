<?php
get_main_scripts();
?>
<script>
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