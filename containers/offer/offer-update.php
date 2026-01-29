<section class="bg-slate-50 py-10">
    <div class="mx-auto max-w-5xl px-6">
        <header class="rounded-3xl bg-gradient-to-r from-fuchsia-600 via-purple-500 to-indigo-500 p-8 text-white shadow-lg">
            <h3 class="text-2xl font-semibold"> <?php echo $this->getTitle(); ?></h3>
            <p class="mt-2 text-sm text-purple-100">Refresh offer details and CTA settings.</p>
        </header>
        <div class="mt-8 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
<?php
global $db, $Url;
$name = null;
$author = null;
$content = null;
$type = null;
$btnText = null;
$link = null;
$owner = $Url->get('b');
$oid = $Url->get('oid');
$brand = null;
$image = null;

$sql = "SELECT *FROM  `offers` WHERE `id`=$oid";

$result =$db->Query($sql);

foreach($result as $r){
    $name = $r['name'];
    $link = $r['link'];
    $type = $r['type'];
    $brand = $r['brand'];
    $content = $r['content'];
}


?>
            <div class="flex flex-wrap items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-600">
                <a href="#" class="rounded-full bg-white px-4 py-2 text-slate-700 shadow-sm">Create</a>
                <a href="#" class="rounded-full px-4 py-2 text-slate-500 transition hover:bg-white hover:text-slate-700">List</a>
            </div>
            <form action="" method="post" enctype="multipart/form-data" class="mt-6 space-y-6">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Offer Name</label>
                    <input type="text" value="<?php echo $name; ?>" name="name" placeholder="Type Offer name" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200" required>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Offer Types</label>
                    <div class="mt-2 grid gap-4 md:grid-cols-2">
                        <select name="type" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200" required>
                            <option value="visitation" <?php
                    if($type == 'visitation'){
                        echo "selected";
                    }
                    
                    ?>>Visit Now</option>
                            <option value="call" <?php
                    if($type == 'call'){
                        echo "selected";
                    }
                    
                    ?>>Call Now</option>
                            <option value="email" <?php
                    if($type == 'email'){
                        echo "selected";
                    }
                    
                    ?>>Email Now</option>
                            <option value="apointment" <?php
                    if($type == 'apointment'){
                        echo "selected";
                    }
                    
                    ?>> Make an Appointment</option>
                            <option value="install" <?php
                    if($type == 'install'){
                        echo "selected";
                    }
                    
                    ?>> Install Now</option>
                            <option value="buy" <?php
                    if($type == 'buy'){
                        echo "selected";
                    }
                    
                    ?>> Buy Now</option>
                            <option value="start" <?php
                    if($type == 'start'){
                        echo "selected";
                    }
                    
                    ?>> Get Started</option>
                        </select>
                        <input type="text" value="<?php echo $link; ?>" name="link" placeholder="values " class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200" required>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Brand</label>
                    <select name="parent" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200">
                        <option value="jamilsoft">Default</option>
                        <?php

                        global $db;
                        $sql = "SELECT *FROM `brands`";
                        $result =$db->Query($sql);

                        foreach($result as $r){
                            $name = $r['name'];
                            $brandcode = $r['code'];
                            if($brandcode == $brand){
                                echo "<option value='$brandcode' selected>$name</option>";
                            }else{
                                echo "<option value='$brandcode'>$name</option>";
                            }
                            // echo "<option value='$brandcode'>$name</option>";
                        }
                        

                        ?>
                    </select>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Featured Image</label>
                    <input type="file" name="image" class="mt-2 w-full rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-500" required>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Offer Details</label>
                    <div class="mt-2 rounded-2xl border border-slate-200 bg-white">
                        <textarea name='content' id='pid' cols="60" rows="8" class="w-full rounded-2xl border-0 bg-transparent px-4 py-3 text-sm text-slate-700 focus:outline-none"><?php echo $content;?></textarea>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Keywords</label>
                    <input type="text" name="keywords" placeholder="e.g product, service, computer" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200" required>
                </div>
                <div class="flex justify-end">
                    <input type="submit" name="update" class="inline-flex items-center justify-center rounded-2xl bg-purple-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-purple-700" value="Update Offer">
                </div>
            </form>
        </div>
    </div>
</section>





