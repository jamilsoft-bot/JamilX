<?php

class emailservice extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('Email Service');
    }
    public function main(){
        if (!isset($_SESSION['uid'])) {
            Redirect('login&resume=email');
            return;
        }
        if (!Email::isAdmin()) {
            $message = "You are not authorized to access the Email service. Please visit the <a href='dashboard'>Dashboard</a>.";
            $linkback = "dashboard";
            include('containers/admin/errorpage.php');
            return;
        }

        include 'containers/email/email.php';
    }

} 
