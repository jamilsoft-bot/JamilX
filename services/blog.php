<?php
 
class blog extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('Blog Service');
    }

    public function main(){
        global $Url;
        $action = $Url->get('action') ?? 'home';
        $actionMap = [
            'home' => 'blogindex',
            'post' => 'blogpost',
            'category' => 'blogcategory',
            'tag' => 'blogtag',
            'search' => 'blogsearch',
            'admin-index' => 'blogadminindex',
            'admin-new' => 'blogadminnew',
            'admin-edit' => 'blogadminedit',
            'admin-delete' => 'blogadmindelete',
            'admin-categories' => 'blogadmincategories',
            'admin-tags' => 'blogadmintags',
            'admin-upload' => 'blogadminupload',
        ];

        $actionClass = $actionMap[$action] ?? $actionMap['home'];

        if (class_exists($actionClass)) {
            $handler = new $actionClass();
            $handler->getAction();
            return;
        }

        http_response_code(404);
        include 'containers/common/error.php';
    }
}
