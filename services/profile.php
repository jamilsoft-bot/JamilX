<?php
 
class profile extends JX_Serivce implements JX_service
{
    public function __construct()
    {
        $this->setTitle('User Profile');
    }

    public function main()
    {
        global $Url;

        if (!isset($_SESSION['uid'])) {
            Redirect('login&resume=profile');
            return;
        }

        $action = is_null($Url->get('action')) ? 'view' : $Url->get('action');
        $actionMap = [
            'view' => 'profileview',
            'edit' => 'profileedit',
            'update' => 'profileupdate',
            'settings' => 'profilesettings',
            'settingsupdate' => 'profilesettingsupdate',
        ];

        $actionClass = $actionMap[$action] ?? 'profileview';

        if (!class_exists($actionClass)) {
            include 'containers/common/error.php';
            return;
        }

        $getAction = new $actionClass();

        if (in_array($action, ['update', 'settingsupdate'], true)) {
            $getAction->getAction();
            return;
        }

        include 'containers/profile/layout.php';
    }
}
