<?php

class catadd extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Create Category');
    }

    public function getAction()
    {
        global $db;
        if (isset($_POST) && $_FILES) {

            $powner = $_GET['b'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $blog = $_POST['parent'];
            $pimage = $_FILES['image']['name'];
            $pimageu = $_FILES['image'];
            $author = intval($_SESSION['uid']);
            $parent = $_POST['parent'];

            $sql = "INSERT INTO `categories`(`name`, `description`, `parent`, `image`, `owner`,`author`) VALUES ('$title','$content','$parent','$pimage','$powner',$author)";
            if (UploadpostImage($pimageu)) {
                if ($db->Query($sql)) {
                    echo "<div class='alert w3-flat-wet-asphalt alert-dismissible fade show' role='alert'>";
                    echo "<strong>Content Created!</strong> Category was created Sucessfully.";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            } else {
                echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
                echo "<strong>Content Error!</strong> Something went wrong, please check<br>your fields to correct the errors.";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }

        include 'containers/admin/error.php';
    }
}

class catupdate extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Category update');
    }

    public function getAction()
    {
        global $db, $Url, $Me;

        if ($Url->post('update') !== null) {
            $lg = $_FILES['image'];
            $title = $Url->post('title');
            $body = $Url->post('content');
            $keywords = $Url->post('keyword');
            $owner  = $Url->get('b');
            $blog = $Url->post('parent');
            $pid = $Url->get('cid');
            $logo = $_FILES['image']['name'];
            $author = $Me->username();

            if (UploadpostImage($lg)) {
                $sql = "UPDATE `categories` SET `name`='$title',`description`='$body',`image`='$logo',`owner`='$owner',`parent`='$blog',`keywords`='$keywords',`author`='$author',`updated`=CURRENT_TIMESTAMP WHERE `id` = '$pid'";
                if ($db->Query($sql)) {
                    echo "<div class='alert w3-green alert-dismissible fade show' role='alert'>";
                    echo "<strong>Content Alert!</strong> the Category was successfully updated.<br>";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            } else {
                echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
                echo "<strong>Content Error!</strong> Something went wrong, please check<br>your fields to correct the errors.";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
        include 'containers/admin/error.php';
    }
}

class cats extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Categoery List');
    }

    public function getAction()
    {
        global $db, $Url;

        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Content Alert!</strong><br> Are you Sure, You want to delete this Category?.<br>";
            echo "<br><a href='dashboard?b=$code&action=cat&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if ($Url->get('yesdel') !== null) {
            $id = $Url->get('yesdel');

            $sql = "DELETE FROM `categories` WHERE `id`=$id";
            if ($db->Query($sql)) {
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Content Alert!</strong> the Category has successfully deleted.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }

        include 'containers/admin/error.php';
    }
}

class catdel extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        global $db, $Url;
        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Content Alert!</strong><br> Are you Sure, You want to delete this Category?.<br>";
            echo "<br><a href='dashboard?b=$code&action=cat&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if ($Url->get('yesdel') !== null) {
            $id = $Url->get('yesdel');

            $sql = "DELETE FROM `categories` WHERE `id`=$id";
            if ($db->Query($sql)) {
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Content Alert!</strong> the Category has successfully deleted.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
    }
}
