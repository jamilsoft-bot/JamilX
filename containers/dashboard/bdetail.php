<?php
global $Url,$db;
$name = null;
$detail = null;
$logo = null;
$data = null;
$cd =$Url->get('b');
$sql = "SELECT * FROM `business` WHERE code='$cd'";

                $row = $db->Query($sql);
   
    foreach($row as $r){
        $json =  $r['data'];
        $data= json_decode($json);
    }
    

?>

<header class="w3-container w3-flat-wet-asphalt">
    <div class="container">
        <div class="row">
            <div class="col-md-7 ">
                    <h1>
                <?php echo $data->name;?>

                    </h1>
            </div>
        
        </div>
        
    </div>
</header>
<div class="w3-container content">

    
    <h1>
           <?php
            $test = "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Possimus iste culpa debitis dolor nobis cum excepturi quam et facere beatae, ab unde optio non tempora ratione blanditiis! Voluptates, voluptatum asperiores.";
            echo substr($test,0,25) . "...";
           ?>
       </h1>
</div>