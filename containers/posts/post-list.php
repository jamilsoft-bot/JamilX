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
                                 <th>Title</th>
                                 <th>blog</th>
                                 <th>Comments</th>
                                 <th>Date created</th>
                                 <th>Operation</th>
                             </tr>
                             <?php
                                 
                                 global $db;
                                    $code = $_GET['b'];
                                    $sql = "SELECT * FROM `posts` WHERE `type`='post' AND `owner`='$code'";

                                    $row = $db->Query($sql);

                                    foreach($row as $r){
                                        
                                        $id = $r['id'];
                                        $code = $_GET['b'];
                                        $blog = $r['blog'];
                                        $sql2 = "SELECT *FROM `comments` WHERE `post_id`=$id";
                                        $re = $db->Query($sql2);
                                        $count = $re->num_rows;
                                        echo "<tr>";
                                        echo "<td>". $r['id'] . "</td>";
                                        echo "<td>". $r['title']. "</td>";
                                        echo "<td>". $r['blog'] . "</td>";
                                        echo "<td style='align:center'>$count</td>";
                                        echo "<td>". get_default_date($r['date_created']) . "</td>";
                                        echo "<td> <a href='$blog?action=postview&pid=$id' class='btn btn-primary'><i class='fa fa-eye'></i></a><a href='dashboard?b=$code&action=postupdate&pid=$id' class='btn btn-secondary w3-margin-left'><i class='fa fa-edit'></i></a><a href='dashboard?b=$code&action=posts&del=$id' class='btn btn-danger w3-margin-left'><i class='fa fa-trash'></i></a> </td>";
                                    }
                                    
                                ?>
                         </table>
                     </div>
                     
                </div>