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
        $segment = $paths[1] ?? null;

        if ($segment === null && $Url->get('action') !== null) {
            $segment = $Url->get('action');
        }

        if ($segment === 'api') {
            $apiAction = $paths[2] ?? $Url->get('api');
            switch ($apiAction) {
                case 'list':
                    filemanager_api_list();
                    break;
                case 'upload':
                    filemanager_api_upload();
                    break;
                default:
                    http_response_code(404);
                    include 'containers/common/error.php';
                    break;
            }
            return;
        }

        switch ($segment) {
            case 'browse':
                filemanager_browse();
                break;
            case 'upload':
                filemanager_upload();
                break;
            case 'new-folder':
                filemanager_create_folder();
                break;
            case 'rename':
                filemanager_rename();
                break;
            case 'delete':
                filemanager_delete();
                break;
            case 'move':
                filemanager_move();
                break;
            case 'copy':
                filemanager_copy();
                break;
            case 'download':
                filemanager_download();
                break;
            case 'preview':
                filemanager_preview();
                break;
            case 'search':
                filemanager_search();
                break;
            case 'home':
            case null:
                filemanager_index();
                break;
            default:
                http_response_code(404);
                include 'containers/common/error.php';
                break;
        }
    }
}
