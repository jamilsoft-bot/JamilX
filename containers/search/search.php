<style>
body {
  font-family: Arial;
}

* {
  box-sizing: border-box;
}

.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
}

.example button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}

.example button:hover {
  background: #0b7dda;
}

.example::after {
  content: "";
  clear: both;
  display: table;
}
.ex{
    width: 100%;
    
}
.login-container{
    box-shadow: none;
}
</style>
<div class="login-container ex">
    <div class="example" style="width: 700pt;background:none;">
    <img src="assets/images/logo.png" style="width: 300px;" alt="Logo.png"><br><br>
    
    <input type="text" placeholder="Search.." class="js-card2 w3-input" name="q">
    <button type="submit"><i class="fa fa-search"></i></button>
    </div>
</div>