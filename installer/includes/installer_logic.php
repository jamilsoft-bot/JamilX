<?php
// Installer logic that mirrors the legacy installer behavior while keeping UI separate.

declare(strict_types=1);

/**
 * Build the database configuration file in the application root.
 */
function installer_write_config(string $appRoot, array $dbConfig): string
{
    $dbname = $dbConfig['dbname'] ?? '';
    $dbhost = $dbConfig['dbhost'] ?? '';
    $dbpass = $dbConfig['dbpass'] ?? '';
    $dbuser = $dbConfig['dbuser'] ?? '';
    $dbport = $dbConfig['dbport'] ?? '';

    $dbportLine = $dbport !== '' ? "    \"DB_Port\" => \"{$dbport}\",\n\n" : '';

    $output = <<<END
<?php
\$INDEX = "about";
\$CONF_DIR = "system/configs";
\$CONF_APPS_DIR = "Apps/";
\$CONF_SETTING = "system/configs/setting.json";
\$CONF_SERVICE_DIR = "services/";

\$DB_Data = [
    "DB_Host" => "{$dbhost}",
    "DB_User" => "{$dbuser}",
    "DB_Pass" => "{$dbpass}",
    "DB_Name" => "{$dbname}",
{$dbportLine}];
END;

    $configPath = $appRoot . '/conf.php';

    if (!file_put_contents($configPath, $output)) {
        return 'Unable to write configuration file.';
    }

    return 'Database information saved successfully.';
}

/**
 * Validate database form inputs.
 */
function installer_validate_db(array $data): array
{
    $errors = [];
    $required = ['dbhost', 'dbname', 'dbuser'];

    foreach ($required as $field) {
        if (empty(trim((string) ($data[$field] ?? '')))) {
            $errors[] = ucfirst($field) . ' is required.';
        }
    }

    return $errors;
}

/**
 * Validate company info inputs.
 */
function installer_validate_company(array $data): array
{
    $errors = [];
    $required = ['name', 'summary', 'industry', 'country', 'city', 'street', 'website', 'email', 'phone'];

    foreach ($required as $field) {
        if (empty(trim((string) ($data[$field] ?? '')))) {
            $errors[] = ucfirst($field) . ' is required.';
        }
    }

    if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Company email must be valid.';
    }

    return $errors;
}

/**
 * Validate admin account inputs.
 */
function installer_validate_admin(array $data): array
{
    $errors = [];
    $required = ['name', 'username', 'password', 'email'];

    foreach ($required as $field) {
        if (empty(trim((string) ($data[$field] ?? '')))) {
            $errors[] = ucfirst($field) . ' is required.';
        }
    }

    if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Admin email must be valid.';
    }

    return $errors;
}

/**
 * Run SQL installation using the provided configuration.
 */
function installer_run_sql(string $sqlPath, array $dbData): array
{
    $message = 'Database tables created successfully.';
    $errors = [];

    $dbPort = isset($dbData['DB_Port']) && $dbData['DB_Port'] !== '' ? (int) $dbData['DB_Port'] : null;

    $mysqli = $dbPort
        ? new mysqli($dbData['DB_Host'], $dbData['DB_User'], $dbData['DB_Pass'], $dbData['DB_Name'], $dbPort)
        : new mysqli($dbData['DB_Host'], $dbData['DB_User'], $dbData['DB_Pass'], $dbData['DB_Name']);

    if ($mysqli->connect_error) {
        return [
            'message' => 'Unable to connect to the database.',
            'errors' => [$mysqli->connect_error],
        ];
    }

    $input = file_get_contents($sqlPath);

    if ($input === false) {
        return [
            'message' => 'Unable to read SQL installer file.',
            'errors' => ['Missing installer SQL file.'],
        ];
    }

    if (!$mysqli->multi_query($input)) {
        $errors[] = $mysqli->error;
        $message = 'Database installation failed.';
    }

    return [
        'message' => $message,
        'errors' => $errors,
    ];
}

/**
 * Save company info to options table (mirrors legacy installer behavior).
 */
function installer_save_company(array $data, array $dbData): array
{
    $dbPort = isset($dbData['DB_Port']) && $dbData['DB_Port'] !== '' ? (int) $dbData['DB_Port'] : null;

    $mysqli = $dbPort
        ? new mysqli($dbData['DB_Host'], $dbData['DB_User'], $dbData['DB_Pass'], $dbData['DB_Name'], $dbPort)
        : new mysqli($dbData['DB_Host'], $dbData['DB_User'], $dbData['DB_Pass'], $dbData['DB_Name']);

    if ($mysqli->connect_error) {
        return ['Unable to connect to the database.'];
    }

    $payload = json_encode($data, JSON_UNESCAPED_UNICODE);

    $statement = $mysqli->prepare("INSERT INTO `options`(`name`, `value`) VALUES ('cprofile', ?)");
    if (!$statement) {
        return [$mysqli->error];
    }

    $statement->bind_param('s', $payload);

    if (!$statement->execute()) {
        return [$statement->error];
    }

    return [];
}

/**
 * Save admin account to users table (mirrors legacy installer behavior).
 */
function installer_save_admin(array $data, array $dbData): array
{
    $dbPort = isset($dbData['DB_Port']) && $dbData['DB_Port'] !== '' ? (int) $dbData['DB_Port'] : null;

    $mysqli = $dbPort
        ? new mysqli($dbData['DB_Host'], $dbData['DB_User'], $dbData['DB_Pass'], $dbData['DB_Name'], $dbPort)
        : new mysqli($dbData['DB_Host'], $dbData['DB_User'], $dbData['DB_Pass'], $dbData['DB_Name']);

    if ($mysqli->connect_error) {
        return ['Unable to connect to the database.'];
    }

    $passwordHash = password_hash((string) ($data['password'] ?? ''), PASSWORD_DEFAULT);

    $statement = $mysqli->prepare(
        "INSERT INTO `users`(`username`, `password`, `role`, `city`, `country`, `email`, `phone`, `gender`, `address`, `state`, `name`, `dob`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    if (!$statement) {
        return [$mysqli->error];
    }

    $statement->bind_param(
        'ssssssssssss',
        $data['username'],
        $passwordHash,
        $data['role'],
        $data['city'],
        $data['country'],
        $data['email'],
        $data['phone'],
        $data['gender'],
        $data['address'],
        $data['state'],
        $data['name'],
        $data['dob']
    );

    if (!$statement->execute()) {
        return [$statement->error];
    }

    return [];
}

/**
 * Build requirements status list.
 */
function installer_requirements(string $appRoot): array
{
    $requirements = [];

    $requirements[] = [
        'label' => 'PHP 7.4+',
        'ok' => version_compare(PHP_VERSION, '7.4.0', '>='),
        'details' => 'Current: ' . PHP_VERSION,
    ];

    $extensions = ['mysqli', 'json', 'mbstring'];
    foreach ($extensions as $extension) {
        $requirements[] = [
            'label' => "Extension: {$extension}",
            'ok' => extension_loaded($extension),
            'details' => extension_loaded($extension) ? 'Loaded' : 'Missing',
        ];
    }

    $requirements[] = [
        'label' => 'Writable app root',
        'ok' => is_writable($appRoot),
        'details' => $appRoot,
    ];

    $dataDir = $appRoot . '/data';
    $requirements[] = [
        'label' => 'Writable data directory',
        'ok' => is_dir($dataDir) && is_writable($dataDir),
        'details' => $dataDir,
    ];

    return $requirements;
}
