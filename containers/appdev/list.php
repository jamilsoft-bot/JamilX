<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <script src="assets/tailwindcss.js"></script>

</head>
<body>
    <header class="rounded-t-lg bg-blue-600 px-4 py-3 text-white">
    <h2 class="text-lg font-semibold">Available Apps</h2>
</header>
<div class="rounded-b-lg bg-white px-4 py-4 shadow-sm">
    <?php 


    global $APP;
$path = "Apps/";
$aps = scandir($path);
unset($aps[0]);
unset($aps[1]);
$status = [
    "icon" => "",
    "link" => "", 
];

foreach($aps as $ap){
    $install_display_option = "";
    $uninstall_display_option = "display:none";
    $path = "Apps/$ap/conf.json";
    $info = json_decode(file_get_contents($path));
    $tags = str_getcsv($info->tag);
    $appdir = $ap;
    $appname = $info->Name;
    $logo = isset($info->logo)?$info->logo: null;
    $author = isset($info->author)?$info->author: "Jamilsoft";
    $website = isset($info->website)?$info->website: "http://jamilsoft.com.ng";
    $version = isset($info->version)?$info->version: " null";
    
    echo "<ul class='space-y-4'>";
    include "containers/admin/app-card.php";
	//echo "i see nothing";
    echo "</ul>";
}



    





?>
</div>

</body>
</html>