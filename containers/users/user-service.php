
    

  <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex flex-wrap gap-3 border-b border-slate-200 pb-4">
      <a href="javascript:void(0)" onclick="openAction(event, 'Home');" class="tablink flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100">
        <span class="h-2 w-2 rounded-full bg-blue-500"></span> Home
      </a>
      <a href="javascript:void(0)" onclick="openAction(event, 'create');" class="tablink flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100">
        <span class="h-2 w-2 rounded-full bg-emerald-500"></span> Create
      </a>
      <a href="javascript:void(0)" onclick="openAction(event, 'List');" class="tablink flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100">
        <span class="h-2 w-2 rounded-full bg-purple-500"></span> List
      </a>
      <a href="javascript:void(0)" onclick="openAction(event, 'Other');" class="tablink flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100">
        <span class="h-2 w-2 rounded-full bg-amber-500"></span> Other
      </a>
    </div>

    <div id="Home" class="Action pt-6">
      <h2 class="text-xl font-semibold text-slate-900">User Homepage</h2>
      <p class="mt-2 text-sm text-slate-500">The is the user home page.</p>
    </div>

    <div id="create" class="Action pt-6" style="display:none">
      <?php $this->create();?>
    </div>

    <div id="List" class="Action pt-6" style="display:none;">
    <?php $this->list();?>
    </div>
    <div id="Other" class="Action pt-6" style="display:none">
      <h2 class="text-xl font-semibold text-slate-900">User Other Action</h2>
      <p class="mt-2 text-sm text-slate-500">The is the user Other page.</p>
    </div>
  </div>
  
  <script>
    function checkaction(){
      var c = localStorage.action
      openAction(event,c)
    }
  function openAction(evt, ActionName) {
    localStorage.action = ActionName;
    var i, x, tablinks;
    x = document.getElementsByClassName("Action");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < x.length; i++) {
       tablinks[i].className = tablinks[i].className.replace(" border-b-2 border-blue-600 text-blue-600", "");
    }
    document.getElementById(ActionName).style.display = "block";
    evt.currentTarget.className += " border-b-2 border-blue-600 text-blue-600";
  }
  </script>
