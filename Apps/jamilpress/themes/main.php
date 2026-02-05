<div class="w3-margin-top  w3-container w3-bar ">
    <h1 class="w3-bar-item "><?php
    if(isset($_GET['search'])){
        echo "Search Result";
    }else{
        echo "Latest Posts";
    }
    ?></h1>
    <div class="w3-right " style="margin-right: 20pt;">
                        <form action="" method="get">
        <input type="text" class="w3-bar-item w3-border w3-input" name="search" placeholder="Search..">
        <button type="submit" href="#" class="w3-bar-item w3-button w3-blue"><i class="fa fa-search"></i> </button>
                        </form>
    </div>
</div>
<div class="w3-container">
   <?php

        if(isset($_GET['search'])){
            global $Url;
            $xt = $Url->get_paths();
            $posts = getPosts2($xt[1]);
            $link = $xt[1];
            $posts = searchPosts($_GET['search']);
            foreach($posts as $p){
                $title = $p['title'];
                $summary = $p['content'];
                $image = $p['image'];
                $id = $p['id'];
                $date = get_default_date($p['date_created']);
                include "item.php";
            }
        }else{
            global $Url;
            $xt = $Url->get_paths();
            $posts = getPosts2($xt[1]);
            $link = $xt[1];

        foreach($posts as $p){
            $title = $p['title'];
            $summary = $p['content'];
            $image = $p['image'];
            $id = $p['id'];
            $date = get_default_date($p['date_created']);
            include "item.php";
        }
        }

   ?>
    
</div>