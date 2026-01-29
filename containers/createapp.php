<?php

function createApp(){
    
    if(isset($_POST['createappbtn'])){
        unset($_POST['createappbtn']);
        $appnick = $_POST['Nick'];
        $json = json_encode($_POST);
        
        $creatdata = new AppData($appnick);
        $creatdata->createdr();
        $creatdata->createData();
        file_put_contents("Apps/$appnick/conf.json",$json);
        JX_Alert("Your App Was Sucessfully Created!, Go to Apps to Activate it");
    }

}
createApp();
?>
<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="border-b border-slate-100 pb-4">
        <h1 class="text-2xl font-semibold text-slate-900">Create An App</h1>
        <p class="text-sm text-slate-500">Define the app details and branding information.</p>
    </div>
    <form action="" method="post" class="mt-6 space-y-6">
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <label class="text-sm font-semibold text-slate-700">App Full Name</label>
                <input type="text" name="Name" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">App Nickname (no space)</label>
                <input type="text" name="Nick" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">App Summary</label>
                <input type="text" name="Summary" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">App Author</label>
                <input type="text" name="author" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">App Website</label>
                <input type="text" name="website" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">App Email</label>
                <input type="text" name="email" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
            </div>
            <div class="hidden">
                <input type="hidden" name="version" value="0.1">
                <input type="hidden" name="logo" value="path/to/your/logo">
            </div>
        </div>
        <div class="flex justify-end">
            <input type="submit" name="createappbtn" class="inline-flex items-center rounded-xl bg-blue-600 px-6 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700" value="Create App">
        </div>
    </form>
</div>
