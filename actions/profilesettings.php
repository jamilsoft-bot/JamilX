<?php

class profilesettings extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Profile Settings');
        $this->setText('Control visibility, notifications, and privacy preferences.');
    }

    public function getAction()
    {
        global $Me;

        $userId = (int) ($Me->id() ?? 0);
        $profileModel = new JX_UserProfileP();
        $profile = $profileModel->getByUserId($userId) ?? [];
        $preferences = $profileModel->decodeJson($profile['preferences'] ?? '');

        include 'containers/profile/settings.php';
    }
}
