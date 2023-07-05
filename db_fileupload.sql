-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2023 at 08:40 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_fileupload`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_file`
--

CREATE TABLE `tbl_file` (
  `Id` int(11) NOT NULL,
  `types` varchar(50) CHARACTER SET utf8 NOT NULL,
  `sex` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `breed` varchar(100) CHARACTER SET utf8 NOT NULL,
  `tel` varchar(11) CHARACTER SET utf8 NOT NULL,
  `age` varchar(100) CHARACTER SET utf8 NOT NULL,
  `image` varchar(250) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_file`
--

INSERT INTO `tbl_file` (`Id`, `types`, `sex`, `name`, `breed`, `tel`, `age`, `image`) VALUES
(3, 'สุนัข', 'เพศชาย', 'ประยุท', 'Golden Retriever', '0836238510', '5', 'dog-puppy-on-garden-royalty-free-image-1586966191.jpg'),
(4, 'แมว', 'เพศหญิง', 'ประวิท', 'Persian', '0836238510', '4', 'Kemra2.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_file`
--
ALTER TABLE `tbl_file`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_file`
--
ALTER TABLE `tbl_file`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
