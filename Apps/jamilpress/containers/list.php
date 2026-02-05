<?php include "list-menu.php";?>





<ul class='w3-ul w3-margin-top'>
<?php
    $data = $plist->GetArray();

    foreach($data as $datum){
        $name = $plist->getName($datum);
        $summary = substr($plist->getContent($datum),0,70);
        $author = $plist->getAuthor($datum);
        $rdate = $plist->getDateAll($datum);
        $id = $plist->getId($datum);
        $cdate = $rdate['created'];
        $date = get_default_date($cdate);
        $comment = $plist->getCommentNum($datum['id']);
        $image = $plist->getImage($datum);
        include("item-card.php");
    }

?> 
</ul>