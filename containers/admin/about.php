<div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
    <header class="rounded-t-3xl bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-8 text-center text-white">
        <h3 class="text-2xl font-semibold">Thank You For Choosing JamilX</h3>
        <p class="mt-2 text-sm text-blue-100">Building modern products with a lightweight PHP framework.</p>
    </header>

    <div class="flex flex-col items-center gap-4 px-6 py-12 text-center">
        <div class="flex h-24 w-24 items-center justify-center rounded-full bg-blue-50">
            <img src="assets/images/jslogobird.png" class="h-16 w-16" alt="JamilX">
        </div>
        <h1 class="text-3xl font-bold text-slate-900">JamilX</h1>
        <p class="max-w-xl text-sm text-slate-500">PHP Framework for Everyone</p>
        <a href="https://paystack.com/pay/jamilsoft" class="mt-2 inline-flex items-center justify-center rounded-full bg-blue-600 px-6 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">Donate</a>
    </div>

    <footer class="rounded-b-3xl bg-slate-50 px-6 py-4 text-center text-sm text-slate-500">
        &copy; <span id="copyr"></span> Jamilsoft All Right Researved
    </footer>
</div>
    
<script>
    var x = document.getElementById("copyr")
    var dt = new Date();
    x.innerHTML = "2021-" + dt.getFullYear()
</script>
