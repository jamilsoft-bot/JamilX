<?php
return [
    'up' => [
        "CREATE TABLE IF NOT EXISTS `user_passkeys` (\n"
        . "  `id` INT NOT NULL AUTO_INCREMENT,\n"
        . "  `user_id` INT NOT NULL,\n"
        . "  `credential_id` VARCHAR(512) NOT NULL,\n"
        . "  `public_key_cose` MEDIUMTEXT NOT NULL,\n"
        . "  `sign_count` BIGINT UNSIGNED NOT NULL DEFAULT 0,\n"
        . "  `transports` JSON DEFAULT NULL,\n"
        . "  `aaguid` VARCHAR(64) DEFAULT NULL,\n"
        . "  `device_name` VARCHAR(255) DEFAULT NULL,\n"
        . "  `last_used_at` TIMESTAMP NULL DEFAULT NULL,\n"
        . "  `revoked_at` TIMESTAMP NULL DEFAULT NULL,\n"
        . "  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,\n"
        . "  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,\n"
        . "  PRIMARY KEY (`id`),\n"
        . "  UNIQUE KEY `user_passkeys_credential_id_unique` (`credential_id`),\n"
        . "  KEY `user_passkeys_user_id_index` (`user_id`)\n"
        . ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
    ],
    'down' => [
        "DROP TABLE IF EXISTS `user_passkeys`",
    ],
];
