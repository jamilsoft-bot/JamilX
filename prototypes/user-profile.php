<?php

class JX_UserProfileP extends JX_Prototype implements JX_PrototypeI
{
    public function __construct()
    {
        parent::__construct('user_profiles');
    }

    public function createTable($fields)
    {
        return parent::createTable($fields);
    }

    public function delete($id)
    {
        return parent::delete($id);
    }

    public function read($id)
    {
        return parent::read($id);
    }

    public function insert($fields, $values)
    {
        return parent::insert($fields, $values);
    }

    public function getByUserId($userId)
    {
        global $JX_db;
        $userId = (int) $userId;

        if ($userId <= 0) {
            return null;
        }

        $sql = "SELECT * FROM `user_profiles` WHERE `user_id` = $userId LIMIT 1";
        $result = $JX_db->query($sql);

        if (!$result) {
            return null;
        }

        foreach ($result as $row) {
            return $row;
        }

        return null;
    }

    public function upsert($userId, array $data)
    {
        global $JX_db;
        $userId = (int) $userId;

        if ($userId <= 0) {
            return false;
        }

        $fields = [
            'display_name' => $data['display_name'] ?? null,
            'headline' => $data['headline'] ?? null,
            'bio' => $data['bio'] ?? null,
            'website' => $data['website'] ?? null,
            'location' => $data['location'] ?? null,
            'timezone' => $data['timezone'] ?? null,
            'pronouns' => $data['pronouns'] ?? null,
            'skills' => $data['skills'] ?? null,
            'social_links' => $data['social_links'] ?? null,
            'preferences' => $data['preferences'] ?? null,
        ];

        $columns = ['user_id'];
        $values = [$userId];

        foreach ($fields as $key => $value) {
            $columns[] = $key;
            if ($value === null || $value === '') {
                $values[] = 'NULL';
            } else {
                $values[] = "'" . $JX_db->real_escape_string($value) . "'";
            }
        }

        $columns[] = 'created_at';
        $columns[] = 'updated_at';
        $values[] = 'NOW()';
        $values[] = 'NOW()';

        $updateAssignments = [];
        foreach (array_keys($fields) as $key) {
            $updateAssignments[] = "`$key` = VALUES(`$key`)";
        }
        $updateAssignments[] = '`updated_at` = NOW()';

        $sql = "INSERT INTO `user_profiles` (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $values) . ") "
            . "ON DUPLICATE KEY UPDATE " . implode(', ', $updateAssignments);

        return $JX_db->query($sql);
    }

    public function decodeJson($value)
    {
        if ($value === null || $value === '') {
            return [];
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : [];
    }

    public function encodeJson($value)
    {
        return json_encode($value);
    }

    public function normalizeList($items)
    {
        if (is_string($items)) {
            $items = explode(',', $items);
        }

        if (!is_array($items)) {
            return [];
        }

        $normalized = [];
        foreach ($items as $item) {
            $trimmed = trim((string) $item);
            if ($trimmed !== '') {
                $normalized[] = $trimmed;
            }
        }

        return array_values(array_unique($normalized));
    }

    public function encodeList($items)
    {
        return json_encode($this->normalizeList($items));
    }
}
