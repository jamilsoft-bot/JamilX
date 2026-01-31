<?php

function forum_index()
{
    $categories = forum_categories();
    include 'containers/forum/index.php';
}

function forum_category($slug)
{
    global $Url;
    $category = forum_category_by_slug($slug);
    if (!$category) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }
    $page = max(1, (int) $Url->get('page'));
    $perPage = 10;
    $search = trim((string) $Url->get('q'));
    $topics = forum_fetch_topics($category['id'], $page, $perPage, $search !== '' ? $search : null);
    $total = forum_count_topics($category['id'], $search !== '' ? $search : null);
    $pagination = [
        'page' => $page,
        'total_pages' => max(1, (int) ceil($total / $perPage)),
    ];
    include 'containers/forum/category.php';
}

function forum_topic($slug)
{
    global $Url;
    $topic = forum_get_topic_by_slug($slug);
    if (!$topic) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }
    $page = max(1, (int) $Url->get('page'));
    $perPage = 15;
    $posts = forum_topic_posts($topic['id'], $page, $perPage);
    $total = forum_count_posts($topic['id']);
    $pagination = [
        'page' => $page,
        'total_pages' => max(1, (int) ceil($total / $perPage)),
    ];
    $csrf = forum_csrf_token();
    include 'containers/forum/topic.php';
}

function forum_new_topic($slug)
{
    if (!forum_require_login('forum')) {
        return;
    }
    $category = forum_category_by_slug($slug);
    if (!$category) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }
    $csrf = forum_csrf_token();
    include 'containers/forum/new_topic.php';
}

function forum_store_topic($slug)
{
    global $Url;
    if (!forum_require_login('forum')) {
        return;
    }
    $category = forum_category_by_slug($slug);
    if (!$category) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }
    $errors = [];
    if (!forum_validate_csrf($Url->post('csrf_token'))) {
        $errors[] = 'Invalid form token.';
    }
    $title = trim((string) $Url->post('title'));
    $body = trim((string) $Url->post('body'));

    if ($title === '') {
        $errors[] = 'Title is required.';
    }
    if ($body === '') {
        $errors[] = 'Post body is required.';
    }
    if (!forum_rate_limit('topic', 3, 60)) {
        $errors[] = 'You are posting too quickly. Please wait a moment.';
    }

    if (!empty($errors)) {
        $csrf = forum_csrf_token();
        include 'containers/forum/new_topic.php';
        return;
    }

    $topicResult = forum_create_topic($category['id'], $title, $body);
    if (!$topicResult) {
        $errors[] = 'Unable to create topic.';
        $csrf = forum_csrf_token();
        include 'containers/forum/new_topic.php';
        return;
    }

    Redirect('forum?action=topic&slug=' . urlencode($topicResult['slug']));
}

function forum_reply($slug)
{
    global $Url;
    if (!forum_require_login('forum')) {
        return;
    }
    $topic = forum_get_topic_by_slug($slug);
    if (!$topic) {
        http_response_code(404);
        include 'containers/common/error.php';
        return;
    }
    if (!empty($topic['is_locked'])) {
        http_response_code(403);
        include 'containers/admin/errorpage.php';
        return;
    }
    $errors = [];
    if (!forum_validate_csrf($Url->post('csrf_token'))) {
        $errors[] = 'Invalid form token.';
    }
    $body = trim((string) $Url->post('body'));
    if ($body === '') {
        $errors[] = 'Reply cannot be empty.';
    }
    if (!forum_rate_limit('reply', 5, 60)) {
        $errors[] = 'You are posting too quickly. Please wait a moment.';
    }
    if (!empty($errors)) {
        $page = 1;
        $perPage = 15;
        $posts = forum_topic_posts($topic['id'], $page, $perPage);
        $total = forum_count_posts($topic['id']);
        $pagination = [
            'page' => $page,
            'total_pages' => max(1, (int) ceil($total / $perPage)),
        ];
        $csrf = forum_csrf_token();
        include 'containers/forum/topic.php';
        return;
    }

    forum_add_reply($topic['id'], $body);
    Redirect('forum?action=topic&slug=' . urlencode($topic['slug']));
}

function forum_search()
{
    global $Url;
    $query = trim((string) $Url->get('q'));
    $page = max(1, (int) $Url->get('page'));
    $perPage = 10;
    $result = forum_search_topics($query, $page, $perPage);
    $topics = $result['results'];
    $total = $result['total'];
    $pagination = [
        'page' => $page,
        'total_pages' => max(1, (int) ceil(($total ?: 1) / $perPage)),
    ];
    include 'containers/forum/search.php';
}

function forum_admin_categories()
{
    if (!forum_require_moderator()) {
        return;
    }
    $categories = forum_all_categories();
    $csrf = forum_csrf_token();
    include 'containers/forum/admin/categories.php';
}

function forum_admin_save_category($id = null)
{
    global $Url;
    if (!forum_require_moderator()) {
        return;
    }
    if (!forum_validate_csrf($Url->post('csrf_token'))) {
        http_response_code(403);
        include 'containers/common/error.php';
        return;
    }
    $data = [
        'name' => trim((string) $Url->post('name')),
        'slug' => trim((string) $Url->post('slug')),
        'description' => trim((string) $Url->post('description')),
        'position' => (int) $Url->post('position'),
        'is_active' => $Url->post('is_active') ? 1 : 0,
    ];
    if ($id) {
        forum_update_category($id, $data);
    } else {
        forum_create_category($data);
    }
    Redirect('forum?action=admin-categories');
}

function forum_admin_toggle_topic($topicId, $field)
{
    global $Url;
    if (!forum_require_moderator()) {
        return;
    }
    if (!forum_validate_csrf($Url->post('csrf_token'))) {
        http_response_code(403);
        include 'containers/common/error.php';
        return;
    }
    $value = (int) $Url->post('value');
    forum_toggle_topic_flag($topicId, $field, $value === 1);
    Redirect('forum?action=topic&slug=' . urlencode(forum_slugify((string) $Url->post('slug'))));
}

function forum_admin_delete_post($postId, $slug)
{
    global $Url;
    if (!forum_require_moderator()) {
        return;
    }
    if (!forum_validate_csrf($Url->post('csrf_token'))) {
        http_response_code(403);
        include 'containers/common/error.php';
        return;
    }
    forum_soft_delete_post($postId);
    Redirect('forum?action=topic&slug=' . urlencode($slug));
}

function forum_admin_restore_post($postId, $slug)
{
    global $Url;
    if (!forum_require_moderator()) {
        return;
    }
    if (!forum_validate_csrf($Url->post('csrf_token'))) {
        http_response_code(403);
        include 'containers/common/error.php';
        return;
    }
    forum_restore_post($postId);
    Redirect('forum?action=topic&slug=' . urlencode($slug));
}

class forumhome extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        forum_index();
    }
}

class forumcategory extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        global $Url;
        forum_category((string) $Url->get('slug'));
    }
}

class forumtopic extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        global $Url;
        forum_topic((string) $Url->get('slug'));
    }
}

class forumnewtopic extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        global $Url;
        $slug = (string) $Url->get('slug');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            forum_store_topic($slug);
            return;
        }
        forum_new_topic($slug);
    }
}

class forumreply extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        global $Url;
        $slug = (string) $Url->get('slug');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            forum_reply($slug);
            return;
        }
        http_response_code(405);
    }
}

class forumsearch extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        forum_search();
    }
}

class forummoderatelock extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        global $Url;
        forum_admin_toggle_topic((int) $Url->get('id'), 'is_locked');
    }
}

class forummoderatepin extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        global $Url;
        forum_admin_toggle_topic((int) $Url->get('id'), 'is_pinned');
    }
}

class forumpostdelete extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        global $Url;
        forum_admin_delete_post((int) $Url->get('id'), (string) $Url->get('slug'));
    }
}

class forumpostrestore extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        global $Url;
        forum_admin_restore_post((int) $Url->get('id'), (string) $Url->get('slug'));
    }
}

class forumadmincategories extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        forum_admin_categories();
    }
}

class forumadmincategoriessave extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        global $Url;
        $id = (int) $Url->get('id');
        forum_admin_save_category($id ?: null);
    }
}
