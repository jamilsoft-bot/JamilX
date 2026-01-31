<?php

class profileupdate extends JX_Action implements JX_ActionI
{
    public function __construct()
    {
        $this->setTitle('Updating Profile');
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
            Redirect('profile?action=edit');
            return;
        }

        $profileModel = new JX_UserProfileP();
        $skills = $profileModel->encodeList($Url->post('skills') ?? '');

        $socialLinks = [
            'twitter' => Input_test('twitter'),
            'linkedin' => Input_test('linkedin'),
            'github' => Input_test('github'),
        ];

        $payload = [
            'display_name' => Input_test('display_name'),
            'headline' => Input_test('headline'),
            'bio' => Input_test('bio'),
            'website' => Input_test('website'),
            'location' => Input_test('location'),
            'timezone' => Input_test('timezone'),
            'pronouns' => Input_test('pronouns'),
            'skills' => $skills,
            'social_links' => $profileModel->encodeJson($socialLinks),
        ];

        $profileModel->upsert($userId, $payload);

        Redirect('profile?action=view');
    }
}
