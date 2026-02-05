<?php
$sql2 = "SELECT *FROM `comments` WHERE `post_id`=$id";
$re = $db->Query($sql2);
$count = $re->num_rows;
?>
<div class="group">
    <a href="?action=postview&pid=<?php echo $id;?>" class="block rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
      <div class="overflow-hidden rounded-t-3xl">
          <img src="data/<?php echo $image;?>" alt="<?php echo $image;?>" class="h-48 w-full object-cover transition duration-300 group-hover:scale-105">
      </div>
      <div class="space-y-3 p-6">
          <h2 class="text-lg font-semibold text-slate-900"><?php echo $title;?></h2>
          <div class="flex flex-wrap gap-3 text-xs font-semibold uppercase tracking-wide text-slate-400">
              <span class="inline-flex items-center gap-1"><i class="fa fa-user"></i><?php echo $authur;?></span>
              <span class="inline-flex items-center gap-1"><i class="fa fa-calendar"></i><?php echo $date;?></span>
              <span class="inline-flex items-center gap-1"><i class="fa fa-comments"></i><?php echo $count;?></span>
              <span class="inline-flex items-center gap-1"><i class="fas fa-thumbs-up"></i><?php echo $count;?></span>
          </div>
      </div>
    </a>
</div>
