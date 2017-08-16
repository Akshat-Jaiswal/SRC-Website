-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 20, 2015 at 10:14 AM
-- Server version: 5.1.33
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `src`
--

-- --------------------------------------------------------

--
-- Table structure for table `aayaam`
--

CREATE TABLE IF NOT EXISTS `aayaam` (
  `Title` varchar(500) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `EDate` date NOT NULL,
  `Link` varchar(100) DEFAULT NULL,
  `LDate` date NOT NULL,
  `imageURL` varchar(100) NOT NULL,
  `statement` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Title`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aayaam`
--


-- --------------------------------------------------------

--
-- Table structure for table `committee members`
--

CREATE TABLE IF NOT EXISTS `committee members` (
  `Email` varchar(50) NOT NULL,
  `Department` varchar(50) NOT NULL,
  `Admin` tinyint(1) NOT NULL DEFAULT '0',
  `Password` varchar(25) NOT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `committee members`
--

INSERT INTO `committee members` (`Email`, `Department`, `Admin`, `Password`) VALUES
('akshatjaiswal1995@gmail.com', 'Software Team', 1, 'akshat06');

-- --------------------------------------------------------

--
-- Table structure for table `founders`
--

CREATE TABLE IF NOT EXISTS `founders` (
  `Name` varchar(50) NOT NULL,
  `Designation` varchar(100) NOT NULL,
  `Year` int(11) NOT NULL,
  `imageURL` varchar(100) NOT NULL,
  PRIMARY KEY (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `founders`
--

INSERT INTO `founders` (`Name`, `Designation`, `Year`, `imageURL`) VALUES
('Mr. Manish panchal', 'Faculty Coordinator(Electonics and TeleCommunication Department)', 0, './images/founders/manishsir.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `Title` varchar(50) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `imageURL` varchar(100) NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gallery`
--


-- --------------------------------------------------------

--
-- Table structure for table `gcm`
--

CREATE TABLE IF NOT EXISTS `gcm` (
  `Id` varchar(50) DEFAULT NULL,
  `GCMid` varchar(300) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  KEY `Id` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gcm`
--

INSERT INTO `gcm` (`Id`, `GCMid`, `Name`) VALUES
(NULL, 'APA91bG_qMx9Q4XQhWbAc2p02nxkjUrC3iFzsF9VHpwQbnlExeDUaXxcZ7Sh_kBebBScMr4BCf6BK4LK6GEDrDQfXAL8mz5bMV4HtAyrzgFy-jcr92Q9GptabYzcYbOL1wmPYwXljn8FbTesXL5k72fsEHlOgEH-sJy0sdU0yEBaI6mGYGqTxrE', '');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Contact` text NOT NULL,
  `Branch` varchar(5) NOT NULL,
  `College` varchar(100) NOT NULL,
  PRIMARY KEY (`Email`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=150004 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`ID`, `Name`, `Email`, `Contact`, `Branch`, `College`) VALUES
(150001, 'Akshat Jaiswal', 'akshatjaiswal1995@gmail.com', '8989779509', 'CS', 'Shri Govindram Seksaria Institute Of Technology And Science');

-- --------------------------------------------------------

--
-- Table structure for table `mentors`
--

CREATE TABLE IF NOT EXISTS `mentors` (
  `Pid` int(11) NOT NULL,
  `Mid` varchar(50) NOT NULL,
  PRIMARY KEY (`Pid`,`Mid`),
  KEY `Mid` (`Mid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mentors`
--


-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `Message` varchar(200) NOT NULL,
  `NDate` date NOT NULL,
  `NTime` time NOT NULL,
  `Recepients` varchar(500) NOT NULL,
  `SentBy` varchar(50) NOT NULL,
  PRIMARY KEY (`NDate`,`NTime`),
  KEY `SentBy` (`SentBy`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`Message`, `NDate`, `NTime`, `Recepients`, `SentBy`) VALUES
('', '2015-02-14', '04:13:17', 'Everyone', 'akshatjaiswal1995@gmail.com'),
('', '2015-02-14', '04:13:19', 'Everyone', 'akshatjaiswal1995@gmail.com'),
('', '2015-02-14', '04:13:22', 'Everyone', 'akshatjaiswal1995@gmail.com'),
('', '2015-02-14', '04:13:23', 'Everyone', 'akshatjaiswal1995@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE IF NOT EXISTS `participants` (
  `TeamName` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Contact` varchar(12) NOT NULL,
  `Address` varchar(150) NOT NULL,
  `College` varchar(150) NOT NULL,
  PRIMARY KEY (`TeamName`,`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`TeamName`, `Name`, `Email`, `Contact`, `Address`, `College`) VALUES
('Blasters', 'akshat', 'akshatjaiswal1995@gmail.com', '8989449509', 'SGSits', 'SGSITS');

-- --------------------------------------------------------

--
-- Table structure for table `participatingteams`
--

CREATE TABLE IF NOT EXISTS `participatingteams` (
  `TeamName` varchar(100) NOT NULL,
  `Event` varchar(50) NOT NULL,
  `RegistrationDate` date NOT NULL,
  PRIMARY KEY (`TeamName`,`Event`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participatingteams`
--

INSERT INTO `participatingteams` (`TeamName`, `Event`, `RegistrationDate`) VALUES
('Blasters', 'Sarthi', '2015-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(50) NOT NULL,
  `PDate` datetime NOT NULL,
  `Description` varchar(500) NOT NULL,
  `PostedBy` varchar(50) NOT NULL,
  `ImageURL` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `PostedBy` (`PostedBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `posts`
--


-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(50) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `ImageURL` varchar(100) NOT NULL,
  `Report` varchar(150) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `projects`
--


-- --------------------------------------------------------

--
-- Table structure for table `projectteams`
--

CREATE TABLE IF NOT EXISTS `projectteams` (
  `Pid` int(11) NOT NULL,
  `Mid` varchar(50) NOT NULL,
  PRIMARY KEY (`Mid`),
  KEY `Pid` (`Pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projectteams`
--


-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `Title` varchar(100) NOT NULL,
  `Link` varchar(100) NOT NULL,
  `RDate` date NOT NULL,
  `UploadedBy` varchar(50) NOT NULL,
  PRIMARY KEY (`Title`),
  KEY `UploadedBy` (`UploadedBy`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--


-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

CREATE TABLE IF NOT EXISTS `workshops` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(50) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `WDate` date NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  `ImageURL` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `workshops`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `committee members`
--
ALTER TABLE `committee members`
  ADD CONSTRAINT `committee members_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `members` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mentors`
--
ALTER TABLE `mentors`
  ADD CONSTRAINT `mentors_ibfk_1` FOREIGN KEY (`Pid`) REFERENCES `projects` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mentors_ibfk_2` FOREIGN KEY (`Mid`) REFERENCES `committee members` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`SentBy`) REFERENCES `committee members` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_ibfk_1` FOREIGN KEY (`TeamName`) REFERENCES `participatingteams` (`TeamName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `Post By` FOREIGN KEY (`PostedBy`) REFERENCES `committee members` (`Email`);

--
-- Constraints for table `projectteams`
--
ALTER TABLE `projectteams`
  ADD CONSTRAINT `projectteams_ibfk_1` FOREIGN KEY (`Pid`) REFERENCES `projects` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projectteams_ibfk_2` FOREIGN KEY (`Mid`) REFERENCES `members` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`UploadedBy`) REFERENCES `committee members` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;
