<nav class="w3-sidebar w3-bar-block w3-collapse w3-white w3-animate-left w3-card" style="z-index:3;width:320px;" id="mySidebar">
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-border-bottom w3-large"><img src="assets/images/logo.png" style="width:60%;"></a>
  <a href="javascript:void(0)" onclick="w3_close()" title="Close Sidemenu" 
  class="w3-bar-item w3-button w3-hide-large w3-large">Close <i class="fa fa-remove"></i></a>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-dark-grey w3-button w3-hover-black w3-left-align" onclick="document.getElementById('id01').style.display='block'">New Message <i class="w3-padding fa fa-pencil"></i></a>
  <a id="myBtn" onclick="myFunc('inbox')" href="javascript:void(0)" class="w3-bar-item w3-button"><i class="fa fa-inbox w3-margin-right"></i>Inbox (3)<i class="fa fa-caret-down w3-margin-left"></i></a>
  <div id="inbox" class="w3-hide w3-animate-left">
    <?php include "message-card.php";?>
     
  </div>
  <a id="myBtn" onclick="myFunc('sent')" href="javascript:void(0)" class="w3-bar-item w3-button"><i class="fa fa-paper-plane w3-margin-right"></i>Sent (3)<i class="fa fa-caret-down w3-margin-left"></i></a>
  <div id="sent" class="w3-hide w3-animate-left">
    <?php include "message-card.php";?>
     
  </div>
  <a id="myBtn" onclick="myFunc('draft')" href="javascript:void(0)" class="w3-bar-item w3-button"><i class="fa fa-hourglass-end w3-margin-right"></i>Draft (3)<i class="fa fa-caret-down w3-margin-left"></i></a>
  <div id="draft" class="w3-hide w3-animate-left">
    <?php include "message-card.php";?>
     
  </div>

  <a id="myBtn" onclick="myFunc('trash')" href="javascript:void(0)" class="w3-bar-item w3-button"><i class="fa fa-trash w3-margin-right"></i>Trash (3)<i class="fa fa-caret-down w3-margin-left"></i></a>
  <div id="trash" class="w3-hide w3-animate-left">
    <?php include "message-card.php";?>
     
  </div>


  <!-- <a href="#" class="w3-bar-item w3-button"><i class="fa fa-paper-plane w3-margin-right"></i>Sent</a>
  <a href="#" class="w3-bar-item w3-button"><i class="fa fa-hourglass-end w3-margin-right"></i>Drafts</a>
  <a href="#" class="w3-bar-item w3-button"><i class="fa fa-trash w3-margin-right"></i>Trash</a> -->

</nav>
