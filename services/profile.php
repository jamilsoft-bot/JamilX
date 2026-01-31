<?php

class profile extends JX_Serivce implements JX_service
{
    private $profile;

    public function __construct()
    {
        $this->setTitle('User Profile');
        $this->profile = new JX_ProfileP();
    }

    public function main()
    {
        global $Url;
        $action = $Url->get('action') ?? 'overview';

        if (!method_exists($this, $action)) {
            $action = 'overview';
        }

        $this->$action();
    }

    private function guardAuth(): void
    {
        if (!isset($_SESSION['uid'])) {
            echo "<script>location.assign('login');</script>";
            exit;
        }
    }

    public function overview(): void
    {
        $this->guardAuth();
        $uid = (int) $_SESSION['uid'];
        $user = $this->profile->getUserById($uid);
        $experiences = $this->profile->getUserExperiences($uid);

        include 'containers/profile/overview.php';
    }

    public function edit(): void
    {
        global $Url;
        $this->guardAuth();
        $uid = (int) $_SESSION['uid'];
        $message = null;

        if ($Url->isPost()) {
            $payload = [
                'username' => $Url->post('username'),
                'email' => $Url->post('email'),
                'phone' => $Url->post('phone'),
                'name' => $Url->post('name'),
                'bio' => $Url->post('bio'),
                'address' => $Url->post('address'),
                'city' => $Url->post('city'),
                'state' => $Url->post('state'),
                'country' => $Url->post('country'),
                'dob' => $Url->post('dob'),
                'gender' => $Url->post('gender'),
            ];

            $password = $Url->post('password');
            if (!empty($password)) {
                $payload['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            $message = $this->profile->updateProfile($uid, $payload)
                ? 'Profile updated successfully.'
                : 'No changes were saved.';
        }

        $user = $this->profile->getUserById($uid);
        include 'containers/profile/edit.php';
    }

    public function experience(): void
    {
        global $Url;
        $this->guardAuth();
        $uid = (int) $_SESSION['uid'];
        $message = null;

        if ($Url->isPost()) {
            $payload = [
                'title' => $Url->post('title'),
                'company_name' => $Url->post('company_name'),
                'location' => $Url->post('location'),
                'start_date' => $Url->post('start_date'),
                'end_date' => $Url->post('end_date'),
                'is_current' => $Url->post('is_current'),
                'description' => $Url->post('description'),
            ];

            $message = $this->profile->addExperience($uid, $payload)
                ? 'Experience added successfully.'
                : 'Unable to add experience. Check required fields.';
        }

        $user = $this->profile->getUserById($uid);
        $experiences = $this->profile->getUserExperiences($uid);
        include 'containers/profile/experience.php';
    }
}
