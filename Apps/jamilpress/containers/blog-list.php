<div class="w3-margin-top w3-blue-grey w3-container w3-bar">
                <span class="w3-bar-item w3-large">Blogs Manage by You</span>
</div>
<div class="w3-container w3-margin-top">
<div class="row">
    <?php

$data = $plist->GetArray();

    foreach($data as $datum){
         $name = $plist->getName($datum);
         $summary = substr($plist->getSummary($datum),0,60);
        // $author = $plist->getAuthor($datum);
        // $rdate = $plist->getDateAll($datum);
        // $id = $plist->getId($datum);
        // $cdate = $rdate['created'];
        $url = $datum['url'];
        // $date = get_default_date($cdate);
        // $comment = $plist->getCommentNum($datum['id']);
         $image = $plist->getImage($datum);
        include("blog-card.php");
    }
    ?>
</div>
</div>