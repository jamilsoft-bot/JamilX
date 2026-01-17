<ul class="w3-ul w3-card-4" >
        <li class="w3-bar">
            <span class="w3-bar-item  w3-xlarge w3-right">
           <a href="?serve=users&action=update&id=<?php echo $row['id'];?>"> <i class="fa fa-edit w3-button"></i></a>
           <a href="?serve=users&action=read&id=<?php echo $row['id'];?>">  <i class="fa fa-eye w3-button"></i></a>
           <a href="?serve=users&action=delete&id=<?php echo $row['id'];?>"> <i class="fa fa-archive w3-button"></i></a>
        </span>
            <img src="data/images/<?php echo $row['avatar'];?>" class="w3-bar-item w3-circle" style="width:85px">
            <div class="w3-bar-item">
              <span class="w3-large">@<?php echo $row['username'];?></span><br>
              <span class="w3-small"><?php echo $row['name'];?></span><br>
              <span><?php echo $row['role'];?></span>
            </div>
          </li>
      </ul>