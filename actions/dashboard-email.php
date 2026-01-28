<?php

class emails extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Email service');
    }

    public function getAction()
    {
        global $db, $Url;

        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Campaign Alert!</strong><br> Are you Sure, You want to delete this Email?.<br>";
            echo "<br><a href='dashboard?b=$code&action=emails&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if ($Url->get('yesdel') !== null) {
            $id = $Url->get('yesdel');

            $sql = "DELETE FROM `mails` WHERE `id`=$id";

            if ($db->Query($sql)) {
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Alert!</strong> the email was successfully deleted.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }

        include 'containers/email/email-list.php';
    }
}

class emailupdate extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Email list');
    }

    public function getAction()
    {
        global $db, $Url;
        if ($Url->post('update') !== null) {
            $subject = $Url->post('subject');
            $content = $Url->post('content');
            $cc = $Url->post('cc');
            $owner  = $Url->get('b');
            $eid  = $Url->get('eid');


            $sql = "UPDATE `mails` SET `owner`='$owner',`subject`='$subject',`cc`='$cc',`content`= '$content',`updated`= CURRENT_TIMESTAMP WHERE `id` = $eid";
            if ($db->Query($sql)) {
                echo "<div class='alert w3-green alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Alert!</strong> the Email was successfully updated.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
        include 'containers/email/email-update.php';
    }
}

class emaildel extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Email List');
    }

    public function getAction()
    {
        global $db, $Url;

        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Campaign Alert!</strong><br> Are you Sure, You want to delete this Email?.<br>";
            echo "<br><a href='dashboard?b=$code&action=emails&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if ($Url->get('yesdel') !== null) {
            $id = $Url->get('yesdel');

            $sql = "DELETE FROM `mails` WHERE `id`=$id";

            if ($db->Query($sql)) {
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Alert!</strong> the email was successfully deleted.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
    }
}

class emailadd extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Create Email');
    }

    public function getAction()
    {
        global $db;
        if (isset($_POST['add'])) {
            $powner = $_GET['b'];
            $subject = $_POST['subject'];
            $content = $_POST['content'];
            $cc_bcc = $_POST['cc'];

            $sql = "INSERT INTO `mails`(`subject`, `cc`, `content`, `owner`) VALUES ('$subject','$cc_bcc','$content','$powner')";

            if ($db->Query($sql)) {
                echo "<div class='alert w3-flat-wet-asphalt alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Created!</strong> Email was created Sucessfully.";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            } else {
                echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Error!</strong> Something went wrong, please check<br>your fields to correct the errors.";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }

        include 'containers/email/email-add.php';
    }
}
