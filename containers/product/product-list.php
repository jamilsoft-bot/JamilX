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
                                 <th>Prices</th>
                                 <th>Brand</th>
                                 <th>Owner</th>
                                 <th>Date created</th>
                                 <th>Operation</th>
                             </tr>
                             <?php
                                 
                                 global $db;
                                    $code = $_GET['b'];
                                    $sql = "SELECT * FROM `products` WHERE  `owner`='$code'";

                                    $row = $db->Query($sql);

                                    foreach($row as $r){
                                        
                                        $id = $r['id'];
                                        $code = $_GET['b'];
                                        $price = $r['price'];
                                        $sale = $r['sale'];
                                        $brand = null;
                                        $owner = null;
                                        echo "<tr>";
                                        echo "<td>". $r['id'] . "</td>";
                                        echo "<td>". $r['name']. "</td>";
                                        echo "<td>". $r['type']. "</td>";
                                        echo "<td>N$price/N$sale</td>";
                                        echo "<td>". $r['brand']. "</td>";
                                        echo "<td>". $r['owner']. "</td>";
                                        echo "<td>". $r['date'] . "</td>";
                                        echo "<td> <a href='dashboard?b=$code&action=productview&pid=$id' class='btn btn-primary'><i class='fa fa-eye'></i></a><a href='dashboard?b=$code&action=productupdate&pid=$id' class='btn btn-secondary w3-margin-left'><i class='fa fa-edit'></i></a><a href='dashboard?b=$code&action=products&del=$id' class='btn btn-danger w3-margin-left'><i class='fa fa-trash'></i></a> </td>";
                                    }
                                    
                                ?>
                         </table>
                     </div>
                     
                </div>