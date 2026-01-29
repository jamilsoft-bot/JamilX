<section class="bg-slate-50 py-10">
    <div class="mx-auto max-w-5xl px-6">
        <header class="rounded-3xl bg-gradient-to-r from-emerald-600 via-teal-500 to-cyan-400 p-8 text-white shadow-lg">
            <h3 class="text-2xl font-semibold"> <?php echo $this->getTitle(); ?></h3>
            <p class="mt-2 text-sm text-emerald-100">Update product details, pricing, and assets.</p>
        </header>
        <div class="mt-8 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
<?php
global $db, $Url;
        $name = null;
        $id = $Url->get('pid');
        $author = null;
        $content = null;
        $price = null; $sale = null;
        $type = null;
        $owner = $Url->get('b');
        $brand = null;
        $image = null;
        $pic = null;
        
        $sql = "SELECT * FROM `products` WHERE `id` = '$id'";
        $presult = $db->Query($sql);
        foreach($presult as $pr){

        $name = $pr['name'];
        $content = $pr['content'];
        $price = $pr['price']; $sale = $pr['sale'];
        $type = $pr['type'];
       
        $brand = $pr['brand'];
        
        $pic = $pr['pic'];

        }

?>
            <div class="flex flex-wrap items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-600">
                <a href="#" class="rounded-full bg-white px-4 py-2 text-slate-700 shadow-sm">Create</a>
                <a href="#" class="rounded-full px-4 py-2 text-slate-500 transition hover:bg-white hover:text-slate-700">List</a>
            </div>
            <form action="" method="post" enctype="multipart/form-data" class="mt-6 space-y-6">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Product/Service Name</label>
                    <input type="text" value="<?php echo $name; ?>" name="name" placeholder="Type product or service name" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-200" required>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Type</label>
                    <select name="type" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-200" required>
                    <option value="service" <?php
                    if($type == 'service'){
                        echo "selected";
                    }
                    
                    ?>>Service</option>
                    <option value="product"  <?php
                    if($type == 'product'){
                        echo "selected";
                    }
                    
                    ?>>Product</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Product Prices</label>
                    <div class="mt-2 grid gap-4 md:grid-cols-2">
                        <input type="text" value="<?php echo $price; ?>" name="rprice" placeholder="Regular price without currency" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-200" required>
                        <input type="text" value="<?php echo $sale; ?>" name="sprice" placeholder="Sale price without currency" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-200" required>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Brand</label>
                    <select name="parent" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-200">
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
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Product Details</label>
                    <div class="mt-2 rounded-2xl border border-slate-200 bg-white">
                        <textarea name='content' id='pid' cols="60" rows="8" class="w-full rounded-2xl border-0 bg-transparent px-4 py-3 text-sm text-slate-700 focus:outline-none"><?php echo $content;?></textarea>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Keywords</label>
                    <input type="text" name="keywords" placeholder="e.g product, service, computer" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-200" required>
                </div>
                <div class="flex justify-end">
                    <input type="submit" name="update" class="inline-flex items-center justify-center rounded-2xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700" value="Update Product">
                </div>
            </form>
        </div>
    </div>
</section>





