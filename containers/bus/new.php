<style>
    label{
        color:deepskyblue;
    }
    
</style>
<header class="w3-container text-center w3-blue">
    <h1>Business Creation Manager</h1>
</header>
<div class="row">
    <div class="col-2">

    </div>
    <div class="col-8 w3-card  w3-margin" >
        <div class="w3-bar w3-margin-top">
            <li class="w3-bar-item w3-right w3-button"><span class="fas fa-power-off"></span></li>
        </div>
        <div class="w3-margin w3-padding">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 text-center">
                <label>Business Logo</label>
            <input type="file" class="w3-input w3-center w3-border w3-border-blue w3-bottombar"  name="blogo" id="blogo">
        
                </div>
                <div class="col-md-4"></div>
            </div>
           
        </div>
        <div class="row ">
            <div class="col-md-6 w3-container">
                <label>Business Name</label>
                <input type="text" class="w3-border w3-border-blue w3-bottombar w3-input" name="Bname" placeholder="e.g Jamilsoft Technologies">
            </div>
            <div class="col-md-6 w3-container">
                <label>Business Description</label>
                <input type="text" class="w3-border w3-border-blue w3-bottombar  w3-input" name="Bname" placeholder="Type Business Summary">
            </div>
            <div class="col-md-6 w3-container">
                <label>Business Industry</label>
                <select name="industry" class="w3-input w3-border w3-border-blue w3-bottombar ">
                    <option>Health </option>
                    <option>Education </option>
                    <option>Technology </option>
                    <option>Other </option>
                </select>
            </div>
            <div class="col-md-6 w3-container">
                <label>Business Street</label>
                <input type="text" class="w3-input w3-border w3-border-blue w3-bottombar " name="Bname" placeholder="e.g Gwallaga Street">
            </div>
            <div class="col-md-6 w3-container">
                <label>Business Country</label>
                <select name="country" class="w3-input w3-border w3-border-blue w3-bottombar " id="cid"></select>
            </div>
            <div class="col-md-6 w3-container">
                <label>Business State/City</label>
                <input type="text" class="w3-input w3-border w3-border-blue w3-bottombar " name="Bname" placeholder="e.g Alkaleri/Bauchi">
            </div>
            <div class="col-md-6 w3-container">
                <label>Business Phone</label>
                <input type="text" class="w3-input w3-border w3-border-blue w3-bottombar " name="Bname" placeholder="with country code e.g +234">
            </div>
            <div class="col-md-6 w3-container">
                <label>Business Website</label>
                <input type="text" class="w3-input w3-border w3-border-blue w3-bottombar " name="Bname" placeholder="https://.....">
            </div>
            <div class="col-md-6 w3-container">
                <label>Business Email</label>
                <input type="text" class="w3-input w3-border w3-border-blue w3-bottombar " name="Bname" placeholder="someone@something.com">
            </div>
            <div class="col-md-6 w3-container">
                <label>Business RC Code (optional)</label>
                <input type="text" class="w3-input w3-border w3-border-blue w3-bottombar " name="Bname" placeholder="RC, BN, Etc">
            </div>
            <div class="w3-margin w3-padding">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <input type="submit" class="w3-input w3-button w3-blue"  name="submit" value="Create Now">
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-2">

    </div>
</div>