<?php
                                 
                                 global $db;
                                    $code = $_GET['b'];
                                    $sql = "SELECT * FROM `comments` WHERE `type`='post' AND `owner`='$code'";

                                    $row = $db->Query($sql);

                                    foreach($row as $r){
                                        
                                        $id = $r['id'];
                                        $code = $_GET['b'];
                                        echo "<tr>";
                                        echo "<td>". $r['id'] . "</td>";
                                        echo "<td>". $r['title']. "</td>";
                                        echo "<td>". $r['owner'] . "</td>";
                                        echo "<td>". $r['data_created'] . "</td>";
                                        echo "<td> <a href='dashboard?b=$code&action=postview&pid=$id' class='btn btn-primary'>View</a><a href='dashboard?b=$code&action=postupdate&pid=$id' class='btn btn-secondary w3-margin-left'>Update</a><a href='dashboard?b=$code&action=posts&del=$id' class='btn btn-danger w3-margin-left'>Delete</a> </td>";
                                    }
                                    
                                ?>