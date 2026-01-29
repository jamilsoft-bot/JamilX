<div id="id01" class="hidden fixed inset-0 z-50 overflow-y-auto">
  <div class="flex min-h-screen items-center justify-center bg-slate-900/50 px-4 py-8">
    <div class="w-full max-w-3xl overflow-hidden rounded-2xl bg-white shadow-xl">
      <header class="flex items-center justify-between bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-4 text-white">
        <h2 class="text-lg font-semibold">Switch Business</h2>
        <button onclick="document.getElementById('id01').classList.add('hidden')" class="rounded-full bg-white/10 p-2 text-white hover:bg-white/20">&times;</button>
      </header>

      <div class="p-6">
        <?php include "containers/dashboard/buslist.php" ?>
      </div>

      <footer class="bg-slate-50 px-6 py-4 text-sm text-slate-500">
        &copy; Jamilsoft Technologies
      </footer>
    </div>
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
  if (event.target === modal) {
    modal.classList.add("hidden");
  }
}
     loadCountries("cid","Nigeria");
</script>
</body>
</html>
