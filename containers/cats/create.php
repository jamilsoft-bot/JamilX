<div class="w3-container m-3">
    <form action="" method="post" class="row">
        <div class="col-md-6">
            <label class="w3-text-blue">Category Name</label>
            <input type="text" name="name" class="w3-border-blue w3-leftbar w3-border w3-input">
        </div>
        <div class="col-md-6">
            <label class="w3-text-blue"> Description</label>
            <input type="text" name="summary" class="w3-border w3-leftbar w3-border-blue w3-input">
        </div>
        <div class="col-md-6">
            <label class="w3-text-blue">Parent Category</label>
            <select name="cat" class="w3-input w3-border w3-border-blue w3-leftbar">
                <?php
                    global $JX_db;
                    $sql = "SELECT *FROM `categories`";
                    $ee = $JX_db->query($sql);
                    foreach($ee as $e){
                        $name = $e['name'];
                        echo "<option>$name</option>";
                    }
                ?>
            </select>
        </div>
        <div class="col-md-6">
        <label class="w3-text-blue"></label>
            <input type="submit" name="rolebtn" class="w3-button w3-hover-blue w3-border-blue w3-leftbar w3-border w3-block" value="Add Role">
        </div>
    </form>
</div>