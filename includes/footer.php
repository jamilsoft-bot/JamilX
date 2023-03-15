
<?php
global $Url;

$about = $Url->get('serve');
if($about !== 'admin'){
get_main_scripts();
bus_scripts();
about_scripts();
	
}else{
  

}


?>
<script src="assets/sum/summernote-lite.js"></script>
<!-- <script src="assets/editor/ckeditor.js"></script> -->

<script>
	// CKEDITOR.replace('pid');
	$(document).ready(function() {
  $('#pid').summernote({
		
        tabsize: 2,
        height: 300
  });
});
    
    loadCountries("cid","");
    
    </script>
</body>
</html>