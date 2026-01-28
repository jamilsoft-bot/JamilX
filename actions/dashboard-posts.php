<?php

class postview extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Post List');
    }

    public function getAction()
    {
        include 'containers/posts/post-view.php';
    }
}

class postupdate extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Post post update');
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
            $pid = $Url->get('pid');
            $cat = $Url->post('cat');
            $logo = $_FILES['image']['name'];
            $author = $Me->username();

            if (UploadpostImage($lg)) {
                $sql = "UPDATE `posts` SET `title`='$title',`cat`='$cat',`content`='$body',`image`='$logo',`owner`='$owner',`blog`='$blog',`keywords`='$keywords',`author`='$author',`date_updated`=CURRENT_TIMESTAMP WHERE `id` = '$pid'";
                if ($db->Query($sql)) {
                    echo "<div class='alert w3-green alert-dismissible fade show' role='alert'>";
                    echo "<strong>Campaign Alert!</strong> the Post was successfully updated.<br>";
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
        include 'containers/posts/post-update.php';
    }
}

class postlist extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Post List');
    }

    public function getAction()
    {
        global $db, $Url;

        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Campaign Alert!</strong><br> Are you Sure, You want to delete this post?.<br>";
            echo "<br><a href='dashboard?b=$code&action=posts&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if ($Url->get('yesdel') !== null) {
            $id = $Url->get('yesdel');

            $sql = "DELETE FROM `posts` WHERE `id`=$id";
            if ($db->Query($sql)) {
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Alert!</strong> the post has successfully deleted.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }

        include 'containers/posts/post-list.php';
    }
}

class postdel extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Post List');
    }

    public function getAction()
    {
        global $db, $Url;
        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Campaign Alert!</strong><br> Are you Sure, You want to delete this post?.<br>";
            echo "<br><a href='dashboard?b=$code&action=posts&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if ($Url->get('yesdel') !== null) {
            $id = $Url->get('yesdel');

            $sql = "DELETE FROM `posts` WHERE `id`=$id";
            if ($db->Query($sql)) {
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Alert!</strong> the post has successfully deleted.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
    }
}

class postadd extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Create Posts');
    }

    public function getAction()
    {
        global $db, $Me;
        if (isset($_POST) && $_FILES) {

            $powner = $_GET['b'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $blog = $_POST['parent'];
            $pimage = $_FILES['image']['name'];
            $cat = $_POST['cat'];
            $pimageu = $_FILES['image'];
            $author = $Me->username();

            $sql = "INSERT INTO `posts`(`blog`, `title`, `content`, `type`, `image`, `owner`,`author`,`cat`) VALUES ('$blog','$title','$content','post','$pimage','$powner','$author','$cat')";
            if (UploadpostImage($pimageu)) {
                if ($db->Query($sql)) {
                    echo "<div class='alert w3-flat-wet-asphalt alert-dismissible fade show' role='alert'>";
                    echo "<strong>Campaign Created!</strong> Post created Sucessfully.";
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

        include 'containers/posts/post-add.php';
    }
}

class posts extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Posts management tool');
    }

    public function getAction()
    {
        global $db, $Url;

        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Campaign Alert!</strong><br> Are you Sure, You want to delete this post?.<br>";
            echo "<br><a href='dashboard?b=$code&action=posts&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if ($Url->get('yesdel') !== null) {
            $id = $Url->get('yesdel');

            $sql = "DELETE FROM `posts` WHERE `id`=$id";
            if ($db->Query($sql)) {
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Alert!</strong> the post has successfully deleted.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }

        include 'containers/posts/post-list.php';
    }
}
