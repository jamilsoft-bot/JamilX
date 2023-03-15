<?php

//$product_name = $data['title'];
//$product_summary = null;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jamilsoft - Online Business Directory</title>
    <link rel="stylesheet" href="assets/css/jamilpress.css">
    <link rel="stylesheet" href="assets/lib/w3/w3.css">
    <link rel="shortcut icon" href="Apps/search/assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/lib/bs5/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/lib/font/css/all.css">
    <meta name="description" content="Just another Online Directory">
    <meta name="keywords" content="Jamilsoft, Jamilpress, Business, Directory, Education, Course, Projects, etc">
    <meta name="author" content="Muhammad Jamil">
    
</head>
<body>

<div class="container">
    <div class="w3-card">
        <header class="w3-container w3-center w3-green p-2">
            <h3>Invoice</h3>
        </header>
        <div class="w3-container">
                <div class="p-2">
                    <header class=" w3-bottombar w3-border-green p-2">
                        <div class="row">
                            <div class="col-md-8">
                                <h4>Issued to</h4>
                                <address>
                                    <?php echo $data['customer_name'];?><br>
                                    <?php echo $data['address'];?></br>
                                    <?php echo $data['phone'] . ", ". $data['email'];?></br>
                                    <?php echo $data['period'];?>
                                </address>
                            </div>
                            <div class="col-md">
                                <?php if($data['status'] == 'pending'):?>
                                <h4>Pay to</h4>
                                <address>
                                    Muhammad Jamil Yakubu<br>
                                    Wema Bank<br>
                                    0272233719<br>
                                </address>
                                <?php else:?>
                                    <h4 class="w3-text-red">Paid</h4>
                                <?php endif;?>
                            </div>
                        </div>
                    </header>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Course Name</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Amount</th>
                            </tr>
                            <tr>
                                <td><?php echo $data['cname'] . " -" . $data['period'];?></td>
                                <td>1</td>
                                <td><?php echo JP_money(intval($data['price']));?></td>
                                <td><?php echo JP_money(intval($data['price']) )?></td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="w3-green">Total</td>
                                <td><?php echo JP_money(intval($data['price']))?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="w3-center mt-4">
                        <h1>Your Order key: <?php echo $data['orderkey']?></h1>
                    </div>
                </div>
        </div>
    </div>

</div>
</body>
</html>