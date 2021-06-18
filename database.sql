-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 28, 2010 at 02:18 AM
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
  `MID` int(5) NOT NULL,
  `PID` int(5) NOT NULL,
  `POOL_SID` tinyint(1) NOT NULL,
  PRIMARY KEY (`MID`,`PID`,`POOL_SID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `belongs_to`
--


-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `MID` int(5) NOT NULL,
  `LATITUDE` double(9,6) NOT NULL,
  `LONGITUDE` double(9,6) NOT NULL,
  `LOCALITY` int(20) DEFAULT NULL,
  `AREA` int(20) DEFAULT NULL,
  PRIMARY KEY (`MID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=124 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`MID`, `NAME`, `SEX`, `EMAIL_ID`, `MOBILE_NO`, `PASSWORD`) VALUES
(00113, 'g', 'M', 'g', 0, 'g'),
(00112, 'f', 'M', 'f', 0, 'f'),
(00111, 'e', 'M', 'e', 0, 'e'),
(00110, 'd', 'M', 'd', 0, 'd'),
(00109, 'shashi', 'M', 's', 2, 's'),
(00114, 'h', 'M', 'h', 0, 'h'),
(00115, 'i', 'M', 'i', 0, 'i'),
(00116, 'q', 'M', 'q', 0, 'q'),
(00117, 'w', 'M', 'w', 0, 'w'),
(00118, 'e', 'M', 'et', 0, 'e'),
(00119, 'z', 'M', 'z', 0, 'z'),
(00120, 'p', 'M', 'p', 0, 'p'),
(00121, 'j', 'F', 'j', 0, 'j'),
(00122, 'l', 'M', 'l', 0, 'l'),
(00123, 'm', 'M', 'm', 0, 'm');

-- --------------------------------------------------------

--
-- Table structure for table `pool`
--

CREATE TABLE IF NOT EXISTS `pool` (
  `PID` int(5) NOT NULL,
  `POOL_TYPE` tinyint(1) DEFAULT NULL,
  `PICKUP_DROP_POINT` varchar(25) DEFAULT NULL,
  `PICKUP_TIME` varchar(15) DEFAULT NULL,
  `DROP_TIME` varchar(15) DEFAULT NULL,
  `DAY_COUNT` int(7) DEFAULT NULL,
  `SELECT_SID` tinyint(1) DEFAULT NULL,
  KEY `PID` (`PID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pool`
--


-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE IF NOT EXISTS `vehicle` (
  `REG_NO` varchar(16) NOT NULL,
  `MODEL` varchar(20) NOT NULL,
  `COLOUR` varchar(10) NOT NULL,
  `VEHICLE_TYPE` tinyint(3) unsigned NOT NULL,
  `MID` int(5) NOT NULL,
  PRIMARY KEY (`REG_NO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`REG_NO`, `MODEL`, `COLOUR`, `VEHICLE_TYPE`, `MID`) VALUES
('a', 'a', 'a', 0, 0),
('s', 's', 's', 0, 0),
('d', 'd', 'd', 0, 0),
('e', 'e', 'e', 2, 0),
('f', 'f', 'f', 2, 0),
('g', 'g', 'g', 2, 0),
('h', 'h', 'h', 2, 0),
('i', 'i', 'i', 2, 0),
('q', 'q', 'q', 2, 0),
('w', 'w', 'w', 2, 0),
('z', 'z', 'z', 2, 0),
('p', 'p', 'p', 2, 0),
('j', 'j', 'j', 2, 0),
('l', 'l', 'l', 2, 0),
('m', 'm', 'm', 4, 0);
