<div class="col-md-4 w3-margin-top" >
    <div class="flip-card">
            <div class="flip-card-inner">
                        <div class="flip-card-front">
                        <img src="<?php
                                        if($name == null){
                                            echo "assets/images/user.png";
                                        }else{
                                            echo "data/$name";
                                        }
                                        //echo $logo;
                                        
                                        ?>" alt="Avatar"  style="width:100%;height:300px;">
                        </div>
                        <div class="flip-card-back w3-white">
                        
                            <header class="w3-container w3-centered">
                                <strong>File Details</strong>
                            </header>
                            <div class="w3-responsive">
                           <table class="w3-table  w3-table-all w3-hoverable">
                            <tr class="w3-green">
                                <th>Data</th>
                                <th>Values</th>
                            </tr>
                            <tr>
                                <td>File Name</td>
                                <td><?php echo substr($name,0,9) . "..";?></td>
                            </tr>
                            <tr>
                                <td>File Summary</td>
                                <td><?php echo substr($text,0,9) . "..";?></td>
                            </tr>
                            <tr>
                                <td>File Size</td>
                                <td><?php echo $size;?>kb</td>
                            </tr>
                            <tr>
                                <td>Date Uploaded</td>
                                <td><?php echo $date;?></td>
                            </tr>
                           </table>
                            </div>
                            <footer class="w3-container w3-centered w3-margin">
                                <a class="w3-button w3-blue">Manage</a>
                            </footer>
                        </div>
            </div>
    </div>
</div>
