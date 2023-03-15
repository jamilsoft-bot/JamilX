<?php global $db;?>
<div class=" w3-white">
  <header class="w3-container w3-blue">
    <h3>Business List</h3>
  </header>
  <div class="w3-container">
  <?php

                        $sql = "SELECT *FROM `business`";
                        $result = $db->Query($sql);

                        foreach($result as $r){
                            $json = $r['data'];
                            $data = json_decode($json);
                            $name = isset($data->Bname)?$data->Bname:$data->name;
                            
                            $type = isset($data->btype)?$data->btype:$r['plan'];
                            $des = isset($data->Bdec)?$data->Bdec:$data->summary;//$data->Bdec;
                            $city = isset($data->Bcity)?$data->Bcity:$data->city;//$data->Bcity;
                            $logo = $r['logo'];
                            $id = $r['code'];
                            $date_d = new DateTime($r['date_created']);
                            $date = $date_d->format("D d,M Y");
                            echo "<ul class='w3-ul'>";
                            include "bus-card.php";
                            echo "</ul>";
                        }

                    ?>
  </div>
</div>
                  
                  
              
              