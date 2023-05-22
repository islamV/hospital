-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2023 at 05:48 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `ID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `Age` int(11) NOT NULL,
  `department` varchar(30) NOT NULL,
  `entry_date` date NOT NULL,
  `Doctor_Name` varchar(30) DEFAULT NULL,
  `Doctor_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`ID`, `name`, `Age`, `department`, `entry_date`, `Doctor_Name`, `Doctor_ID`) VALUES
(19929, 'islam', 21, 'Pediatric diseases', '2023-05-17', 'islam abdlekarim', 115200),
(123274, 'islam', 12, 'Pediatric diseases', '2023-05-17', 'islam abdelkarim', 115200),
(199297, 'islam', 55, 'Pediatric diseases', '2023-05-17', 'islam abdelkarim', 115200),
(19929722, 'islam', 15, 'Pediatric diseases', '2023-05-17', 'islam abdelkarim', 115200),
(199293423, 'khaled ali', 12, 'Pediatric diseases', '2023-05-17', 'islam abdelkarim', 115200);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `d_id` (`Doctor_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `d_id` FOREIGN KEY (`Doctor_ID`) REFERENCES `doctors` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
