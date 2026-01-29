<?php
 
class forum extends JX_Serivce implements JX_service
{
    public function __construct()
    {
        $this->setTitle('Forum Service');
    }

    public function main()
    {
        global $Url;
        $paths = $Url->get_paths();
        $segment = $paths[1] ?? null;
        $isAdmin = false;

        if (($paths[0] ?? '') === 'admin' && ($paths[1] ?? '') === 'forum') {
            $isAdmin = true;
            $segment = $paths[2] ?? null;
        }

        if ($segment === null && $Url->get('action') !== null) {
            $segment = $Url->get('action');
        }

        if ($isAdmin) {
            switch ($segment) {
                case 'categories':
                    forum_admin_categories();
                    break;
                case 'categories-save':
                    $id = (int) ($paths[3] ?? $Url->get('id'));
                    forum_admin_save_category($id ?: null);
                    break;
                default:
                    forum_admin_categories();
                    break;
            }
            return;
        }

        switch ($segment) {
            case 'category':
                forum_category($paths[2] ?? '');
                break;
            case 'topic':
                forum_topic($paths[2] ?? '');
                break;
            case 'new':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    forum_store_topic($paths[2] ?? '');
                } else {
                    forum_new_topic($paths[2] ?? '');
                }
                break;
            case 'reply':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    forum_reply($paths[2] ?? '');
                } else {
                    http_response_code(405);
                }
                break;
            case 'search':
                forum_search();
                break;
            case 'moderate-lock':
                forum_admin_toggle_topic((int) ($paths[2] ?? $Url->get('id')), 'is_locked');
                break;
            case 'moderate-pin':
                forum_admin_toggle_topic((int) ($paths[2] ?? $Url->get('id')), 'is_pinned');
                break;
            case 'post-delete':
                forum_admin_delete_post((int) ($paths[2] ?? $Url->get('id')), $paths[3] ?? '');
                break;
            case 'post-restore':
                forum_admin_restore_post((int) ($paths[2] ?? $Url->get('id')), $paths[3] ?? '');
                break;
            case 'home':
            case null:
                forum_index();
                break;
            default:
                http_response_code(404);
                include 'containers/common/error.php';
                break;
        }
    }
}
