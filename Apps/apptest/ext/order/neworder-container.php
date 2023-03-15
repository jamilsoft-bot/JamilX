<?php

// $product_name = $data['title'];
// $product_summary = null;


?>


<div class="container p-3 mt-2">
    <div class="w3-card">
        <header class="w3-container w3-center w3-blue p-2">
            <h3>New Course Enrollment Form</h3>
        </header>
        <div class="w3-container">
            <div class="row">
                <div class="col-md-6">
                    <header class=" w3-bottombar w3-border-blue w3-center p-2">
                        <h3>Course Details Details</h3>
                    </header>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>Course Name</td>
                                <td><?php echo $data['name'];?> </td>
                            </tr>
                            <tr>
                                <td>Course Type</td>
                                <td><?php echo $data['type'];?> </td>
                            </tr>
                            <tr>
                                <td>Course Summary</td>
                                <td><?php echo $data['summary'];?> </td>
                            </tr>
                            <tr>
                                <td>Course Price</td>
                                <td><?php echo JP_money(intval($data['price']));?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <header class=" w3-bottombar w3-border-blue w3-center p-2">
                        <h3>Student Details</h3>
                    </header>
                    <div class="table-responsive p-3">
                        <form action="ecordersubmit" method="post">
                        <table class="table">
                            <tr>
                                <td>Full Name</td>
                                <td><input type="text" class="w3-input w3-border w3-bottombar w3-border-blue" name="cfullname"> </td>
                            </tr>
                            <tr>
                                <td>Full Address</td>
                                <td><input type="text" class="w3-input w3-border w3-bottombar w3-border-blue" name="address"> </td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td><input type="text" class="w3-input w3-border w3-bottombar w3-border-blue" name="phone"> </td>
                            </tr>
                            <tr>
                                <td>Email Address</td>
                                <td><input type="text" class="w3-input w3-border w3-bottombar w3-border-blue" name="email"> </td>
                            </tr>
                            <!-- <tr>
                                <td>Product Quantity</td>
                                <td><input type="number" class="w3-input w3-border w3-bottombar w3-border-blue" name="quantity" required> </td>
                            </tr> -->
                            <tr>
                                <td>Period</td>
                                <td>
                                    <select name="period" class="w3-input w3-border w3-bottombar w3-border-blue">
                                        <option>Mondays, Wednessdays, Fridays</option>
                                        <option>Tuesdays, Thursdays and Saturdays</option>
                                        <option>Staturdays and Sundays</option>

                                    </select>
                                    <!-- <i>we charge for Product Shipping based on your Location via phone call</i> -->
                                </td>

                            </tr>
                        </table>
                        <input type="hidden"  name="orderby" value="<?php
                            if(isset($_SESSION['uid'])){
                                echo $_SESSION['uid'];
                            }else{
                                echo "guest";
                            }
                        ?>">
                        <input type="hidden"  name="pname" value="<?php
                            echo $data['name'];
                        ?>">
                        <input type="hidden"  name="powner" value="<?php
                            echo $data['agent'];
                        ?>">
                        <input type="hidden"  name="price" value="<?php
                            echo $data['price'];
                        ?>">
                        <input type="hidden"  name="productid" value="<?php
                            echo $_GET['id'];
                        ?>">
                        <input type="submit" name="submit" value="Complete order" class="w3-button w3-blue">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
