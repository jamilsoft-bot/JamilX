<?php
return [
    'up' => [
        "CREATE TABLE IF NOT EXISTS `webauthn_challenges` (\n"
        . "  `id` INT NOT NULL AUTO_INCREMENT,\n"
        . "  `session_id` VARCHAR(255) NOT NULL,\n"
        . "  `challenge` VARCHAR(255) NOT NULL,\n"
        . "  `challenge_type` VARCHAR(20) NOT NULL,\n"
        . "  `user_id` INT NULL DEFAULT NULL,\n"
        . "  `expires_at` DATETIME NOT NULL,\n"
        . "  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,\n"
        . "  PRIMARY KEY (`id`),\n"
        . "  UNIQUE KEY `webauthn_challenges_challenge_unique` (`challenge`),\n"
        . "  KEY `webauthn_challenges_type_index` (`challenge_type`),\n"
        . "  KEY `webauthn_challenges_user_id_index` (`user_id`),\n"
        . "  KEY `webauthn_challenges_expires_at_index` (`expires_at`)\n"
        . ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
    ],
    'down' => [
        "DROP TABLE IF EXISTS `webauthn_challenges`",
    ],
];
