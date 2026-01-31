<?php
 
class filemanager extends JX_Serivce implements JX_service
{
    public function __construct()
    {
        $this->setTitle('File Manager');
    }

    public function main()
    {
        global $Url;

        $paths = $Url->get_paths();
        $action = $Url->get('action');

        if ($action === null && isset($paths[1])) {
            $redirect = 'filemanager?action=' . urlencode($paths[1]);
            if ($paths[1] === 'api' && isset($paths[2])) {
                $redirect .= '&api=' . urlencode($paths[2]);
            }
            Redirect($redirect);
            return;
        }

        $action = $action ?? 'home';
        $actionMap = [
            'home' => 'filemanagerhome',
            'browse' => 'filemanagerbrowse',
            'upload' => 'filemanagerupload',
            'new-folder' => 'filemanagernewfolder',
            'rename' => 'filemanagerrename',
            'delete' => 'filemanagerdelete',
            'move' => 'filemanagermove',
            'copy' => 'filemanagercopy',
            'download' => 'filemanagerdownload',
            'preview' => 'filemanagerpreview',
            'search' => 'filemanagersearch',
            'api' => 'filemanagerapi',
        ];

        $actionClass = $actionMap[$action] ?? null;
        if (!$actionClass || !class_exists($actionClass)) {
            http_response_code(404);
            include 'containers/common/error.php';
            return;
        }

        $getAction = new $actionClass();
        $getAction->getAction();
    }
}
