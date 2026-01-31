<?php

class profileedit extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Edit Profile');
        $this->setText('Update your personal details, skills, and social links.');
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

        include 'containers/profile/edit.php';
    }
}
