<?php
global $Url,$db;
$name = null;
$detail = $Url->post('about');
$logo = null;
$data = null;
$cd =$Url->get('b');
$sql_select = "SELECT * FROM `option` WHERE `name`='about'";
$sql_insert = "INSERT INTO `options`(`name`,`value`)VALUES('','')";
$sql_update = "UPDATE `options` SET `value` = '' WHERE `name` = ''";

                
    // $result = $db->Query($sql_select);
    // if($result->num_rows > 0){
    //     foreach($result as $r){
    //         $data = $r['value'];
    //     }
    // }

?>

<section class="rounded-3xl bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 px-6 py-10 text-white">
    <div class="max-w-4xl">
        <p class="text-sm font-semibold uppercase tracking-widest text-slate-300">About</p>
        <h1 class="mt-2 text-3xl font-semibold">Learn more about your workspace</h1>
        <p class="mt-3 text-sm text-slate-300">A quick snapshot of the business profile and operational overview.</p>
    </div>
</section>
<div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
    <h2 class="text-xl font-semibold text-slate-900">
       <?php
        $test = "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Possimus iste culpa debitis dolor nobis cum excepturi quam et facere beatae, ab unde optio non tempora ratione blanditiis! Voluptates, voluptatum asperiores.";
        echo substr($test,0,25) . "...";
       ?>
   </h2>
    <p class="mt-2 text-sm text-slate-500">Share a concise statement about the business or mission here.</p>
</div>
