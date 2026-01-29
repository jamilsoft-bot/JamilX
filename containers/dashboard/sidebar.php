<?php
global $JXD_sidebar;
$dslist = $JXD_sidebar->get_list();

?>
<aside class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm" id="sidebar">
                <div class="flex items-center justify-between gap-3">
                    <strong class="text-sm font-semibold text-slate-700">Business Name</strong>
                    <span class="rounded-full bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-700">Active</span>
                </div>
               <div class="mt-4">
                   <a href="" class="inline-flex w-full items-center justify-center rounded-xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-white">Change Business</a>
               </div>
               <div class="my-4 h-px bg-slate-200"></div>
                <div class="flex flex-col gap-1 text-sm">
                    <a href="?action=dashboardmain" class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"><i class="fa fa-home"></i> Home</a>
                    <a href="invoice" class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"><i class="fa fa-file-invoice-dollar"></i> Invoices</a>
                    <a href="billing" class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"><i class="fa fa-receipt"></i> Billing</a>
                    <a href="forum" class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"><i class="fa fa-comments"></i> Forum</a>
                    <?php

                    if(count($dslist) !== 0){
                        foreach($dslist as $list){
                            echo $list;
                        }
                    }

                    ?>
                    <!-- <a href="?action=dashboardmain" class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"><i class="fas fa-th"></i> App Menu</a> -->
                    <!-- <a href="" class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"><i class="fa fa-edit"></i> Customize</a> -->
                    <!-- <a href="" class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"><i class="fa fa-business-time"></i> Services</a> -->
                    <button type="button" onclick="showprofile()" class="flex items-center gap-3 rounded-lg px-3 py-2 text-left text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"><i class="fa fa-user"></i> My Profile</button>
                    <div class="mt-2 hidden flex-col gap-1 rounded-lg border border-slate-200 bg-slate-50 p-2" id="profile">
                        <a href="?action=myprofile" class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 transition hover:bg-white hover:text-slate-900"><i class="fa fa-user"></i> My Profile</a>
                        <a href="?action=updatemyprofilepic" class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 transition hover:bg-white hover:text-slate-900"><i class="fa fa-camera"></i> Change Profile Pic</a>
                        <a href="?action=editmyprofile" class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 transition hover:bg-white hover:text-slate-900"><i class="fa fa-user-edit"></i>Update Profile</a>
                    </div>
                    <!-- <a href="" class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"><i class="fa fa-code-branch"></i> Extensions</a> -->
                    <a href="" class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"><i class="fa fa-cog"></i> Setting</a>
                    <a href="" class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"><i class="fa fa-umbrella"></i> About</a>
                    <a href="" class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"><i class="fa fa-question"></i> Help</a>

                </div>
            </aside>

<script>
function showprofile() {
    var x = document.getElementById("profile");
    if (x.classList.contains("hidden")) {
        x.classList.remove("hidden");
        x.classList.add("flex");
    } else {
        x.classList.add("hidden");
        x.classList.remove("flex");
    }
}
</script>
