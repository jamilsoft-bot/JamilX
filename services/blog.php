<?php
 
class blog extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('Blog Service');
    }

    public function main(){
        global $Url;
        $paths = $Url->get_paths();
        $segment = $paths[1] ?? null;
        $isAdmin = false;

        if (($paths[0] ?? '') === 'admin' && ($paths[1] ?? '') === 'blog') {
            $isAdmin = true;
            $segment = $paths[2] ?? null;
        }

        if ($segment === null && $Url->get('action') !== null) {
            $segment = $Url->get('action');
        }

        if ($isAdmin) {
            if (!blog_require_admin()) {
                return;
            }
            switch ($segment) {
                case 'new':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        adminStore();
                    } else {
                        adminCreate();
                    }
                    break;
                case 'edit':
                    $id = (int) ($paths[3] ?? $Url->get('id'));
                    if ($id <= 0) {
                        http_response_code(404);
                        include 'containers/common/error.php';
                        return;
                    }
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        adminUpdate($id);
                    } else {
                        adminEdit($id);
                    }
                    break;
                case 'delete':
                    $id = (int) ($paths[3] ?? $Url->get('id'));
                    if ($id <= 0) {
                        http_response_code(404);
                        include 'containers/common/error.php';
                        return;
                    }
                    adminDelete($id);
                    break;
                case 'categories':
                    adminCategories();
                    break;
                case 'tags':
                    adminTags();
                    break;
                case 'upload':
                    uploadFeaturedImage();
                    break;
                default:
                    adminIndex();
                    break;
            }
            return;
        }

        switch ($segment) {
            case 'post':
                $slug = $paths[2] ?? $Url->get('slug');
                if (!$slug) {
                    http_response_code(404);
                    include 'containers/common/error.php';
                    return;
                }
                viewPost($slug);
                break;
            case 'category':
                listByCategory($paths[2] ?? null);
                break;
            case 'tag':
                listByTag($paths[2] ?? null);
                break;
            case 'search':
                search();
                break;
            default:
                listPosts();
                break;
        }
    }
}
