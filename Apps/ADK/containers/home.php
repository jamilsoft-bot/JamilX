<?php
$overview = ADKShowcase::overview();
?>
<section class="rounded-3xl border border-slate-800 bg-slate-900/40 p-6">
    <p class="text-xs uppercase tracking-[0.3em] text-slate-500">ADK Home</p>
    <h2 class="mt-3 text-2xl font-semibold"><?php echo $overview['title']; ?></h2>
    <p class="mt-2 text-sm text-slate-400"><?php echo $overview['subtitle']; ?></p>
</section>
