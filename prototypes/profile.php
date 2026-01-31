<?php

class JX_ProfileP extends JX_Prototype implements JX_PrototypeI
{
    private $db;

    public function __construct()
    {
        parent::__construct('users');
        global $JX_db;
        $this->db = $JX_db;
    }

    private function escape(?string $value): string
    {
        return $this->db->real_escape_string($value ?? '');
    }

    public function getUserById(int $id): ?array
    {
        $id = (int) $id;
        $result = $this->db->query("SELECT * FROM `users` WHERE id=$id LIMIT 1");
        if (!$result) {
            return null;
        }

        foreach ($result as $row) {
            return $row;
        }

        return null;
    }

    public function updateProfile(int $id, array $data): bool
    {
        $id = (int) $id;
        $fields = [];

        $map = [
            'username' => 'username',
            'email' => 'email',
            'phone' => 'phone',
            'name' => 'name',
            'bio' => 'bio',
            'address' => 'address',
            'city' => 'city',
            'state' => 'state',
            'country' => 'country',
            'dob' => 'dob',
            'gender' => 'gender',
        ];

        foreach ($map as $key => $column) {
            if (array_key_exists($key, $data)) {
                $value = $this->escape((string) $data[$key]);
                $fields[] = "`$column`='$value'";
            }
        }

        if (!empty($data['password'])) {
            $password = $this->escape((string) $data['password']);
            $fields[] = "`password`='$password'";
        }

        if ($fields === []) {
            return false;
        }

        $sql = "UPDATE `users` SET " . implode(', ', $fields) . ", `date_updated`=NOW() WHERE id=$id";
        return (bool) $this->db->query($sql);
    }

    public function getUserExperiences(int $userId): array
    {
        $userId = (int) $userId;
        $rows = [];
        $result = $this->db->query("SELECT * FROM `user_experiences` WHERE user_id=$userId ORDER BY start_date DESC");
        if (!$result) {
            return $rows;
        }

        foreach ($result as $row) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function addExperience(int $userId, array $data): bool
    {
        $userId = (int) $userId;
        $title = $this->escape($data['title'] ?? '');
        $company = $this->escape($data['company_name'] ?? '');
        $location = $this->escape($data['location'] ?? '');
        $start = $this->escape($data['start_date'] ?? '');
        $end = $this->escape($data['end_date'] ?? '');
        $description = $this->escape($data['description'] ?? '');
        $isCurrent = !empty($data['is_current']) ? 1 : 0;

        if ($title === '' || $company === '' || $start === '') {
            return false;
        }

        $sql = "INSERT INTO `user_experiences` (`user_id`, `title`, `company_name`, `location`, `start_date`, `end_date`, `is_current`, `description`, `created_at`, `updated_at`)
                VALUES ($userId, '$title', '$company', '$location', '$start', " . ($end !== '' ? "'$end'" : 'NULL') . ", $isCurrent, '$description', NOW(), NOW())";

        return (bool) $this->db->query($sql);
    }
}
