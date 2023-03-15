<?php
global $JX_db, $Url;

$data = [];
$type = $Url->get('type');
$data_id = $Url->get('b');
$data = null;
$sql = "SELECT *FROM `business` WHERE `code` = '$data_id'";
$result = $JX_db->query($sql);

$data = $result->fetch_assoc();

$bus =json_decode($data['data']);
$logo = $data['logo'];

?>
<header class="w3-container w3-margin-top">
                <div class="row">
                <h1 class=" w3-blue">Information</h1>
                    <div class="col-md-4">
                        <img src="<?php
                        if($logo == null){
                            echo "assets/images/user.png";
                        }else{
                            echo "data/$logo";
                        }
                        
                        
                        ?>" style="width: 100%; height:200px">

                    </div>
                    <div class="col-md-8">
                    <h1><strong><?php echo $bus->name;?></strong> </h1>
                    <h3><?php echo $bus->summary;?></h3>
                    <h4 class="text-muted">Created on <?php echo get_default_date($data['date_created']) ?></h4>
                    </div>
                </div>
            </header>
            <div class="w3-container w3-margin-top">
              <h1 class="w3-text-blue">Personal Information</h1>
                <table class="w3-table w3-striped w3-hoverable">
                    <tr class="w3-green">
                        <th> Data</th>
                        <th>Values</th>
                    </tr>

                    <tr>
                        <td>Name</td>
                        <td><?php echo $bus->name;?></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><?php echo $bus->summary;?></td>
                    </tr>
                    <tr>
                        <td>Code</td>
                        <td><?php echo $data['code'];?></td>
                    </tr>
                    <tr>
                        <td>Industry</td>
                        <td><?php echo $bus->industry;?></td>
                    </tr>
                    <tr>
                        <td>Owner</td>
                        <td><?php echo $data['owner'];?></td>
                    </tr>
                    <tr>
                        <td>Website</td>
                        <td><?php echo $bus->website;?></td>
                    </tr>
                    <tr>
                        <td>National Registration Number</td>
                        <td><?php echo $bus->rc;?></td>
                    </tr>

                    
                </table>
                <h1 class="w3-text-blue">Contact Information</h1>
                <table class="w3-table w3-striped w3-hoverable">
                    <tr class="w3-green">
                        <th> Data</th>
                        <th>Values</th>
                    </tr>
                    <tr>
                        <td> Street Address</td>
                        <td><?php echo $bus->street;?></td>
                    </tr>
                    <tr>
                        <td> City</td>
                        <td><?php echo $bus->city;?></td>
                    </tr>
                    <tr>
                        <td> Country</td>
                        <td><?php echo $bus->country;?></td>
                    </tr>
                    <tr>
                        <td> Email Address</td>
                        <td><?php echo $bus->email;?></td>
                    </tr>
                    <tr>
                        <td> Phone Number</td>
                        <td><?php echo $bus->phone;?></td>
                    </tr>
                    
                </table>

                <h1 class="w3-text-blue">Social Media</h1>
                <table class="w3-table w3-striped w3-hoverable">
                    <tr class="w3-green">
                        <th> Data</th>
                        <th>Values</th>
                    </tr>
                    <tr>
                        <td> Facebook</td>
                        <td><?php echo $bus->facebook;?></td>
                    </tr>
                    <tr>
                        <td> twitter</td>
                        <td><?php echo $bus->twitter;?></td>
                    </tr>
                    <tr>
                        <td> Youtube</td>
                        <td><?php echo $bus->youtube;?></td>
                    </tr>
                    <tr>
                        <td> Instagram</td>
                        <td><?php echo $bus->instagram;?></td>
                    </tr>
                </table>
                <a class="w3-button w3-blue" onclick="document.getElementById('id01').style.display='block'">Edit Profile</a>
                <a class="w3-button w3-red">Delete Profile</a>
                <a class="w3-button w3-green">Share Profile</a>
            </div>

        </div>

 

<div id="id01" class="w3-modal w3-animate-zoom">
  <div class="w3-modal-content w3-card" style="width: 80%;">
  <header class="w3-container w3-teal">
      <span onclick="document.getElementById('id01').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      <h2>Admin Edit - Business </h2>
    </header>

    <div class="w3-container w3-margin">
      <form action="" enctype="multipart/form-data" method="post">
    <?php include "containers/dashboard/update-bus.php";?>
      </form>
    </div>

    <footer class="w3-container w3-teal">
      <p>&copy; Jamilsoft All right Reserved!</p>
    </footer>
        
          

        
  
    </div>
  </div>

  </div>