<?php

function ecconfirm_item(){
    global $Url, $JX_db;
    if($Url->get('confirm') !== null){
        $id = $Url->get('id');
            $code = $Url->get('b');
            $link = "?action=".$Url->get('action');
        echo "<div class='w3-margin-top'>";
        echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Order Alert!</strong><br> Are you Sure, You want to Approved this Order?.<br>";
            echo "<br><a href='$link&yes=$id' class='btn btn-danger '>Comfrim Paid</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
        echo "</div></div>";
        
    }

        if($Url->get('yes') !== null){
            $id = $Url->get('yes');
            $idx = intval($id);
            $sql = "UPDATE `orders` SET `status`='success' WHERE `id`=$idx";
            if($JX_db->query($sql)){
                echo "<div class='w3-margin-top'>";
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Order Alert!</strong> the Item was successfully Approved.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div></div>";
            }
}
}