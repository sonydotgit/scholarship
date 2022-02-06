-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 06, 2022 at 10:32 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scholarship`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `u_name` varchar(30) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`u_name`, `password`) VALUES
('admin', 'adminPass');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `app_id` varchar(10) NOT NULL,
  `c_code` varchar(10) DEFAULT NULL,
  `s_name` varchar(30) DEFAULT NULL,
  `aadhar` varchar(12) DEFAULT NULL,
  `reg_no` varchar(10) DEFAULT NULL,
  `prev_year_perc` decimal(10,0) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`app_id`, `c_code`, `s_name`, `aadhar`, `reg_no`, `prev_year_perc`, `status`) VALUES
('1643877913', 'bietdvg123', 'Bussa Guru', '123456789012', '4bd19cs111', '98', 'Sanctioned'),
('1643881998', 'bietdvg123', 'Dinjari', '098765432134', '4bd19ec001', '99', 'Application Submitted'),
('1643885995', 'bietdvg123', 'Sohan', '341215767451', '4bd19cs101', '97', 'Sanctioned');

-- --------------------------------------------------------

--
-- Table structure for table `bank_detail`
--

CREATE TABLE `bank_detail` (
  `app_id` varchar(10) DEFAULT NULL,
  `ifsc` varchar(15) DEFAULT NULL,
  `acc_no` varchar(15) DEFAULT NULL,
  `b_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank_detail`
--

INSERT INTO `bank_detail` (`app_id`, `ifsc`, `acc_no`, `b_name`) VALUES
('1643877913', 'BOB12345', 'ACC00021', 'Bank Of Barmuda'),
('1643881998', 'RAT001', 'ACCNO002', 'Bank of Palpatine'),
('1643885995', 'SBIN001', '445656157', 'SBI');

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `c_code` varchar(10) NOT NULL,
  `c_name` varchar(100) DEFAULT NULL,
  `c_password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`c_code`, `c_name`, `c_password`) VALUES
('bietdvg123', 'Bapuji Institute of Engineering and Technology', 'bietPass'),
('jgidvg1234', 'Jain Group of Institute', 'jgiPass'),
('sit022', 'Sohan Institue of Technology', 'sonyPass');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `app_id` varchar(10) DEFAULT NULL,
  `comments` varchar(200) DEFAULT NULL,
  `ratings` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `app_id` varchar(10) NOT NULL,
  `ph_no` char(10) DEFAULT NULL,
  `S_password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`app_id`, `ph_no`, `S_password`) VALUES
('1643877913', '9887624476', 'pAss123'),
('1643881998', '9026685598', 'LastPass'),
('1643885995', '9876543210', '123Pass');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`app_id`),
  ADD KEY `apfkcd` (`c_code`);

--
-- Indexes for table `bank_detail`
--
ALTER TABLE `bank_detail`
  ADD KEY `bkfkid` (`app_id`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`c_code`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD KEY `fbfkst` (`app_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`app_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `apfkcd` FOREIGN KEY (`c_code`) REFERENCES `college` (`c_code`) ON DELETE CASCADE,
  ADD CONSTRAINT `apfkid` FOREIGN KEY (`app_id`) REFERENCES `student` (`app_id`) ON DELETE CASCADE;

--
-- Constraints for table `bank_detail`
--
ALTER TABLE `bank_detail`
  ADD CONSTRAINT `bkfkid` FOREIGN KEY (`app_id`) REFERENCES `application` (`app_id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fbfkst` FOREIGN KEY (`app_id`) REFERENCES `student` (`app_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
