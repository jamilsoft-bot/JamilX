
    

  <div class="px-4 py-6">
  
    <div class="flex flex-wrap border-b border-gray-200">
      <a href="javascript:void(0)" onclick="openAction(event, 'Home');" class="flex-1">
        <div class="tablink border-b-2 border-transparent px-4 py-2 text-center text-sm font-medium text-gray-600 transition hover:border-gray-300 hover:text-gray-900">Main</div>
      </a>
      <a href="javascript:void(0)" onclick="openAction(event, 'installed');" class="flex-1">
        <div class="tablink border-b-2 border-transparent px-4 py-2 text-center text-sm font-medium text-gray-600 transition hover:border-gray-300 hover:text-gray-900">Installed</div>
      </a>
      <a href="javascript:void(0)" onclick="openAction(event, 'List');" class="flex-1">
        <div class="tablink border-b-2 border-transparent px-4 py-2 text-center text-sm font-medium text-gray-600 transition hover:border-gray-300 hover:text-gray-900">All</div>
      </a>
      <a href="javascript:void(0)" onclick="openAction(event, 'Other');" class="flex-1">
        <div class="tablink border-b-2 border-transparent px-4 py-2 text-center text-sm font-medium text-gray-600 transition hover:border-gray-300 hover:text-gray-900">Other</div>
      </a>
    </div>
  
    <div id="Home" class="Action py-4">
    <?php  echo $HomePanel; ?>
    </div>
  
    <div id="installed" class="Action py-4" style="display:none">
      <?php $this->installeds(); ?>
    </div>
  
    <div id="List" class="Action py-4" style="display:none;">
    <?php $this->applist();?>
    </div>
    <div id="Other" class="Action py-4" style="display:none">
    <h2 class="text-xl font-semibold text-gray-900">User Other Action</h2>
      <p class="text-gray-600">The is the user Other page.</p>
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
       tablinks[i].className = tablinks[i].className.replace(" border-red-500", "");
    }
    document.getElementById(ActionName).style.display = "block";
    evt.currentTarget.firstElementChild.className += " border-red-500";
  }
  </script>
