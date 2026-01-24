<?php

    global $JX_db,$Apps;
    $sql = "SELECT * FROM `apps`";
    $res = $JX_db->query($sql);

?>

<div class="<?php echo $ui['card']; ?>">
    <div class="<?php echo $ui['card_header']; ?>">
        <div>
            <h2 class="<?php echo $ui['card_title']; ?>">Your Apps</h2>
            <p class="text-sm text-slate-500">Launch and manage installed applications.</p>
        </div>
        <a href="apps" class="<?php echo $ui['btn_secondary']; ?>">Manage apps</a>
    </div>
    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($res as $s) : ?>
            <?php
                $appname = $s['app_name'];
                $data = $Apps->getApp($s['app_name']);
                $logo = $data->logo;
                $tooltip = $data->Summary;
                include "app-card.php";
            ?>
        <?php endforeach; ?>
    </div>
</div>
