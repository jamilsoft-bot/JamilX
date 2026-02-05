<div class="rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
    <div class="overflow-hidden rounded-t-3xl">
        <img src="<?php
                        if($name == null){
                            echo "assets/images/user.png";
                        }else{
                            echo "data/$name";
                        }
                        //echo $logo;
                        
                        ?>" alt="Avatar"  class="h-56 w-full object-cover">
    </div>
    <div class="space-y-4 p-6">
        <header>
            <strong class="text-sm font-semibold text-slate-900">File Details</strong>
        </header>
        <div class="space-y-2 text-sm text-slate-600">
            <div class="flex items-center justify-between">
                <span>File Name</span>
                <span class="font-semibold text-slate-700"><?php echo substr($name,0,9) . "..";?></span>
            </div>
            <div class="flex items-center justify-between">
                <span>File Summary</span>
                <span class="font-semibold text-slate-700"><?php echo substr($text,0,9) . "..";?></span>
            </div>
            <div class="flex items-center justify-between">
                <span>File Size</span>
                <span class="font-semibold text-slate-700"><?php echo $size;?>kb</span>
            </div>
            <div class="flex items-center justify-between">
                <span>Date Uploaded</span>
                <span class="font-semibold text-slate-700"><?php echo $date;?></span>
            </div>
        </div>
        <footer>
            <a class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-white shadow-sm transition hover:bg-blue-700">Manage</a>
        </footer>
    </div>
</div>
