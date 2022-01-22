-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.27-0ubuntu0.20.04.1 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for watkanikdoen_app
DROP DATABASE IF EXISTS `watkanikdoen_app`;
CREATE DATABASE IF NOT EXISTS `watkanikdoen_app` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `watkanikdoen_app`;

-- Dumping structure for table watkanikdoen_app.aanmeldingen
DROP TABLE IF EXISTS `aanmeldingen`;
CREATE TABLE IF NOT EXISTS `aanmeldingen` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `externe_link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `location` point DEFAULT NULL,
  `location_human` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('PENDING','APPROVED','REJECTED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.aanmeldingen: ~0 rows (approximately)
/*!40000 ALTER TABLE `aanmeldingen` DISABLE KEYS */;
INSERT INTO `aanmeldingen` (`id`, `user_id`, `title`, `body`, `externe_link`, `time_start`, `time_end`, `location`, `location_human`, `image`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Test aanmelding', '<p>Dit is een test</p>', '#', '2022-01-19 17:22:00', '2022-01-19 17:22:00', NULL, 'Loc', NULL, 'PENDING', '2022-01-19 16:22:36', '2022-01-21 10:35:43');
/*!40000 ALTER TABLE `aanmeldingen` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.acties
DROP TABLE IF EXISTS `acties`;
CREATE TABLE IF NOT EXISTS `acties` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `externe_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `location` point DEFAULT NULL,
  `location_human` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` enum('PUBLISHED','DRAFT','PENDING') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.acties: ~10 rows (approximately)
/*!40000 ALTER TABLE `acties` DISABLE KEYS */;
INSERT INTO `acties` (`id`, `user_id`, `title`, `seo_title`, `excerpt`, `body`, `externe_link`, `time_start`, `time_end`, `location`, `location_human`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `featured`, `created_at`, `updated_at`) VALUES
	(11, 2, 'Klimaatdemo', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis venenatis nibh, dapibus tempus ex ultrices sit amet.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis venenatis nibh, dapibus tempus ex ultrices sit amet. <strong>Donec bibendum purus venenatis sapien semper volutpat. Aliquam tincidunt convallis iaculis. Donec at ligula ac arcu fringilla lacinia sed id erat.</strong> Vestibulum non ex gravida, pretium urna eu, luctus justo. Pellentesque gravida porta scelerisque. Curabitur nulla neque, tristique eu ipsum at, gravida tempor nisl. Proin non iaculis magna. Praesent sed lectus vel nunc egestas pulvinar. <em>Integer tincidunt sem in vehicula commodo. </em></p>', '#', '2022-02-06 15:45:00', '2022-02-06 16:45:00', _binary 0x0000000001010000001fd5bfa0ac8d1340e5a06c50362c4a40, 'De Dam, Amsterdam', NULL, 'klimaatdemo-amsterdam', NULL, NULL, 'PUBLISHED', 0, '2021-11-29 16:26:00', '2022-01-04 08:57:30'),
	(12, 2, 'Black Lives Matter', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vel leo massa. Suspendisse pharetra justo ut turpis suscipit, in auctor tellus dignissim. Donec orci tortor, aliquam eu mauris vitae, vestibulum porta mi. Ut leo augue, elementum nec malesuada sed, euismod vel nunc. Sed tincidunt dolor porttitor eros suscipit, in dignissim erat mollis. Vestibulum in rhoncus mauris, sit amet rutrum orci. Vestibulum at pulvinar nisl.</p>\r\n<p>Ut hendrerit augue nec suscipit interdum. In auctor purus sem. Nullam quis lorem eu turpis euismod cursus. Maecenas varius, nisi ut bibendum gravida, quam massa aliquet quam, a imperdiet leo nulla at magna. Donec sollicitudin congue rhoncus. Phasellus et semper nisl. Nulla facilisi. Praesent eget ipsum laoreet, convallis sapien id, fringilla dui. Donec volutpat odio nec molestie efficitur. Cras finibus vulputate mauris. Suspendisse potenti. Praesent ac vestibulum felis. Nulla mollis tellus a odio tincidunt tincidunt. Nullam tempor, metus quis vulputate consectetur, quam ex elementum mi, id posuere tellus nisl non orci.</p>', '#', '2022-02-06 15:45:00', '2022-02-06 15:45:00', _binary 0x00000000010100000075931804568e13406f1283c0ca314a40, 'De Dam, Amsterdam', 'acties/pexels-paddy-o-sullivan-2369217-resize-500.jpg', 'black-lives-matter-amsterdam', NULL, NULL, 'PUBLISHED', 0, '2021-12-02 18:26:00', '2022-01-03 16:27:19'),
	(16, 1, 'Kick Out Zwarte Piet', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu felis sodales, ullamcorper diam quis, condimentum velit. Vestibulum nisl augue, mattis ultricies laoreet a, maximus vitae tellus. Aenean imperdiet, mauris vitae ornare convallis, sem massa hendrerit diam, auctor aliquet est augue scelerisque elit. Nam volutpat mi eget fringilla dignissim. Integer varius sagittis nisi vel viverra. Etiam sit amet feugiat ligula. Donec quis hendrerit purus. Duis placerat iaculis massa, ac imperdiet nisi luctus eget. Praesent vel massa vel arcu efficitur bibendum non a arcu. Quisque ornare facilisis enim dapibus auctor. Fusce laoreet nunc non massa auctor, sit amet blandit urna bibendum. Aliquam efficitur porttitor justo, a mollis orci egestas ac.</p>\r\n<p>Phasellus aliquam laoreet nibh id auctor. Nulla auctor, nisl vel dictum tristique, lacus felis lacinia ligula, ac mollis velit justo ut magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec elit magna, maximus id egestas in, elementum id turpis. Sed vitae neque vestibulum, auctor lacus elementum, elementum purus. Ut aliquet justo et lacus consequat hendrerit eget ac elit. Morbi rhoncus a dolor vel vehicula. Aliquam erat volutpat. Vivamus pulvinar mi sit amet libero finibus, ut sodales sapien gravida. Aliquam erat volutpat.</p>', '#', '2022-02-08 09:00:00', '2022-02-09 15:00:00', _binary 0x00000000010100000075931804568e13406f1283c0ca314a40, 'De Dam, Amsterdam', 'acties/pexels-markus-spiske-3039036-resize-500.jpg', 'kick-out-zwarte-piet', NULL, NULL, 'PUBLISHED', 0, '2021-12-08 09:00:00', '2022-01-04 08:55:07'),
	(17, 1, 'Woonprotest', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ultrices tortor in auctor pulvinar. In enim enim, tristique a erat quis, venenatis facilisis dui. Maecenas eget ligula ut ipsum lobortis tristique in non diam. Pellentesque quis orci tempus, accumsan velit a, sodales sem. Ut elementum nunc viverra augue imperdiet euismod. Praesent venenatis tempus dolor. Maecenas venenatis laoreet sem et ultricies. Sed augue sapien, mollis a eros at, bibendum placerat arcu. Phasellus vitae dui gravida, semper augue non, sagittis lacus. Curabitur non metus eget quam consequat tincidunt. Duis feugiat dignissim felis. In egestas ante arcu, nec scelerisque quam suscipit sit amet. Aliquam et ex at sapien sodales pharetra nec at leo. Donec hendrerit pulvinar ipsum sit amet elementum. Pellentesque placerat enim ligula, cursus vulputate augue mollis vel.</p>', '#', '2022-01-15 18:59:00', '2022-01-24 19:00:00', _binary 0x00000000010100000075931804568e13406f1283c0ca314a40, 'De Dam, Amsterdam', 'acties/pexels-karolina-grabowska-8106775-resize-500.jpg', 'woonprotest-amsterdam', NULL, NULL, 'PUBLISHED', 0, '2021-12-11 18:00:00', '2022-01-03 16:08:47'),
	(19, 2, 'Klimaatdemo', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis venenatis nibh, dapibus tempus ex ultrices sit amet.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis venenatis nibh, dapibus tempus ex ultrices sit amet. <strong>Donec bibendum purus venenatis sapien semper volutpat. Aliquam tincidunt convallis iaculis. Donec at ligula ac arcu fringilla lacinia sed id erat.</strong> Vestibulum non ex gravida, pretium urna eu, luctus justo. Pellentesque gravida porta scelerisque. Curabitur nulla neque, tristique eu ipsum at, gravida tempor nisl. Proin non iaculis magna. Praesent sed lectus vel nunc egestas pulvinar. <em>Integer tincidunt sem in vehicula commodo. </em></p>', '#', '2022-02-06 15:45:00', '2022-02-06 15:45:00', _binary 0x00000000010100000051ce5ed57f741440db971090640a4a40, 'Jaarbeursplein, Utrecht', NULL, 'klimaatdemo-utrecht', NULL, NULL, 'PUBLISHED', 0, '2021-11-29 16:26:00', '2022-01-04 08:58:26'),
	(20, 2, 'Klimaatdemo', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis venenatis nibh, dapibus tempus ex ultrices sit amet.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis venenatis nibh, dapibus tempus ex ultrices sit amet. <strong>Donec bibendum purus venenatis sapien semper volutpat. Aliquam tincidunt convallis iaculis. Donec at ligula ac arcu fringilla lacinia sed id erat.</strong> Vestibulum non ex gravida, pretium urna eu, luctus justo. Pellentesque gravida porta scelerisque. Curabitur nulla neque, tristique eu ipsum at, gravida tempor nisl. Proin non iaculis magna. Praesent sed lectus vel nunc egestas pulvinar. <em>Integer tincidunt sem in vehicula commodo. </em></p>', '#', '2022-02-06 15:45:00', '2022-02-06 15:45:00', _binary 0x000000000101000000533b75f0456117403cfd40fef4eb4940, 'Valkhofpark, Nijmegen', NULL, 'klimaatdemo-nijmegen', NULL, NULL, 'PUBLISHED', 0, '2021-11-29 16:26:00', '2022-01-04 08:58:58'),
	(23, 2, 'Black Lives Matter', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vel leo massa. Suspendisse pharetra justo ut turpis suscipit, in auctor tellus dignissim. Donec orci tortor, aliquam eu mauris vitae, vestibulum porta mi. Ut leo augue, elementum nec malesuada sed, euismod vel nunc. Sed tincidunt dolor porttitor eros suscipit, in dignissim erat mollis. Vestibulum in rhoncus mauris, sit amet rutrum orci. Vestibulum at pulvinar nisl.</p>\r\n<p>Ut hendrerit augue nec suscipit interdum. In auctor purus sem. Nullam quis lorem eu turpis euismod cursus. Maecenas varius, nisi ut bibendum gravida, quam massa aliquet quam, a imperdiet leo nulla at magna. Donec sollicitudin congue rhoncus. Phasellus et semper nisl. Nulla facilisi. Praesent eget ipsum laoreet, convallis sapien id, fringilla dui. Donec volutpat odio nec molestie efficitur. Cras finibus vulputate mauris. Suspendisse potenti. Praesent ac vestibulum felis. Nulla mollis tellus a odio tincidunt tincidunt. Nullam tempor, metus quis vulputate consectetur, quam ex elementum mi, id posuere tellus nisl non orci.</p>', 'https://utrecht.nl', '2022-02-06 15:45:00', '2022-02-06 15:45:00', _binary 0x0000000001010000007342d444da70144092fd8ea7fc0a4a40, 'Jaarbeursplein, Utrecht', NULL, 'black-lives-matter-utrecht', NULL, NULL, 'PUBLISHED', 0, '2021-12-02 18:26:00', '2022-01-04 08:55:59'),
	(24, 2, 'Black Lives Matter', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vel leo massa. Suspendisse pharetra justo ut turpis suscipit, in auctor tellus dignissim. Donec orci tortor, aliquam eu mauris vitae, vestibulum porta mi. Ut leo augue, elementum nec malesuada sed, euismod vel nunc. Sed tincidunt dolor porttitor eros suscipit, in dignissim erat mollis. Vestibulum in rhoncus mauris, sit amet rutrum orci. Vestibulum at pulvinar nisl.</p>\r\n<p>Ut hendrerit augue nec suscipit interdum. In auctor purus sem. Nullam quis lorem eu turpis euismod cursus. Maecenas varius, nisi ut bibendum gravida, quam massa aliquet quam, a imperdiet leo nulla at magna. Donec sollicitudin congue rhoncus. Phasellus et semper nisl. Nulla facilisi. Praesent eget ipsum laoreet, convallis sapien id, fringilla dui. Donec volutpat odio nec molestie efficitur. Cras finibus vulputate mauris. Suspendisse potenti. Praesent ac vestibulum felis. Nulla mollis tellus a odio tincidunt tincidunt. Nullam tempor, metus quis vulputate consectetur, quam ex elementum mi, id posuere tellus nisl non orci.</p>', 'https://nijmegen.nl', '2022-02-06 15:45:00', '2022-02-06 15:45:00', _binary 0x00000000010100000059eae08b466617402b72757724eb4940, 'Valkhofpark, Nijmegen', NULL, 'black-lives-matter-nijmegen', NULL, NULL, 'PUBLISHED', 0, '2021-12-02 18:26:00', '2022-01-04 08:56:59'),
	(25, 2, 'Bio-industrie Protest', NULL, NULL, '<p>Dit is de beschrijving. Lorem Ipsum lorem ipsum</p>', 'https://partijvoordedieren.nl', '2022-02-17 10:02:00', '2022-02-17 10:02:00', _binary 0x00000000010100000075931804568e13406f1283c0ca314a40, 'Museumplein, Amsterdam', 'acties/pexels-karolina-grabowska-8106775-resize-500.jpg', 'bio-industrie-protest', NULL, NULL, 'PUBLISHED', 0, '2021-12-18 10:02:00', '2022-01-21 10:05:51');
/*!40000 ALTER TABLE `acties` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.actie_actie_theme
DROP TABLE IF EXISTS `actie_actie_theme`;
CREATE TABLE IF NOT EXISTS `actie_actie_theme` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `actie_id` int unsigned NOT NULL,
  `actie_theme_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `actie_actie_theme_actie_id_foreign` (`actie_id`),
  KEY `actie_actie_theme_theme_id_foreign` (`actie_theme_id`),
  CONSTRAINT `actie_actie_theme_actie_id_foreign` FOREIGN KEY (`actie_id`) REFERENCES `acties` (`id`) ON DELETE CASCADE,
  CONSTRAINT `actie_actie_theme_actie_theme_id_foreign` FOREIGN KEY (`actie_theme_id`) REFERENCES `actie_themes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.actie_actie_theme: ~8 rows (approximately)
/*!40000 ALTER TABLE `actie_actie_theme` DISABLE KEYS */;
INSERT INTO `actie_actie_theme` (`id`, `actie_id`, `actie_theme_id`) VALUES
	(1, 17, 4),
	(2, 16, 2),
	(3, 12, 2),
	(4, 11, 1),
	(5, 23, 2),
	(6, 24, 2),
	(7, 19, 1),
	(8, 20, 1);
/*!40000 ALTER TABLE `actie_actie_theme` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.actie_category
DROP TABLE IF EXISTS `actie_category`;
CREATE TABLE IF NOT EXISTS `actie_category` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `actie_id` int unsigned NOT NULL,
  `category_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `actie_category_actie_id_foreign` (`actie_id`),
  KEY `actie_category_category_id_foreign` (`category_id`),
  CONSTRAINT `actie_category_actie_id_foreign` FOREIGN KEY (`actie_id`) REFERENCES `acties` (`id`) ON DELETE CASCADE,
  CONSTRAINT `actie_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.actie_category: ~8 rows (approximately)
/*!40000 ALTER TABLE `actie_category` DISABLE KEYS */;
INSERT INTO `actie_category` (`id`, `actie_id`, `category_id`) VALUES
	(11, 16, 6),
	(12, 17, 6),
	(13, 12, 6),
	(14, 11, 6),
	(15, 23, 6),
	(16, 24, 6),
	(17, 19, 6),
	(18, 20, 6),
	(19, 25, 6);
/*!40000 ALTER TABLE `actie_category` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.actie_organizer
DROP TABLE IF EXISTS `actie_organizer`;
CREATE TABLE IF NOT EXISTS `actie_organizer` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `actie_id` int unsigned NOT NULL,
  `organizer_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `actie_organizer_actie_id_foreign` (`actie_id`),
  KEY `actie_organizer_organizer_id_foreign` (`organizer_id`),
  CONSTRAINT `actie_organizer_actie_id_foreign` FOREIGN KEY (`actie_id`) REFERENCES `acties` (`id`) ON DELETE CASCADE,
  CONSTRAINT `actie_organizer_organizer_id_foreign` FOREIGN KEY (`organizer_id`) REFERENCES `organizers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.actie_organizer: ~11 rows (approximately)
/*!40000 ALTER TABLE `actie_organizer` DISABLE KEYS */;
INSERT INTO `actie_organizer` (`id`, `actie_id`, `organizer_id`) VALUES
	(1, 17, 1),
	(2, 12, 2),
	(3, 16, 3),
	(4, 23, 2),
	(5, 24, 2),
	(6, 11, 1),
	(7, 19, 1),
	(8, 20, 1),
	(9, 25, 1),
	(11, 25, 3);
/*!40000 ALTER TABLE `actie_organizer` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.actie_themes
DROP TABLE IF EXISTS `actie_themes`;
CREATE TABLE IF NOT EXISTS `actie_themes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `order` int NOT NULL DEFAULT '1',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `actie_themes_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.actie_themes: ~4 rows (approximately)
/*!40000 ALTER TABLE `actie_themes` DISABLE KEYS */;
INSERT INTO `actie_themes` (`id`, `order`, `name`, `slug`, `color`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Klimaat', 'klimaat', NULL, '2017-11-21 16:23:22', '2021-12-06 14:10:08'),
	(2, 1, 'Anti-racisme', 'anti-racisme', NULL, '2021-12-06 14:10:20', '2021-12-06 14:10:20'),
	(3, 1, 'Dierenrechten', 'dierenrechten', NULL, '2021-12-06 14:10:31', '2021-12-06 14:10:31'),
	(4, 1, 'Wonen', 'wonen', NULL, '2021-12-06 14:10:46', '2021-12-06 14:10:46');
/*!40000 ALTER TABLE `actie_themes` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.announcements
DROP TABLE IF EXISTS `announcements`;
CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.announcements: ~2 rows (approximately)
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
INSERT INTO `announcements` (`id`, `title`, `description`, `body`, `created_at`, `updated_at`) VALUES
	(1, 'Wave 1.0 Released', 'We have just released the first official version of Wave. Click here to learn more!', '<p>It\'s been a fun Journey creating this awesome SAAS starter kit and we are super excited to use it in many of our future projects. There are just so many features that Wave has that will make building the SAAS of your dreams easier than ever before.</p>\n<p>Make sure to stay up-to-date on our latest releases as we will be releasing many more features down the road :)</p>\n<p>Thanks! Talk to you soon.</p>', '2018-05-20 23:19:00', '2018-05-21 00:38:02'),
	(2, 'Wave 2.0 Released', 'Wave V2 has been released with some awesome new features. Be sure to read up on what\'s new!', '<p>This new version of Wave includes the following updates:</p>\r\n<ul>\r\n<li>Update to the latest version of Laravel</li>\r\n<li>New Payment integration with Paddle</li>\r\n<li>Rewritten theme support</li>\r\n<li>Deployment integration</li>\r\n<li>Much more awesomeness</li>\r\n</ul>\r\n<p>Be sure to check out the official Wave v2 page at <a href="https://devdojo.com/wave">https://devdojo.com/wave</a></p>', '2020-03-20 23:19:00', '2021-11-24 19:54:32'),
	(3, 'Test Announcement', 'This is a test announcement', '<p>Does this test work? This is the body.</p>', '2021-11-29 09:15:20', '2021-11-29 09:15:21');
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.announcement_user
DROP TABLE IF EXISTS `announcement_user`;
CREATE TABLE IF NOT EXISTS `announcement_user` (
  `announcement_id` int unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  KEY `announcement_user_announcement_id_index` (`announcement_id`),
  KEY `announcement_user_user_id_index` (`user_id`),
  CONSTRAINT `announcement_user_announcement_id_foreign` FOREIGN KEY (`announcement_id`) REFERENCES `announcements` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `announcement_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.announcement_user: ~6 rows (approximately)
/*!40000 ALTER TABLE `announcement_user` DISABLE KEYS */;
INSERT INTO `announcement_user` (`announcement_id`, `user_id`) VALUES
	(1, 1),
	(2, 1),
	(1, 2),
	(2, 2),
	(3, 2),
	(3, 1);
/*!40000 ALTER TABLE `announcement_user` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `order` int NOT NULL DEFAULT '1',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.categories: ~1 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `order`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(6, 1, 'Demonstratie', 'demonstratie', '2021-12-20 12:48:31', '2021-12-20 12:48:31');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.data_rows
DROP TABLE IF EXISTS `data_rows`;
CREATE TABLE IF NOT EXISTS `data_rows` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `data_type_id` int unsigned NOT NULL,
  `field` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `details` text COLLATE utf8mb4_unicode_ci,
  `order` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `data_rows_data_type_id_foreign` (`data_type_id`),
  CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.data_rows: ~112 rows (approximately)
/*!40000 ALTER TABLE `data_rows` DISABLE KEYS */;
INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
	(1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '', 1),
	(2, 1, 'author_id', 'text', 'Author', 1, 0, 1, 1, 0, 1, '', 2),
	(3, 1, 'category_id', 'text', 'Category', 1, 0, 1, 1, 1, 0, '', 3),
	(4, 1, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '', 4),
	(5, 1, 'excerpt', 'text_area', 'excerpt', 1, 0, 1, 1, 1, 1, '', 5),
	(6, 1, 'body', 'rich_text_box', 'Body', 1, 0, 1, 1, 1, 1, '', 6),
	(7, 1, 'image', 'image', 'Post Image', 0, 1, 1, 1, 1, 1, '{"resize":{"width":"1000","height":"null"},"quality":"70%","upsize":true,"thumbnails":[{"name":"medium","scale":"50%"},{"name":"small","scale":"25%"},{"name":"cropped","crop":{"width":"300","height":"250"}}]}', 7),
	(8, 1, 'slug', 'text', 'slug', 1, 0, 1, 1, 1, 1, '{"slugify":{"origin":"title","forceUpdate":true}}', 8),
	(9, 1, 'meta_description', 'text_area', 'meta_description', 1, 0, 1, 1, 1, 1, '', 9),
	(10, 1, 'meta_keywords', 'text_area', 'meta_keywords', 1, 0, 1, 1, 1, 1, '', 10),
	(11, 1, 'status', 'select_dropdown', 'status', 1, 1, 1, 1, 1, 1, '{"default":"DRAFT","options":{"PUBLISHED":"published","DRAFT":"draft","PENDING":"pending"}}', 11),
	(12, 1, 'created_at', 'timestamp', 'created_at', 0, 1, 1, 0, 0, 0, '', 12),
	(13, 1, 'updated_at', 'timestamp', 'updated_at', 0, 0, 0, 0, 0, 0, '', 13),
	(14, 2, 'id', 'number', 'id', 1, 0, 0, 0, 0, 0, '{}', 1),
	(15, 2, 'author_id', 'text', 'author_id', 1, 0, 0, 0, 0, 0, '{}', 2),
	(16, 2, 'title', 'text', 'title', 1, 1, 1, 1, 1, 1, '{}', 3),
	(17, 2, 'excerpt', 'text_area', 'excerpt', 0, 0, 1, 1, 1, 1, '{}', 4),
	(18, 2, 'body', 'rich_text_box', 'body', 0, 0, 1, 1, 1, 1, '{"tinymceOptions":{"inline_styles":false,"plugins":"link, image, code, table, textcolor, lists, paste","paste_remove_styles":true,"theme_advanced_buttons3_add":"pastetext,pasteword,selectall"}}', 5),
	(19, 2, 'slug', 'text', 'slug', 1, 0, 1, 1, 1, 1, '{"slugify":{"origin":"title"}}', 6),
	(20, 2, 'meta_description', 'text', 'meta_description', 0, 0, 1, 1, 1, 1, '{}', 7),
	(21, 2, 'meta_keywords', 'text', 'meta_keywords', 0, 0, 1, 1, 1, 1, '{}', 8),
	(22, 2, 'status', 'select_dropdown', 'status', 1, 1, 1, 1, 1, 1, '{"default":"INACTIVE","options":{"INACTIVE":"INACTIVE","ACTIVE":"ACTIVE"}}', 9),
	(23, 2, 'created_at', 'timestamp', 'created_at', 0, 1, 1, 0, 0, 0, '{}', 10),
	(24, 2, 'updated_at', 'timestamp', 'updated_at', 0, 0, 0, 0, 0, 0, '{}', 11),
	(25, 2, 'image', 'image', 'image', 0, 1, 1, 1, 1, 1, '{}', 12),
	(26, 3, 'id', 'number', 'id', 1, 0, 0, 0, 0, 0, NULL, 1),
	(27, 3, 'name', 'text', 'name', 1, 1, 1, 1, 1, 1, NULL, 2),
	(28, 3, 'email', 'text', 'email', 1, 1, 1, 1, 1, 1, NULL, 3),
	(29, 3, 'password', 'password', 'password', 1, 0, 0, 1, 1, 0, NULL, 5),
	(30, 3, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{"model":"TCG\\\\Voyager\\\\Models\\\\Role","table":"roles","type":"belongsToMany","column":"role_id","key":"id","label":"display_name","pivot_table":"user_roles","pivot":"1","taggable":"on"}', 11),
	(31, 3, 'remember_token', 'text', 'remember_token', 0, 0, 0, 0, 0, 0, NULL, 6),
	(32, 3, 'created_at', 'timestamp', 'created_at', 0, 1, 1, 0, 0, 0, NULL, 7),
	(33, 3, 'updated_at', 'timestamp', 'updated_at', 0, 0, 0, 0, 0, 0, NULL, 8),
	(34, 3, 'avatar', 'image', 'avatar', 0, 1, 1, 1, 1, 1, NULL, 9),
	(35, 5, 'id', 'number', 'id', 1, 0, 0, 0, 0, 0, '', 1),
	(36, 5, 'name', 'text', 'name', 1, 1, 1, 1, 1, 1, '', 2),
	(37, 5, 'created_at', 'timestamp', 'created_at', 0, 0, 0, 0, 0, 0, '', 3),
	(38, 5, 'updated_at', 'timestamp', 'updated_at', 0, 0, 0, 0, 0, 0, '', 4),
	(39, 4, 'id', 'number', 'id', 1, 0, 0, 0, 0, 0, '{}', 1),
	(41, 4, 'order', 'text', 'order', 1, 1, 1, 1, 1, 1, '{"default":1}', 3),
	(42, 4, 'name', 'text', 'name', 1, 1, 1, 1, 1, 1, '{}', 4),
	(43, 4, 'slug', 'text', 'slug', 1, 1, 1, 1, 1, 1, '{"slugify":{"origin":"name"}}', 5),
	(44, 4, 'created_at', 'timestamp', 'created_at', 0, 0, 1, 0, 0, 0, '{}', 6),
	(45, 4, 'updated_at', 'timestamp', 'updated_at', 0, 0, 0, 0, 0, 0, '{}', 7),
	(46, 6, 'id', 'number', 'id', 1, 0, 0, 0, 0, 0, '', 1),
	(47, 6, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '', 2),
	(48, 6, 'created_at', 'timestamp', 'created_at', 0, 0, 0, 0, 0, 0, '', 3),
	(49, 6, 'updated_at', 'timestamp', 'updated_at', 0, 0, 0, 0, 0, 0, '', 4),
	(50, 6, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, '', 5),
	(51, 1, 'seo_title', 'text', 'seo_title', 0, 1, 1, 1, 1, 1, '', 14),
	(52, 1, 'featured', 'checkbox', 'featured', 1, 1, 1, 1, 1, 1, '', 15),
	(53, 3, 'role_id', 'text', 'role_id', 0, 1, 1, 1, 1, 1, NULL, 10),
	(54, 3, 'username', 'text', 'Username', 1, 1, 1, 1, 1, 1, NULL, 4),
	(55, 7, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
	(56, 7, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, NULL, 2),
	(57, 7, 'description', 'text_area', 'Description (max 250 characters)', 1, 1, 1, 1, 1, 1, NULL, 3),
	(58, 7, 'body', 'rich_text_box', 'Body', 1, 0, 1, 1, 1, 1, NULL, 4),
	(59, 7, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, NULL, 5),
	(60, 7, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 6),
	(61, 3, 'settings', 'hidden', 'Settings', 0, 1, 1, 1, 1, 1, NULL, 9),
	(62, 3, 'user_belongstomany_role_relationship', 'relationship', 'Roles', 0, 1, 1, 1, 1, 0, '{"model":"TCG\\\\Voyager\\\\Models\\\\Role","table":"roles","type":"belongsToMany","column":"id","key":"id","label":"name","pivot_table":"user_roles","pivot":"1"}', 11),
	(63, 3, 'locale', 'text', 'Locale', 0, 1, 1, 1, 1, 0, '', 12),
	(122, 9, 'id', 'number', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
	(123, 9, 'user_id', 'text', 'User Id', 1, 0, 1, 1, 1, 1, '{}', 2),
	(125, 9, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '{}', 3),
	(126, 9, 'seo_title', 'text', 'Seo Title', 0, 0, 1, 1, 1, 1, '{}', 4),
	(127, 9, 'excerpt', 'text', 'Excerpt', 0, 0, 1, 1, 1, 1, '{}', 5),
	(128, 9, 'body', 'rich_text_box', 'Body', 1, 0, 1, 1, 1, 1, '{}', 6),
	(129, 9, 'image', 'media_picker', 'Image', 0, 1, 1, 1, 1, 1, '{"max":1,"min":0,"expanded":true,"show_folders":true,"show_toolbar":true,"allow_upload":true,"allow_move":false,"allow_delete":false,"allow_create_folder":false,"allow_rename":false,"allow_crop":true,"allowed":["image\\/jpeg","image\\/png"],"show_as_images":true,"hide_thumbnails":false,"quality":70,"upsize":true,"thumbnails":[{"type":"resize","name":"resize-500","width":"500"}]}', 9),
	(130, 9, 'slug', 'text', 'Slug', 1, 0, 1, 1, 1, 1, '{"slugify":{"origin":"title","forceUpdate":true}}', 10),
	(131, 9, 'meta_description', 'text', 'Meta Description', 0, 0, 1, 1, 1, 1, '{}', 13),
	(132, 9, 'meta_keywords', 'text', 'Meta Keywords', 0, 0, 1, 1, 1, 1, '{}', 14),
	(133, 9, 'status', 'select_dropdown', 'Status', 1, 1, 1, 1, 1, 1, '{"default":"DRAFT","options":{"PUBLISHED":"published","DRAFT":"draft","PENDING":"pending"}}', 15),
	(134, 9, 'featured', 'checkbox', 'Featured', 1, 0, 1, 1, 1, 1, '{}', 16),
	(135, 9, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 17),
	(136, 9, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 18),
	(137, 9, 'acty_hasmany_category_relationship', 'relationship', 'categories', 0, 0, 1, 1, 1, 1, '{"foreign_pivot_key":"actie_id","related_pivot_key":"category_id","parent_key":"id","model":"Wave\\\\Category","table":"categories","type":"belongsToMany","column":"id","key":"id","label":"name","pivot_table":"actie_category","pivot":"1","taggable":"0"}', 19),
	(139, 9, 'time_start', 'timestamp', 'Time Start', 1, 1, 1, 1, 1, 1, '{}', 7),
	(140, 9, 'time_end', 'timestamp', 'Time End', 1, 0, 1, 1, 1, 1, '{}', 8),
	(142, 9, 'location_human', 'text', 'Location Human', 1, 0, 1, 1, 1, 1, '{}', 12),
	(145, 9, 'location', 'coordinates', 'Location', 0, 0, 1, 1, 1, 1, '{}', 11),
	(146, 12, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
	(147, 12, 'order', 'text', 'Order', 1, 1, 1, 1, 1, 1, '{"default":1}', 2),
	(148, 12, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 3),
	(149, 12, 'slug', 'text', 'Slug', 1, 1, 1, 1, 1, 1, '{"slugify":{"origin":"name"}}', 4),
	(150, 12, 'color', 'text', 'Color', 1, 1, 1, 1, 1, 1, '{}', 5),
	(151, 12, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 6),
	(152, 12, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
	(153, 9, 'acty_hasmany_actie_theme_relationship', 'relationship', 'themes', 0, 1, 1, 1, 1, 1, '{"foreign_pivot_key":"actie_id","related_pivot_key":"actie_theme_id","parent_key":"id","model":"Wave\\\\ActieTheme","table":"actie_themes","type":"belongsToMany","column":"id","key":"id","label":"name","pivot_table":"actie_actie_theme","pivot":"1","taggable":"0"}', 19),
	(154, 9, 'externe_link', 'text', 'Externe Link', 1, 0, 1, 1, 1, 1, '{}', 7),
	(155, 14, 'id', 'number', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
	(156, 14, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
	(157, 14, 'description', 'rich_text_box', 'Description', 1, 1, 1, 1, 1, 1, '{}', 3),
	(158, 14, 'website', 'text', 'Website', 1, 1, 1, 1, 1, 1, '{}', 4),
	(159, 14, 'logo', 'media_picker', 'Logo', 0, 1, 1, 1, 1, 1, '{"max":1,"min":1,"expanded":true,"show_folders":true,"show_toolbar":true,"allow_upload":true,"allow_move":false,"allow_delete":false,"allow_create_folder":false,"allow_rename":false,"allow_crop":true,"allowed":["image\\/jpeg","image\\/png"],"show_as_images":true,"hide_thumbnails":false,"quality":70,"upsize":true,"thumbnails":[{"type":"resize","name":"resize-500","width":"500"}]}', 5),
	(160, 14, 'slug', 'text', 'Slug', 1, 1, 1, 1, 1, 1, '{"slugify":{"origin":"name","forceUpdate":true}}', 6),
	(161, 14, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 7),
	(162, 14, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8),
	(163, 9, 'acty_belongstomany_organizer_relationship', 'relationship', 'organizers', 1, 1, 1, 1, 1, 1, '{"model":"Wave\\\\Organizer","table":"organizers","type":"belongsToMany","column":"id","key":"id","label":"name","pivot_table":"actie_organizer","pivot":"1","taggable":"0"}', 20),
	(176, 21, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
	(177, 21, 'user_id', 'text', 'User Id', 1, 0, 1, 1, 1, 1, '{}', 2),
	(178, 21, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '{}', 3),
	(179, 21, 'body', 'rich_text_box', 'Body', 1, 0, 1, 1, 1, 1, '{}', 4),
	(180, 21, 'externe_link', 'text', 'Externe Link', 1, 0, 1, 1, 1, 1, '{}', 5),
	(181, 21, 'time_start', 'timestamp', 'Time Start', 1, 1, 1, 1, 1, 1, '{}', 6),
	(182, 21, 'time_end', 'timestamp', 'Time End', 1, 0, 1, 1, 1, 1, '{}', 7),
	(183, 21, 'location', 'text', 'Location', 0, 0, 1, 1, 1, 1, '{}', 8),
	(184, 21, 'location_human', 'text', 'Location Human', 1, 0, 1, 1, 1, 1, '{}', 9),
	(185, 21, 'image', 'text', 'Image', 0, 0, 1, 1, 1, 1, '{}', 10),
	(186, 21, 'status', 'text', 'Status', 1, 1, 1, 1, 1, 1, '{"default":"PENDING","options":{"PENDING":"pending","APPROVED":"approved","REJECTED":"rejected"}}', 11),
	(187, 21, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 12),
	(188, 21, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 13),
	(189, 21, 'aanmeldingen_belongsto_user_relationship', 'relationship', 'users', 0, 1, 1, 1, 1, 1, '{"model":"Wave\\\\User","table":"users","type":"belongsTo","column":"user_id","key":"id","label":"name","pivot_table":"aanmeldingen","pivot":"0","taggable":"0"}', 14);
/*!40000 ALTER TABLE `data_rows` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.data_types
DROP TABLE IF EXISTS `data_types`;
CREATE TABLE IF NOT EXISTS `data_types` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT '0',
  `server_side` tinyint NOT NULL DEFAULT '0',
  `details` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_types_name_unique` (`name`),
  UNIQUE KEY `data_types_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.data_types: ~12 rows (approximately)
/*!40000 ALTER TABLE `data_types` DISABLE KEYS */;
INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
	(1, 'posts', 'posts', 'Post', 'Posts', 'voyager-news', 'TCG\\Voyager\\Models\\Post', 'TCG\\Voyager\\Policies\\PostPolicy', NULL, 'This database contains posts.', 1, 0, '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}', '2017-11-21 16:23:22', '2021-11-24 15:57:47'),
	(2, 'pages', 'pages', 'Page', 'Pages', 'voyager-file-text', 'TCG\\Voyager\\Models\\Page', NULL, NULL, NULL, 1, 0, '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}', '2017-11-21 16:23:22', '2022-01-18 21:13:45'),
	(3, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', NULL, NULL, 1, 0, '{"order_column":null,"order_display_column":null}', '2017-11-21 16:23:22', '2018-06-22 20:29:47'),
	(4, 'categories', 'categories', 'Category', 'Categories', 'voyager-categories', 'Wave\\Category', NULL, NULL, NULL, 1, 0, '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}', '2017-11-21 16:23:22', '2021-12-06 11:11:11'),
	(5, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2017-11-21 16:23:22', '2017-11-21 16:23:22'),
	(6, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController', '', 1, 0, NULL, '2017-11-21 16:23:22', '2017-11-21 16:23:22'),
	(7, 'announcements', 'announcements', 'Announcement', 'Announcements', 'voyager-megaphone', 'Wave\\Announcement', NULL, NULL, NULL, 1, 0, NULL, '2018-05-20 21:08:14', '2018-05-20 21:08:14'),
	(9, 'acties', 'acties', 'Actie', 'Acties', 'voyager-exclamation', 'Wave\\Actie', NULL, 'Wave\\Http\\Controllers\\ActieController', 'This is the database table for events', 1, 0, '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}', '2021-11-24 16:23:01', '2022-01-03 16:38:36'),
	(12, 'actie_themes', 'actie-themes', 'Actie Theme', 'Actie Themes', NULL, 'Wave\\ActieTheme', NULL, NULL, NULL, 1, 0, '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}', '2021-12-18 16:24:23', '2021-12-18 16:24:23'),
	(14, 'organizers', 'organizers', 'Organizer', 'Organizers', 'voyager-pirate', 'Wave\\Organizer', NULL, NULL, NULL, 1, 0, '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}', '2022-01-03 15:53:00', '2022-01-03 15:53:00'),
	(21, 'aanmeldingen', 'aanmeldingen', 'Aanmelding', 'Aanmeldingen', 'voyager-question', 'Wave\\Aanmelding', NULL, NULL, NULL, 1, 0, '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}', '2022-01-19 15:46:35', '2022-01-19 15:51:49');
/*!40000 ALTER TABLE `data_types` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.jobs
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.menus
DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.menus: ~1 rows (approximately)
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '2017-11-21 16:23:22', '2017-11-21 16:23:22');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.menu_items
DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.menu_items: ~21 rows (approximately)
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
	(2, 1, 'Media', '', '_self', 'voyager-images', NULL, NULL, 3, '2017-11-21 16:23:22', '2022-01-03 15:53:16', 'voyager.media.index', NULL),
	(3, 1, 'Posts', '', '_self', 'voyager-news', NULL, NULL, 4, '2017-11-21 16:23:22', '2022-01-03 15:53:16', 'voyager.posts.index', NULL),
	(4, 1, 'Users', '', '_self', 'voyager-person', NULL, 37, 1, '2017-11-21 16:23:22', '2021-12-20 12:56:09', 'voyager.users.index', NULL),
	(5, 1, 'Categories', '', '_self', 'voyager-categories', NULL, 38, 3, '2017-11-21 16:23:22', '2022-01-19 15:49:14', 'voyager.categories.index', NULL),
	(6, 1, 'Pages', '', '_self', 'voyager-file-text', NULL, NULL, 5, '2017-11-21 16:23:22', '2022-01-03 15:53:16', 'voyager.pages.index', NULL),
	(7, 1, 'Roles', '', '_self', 'voyager-lock', NULL, 37, 2, '2017-11-21 16:23:22', '2021-12-20 12:56:14', 'voyager.roles.index', NULL),
	(8, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 7, '2017-11-21 16:23:22', '2022-01-03 15:53:16', NULL, NULL),
	(9, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 8, 1, '2017-11-21 16:23:22', '2018-05-20 21:08:37', 'voyager.menus.index', NULL),
	(10, 1, 'Database', '', '_self', 'voyager-data', NULL, 8, 2, '2017-11-21 16:23:22', '2018-05-20 21:08:37', 'voyager.database.index', NULL),
	(11, 1, 'Compass', '/admin/compass', '_self', 'voyager-compass', NULL, 8, 3, '2017-11-21 16:23:22', '2018-05-20 21:08:37', NULL, NULL),
	(12, 1, 'Hooks', '/admin/hooks', '_self', 'voyager-hook', '#000000', 8, 5, '2017-11-21 16:23:22', '2018-06-22 20:55:55', NULL, ''),
	(13, 1, 'Settings', '', '_self', 'voyager-settings', NULL, 8, 6, '2017-11-21 16:23:22', '2021-12-20 12:58:31', 'voyager.settings.index', NULL),
	(14, 1, 'Themes', '/admin/themes', '_self', 'voyager-paint-bucket', NULL, 8, 7, '2017-11-21 16:31:00', '2021-12-20 12:58:32', NULL, NULL),
	(30, 1, 'Announcements', '/admin/announcements', '_self', 'voyager-megaphone', NULL, NULL, 6, '2018-05-20 21:08:14', '2022-01-03 15:53:16', NULL, NULL),
	(31, 1, 'BREAD', '', '_self', 'voyager-bread', '#000000', 8, 4, '2018-06-22 20:53:25', '2018-06-22 20:54:13', 'voyager.bread.index', NULL),
	(34, 1, 'Acties', '', '_self', 'voyager-exclamation', '#000000', 38, 2, '2021-11-24 16:23:01', '2022-01-19 15:49:14', 'voyager.acties.index', 'null'),
	(36, 1, 'Actie Themes', '', '_self', 'voyager-bubble-hear', '#000000', 38, 4, '2021-12-18 16:24:23', '2022-01-19 15:49:14', 'voyager.actie-themes.index', 'null'),
	(37, 1, 'Accounts', '', '_self', 'voyager-people', '#000000', NULL, 2, '2021-12-20 12:55:52', '2022-01-03 15:53:16', NULL, ''),
	(38, 1, 'Acties & Organisatoren', '', '_self', 'voyager-exclamation', '#000000', NULL, 1, '2021-12-20 12:56:41', '2022-01-03 15:53:16', NULL, ''),
	(39, 1, 'Organizers', '', '_self', 'voyager-pirate', NULL, 38, 5, '2022-01-03 15:53:00', '2022-01-19 15:49:14', 'voyager.organizers.index', NULL),
	(44, 1, 'Aanmeldingen', '', '_self', 'voyager-question', NULL, 38, 1, '2022-01-19 15:46:35', '2022-01-19 15:49:14', 'voyager.aanmeldingen.index', NULL);
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.migrations: ~50 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2016_01_01_000000_add_voyager_user_fields', 1),
	(4, '2016_01_01_000000_create_data_types_table', 1),
	(5, '2016_01_01_000000_create_pages_table', 1),
	(6, '2016_01_01_000000_create_posts_table', 1),
	(7, '2016_02_15_204651_create_categories_table', 1),
	(8, '2016_05_19_173453_create_menu_table', 1),
	(9, '2016_10_21_190000_create_roles_table', 1),
	(10, '2016_10_21_190000_create_settings_table', 1),
	(11, '2016_11_30_135954_create_permission_table', 1),
	(12, '2016_11_30_141208_create_permission_role_table', 1),
	(13, '2016_12_26_201236_data_types__add__server_side', 1),
	(14, '2017_01_13_000000_add_route_to_menu_items_table', 1),
	(15, '2017_01_14_005015_create_translations_table', 1),
	(16, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1),
	(17, '2017_03_06_000000_add_controller_to_data_types_table', 1),
	(18, '2017_04_11_000000_alter_post_nullable_fields_table', 1),
	(19, '2017_04_21_000000_add_order_to_data_rows_table', 1),
	(20, '2017_07_05_210000_add_policyname_to_data_types_table', 1),
	(21, '2017_08_05_000000_add_group_to_settings_table', 1),
	(22, '2017_11_26_013050_add_user_role_relationship', 1),
	(23, '2017_11_26_015000_create_user_roles_table', 1),
	(24, '2018_03_11_000000_add_user_settings', 1),
	(25, '2018_03_14_000000_add_details_to_data_types_table', 1),
	(26, '2018_03_16_000000_make_settings_value_nullable', 1),
	(27, '2018_09_22_234251_add_permissions_group_id_to_permissions_table', 1),
	(28, '2018_09_22_234251_add_username_billing_to_users', 1),
	(29, '2018_09_22_234251_create_announcement_user_table', 1),
	(30, '2018_09_22_234251_create_announcements_table', 1),
	(31, '2018_09_22_234251_create_api_keys_table', 1),
	(32, '2018_09_22_234251_create_notifications_table', 1),
	(33, '2018_09_22_234251_create_permission_groups_table', 1),
	(34, '2018_09_22_234251_create_plans_table', 1),
	(35, '2018_09_22_234251_create_subscriptions_table', 1),
	(36, '2018_09_22_234251_create_voyager_theme_options_table', 1),
	(37, '2018_09_22_234251_create_voyager_themes_table', 1),
	(38, '2018_09_22_234251_create_wave_key_values_table', 1),
	(39, '2018_09_22_234252_add_foreign_keys_to_announcement_user_table', 1),
	(40, '2018_09_22_234252_add_foreign_keys_to_plans_table', 1),
	(41, '2020_03_30_032031_change_voyager_themes_table_name', 1),
	(42, '2020_04_22_234252_add_foreign_keys_to_voyager_theme_options_table', 1),
	(43, '2020_06_23_210721_add_stripe_status_column_to_subscriptions_table', 1),
	(44, '2020_07_03_000003_create_subscription_items_table', 1),
	(53, '2021_01_28_041011_create_paddle_subscriptions_table', 2),
	(54, '2021_01_28_182638_removing_cashier_sub_tables', 3),
	(55, '2021_01_29_173720_add_slug_column_to_plans_table', 4),
	(59, '2021_12_06_104517_create_acties_table', 5),
	(60, '2021_12_06_135054_create_actie_category_table', 5),
	(61, '2021_12_06_135055_add_foreign_keys_to_actie_category_table', 5),
	(62, '2021_12_14_100458_create_jobs_table', 6),
	(63, '2021_12_18_171000_create_actie_themes_table', 7),
	(64, '2021_12_18_171400_create_actie_actie_theme_table', 7),
	(65, '2022_01_03_104517_create_organizers_table', 8),
	(66, '2022_01_03_114517_create_actie_organizer_table', 9),
	(67, '2022_01_19_104500_create_aanmeldingen_table', 10);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.notifications
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int unsigned NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.notifications: ~1 rows (approximately)
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.organizers
DROP TABLE IF EXISTS `organizers`;
CREATE TABLE IF NOT EXISTS `organizers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `organizers_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.organizers: ~3 rows (approximately)
/*!40000 ALTER TABLE `organizers` DISABLE KEYS */;
INSERT INTO `organizers` (`id`, `name`, `description`, `website`, `logo`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Greenpeace', '<p>This is a description for Greenpeace.</p>', 'https://greenpeace.com', 'organizers/greenpeace_logo.jpg', 'greenpeace', '2022-01-03 15:57:37', '2022-01-03 15:57:37'),
	(2, 'Nederland Wordt Beter', '<p>Dit is een beschrijving van Nederland Wordt Beter.</p>', 'https://nederlandwordtbeter.nl/', 'organizers/nwb_logo.jpg', 'nederland-wordt-beter', '2022-01-03 16:26:11', '2022-01-03 16:26:11'),
	(3, 'Kick Out Zwarte Piet', '<p>Dit is een beschrijving van Kick Out Zwarte Piet.</p>', 'https://kozwartepiet.nl/', 'organizers/kozp_logo.jpg', 'kick-out-zwarte-piet', '2022-01-03 16:41:14', '2022-01-03 16:41:14');
/*!40000 ALTER TABLE `organizers` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.pages
DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.pages: ~1 rows (approximately)
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`id`, `author_id`, `title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
	(2, 1, 'Over ons', 'This is the about page.', '<p><em><span style="font-weight: 400;">Watkanikdoen </span></em><span style="font-weight: 400;">is een onafhankelijk platform waarop alle initiatieven te vinden zijn, die zich inzetten voor een eerlijke, inclusieve en duurzame wereld, die in Nederland georganiseerd worden en die burgers inspireren om in actie te komen. Alle demonstraties, stakingen, inzamelacties, petities, meet-ups, marsen en sit-ins zijn voortaan in &eacute;&eacute;n oogopslag bij elkaar te vinden. </span><em><span style="font-weight: 400;">Watkanikdoen</span></em><span style="font-weight: 400;"> zet zich in voor een sterke en actieve democratie met &eacute;&eacute;n helder doel: het bevorderen van een inclusieve, eerlijke en duurzame samenleving door het stimuleren van actief burgerschap. Wij richten ons hierbij op de (potenti&euml;le) actievoerder tussen de 18 en 28 jaar.&nbsp;</span></p>\n<p><span style="font-weight: 400;"><img title="Image of a demonstration" src="http://localhost:8000/storage/pages/January2022/pexels-markus-spiske-2990644.jpg" alt="Image of a demonstration" width="900" height="600" /></span></p>\n<h2><span style="font-weight: 400;">Missie</span></h2>\n<p><span style="font-weight: 400;">De missie van </span><em><span style="font-weight: 400;">watkanikdoen</span></em><span style="font-weight: 400;"> is het bevorderen van een inclusieve, eerlijke en duurzame samenleving. Inclusief omdat wij vinden dat iedereen mee moet kunnen komen. Eerlijk omdat wij geloven in gelijke kansen en openheid van zaken. En duurzaam omdat wij waarde hechten aan de generaties na ons.&nbsp;</span></p>\n<p><span style="font-weight: 400;">Het team van </span><em><span style="font-weight: 400;">watkanikdoen</span></em><span style="font-weight: 400;"> is optimistisch als het gaat over de toekomst; wij zien veel welwillendheid bij Nederlandse burgers om te staan voor de goede zaak en daarvoor de regen te trotseren als dat nodig is. Wij willen die betrokkenheid stimuleren, want alleen als een democratie goed functioneert, wordt een samenleving inclusiever, eerlijker en duurzamer. Onze tijd kent uiteenlopende maatschappelijke uitdagingen. Van klimaatverandering tot lerarentekorten en van te lage salarissen in de zorgsector tot institutioneel racisme. Ieder onderwerp vraagt om een eigen benadering en aandacht maar ze hebben &eacute;&eacute;n gemene deler: ze worden het best aangepakt door een actieve deelname van burgers.&nbsp;</span></p>\n<p><span style="font-weight: 400;">Democratie is niet vanzelfsprekend en moet actief worden onderhouden; een sterke democratie vraagt om actief burgerschap. Er worden in Nederland dan ook talloze acties georganiseerd in de vorm van bijvoorbeeld demonstraties, stakingen en petities. Waar </span><em><span style="font-weight: 400;">watkanikdoen</span></em><span style="font-weight: 400;"> voor staat is om deze acties kracht bij te zetten en het bereik ervan te vergroten om zo bij te dragen aan een progressief klimaat.&nbsp;</span></p>\n<h2><span style="font-weight: 400;">Visie</span></h2>\n<p><span style="font-weight: 400;">Actief burgerschap klinkt goed, maar hoe wordt iemand een actieve burger? Wat kan je doen om je in te zetten? Om die vraag te beantwoorden speelt informatievoorziening een primaire rol. Informatie over hoe zet ik me in voor een progressief doel en waar moet ik zijn om dat te realiseren? Voordat een potenti&euml;le actievoerder de stap zet naar het demonstratieveld moet diegene allereerst op de hoogte zijn van wat er speelt en wat er te doen is. De mogelijkheid om informatie in te winnen is eindeloos, je moet echter wel de </span><em><span style="font-weight: 400;">juiste </span></em><span style="font-weight: 400;">informatie zien te vinden. </span><em><span style="font-weight: 400;">Watkanikdoen</span></em><span style="font-weight: 400;"> komt hieraan tegemoet door &eacute;&eacute;n overzicht te bieden van alle acties die worden georganiseerd en gebruikers daar bovendien actief over op de hoogte te houden.</span></p>\n<p><em><span style="font-weight: 400;">Watkanikdoen</span></em><span style="font-weight: 400;"> onderscheidt zich door zich niet voor &eacute;&eacute;n specifiek thema in te zetten, maar een platform te bieden aan alle acties met een progressief doeleinde. Onze overtuiging is dat de uitdagingen waar onze samenleving voor staat niet los van elkaar te zien zijn, maar onderdeel zijn van hetzelfde systeem. Dit is terug te zien in de diversiteit aan thema&rsquo;s van de acties waaraan </span><em><span style="font-weight: 400;">watkanikdoen</span></em><span style="font-weight: 400;"> een platform biedt, alsmede in de samenwerkingen die wij aangaan en het netwerk van organisatoren waar wij als verbinder een rol in willen spelen.</span></p>', NULL, 'over-ons', 'Over Wat Kan Ik Doen', 'about', 'ACTIVE', '2018-03-30 03:04:51', '2022-01-18 21:32:01'),
	(3, 1, 'Privacybeleid', 'Privacybeleid.', '<p>Dit is het privacybeleid.</p>\n<p>&nbsp;</p>', NULL, 'privacybeleid', 'privacybeleid', 'privacy', 'ACTIVE', '2022-01-05 10:18:41', '2022-01-18 21:25:02'),
	(4, 1, 'Contact', 'Dit is de contactpagina.', '<p>Dit is de contactpagina.</p>', NULL, 'contact', 'contact', 'contact', 'ACTIVE', '2022-01-11 09:53:31', '2022-01-11 09:53:31');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('kamiel.verhelst@gmail.com', '$2y$10$hg1lo.yO6QTE1XUdlZUZfu74UsX40xYm.Yw4XK7AIgdzOGynPJnjq', '2021-11-28 14:59:59');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission_group_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.permissions: ~72 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`, `permission_group_id`) VALUES
	(1, 'browse_admin', NULL, '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(2, 'browse_bread', NULL, '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(3, 'browse_database', NULL, '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(4, 'browse_media', NULL, '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(5, 'browse_compass', NULL, '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(6, 'browse_menus', 'menus', '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(7, 'read_menus', 'menus', '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(8, 'edit_menus', 'menus', '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(9, 'add_menus', 'menus', '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(10, 'delete_menus', 'menus', '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(11, 'browse_roles', 'roles', '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(12, 'read_roles', 'roles', '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(13, 'edit_roles', 'roles', '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(14, 'add_roles', 'roles', '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(15, 'delete_roles', 'roles', '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(16, 'browse_users', 'users', '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(17, 'read_users', 'users', '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(18, 'edit_users', 'users', '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(19, 'add_users', 'users', '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(20, 'delete_users', 'users', '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(21, 'browse_settings', 'settings', '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(22, 'read_settings', 'settings', '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(23, 'edit_settings', 'settings', '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(24, 'add_settings', 'settings', '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(25, 'delete_settings', 'settings', '2018-06-22 20:15:45', '2018-06-22 20:15:45', NULL),
	(26, 'browse_categories', 'categories', '2018-06-22 20:15:46', '2018-06-22 20:15:46', NULL),
	(27, 'read_categories', 'categories', '2018-06-22 20:15:46', '2018-06-22 20:15:46', NULL),
	(28, 'edit_categories', 'categories', '2018-06-22 20:15:46', '2018-06-22 20:15:46', NULL),
	(29, 'add_categories', 'categories', '2018-06-22 20:15:46', '2018-06-22 20:15:46', NULL),
	(30, 'delete_categories', 'categories', '2018-06-22 20:15:46', '2018-06-22 20:15:46', NULL),
	(31, 'browse_posts', 'posts', '2018-06-22 20:15:46', '2018-06-22 20:15:46', NULL),
	(32, 'read_posts', 'posts', '2018-06-22 20:15:46', '2018-06-22 20:15:46', NULL),
	(33, 'edit_posts', 'posts', '2018-06-22 20:15:46', '2018-06-22 20:15:46', NULL),
	(34, 'add_posts', 'posts', '2018-06-22 20:15:46', '2018-06-22 20:15:46', NULL),
	(35, 'delete_posts', 'posts', '2018-06-22 20:15:46', '2018-06-22 20:15:46', NULL),
	(36, 'browse_pages', 'pages', '2018-06-22 20:15:46', '2018-06-22 20:15:46', NULL),
	(37, 'read_pages', 'pages', '2018-06-22 20:15:46', '2018-06-22 20:15:46', NULL),
	(38, 'edit_pages', 'pages', '2018-06-22 20:15:46', '2018-06-22 20:15:46', NULL),
	(39, 'add_pages', 'pages', '2018-06-22 20:15:46', '2018-06-22 20:15:46', NULL),
	(40, 'delete_pages', 'pages', '2018-06-22 20:15:46', '2018-06-22 20:15:46', NULL),
	(41, 'browse_hooks', NULL, '2018-06-22 20:15:46', '2018-06-22 20:15:46', NULL),
	(42, 'browse_announcements', 'announcements', '2018-05-20 21:08:14', '2018-05-20 21:08:14', NULL),
	(43, 'read_announcements', 'announcements', '2018-05-20 21:08:14', '2018-05-20 21:08:14', NULL),
	(44, 'edit_announcements', 'announcements', '2018-05-20 21:08:14', '2018-05-20 21:08:14', NULL),
	(45, 'add_announcements', 'announcements', '2018-05-20 21:08:14', '2018-05-20 21:08:14', NULL),
	(46, 'delete_announcements', 'announcements', '2018-05-20 21:08:14', '2018-05-20 21:08:14', NULL),
	(47, 'browse_themes', 'admin', '2017-11-21 16:31:00', '2017-11-21 16:31:00', NULL),
	(48, 'browse_hooks', 'hooks', '2018-06-22 13:55:03', '2018-06-22 13:55:03', NULL),
	(49, 'read_hooks', 'hooks', '2018-06-22 13:55:03', '2018-06-22 13:55:03', NULL),
	(50, 'edit_hooks', 'hooks', '2018-06-22 13:55:03', '2018-06-22 13:55:03', NULL),
	(51, 'add_hooks', 'hooks', '2018-06-22 13:55:03', '2018-06-22 13:55:03', NULL),
	(52, 'delete_hooks', 'hooks', '2018-06-22 13:55:03', '2018-06-22 13:55:03', NULL),
	(53, 'browse_plans', 'plans', '2018-07-03 04:50:28', '2018-07-03 04:50:28', NULL),
	(54, 'read_plans', 'plans', '2018-07-03 04:50:28', '2018-07-03 04:50:28', NULL),
	(55, 'edit_plans', 'plans', '2018-07-03 04:50:28', '2018-07-03 04:50:28', NULL),
	(56, 'add_plans', 'plans', '2018-07-03 04:50:28', '2018-07-03 04:50:28', NULL),
	(57, 'delete_plans', 'plans', '2018-07-03 04:50:28', '2018-07-03 04:50:28', NULL),
	(58, 'browse_acties', 'acties', '2021-11-24 16:23:01', '2021-11-24 16:23:01', NULL),
	(59, 'read_acties', 'acties', '2021-11-24 16:23:01', '2021-11-24 16:23:01', NULL),
	(60, 'edit_acties', 'acties', '2021-11-24 16:23:01', '2021-11-24 16:23:01', NULL),
	(61, 'add_acties', 'acties', '2021-11-24 16:23:01', '2021-11-24 16:23:01', NULL),
	(62, 'delete_acties', 'acties', '2021-11-24 16:23:01', '2021-11-24 16:23:01', NULL),
	(68, 'browse_actie_themes', 'actie_themes', '2021-12-18 16:24:23', '2021-12-18 16:24:23', NULL),
	(69, 'read_actie_themes', 'actie_themes', '2021-12-18 16:24:23', '2021-12-18 16:24:23', NULL),
	(70, 'edit_actie_themes', 'actie_themes', '2021-12-18 16:24:23', '2021-12-18 16:24:23', NULL),
	(71, 'add_actie_themes', 'actie_themes', '2021-12-18 16:24:23', '2021-12-18 16:24:23', NULL),
	(72, 'delete_actie_themes', 'actie_themes', '2021-12-18 16:24:23', '2021-12-18 16:24:23', NULL),
	(73, 'browse_organizers', 'organizers', '2022-01-03 15:53:00', '2022-01-03 15:53:00', NULL),
	(74, 'read_organizers', 'organizers', '2022-01-03 15:53:00', '2022-01-03 15:53:00', NULL),
	(75, 'edit_organizers', 'organizers', '2022-01-03 15:53:00', '2022-01-03 15:53:00', NULL),
	(76, 'add_organizers', 'organizers', '2022-01-03 15:53:00', '2022-01-03 15:53:00', NULL),
	(77, 'delete_organizers', 'organizers', '2022-01-03 15:53:00', '2022-01-03 15:53:00', NULL),
	(98, 'browse_aanmeldingen', 'aanmeldingen', '2022-01-19 15:46:35', '2022-01-19 15:46:35', NULL),
	(99, 'read_aanmeldingen', 'aanmeldingen', '2022-01-19 15:46:35', '2022-01-19 15:46:35', NULL),
	(100, 'edit_aanmeldingen', 'aanmeldingen', '2022-01-19 15:46:35', '2022-01-19 15:46:35', NULL),
	(101, 'add_aanmeldingen', 'aanmeldingen', '2022-01-19 15:46:35', '2022-01-19 15:46:35', NULL),
	(102, 'delete_aanmeldingen', 'aanmeldingen', '2022-01-19 15:46:35', '2022-01-19 15:46:35', NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.permission_groups
DROP TABLE IF EXISTS `permission_groups`;
CREATE TABLE IF NOT EXISTS `permission_groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission_groups_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.permission_groups: ~0 rows (approximately)
/*!40000 ALTER TABLE `permission_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_groups` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.permission_role
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.permission_role: ~84 rows (approximately)
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(6, 3),
	(7, 1),
	(7, 3),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(16, 3),
	(17, 1),
	(17, 3),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(26, 3),
	(27, 1),
	(27, 3),
	(28, 1),
	(29, 1),
	(30, 1),
	(31, 1),
	(31, 3),
	(32, 1),
	(32, 3),
	(33, 1),
	(34, 1),
	(35, 1),
	(36, 1),
	(36, 3),
	(37, 1),
	(37, 3),
	(38, 1),
	(39, 1),
	(40, 1),
	(41, 1),
	(42, 1),
	(42, 3),
	(43, 1),
	(43, 3),
	(44, 1),
	(45, 1),
	(46, 1),
	(47, 1),
	(48, 1),
	(49, 1),
	(50, 1),
	(51, 1),
	(52, 1),
	(53, 1),
	(54, 1),
	(55, 1),
	(56, 1),
	(57, 1),
	(58, 1),
	(59, 1),
	(60, 1),
	(61, 1),
	(62, 1),
	(68, 1),
	(69, 1),
	(70, 1),
	(71, 1),
	(72, 1),
	(73, 1),
	(74, 1),
	(75, 1),
	(76, 1),
	(77, 1),
	(98, 1),
	(99, 1),
	(100, 1),
	(101, 1),
	(102, 1);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.posts
DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('PUBLISHED','DRAFT','PENDING') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.posts: ~7 rows (approximately)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `author_id`, `category_id`, `title`, `seo_title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `featured`, `created_at`, `updated_at`) VALUES
	(5, 1, 1, 'Best ways to market your application', 'Best ways to market your application', '', '<p>There are many different ways to market your application. First, let\'s start off at the beginning and then we will get more in-depth. You\'ll want to discover your target audience and after that, you\'ll want to run some ads.</p>\n<p>Let\'s not complicate things here, if you build a good product, you are going to have users. But you will need to let your users know where to find you. This is where social media and ads come in to play. You\'ll need to boast about your product and your app. If it\'s something that you really believe in, the odds are others will too.</p>\n<blockquote>\n<p>You may have a need to only want to make money from your application, but if your application can help others achieve a goal and you can make money from it too, you have a gold-mine.</p>\n</blockquote>\n<p>Some more info on your awesome post here. After this sentence, it\'s just going to be a little bit of jibberish. But you get a general idea. You\'ll want to blog about stuff to get your customers interested in your application. With leverage existing reliable initiatives before leveraged ideas. Rapidiously develops equity invested expertise rather than enabled channels. Monotonectally intermediate distinctive networks before highly efficient core competencies.</p>\n<h2>Seamlessly promote flexible growth strategies.</h2>\n<p><img src="/storage/posts/March2018/blog-1.jpg" alt="blog" /></p>\n<p>Dramatically harness extensive value through the fully researched human capital. Seamlessly transition premium schemas vis-a-vis efficient convergence. Intrinsically build competitive e-commerce with cross-unit information. Collaboratively e-enable real-time processes before extensive technology. Authoritatively fabricate efficient metrics through intuitive quality vectors.</p>\n<p>Collaboratively deliver optimal vortals whereas backward-compatible models. Globally syndicate diverse leadership rather than high-payoff experiences. Uniquely pontificate unique metrics for cross-media human capital. Completely procrastinate professional collaboration and idea-sharing rather than 24/365 paradigms. Phosfluorescently initiates multimedia based outsourcing for interoperable benefits.</p>\n<h3>Seamlessly promote flexible growth strategies.</h3>\n<p>Progressively leverage other\'s e-business functionalities through corporate e-markets. Holistic repurpose timely systems via seamless total linkage. Appropriately maximize impactful "outside the box" thinking vis-a-vis visionary value. Authoritatively deploy interdependent technology through process-centric "outside the box" thinking. Interactively negotiate pandemic internal or "organic" sources whereas competitive relationships.</p>\n<figure><img src="/storage/posts/March2018/blog-2.jpg" alt="wide" />\n<figcaption>Keep working until you find success.</figcaption>\n</figure>\n<p>Enthusiastically deliver viral potentialities through multidisciplinary products. Synergistically plagiarize client-focused partnerships for adaptive applications. Seamlessly morph process-centric synergy whereas bricks-and-clicks deliverables. Continually disintermediate holistic action items without distinctive customer service. Enthusiastically seize enterprise web-readiness without effective schemas.</p>\n<h4>Seamlessly promote flexible growth strategies.</h4>\n<p>Assertively restore installed base data before sustainable platforms. Globally recapitalize orthogonal systems via clicks-and-mortar web services. Efficiently grow visionary action items through collaborative e-commerce. Efficiently architect highly efficient "outside the box" thinking before customer directed infomediaries. Proactively mesh holistic human capital rather than exceptional niches.</p>\n<p>Intrinsically create innovative value and pandemic resources. Progressively productize turnkey e-markets and economically sound synergy. Objectively supply turnkey imperatives vis-a-vis high standards in outsourcing. Dynamically exploit unique imperatives with dynamic systems. Appropriately formulate technically sound users and excellent expertise.</p>\n<p>Competently redefine long-term high-impact relationships rather than effective metrics. Distinctively maintain impactful platforms after strategic imperatives. Intrinsically evolve mission-critical deliverables after multimedia based e-business. Interactively mesh cooperative benefits whereas distributed process improvements. Progressively monetize an expanded array of e-services whereas.</p>', 'posts/March2018/h86hSqPMkT9oU8pjcrSu.jpg', 'best-ways-to-market-your-application', 'Find out the best ways to market your application in this article.', 'market, saas, market your app', 'PUBLISHED', 0, '2018-03-26 02:55:01', '2021-11-30 12:39:16'),
	(6, 1, 1, 'Achieving your Dreams', 'Achieving your Dreams', NULL, '<p>What can be said about achieving your dreams? <br>Well... It\'s a good thing, and it\'s probably something you\'re dreaming of. Oh yeah, when you create an app and a product that you enjoy working on... You\'ll be pretty happy and your dreams will probably come true. Cool, right?</p>\n<p>I hope that you are ready for some cool stuff because there is some cool stuff right around the corner. By the time you\'ve reached the sky, you\'ll realize your true limits. That last sentence there... That was a little bit of jibberish, but I\'m trying to write about something cool. Bottom line is that Wave is going to help save you so much time.</p>\n<blockquote>\n<p>You may have a need to only want to make money from your application, but if your application can help others achieve a goal and you can make money from it too, you have a gold-mine.</p>\n</blockquote>\n<p>Some more info on your awesome post here. After this sentence, it\'s just going to be a little bit of jibberish. But you get a general idea. You\'ll want to blog about stuff to get your customers interested in your application. With leverage existing reliable initiatives before leveraged ideas. Rapidiously develops equity invested expertise rather than enabled channels. Monotonectally intermediate distinctive networks before highly efficient core competencies.</p>\n<h2>Seamlessly promote flexible growth strategies.</h2>\n<p><img src="/storage/posts/March2018/blog-1.jpg" alt="blog" /></p><p>Dramatically harness extensive value through the fully researched human capital. Seamlessly transition premium schemas vis-a-vis efficient convergence. Intrinsically build competitive e-commerce with cross-unit information. Collaboratively e-enable real-time processes before extensive technology. Authoritatively fabricate efficient metrics through intuitive quality vectors.</p>\n<p>Collaboratively deliver optimal vortals whereas backward-compatible models. Globally syndicate diverse leadership rather than high-payoff experiences. Uniquely pontificate unique metrics for cross-media human capital. Completely procrastinate professional collaboration and idea-sharing rather than 24/365 paradigms. Phosfluorescently initiates multimedia based outsourcing for interoperable benefits.</p>\n<h3>Seamlessly promote flexible growth strategies.</h3>\n<p>Progressively leverage other\'s e-business functionalities through corporate e-markets. Holistic repurpose timely systems via seamless total linkage. Appropriately maximize impactful "outside the box" thinking vis-a-vis visionary value. Authoritatively deploy interdependent technology through process-centric "outside the box" thinking. Interactively negotiate pandemic internal or "organic" sources whereas competitive relationships.</p>\n<figure><img src="/storage/posts/March2018/blog-2.jpg" alt="wide" />\n<figcaption>Keep working until you find success.</figcaption>\n</figure>\n<p>Enthusiastically deliver viral potentialities through multidisciplinary products. Synergistically plagiarize client-focused partnerships for adaptive applications. Seamlessly morph process-centric synergy whereas bricks-and-clicks deliverables. Continually disintermediate holistic action items without distinctive customer service. Enthusiastically seize enterprise web-readiness without effective schemas.</p>\n<h4>Seamlessly promote flexible growth strategies.</h4>\n<p>Assertively restore installed base data before sustainable platforms. Globally recapitalize orthogonal systems via clicks-and-mortar web services. Efficiently grow visionary action items through collaborative e-commerce. Efficiently architect highly efficient "outside the box" thinking before customer directed infomediaries. Proactively mesh holistic human capital rather than exceptional niches.</p>\n<p>Intrinsically create innovative value and pandemic resources. Progressively productize turnkey e-markets and economically sound synergy. Objectively supply turnkey imperatives vis-a-vis high standards in outsourcing. Dynamically exploit unique imperatives with dynamic systems. Appropriately formulate technically sound users and excellent expertise.</p>\n<p>Competently redefine long-term high-impact relationships rather than effective metrics. Distinctively maintain impactful platforms after strategic imperatives. Intrinsically evolve mission-critical deliverables after multimedia based e-business. Interactively mesh cooperative benefits whereas distributed process improvements. Progressively monetize an expanded array of e-services whereas.</p>', 'posts/March2018/rU26aWVsZ2zocWGSTE7J.jpg', 'achieving-your-dreams', 'In this post, you\'ll learn about achieving your dreams by building the SAAS app of your dreams', 'saas app, dreams', 'PUBLISHED', 0, '2018-03-26 02:50:18', '2018-03-26 02:15:18'),
	(7, 1, 1, 'Building a solid foundation', 'Building a solid foundation', NULL, '<p>The foundation is one of the most important aspects. You\'ll want to make sure that you build your application on a solid foundation because this is where every other feature will grow on top of.</p>\n<p>If the foundation is unstable the rest of the application will be so as well. But a solid foundation will make mediocre features seem amazing. So, if you want to save yourself some time you will build your application on a solid foundation of cool features, awesome jumps, and killer waves... I don\'t know what this paragraph is about anymore.</p>\n<blockquote>\n<p>You may have a need to only want to make money from your application, but if your application can help others achieve a goal and you can make money from it too, you have a gold-mine.</p>\n</blockquote>\n<p>Some more info on your awesome post here. After this sentence, it\'s just going to be a little bit of jibberish. But you get a general idea. You\'ll want to blog about stuff to get your customers interested in your application. With leverage existing reliable initiatives before leveraged ideas. Rapidiously develops equity invested expertise rather than enabled channels. Monotonectally intermediate distinctive networks before highly efficient core competencies.</p>\n<h2>Seamlessly promote flexible growth strategies.</h2>\n<p><img src="/storage/posts/March2018/blog-1.jpg" alt="blog" /></p><p>Dramatically harness extensive value through the fully researched human capital. Seamlessly transition premium schemas vis-a-vis efficient convergence. Intrinsically build competitive e-commerce with cross-unit information. Collaboratively e-enable real-time processes before extensive technology. Authoritatively fabricate efficient metrics through intuitive quality vectors.</p>\n<p>Collaboratively deliver optimal vortals whereas backward-compatible models. Globally syndicate diverse leadership rather than high-payoff experiences. Uniquely pontificate unique metrics for cross-media human capital. Completely procrastinate professional collaboration and idea-sharing rather than 24/365 paradigms. Phosfluorescently initiates multimedia based outsourcing for interoperable benefits.</p>\n<h3>Seamlessly promote flexible growth strategies.</h3>\n<p>Progressively leverage other\'s e-business functionalities through corporate e-markets. Holistic repurpose timely systems via seamless total linkage. Appropriately maximize impactful "outside the box" thinking vis-a-vis visionary value. Authoritatively deploy interdependent technology through process-centric "outside the box" thinking. Interactively negotiate pandemic internal or "organic" sources whereas competitive relationships.</p>\n<figure><img src="/storage/posts/March2018/blog-2.jpg" alt="wide" />\n<figcaption>Keep working until you find success.</figcaption>\n</figure>\n<p>Enthusiastically deliver viral potentialities through multidisciplinary products. Synergistically plagiarize client-focused partnerships for adaptive applications. Seamlessly morph process-centric synergy whereas bricks-and-clicks deliverables. Continually disintermediate holistic action items without distinctive customer service. Enthusiastically seize enterprise web-readiness without effective schemas.</p>\n<h4>Seamlessly promote flexible growth strategies.</h4>\n<p>Assertively restore installed base data before sustainable platforms. Globally recapitalize orthogonal systems via clicks-and-mortar web services. Efficiently grow visionary action items through collaborative e-commerce. Efficiently architect highly efficient "outside the box" thinking before customer directed infomediaries. Proactively mesh holistic human capital rather than exceptional niches.</p>\n<p>Intrinsically create innovative value and pandemic resources. Progressively productize turnkey e-markets and economically sound synergy. Objectively supply turnkey imperatives vis-a-vis high standards in outsourcing. Dynamically exploit unique imperatives with dynamic systems. Appropriately formulate technically sound users and excellent expertise.</p>\n<p>Competently redefine long-term high-impact relationships rather than effective metrics. Distinctively maintain impactful platforms after strategic imperatives. Intrinsically evolve mission-critical deliverables after multimedia based e-business. Interactively mesh cooperative benefits whereas distributed process improvements. Progressively monetize an expanded array of e-services whereas.&nbsp;</p>', 'posts/March2018/4vI1gzsAvMZ30yfDIe67.jpg', 'building-a-solid-foundation', 'Building a solid foundation for your application is super important. Read on below.', 'foundation, app foundation', 'PUBLISHED', 0, '2018-03-26 02:24:43', '2018-03-26 02:24:43'),
	(8, 1, 2, 'Finding the solution that fits for you', 'Finding the solution that fits for you', NULL, '<p>There is a fit for each person. Depending on the service you may want to focus on what each person needs. When you find this you\'ll be able to segregate your application to fit each person\'s needs.</p>\n<p>This is really just an example post. I could write some stuff about how this and that, but it would probably only be information about this and that. Who am I kidding? This really isn\'t going to make some sense, but thanks for still reading. Are you still reading this article? That\'s awesome. Thanks for being interested.</p>\n<blockquote>\n<p>You may have a need to only want to make money from your application, but if your application can help others achieve a goal and you can make money from it too, you have a gold-mine.</p>\n</blockquote>\n<p>Some more info on your awesome post here. After this sentence, it\'s just going to be a little bit of jibberish. But you get a general idea. You\'ll want to blog about stuff to get your customers interested in your application. With leverage existing reliable initiatives before leveraged ideas. Rapidiously develops equity invested expertise rather than enabled channels. Monotonectally intermediate distinctive networks before highly efficient core competencies.</p>\n<h2>Seamlessly promote flexible growth strategies.</h2>\n<p><img src="/storage/posts/March2018/blog-1.jpg" alt="blog" /></p><p>Dramatically harness extensive value through the fully researched human capital. Seamlessly transition premium schemas vis-a-vis efficient convergence. Intrinsically build competitive e-commerce with cross-unit information. Collaboratively e-enable real-time processes before extensive technology. Authoritatively fabricate efficient metrics through intuitive quality vectors.</p>\n<p>Collaboratively deliver optimal vortals whereas backward-compatible models. Globally syndicate diverse leadership rather than high-payoff experiences. Uniquely pontificate unique metrics for cross-media human capital. Completely procrastinate professional collaboration and idea-sharing rather than 24/365 paradigms. Phosfluorescently initiates multimedia based outsourcing for interoperable benefits.</p>\n<h3>Seamlessly promote flexible growth strategies.</h3>\n<p>Progressively leverage other\'s e-business functionalities through corporate e-markets. Holistic repurpose timely systems via seamless total linkage. Appropriately maximize impactful "outside the box" thinking vis-a-vis visionary value. Authoritatively deploy interdependent technology through process-centric "outside the box" thinking. Interactively negotiate pandemic internal or "organic" sources whereas competitive relationships.</p>\n<figure><img src="/storage/posts/March2018/blog-2.jpg" alt="wide" />\n<figcaption>Keep working until you find success.</figcaption>\n</figure>\n<p>Enthusiastically deliver viral potentialities through multidisciplinary products. Synergistically plagiarize client-focused partnerships for adaptive applications. Seamlessly morph process-centric synergy whereas bricks-and-clicks deliverables. Continually disintermediate holistic action items without distinctive customer service. Enthusiastically seize enterprise web-readiness without effective schemas.</p>\n<h4>Seamlessly promote flexible growth strategies.</h4>\n<p>Assertively restore installed base data before sustainable platforms. Globally recapitalize orthogonal systems via clicks-and-mortar web services. Efficiently grow visionary action items through collaborative e-commerce. Efficiently architect highly efficient "outside the box" thinking before customer directed infomediaries. Proactively mesh holistic human capital rather than exceptional niches.</p>\n<p>Intrinsically create innovative value and pandemic resources. Progressively productize turnkey e-markets and economically sound synergy. Objectively supply turnkey imperatives vis-a-vis high standards in outsourcing. Dynamically exploit unique imperatives with dynamic systems. Appropriately formulate technically sound users and excellent expertise.</p>\n<p>Competently redefine long-term high-impact relationships rather than effective metrics. Distinctively maintain impactful platforms after strategic imperatives. Intrinsically evolve mission-critical deliverables after multimedia based e-business. Interactively mesh cooperative benefits whereas distributed process improvements. Progressively monetize an expanded array of e-services whereas.&nbsp;</p>', 'posts/March2018/hWOT5yqNmzCnLhVWXB2u.jpg', 'finding-the-solution-that-fits-for-you', 'How to build an app and find a solution that fits each users needs', 'solution, app solution', 'PUBLISHED', 0, '2018-03-26 02:42:44', '2018-03-26 02:42:44'),
	(9, 1, 2, 'Creating something useful', 'Creating something useful', NULL, '<p>It\'s not enough nowadays to create something you want, instead you\'ll need to focus on what people need. If you find a need for something that isn\'t available... You should create it. Odds are someone will find it useful as well.</p>\n<p>When you focus your energy on building something that you are passionate about it\'s going to show. Your customers will buy because it\'s a great application, but also because they believe in what you are trying to achieve. So, continue to focus on making something that people need and find useful.</p>\n<blockquote>\n<p>You may have a need to only want to make money from your application, but if your application can help others achieve a goal and you can make money from it too, you have a gold-mine.</p>\n</blockquote>\n<p>Some more info on your awesome post here. After this sentence, it\'s just going to be a little bit of jibberish. But you get a general idea. You\'ll want to blog about stuff to get your customers interested in your application. With leverage existing reliable initiatives before leveraged ideas. Rapidiously develops equity invested expertise rather than enabled channels. Monotonectally intermediate distinctive networks before highly efficient core competencies.</p>\n<h2>Seamlessly promote flexible growth strategies.</h2>\n<p><img src="/storage/posts/March2018/blog-1.jpg" alt="blog" /></p><p>Dramatically harness extensive value through the fully researched human capital. Seamlessly transition premium schemas vis-a-vis efficient convergence. Intrinsically build competitive e-commerce with cross-unit information. Collaboratively e-enable real-time processes before extensive technology. Authoritatively fabricate efficient metrics through intuitive quality vectors.</p>\n<p>Collaboratively deliver optimal vortals whereas backward-compatible models. Globally syndicate diverse leadership rather than high-payoff experiences. Uniquely pontificate unique metrics for cross-media human capital. Completely procrastinate professional collaboration and idea-sharing rather than 24/365 paradigms. Phosfluorescently initiates multimedia based outsourcing for interoperable benefits.</p>\n<h3>Seamlessly promote flexible growth strategies.</h3>\n<p>Progressively leverage other\'s e-business functionalities through corporate e-markets. Holistic repurpose timely systems via seamless total linkage. Appropriately maximize impactful "outside the box" thinking vis-a-vis visionary value. Authoritatively deploy interdependent technology through process-centric "outside the box" thinking. Interactively negotiate pandemic internal or "organic" sources whereas competitive relationships.</p>\n<figure><img src="/storage/posts/March2018/blog-2.jpg" alt="wide" />\n<figcaption>Keep working until you find success.</figcaption>\n</figure>\n<p>Enthusiastically deliver viral potentialities through multidisciplinary products. Synergistically plagiarize client-focused partnerships for adaptive applications. Seamlessly morph process-centric synergy whereas bricks-and-clicks deliverables. Continually disintermediate holistic action items without distinctive customer service. Enthusiastically seize enterprise web-readiness without effective schemas.</p>\n<h4>Seamlessly promote flexible growth strategies.</h4>\n<p>Assertively restore installed base data before sustainable platforms. Globally recapitalize orthogonal systems via clicks-and-mortar web services. Efficiently grow visionary action items through collaborative e-commerce. Efficiently architect highly efficient "outside the box" thinking before customer directed infomediaries. Proactively mesh holistic human capital rather than exceptional niches.</p>\n<p>Intrinsically create innovative value and pandemic resources. Progressively productize turnkey e-markets and economically sound synergy. Objectively supply turnkey imperatives vis-a-vis high standards in outsourcing. Dynamically exploit unique imperatives with dynamic systems. Appropriately formulate technically sound users and excellent expertise.</p>\n<p>Competently redefine long-term high-impact relationships rather than effective metrics. Distinctively maintain impactful platforms after strategic imperatives. Intrinsically evolve mission-critical deliverables after multimedia based e-business. Interactively mesh cooperative benefits whereas distributed process improvements. Progressively monetize an expanded array of e-services whereas.</p>', 'posts/March2018/weZwLLpaXnxyTR989iDk.jpg', 'creating-something-useful', 'Find out how to Create something useful', 'useful, create something useful', 'PUBLISHED', 0, '2018-03-26 02:49:37', '2018-03-26 02:56:38'),
	(10, 1, 1, 'Never Stop Creating', 'Never Stop Creating', NULL, '<p>The reason why we are the way we are is... Because we are designed for a purpose. Some people are created to help or service, and others are created to... Well... Create. Are you a creator.</p>\n<p>If you have a passion for creating new things and bringing ideas to life. You\'ll want to save yourself some time by using Wave to build the foundation. Wave has so many built-in features including Billing, User Profiles, User Settings, an API, and so much more.</p>\n<blockquote>\n<p>You may have a need to only want to make money from your application, but if your application can help others achieve a goal and you can make money from it too, you have a gold-mine.</p>\n</blockquote>\n<p>Some more info on your awesome post here. After this sentence, it\'s just going to be a little bit of jibberish. But you get a general idea. You\'ll want to blog about stuff to get your customers interested in your application. With leverage existing reliable initiatives before leveraged ideas. Rapidiously develops equity invested expertise rather than enabled channels. Monotonectally intermediate distinctive networks before highly efficient core competencies.</p>\n<h2>Seamlessly promote flexible growth strategies.</h2>\n<p><img src="/storage/posts/March2018/blog-1.jpg" alt="blog" /></p><p>Dramatically harness extensive value through the fully researched human capital. Seamlessly transition premium schemas vis-a-vis efficient convergence. Intrinsically build competitive e-commerce with cross-unit information. Collaboratively e-enable real-time processes before extensive technology. Authoritatively fabricate efficient metrics through intuitive quality vectors.</p>\n<p>Collaboratively deliver optimal vortals whereas backward-compatible models. Globally syndicate diverse leadership rather than high-payoff experiences. Uniquely pontificate unique metrics for cross-media human capital. Completely procrastinate professional collaboration and idea-sharing rather than 24/365 paradigms. Phosfluorescently initiates multimedia based outsourcing for interoperable benefits.</p>\n<h3>Seamlessly promote flexible growth strategies.</h3>\n<p>Progressively leverage other\'s e-business functionalities through corporate e-markets. Holistic repurpose timely systems via seamless total linkage. Appropriately maximize impactful "outside the box" thinking vis-a-vis visionary value. Authoritatively deploy interdependent technology through process-centric "outside the box" thinking. Interactively negotiate pandemic internal or "organic" sources whereas competitive relationships.</p>\n<figure><img src="/storage/posts/March2018/blog-2.jpg" alt="wide" />\n<figcaption>Keep working until you find success.</figcaption>\n</figure>\n<p>Enthusiastically deliver viral potentialities through multidisciplinary products. Synergistically plagiarize client-focused partnerships for adaptive applications. Seamlessly morph process-centric synergy whereas bricks-and-clicks deliverables. Continually disintermediate holistic action items without distinctive customer service. Enthusiastically seize enterprise web-readiness without effective schemas.</p>\n<h4>Seamlessly promote flexible growth strategies.</h4>\n<p>Assertively restore installed base data before sustainable platforms. Globally recapitalize orthogonal systems via clicks-and-mortar web services. Efficiently grow visionary action items through collaborative e-commerce. Efficiently architect highly efficient "outside the box" thinking before customer directed infomediaries. Proactively mesh holistic human capital rather than exceptional niches.</p>\n<p>Intrinsically create innovative value and pandemic resources. Progressively productize turnkey e-markets and economically sound synergy. Objectively supply turnkey imperatives vis-a-vis high standards in outsourcing. Dynamically exploit unique imperatives with dynamic systems. Appropriately formulate technically sound users and excellent expertise.</p>\n<p>Competently redefine long-term high-impact relationships rather than effective metrics. Distinctively maintain impactful platforms after strategic imperatives. Intrinsically evolve mission-critical deliverables after multimedia based e-business. Interactively mesh cooperative benefits whereas distributed process improvements. Progressively monetize an expanded array of e-services whereas.</p>', 'posts/March2018/K804BvnOehlLao0XmI08.jpg', 'never-stop-creating', 'In this article you\'ll learn how important it is to never stop creating', 'creating, never stop', 'PUBLISHED', 0, '2018-03-26 02:08:02', '2018-06-28 06:14:31');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.roles: ~3 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'Admin User', '2017-11-21 16:23:22', '2017-11-21 16:23:22'),
	(3, 'basic', 'Basic Plan', '2018-07-03 05:03:21', '2018-07-03 17:28:44'),
	(6, 'cancelled', 'Cancelled User', '2018-07-03 16:28:42', '2018-07-03 17:28:32');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `details` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '1',
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.settings: ~15 rows (approximately)
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
	(1, 'site.title', 'Site Title', 'Wat kan ik doen?', '', 'text', 1, 'Site'),
	(2, 'site.description', 'Site Description', 'Jouw startpunt voor actief burgerschap!', '', 'text', 2, 'Site'),
	(4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', NULL, '', 'text', 4, 'Site'),
	(6, 'admin.title', 'Admin Title', 'Admin Paneel', '', 'text', 1, 'Admin'),
	(7, 'admin.description', 'Admin Description', 'I am the Admin.', '', 'text', 2, 'Admin'),
	(8, 'admin.loader', 'Admin Loader', '', '', 'image', 3, 'Admin'),
	(9, 'admin.icon_image', 'Admin Icon Image', '', '', 'image', 4, 'Admin'),
	(10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', NULL, '', 'text', 1, 'Admin'),
	(11, 'site.favicon', 'Favicon', 'settings/December2021/ZWp2Kc1if4Qq5yRno3Mo.png', NULL, 'image', 6, 'Site'),
	(12, 'auth.dashboard_redirect', 'Homepage Redirect to Dashboard if Logged in', '0', NULL, 'checkbox', 7, 'Auth'),
	(13, 'auth.email_or_username', 'Users Login with Email or Username', 'email', '{\n"default" : "email",\n"options" : {\n"email": "Email Address",\n"username": "Username"\n}\n}', 'select_dropdown', 8, 'Auth'),
	(14, 'auth.username_in_registration', 'Username when Registering', 'no', '{\n"default" : "yes",\n"options" : {\n"yes": "Yes, Include the Username Field when Registering",\n"no": "No, Have it automatically generated"\n}\n}', 'select_dropdown', 9, 'Auth'),
	(15, 'auth.verify_email', 'Verify Email during Sign Up', '1', NULL, 'checkbox', 10, 'Auth');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.themes
DROP TABLE IF EXISTS `themes`;
CREATE TABLE IF NOT EXISTS `themes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `folder` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `version` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `voyager_themes_folder_unique` (`folder`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.themes: ~0 rows (approximately)
/*!40000 ALTER TABLE `themes` DISABLE KEYS */;
INSERT INTO `themes` (`id`, `name`, `folder`, `active`, `version`, `created_at`, `updated_at`) VALUES
	(1, 'Tailwind Theme', 'tailwind', 0, '1.0', '2020-08-23 08:06:45', '2021-11-26 17:08:54'),
	(2, 'Custom Theme', 'custom', 1, '1.0', '2021-11-26 16:57:37', '2021-11-26 17:08:54');
/*!40000 ALTER TABLE `themes` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.theme_options
DROP TABLE IF EXISTS `theme_options`;
CREATE TABLE IF NOT EXISTS `theme_options` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `theme_id` int unsigned NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `voyager_theme_options_theme_id_index` (`theme_id`),
  CONSTRAINT `theme_options_theme_id_foreign` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.theme_options: ~14 rows (approximately)
/*!40000 ALTER TABLE `theme_options` DISABLE KEYS */;
INSERT INTO `theme_options` (`id`, `theme_id`, `key`, `value`, `created_at`, `updated_at`) VALUES
	(17, 1, 'logo', '', '2017-11-22 16:54:46', '2018-02-11 05:02:40'),
	(18, 1, 'home_headline', 'Welcome to Wave', '2017-11-25 17:31:45', '2018-08-28 00:17:41'),
	(19, 1, 'home_subheadline', 'Start crafting your next great idea.', '2017-11-25 17:31:45', '2017-11-26 07:11:47'),
	(20, 1, 'home_description', 'Wave will help you rapidly build a Software as a Service. Out of the box Authentication, Subscriptions, Invoices, Announcements, User Profiles, API, and so much more!', '2017-11-25 17:31:45', '2017-11-26 07:09:50'),
	(21, 1, 'home_cta', 'Signup', '2017-11-25 20:02:29', '2020-10-23 20:17:25'),
	(22, 1, 'home_cta_url', '/register', '2017-11-25 20:09:33', '2017-11-26 16:12:41'),
	(23, 1, 'home_promo_image', 'themes/February2018/mFajn4fwpGFXzI1UsNH6.png', '2017-11-25 21:36:46', '2017-11-29 01:17:00'),
	(24, 1, 'footer_logo', 'themes/August2018/TksmVWMqp5JXUQj8C6Ct.png', '2018-08-28 23:12:11', '2018-08-28 23:12:11'),
	(25, 2, 'home_headline', NULL, '2021-12-14 12:23:05', '2021-12-14 12:23:05'),
	(26, 2, 'home_subheadline', NULL, '2021-12-14 12:23:05', '2021-12-14 12:23:05'),
	(27, 2, 'home_description', NULL, '2021-12-14 12:23:05', '2021-12-14 12:23:05'),
	(28, 2, 'home_cta', NULL, '2021-12-14 12:23:05', '2021-12-14 12:23:05'),
	(29, 2, 'home_cta_url', NULL, '2021-12-14 12:23:05', '2021-12-14 12:23:05'),
	(30, 2, 'logo', 'themes/December2021/NyenZgLPF9lVeXFg9uAh.png', '2021-12-14 12:23:05', '2021-12-14 12:23:05'),
	(31, 2, 'footer_logo', 'themes/December2021/WyyPQIqht2O9BDTBD5YI.png', '2021-12-14 12:23:19', '2021-12-14 12:23:19');
/*!40000 ALTER TABLE `theme_options` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.translations
DROP TABLE IF EXISTS `translations`;
CREATE TABLE IF NOT EXISTS `translations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.translations: ~125 rows (approximately)
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
INSERT INTO `translations` (`id`, `table_name`, `column_name`, `foreign_key`, `locale`, `value`, `created_at`, `updated_at`) VALUES
	(1, 'data_types', 'display_name_singular', 1, 'pt', 'Post', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(2, 'data_types', 'display_name_singular', 2, 'pt', 'Página', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(3, 'data_types', 'display_name_singular', 3, 'pt', 'Utilizador', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(4, 'data_types', 'display_name_singular', 4, 'pt', 'Categoria', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(5, 'data_types', 'display_name_singular', 5, 'pt', 'Menu', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(6, 'data_types', 'display_name_singular', 6, 'pt', 'Função', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(7, 'data_types', 'display_name_plural', 1, 'pt', 'Posts', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(8, 'data_types', 'display_name_plural', 2, 'pt', 'Páginas', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(9, 'data_types', 'display_name_plural', 3, 'pt', 'Utilizadores', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(10, 'data_types', 'display_name_plural', 4, 'pt', 'Categorias', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(11, 'data_types', 'display_name_plural', 5, 'pt', 'Menus', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(12, 'data_types', 'display_name_plural', 6, 'pt', 'Funções', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(13, 'categories', 'slug', 1, 'pt', 'categoria-1', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(14, 'categories', 'name', 1, 'pt', 'Categoria 1', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(15, 'categories', 'slug', 2, 'pt', 'categoria-2', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(16, 'categories', 'name', 2, 'pt', 'Categoria 2', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(17, 'pages', 'title', 1, 'pt', 'Olá Mundo', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(18, 'pages', 'slug', 1, 'pt', 'ola-mundo', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(19, 'pages', 'body', 1, 'pt', '<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(20, 'menu_items', 'title', 1, 'pt', 'Painel de Controle', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(21, 'menu_items', 'title', 2, 'pt', 'Media', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(22, 'menu_items', 'title', 3, 'pt', 'Publicações', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(23, 'menu_items', 'title', 4, 'pt', 'Utilizadores', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(24, 'menu_items', 'title', 5, 'pt', 'Categorias', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(25, 'menu_items', 'title', 6, 'pt', 'Páginas', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(26, 'menu_items', 'title', 7, 'pt', 'Funções', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(27, 'menu_items', 'title', 8, 'pt', 'Ferramentas', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(28, 'menu_items', 'title', 9, 'pt', 'Menus', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(29, 'menu_items', 'title', 10, 'pt', 'Base de dados', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(30, 'menu_items', 'title', 13, 'pt', 'Configurações', '2017-11-21 16:23:23', '2017-11-21 16:23:23'),
	(31, 'data_rows', 'display_name', 77, 'en', 'Id', '2021-11-29 13:27:22', '2021-11-29 13:27:22'),
	(32, 'data_rows', 'display_name', 78, 'en', 'Title', '2021-11-29 13:27:22', '2021-11-29 13:27:22'),
	(33, 'data_rows', 'display_name', 79, 'en', 'Excerpt', '2021-11-29 13:27:22', '2021-11-29 13:27:22'),
	(34, 'data_rows', 'display_name', 81, 'en', 'Created At', '2021-11-29 13:27:22', '2021-11-29 13:27:22'),
	(35, 'data_rows', 'display_name', 82, 'en', 'Updated At', '2021-11-29 13:27:22', '2021-11-29 13:27:22'),
	(36, 'data_types', 'display_name_singular', 9, 'en', 'Event', '2021-11-29 13:27:22', '2021-11-29 13:27:22'),
	(37, 'data_types', 'display_name_plural', 9, 'en', 'Events', '2021-11-29 13:27:22', '2021-11-29 13:27:22'),
	(38, 'pages', 'title', 2, 'en', 'About', '2021-11-30 12:38:41', '2021-11-30 12:38:41'),
	(39, 'pages', 'body', 2, 'en', '<p>Wave is the ultimate&nbsp;Software as a Service Starter kit. If you\'ve ever wanted to create your own SAAS application, Wave can help save you hundreds of hours. Wave is one of a kind and it is built on top of Laravel and Voyager. Building your application is going to be funner&nbsp;than ever before... Funner may not be a real word, but you get where I\'m trying to go.</p>\n<p>Wave has a bunch of functionality built-in that will save you a bunch of time. Your users will be able to update their settings, billing information, profile information and so much more. You will also be able to accept&nbsp;payments from your user with multiple vendors.</p>\n<p>We want to help you build the SAAS of your dreams by making it easier and less time-consuming. Let\'s start creating some "Waves" and build out the SAAS in your particular niche... Sorry about that Wave pun...</p>', '2021-11-30 12:38:41', '2021-11-30 12:38:41'),
	(40, 'pages', 'slug', 2, 'en', 'about', '2021-11-30 12:38:41', '2021-11-30 12:38:41'),
	(41, 'posts', 'title', 5, 'en', 'Best ways to market your application', '2021-11-30 12:39:16', '2021-11-30 12:39:16'),
	(42, 'posts', 'body', 5, 'en', '<p>There are many different ways to market your application. First, let\'s start off at the beginning and then we will get more in-depth. You\'ll want to discover your target audience and after that, you\'ll want to run some ads.</p>\n<p>Let\'s not complicate things here, if you build a good product, you are going to have users. But you will need to let your users know where to find you. This is where social media and ads come in to play. You\'ll need to boast about your product and your app. If it\'s something that you really believe in, the odds are others will too.</p>\n<blockquote>\n<p>You may have a need to only want to make money from your application, but if your application can help others achieve a goal and you can make money from it too, you have a gold-mine.</p>\n</blockquote>\n<p>Some more info on your awesome post here. After this sentence, it\'s just going to be a little bit of jibberish. But you get a general idea. You\'ll want to blog about stuff to get your customers interested in your application. With leverage existing reliable initiatives before leveraged ideas. Rapidiously develops equity invested expertise rather than enabled channels. Monotonectally intermediate distinctive networks before highly efficient core competencies.</p>\n<h2>Seamlessly promote flexible growth strategies.</h2>\n<p><img src="/storage/posts/March2018/blog-1.jpg" alt="blog" /></p><p> Dramatically harness extensive value through the fully researched human capital. Seamlessly transition premium schemas vis-a-vis efficient convergence. Intrinsically build competitive e-commerce with cross-unit information. Collaboratively e-enable real-time processes before extensive technology. Authoritatively fabricate efficient metrics through intuitive quality vectors.</p>\n<p>Collaboratively deliver optimal vortals whereas backward-compatible models. Globally syndicate diverse leadership rather than high-payoff experiences. Uniquely pontificate unique metrics for cross-media human capital. Completely procrastinate professional collaboration and idea-sharing rather than 24/365 paradigms. Phosfluorescently initiates multimedia based outsourcing for interoperable benefits.</p>\n<h3>Seamlessly promote flexible growth strategies.</h3>\n<p>Progressively leverage other\'s e-business functionalities through corporate e-markets. Holistic repurpose timely systems via seamless total linkage. Appropriately maximize impactful "outside the box" thinking vis-a-vis visionary value. Authoritatively deploy interdependent technology through process-centric "outside the box" thinking. Interactively negotiate pandemic internal or "organic" sources whereas competitive relationships.</p>\n<figure><img src="/storage/posts/March2018/blog-2.jpg" alt="wide" />\n<figcaption>Keep working until you find success.</figcaption>\n</figure>\n<p>Enthusiastically deliver viral potentialities through multidisciplinary products. Synergistically plagiarize client-focused partnerships for adaptive applications. Seamlessly morph process-centric synergy whereas bricks-and-clicks deliverables. Continually disintermediate holistic action items without distinctive customer service. Enthusiastically seize enterprise web-readiness without effective schemas.</p>\n<h4>Seamlessly promote flexible growth strategies.</h4>\n<p>Assertively restore installed base data before sustainable platforms. Globally recapitalize orthogonal systems via clicks-and-mortar web services. Efficiently grow visionary action items through collaborative e-commerce. Efficiently architect highly efficient "outside the box" thinking before customer directed infomediaries. Proactively mesh holistic human capital rather than exceptional niches.</p>\n<p>Intrinsically create innovative value and pandemic resources. Progressively productize turnkey e-markets and economically sound synergy. Objectively supply turnkey imperatives vis-a-vis high standards in outsourcing. Dynamically exploit unique imperatives with dynamic systems. Appropriately formulate technically sound users and excellent expertise.</p>\n<p>Competently redefine long-term high-impact relationships rather than effective metrics. Distinctively maintain impactful platforms after strategic imperatives. Intrinsically evolve mission-critical deliverables after multimedia based e-business. Interactively mesh cooperative benefits whereas distributed process improvements. Progressively monetize an expanded array of e-services whereas.</p>', '2021-11-30 12:39:16', '2021-11-30 12:39:16'),
	(43, 'posts', 'slug', 5, 'en', 'best-ways-to-market-your-application', '2021-11-30 12:39:16', '2021-11-30 12:39:16'),
	(44, 'posts', 'meta_description', 5, 'en', 'Find out the best ways to market your application in this article.', '2021-11-30 12:39:16', '2021-11-30 12:39:16'),
	(45, 'posts', 'meta_keywords', 5, 'en', 'market, saas, market your app', '2021-11-30 12:39:16', '2021-11-30 12:39:16'),
	(46, 'posts', 'seo_title', 5, 'en', 'Best ways to market your application', '2021-11-30 12:39:16', '2021-11-30 12:39:16'),
	(47, 'data_rows', 'display_name', 93, 'en', 'ID', '2021-11-30 13:30:47', '2021-11-30 13:30:47'),
	(48, 'data_rows', 'display_name', 94, 'en', 'Author', '2021-11-30 13:30:47', '2021-11-30 13:30:47'),
	(49, 'data_rows', 'display_name', 95, 'en', 'Category', '2021-11-30 13:30:47', '2021-11-30 13:30:47'),
	(50, 'data_rows', 'display_name', 96, 'en', 'Title', '2021-11-30 13:30:47', '2021-11-30 13:30:47'),
	(51, 'data_rows', 'display_name', 97, 'en', 'excerpt', '2021-11-30 13:30:47', '2021-11-30 13:30:47'),
	(52, 'data_rows', 'display_name', 98, 'en', 'Body', '2021-11-30 13:30:47', '2021-11-30 13:30:47'),
	(53, 'data_rows', 'display_name', 99, 'en', 'Post Image', '2021-11-30 13:30:47', '2021-11-30 13:30:47'),
	(54, 'data_rows', 'display_name', 100, 'en', 'slug', '2021-11-30 13:30:47', '2021-11-30 13:30:47'),
	(55, 'data_rows', 'display_name', 101, 'en', 'meta_description', '2021-11-30 13:30:47', '2021-11-30 13:30:47'),
	(56, 'data_rows', 'display_name', 102, 'en', 'meta_keywords', '2021-11-30 13:30:47', '2021-11-30 13:30:47'),
	(57, 'data_rows', 'display_name', 103, 'en', 'status', '2021-11-30 13:30:47', '2021-11-30 13:30:47'),
	(58, 'data_rows', 'display_name', 104, 'en', 'created_at', '2021-11-30 13:30:47', '2021-11-30 13:30:47'),
	(59, 'data_rows', 'display_name', 105, 'en', 'updated_at', '2021-11-30 13:30:47', '2021-11-30 13:30:47'),
	(60, 'data_rows', 'display_name', 120, 'en', 'Seo Title', '2021-11-30 13:35:12', '2021-11-30 13:35:12'),
	(61, 'data_rows', 'display_name', 121, 'en', 'Featured', '2021-11-30 13:35:12', '2021-11-30 13:35:12'),
	(65, 'menu_items', 'title', 34, 'en', 'Events', '2021-12-06 10:22:59', '2021-12-06 10:22:59'),
	(66, 'data_rows', 'display_name', 122, 'en', 'Id', '2021-12-06 10:38:21', '2021-12-06 10:38:21'),
	(67, 'data_rows', 'display_name', 123, 'en', 'Author Id', '2021-12-06 10:38:21', '2021-12-06 10:38:21'),
	(68, 'data_rows', 'display_name', 124, 'en', 'Category Id', '2021-12-06 10:38:21', '2021-12-06 10:38:21'),
	(69, 'data_rows', 'display_name', 125, 'en', 'Title', '2021-12-06 10:38:21', '2021-12-06 10:38:21'),
	(70, 'data_rows', 'display_name', 126, 'en', 'Seo Title', '2021-12-06 10:38:21', '2021-12-06 10:38:21'),
	(71, 'data_rows', 'display_name', 127, 'en', 'Excerpt', '2021-12-06 10:38:21', '2021-12-06 10:38:21'),
	(72, 'data_rows', 'display_name', 128, 'en', 'Body', '2021-12-06 10:38:21', '2021-12-06 10:38:21'),
	(73, 'data_rows', 'display_name', 129, 'en', 'Image', '2021-12-06 10:38:21', '2021-12-06 10:38:21'),
	(74, 'data_rows', 'display_name', 130, 'en', 'Slug', '2021-12-06 10:38:21', '2021-12-06 10:38:21'),
	(75, 'data_rows', 'display_name', 131, 'en', 'Meta Description', '2021-12-06 10:38:21', '2021-12-06 10:38:21'),
	(76, 'data_rows', 'display_name', 132, 'en', 'Meta Keywords', '2021-12-06 10:38:21', '2021-12-06 10:38:21'),
	(77, 'data_rows', 'display_name', 133, 'en', 'Status', '2021-12-06 10:38:21', '2021-12-06 10:38:21'),
	(78, 'data_rows', 'display_name', 134, 'en', 'Featured', '2021-12-06 10:38:21', '2021-12-06 10:38:21'),
	(79, 'data_rows', 'display_name', 135, 'en', 'Created At', '2021-12-06 10:38:21', '2021-12-06 10:38:21'),
	(80, 'data_rows', 'display_name', 136, 'en', 'Updated At', '2021-12-06 10:38:21', '2021-12-06 10:38:21'),
	(81, 'data_rows', 'display_name', 39, 'en', 'id', '2021-12-06 11:11:11', '2021-12-06 11:11:11'),
	(82, 'data_rows', 'display_name', 40, 'en', 'parent_id', '2021-12-06 11:11:11', '2021-12-06 11:11:11'),
	(83, 'data_rows', 'display_name', 41, 'en', 'order', '2021-12-06 11:11:11', '2021-12-06 11:11:11'),
	(84, 'data_rows', 'display_name', 42, 'en', 'name', '2021-12-06 11:11:11', '2021-12-06 11:11:11'),
	(85, 'data_rows', 'display_name', 43, 'en', 'slug', '2021-12-06 11:11:11', '2021-12-06 11:11:11'),
	(86, 'data_rows', 'display_name', 44, 'en', 'created_at', '2021-12-06 11:11:11', '2021-12-06 11:11:11'),
	(87, 'data_rows', 'display_name', 45, 'en', 'updated_at', '2021-12-06 11:11:11', '2021-12-06 11:11:11'),
	(88, 'data_types', 'display_name_singular', 4, 'en', 'Category', '2021-12-06 11:11:11', '2021-12-06 11:11:11'),
	(89, 'data_types', 'display_name_plural', 4, 'en', 'Categories', '2021-12-06 11:11:11', '2021-12-06 11:11:11'),
	(90, 'data_rows', 'display_name', 137, 'en', 'categories', '2021-12-06 14:00:52', '2021-12-06 14:00:52'),
	(91, 'data_rows', 'display_name', 139, 'en', 'Time Start', '2021-12-06 14:50:30', '2021-12-06 14:50:30'),
	(92, 'data_rows', 'display_name', 140, 'en', 'Time End', '2021-12-06 14:50:30', '2021-12-06 14:50:30'),
	(93, 'data_rows', 'display_name', 141, 'en', 'Location', '2021-12-06 14:50:30', '2021-12-06 14:50:30'),
	(94, 'data_rows', 'display_name', 142, 'en', 'Location Human', '2021-12-06 14:50:30', '2021-12-06 14:50:30'),
	(95, 'data_rows', 'display_name', 145, 'en', 'Location', '2021-12-10 17:02:15', '2021-12-10 17:02:15'),
	(96, 'menu_items', 'title', 36, 'en', 'Actie Themes', '2021-12-20 12:58:14', '2021-12-20 12:58:14'),
	(97, 'menu_items', 'title', 38, 'en', 'Acties & meer', '2021-12-21 15:14:34', '2021-12-21 15:14:34'),
	(98, 'menu_items', 'title', 37, 'en', 'Accounts', '2021-12-21 15:18:02', '2021-12-21 15:18:02'),
	(99, 'data_rows', 'display_name', 153, 'en', 'themes', '2021-12-31 11:42:22', '2021-12-31 11:42:22'),
	(100, 'data_rows', 'display_name', 154, 'en', 'Externe Link', '2022-01-03 16:09:54', '2022-01-03 16:09:54'),
	(101, 'data_rows', 'display_name', 163, 'en', 'organizers', '2022-01-03 16:09:54', '2022-01-03 16:09:54'),
	(102, 'pages', 'title', 3, 'en', 'Privacybeleid', '2022-01-05 10:20:05', '2022-01-05 10:20:05'),
	(103, 'pages', 'body', 3, 'en', '<p>Privacybeleid.</p>', '2022-01-05 10:20:05', '2022-01-05 10:20:05'),
	(104, 'pages', 'slug', 3, 'en', 'privacybeleid', '2022-01-05 10:20:05', '2022-01-05 10:20:05'),
	(105, 'data_rows', 'display_name', 14, 'en', 'id', '2022-01-18 17:37:03', '2022-01-18 17:37:03'),
	(106, 'data_rows', 'display_name', 15, 'en', 'author_id', '2022-01-18 17:37:03', '2022-01-18 17:37:03'),
	(107, 'data_rows', 'display_name', 16, 'en', 'title', '2022-01-18 17:37:03', '2022-01-18 17:37:03'),
	(108, 'data_rows', 'display_name', 17, 'en', 'excerpt', '2022-01-18 17:37:03', '2022-01-18 17:37:03'),
	(109, 'data_rows', 'display_name', 18, 'en', 'body', '2022-01-18 17:37:03', '2022-01-18 17:37:03'),
	(110, 'data_rows', 'display_name', 25, 'en', 'image', '2022-01-18 17:37:03', '2022-01-18 17:37:03'),
	(111, 'data_rows', 'display_name', 19, 'en', 'slug', '2022-01-18 17:37:03', '2022-01-18 17:37:03'),
	(112, 'data_rows', 'display_name', 20, 'en', 'meta_description', '2022-01-18 17:37:03', '2022-01-18 17:37:03'),
	(113, 'data_rows', 'display_name', 21, 'en', 'meta_keywords', '2022-01-18 17:37:03', '2022-01-18 17:37:03'),
	(114, 'data_rows', 'display_name', 22, 'en', 'status', '2022-01-18 17:37:03', '2022-01-18 17:37:03'),
	(115, 'data_rows', 'display_name', 23, 'en', 'created_at', '2022-01-18 17:37:03', '2022-01-18 17:37:03'),
	(116, 'data_rows', 'display_name', 24, 'en', 'updated_at', '2022-01-18 17:37:03', '2022-01-18 17:37:03'),
	(117, 'data_types', 'display_name_singular', 2, 'en', 'Page', '2022-01-18 17:37:03', '2022-01-18 17:37:03'),
	(118, 'data_types', 'display_name_plural', 2, 'en', 'Pages', '2022-01-18 17:37:03', '2022-01-18 17:37:03'),
	(121, 'data_rows', 'display_name', 176, 'en', 'Id', '2022-01-19 15:51:49', '2022-01-19 15:51:49'),
	(122, 'data_rows', 'display_name', 177, 'en', 'User Id', '2022-01-19 15:51:49', '2022-01-19 15:51:49'),
	(123, 'data_rows', 'display_name', 178, 'en', 'Title', '2022-01-19 15:51:49', '2022-01-19 15:51:49'),
	(124, 'data_rows', 'display_name', 179, 'en', 'Body', '2022-01-19 15:51:49', '2022-01-19 15:51:49'),
	(125, 'data_rows', 'display_name', 180, 'en', 'Externe Link', '2022-01-19 15:51:49', '2022-01-19 15:51:49'),
	(126, 'data_rows', 'display_name', 181, 'en', 'Time Start', '2022-01-19 15:51:49', '2022-01-19 15:51:49'),
	(127, 'data_rows', 'display_name', 182, 'en', 'Time End', '2022-01-19 15:51:49', '2022-01-19 15:51:49'),
	(128, 'data_rows', 'display_name', 183, 'en', 'Location', '2022-01-19 15:51:49', '2022-01-19 15:51:49'),
	(129, 'data_rows', 'display_name', 184, 'en', 'Location Human', '2022-01-19 15:51:49', '2022-01-19 15:51:49'),
	(130, 'data_rows', 'display_name', 185, 'en', 'Image', '2022-01-19 15:51:49', '2022-01-19 15:51:49'),
	(131, 'data_rows', 'display_name', 186, 'en', 'Status', '2022-01-19 15:51:49', '2022-01-19 15:51:49'),
	(132, 'data_rows', 'display_name', 187, 'en', 'Created At', '2022-01-19 15:51:49', '2022-01-19 15:51:49'),
	(133, 'data_rows', 'display_name', 188, 'en', 'Updated At', '2022-01-19 15:51:49', '2022-01-19 15:51:49'),
	(134, 'data_rows', 'display_name', 189, 'en', 'users', '2022-01-19 15:51:49', '2022-01-19 15:51:49'),
	(135, 'data_types', 'display_name_singular', 21, 'en', 'Aanmelding', '2022-01-19 15:51:49', '2022-01-19 15:51:49'),
	(136, 'data_types', 'display_name_plural', 21, 'en', 'Aanmeldingen', '2022-01-19 15:51:49', '2022-01-19 15:51:49');
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` datetime DEFAULT NULL,
  `verification_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `remember_token`, `settings`, `created_at`, `updated_at`, `username`, `stripe_id`, `card_brand`, `card_last_four`, `trial_ends_at`, `verification_code`, `verified`) VALUES
	(1, 1, 'Web Admin', 'admin@admin.com', 'users/January2022/7zHXRf96GKsRIcEd0HX0.jpg', NULL, '$2y$10$WkbajwgAuz7zYR7D572LzeSfzmtkcg79hJL/emgptCrLW1jG05r.W', 'sbxXg0E9VVoUblkYivq9ZYRdemD4gXUZNgKpo4270AwJx11906dJN2PihzHX', '{"locale":null}', '2017-11-21 16:07:22', '2022-01-21 15:19:45', 'admin', NULL, NULL, NULL, NULL, NULL, 1),
	(2, 3, 'Kamiel', 'kamiel.verhelst@gmail.com', 'avatars/kamiel.png', '2021-11-24 19:32:43', '$2y$10$ZXArXh63T25DBI57k96.2eyojV23cHX06pU8xaVRlDfXjJzH5pnG6', NULL, NULL, '2021-11-24 17:25:15', '2021-11-29 09:53:29', 'kamiel', NULL, NULL, NULL, NULL, NULL, 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table watkanikdoen_app.user_roles
DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `user_roles_user_id_index` (`user_id`),
  KEY `user_roles_role_id_index` (`role_id`),
  CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table watkanikdoen_app.user_roles: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
