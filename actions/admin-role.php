<?php

class roleadd extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Create Role');
    }

    public function getAction()
    {
        global $JX_db;
        if (isset($_POST['rolebtn'])) {

            // $powner = $_SESSION['uid'];
            $name = $_POST['name'];
            $summary = $_POST['summary'];
            // $blog = $_POST['parent'];
            $pimage = null;//$_FILES['image']['name'];
            $pimageu = null;//$_FILES['image'];
            // $author = intval($_SESSION['uid']);
            $category = $_POST['category'];

            $sql = "INSERT INTO `roles`(`name`, `summary`, `category`) VALUES ('$name','$summary','$category')";
             if ($JX_db->query($sql)) {
                    echo "<div class='alert w3-flat-wet-asphalt alert-dismissible fade show' role='alert'>";
                    echo "<strong>Content Created!</strong> Category was created Sucessfully.";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }else {
                    echo $JX_db->error;
                echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
                echo "<strong>Content Error!</strong> Something went wrong, please check<br>your fields to correct the errors.";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        } 

        include 'containers/roles/create.php';
    }
}

class roleupdate extends JX_Action implements JX_ActionI
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
            $body = $Url->post('summary');
            $keywords = $Url->post('keyword');
            $owner  = $Url->get('b');
            $blog = $Url->post('parent');
            $pid = $Url->get('cid');
            $logo = $_FILES['image']['name'];

            if (UploadpostImage($lg)) {
                $sql = "UPDATE `role` SET `name`='$title',`summary`='$body',`category`='$category'";
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
        include 'containers/cat/cat-update.php';
    }
}

class roles extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Role List');
    }

    public function getAction()
    {
        global $db, $Url;

        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Content Alert!</strong><br> Are you Sure, You want to delete this Category?.<br>";
            echo "<br><a href='admin?b=$code&action=cats&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if ($Url->get('yesdel') !== null) {
            global $JX_db;
            $id = $Url->get('yesdel');

            $sql = "DELETE FROM `categories` WHERE `id`=$id";
            if ($JX_db->query($sql)) {
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Content Alert!</strong> the Category has successfully deleted.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }

        include 'containers/roles/role-list.php';
    }
}

class roledel extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        global $db, $Url;
        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Content Alert!</strong><br> Are you Sure, You want to delete this Category?.<br>";
            echo "<br><a href='admin?b=$code&action=catdel&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
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
