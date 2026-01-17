CREATE TABLE IF NOT EXISTS `email_logs` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `recipient` TEXT NOT NULL,
    `subject` VARCHAR(255) NOT NULL,
    `template` VARCHAR(120) DEFAULT NULL,
    `driver` VARCHAR(40) DEFAULT NULL,
    `status` VARCHAR(20) NOT NULL,
    `error_message` TEXT,
    `meta` TEXT,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `email_queue` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `recipient` TEXT NOT NULL,
    `subject` VARCHAR(255) NOT NULL,
    `html` LONGTEXT,
    `text` LONGTEXT,
    `options` LONGTEXT,
    `template` VARCHAR(120) DEFAULT NULL,
    `status` VARCHAR(20) NOT NULL DEFAULT 'pending',
    `attempts` INT NOT NULL DEFAULT 0,
    `last_error` TEXT,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `sent_at` DATETIME DEFAULT NULL
);
