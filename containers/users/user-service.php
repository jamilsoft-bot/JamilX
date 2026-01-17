
    

  <div class="w3-container">
  
    <div class="w3-row">
      <a href="javascript:void(0)" onclick="openAction(event, 'Home');">
        <div class="w3-col s2  tablink w3-bottombar w3-hover-light-grey w3-padding">Home</div>
      </a>
      <a href="javascript:void(0)" onclick="openAction(event, 'create');">
        <div class="w3-col s2  tablink w3-bottombar w3-hover-light-grey w3-padding">Create</div>
      </a>
      <a href="javascript:void(0)" onclick="openAction(event, 'List');">
        <div class="w3-col s2  tablink w3-bottombar w3-hover-light-grey w3-padding">List</div>
      </a>
      <a href="javascript:void(0)" onclick="openAction(event, 'Other');">
        <div class="w3-col s2 tablink w3-bottombar w3-hover-light-grey w3-padding">Other</div>
      </a>
    </div>
  
    <div id="Home" class="w3-container Action">
      <h2>User Homepage</h2>
      <p>The is the user home page.</p>
    </div>
  
    <div id="create" class="w3-container Action" style="display:none">
      <?php $this->create();?>
    </div>
  
    <div id="List" class="w3-container Action" style="display:none;">
    <?php $this->list();?>
    </div>
    <div id="Other" class="w3-container Action" style="display:none">
    <h2>User Other Action</h2>
      <p>The is the user Other page.</p>
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
       tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
    }
    document.getElementById(ActionName).style.display = "block";
    evt.currentTarget.firstElementChild.className += " w3-border-red";
  }
  </script>