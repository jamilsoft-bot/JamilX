<?php
return [
    'up' => [
        "CREATE TABLE IF NOT EXISTS `user_profiles` (\n"
        . "  `id` INT NOT NULL AUTO_INCREMENT,\n"
        . "  `user_id` INT NOT NULL,\n"
        . "  `display_name` VARCHAR(150) DEFAULT NULL,\n"
        . "  `headline` VARCHAR(255) DEFAULT NULL,\n"
        . "  `bio` TEXT DEFAULT NULL,\n"
        . "  `website` VARCHAR(255) DEFAULT NULL,\n"
        . "  `location` VARCHAR(150) DEFAULT NULL,\n"
        . "  `timezone` VARCHAR(100) DEFAULT NULL,\n"
        . "  `pronouns` VARCHAR(60) DEFAULT NULL,\n"
        . "  `skills` JSON DEFAULT NULL,\n"
        . "  `social_links` JSON DEFAULT NULL,\n"
        . "  `preferences` JSON DEFAULT NULL,\n"
        . "  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,\n"
        . "  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,\n"
        . "  PRIMARY KEY (`id`),\n"
        . "  UNIQUE KEY `user_profiles_user_id_unique` (`user_id`)\n"
        . ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
    ],
    'down' => [
        "DROP TABLE IF EXISTS `user_profiles`",
    ],
];
