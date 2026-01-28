<?php

class productupdate extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Product update');
    }

    public function getAction()
    {
        global $db, $Url, $Me;
        if ($Url->post('update') !== null) {
            $name = $Url->post('name');
            $author = $Me->username();
            $content = $Url->post('content');
            $price = $Url->post('rprice');
            $sale = $Url->post('sprice');
            $type = $Url->post('type');
            $owner = $Url->get('b');
            $pid = $Url->get('pid');
            $blog = $Url->post('parent');
            $image = $_FILES['image'];
            $pic = $image['name'];

            if (UploadpostImage($image)) {
                $sql = "UPDATE `products` SET `name`='$name',`content`='$content',`pic`='$pic',`owner`='$owner',`blog`='$blog',`type`='$type',`price`='$price',`sale`='$sale',`author`='$author',`date_update`=CURRENT_TIMESTAMP WHERE `id` = '$pid'";
                if ($db->Query($sql)) {
                    echo "<div class='alert w3-green alert-dismissible fade show' role='alert'>";
                    echo "<strong>Campaign Alert!</strong> the Product was successfully updated.<br>";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            } else {
                echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Error!</strong> Something went wrong, please check<br>your fields to correct the errors.";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }

        include 'containers/product/product-update.php';
    }
}

class products extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Products List');
    }

    public function getAction()
    {
        global $db, $Url;

        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Campaign Alert!</strong><br> Are you Sure, You want to delete this post?.<br>";
            echo "<br><a href='dashboard?b=$code&action=products&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if ($Url->get('yesdel') !== null) {
            $id = $Url->get('yesdel');

            $sql = "DELETE FROM `products` WHERE `id`=$id";
            if ($db->Query($sql)) {
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Alert!</strong> the Product was successfully deleted.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }

        include 'containers/product/product-list.php';
    }
}

class productdel extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Product list');
    }

    public function getAction()
    {
        global $db, $Url;
        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Campaign Alert!</strong><br> Are you Sure, You want to delete this post?.<br>";
            echo "<br><a href='dashboard?b=$code&action=products&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if ($Url->get('yesdel') !== null) {
            $id = $Url->get('yesdel');

            $sql = "DELETE FROM `products` WHERE `id`=$id";
            if ($db->Query($sql)) {
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Alert!</strong> the Product was successfully deleted.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
    }
}

class productadd extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Create Product');
    }

    public function getAction()
    {
        global $db, $Url, $Me;

        if (isset($_POST['padd'])) {

            $name = $Url->post('name');
            $author = $Me->username();
            $content = $Url->post('content');
            $price = $Url->post('rprice');
            $sale = $Url->post('sprice');
            $type = $Url->post('type');
            $owner = $Url->get('b');
            $blog = $Url->post('parent');
            $image = $_FILES['image'];
            $pic = $image['name'];

            if (UploadpostImage($image)) {
                $sql = "INSERT INTO `products`( `name`, `content`, `pic`, `price`, `sale`,`type` , `owner`, `blog`, `author`) VALUES ('$name','$content','$pic','$price','$sale','$type','$owner','$blog','$author')";
                if ($db->Query($sql)) {
                    echo "<div class='alert w3-flat-wet-asphalt alert-dismissible fade show' role='alert'>";
                    echo "<strong>Campaign Created!</strong> Product was created Sucessfully.";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            } else {
                echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Error!</strong> Something went wrong, please check<br>your fields to correct the errors.";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
        include 'containers/product/product-add.php';
    }
}
