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
<div class="row">
    <div class="col-md-6" id="div1" ondrop="drop(event)" ondragover="allowDrop(event)">
        <div class="d-flex p-3">
            <h1 class="p-3" id="drg"  ondragstart="drag(event)" draggable="true">drag me</h1>
        </div>
    </div>
    <div class="col-md-6 w3-red">
    <div id="dg" class="d-flex p-3" ondrop="drop(event)" ondragover="allowDrop(event)" allowDrop="true">
            
        </div>
    </div>
</div>