<header class="w3-container w3-blue">
    <h2>Available Apps</h2>
</header>
<div class="w3-container w3-white">
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
    $tags = str_getcsv($info->Tag);
    $appdir = $ap;
    $appname = $info->Name;
    $logo = isset($info->logo)?$info->logo: null;
    $author = isset($info->author)?$info->author: "Jamilsoft";
    $website = isset($info->website)?$info->website: "http://jamilsoft.com.ng";
    $version = isset($info->version)?$info->version: " null";
    
    echo "<ul class='w3-ul'>";
    include "containers/admin/app-card.php";
    echo "</ul>";
}



    





?>
</div>