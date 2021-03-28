-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 28, 2021 at 01:52 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `storedatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentID` int(10) UNSIGNED NOT NULL,
  `departmentName` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `departmentManager` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentID`, `departmentName`, `departmentManager`) VALUES
(1, 'Bath', 'Michael'),
(2, 'Kitchen', 'John'),
(3, 'Bedroom', 'Liz');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `manufacturerID` int(10) UNSIGNED NOT NULL,
  `manufactureName` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `manufactureWebsite` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `departmentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`manufacturerID`, `manufactureName`, `manufactureWebsite`, `departmentID`) VALUES
(1, 'Cannon', 'http://www.cannonhome.com/', 1),
(2, 'InterDesign', 'http://www.interdesignusa.com/', 2),
(3, 'LinenSpa', 'http://www.linenspa.com/', 3),
(4, 'Dell', 'http://dell.com/', 4),
(5, 'Samsung', 'http://samsung.com/', 5);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(10) UNSIGNED NOT NULL,
  `productName` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `color` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(18,2) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `productPage` varchar(65) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `manufacturerID` int(11) DEFAULT NULL,
  `departmentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `color`, `price`, `quantity`, `productPage`, `manufacturerID`, `departmentID`) VALUES
(1, 'Bath Towel', 'Black', '5.75', 75, 'http://MyStore.com/bathtowel.php', 1, 1),
(2, 'Wash Cloth', 'White', '0.99', 225, 'http://MyStore.com/washcloth.php', 1, 1),
(3, 'Shower Curtain', 'White', '11.99', 73, 'http://MyStore.com/showercurtain.php', 2, 1),
(4, 'Pantry Organizer', 'Clear', '3.99', 52, 'http://MyStore.com/pantryorganizer.php', 2, 2),
(5, 'Storage Jar', 'Clear', '5.99', 18, 'http://MyStore.com/storagejar.php', 2, 2),
(6, 'Firm Pillow', 'White', '12.99', 24, 'http://MyStore.com/pillow.php', 1, 3),
(7, 'Comforter', 'White', '34.99', 12, 'http://MyStore.com/comforter.php', 3, 3),
(8, 'Rollaway Bed', 'Black', '249.99', 3, 'http://Mystore.com/rollaway.php', 3, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentID`);

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`manufacturerID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `departmentID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `manufacturerID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
