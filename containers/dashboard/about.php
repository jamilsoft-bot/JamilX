<?php
global $Url,$db;
$name = null;
$detail = $Url->post('about');
$logo = null;
$data = null;
$cd =$Url->get('b');
$sql_select = "SELECT * FROM `option` WHERE `name`='about'";
$sql_insert = "INSERT INTO `options`(`name`,`value`)VALUES('','')";
$sql_update = "UPDATE `options` SET `value` = '' WHERE `name` = ''";

                
    // $result = $db->Query($sql_select);
    // if($result->num_rows > 0){
    //     foreach($result as $r){
    //         $data = $r['value'];
    //     }
    // }

?>

<header class="w3-container w3-flat-wet-asphalt">
    <div class="container">
        <div class="row">
            <div class="col-md-7 ">
                    <h1>
                        About

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