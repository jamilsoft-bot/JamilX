<div class="space-y-8">
    <div class="rounded-3xl bg-white shadow-sm border border-slate-200">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-center text-white rounded-t-3xl">
            <p class="text-xs uppercase tracking-widest text-blue-100">Profile</p>
            <h2 class="mt-2 text-2xl font-semibold"><?php global $Me; echo $Me->Fullname();?></h2>
        </div>
        <div class="px-6 py-8 text-center">
            <img src="<?php
                    global $Me;
                    $logo = $Me->pic();
                    if($logo == null){
                        echo "assets/images/user.png";
                    }else{
                        echo "data/$logo";
                    }
                    //echo $logo;
                    
                    ?>" class="mx-auto h-32 w-32 rounded-full border-4 border-white shadow-sm object-cover" alt="Profile">
            <h3 class="mt-4 text-xl font-semibold text-slate-900"><?php global $Me; echo $Me->Fullname();?></h3>
            <p class="text-sm text-slate-500"><?php global $Me; echo $Me->role();?></p>
            <p class="mt-2 text-xs text-slate-400">Born 
            <?php 
            global $Me; 
            $dt = new DateTime($Me->DoB());
            echo $dt->format("M, Y");
            
            ?>
            </p>
            <div class="mt-5 flex justify-center gap-3">
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 text-slate-500"><i class="fas fa-video"></i></span>
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 text-slate-500"><i class="fas fa-phone"></i></span>
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 text-slate-500"><i class="fas fa-envelope"></i></span>
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-slate-900">Biography</h3>
        <p class="mt-3 text-sm leading-relaxed text-slate-600">
        <?php global $Me; echo $Me->bio();?>
        </p>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-900">Personal Information</h3>
            <dl class="mt-4 divide-y divide-slate-100 text-sm">
                <div class="flex justify-between py-2">
                    <dt class="text-slate-500">Name</dt>
                    <dd class="font-medium text-slate-900"><?php global $Me; echo $Me->Fullname();?></dd>
                </div>
                <div class="flex justify-between py-2">
                    <dt class="text-slate-500">Username</dt>
                    <dd class="font-medium text-slate-900"><?php global $Me; echo $Me->username();?></dd>
                </div>
                <div class="flex justify-between py-2">
                    <dt class="text-slate-500">Password</dt>
                    <dd class="font-medium text-slate-900">************</dd>
                </div>
                <div class="flex justify-between py-2">
                    <dt class="text-slate-500">Gender</dt>
                    <dd class="font-medium text-slate-900"><?php global $Me; echo $Me->gender();?></dd>
                </div>
                <div class="flex justify-between py-2">
                    <dt class="text-slate-500">Role</dt>
                    <dd class="font-medium text-slate-900"><?php global $Me; echo $Me->role();?></dd>
                </div>
                <div class="flex justify-between py-2">
                    <dt class="text-slate-500">Date of Birth</dt>
                    <dd class="font-medium text-slate-900"><?php global $Me; echo $Me->DOB();?></dd>
                </div>
            </dl>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-900">Contact Information</h3>
            <dl class="mt-4 divide-y divide-slate-100 text-sm">
                <div class="flex justify-between py-2">
                    <dt class="text-slate-500">Email Address</dt>
                    <dd class="font-medium text-slate-900"><?php global $Me; echo $Me->email();?></dd>
                </div>
                <div class="flex justify-between py-2">
                    <dt class="text-slate-500">Phone Number</dt>
                    <dd class="font-medium text-slate-900"><?php global $Me; echo $Me->phone();?></dd>
                </div>
                <div class="flex justify-between py-2">
                    <dt class="text-slate-500">Address</dt>
                    <dd class="font-medium text-slate-900"><?php global $Me; echo $Me->address();?></dd>
                </div>
                <div class="flex justify-between py-2">
                    <dt class="text-slate-500">City/State</dt>
                    <dd class="font-medium text-slate-900"><?php global $Me; echo $Me->city();?>,<?php global $Me; echo $Me->state();?></dd>
                </div>
                <div class="flex justify-between py-2">
                    <dt class="text-slate-500">Country</dt>
                    <dd class="font-medium text-slate-900"><?php global $Me; echo $Me->country();?></dd>
                </div>
            </dl>
        </div>
    </div>
</div>
