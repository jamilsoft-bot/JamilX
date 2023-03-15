CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL DEFAULT 'class',
  `category` varchar(100) NOT NULL DEFAULT 'uncatigorized',
  `url` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT 'jamilsoft, blog, jamilpress',
  `theme` longtext,
  `data` longtext,
  `date_reg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_update` datetime DEFAULT NULL
);

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `summary` varchar(255) NOT NULL DEFAULT 'Summary of the Post',
  `type` varchar(100) NOT NULL DEFAULT 'post',
  `cat` varchar(100) NOT NULL DEFAULT 'uncategorized',
  `data` longtext,
  `image` varchar(100) NOT NULL DEFAULT 'kimage.png',
  `class` varchar(100) NOT NULL DEFAULT 'none',
  `keywords` text NOT NULL,
  `author` varchar(100) NOT NULL DEFAULT 'none',
  `status` varchar(100) NOT NULL DEFAULT 'published',
  `privacy` varchar(100) NOT NULL DEFAULT 'public',
  `shortname` varchar(50) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL
)