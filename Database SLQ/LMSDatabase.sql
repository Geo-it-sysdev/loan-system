-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for lms
CREATE DATABASE IF NOT EXISTS `lms` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lms`;

-- Dumping structure for table lms.tbl_barangays
CREATE TABLE IF NOT EXISTS `tbl_barangays` (
  `id` int NOT NULL AUTO_INCREMENT,
  `municipality_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `municipality_id` (`municipality_id`),
  CONSTRAINT `tbl_barangays_ibfk_1` FOREIGN KEY (`municipality_id`) REFERENCES `tbl_municipalities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=219 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table lms.tbl_borrower
CREATE TABLE IF NOT EXISTS `tbl_borrower` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(25) DEFAULT NULL,
  `lastname` varchar(25) DEFAULT NULL,
  `middlename` varchar(25) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL,
  `type_of_id` varchar(50) DEFAULT NULL,
  `valid_id_no` varchar(25) DEFAULT NULL,
  `photo` varchar(300) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table lms.tbl_collector
CREATE TABLE IF NOT EXISTS `tbl_collector` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `fullname` varchar(55) DEFAULT NULL,
  `collector_type` enum('Admin','User') DEFAULT 'Admin',
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact_no` varchar(25) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `photo` varchar(300) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table lms.tbl_interest_rate
CREATE TABLE IF NOT EXISTS `tbl_interest_rate` (
  `id` int NOT NULL AUTO_INCREMENT,
  `interest_rate` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table lms.tbl_loan
CREATE TABLE IF NOT EXISTS `tbl_loan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `borrower_id` int DEFAULT NULL,
  `loan_purpose` varchar(50) DEFAULT NULL,
  `co_maker` varchar(50) DEFAULT NULL,
  `co_maker_contact` varchar(50) DEFAULT NULL,
  `relationship` varchar(50) DEFAULT NULL,
  `collateral` varchar(50) DEFAULT NULL,
  `loan_plan` varchar(50) DEFAULT NULL,
  `effective_date` date DEFAULT NULL,
  `loan_amount` varchar(55) DEFAULT NULL,
  `interest_rate` varchar(25) DEFAULT NULL,
  `monthly_payment` varchar(55) DEFAULT NULL,
  `unearned_interest` varchar(55) DEFAULT NULL,
  `total_balance` varchar(55) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `status` enum('Pending','Released','Partial','Fully') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table lms.tbl_municipalities
CREATE TABLE IF NOT EXISTS `tbl_municipalities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `province_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table lms.tbl_payment
CREATE TABLE IF NOT EXISTS `tbl_payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `loan_id` int DEFAULT NULL,
  `borrower_id` int DEFAULT NULL,
  `ref_no` varchar(55) DEFAULT NULL,
  `collector` varchar(55) DEFAULT NULL,
  `payment_amount` varchar(50) DEFAULT NULL,
  `penalty` varchar(25) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `date_payment` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table lms.tbl_provinces
CREATE TABLE IF NOT EXISTS `tbl_provinces` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
