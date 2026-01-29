<?php

class aboutno extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        include 'containers/dashboard/about.php';
    }
}

class dashboardhome extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        include 'containers/dashboard/home.php';
    }
}

class messages extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        include 'containers/messages/message-list.php';
    }
}

class ads extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Ads List');
    }

    public function getAction()
    {
        include 'containers/dashboard/pad.php';
    }
}

class Blist extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Business List');
    }

    public function getAction()
    {
        include 'containers/dashboard/pad.php';
    }
}

class seo extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('seo service');
    }

    public function getAction()
    {
        echo 'SEO';
    }
}
