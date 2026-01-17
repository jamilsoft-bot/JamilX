<h4>App List</h4>
<div class="row">
    <?php 
    
    global $JX_db,$Apps;
    $sql = "SELECT * FROM `apps`";
    $res = $JX_db->query($sql);

    foreach($res as $s){
        $appname = $s['app_name'];
        $data = $Apps->getApp($s['app_name']);
        $logo = $data->logo;
        $tooltip = $data->Summary;
        include "app-card.php";
    }

    
    
    
    ?>
    
</div>