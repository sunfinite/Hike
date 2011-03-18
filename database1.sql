-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 29, 2010 at 11:40 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `pool`
--

-- --------------------------------------------------------

--
-- Table structure for table `belongs_to`
--

CREATE TABLE IF NOT EXISTS `belongs_to` (
  `MID` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `PID` int(5) NOT NULL,
  `POOL_COUNT` tinyint(1) NOT NULL,
  PRIMARY KEY (`MID`,`PID`,`POOL_COUNT`),
  KEY `PID` (`PID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `belongs_to`
--

INSERT INTO `belongs_to` (`MID`, `PID`, `POOL_COUNT`) VALUES
(00001, 2, 0),
(00001, 3, 0),
(00002, 4, 0),
(00002, 5, 0),
(00004, 7, 0),
(00003, 14, 1),
(00003, 16, 1),
(00001, 17, 1),
(00001, 18, 1),
(00003, 20, 1),
(00004, 21, 1),
(00002, 22, 1),
(00002, 23, 1),
(00003, 24, 1),
(00005, 25, 1),
(00006, 26, 1),
(00019, 27, 1),
(00011, 28, 1),
(00007, 29, 1),
(00008, 30, 1),
(00009, 31, 1),
(00010, 32, 1),
(00012, 33, 1),
(00013, 34, 1),
(00014, 35, 1),
(00015, 36, 1),
(00016, 37, 1),
(00017, 38, 1),
(00018, 39, 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `MID` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `LATITUDE` double(9,6) NOT NULL,
  `LONGITUDE` double(9,6) NOT NULL,
  `LOCALITY` varchar(20) DEFAULT NULL,
  `AREA` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`MID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`MID`, `LATITUDE`, `LONGITUDE`, `LOCALITY`, `AREA`) VALUES
(00001, 12.959850, 77.528400, 'Income Tax Layout', 'Chandra Layout'),
(00002, 12.955002, 77.533178, 'Attiguppe', 'Chandra Layout'),
(00003, 12.990590, 77.585280, 'Golf Course', 'High Grounds'),
(00004, 12.985760, 77.584150, 'Golf Course', 'High Grounds'),
(00005, 12.935440, 77.535020, 'Attiguppe', 'Chandra layout'),
(00006, 12.893110, 77.564080, 'Bus stand', 'Majestic'),
(00007, 13.097916, 77.594178, 'railway station', 'Gandhi nagar'),
(00008, 13.110000, 77.600000, '3rd main', 'Yelanka'),
(00009, 13.005410, 77.537579, 'Maruthi temple', 'Maruthi nagar'),
(00010, 12.940011, 77.521454, 'ITI layout', 'Nayandahalli'),
(00011, 12.936545, 77.544745, 'Nehru road', 'Giri nagar'),
(00012, 12.936545, 77.544745, 'Vivekananda park', 'Banashankari'),
(00013, 12.927994, 77.535788, '2nd cross', 'Mukambika nagar'),
(00014, 12.959850, 77.528405, 'Attiguppe', 'Chandra layout'),
(00015, 12.929604, 77.532563, '2nd main', 'Pushpagiri nagar'),
(00016, 12.936545, 77.544745, '3rd main', 'Giri nagar'),
(00017, 13.037747, 77.519662, '5th cross', 'Vivekananda'),
(00018, 12.946618, 77.533996, 'BHEL', 'Dipanjali nagar'),
(00019, 12.893111, 77.564082, '3rd phase', 'Majestic');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `MID` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `NAME` varchar(25) NOT NULL,
  `SEX` varchar(1) NOT NULL,
  `EMAIL_ID` varchar(35) NOT NULL,
  `MOBILE_NO` bigint(10) unsigned NOT NULL,
  `PASSWORD` varchar(25) NOT NULL,
  PRIMARY KEY (`MID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`MID`, `NAME`, `SEX`, `EMAIL_ID`, `MOBILE_NO`, `PASSWORD`) VALUES
(00001, 'Sunil', 'M', 'sunil', 9916778133, 'sunil'),
(00002, 'Swaroop', 'M', 'swaroop', 9035206260, 'swaroop'),
(00003, 'Sankalp', 'M', 'sankalp', 9972206164, 'sankalp'),
(00004, 'Shashidhar S Patil', 'M', 'shashi', 9611781324, 'shashi'),
(00005, 'Ram', 'M', 'ram cool', 9973309876, 'ram'),
(00006, 'Mohan', 'M', 'mohan', 9938828383, 'mohan'),
(00007, 'Laxman', 'M', 'laxman', 9987754327, 'laxman'),
(00008, 'Rahim', 'M', 'rahim', 9982776354, 'rahim'),
(00009, 'John', 'M', 'john', 9873627364, 'john'),
(00010, 'Stella', 'F', 'stella', 9976652413, 'stella'),
(00011, 'Max', 'M', 'max', 9972206172, 'max'),
(00012, 'Rohan', 'M', 'rohan', 9879678547, '123'),
(00013, 'Roshan', 'M', 'roshan', 9978865643, '345'),
(00014, 'Mouna', 'F', 'mouna', 9987654634, 'mouna'),
(00015, 'Vrushali', 'F', 'vrushali', 9876587456, '12345'),
(00016, 'Kumar ', 'M', 'kumar', 9987763692, 'kumar'),
(00017, 'Russel', 'M', 'rus', 9845955768, 'rus'),
(00018, 'Rakesh', 'M', 'rak', 9448146432, 'rak'),
(00019, 'karan', 'M', 'karan', 9817266542, 'karan');

-- --------------------------------------------------------

--
-- Table structure for table `pool`
--

CREATE TABLE IF NOT EXISTS `pool` (
  `PID` int(5) NOT NULL AUTO_INCREMENT,
  `DATE` date NOT NULL,
  `GIVER_OR_TAKER` int(1) NOT NULL,
  `POOL_TYPE` tinyint(1) DEFAULT NULL,
  `PICKUP_DROP_POINT` varchar(25) DEFAULT NULL,
  `PICKUP_TIME` varchar(15) DEFAULT NULL,
  `DROP_TIME` varchar(15) DEFAULT NULL,
  `DAY_COUNT` int(7) DEFAULT NULL,
  `SELECT_SID` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`PID`),
  KEY `PID` (`PID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `pool`
--

INSERT INTO `pool` (`PID`, `DATE`, `GIVER_OR_TAKER`, `POOL_TYPE`, `PICKUP_DROP_POINT`, `PICKUP_TIME`, `DROP_TIME`, `DAY_COUNT`, `SELECT_SID`) VALUES
(2, '2010-11-29', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '2010-11-30', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '2010-11-30', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '2010-12-01', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '2010-11-30', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '2010-11-30', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '2010-02-28', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '2010-12-30', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '2010-10-30', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(20, '2010-09-30', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(21, '2010-12-30', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(22, '2010-12-30', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(23, '2010-12-29', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(24, '2010-12-29', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(25, '2010-11-30', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(26, '2010-11-30', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(27, '2010-11-30', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(28, '2010-11-30', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(29, '2010-11-30', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(30, '2010-11-30', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(31, '2010-11-30', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(32, '2010-11-30', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(33, '2010-11-30', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(34, '2010-11-30', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(35, '2010-11-30', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(36, '2010-11-30', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(37, '2010-11-30', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(38, '2010-11-30', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(39, '2010-11-30', 0, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE IF NOT EXISTS `vehicle` (
  `REG_NO` varchar(16) NOT NULL,
  `MODEL` varchar(20) NOT NULL,
  `COLOUR` varchar(10) NOT NULL,
  `VEHICLE_TYPE` tinyint(3) unsigned NOT NULL,
  `MID` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `CAPACITY` int(1) NOT NULL,
  PRIMARY KEY (`REG_NO`),
  KEY `MID` (`MID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`REG_NO`, `MODEL`, `COLOUR`, `VEHICLE_TYPE`, `MID`, `CAPACITY`) VALUES
('0987', 'Activa', 'Blue', 2, 00015, 1),
('1234', 'Audi', 'Red', 4, 00014, 3),
('1298', 'Innova', 'Red', 4, 00019, 3),
('1928', 'Kinetic', 'Green', 2, 00018, 1),
('2221', 'Audi', 'Silver', 4, 00011, 3),
('2345', 'Yamaha', 'Red', 2, 00005, 1),
('2348', 'Alto', 'Blue', 4, 00006, 2),
('3456', 'Activa', 'Red', 2, 00007, 1),
('3472', 'Maruti', 'Silver', 4, 00008, 3),
('3487', 'Safari', 'Black', 4, 00016, 3),
('4571', 'Pulsar', 'Yellw', 2, 00012, 1),
('6378', 'Honda', 'Black', 2, 00009, 1),
('6541', 'Safari', 'Ash', 4, 00017, 2),
('6666', 'Maruti', 'Black', 4, 00013, 2),
('9807', 'Tata', 'White', 4, 00010, 2),
('KA-02-P-9997', 'Activa', 'Black', 2, 00002, 1),
('KA-02-P-9998', 'Swift', 'Blue', 4, 00004, 3),
('KA-02-P-9999', 'Dio', 'Black', 2, 00001, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `belongs_to`
--
ALTER TABLE `belongs_to`
  ADD CONSTRAINT `belongs_to_ibfk_1` FOREIGN KEY (`PID`) REFERENCES `pool` (`PID`) ON DELETE CASCADE,
  ADD CONSTRAINT `belongs_to_ibfk_2` FOREIGN KEY (`MID`) REFERENCES `member` (`MID`) ON DELETE CASCADE;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`MID`) REFERENCES `member` (`MID`) ON DELETE CASCADE;

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`MID`) REFERENCES `member` (`MID`) ON DELETE CASCADE;
