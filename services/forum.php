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
        $action = $Url->get('action') ?? 'home';
        $actionMap = [
            'home' => 'forumhome',
            'category' => 'forumcategory',
            'topic' => 'forumtopic',
            'new' => 'forumnewtopic',
            'reply' => 'forumreply',
            'search' => 'forumsearch',
            'moderate-lock' => 'forummoderatelock',
            'moderate-pin' => 'forummoderatepin',
            'post-delete' => 'forumpostdelete',
            'post-restore' => 'forumpostrestore',
            'admin-categories' => 'forumadmincategories',
            'admin-categories-save' => 'forumadmincategoriessave',
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
