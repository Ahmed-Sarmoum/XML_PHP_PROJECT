/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) NOT NULL DEFAULT '0',
  `teach_id` int(11) NOT NULL DEFAULT '0',
  `mod_id` int(11) NOT NULL DEFAULT '0',
  `hall_id` int(11) NOT NULL DEFAULT '0',
  `day` varchar(50) NOT NULL DEFAULT '0',
  `start_time` varchar(50) NOT NULL DEFAULT '0',
  `end_time` varchar(50) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_courses_promotions` (`promo_id`),
  KEY `FK_courses_teachers` (`teach_id`),
  KEY `FK_courses_modules` (`mod_id`),
  KEY `FK_courses_halls` (`hall_id`),
  CONSTRAINT `FK_courses_halls` FOREIGN KEY (`hall_id`) REFERENCES `halls` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_courses_modules` FOREIGN KEY (`mod_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_courses_promotions` FOREIGN KEY (`promo_id`) REFERENCES `promotions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_courses_teachers` FOREIGN KEY (`teach_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` (`id`, `promo_id`, `teach_id`, `mod_id`, `hall_id`, `day`, `start_time`, `end_time`, `created_at`) VALUES
	(2, 5, 2, 3, 4, '12', '11:00:00', '13:00:00', '2021-12-20 23:36:52'),
	(3, 5, 1, 5, 1, '20', '08:00:00', '11:00:00', '2021-12-20 23:37:58'),
	(4, 5, 3, 2, 2, '15', '10:00:00', '12:00:00', '2021-12-21 22:49:36');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `halls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `halls` DISABLE KEYS */;
INSERT INTO `halls` (`id`, `name`, `description`, `created_at`) VALUES
	(1, '15', 'SALLE 15', '2021-12-20 23:32:08'),
	(2, '7', 'SALLE 7', '2021-12-20 23:32:20'),
	(3, '13', 'SALLE 13', '2021-12-20 23:32:48'),
	(4, '14', 'SALLE 14', '2021-12-20 23:32:49');
/*!40000 ALTER TABLE `halls` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `promo_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_modules_promotions` (`promo_id`),
  CONSTRAINT `FK_modules_promotions` FOREIGN KEY (`promo_id`) REFERENCES `promotions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` (`id`, `name`, `description`, `promo_id`, `created_at`) VALUES
	(1, 'XML', 'XML et base de donné avoncé', 5, '2021-12-20 23:29:09'),
	(2, 'Maintenance des logiciels', 'Maintenance des logiciels', 5, '2021-12-20 23:29:41'),
	(3, 'Recherch bibiliographi', 'Recherch bibiliographi', 5, '2021-12-20 23:30:18'),
	(4, 'GPI', 'Gestion Projet Informatique', 5, '2021-12-20 23:31:14'),
	(5, 'English', 'Anglais', 5, '2021-12-20 23:31:47');
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `promotions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `spec_id` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_promotions_specialities` (`spec_id`),
  CONSTRAINT `FK_promotions_specialities` FOREIGN KEY (`spec_id`) REFERENCES `specialities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `promotions` DISABLE KEYS */;
INSERT INTO `promotions` (`id`, `spec_id`, `level`, `created_at`) VALUES
	(1, 4, 1, '2021-12-20 23:26:16'),
	(2, 4, 2, '2021-12-20 23:26:27'),
	(3, 4, 3, '2021-12-20 23:26:55'),
	(4, 1, 1, '2021-12-20 23:26:53'),
	(5, 1, 2, '2021-12-20 23:27:06'),
	(6, 2, 1, '2021-12-20 23:27:26'),
	(7, 2, 2, '2021-12-20 23:28:00'),
	(8, 3, 1, '2021-12-20 23:28:01'),
	(9, 3, 2, '2021-12-20 23:28:02');
/*!40000 ALTER TABLE `promotions` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `specialities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `specialities` DISABLE KEYS */;
INSERT INTO `specialities` (`id`, `name`, `description`, `created_at`) VALUES
	(1, 'GL', 'Géni logiciel', '2021-12-20 23:22:20'),
	(2, 'GI', 'Géni informatique', '2021-12-20 23:22:44'),
	(3, 'RT', 'Réseau et télécominication', '2021-12-20 23:23:26'),
	(4, 'L', 'Licence', '2021-12-20 23:24:41');
/*!40000 ALTER TABLE `specialities` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(150) DEFAULT NULL,
  `lastname` varchar(150) DEFAULT NULL,
  `promo_id` int(11) DEFAULT NULL,
  `adresse` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_students_promotions` (`promo_id`),
  CONSTRAINT `FK_students_promotions` FOREIGN KEY (`promo_id`) REFERENCES `promotions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` (`id`, `firstname`, `lastname`, `promo_id`, `adresse`, `created_at`) VALUES
	(1, 'Ahmed', 'SARMOUM', 5, 'TEH', '2021-12-20 23:17:11'),
	(2, 'Amar', 'ould hamadouch', 5, 'tiaret', '2021-12-20 23:17:35'),
	(3, 'Ali', 'barça', 5, 'tiaret', '2021-12-20 23:19:30'),
	(4, 'Hocine ', 'KERTEL', 5, 'TEH', '2021-12-20 23:19:45');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
INSERT INTO `teachers` (`id`, `fullname`, `phone`, `created_at`) VALUES
	(1, 'Ahmed TASSALIT', '0565654545', '2021-12-20 23:20:12'),
	(2, 'Omar Talbi', '0767654345', '2021-12-20 23:20:39'),
	(3, 'Yacine KHAROUBI', '06565434', '2021-12-20 23:21:07');
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
