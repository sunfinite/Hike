-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 26, 2010 at 06:29 PM
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `member`
--


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
  `MID` int(11) NOT NULL,
  PRIMARY KEY (`REG_NO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--
