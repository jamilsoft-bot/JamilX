<div class="media border p-3 " style="margin: 20pt;">
  <img src="../../assets/images/user.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
  <div class="media-body">
    <h4><?php echo $author;?> <small> <i> Commented on <?php echo $date;?></i></small></h4>
    <p><?php echo html_entity_decode($message);?></p>
  </div>
</div>
