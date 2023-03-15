<div class="table-responsive">
    <table class="table">
        <tr>
            <th><i class="fa fa-cogs"></i> </th>
            <th>Id</th>
            <th>Product</th>
            <th>Customer</th>
            <th>Quantity</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
        <?php

        delete_item('orders');
        confirm_item();
        global $JX_db;
        $me = $_SESSION['uid'];
        $sql = "SELECT *FROM `orders` WHERE `powner`='$me'";
        $row = $JX_db->query($sql);


        foreach($row as $r){
            echo "<tr>";
            echo "<td>";
            include "list-actions.php";
            echo "</td>";
            echo "<td>" . $r['id'] . "</td>";
            echo "<td >" . $r['pname'] . "</td>";
            echo "<td '>" . $r['customer_name'] . "</td>";
            echo "<td >" . $r['quantity'] . "</td>";
            echo "<td >" . JP_money(intval($r['price']) * intval($r['quantity'])) . "</td>";
            echo "<td >" . $r['status'] . "</td>";
            echo "<td>" . get_default_date($r['date']) . "</td>";


        }


        ?>
    </table>
</div>