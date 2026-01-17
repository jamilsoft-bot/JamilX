
    

<div class="table-responsive w3-margin-top">

        <table class="table table-striped table-hover table-condensed">
            <tr>
                <th>Code</th>
                <th>Business Name</th>
                <th>Plan</th>
                <th>Location</th>
                <th>Status</th>
                <th>Operations</th>
            </tr>
<?php

                global $db,$Me;
                $myown = $Me->username();
                $sql = "SELECT * FROM `business` WHERE `owner`='$myown'";

                $row = $db->Query($sql);

                if($row->num_rows > 0){
                    //
                    foreach($row as $rw){
                    $data = json_decode($rw['data']);
                    $bname = isset($data->Bname)?$data->Bname:$data->name;
                    $location = isset($data->Bstreet)?$data->Bstreet:$data->street;
                    //$plan = isset($data->btype)?$data->btype:$data->type;
                    $code = $rw['code'];
                    $btype = $rw['data'];
                    $stats = $rw['status'];
                    $plan = $rw['plan'];
                    echo "<tr>";
                    echo "<td>". $rw['code']."</td>";
                    echo "<td> $bname</td>";
                    echo "<td> $plan</td>";
                    echo "<td> $location</td>";
                    echo "<td> $stats</td>";
                    echo "<td> <a href='dashboard&b=$code' class='btn btn-primary'>Manage</a><a href='upgrade&b=$code' class='btn btn-primary w3-margin-left'>Upgrade</a></td>";


                    }
                    
                }


?>
        </table>
    </div>
    