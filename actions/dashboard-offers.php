<?php

class offers extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Business Offers');
    }

    public function getAction()
    {
        global $db, $Url;

        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Campaign Alert!</strong><br> Are you Sure, You want to delete this Offer?.<br>";
            echo "<br><a href='dashboard?b=$code&action=offers&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if ($Url->get('yesdel') !== null) {
            $id = $Url->get('yesdel');

            $sql = "DELETE FROM `offers` WHERE `id`=$id";
            if ($db->Query($sql)) {
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Alert!</strong> the offer was successfully deleted.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }

        include 'containers/offer/offer-list.php';
    }
}

class offeradd extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Create Offer');
    }

    public function getAction()
    {
        global $db, $Url, $Me;

        if (isset($_POST['oadd'])) {

            $name = $Url->post('name');
            $author = $Me->username();
            $content = $Url->post('content');

            $type = $Url->post('type');
            $btnText = $type;
            $link = $Url->post('link');
            $owner = $Url->get('b');
            $blog = $Url->post('parent');
            $image = $_FILES['image'];
            $pic = $image['name'];

            if (UploadpostImage($image)) {
                $sql = "INSERT INTO `offers`(`link`, `name`,`btnText`, `content`, `image`,  `owner`, `blog`, `author`,`type`) VALUES ('$link','$name','$btnText','$content','$pic','$owner','$blog','$author','$type')";
                if ($db->Query($sql)) {
                    echo "<div class='alert w3-flat-wet-asphalt alert-dismissible fade show' role='alert'>";
                    echo "<strong>Campaign Created!</strong> Offer was created Sucessfully.";
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
        include 'containers/offer/offer-add.php';
    }
}

class offerupdate extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Business Offers');
    }

    public function getAction()
    {
        global $db, $Url, $Me;

        if ($Url->post('update') !== null) {
            $name = $Url->post('name');
            $author = $Me->username();
            $content = $Url->post('content');

            $type = $Url->post('type');
            $btnText = $type;
            $link = $Url->post('link');
            $owner = $Url->get('b');
            $oid = $Url->get('oid');
            $blog = $Url->post('parent');
            $image = $_FILES['image'];
            $pic = $image['name'];

            if (UploadpostImage($image)) {
                $sql = "UPDATE `offers` SET `name`='$name',`content`='$content',`image`='$pic',`owner`='$owner',`blog`='$blog',`type`='$type',`btnText`='$btnText',`link`='$link',`author`='$author',`date_update`=CURRENT_TIMESTAMP WHERE `id` = '$oid'";
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

        include 'containers/offer/offer-update.php';
    }
}

class offerdel extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Offer list');
    }

    public function getAction()
    {
        global $db, $Url;
        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Campaign Alert!</strong><br> Are you Sure, You want to delete this Offer?.<br>";
            echo "<br><a href='dashboard?b=$code&action=offers&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if ($Url->get('yesdel') !== null) {
            $id = $Url->get('yesdel');

            $sql = "DELETE FROM `offers` WHERE `id`=$id";
            if ($db->Query($sql)) {
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Alert!</strong> the offer was successfully deleted.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
    }
}
