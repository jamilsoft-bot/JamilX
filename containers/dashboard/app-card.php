<div class="rounded-xl border border-slate-200 bg-white p-4 text-center shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:shadow">
    <a href="<?php echo strtolower($appname); ?>" data-toggle="tooltip" title="<?php echo $tooltip;?>" target="_blank" class="block">
        <img src="<?php
            if ($logo == null) {
                echo "assets/images/jslogobird.png";
            } else {
                echo "Apps/$appname/$logo";
            }
        ?>" alt="<?php echo $appname; ?>" class="mx-auto h-12 w-12">
        <p class="mt-3 text-sm font-semibold text-slate-900"><?php echo $appname; ?></p>
        <p class="mt-1 text-xs text-slate-500">Open app</p>
    </a>
</div>
