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
                                 <th>Type</th>
                                 <th>Value</th>
                                 <th>Brand</th>
                                 <th>Owner</th>
                                 <th>Date created</th>
                                 <th>Operation</th>
                             </tr>
                             <?php
                                 
                                 global $db, $JX_db;
                                    $code = isset($_GET['b'])?$_GET['b']: $_SESSION['uid'];
                                    $sql = "SELECT * FROM `offers` WHERE  `owner`='$code'";

                                    $row = $JX_db->query($sql);

                                    foreach($row as $r){
                                        
                                        $id = $r['id'];
                                        $code = $_GET['b'];
                                        $type = $r['type'];
                                        $link = $r['link'];
                                        $brand = null;
                                        $owner = null;
                                        echo "<tr>";
                                        echo "<td>". $r['id'] . "</td>";
                                        echo "<td>". $r['name']. "</td>";
                                        echo "<td>". $r['type']. "</td>";
                                        echo "<td>$link</td>";
                                        echo "<td>". $r['brand']. "</td>";
                                        echo "<td>". $r['owner']. "</td>";
                                        echo "<td>". $r['date'] . "</td>";
                                        echo "<td> <a href='dashboard?b=$code&action=productview&pid=$id' class='btn btn-primary'><i class='fa fa-eye'></i></a><a href='dashboard?b=$code&action=offerupdate&oid=$id' class='btn btn-secondary w3-margin-left'><i class='fa fa-edit'></i></a><a href='dashboard?b=$code&action=offers&del=$id' class='btn btn-danger w3-margin-left'><i class='fa fa-trash'></i></a> </td>";
                                    }
                                    
                                ?>
                         </table>
                     </div>
                     
                </div>