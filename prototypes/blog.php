<?php

const BLOG_TABLE_POSTS = 'blog_posts';
const BLOG_TABLE_CATEGORIES = 'blog_categories';
const BLOG_TABLE_TAGS = 'blog_tags';
const BLOG_TABLE_POST_TAGS = 'blog_post_tags';
const BLOG_TABLE_SUBSCRIBERS = 'blog_subscribers';

function blog_db()
{
    global $JX_db;
    return $JX_db;
}

function blog_escape($value)
{
    return blog_db()->real_escape_string($value);
}

function blog_html($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function blog_slugify($text)
{
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    return trim($text, '-');
}

function blog_excerpt($content, $length = 160)
{
    $plain = trim(strip_tags($content));
    if (mb_strlen($plain) <= $length) {
        return $plain;
    }
    return mb_substr($plain, 0, $length) . '...';
}

function blog_unique_slug($slug, $table, $ignoreId = null)
{
    $slug = blog_slugify($slug);
    if ($slug === '') {
        $slug = 'post';
    }

    $base = $slug;
    $suffix = 1;
    while (blog_slug_exists($slug, $table, $ignoreId)) {
        $slug = $base . '-' . $suffix;
        $suffix++;
    }

    return $slug;
}

function blog_slug_exists($slug, $table, $ignoreId = null)
{
    $slug = blog_escape($slug);
    $sql = "SELECT id FROM `$table` WHERE `slug` = '$slug'";
    if ($ignoreId !== null) {
        $ignoreId = (int) $ignoreId;
        $sql .= " AND id != $ignoreId";
    }
    $sql .= ' LIMIT 1';
    $result = blog_db()->query($sql);
    return $result && $result->num_rows > 0;
}

function blog_page_url($base, array $params = [])
{
    $query = http_build_query(array_filter($params, function ($value) {
        return $value !== null && $value !== '';
    }));
    if ($query === '') {
        return $base;
    }
    return $base . '?' . $query;
}

function blog_get_categories()
{
    $sql = "SELECT * FROM `" . BLOG_TABLE_CATEGORIES . "` ORDER BY name ASC";
    $result = blog_db()->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function blog_get_category_by_slug($slug)
{
    $slug = blog_escape($slug);
    $sql = "SELECT * FROM `" . BLOG_TABLE_CATEGORIES . "` WHERE slug = '$slug' LIMIT 1";
    $result = blog_db()->query($sql);
    return $result ? $result->fetch_assoc() : null;
}

function blog_get_category_by_id($id)
{
    $id = (int) $id;
    $sql = "SELECT * FROM `" . BLOG_TABLE_CATEGORIES . "` WHERE id = $id LIMIT 1";
    $result = blog_db()->query($sql);
    return $result ? $result->fetch_assoc() : null;
}

function blog_get_tags()
{
    $sql = "SELECT * FROM `" . BLOG_TABLE_TAGS . "` ORDER BY name ASC";
    $result = blog_db()->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function blog_get_tag_by_slug($slug)
{
    $slug = blog_escape($slug);
    $sql = "SELECT * FROM `" . BLOG_TABLE_TAGS . "` WHERE slug = '$slug' LIMIT 1";
    $result = blog_db()->query($sql);
    return $result ? $result->fetch_assoc() : null;
}

function blog_fetch_posts($limit, $offset, $filters = [])
{
    $statusSql = "(p.status = 'published' OR p.status = 'scheduled') AND (p.published_at IS NULL OR p.published_at <= NOW())";
    $where = [$statusSql];

    if (!empty($filters['category_id'])) {
        $categoryId = (int) $filters['category_id'];
        $where[] = "p.category_id = $categoryId";
    }

    if (!empty($filters['search'])) {
        $search = blog_escape($filters['search']);
        $where[] = "(p.title LIKE '%$search%' OR p.content LIKE '%$search%')";
    }

    if (!empty($filters['tag_id'])) {
        $tagId = (int) $filters['tag_id'];
        $where[] = "p.id IN (SELECT post_id FROM `" . BLOG_TABLE_POST_TAGS . "` WHERE tag_id = $tagId)";
    }

    $whereSql = implode(' AND ', $where);
    $limit = (int) $limit;
    $offset = (int) $offset;

    $sql = "SELECT p.*, c.name AS category_name, c.slug AS category_slug
            FROM `" . BLOG_TABLE_POSTS . "` p
            LEFT JOIN `" . BLOG_TABLE_CATEGORIES . "` c ON p.category_id = c.id
            WHERE $whereSql
            ORDER BY COALESCE(p.published_at, p.created_at) DESC
            LIMIT $limit OFFSET $offset";
    $result = blog_db()->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function blog_count_posts($filters = [])
{
    $statusSql = "(status = 'published' OR status = 'scheduled') AND (published_at IS NULL OR published_at <= NOW())";
    $where = [$statusSql];

    if (!empty($filters['category_id'])) {
        $categoryId = (int) $filters['category_id'];
        $where[] = "category_id = $categoryId";
    }

    if (!empty($filters['search'])) {
        $search = blog_escape($filters['search']);
        $where[] = "(title LIKE '%$search%' OR content LIKE '%$search%')";
    }

    if (!empty($filters['tag_id'])) {
        $tagId = (int) $filters['tag_id'];
        $where[] = "id IN (SELECT post_id FROM `" . BLOG_TABLE_POST_TAGS . "` WHERE tag_id = $tagId)";
    }

    $whereSql = implode(' AND ', $where);
    $sql = "SELECT COUNT(*) AS total FROM `" . BLOG_TABLE_POSTS . "` WHERE $whereSql";
    $result = blog_db()->query($sql);
    if ($result && ($row = $result->fetch_assoc())) {
        return (int) $row['total'];
    }
    return 0;
}

function blog_fetch_post_by_slug($slug)
{
    $slug = blog_escape($slug);
    $sql = "SELECT p.*, c.name AS category_name, c.slug AS category_slug
            FROM `" . BLOG_TABLE_POSTS . "` p
            LEFT JOIN `" . BLOG_TABLE_CATEGORIES . "` c ON p.category_id = c.id
            WHERE p.slug = '$slug'
            LIMIT 1";
    $result = blog_db()->query($sql);
    return $result ? $result->fetch_assoc() : null;
}

function blog_fetch_post_by_id($id)
{
    $id = (int) $id;
    $sql = "SELECT * FROM `" . BLOG_TABLE_POSTS . "` WHERE id = $id LIMIT 1";
    $result = blog_db()->query($sql);
    return $result ? $result->fetch_assoc() : null;
}

function blog_fetch_posts_admin($limit, $offset)
{
    $limit = (int) $limit;
    $offset = (int) $offset;
    $sql = "SELECT p.*, c.name AS category_name
            FROM `" . BLOG_TABLE_POSTS . "` p
            LEFT JOIN `" . BLOG_TABLE_CATEGORIES . "` c ON p.category_id = c.id
            ORDER BY p.updated_at DESC
            LIMIT $limit OFFSET $offset";
    $result = blog_db()->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function blog_count_posts_admin()
{
    $sql = "SELECT COUNT(*) AS total FROM `" . BLOG_TABLE_POSTS . "`";
    $result = blog_db()->query($sql);
    if ($result && ($row = $result->fetch_assoc())) {
        return (int) $row['total'];
    }
    return 0;
}

function blog_get_tags_for_posts(array $postIds)
{
    if (empty($postIds)) {
        return [];
    }
    $ids = implode(',', array_map('intval', $postIds));
    $sql = "SELECT pt.post_id, t.id, t.name, t.slug
            FROM `" . BLOG_TABLE_POST_TAGS . "` pt
            INNER JOIN `" . BLOG_TABLE_TAGS . "` t ON pt.tag_id = t.id
            WHERE pt.post_id IN ($ids)
            ORDER BY t.name ASC";
    $result = blog_db()->query($sql);
    if (!$result) {
        return [];
    }

    $map = [];
    foreach ($result as $row) {
        $map[$row['post_id']][] = $row;
    }
    return $map;
}

function blog_get_tags_for_post($postId)
{
    $map = blog_get_tags_for_posts([(int) $postId]);
    return $map[$postId] ?? [];
}

function blog_upsert_tags(array $names)
{
    $ids = [];
    foreach ($names as $name) {
        $name = trim($name);
        if ($name === '') {
            continue;
        }
        $slug = blog_unique_slug($name, BLOG_TABLE_TAGS);
        $safeName = blog_escape($name);
        $safeSlug = blog_escape($slug);
        $sql = "SELECT id FROM `" . BLOG_TABLE_TAGS . "` WHERE slug = '$safeSlug' LIMIT 1";
        $result = blog_db()->query($sql);
        if ($result && ($row = $result->fetch_assoc())) {
            $ids[] = (int) $row['id'];
            continue;
        }
        $insert = "INSERT INTO `" . BLOG_TABLE_TAGS . "` (`name`, `slug`) VALUES ('$safeName', '$safeSlug')";
        if (blog_db()->query($insert)) {
            $ids[] = (int) blog_db()->insert_id;
        }
    }
    return array_values(array_unique($ids));
}

function blog_set_post_tags($postId, array $tagIds)
{
    $postId = (int) $postId;
    blog_db()->query("DELETE FROM `" . BLOG_TABLE_POST_TAGS . "` WHERE post_id = $postId");
    foreach ($tagIds as $tagId) {
        $tagId = (int) $tagId;
        if ($tagId <= 0) {
            continue;
        }
        $sql = "INSERT INTO `" . BLOG_TABLE_POST_TAGS . "` (`post_id`, `tag_id`) VALUES ($postId, $tagId)";
        blog_db()->query($sql);
    }
}

function blog_parse_tags($input)
{
    $parts = array_filter(array_map('trim', explode(',', (string) $input)));
    return array_values(array_unique($parts));
}

function blog_handle_featured_upload($file)
{
    if (!isset($file) || !is_array($file) || ($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return ['path' => null, 'error' => null];
    }

    if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
        return ['path' => null, 'error' => 'Unable to upload featured image.'];
    }

    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed, true)) {
        return ['path' => null, 'error' => 'Invalid image format.'];
    }

    if (($file['size'] ?? 0) > 2 * 1024 * 1024) {
        return ['path' => null, 'error' => 'Image exceeds the 2MB size limit.'];
    }

    $check = getimagesize($file['tmp_name']);
    if ($check === false) {
        return ['path' => null, 'error' => 'Uploaded file is not a valid image.'];
    }

    $directory = __DIR__ . '/../data/blog';
    if (!is_dir($directory)) {
        mkdir($directory, 0775, true);
    }

    $filename = uniqid('blog_', true) . '.' . $ext;
    $destination = $directory . '/' . $filename;
    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        return ['path' => null, 'error' => 'Unable to save the uploaded image.'];
    }

    return ['path' => 'data/blog/' . $filename, 'error' => null];
}

function blog_require_admin()
{
    global $Me;
    if (!isset($_SESSION['uid'])) {
        Redirect('login&resume=blog');
        return false;
    }
    if ($Me->role() !== 'admin') {
        http_response_code(403);
        $message = "You are not authorized to manage the blog. Please visit the <a href='dashboard'>Dashboard</a>.";
        $linkback = 'dashboard';
        include('containers/admin/errorpage.php');
        return false;
    }
    return true;
}

function blog_get_related_posts($postId, $categoryId, array $tagIds, $limit = 3)
{
    $postId = (int) $postId;
    $limit = (int) $limit;
    $conditions = [];
    if ($categoryId) {
        $categoryId = (int) $categoryId;
        $conditions[] = "p.category_id = $categoryId";
    }
    if (!empty($tagIds)) {
        $tagIds = implode(',', array_map('intval', $tagIds));
        $conditions[] = "p.id IN (SELECT post_id FROM `" . BLOG_TABLE_POST_TAGS . "` WHERE tag_id IN ($tagIds))";
    }
    if (empty($conditions)) {
        return [];
    }
    $where = implode(' OR ', $conditions);
    $sql = "SELECT p.*, c.name AS category_name, c.slug AS category_slug
            FROM `" . BLOG_TABLE_POSTS . "` p
            LEFT JOIN `" . BLOG_TABLE_CATEGORIES . "` c ON p.category_id = c.id
            WHERE p.id != $postId
              AND ($where)
              AND (p.status = 'published' OR p.status = 'scheduled')
              AND (p.published_at IS NULL OR p.published_at <= NOW())
            ORDER BY COALESCE(p.published_at, p.created_at) DESC
            LIMIT $limit";
    $result = blog_db()->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function blog_store_subscriber($email)
{
    $email = strtolower(trim($email));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['success' => false, 'message' => 'Please provide a valid email address.'];
    }
    $safeEmail = blog_escape($email);
    $check = blog_db()->query("SELECT id FROM `" . BLOG_TABLE_SUBSCRIBERS . "` WHERE email = '$safeEmail' LIMIT 1");
    if ($check && $check->num_rows > 0) {
        return ['success' => true, 'message' => 'You are already subscribed.'];
    }
    $sql = "INSERT INTO `" . BLOG_TABLE_SUBSCRIBERS . "` (`email`, `created_at`) VALUES ('$safeEmail', NOW())";
    if (blog_db()->query($sql)) {
        return ['success' => true, 'message' => 'Thanks for subscribing!'];
    }
    return ['success' => false, 'message' => 'Unable to save your subscription right now.'];
}

function blog_normalize_datetime($value)
{
    $value = trim((string) $value);
    if ($value === '') {
        return '';
    }
    $timestamp = strtotime($value);
    if ($timestamp === false) {
        return '';
    }
    return date('Y-m-d H:i:s', $timestamp);
}
