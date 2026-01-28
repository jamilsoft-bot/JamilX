<?php

class pages extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('blogs list');
    }

    public function getAction()
    {
        global $db, $Url;

        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Campaign Alert!</strong><br> Are you Sure, You want to delete this blog?.<br>";
            echo "<br><a href='dashboard?b=$code&action=pages&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if ($Url->get('yesdel') !== null) {
            $id = $Url->get('yesdel');

            $sql = "DELETE FROM `blogs` WHERE `id`=$id";

            if ($db->Query($sql)) {
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Alert!</strong> the blog was successfully deleted.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }

        include 'containers/blog/blog-list.php';
    }
}

class pageupdate extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('blogs list');
    }

    public function getAction()
    {
        global $db, $Url;
        if ($Url->post('update') !== null) {
            $lg = $_FILES['bloglogo'];
            $name = $Url->post('blogname');
            $des = $Url->post('blogDes');
            $cat = $Url->post('cat');
            $keywords = $Url->post('keyword');
            $owner  = $Url->post('owner');
            $url = $Url->post('blogurl');
            $bid = $Url->get('bid');
            $logo = $_FILES['bloglogo']['name'];

            if (UploadpostImage($lg)) {
                $sql = "UPDATE `blogs` SET `name`='$name',`url`='$url',`logo`='$logo',`category`='$cat',`description`= '$des',`keywords`='$keywords',`date_update`= CURRENT_TIMESTAMP WHERE `id` = $bid";
                if ($db->Query($sql)) {
                    echo "<div class='alert w3-green alert-dismissible fade show' role='alert'>";
                    echo "<strong>Campaign Alert!</strong> the blog was successfully updated.<br>";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            }
        }
        include 'containers/blog/blog-update.php';
    }
}

class pagedel extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Blog List');
    }

    public function getAction()
    {
        global $db, $Url;
        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Campaign Alert!</strong><br> Are you Sure, You want to delete this blog?.<br>";
            echo "<br><a href='dashboard?b=$code&action=pages&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if ($Url->get('yesdel') !== null) {
            $id = $Url->get('yesdel');

            $sql = "DELETE FROM `blogs` WHERE `id`=$id";

            if ($db->Query($sql)) {
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Alert!</strong> the blog was successfully deleted.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
    }
}

class pageadd extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Blog list');
    }

    public function getAction()
    {
        global $db;
        $url = "";
        $name = "";
        $author = "";
        $dec = "";
        $keywords = "";
        $owner = "";
        $logo = "";
        $cat = "";

        if (isset($_POST['badd'])) {
            $url = $_POST['blogurl'];
            $name = $_POST['blogname'];
            $author = $_POST['author'];
            $owner = $_POST['owner'];
            $dec = $_POST['blogDes'];
            $keywords = $_POST['keywords'];
            $logo = $_FILES['bloglogo'];
            $cat = $_POST['cat'];


            if (UploadpostImage($logo)) {
                $lg = $logo['name'];
                $sql = "INSERT INTO `blogs`(`name`,`owner`,`description`,`author`,`keywords`,`logo`,`url`,`category`)VALUES('$name','$owner','$dec','$author','$keywords','$lg','$url','$cat')";

                if ($db->Query($sql)) {
                    echo "<div class='alert w3-flat-wet-asphalt alert-dismissible fade show' role='alert'>";
                    echo "<strong>Campaign Created!</strong> blog was created Sucessfully.";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            }
        }

        include 'containers/blog/blog-add.php';
    }
}
