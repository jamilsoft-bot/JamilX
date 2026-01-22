<?php

const FORUM_TABLE_CATEGORIES = 'forum_categories';
const FORUM_TABLE_TOPICS = 'forum_topics';
const FORUM_TABLE_POSTS = 'forum_posts';
const FORUM_TABLE_EDITS = 'forum_post_edits';

function forum_db()
{
    global $JX_db;
    return $JX_db;
}

function forum_escape($value)
{
    return forum_db()->real_escape_string((string) $value);
}

function forum_html($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function forum_render_text($value)
{
    return nl2br(forum_html($value));
}

function forum_slugify($text)
{
    $text = strtolower(trim((string) $text));
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    return trim($text, '-');
}

function forum_topic_slug_exists($slug)
{
    $slug = forum_escape($slug);
    $sql = "SELECT id FROM `" . FORUM_TABLE_TOPICS . "` WHERE slug = '$slug' LIMIT 1";
    $result = forum_db()->query($sql);
    return $result && $result->num_rows > 0;
}

function forum_unique_topic_slug($title)
{
    $slug = forum_slugify($title);
    if ($slug === '') {
        $slug = 'topic';
    }
    $base = $slug;
    $suffix = 1;
    while (forum_topic_slug_exists($slug)) {
        $slug = $base . '-' . $suffix;
        $suffix++;
    }
    return $slug;
}

function forum_require_login($resume = 'forum')
{
    if (!isset($_SESSION['uid'])) {
        Redirect('login&resume=' . $resume);
        return false;
    }
    return true;
}

function forum_is_moderator()
{
    global $Me;
    $role = strtolower((string) $Me->role());
    return in_array($role, ['admin', 'moderator'], true);
}

function forum_require_moderator()
{
    if (!forum_require_login('forum')) {
        return false;
    }
    if (!forum_is_moderator()) {
        http_response_code(403);
        $message = 'You are not authorized to manage forum content.';
        $linkback = 'dashboard';
        include('containers/admin/errorpage.php');
        return false;
    }
    return true;
}

function forum_csrf_token()
{
    if (!isset($_SESSION['forum_csrf'])) {
        $_SESSION['forum_csrf'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['forum_csrf'];
}

function forum_validate_csrf($token)
{
    return isset($_SESSION['forum_csrf']) && hash_equals($_SESSION['forum_csrf'], (string) $token);
}

function forum_rate_limit($key, $limit = 5, $seconds = 60)
{
    $now = time();
    if (!isset($_SESSION['forum_rate'])) {
        $_SESSION['forum_rate'] = [];
    }
    $bucket = $_SESSION['forum_rate'][$key] ?? [];
    $bucket = array_filter($bucket, function ($timestamp) use ($now, $seconds) {
        return ($now - $timestamp) < $seconds;
    });
    if (count($bucket) >= $limit) {
        $_SESSION['forum_rate'][$key] = $bucket;
        return false;
    }
    $bucket[] = $now;
    $_SESSION['forum_rate'][$key] = $bucket;
    return true;
}

function forum_categories()
{
    $sql = "SELECT * FROM `" . FORUM_TABLE_CATEGORIES . "` WHERE is_active = 1 ORDER BY position ASC, name ASC";
    $result = forum_db()->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function forum_all_categories()
{
    $sql = "SELECT * FROM `" . FORUM_TABLE_CATEGORIES . "` ORDER BY position ASC, name ASC";
    $result = forum_db()->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function forum_category_by_slug($slug)
{
    $slug = forum_escape($slug);
    $sql = "SELECT * FROM `" . FORUM_TABLE_CATEGORIES . "` WHERE slug = '$slug' LIMIT 1";
    $result = forum_db()->query($sql);
    return $result ? $result->fetch_assoc() : null;
}

function forum_create_category($data)
{
    $name = forum_escape($data['name'] ?? '');
    $slug = forum_escape($data['slug'] ?? forum_slugify($data['name'] ?? 'category'));
    $description = forum_escape($data['description'] ?? '');
    $position = (int) ($data['position'] ?? 0);
    $active = !empty($data['is_active']) ? 1 : 0;
    $sql = "INSERT INTO `" . FORUM_TABLE_CATEGORIES . "` (`name`, `slug`, `description`, `position`, `is_active`, `created_at`, `updated_at`)
            VALUES ('$name', '$slug', '$description', $position, $active, NOW(), NOW())";
    return forum_db()->query($sql);
}

function forum_update_category($id, $data)
{
    $id = (int) $id;
    $name = forum_escape($data['name'] ?? '');
    $slug = forum_escape($data['slug'] ?? forum_slugify($data['name'] ?? 'category'));
    $description = forum_escape($data['description'] ?? '');
    $position = (int) ($data['position'] ?? 0);
    $active = !empty($data['is_active']) ? 1 : 0;
    $sql = "UPDATE `" . FORUM_TABLE_CATEGORIES . "` SET `name` = '$name', `slug` = '$slug', `description` = '$description', `position` = $position, `is_active` = $active, `updated_at` = NOW() WHERE id = $id";
    return forum_db()->query($sql);
}

function forum_fetch_topics($categoryId, $page, $perPage, $search = null)
{
    $categoryId = (int) $categoryId;
    $page = max(1, (int) $page);
    $perPage = max(1, (int) $perPage);
    $offset = ($page - 1) * $perPage;
    $conditions = ["t.category_id = $categoryId", "t.deleted_at IS NULL"];
    if ($search) {
        $search = forum_escape($search);
        $conditions[] = "(t.title LIKE '%$search%' OR p.body LIKE '%$search%')";
    }
    $where = implode(' AND ', $conditions);
    $sql = "SELECT t.*, u.username, MAX(p.created_at) AS last_reply
            FROM `" . FORUM_TABLE_TOPICS . "` t
            LEFT JOIN `" . FORUM_TABLE_POSTS . "` p ON p.topic_id = t.id AND p.deleted_at IS NULL
            LEFT JOIN `users` u ON t.user_id = u.id
            WHERE $where
            GROUP BY t.id
            ORDER BY t.is_pinned DESC, COALESCE(t.last_post_at, t.created_at) DESC
            LIMIT $perPage OFFSET $offset";
    $result = forum_db()->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function forum_count_topics($categoryId, $search = null)
{
    $categoryId = (int) $categoryId;
    $conditions = ["category_id = $categoryId", "deleted_at IS NULL"];
    if ($search) {
        $search = forum_escape($search);
        $conditions[] = "title LIKE '%$search%'";
    }
    $where = implode(' AND ', $conditions);
    $sql = "SELECT COUNT(*) AS total FROM `" . FORUM_TABLE_TOPICS . "` WHERE $where";
    $result = forum_db()->query($sql);
    if ($result && ($row = $result->fetch_assoc())) {
        return (int) $row['total'];
    }
    return 0;
}

function forum_get_topic_by_slug($slug)
{
    $slug = forum_escape($slug);
    $sql = "SELECT t.*, c.name AS category_name, c.slug AS category_slug, u.username
            FROM `" . FORUM_TABLE_TOPICS . "` t
            LEFT JOIN `" . FORUM_TABLE_CATEGORIES . "` c ON t.category_id = c.id
            LEFT JOIN `users` u ON t.user_id = u.id
            WHERE t.slug = '$slug' AND t.deleted_at IS NULL
            LIMIT 1";
    $result = forum_db()->query($sql);
    return $result ? $result->fetch_assoc() : null;
}

function forum_topic_posts($topicId, $page, $perPage)
{
    $topicId = (int) $topicId;
    $page = max(1, (int) $page);
    $perPage = max(1, (int) $perPage);
    $offset = ($page - 1) * $perPage;
    $sql = "SELECT p.*, u.username
            FROM `" . FORUM_TABLE_POSTS . "` p
            LEFT JOIN `users` u ON p.user_id = u.id
            WHERE p.topic_id = $topicId AND p.deleted_at IS NULL
            ORDER BY p.created_at ASC
            LIMIT $perPage OFFSET $offset";
    $result = forum_db()->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function forum_count_posts($topicId)
{
    $topicId = (int) $topicId;
    $sql = "SELECT COUNT(*) AS total FROM `" . FORUM_TABLE_POSTS . "` WHERE topic_id = $topicId AND deleted_at IS NULL";
    $result = forum_db()->query($sql);
    if ($result && ($row = $result->fetch_assoc())) {
        return (int) $row['total'];
    }
    return 0;
}

function forum_create_topic($categoryId, $title, $body)
{
    global $Me;
    $db = forum_db();
    $db->begin_transaction();
    try {
        $categoryId = (int) $categoryId;
        $titleSafe = forum_escape($title);
        $slug = forum_escape(forum_unique_topic_slug($title));
        $bodySafe = forum_escape($body);
        $userId = (int) ($Me->id() ?? 0);

        $sql = "INSERT INTO `" . FORUM_TABLE_TOPICS . "` (`category_id`, `user_id`, `title`, `slug`, `is_locked`, `is_pinned`, `reply_count`, `last_post_at`, `created_at`, `updated_at`)
                VALUES ($categoryId, $userId, '$titleSafe', '$slug', 0, 0, 0, NOW(), NOW(), NOW())";
        if (!$db->query($sql)) {
            throw new RuntimeException($db->error);
        }
        $topicId = $db->insert_id;

        $postSql = "INSERT INTO `" . FORUM_TABLE_POSTS . "` (`topic_id`, `user_id`, `body`, `created_at`, `updated_at`)
                    VALUES ($topicId, $userId, '$bodySafe', NOW(), NOW())";
        if (!$db->query($postSql)) {
            throw new RuntimeException($db->error);
        }

        $db->commit();
        return ['id' => $topicId, 'slug' => $slug];
    } catch (Throwable $e) {
        $db->rollback();
        return null;
    }
}

function forum_add_reply($topicId, $body)
{
    global $Me;
    $db = forum_db();
    $db->begin_transaction();
    try {
        $topicId = (int) $topicId;
        $bodySafe = forum_escape($body);
        $userId = (int) ($Me->id() ?? 0);

        $postSql = "INSERT INTO `" . FORUM_TABLE_POSTS . "` (`topic_id`, `user_id`, `body`, `created_at`, `updated_at`)
                    VALUES ($topicId, $userId, '$bodySafe', NOW(), NOW())";
        if (!$db->query($postSql)) {
            throw new RuntimeException($db->error);
        }

        $db->query("UPDATE `" . FORUM_TABLE_TOPICS . "` SET `reply_count` = `reply_count` + 1, `last_post_at` = NOW(), `updated_at` = NOW() WHERE id = $topicId");
        $db->commit();
        return true;
    } catch (Throwable $e) {
        $db->rollback();
        return false;
    }
}

function forum_toggle_topic_flag($topicId, $field, $value)
{
    $topicId = (int) $topicId;
    $field = $field === 'is_locked' ? 'is_locked' : 'is_pinned';
    $value = $value ? 1 : 0;
    $sql = "UPDATE `" . FORUM_TABLE_TOPICS . "` SET `$field` = $value, `updated_at` = NOW() WHERE id = $topicId";
    return forum_db()->query($sql);
}

function forum_soft_delete_post($postId)
{
    $postId = (int) $postId;
    $sql = "UPDATE `" . FORUM_TABLE_POSTS . "` SET `deleted_at` = NOW() WHERE id = $postId";
    return forum_db()->query($sql);
}

function forum_restore_post($postId)
{
    $postId = (int) $postId;
    $sql = "UPDATE `" . FORUM_TABLE_POSTS . "` SET `deleted_at` = NULL WHERE id = $postId";
    return forum_db()->query($sql);
}

function forum_update_post($postId, $body)
{
    global $Me;
    $postId = (int) $postId;
    $bodySafe = forum_escape($body);
    $editorId = (int) ($Me->id() ?? 0);
    $existing = forum_db()->query("SELECT body FROM `" . FORUM_TABLE_POSTS . "` WHERE id = $postId LIMIT 1");
    $previous = $existing ? ($existing->fetch_assoc()['body'] ?? null) : null;
    if ($previous !== null) {
        $prevSafe = forum_escape($previous);
        forum_db()->query("INSERT INTO `" . FORUM_TABLE_EDITS . "` (`post_id`, `editor_id`, `previous_body`, `created_at`) VALUES ($postId, $editorId, '$prevSafe', NOW())");
    }
    $sql = "UPDATE `" . FORUM_TABLE_POSTS . "` SET `body` = '$bodySafe', `updated_at` = NOW() WHERE id = $postId";
    return forum_db()->query($sql);
}

function forum_search_topics($query, $page, $perPage)
{
    $query = trim((string) $query);
    if ($query === '') {
        return ['results' => [], 'total' => 0];
    }
    $search = forum_escape($query);
    $page = max(1, (int) $page);
    $perPage = max(1, (int) $perPage);
    $offset = ($page - 1) * $perPage;
    $sql = "SELECT t.*, c.name AS category_name, c.slug AS category_slug
            FROM `" . FORUM_TABLE_TOPICS . "` t
            LEFT JOIN `" . FORUM_TABLE_CATEGORIES . "` c ON t.category_id = c.id
            WHERE t.deleted_at IS NULL AND (t.title LIKE '%$search%' OR t.id IN (SELECT topic_id FROM `" . FORUM_TABLE_POSTS . "` WHERE body LIKE '%$search%'))
            ORDER BY t.created_at DESC
            LIMIT $perPage OFFSET $offset";
    $result = forum_db()->query($sql);
    $rows = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    $countResult = forum_db()->query("SELECT COUNT(*) AS total FROM `" . FORUM_TABLE_TOPICS . "` WHERE deleted_at IS NULL AND title LIKE '%$search%'");
    $total = 0;
    if ($countResult && ($row = $countResult->fetch_assoc())) {
        $total = (int) $row['total'];
    }
    return ['results' => $rows, 'total' => $total];
}
