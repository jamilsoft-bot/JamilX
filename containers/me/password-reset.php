<?php
$pag = isset($_GET['step'])?$_GET['step']: "";
?>


<?php 
    if($pag == "sentmail"){

    ?>
<form action="test.php"  method="post" class="mx-auto max-w-4xl px-6 py-12">
    <div class="grid gap-6 lg:grid-cols-[220px_1fr]">
        <div class="flex items-center justify-center rounded-3xl bg-emerald-500/10 p-8 text-emerald-600">
            <span class="fa fa-walking text-[120px]"></span>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <header class="border-b border-slate-100 pb-6">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-emerald-600">Password reset</p>
                <h1 class="mt-2 text-2xl font-semibold text-slate-900">Reset your access</h1>
                <p class="mt-2 text-sm text-slate-500">Type a registered email address to receive a secure reset link.</p>
            </header>
            <div class="mt-6 space-y-4">
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Email Address</label>
                <input type="email" name="Email" id="email" placeholder="Email Address" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-200">
                <input type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700" name="submit" id="submit" value="Send reset link">
            </div>
        </div>
    </div>
</form>
<?php }
elseif ($pag =="resetpass") {


?>
<form action="test.php"  method="post" class="mx-auto max-w-4xl px-6 py-12">
    <div class="grid gap-6 lg:grid-cols-[220px_1fr]">
        <div class="flex items-center justify-center rounded-3xl bg-emerald-500/10 p-8 text-emerald-600">
            <span class="fa fa-walking text-[120px]"></span>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <header class="border-b border-slate-100 pb-6">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-emerald-600">Password reset</p>
                <h1 class="mt-2 text-2xl font-semibold text-slate-900">Create a new password</h1>
            </header>
            <div class="mt-6 space-y-4">
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">New Password</label>
                <input type="password" name="password" id="email" placeholder="New Password" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-200">
                <input type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700" name="submit" id="submit" value="Save new password">
            </div>
        </div>
    </div>
</form>
<?php
}
else{}


?>
