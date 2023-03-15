<?php
$sql2 = "SELECT *FROM `comments` WHERE `post_id`=$id";
$re = $db->Query($sql2);
$count = $re->num_rows;
?>
<div class="col-md-6 w3-padding">
    <a href="?action=postview&pid=<?php echo $id;?>">
      <div class="w3-card w3-hover-sand ">
          <img src="data/<?php echo $image;?>" alt="<?php echo $image;?>" style="width: 100%;height:150pt">
          <div class="w3-container">
            
              <h2><?php echo $title;?></h2>
              <div class="w3-bar">
              
              <a class="w3-bar-item text-muted"> <?php echo $authur;?></a>
              <a class="w3-bar-item text-muted"> <?php echo $date;?></a>
              <a class="w3-bar-item  text-muted"><i class="fa fa-comments"></i> <?php echo $count;?></a>
              <a class="w3-bar-item text-muted"><i class="fas fa-thumbs-up"></i> <?php echo $count;?></a>
            </div>
          </div>
      </div>
    </a>
</div>