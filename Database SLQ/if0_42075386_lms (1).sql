-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql103.infinityfree.com
-- Generation Time: Jun 16, 2026 at 03:55 AM
-- Server version: 11.4.12-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_42075386_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barangays`
--

CREATE TABLE `tbl_barangays` (
  `id` int(10) NOT NULL,
  `municipality_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_barangays`
--

INSERT INTO `tbl_barangays` (`id`, `municipality_id`, `name`) VALUES
(1, 1, 'Alejawan'),
(2, 1, 'Balili'),
(3, 1, 'Boctol'),
(4, 1, 'Buyog'),
(5, 1, 'Bunga Ilaya'),
(6, 1, 'Bunga Mar'),
(7, 1, 'Cabunga-an'),
(8, 1, 'Calabacita'),
(9, 1, 'Cambugason'),
(10, 1, 'Can-ipol'),
(11, 1, 'Canjulao'),
(12, 1, 'Cantagay'),
(13, 1, 'Cantuyoc'),
(14, 1, 'Can-uba'),
(15, 1, 'Can-upao'),
(16, 1, 'Faraon'),
(17, 1, 'Ipil'),
(18, 1, 'Kinagbaan'),
(19, 1, 'Laca'),
(20, 1, 'Larapan'),
(21, 1, 'Lonoy'),
(22, 1, 'Looc'),
(23, 1, 'Malbog'),
(24, 1, 'Mayana'),
(25, 1, 'Naatang'),
(26, 1, 'Nausok'),
(27, 1, 'Odiong'),
(28, 1, 'Pagina'),
(29, 1, 'Pangdan'),
(30, 1, 'Poblacion'),
(31, 1, 'Tubod Mar'),
(32, 1, 'Tubod Monte'),
(33, 2, 'Alejawan'),
(34, 2, 'Angilan'),
(35, 2, 'Anibongan'),
(36, 2, 'Bangwalog'),
(37, 2, 'Cansuhay'),
(38, 2, 'Danao'),
(39, 2, 'Duay'),
(40, 2, 'Guinsularan'),
(41, 2, 'Imelda'),
(42, 2, 'Itum'),
(43, 2, 'Langkis'),
(44, 2, 'Lobogon'),
(45, 2, 'Madua Norte'),
(46, 2, 'Madua Sur'),
(47, 2, 'Mambool'),
(48, 2, 'Mawi'),
(49, 2, 'Payao'),
(50, 2, 'San Antonio'),
(51, 2, 'San Isidro'),
(52, 2, 'San Pedro'),
(53, 2, 'Taytay'),
(54, 3, 'Basdio'),
(55, 3, 'Bato'),
(56, 3, 'Bayong'),
(57, 3, 'Biabas'),
(58, 3, 'Bulawan'),
(59, 3, 'Cabantian'),
(60, 3, 'Canhaway'),
(61, 3, 'Cansiwang'),
(62, 3, 'Casbu'),
(63, 3, 'Catungawan Norte'),
(64, 3, 'Catungawan Sur'),
(65, 3, 'Guinacot'),
(66, 3, 'Guio-ang'),
(67, 3, 'Lombog'),
(68, 3, 'Mayuga'),
(69, 3, 'Sawang (Poblacion)'),
(70, 3, 'Tabajan (Poblacion)'),
(71, 3, 'Tabunok'),
(72, 3, 'Trinidad'),
(73, 4, 'Abijilan'),
(74, 4, 'Antipolo'),
(75, 4, 'Basiao'),
(76, 4, 'Cagwang'),
(77, 4, 'Calma'),
(78, 4, 'Cambuyo'),
(79, 4, 'Canayaon East'),
(80, 4, 'Canayaon West'),
(81, 4, 'Candanas'),
(82, 4, 'Candulao'),
(83, 4, 'Catmon'),
(84, 4, 'Cayam'),
(85, 4, 'Cupa'),
(86, 4, 'Datag'),
(87, 4, 'Estaca'),
(88, 4, 'Libertad'),
(89, 4, 'Lungsodaan East'),
(90, 4, 'Lungsodaan West'),
(91, 4, 'Malinao'),
(92, 4, 'Manaba'),
(93, 4, 'Pasong'),
(94, 4, 'Poblacion East'),
(95, 4, 'Poblacion West'),
(96, 4, 'Sacaon'),
(97, 4, 'Sampong'),
(98, 4, 'Tabuan'),
(99, 4, 'Togbongon'),
(100, 4, 'Ulbujan East'),
(101, 4, 'Ulbujan West'),
(102, 4, 'Victoria'),
(103, 5, 'Abihilan'),
(104, 5, 'Anoling'),
(105, 5, 'Boyo-an'),
(106, 5, 'Cadapdapan'),
(107, 5, 'Cambane'),
(108, 5, 'Can-olin'),
(109, 5, 'Canawa'),
(110, 5, 'Cogtong'),
(111, 5, 'La Union'),
(112, 5, 'Luan'),
(113, 5, 'Lungsoda-an'),
(114, 5, 'Mahangin'),
(115, 5, 'Pagahat'),
(116, 5, 'Panadtaran'),
(117, 5, 'Panas'),
(118, 5, 'Poblacion'),
(119, 5, 'San Isidro'),
(120, 5, 'Tambongan'),
(121, 5, 'Tawid'),
(122, 5, 'Tubod (Tres Rosas)'),
(123, 5, 'Tugas');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_borrower`
--

CREATE TABLE `tbl_borrower` (
  `id` int(10) NOT NULL,
  `firstname` varchar(25) DEFAULT NULL,
  `lastname` varchar(25) DEFAULT NULL,
  `middlename` varchar(25) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL,
  `type_of_id` varchar(50) DEFAULT NULL,
  `valid_id_no` varchar(25) DEFAULT NULL,
  `photo` varchar(300) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_borrower`
--

INSERT INTO `tbl_borrower` (`id`, `firstname`, `lastname`, `middlename`, `address`, `email`, `contact_no`, `type_of_id`, `valid_id_no`, `photo`, `date_created`) VALUES
(1, 'Patrick Henry', 'Bersaluna', 'Valejos', 'Purok 1, Guinacot, Guindulman, Bohol', 'patrickbersaluna@gmail.com', '09876543217', 'Driver\'s License', '10126-1194-2026', 'assets/borrower/patrickhenry_bersaluna.png', '2026-06-09 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_collector`
--

CREATE TABLE `tbl_collector` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `collector_type` enum('Admin','User') NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(25) NOT NULL,
  `photo` varchar(300) NOT NULL,
  `password` varchar(300) DEFAULT NULL,
  `date_created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_collector`
--

INSERT INTO `tbl_collector` (`id`, `fullname`, `username`, `collector_type`, `address`, `email`, `contact_no`, `photo`, `password`, `date_created`) VALUES
(1, 'Geovanne Berro Daganato', 'vanne', 'Admin', 'Ambacon, Langkis, Duero, Bohol', 'geovannedaganato9@gmail.com', '09925229456', 'assets/collector/Geovanne_Berro_Daganato.png', '$2y$10$9mlluAdFvwX4nGQhKw3KmOOeGIdSmnmZbdV73DJGTfwxMIaaqbbme', '2026-06-09 00:00:00'),
(2, 'Nikke Joy Jamisola', 'nikke', 'Admin', 'Ambacon, Langkis, Duero, Bohol', 'nikkejamisola4@gmail.com', '0993141451500', 'assets/collector/Nikke_Joy_Jamisola.png', '$2y$10$9mlluAdFvwX4nGQhKw3KmOOeGIdSmnmZbdV73DJGTfwxMIaaqbbme', '2026-06-09 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_interest_rate`
--

CREATE TABLE `tbl_interest_rate` (
  `id` int(10) NOT NULL,
  `interest_rate` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_interest_rate`
--

INSERT INTO `tbl_interest_rate` (`id`, `interest_rate`) VALUES
(1, 3),
(2, 5),
(3, 7),
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loan`
--

CREATE TABLE `tbl_loan` (
  `id` int(10) NOT NULL,
  `borrower_id` int(10) DEFAULT NULL,
  `co_maker` varchar(50) DEFAULT NULL,
  `loan_plan` varchar(50) DEFAULT NULL,
  `effective_date` date DEFAULT NULL,
  `loan_amount` decimal(12,2) DEFAULT NULL,
  `interest_rate` decimal(5,2) DEFAULT NULL,
  `monthly_payment` decimal(12,2) DEFAULT NULL,
  `unearned_interest` decimal(12,2) DEFAULT NULL,
  `total_balance` decimal(12,2) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `status` enum('Pending','Partial','Fully') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_loan`
--

INSERT INTO `tbl_loan` (`id`, `borrower_id`, `co_maker`, `loan_plan`, `effective_date`, `loan_amount`, `interest_rate`, `monthly_payment`, `unearned_interest`, `total_balance`, `date_created`, `status`) VALUES
(3, 1, 'Jason Baldesco', '3 months', '2026-06-30', '5000.00', '3.00', '1816.67', '450.00', '5450.00', '2026-06-10 08:14:46', 'Fully');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_municipalities`
--

CREATE TABLE `tbl_municipalities` (
  `id` int(10) NOT NULL,
  `province_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_municipalities`
--

INSERT INTO `tbl_municipalities` (`id`, `province_id`, `name`) VALUES
(1, 1, 'Jagna'),
(2, 1, 'Duero'),
(3, 1, 'Guindulman'),
(4, 1, 'Garcia Hernandez'),
(5, 1, 'Candijay');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(10) NOT NULL,
  `loan_id` int(10) DEFAULT NULL,
  `borrower_id` int(10) DEFAULT NULL,
  `ref_no` varchar(55) DEFAULT NULL,
  `collector` varchar(55) DEFAULT NULL,
  `payment_amount` decimal(12,2) DEFAULT NULL,
  `penalty` decimal(12,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `date_payment` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`id`, `loan_id`, `borrower_id`, `ref_no`, `collector`, `payment_amount`, `penalty`, `payment_method`, `date_payment`) VALUES
(3, 3, 1, '000003', 'Nikke Joy Jamisola', '1816.67', '0.00', 'Cash', '2026-06-11 15:06:29'),
(4, 3, 1, '000003', 'Nikke Joy Jamisola', '1816.67', '0.00', 'GCash', '2026-06-11 15:32:05'),
(5, 3, 1, '000003', 'Nikke Joy Jamisola', '116.66', '0.00', 'Cash', '2026-06-11 18:08:06'),
(6, 3, 1, '000003', 'Nikke Joy Jamisola', '1700.00', '0.00', 'Cash', '2026-06-11 18:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_provinces`
--

CREATE TABLE `tbl_provinces` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_provinces`
--

INSERT INTO `tbl_provinces` (`id`, `name`) VALUES
(1, 'Bohol');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barangays`
--
ALTER TABLE `tbl_barangays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `municipality_id` (`municipality_id`);

--
-- Indexes for table `tbl_borrower`
--
ALTER TABLE `tbl_borrower`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_collector`
--
ALTER TABLE `tbl_collector`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_interest_rate`
--
ALTER TABLE `tbl_interest_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_loan`
--
ALTER TABLE `tbl_loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_municipalities`
--
ALTER TABLE `tbl_municipalities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_provinces`
--
ALTER TABLE `tbl_provinces`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_barangays`
--
ALTER TABLE `tbl_barangays`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `tbl_borrower`
--
ALTER TABLE `tbl_borrower`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_collector`
--
ALTER TABLE `tbl_collector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_interest_rate`
--
ALTER TABLE `tbl_interest_rate`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_loan`
--
ALTER TABLE `tbl_loan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_municipalities`
--
ALTER TABLE `tbl_municipalities`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_provinces`
--
ALTER TABLE `tbl_provinces`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_barangays`
--
ALTER TABLE `tbl_barangays`
  ADD CONSTRAINT `tbl_barangays_ibfk_1` FOREIGN KEY (`municipality_id`) REFERENCES `tbl_municipalities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
