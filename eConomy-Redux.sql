-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 10, 2019 at 09:11 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `economy_redux`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_types`
--

DROP TABLE IF EXISTS `company_types`;
CREATE TABLE IF NOT EXISTS `company_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `industry_type` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `max_workers` int(11) NOT NULL,
  `production_per_worker` int(11) NOT NULL,
  `upgrade_cost` int(11) NOT NULL,
  `production_growth` int(11) NOT NULL,
  `upgrade_points` int(11) NOT NULL,
  `upgrade_max_workers` int(11) NOT NULL,
  `hire_cost` int(11) NOT NULL,
  `fire_cost` int(11) NOT NULL,
  `max_level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_types`
--

INSERT INTO `company_types` (`id`, `name`, `industry_type`, `cost`, `points`, `max_workers`, `production_per_worker`, `upgrade_cost`, `production_growth`, `upgrade_points`, `upgrade_max_workers`, `hire_cost`, `fire_cost`, `max_level`) VALUES
(1, 'Budka z Hotdogami', 1, 400, 10, 2, 100, 500, 25, 5, 2, 25, 100, 5),
(2, 'Minibar', 1, 800, 20, 5, 130, 1300, 40, 10, 10, 50, 150, 10),
(3, 'Sklep na rogu', 2, 600, 5, 2, 110, 250, 15, 3, 2, 15, 100, 5),
(4, 'Spożywczak', 2, 1600, 20, 15, 120, 2400, 20, 25, 20, 40, 130, 5),
(5, 'Obuwniczy', 3, 500, 2, 3, 30, 600, 15, 1, 1, 25, 100, 5),
(6, 'Odzieżowy', 3, 600, 2, 5, 40, 800, 15, 1, 1, 30, 100, 5),
(7, 'Fryzjer', 4, 1000, 5, 3, 200, 1500, 25, 3, 2, 60, 150, 10),
(8, 'Kosmetyczka', 4, 1500, 8, 4, 250, 2500, 30, 5, 3, 80, 170, 10),
(9, 'Salon gier', 5, 2500, 25, 6, 400, 5000, 60, 50, 4, 50, 150, 5),
(10, 'Centrum rozrywki', 5, 5000, 40, 10, 500, 7500, 60, 80, 10, 80, 150, 10),
(11, 'Kasa oszczędnościowa', 6, 10000, 100, 2, 500, 1500, 50, 100, 3, 100, 250, 5),
(12, 'Sad', 7, 25000, 200, 100, 50, 25000, 50, 150, 150, 40, 100, 10),
(13, 'Fabryka płatków', 8, 50000, 500, 100, 75, 75000, 60, 500, 250, 60, 100, 10),
(14, 'Kurza ferma', 9, 50000, 400, 50, 60, 15000, 20, 50, 10, 80, 160, 20),
(15, 'Fabryka telewizorów', 10, 100000, 1000, 100, 30, 125000, 70, 800, 200, 150, 150, 50),
(16, 'Fabryka samochodów', 11, 200000, 5000, 250, 100, 250000, 90, 2500, 250, 150, 150, 25),
(17, 'Fabryka czołgów', 12, 1000000, 10000, 100, 1000, 1500000, 80, 5000, 50, 150, 250, 10),
(18, 'Krawiec', 13, 350, 1, 1, 14, 50, 10, 1, 1, 15, 30, 5),
(19, 'Fabryka jeansów', 14, 60000, 200, 50, 32, 14000, 25, 140, 15, 70, 150, 15),
(20, 'Fabryka kozaków', 15, 75000, 300, 80, 36, 18000, 40, 180, 20, 65, 130, 20),
(21, 'Fabryka plecaków', 16, 100000, 100, 50, 18, 5000, 10, 50, 50, 35, 80, 10),
(22, 'Kopalnia diamentów', 17, 2000000, 50, 50, 8000, 5000000, 70, 25000, 25, 250, 500, 5),
(23, 'Platforma wiertnicza', 18, 5000000, 5, 100, 8000, 5000000, 90, 100, 100, 500, 1000, 5),
(24, 'Platforma gazowa', 19, 1000000, 5, 20, 3000, 1000000, 75, 150, 10, 400, 1500, 25),
(25, 'Elektrownia atomowa', 20, 10000000, 1, 500, 16000, 50000000, 150, 1, 100, 10000, 50000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `exchange`
--

DROP TABLE IF EXISTS `exchange`;
CREATE TABLE IF NOT EXISTS `exchange` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `last_change` int(11) DEFAULT NULL,
  `raw_materials` int(11) DEFAULT NULL,
  `raw_materials_hossa` int(1) NOT NULL,
  `fabrics` int(11) DEFAULT NULL,
  `fabrics_hossa` int(1) NOT NULL,
  `equipments` int(11) DEFAULT NULL,
  `equipments_hossa` int(1) NOT NULL,
  `food` int(11) DEFAULT NULL,
  `food_hossa` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exchange`
--

INSERT INTO `exchange` (`id`, `last_change`, `raw_materials`, `raw_materials_hossa`, `fabrics`, `fabrics_hossa`, `equipments`, `equipments_hossa`, `food`, `food_hossa`, `created_at`, `updated_at`) VALUES
(1, 1547154518, 40, 1, 15, 0, 59, 1, 5, 0, '2018-10-29 20:22:52', '2019-01-10 20:08:38');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_events`
--

DROP TABLE IF EXISTS `exchange_events`;
CREATE TABLE IF NOT EXISTS `exchange_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(120) NOT NULL,
  `type` int(1) NOT NULL,
  `content` varchar(120) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `industry_types`
--

DROP TABLE IF EXISTS `industry_types`;
CREATE TABLE IF NOT EXISTS `industry_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `industry_types`
--

INSERT INTO `industry_types` (`id`, `name`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'Bary i Restauracje', 0, '2018-09-29 11:04:17', '2018-09-29 11:04:17'),
(2, 'Sklepy spożywcze', 0, '2018-09-29 11:04:38', '2018-09-29 11:04:38'),
(3, 'Sklepy z tekstyliami', 0, '2018-09-29 11:04:52', '2018-09-29 11:04:52'),
(4, 'Fryzjer/Kosmetyczka', 0, '2018-09-29 11:05:05', '2018-09-29 11:05:05'),
(5, 'Salony gier', 0, '2018-09-29 11:05:16', '2018-09-29 11:05:16'),
(6, 'Bankowość', 0, '2018-09-29 11:05:23', '2018-09-29 11:05:40'),
(7, 'Sady', 4, '2018-09-29 11:05:59', '2018-09-29 11:05:59'),
(8, 'Wytwórnie żywności', 4, '2018-09-29 11:06:12', '2018-09-29 11:06:12'),
(9, 'Hodowcy zwierząt', 4, '2018-09-29 11:06:23', '2018-09-29 11:06:23'),
(10, 'Fabryki sprzętu', 3, '2018-09-29 11:06:34', '2018-09-29 11:06:34'),
(11, 'Fabryki motoryzacyjne', 3, '2018-09-29 11:06:47', '2018-09-29 11:06:47'),
(12, 'Fabryki broni', 3, '2018-09-29 11:07:09', '2018-09-29 11:07:09'),
(13, 'Szwalnie, krawcowe', 2, '2018-09-29 11:07:21', '2018-09-29 11:07:21'),
(14, 'Fabryki ubrań', 2, '2018-09-29 11:07:30', '2018-09-29 11:07:30'),
(15, 'Fabryki butów', 2, '2018-09-29 11:07:40', '2018-09-29 11:07:42'),
(16, 'Fabryki torebek', 2, '2018-09-29 11:08:45', '2018-09-29 11:08:45'),
(17, 'Kopalnie minerałów', 1, '2018-09-29 11:08:57', '2018-09-29 11:08:57'),
(18, 'Rafinerie ropy', 1, '2018-09-29 11:09:08', '2018-09-29 11:09:08'),
(19, 'Rafinerie gazu', 1, '2018-09-29 11:09:16', '2018-09-29 11:09:16'),
(20, 'Elektrownie', 1, '2018-09-29 11:09:27', '2018-09-29 11:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `cash` int(11) NOT NULL DEFAULT '1000',
  `bank_acc` int(11) NOT NULL DEFAULT '0',
  `points` int(11) NOT NULL DEFAULT '0',
  `banned` tinyint(4) NOT NULL DEFAULT '0',
  `avatar` tinyint(4) NOT NULL DEFAULT '0',
  `last_action` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_storage`
--

DROP TABLE IF EXISTS `user_storage`;
CREATE TABLE IF NOT EXISTS `user_storage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `raw_materials` int(11) NOT NULL DEFAULT '0',
  `fabrics` int(11) NOT NULL DEFAULT '0',
  `equipments` int(11) NOT NULL DEFAULT '0',
  `food` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
