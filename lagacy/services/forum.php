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
        $action = $Url->get('action');
        $isAdmin = false;

        if (($paths[0] ?? '') === 'admin' && ($paths[1] ?? '') === 'forum') {
            $isAdmin = true;
            if ($action === null && isset($paths[2])) {
                $redirect = 'admin/forum?action=' . urlencode($paths[2]);
                if (isset($paths[3])) {
                    $redirect .= '&id=' . urlencode($paths[3]);
                }
                Redirect($redirect);
                return;
            }
        }

        if (!$isAdmin && $action === null && isset($paths[1])) {
            $redirect = 'forum?action=' . urlencode($paths[1]);
            if (isset($paths[3])) {
                $redirect .= '&id=' . urlencode($paths[2]);
                $redirect .= '&slug=' . urlencode($paths[3]);
            } elseif (isset($paths[2])) {
                $redirect .= '&slug=' . urlencode($paths[2]);
            }
            Redirect($redirect);
            return;
        }

        if ($isAdmin) {
            $action = $action ?? 'categories';
            $actionMap = [
                'categories' => 'forumadmincategories',
                'categories-save' => 'forumadmincategoriessave',
            ];
            $actionClass = $actionMap[$action] ?? null;
            if (!$actionClass || !class_exists($actionClass)) {
                http_response_code(404);
                include 'containers/common/error.php';
                return;
            }
            $getAction = new $actionClass();
            $getAction->getAction();
            return;
        }

        $action = $action ?? 'home';
        $actionMap = [
            'home' => 'forumindex',
            'category' => 'forumcategory',
            'topic' => 'forumtopic',
            'new' => 'forumnewtopic',
            'reply' => 'forumreply',
            'search' => 'forumsearch',
            'moderate-lock' => 'forummoderatelock',
            'moderate-pin' => 'forummoderatepin',
            'post-delete' => 'forumpostdelete',
            'post-restore' => 'forumpostrestore',
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
