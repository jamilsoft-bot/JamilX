<?php

class profilesettingsupdate extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Updating Settings');
    }

    public function getAction()
    {
        global $Url, $Me;

        $userId = (int) ($Me->id() ?? 0);
        if ($userId <= 0) {
            Redirect('login&resume=profile');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Redirect('profile?action=settings');
            return;
        }

        $preferences = [
            'show_email' => $Url->post('show_email') ? true : false,
            'show_phone' => $Url->post('show_phone') ? true : false,
            'show_location' => $Url->post('show_location') ? true : false,
            'newsletter' => $Url->post('newsletter') ? true : false,
        ];

        $profileModel = new JX_UserProfileP();
        $profileModel->upsert($userId, [
            'preferences' => $profileModel->encodeJson($preferences),
        ]);

        Redirect('profile?action=settings');
    }
}
