<?php

function blog_handle_subscribe_request()
{
    global $Url;
    if ($Url->post('subscribe_email') !== null) {
        return blog_store_subscriber($Url->post('subscribe_email'));
    }
    return null;
}

function listPosts()
{
    global $Url;
    $page = max(1, (int) $Url->get('page'));
    $perPage = 6;
    $offset = ($page - 1) * $perPage;
    $posts = blog_fetch_posts($perPage, $offset);
    $total = blog_count_posts();
    $categories = blog_get_categories();
    $tags = blog_get_tags();
    $tagsMap = blog_get_tags_for_posts(array_column($posts, 'id'));
    $subscribeNotice = blog_handle_subscribe_request();
    $pagination = [
        'page' => $page,
        'total_pages' => max(1, (int) ceil($total / $perPage)),
        'base' => 'blog',
        'params' => ['action' => 'home'],
    ];
    include 'containers/blog/index.php';
}

function viewPost($slug)
{
    $post = blog_fetch_post_by_slug($slug);
    if (!$post) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }
    $tags = blog_get_tags_for_post($post['id']);
    $tagIds = array_column($tags, 'id');
    $relatedPosts = blog_get_related_posts($post['id'], $post['category_id'] ?? null, $tagIds, 3);
    $subscribeNotice = blog_handle_subscribe_request();
    include 'containers/blog/single.php';
}

function listByCategory($slug = null)
{
    global $Url;
    $categories = blog_get_categories();
    if ($slug === null) {
        include 'containers/blog/category.php';
        return;
    }

    $category = blog_get_category_by_slug($slug);
    if (!$category) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }

    $page = max(1, (int) $Url->get('page'));
    $perPage = 6;
    $offset = ($page - 1) * $perPage;
    $posts = blog_fetch_posts($perPage, $offset, ['category_id' => $category['id']]);
    $total = blog_count_posts(['category_id' => $category['id']]);
    $tagsMap = blog_get_tags_for_posts(array_column($posts, 'id'));
    $subscribeNotice = blog_handle_subscribe_request();
    $pagination = [
        'page' => $page,
        'total_pages' => max(1, (int) ceil($total / $perPage)),
        'base' => 'blog',
        'params' => ['action' => 'category', 'slug' => $category['slug']],
    ];
    include 'containers/blog/category.php';
}

function listByTag($slug = null)
{
    global $Url;
    $tags = blog_get_tags();
    if ($slug === null) {
        include 'containers/blog/tag.php';
        return;
    }

    $tag = blog_get_tag_by_slug($slug);
    if (!$tag) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }

    $page = max(1, (int) $Url->get('page'));
    $perPage = 6;
    $offset = ($page - 1) * $perPage;
    $posts = blog_fetch_posts($perPage, $offset, ['tag_id' => $tag['id']]);
    $total = blog_count_posts(['tag_id' => $tag['id']]);
    $tagsMap = blog_get_tags_for_posts(array_column($posts, 'id'));
    $subscribeNotice = blog_handle_subscribe_request();
    $pagination = [
        'page' => $page,
        'total_pages' => max(1, (int) ceil($total / $perPage)),
        'base' => 'blog',
        'params' => ['action' => 'tag', 'slug' => $tag['slug']],
    ];
    include 'containers/blog/tag.php';
}

function search()
{
    global $Url;
    $query = trim((string) $Url->get('q'));
    $page = max(1, (int) $Url->get('page'));
    $perPage = 6;
    $offset = ($page - 1) * $perPage;
    $posts = $query === '' ? [] : blog_fetch_posts($perPage, $offset, ['search' => $query]);
    $total = $query === '' ? 0 : blog_count_posts(['search' => $query]);
    $tagsMap = blog_get_tags_for_posts(array_column($posts, 'id'));
    $subscribeNotice = blog_handle_subscribe_request();
    $pagination = [
        'page' => $page,
        'total_pages' => max(1, (int) ceil(($total ?: 1) / $perPage)),
        'base' => 'blog',
        'params' => ['action' => 'search', 'q' => $query],
    ];
    include 'containers/blog/search.php';
}

function adminIndex()
{
    global $Url;
    $page = max(1, (int) $Url->get('page'));
    $perPage = 10;
    $offset = ($page - 1) * $perPage;
    $posts = blog_fetch_posts_admin($perPage, $offset);
    $total = blog_count_posts_admin();
    $tagsMap = blog_get_tags_for_posts(array_column($posts, 'id'));
    $stats = [
        'posts' => $total,
        'categories' => count(blog_get_categories()),
        'tags' => count(blog_get_tags()),
    ];
    $pagination = [
        'page' => $page,
        'total_pages' => max(1, (int) ceil($total / $perPage)),
        'base' => 'blog',
        'params' => ['action' => 'admin-index'],
    ];
    include 'containers/blog/admin/index.php';
}

function adminCreate($errors = [], $values = [], $notice = null)
{
    $categories = blog_get_categories();
    $tags = blog_get_tags();
    include 'containers/blog/admin/editor.php';
}

function adminStore()
{
    global $Url, $Me;
    $errors = [];
    $title = trim((string) $Url->post('title'));
    $slug = trim((string) $Url->post('slug'));
    $content = trim((string) $Url->post('content'));
    $excerpt = trim((string) $Url->post('excerpt'));
    $status = $Url->post('status') ?: 'draft';
    $publishedAt = blog_normalize_datetime($Url->post('published_at'));
    $categoryId = (int) $Url->post('category_id');
    $seoTitle = trim((string) $Url->post('seo_title'));
    $seoDescription = trim((string) $Url->post('seo_description'));

    if ($title === '') {
        $errors[] = 'Title is required.';
    }
    if ($content === '') {
        $errors[] = 'Content is required.';
    }

    if (!in_array($status, ['draft', 'published', 'scheduled'], true)) {
        $status = 'draft';
    }

    $upload = blog_handle_featured_upload($_FILES['featured_image'] ?? null);
    if ($upload['error']) {
        $errors[] = $upload['error'];
    }

    if (!empty($errors)) {
        adminCreate($errors, $_POST, null);
        return;
    }

    $slug = $slug === '' ? $title : $slug;
    $slug = blog_unique_slug($slug, BLOG_TABLE_POSTS);

    if ($excerpt === '') {
        $excerpt = blog_excerpt($content);
    }

    if ($status === 'published' && $publishedAt === '') {
        $publishedAt = date('Y-m-d H:i:s');
    }

    $safeTitle = blog_escape($title);
    $safeSlug = blog_escape($slug);
    $safeExcerpt = blog_escape($excerpt);
    $safeContent = blog_escape($content);
    $safeStatus = blog_escape($status);
    $safeImage = blog_escape($upload['path'] ?? '');
    $safeSeoTitle = blog_escape($seoTitle);
    $safeSeoDescription = blog_escape($seoDescription);
    $authorId = (int) ($Me->id() ?? 0);
    $publishedAtValue = $publishedAt === '' ? 'NULL' : "'" . blog_escape($publishedAt) . "'";
    $categoryValue = $categoryId > 0 ? $categoryId : 'NULL';

    $sql = "INSERT INTO `" . BLOG_TABLE_POSTS . "`
            (`title`, `slug`, `excerpt`, `content`, `status`, `featured_image`, `seo_title`, `seo_description`, `published_at`, `created_at`, `updated_at`, `author_id`, `category_id`)
            VALUES
            ('$safeTitle', '$safeSlug', '$safeExcerpt', '$safeContent', '$safeStatus', '$safeImage', '$safeSeoTitle', '$safeSeoDescription', $publishedAtValue, NOW(), NOW(), $authorId, $categoryValue)";

    if (!blog_db()->query($sql)) {
        $errors[] = 'Unable to create the post. Please try again.';
        adminCreate($errors, $_POST, null);
        return;
    }

    $postId = blog_db()->insert_id;
    $tagNames = blog_parse_tags($Url->post('tags'));
    $tagIds = blog_upsert_tags($tagNames);
    blog_set_post_tags($postId, $tagIds);

    Redirect("blog?action=admin-edit&id=$postId&saved=1");
}

function adminEdit($id, $errors = [], $notice = null)
{
    $post = blog_fetch_post_by_id($id);
    if (!$post) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }
    $categories = blog_get_categories();
    $tags = blog_get_tags();
    $postTags = blog_get_tags_for_post($post['id']);
    $postTagNames = implode(', ', array_column($postTags, 'name'));
    $values = [];
    include 'containers/blog/admin/editor.php';
}

function adminUpdate($id)
{
    global $Url;
    $post = blog_fetch_post_by_id($id);
    if (!$post) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }

    $errors = [];
    $title = trim((string) $Url->post('title'));
    $slug = trim((string) $Url->post('slug'));
    $content = trim((string) $Url->post('content'));
    $excerpt = trim((string) $Url->post('excerpt'));
    $status = $Url->post('status') ?: 'draft';
    $publishedAt = blog_normalize_datetime($Url->post('published_at'));
    $categoryId = (int) $Url->post('category_id');
    $seoTitle = trim((string) $Url->post('seo_title'));
    $seoDescription = trim((string) $Url->post('seo_description'));

    if ($title === '') {
        $errors[] = 'Title is required.';
    }
    if ($content === '') {
        $errors[] = 'Content is required.';
    }

    if (!in_array($status, ['draft', 'published', 'scheduled'], true)) {
        $status = 'draft';
    }

    $upload = blog_handle_featured_upload($_FILES['featured_image'] ?? null);
    if ($upload['error']) {
        $errors[] = $upload['error'];
    }

    if (!empty($errors)) {
        adminEdit($id, $errors, null);
        return;
    }

    $slug = $slug === '' ? $title : $slug;
    $slug = blog_unique_slug($slug, BLOG_TABLE_POSTS, $id);

    if ($excerpt === '') {
        $excerpt = blog_excerpt($content);
    }

    if ($status === 'published' && $publishedAt === '') {
        $publishedAt = date('Y-m-d H:i:s');
    }

    $safeTitle = blog_escape($title);
    $safeSlug = blog_escape($slug);
    $safeExcerpt = blog_escape($excerpt);
    $safeContent = blog_escape($content);
    $safeStatus = blog_escape($status);
    $safeSeoTitle = blog_escape($seoTitle);
    $safeSeoDescription = blog_escape($seoDescription);
    $publishedAtValue = $publishedAt === '' ? 'NULL' : "'" . blog_escape($publishedAt) . "'";
    $categoryValue = $categoryId > 0 ? $categoryId : 'NULL';

    $imageSql = '';
    if ($upload['path']) {
        $safeImage = blog_escape($upload['path']);
        $imageSql = ", featured_image = '$safeImage'";
    }

    $sql = "UPDATE `" . BLOG_TABLE_POSTS . "`
            SET title = '$safeTitle',
                slug = '$safeSlug',
                excerpt = '$safeExcerpt',
                content = '$safeContent',
                status = '$safeStatus',
                seo_title = '$safeSeoTitle',
                seo_description = '$safeSeoDescription',
                published_at = $publishedAtValue,
                updated_at = NOW(),
                category_id = $categoryValue
                $imageSql
            WHERE id = " . (int) $id;

    if (!blog_db()->query($sql)) {
        $errors[] = 'Unable to update the post. Please try again.';
        adminEdit($id, $errors, null);
        return;
    }

    $tagNames = blog_parse_tags($Url->post('tags'));
    $tagIds = blog_upsert_tags($tagNames);
    blog_set_post_tags($id, $tagIds);

    Redirect("blog?action=admin-edit&id=$id&saved=1");
}

function adminDelete($id)
{
    $post = blog_fetch_post_by_id($id);
    if (!$post) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = (int) $id;
        blog_db()->query("DELETE FROM `" . BLOG_TABLE_POST_TAGS . "` WHERE post_id = $id");
        blog_db()->query("DELETE FROM `" . BLOG_TABLE_POSTS . "` WHERE id = $id");
        Redirect('blog?action=admin-index&deleted=1');
        return;
    }
    include 'containers/blog/admin/delete.php';
}

function adminCategories()
{
    global $Url;
    $notice = null;
    $errors = [];
    $editCategory = null;

    if ($Url->get('delete') !== null) {
        $id = (int) $Url->get('delete');
        blog_db()->query("UPDATE `" . BLOG_TABLE_POSTS . "` SET category_id = NULL WHERE category_id = $id");
        blog_db()->query("DELETE FROM `" . BLOG_TABLE_CATEGORIES . "` WHERE id = $id");
        $notice = ['type' => 'success', 'message' => 'Category deleted.'];
    }

    if ($Url->get('edit') !== null) {
        $editCategory = blog_get_category_by_id((int) $Url->get('edit'));
    }

    if ($Url->post('save_category') !== null) {
        $name = trim((string) $Url->post('name'));
        $slug = trim((string) $Url->post('slug'));
        $categoryId = (int) $Url->post('category_id');
        if ($name === '') {
            $errors[] = 'Category name is required.';
        }
        if (empty($errors)) {
            $slug = $slug === '' ? $name : $slug;
            $slug = blog_unique_slug($slug, BLOG_TABLE_CATEGORIES, $categoryId ?: null);
            $safeName = blog_escape($name);
            $safeSlug = blog_escape($slug);
            if ($categoryId > 0) {
                $sql = "UPDATE `" . BLOG_TABLE_CATEGORIES . "` SET name = '$safeName', slug = '$safeSlug' WHERE id = $categoryId";
                blog_db()->query($sql);
                $notice = ['type' => 'success', 'message' => 'Category updated.'];
            } else {
                $sql = "INSERT INTO `" . BLOG_TABLE_CATEGORIES . "` (`name`, `slug`) VALUES ('$safeName', '$safeSlug')";
                blog_db()->query($sql);
                $notice = ['type' => 'success', 'message' => 'Category created.'];
            }
        }
    }

    $categories = blog_get_categories();
    include 'containers/blog/admin/categories.php';
}

function adminTags()
{
    global $Url;
    $notice = null;
    $errors = [];
    $editTag = null;

    if ($Url->get('delete') !== null) {
        $id = (int) $Url->get('delete');
        blog_db()->query("DELETE FROM `" . BLOG_TABLE_POST_TAGS . "` WHERE tag_id = $id");
        blog_db()->query("DELETE FROM `" . BLOG_TABLE_TAGS . "` WHERE id = $id");
        $notice = ['type' => 'success', 'message' => 'Tag deleted.'];
    }

    if ($Url->get('edit') !== null) {
        $editTag = blog_db()->query("SELECT * FROM `" . BLOG_TABLE_TAGS . "` WHERE id = " . (int) $Url->get('edit') . " LIMIT 1");
        $editTag = $editTag ? $editTag->fetch_assoc() : null;
    }

    if ($Url->post('save_tag') !== null) {
        $name = trim((string) $Url->post('name'));
        $slug = trim((string) $Url->post('slug'));
        $tagId = (int) $Url->post('tag_id');
        if ($name === '') {
            $errors[] = 'Tag name is required.';
        }
        if (empty($errors)) {
            $slug = $slug === '' ? $name : $slug;
            $slug = blog_unique_slug($slug, BLOG_TABLE_TAGS, $tagId ?: null);
            $safeName = blog_escape($name);
            $safeSlug = blog_escape($slug);
            if ($tagId > 0) {
                $sql = "UPDATE `" . BLOG_TABLE_TAGS . "` SET name = '$safeName', slug = '$safeSlug' WHERE id = $tagId";
                blog_db()->query($sql);
                $notice = ['type' => 'success', 'message' => 'Tag updated.'];
            } else {
                $sql = "INSERT INTO `" . BLOG_TABLE_TAGS . "` (`name`, `slug`) VALUES ('$safeName', '$safeSlug')";
                blog_db()->query($sql);
                $notice = ['type' => 'success', 'message' => 'Tag created.'];
            }
        }
    }

    $tags = blog_get_tags();
    include 'containers/blog/admin/tags.php';
}

function uploadFeaturedImage()
{
    $upload = blog_handle_featured_upload($_FILES['featured_image'] ?? null);
    header('Content-Type: application/json');
    if ($upload['error']) {
        echo json_encode(['success' => false, 'error' => $upload['error']]);
        return;
    }
    echo json_encode(['success' => true, 'path' => $upload['path']]);
}

class blogindex extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        listPosts();
    }
}

class blogpost extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        global $Url;
        $slug = (string) $Url->get('slug');
        if ($slug === '') {
            http_response_code(404);
            include 'containers/common/error.php';
            return;
        }
        viewPost($slug);
    }
}

class blogcategory extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        global $Url;
        $slug = $Url->get('slug');
        listByCategory($slug ?: null);
    }
}

class blogtag extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        global $Url;
        $slug = $Url->get('slug');
        listByTag($slug ?: null);
    }
}

class blogsearch extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        search();
    }
}

class blogadminindex extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        if (!blog_require_admin()) {
            return;
        }
        adminIndex();
    }
}

class blogadminnew extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        if (!blog_require_admin()) {
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            adminStore();
            return;
        }
        adminCreate();
    }
}

class blogadminedit extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        if (!blog_require_admin()) {
            return;
        }
        global $Url;
        $id = (int) $Url->get('id');
        if ($id <= 0) {
            http_response_code(404);
            include 'containers/common/error.php';
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            adminUpdate($id);
            return;
        }
        adminEdit($id);
    }
}

class blogadmindelete extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        if (!blog_require_admin()) {
            return;
        }
        global $Url;
        $id = (int) $Url->get('id');
        if ($id <= 0) {
            http_response_code(404);
            include 'containers/common/error.php';
            return;
        }
        adminDelete($id);
    }
}

class blogadmincategories extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        if (!blog_require_admin()) {
            return;
        }
        adminCategories();
    }
}

class blogadmintags extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        if (!blog_require_admin()) {
            return;
        }
        adminTags();
    }
}

class blogadminupload extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        if (!blog_require_admin()) {
            return;
        }
        uploadFeaturedImage();
    }
}
