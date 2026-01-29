<?php
global $JX_db, $Me, $Url;
$code2 = $Url->get('b');
$sql = "SELECT * FROM `business` WHERE `code` ='$code2'";

$result = $JX_db->query($sql);

$json = null;
$logo = null;

if($result){
    foreach($result as $r){
        $json = json_decode($r['data']);
        $logo = $r['logo'];
}
}else{
    echo $JX_db->error;
}


?>
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
    <header class="rounded-t-2xl bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-5 text-center text-white">
        <h1 class="text-xl font-semibold">Business Updator</h1>
    </header>
    <div class="p-6">
        <div class="flex items-center justify-end">
            <button type="button" class="rounded-full border border-slate-200 p-2 text-slate-500 hover:bg-slate-50">
                <span class="fas fa-power-off"></span>
            </button>
        </div>

        <div class="mt-6 grid gap-6">
            <div class="rounded-xl border border-dashed border-slate-200 bg-slate-50 p-6 text-center">
                <label class="block text-sm font-semibold text-slate-700">Business Logo</label>
                <input type="file" class="mt-4 w-full rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-600" name="logo" id="blogo">
            </div>
        </div>

        <div class="mt-6 grid gap-6 md:grid-cols-2">
            <div>
                <label class="text-sm font-semibold text-slate-700">Business Name</label>
                <input type="text" value="<?php echo $json->name;?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" name="name" placeholder="e.g Jamilsoft Technologies">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">Business Description</label>
                <input type="text" value="<?php echo $json->summary;?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" name="summary" placeholder="Type Business Summary">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">Business Industry</label>
                <select name="industry" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    <option>Health </option>
                    <option>Education </option>
                    <option>Technology </option>
                    <option>Other </option>
                </select>
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">Business Street</label>
                <input type="text" value="<?php echo $json->street;?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" name="street" placeholder="e.g Gwallaga Street">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">Business Country</label>
                <select name="country" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" id="cid"></select>
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">Business State/City</label>
                <input type="text" value="<?php echo $json->city;?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" name="city" placeholder="e.g Alkaleri/Bauchi">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">Business Phone</label>
                <input type="text" value="<?php echo $json->phone;?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" name="phone" placeholder="with country code e.g +234">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">Business Website</label>
                <input type="text" value="<?php echo $json->website;?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" name="website" placeholder="https://.....">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">Business Email</label>
                <input type="email" value="<?php echo $json->email;?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" name="email" placeholder="someone@something.com">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">Business RC Code (optional)</label>
                <input type="text" value="<?php echo $json->rc;?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" name="rc" placeholder="RC, BN, Etc">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700"><i class="fab fa-facebook"></i> Business facebook</label>
                <input type="text" value="<?php echo $json->facebook;?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" name="facebook" placeholder="https://fb.me/someone">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700"><i class="fab fa-twitter"></i> Business Twiter</label>
                <input type="text" value="<?php echo $json->twitter;?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" name="twitter" placeholder="https://t.co/someone ">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700"><i class="fab fa-youtube"></i> Business Youtube</label>
                <input type="text" value="<?php echo $json->youtube;?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" name="youtube" placeholder="https://...">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700"><i class="fab fa-instagram"></i> Business Instagram</label>
                <input type="text" value="<?php echo $json->instagram;?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" name="instagram" placeholder="https://instagram.com/someone ">
            </div>
        </div>

        <div class="mt-8 flex justify-center">
            <input type="submit" class="inline-flex w-full max-w-xs items-center justify-center rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700" name="submit" value="Update Now">
        </div>
    </div>
</div>
