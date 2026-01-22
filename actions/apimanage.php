<?php

/**
 * API management home action.
 */
class apimanage extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('API Management Overview');
        $this->setText('');
    }

    public function getAction()
    {
        include 'containers/api/manage-home.php';
    }
}
