<?php

?>
<header class="rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-4 text-white shadow-sm">
    <h3 class="text-lg font-semibold">Main Title</h3>
</header>
<div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
    <div class="rounded-2xl border border-slate-200 bg-white p-5 text-center shadow-sm">
        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-blue-50 text-blue-600">
            <span class="fas fa-chalkboard"></span>
        </div>
        <h2 class="mt-4 text-2xl font-semibold text-slate-900"><?php global $Url; echo get_visits($Url->get('b')); ?></h2>
        <p class="text-sm text-slate-500">Visits</p>
    </div>
    <div class="rounded-2xl border border-slate-200 bg-white p-5 text-center shadow-sm">
        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">
            <span class="fas fa-mouse"></span>
        </div>
        <h2 class="mt-4 text-2xl font-semibold text-slate-900">200</h2>
        <p class="text-sm text-slate-500">Clicks</p>
    </div>
    <div class="rounded-2xl border border-slate-200 bg-white p-5 text-center shadow-sm">
        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-amber-50 text-amber-600">
            <span class="fas fa-phone"></span>
        </div>
        <h2 class="mt-4 text-2xl font-semibold text-slate-900">200</h2>
        <p class="text-sm text-slate-500">Calls</p>
    </div>
    <div class="rounded-2xl border border-slate-200 bg-white p-5 text-center shadow-sm">
        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-purple-50 text-purple-600">
            <span class="fas fa-search"></span>
        </div>
        <h2 class="mt-4 text-2xl font-semibold text-slate-900">200</h2>
        <p class="text-sm text-slate-500">Searches</p>
    </div>
</div>
           


