SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `apps` (
  `id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_fullname` varchar(255) NOT NULL,
  `app_summary` longtext NOT NULL,
  `app_category` varchar(255) DEFAULT 'Uncatigorized',
  `app_tags` longtext DEFAULT NULL,
  `Date_install` datetime NOT NULL DEFAULT current_timestamp(),
  `Date_updated` datetime DEFAULT NULL,
  `app_authur` varchar(255) DEFAULT 'Unknown',
  `app_email` varchar(255) DEFAULT NULL,
  `app_website` varchar(255) DEFAULT NULL,
  `app_others` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL DEFAULT 'blog',
  `category` varchar(100) NOT NULL DEFAULT 'uncatigorized',
  `url` varchar(100) NOT NULL,
  `owner` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT 'jamilsoft, blog, jamilpress',
  `theme` longtext DEFAULT NULL,
  `data` longtext NOT NULL,
  `date_reg` datetime NOT NULL DEFAULT current_timestamp(),
  `date_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `blog_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'draft',
  `featured_image` varchar(255) DEFAULT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` varchar(255) DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `author_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `blog_post_tags` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `blog_subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `blog_tags` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `other` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `summary` varchar(255) NOT NULL DEFAULT 'Summary of the Category',
  `parent` varchar(100) NOT NULL,
  `owner` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `privacy` varchar(100) NOT NULL DEFAULT 'public',
  `status` varchar(100) NOT NULL DEFAULT 'published',
  `author` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `keywords` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `author` varchar(100) NOT NULL,
  `message` longtext NOT NULL,
  `email` varchar(100) NOT NULL,
  `post_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `json` longtext DEFAULT NULL,
  `owner` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `course_contents` (
  `id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `content` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) NOT NULL DEFAULT 'unread',
  `visibility` varchar(100) NOT NULL DEFAULT 'sent',
  `scope` varchar(100) NOT NULL DEFAULT 'all'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `refcode` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `country` varchar(500) NOT NULL,
  `address` varchar(500) NOT NULL,
  `phone` varchar(300) NOT NULL,
  `username` varchar(300) NOT NULL,
  `city` varchar(300) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) NOT NULL DEFAULT 'active',
  `others` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `ecorders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `cid` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `orderby` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `period` varchar(100) NOT NULL,
  `orderkey` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `cname` varchar(500) NOT NULL,
  `cowner` varchar(100) NOT NULL,
  `pshop` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `email_logs` (
  `id` int(11) NOT NULL,
  `recipient` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `template` varchar(120) DEFAULT NULL,
  `driver` varchar(40) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `error_message` text DEFAULT NULL,
  `meta` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `email_queue` (
  `id` int(11) NOT NULL,
  `recipient` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `html` longtext DEFAULT NULL,
  `text` longtext DEFAULT NULL,
  `options` longtext DEFAULT NULL,
  `template` varchar(120) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `attempts` int(11) NOT NULL DEFAULT 0,
  `last_error` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sent_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `escrows` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(10) DEFAULT 'NGN',
  `status` enum('pending','funded','released','refunded','disputed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `estudents` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `address` varchar(500) NOT NULL,
  `passport` varchar(110) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `interest` longtext NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending',
  `code` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `to_id` varchar(110) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` longtext NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `data` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `forum_msgs` (
  `msg_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `owner_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `group_msgs` (
  `msg_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `owner_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `k_applicants` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `class` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `parent` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `k_applicants` (`id`, `name`, `class`, `dob`, `phone`, `gender`, `address`, `picture`, `parent`, `date`) VALUES
(1, 'Muhammad Jamil', 'H1A', '2022-01-06', '+2349011050365', 'Male', 'Gwallaga Street', '204-2047214_download-free-png-quran-png-download-png-image.png', '{\"Name\":\"Muhammad Jamil\",\"Job\":\"driver\",\"Relation\":\"Father\",\"Address\":\"Gwallaga Street\",\"Phone\":\"+2349011050365\",\"City\":\"Bauchi\",\"Gender\":\"Male\",\"State\":\"Bauchi\"}', '2022-01-30 13:25:30'),
(2, 'Jamilsoft Dynamic', 'P1A', '1997-07-08', '09011050365', 'Male', 'Gwallaga street', 'kamallogo.png', '{\"Name\":\"Muhammad Jamil\",\"Job\":\"driver\",\"Relation\":\"Father\",\"Address\":\"Gwallaga Street\",\"Phone\":\"+2349011050365\",\"City\":\"Bauchi\",\"Gender\":\"Male\",\"State\":\"Bauchi\"}', '2022-05-09 21:00:06'),
(3, 'Hamza Idris', 'P6C', '2022-05-13', '+2349011050365', 'Male', 'Gwallaga Street', 'kamallogo.png', '{\"Name\":\"Jamilsoft Dynamic\",\"Job\":\"driver\",\"Relation\":\"Father\",\"Address\":\"Gwallaga street\",\"Phone\":\"09011050365\",\"City\":\"Bauchi\",\"Gender\":\"Male\",\"State\":\"Bauchi\"}', '2022-05-11 12:56:24'),
(4, 'Muhammad Jamil', 'P3C', '2022-05-19', '+2349011050365', 'Male', 'Gwallaga Street', '43-430880_al-quran-png-transparent-png.png', '{\"Name\":\"Muhammad Jamil\",\"Job\":\"driver\",\"Relation\":\"Father\",\"Address\":\"Gwallaga Street\",\"Phone\":\"+2349011050365\",\"City\":\"Bauchi\",\"Gender\":\"Male\",\"State\":\"Bauchi\"}', '2022-05-15 12:05:18'),
(5, 'Shukra khalid', 'P5D', '2022-05-20', '+2349011050365', 'Male', 'Gwallaga Street', '43-430880_al-quran-png-transparent-png.png', '{\"Name\":\"Muhammad Jamil\",\"Job\":\"driver\",\"Relation\":\"Father\",\"Address\":\"Gwallaga Street\",\"Phone\":\"+2349011050365\",\"City\":\"Bauchi\",\"Gender\":\"Male\",\"State\":\"Bauchi\"}', '2022-05-16 09:32:28'),
(6, 'Maryam Musa Lele', 'P2C', '2022-05-28', '09011050365', 'Male', 'Gwallaga street', '204-2047214_download-free-png-quran-png-download-png-image.png', '{\"Name\":\"Muhammad Jamil\",\"Job\":\"driver\",\"Relation\":\"Father\",\"Address\":\"Gwallaga Street\",\"Phone\":\"+2349011050365\",\"City\":\"Bauchi\",\"Gender\":\"Male\",\"State\":\"Bauchi\"}', '2022-05-17 11:59:28'),
(7, 'Riyad Auwal', 'P2B', '2022-05-19', '+2349011050365', 'Male', 'Gwallaga Street', '358215-middle.png', '{\"Name\":\"Muhammad Jamil\",\"Job\":\"driver\",\"Relation\":\"Father\",\"Address\":\"Gwallaga Street\",\"Phone\":\"+2349011050365\",\"City\":\"Bauchi\",\"Gender\":\"Male\",\"State\":\"Bauchi\"}', '2022-05-17 18:18:58');

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `size` varchar(100) NOT NULL,
  `summary` varchar(500) NOT NULL,
  `type` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'approve',
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `owner` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `is_deleted` tinyint(1) DEFAULT 0,
  `deleted_by` int(11) DEFAULT NULL,
  `message_type` enum('text','file','system') DEFAULT 'text',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `application_id` int(11) DEFAULT NULL,
  `message_id` int(11) DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `body` text NOT NULL,
  `type` enum('message','application','status_update','payment','system') NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `is_seen` tinyint(1) DEFAULT 0,
  `action_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `type` varchar(200) NOT NULL,
  `brand` varchar(500) NOT NULL,
  `link` varchar(500) NOT NULL,
  `image` varchar(300) NOT NULL,
  `owner` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) NOT NULL DEFAULT 'approve'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` longtext NOT NULL,
  `others` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `options` (`id`, `name`, `value`, `others`) VALUES
(1, 'cprofile', '{\"name\":\"Jamilsoft Technologies\",\"summary\":\"Jamilsoft Technologies\",\"industry\":\"Jamilsoft Technologies\",\"country\":\"Nigeria\",\"city\":\"Bauchi\",\"street\":\"Gwallaga Street\",\"website\":\"Jamilsoft Technologies\",\"email\":\"myakububauchi@gmail.com\",\"phone\":\"+2349011050365\",\"rc\":\"877\"}', NULL);

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `pid` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `orderby` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `shipping` varchar(100) NOT NULL,
  `orderkey` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pname` varchar(500) NOT NULL,
  `powner` varchar(100) NOT NULL,
  `pshop` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `escrow_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(10) DEFAULT 'NGN',
  `payment_type` enum('fund','release','refund') NOT NULL,
  `payment_method` enum('wallet','card','bank_transfer') NOT NULL,
  `status` enum('pending','successful','failed') DEFAULT 'pending',
  `reference` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `summary` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `subs` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `package` varchar(1100) NOT NULL,
  `price` varchar(1100) NOT NULL,
  `circle` varchar(110) NOT NULL,
  `renewal_date` varchar(600) NOT NULL,
  `starting_date` varchar(1100) NOT NULL,
  `user_id` varchar(110) NOT NULL,
  `date_reg` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(1100) NOT NULL DEFAULT 'pending',
  `code` varchar(1100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `userlist` (
  `user_id` int(11) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `account_type` varchar(500) DEFAULT NULL,
  `fullname` varchar(500) DEFAULT NULL,
  `country` varchar(500) DEFAULT NULL,
  `company_name` varchar(500) DEFAULT NULL,
  `reset_id` varchar(500) DEFAULT NULL,
  `category` varchar(500) DEFAULT NULL,
  `year_experience` varchar(500) DEFAULT NULL,
  `portfolio` longtext DEFAULT NULL,
  `bio` longtext DEFAULT NULL,
  `price_rate` varchar(500) DEFAULT NULL,
  `availability` varchar(500) DEFAULT NULL,
  `project_type` varchar(500) DEFAULT NULL,
  `industry` varchar(500) DEFAULT NULL,
  `commitment` varchar(500) DEFAULT NULL,
  `budget` varchar(500) DEFAULT NULL,
  `start_date` varchar(500) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `id` int(110) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `bio` longtext DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `date_reg` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `username`, `password`, `role`, `city`, `country`, `email`, `phone`, `gender`, `address`, `state`, `bio`, `avatar`, `name`, `dob`, `date_reg`, `date_updated`) VALUES
(1, 'myakububauchi@gmail.com', '$2y$10$S6Za9w1iTK88JioezhNCpOALXAs3n98GwwFjZscPkUZ7tt6LRtjwi', 'admin', 'Bauchi', '', 'myakububauchi@gmail.com', '+2349011050365', 'Male', 'Gwallaga Street', 'Bauchi', '', 'jx.jpg', 'Muhammad Jamil', '2023-10-17', '2023-10-07 07:25:30', NULL),
(2, 'jamilsoft.dynamic@gmail.com', '$2y$10$Uj3MdNBKFSe4lCQHkODKR.wHkPFExJLNCvC53ClXLshCS5iNkUA6S', 'admin', 'Bauchi', 'Nigeria', 'jamilsoft.dynamic@gmail.com', '', 'Male', 'Gwallaga street', 'Bauchi', '', '', 'Jamilsoft Dynamic', '2023-10-18', '2023-10-27 18:18:22', NULL);

CREATE TABLE `user_experiences` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `is_current` tinyint(1) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user_experiences` (`id`, `user_id`, `title`, `company_name`, `location`, `start_date`, `end_date`, `is_current`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 'manager', 'Jamilsoft Technologies', 'gwallaga', '2025-12-05', '2025-12-10', 0, 'hgfhgfh', '2025-12-08 09:25:07', '2025-12-08 09:25:07');

CREATE TABLE `user_posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(400) NOT NULL,
  `skills` text DEFAULT NULL,
  `minbudget` varchar(300) DEFAULT NULL,
  `maxbudget` varchar(500) NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` varchar(500) NOT NULL,
  `duration` varchar(110) NOT NULL,
  `type` varchar(500) NOT NULL DEFAULT 'project',
  `location` varchar(500) NOT NULL,
  `files` varchar(500) NOT NULL,
  `image` varchar(1100) NOT NULL,
  `jobtype` varchar(500) NOT NULL DEFAULT 'Full-time',
  `keywords` varchar(500) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `balance` decimal(12,2) DEFAULT 0.00,
  `currency` varchar(10) DEFAULT 'NGN',
  `status` enum('active','frozen') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `wallet_transactions` (
  `id` int(11) NOT NULL,
  `wallet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `balance_before` decimal(12,2) NOT NULL,
  `balance_after` decimal(12,2) NOT NULL,
  `transaction_type` enum('credit','debit') NOT NULL,
  `reason` enum('escrow_release','escrow_fund','refund','withdrawal','commission','manual_adjustment') NOT NULL,
  `reference` varchar(100) DEFAULT NULL,
  `meta` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_categories_slug_unique` (`slug`);

ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_posts_slug_unique` (`slug`),
  ADD KEY `blog_posts_category_idx` (`category_id`);

ALTER TABLE `blog_post_tags`
  ADD PRIMARY KEY (`post_id`,`tag_id`),
  ADD KEY `blog_post_tags_tag_idx` (`tag_id`);

ALTER TABLE `blog_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_subscribers_email_unique` (`email`);

ALTER TABLE `blog_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_tags_slug_unique` (`slug`);

ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `refcode` (`refcode`);

ALTER TABLE `email_logs`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `email_queue`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `escrows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_application` (`application_id`),
  ADD KEY `idx_status` (`status`);

ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_application` (`application_id`),
  ADD KEY `idx_sender` (`sender_id`),
  ADD KEY `idx_receiver` (`receiver_id`),
  ADD KEY `idx_read` (`is_read`);

ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `idx_read` (`is_read`),
  ADD KEY `idx_type` (`type`),
  ADD KEY `fk_notification_application` (`application_id`),
  ADD KEY `fk_notification_message` (`message_id`);

ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference` (`reference`),
  ADD KEY `idx_escrow` (`escrow_id`),
  ADD KEY `idx_user` (`user_id`);

ALTER TABLE `userlist`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `user_experiences`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_posts`
  ADD PRIMARY KEY (`post_id`);

ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `idx_user` (`user_id`);

ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference` (`reference`),
  ADD KEY `idx_wallet` (`wallet_id`),
  ADD KEY `idx_user` (`user_id`);


ALTER TABLE `apps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `blog_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `blog_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `blog_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `email_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `email_queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `escrows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `userlist`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_experiences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `user_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `wallet_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `escrows`
  ADD CONSTRAINT `fk_escrow_application` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE;

ALTER TABLE `messages`
  ADD CONSTRAINT `fk_message_application` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE;

ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notification_application` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_notification_message` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE;

ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payment_escrow` FOREIGN KEY (`escrow_id`) REFERENCES `escrows` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
