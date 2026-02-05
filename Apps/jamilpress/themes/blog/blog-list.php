<header class="w3-container w3-blue ">
                    <h3> <?php echo $this->getTitle(); ?></h3>
</header>
                <div class="w3-container content">
                <div class="w3-bar w3-border  w3-margin-top w3-light-grey">
                    <a href="#" class="w3-bar-item  w3-border-right w3-mobile w3-button">Create</a>
                    <a href="#" class="w3-bar-item  w3-border-right w3-mobile w3-button">List</a>
                    <!-- <a href="#" class="w3-bar-item w3-btn">Create</a> -->
                </div>
                     <div class="table-responsive w3-margin-top">
                         <table class="table table-hover table-striped">
                             <tr>
                                 <th>Id</th>
                                 <th>Name</th>
                                 <th>Owner</th>
                                 <th>Link</th>
                                 <th>Date created</th>
                                 <th>Operation</th>
                             </tr>
                             <?php
                                 
                                 global $db;
                                    $bcode = $_GET['b'];
                                    $sql = "SELECT * FROM `blogs` WHERE   `owner`='$bcode'";

                                    $row = $db->Query($sql);

                                    foreach($row as $r){
                                        
                                        $id = $r['id'];
                                        $code = $r['url'] ;
                                        echo "<tr>";
                                        echo "<td>". $r['id'] . "</td>";
                                        echo "<td>". $r['name']. "</td>";
                                        echo "<td>". $r['owner'] . "</td>";
                                        echo "<td>/". $r['url'] . "</td>";
                                        echo "<td>". get_default_date($r['date_reg']) . "</td>";
                                        echo "<td> <a href='$code' class='btn btn-primary'>View</a><a href='dashboard?b=$bcode&action=pageupdate&bid=$id' class='btn btn-secondary w3-margin-left'>Update</a><a href='dashboard?b=$bcode&action=pages&del=$id' class='btn btn-danger w3-margin-left'>Delete</a> </td>";
                                    }
                                    
                                ?>
                         </table>
                     </div>
                     
                </div>