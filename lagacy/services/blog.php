<?php
 
class blog extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('Blog Service');
    }

    public function main(){
        global $Url;
        $paths = $Url->get_paths();
        $action = $Url->get('action');
        $isAdmin = false;

        if (($paths[0] ?? '') === 'admin' && ($paths[1] ?? '') === 'blog') {
            $isAdmin = true;
            if ($action === null && isset($paths[2])) {
                $redirect = 'admin/blog?action=' . urlencode($paths[2]);
                if (isset($paths[3])) {
                    $redirect .= '&id=' . urlencode($paths[3]);
                }
                Redirect($redirect);
                return;
            }
        }

        if (!$isAdmin && $action === null && isset($paths[1])) {
            $redirect = 'blog?action=' . urlencode($paths[1]);
            if (isset($paths[2])) {
                $redirect .= '&slug=' . urlencode($paths[2]);
            }
            Redirect($redirect);
            return;
        }

        if ($isAdmin) {
            if (!blog_require_admin()) {
                return;
            }
            $action = $action ?? 'index';
            $actionMap = [
                'index' => 'blogadminindex',
                'new' => 'blogadmincreate',
                'edit' => 'blogadminedit',
                'delete' => 'blogadmindelete',
                'categories' => 'blogadmincategories',
                'tags' => 'blogadmintags',
                'upload' => 'blogadminupload',
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
            'home' => 'bloglist',
            'post' => 'blogpost',
            'category' => 'blogcategory',
            'tag' => 'blogtag',
            'search' => 'blogsearch',
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
