<script>
    function allowDrop(allowdropevent) {
    allowdropevent.target.style.color = 'blue';
    allowdropevent.preventDefault();
}

function drag(dragevent) {
    dragevent.dataTransfer.setData("text", dragevent.target.id);
    dragevent.target.style.color = 'green';
}

function drop(dropevent) {
    dropevent.preventDefault();
    var data = dropevent.dataTransfer.getData("text");
    dropevent.target.appendChild(document.getElementById(data));
    document.getElementById("drag").style.color = 'black';
}

</script>
<section class="bg-slate-50 py-10">
    <div class="mx-auto max-w-5xl px-6">
        <div class="grid gap-6 md:grid-cols-2">
            <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-6 shadow-sm" id="div1" ondrop="drop(event)" ondragover="allowDrop(event)">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">Source</p>
                <div class="mt-6 flex items-center justify-center">
                    <span class="inline-flex items-center rounded-2xl bg-slate-100 px-6 py-4 text-lg font-semibold text-slate-700" id="drg" ondragstart="drag(event)" draggable="true">drag me</span>
                </div>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">Destination</p>
                <div id="dg" class="mt-6 flex min-h-[180px] items-center justify-center rounded-2xl border border-dashed border-slate-200 bg-slate-50" ondrop="drop(event)" ondragover="allowDrop(event)" allowDrop="true">
                    <span class="text-sm text-slate-400">Drop here</span>
                </div>
            </div>
        </div>
    </div>
</section>
