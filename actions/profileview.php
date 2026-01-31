<?php

class profileview extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Profile Overview');
        $this->setText('Review and share the highlights of your account.');
    }

    public function getAction()
    {
        global $Me, $users, $JX_db;

        $userId = (int) ($Me->id() ?? 0);
        $userRow = [];

        if ($userId > 0) {
            $result = $JX_db->query($users->SelectById($userId));
            foreach ($result as $row) {
                $userRow = $row;
                break;
            }
        }

        $profileModel = new JX_UserProfileP();
        $profile = $profileModel->getByUserId($userId) ?? [];
        $skills = $profileModel->decodeJson($profile['skills'] ?? '');
        $socialLinks = $profileModel->decodeJson($profile['social_links'] ?? '');
        $preferences = $profileModel->decodeJson($profile['preferences'] ?? '');

        include 'containers/profile/view.php';
    }
}
