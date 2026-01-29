<?php
global $Url,$db;
$name = null;
$detail = null;
$logo = null;
$data = null;
$cd =$Url->get('b');
$sql = "SELECT * FROM `business` WHERE code='$cd'";

                $row = $db->Query($sql);
   
    foreach($row as $r){
        $json =  $r['data'];
        $data= json_decode($json);
    }
    

?>

<section class="rounded-3xl bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 px-6 py-10 text-white shadow-sm">
    <div class="max-w-4xl">
        <p class="text-xs uppercase tracking-widest text-emerald-100">Business Profile</p>
        <h1 class="mt-3 text-3xl font-semibold"><?php echo $data->name;?></h1>
        <p class="mt-2 text-sm text-emerald-100">Overview of your business details and highlights.</p>
    </div>
</section>
<div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
    <h2 class="text-xl font-semibold text-slate-900">
       <?php
        $test = "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Possimus iste culpa debitis dolor nobis cum excepturi quam et facere beatae, ab unde optio non tempora ratione blanditiis! Voluptates, voluptatum asperiores.";
        echo substr($test,0,25) . "...";
       ?>
   </h2>
    <p class="mt-2 text-sm text-slate-500">Highlight recent updates, business goals, or a brief summary here.</p>
</div>
