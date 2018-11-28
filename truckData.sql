#
# DUMP FILE
#
# Database is ported from MS Access
#------------------------------------------------------------------
# Created using "MS Access to MySQL" form http://www.bullzip.com
# Program Version 5.5.282
#
# OPTIONS:
#   sourcefilename=C:/wamp64/www/trucking/truckData.accdb
#   sourceusername=
#   sourcepassword=
#   sourcesystemdatabase=
#   destinationdatabase=newTruckData
#   storageengine=MyISAM
#   dropdatabase=0
#   createtables=1
#   unicode=1
#   autocommit=1
#   transferdefaultvalues=0
#   transferindexes=1
#   transferautonumbers=0
#   transferrecords=1
#   columnlist=1
#   tableprefix=
#   negativeboolean=0
#   ignorelargeblobs=0
#   memotype=LONGTEXT
#   datetimetype=DATETIME
#

CREATE DATABASE IF NOT EXISTS `newTruckData`;
USE `newTruckData`;

#
# Table structure for table 'admin'
#

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `adminID` INTEGER NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255),
  `password` VARCHAR(255),
  `firstName` VARCHAR(255),
  `lastName` VARCHAR(255),
  `type` VARCHAR(255),
  PRIMARY KEY (`adminID`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'admin'
#

INSERT INTO `admin` (`adminID`, `email`, `password`, `firstName`, `lastName`, `type`) VALUES (1, 'root@root.com', 'pass', 'Xiaqiao', 'Lee', 'A');
INSERT INTO `admin` (`adminID`, `email`, `password`, `firstName`, `lastName`, `type`) VALUES (2, 'admin@ri.com', 'pass', 'Kolkhozobod', 'Jenkins', 'A');
INSERT INTO `admin` (`adminID`, `email`, `password`, `firstName`, `lastName`, `type`) VALUES (3, 'athickpenny8@xrea.com', 'pass', 'Verkhnyaya Tura', 'Masters', 'A');
# 3 records

#
# Table structure for table 'client'
#

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `clientID` INTEGER NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255),
  `password` VARCHAR(255),
  `clientName` VARCHAR(255),
  `baseLocation` VARCHAR(255),
  `userName` VARCHAR(255),
  `type` VARCHAR(255),
  PRIMARY KEY (`clientID`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'client'
#

INSERT INTO `client` (`clientID`, `email`, `password`, `clientName`, `baseLocation`, `userName`, `type`) VALUES (1, 'wangEnt@wang.com', 'yamero', 'Wang Enterprises', 'Dongxiang', 'wangEnt', 'C');
INSERT INTO `client` (`clientID`, `email`, `password`, `clientName`, `baseLocation`, `userName`, `type`) VALUES (2, 'client@weyland.com', 'client', 'Weyland-Yutani', 'Salawu', 'Yutani', 'C');
INSERT INTO `client` (`clientID`, `email`, `password`, `clientName`, `baseLocation`, `userName`, `type`) VALUES (3, 'knight@ares.com', 'client', 'Ares Macrotechnology', 'New York', 'Ares', 'C');
# 3 records

#
# Table structure for table 'fufillments'
#

DROP TABLE IF EXISTS `fufillments`;

CREATE TABLE `fufillments` (
  `fufillID` INTEGER NOT NULL AUTO_INCREMENT,
  `clientID` DOUBLE NULL,
  `clientName` VARCHAR(255),
  `origin` VARCHAR(255),
  `destination` VARCHAR(255),
  `miles` DOUBLE NULL,
  `rate` DOUBLE NULL,
  `ratePerMile` DOUBLE NULL,
  `weight` DOUBLE NULL,
  `dateListed` DATETIME,
  `CDL` VARCHAR(255),
  `dateFulfilled` DATETIME,
  INDEX (`clientID`),
  PRIMARY KEY (`fufillID`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'fufillments'
#

INSERT INTO `fufillments` (`fufillID`, `clientID`, `clientName`, `origin`, `destination`, `miles`, `rate`, `ratePerMile`, `weight`, `dateListed`, `CDL`, `dateFulfilled`) VALUES (11, 1, 'Wang Enterprises', 'Dois Vizinhos', 'Wassa-Akropong', 2038, 498, .244357212953876, 3, '2018-10-25 00:00:00', '1234-22-0987', '2018-10-30 00:00:00');
INSERT INTO `fufillments` (`fufillID`, `clientID`, `clientName`, `origin`, `destination`, `miles`, `rate`, `ratePerMile`, `weight`, `dateListed`, `CDL`, `dateFulfilled`) VALUES (12, 1, 'Wang Enterprises', 'Kalchevaya', 'Boitown', 2202, 1543, .700726612170754, 18, '2018-04-11 00:00:00', '1234-22-0987', '2018-04-15 00:00:00');
INSERT INTO `fufillments` (`fufillID`, `clientID`, `clientName`, `origin`, `destination`, `miles`, `rate`, `ratePerMile`, `weight`, `dateListed`, `CDL`, `dateFulfilled`) VALUES (13, 3, 'Ares Macrotechnology', 'Chaoyang', 'Kadoma', 1175, 252, .214468085106383, 7, '2017-11-17 00:00:00', '1234-22-0987', '2017-11-20 00:00:00');
INSERT INTO `fufillments` (`fufillID`, `clientID`, `clientName`, `origin`, `destination`, `miles`, `rate`, `ratePerMile`, `weight`, `dateListed`, `CDL`, `dateFulfilled`) VALUES (14, 2, 'Weyland-Yutani', 'Ducheng', 'Novyy Urgal', 1659, 286, .172393007836046, 2, '2018-11-07 00:00:00', '5402-99-5134', '2018-11-12 00:00:00');
INSERT INTO `fufillments` (`fufillID`, `clientID`, `clientName`, `origin`, `destination`, `miles`, `rate`, `ratePerMile`, `weight`, `dateListed`, `CDL`, `dateFulfilled`) VALUES (15, 2, 'Weyland-Yutani', 'Bor Ondor', 'Fengsheng', 574, 4887, 8.51393728222997, 18, '2018-04-25 00:00:00', '5555-55-5555', '2018-04-30 00:00:00');
# 5 records

#
# Table structure for table 'inTransit'
#

DROP TABLE IF EXISTS `inTransit`;

CREATE TABLE `inTransit` (
  `transitID` INTEGER NOT NULL AUTO_INCREMENT,
  `clientID` INTEGER,
  `clientName` VARCHAR(255),
  `origin` VARCHAR(255),
  `destination` VARCHAR(255),
  `miles` DOUBLE NULL,
  `rate` DOUBLE NULL,
  `ratePerMile` DOUBLE NULL,
  `weight` DOUBLE NULL,
  `dateListed` DATETIME,
  `CDL` VARCHAR(255),
  INDEX (`clientID`),
  PRIMARY KEY (`transitID`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'inTransit'
#

INSERT INTO `inTransit` (`transitID`, `clientID`, `clientName`, `origin`, `destination`, `miles`, `rate`, `ratePerMile`, `weight`, `dateListed`, `CDL`) VALUES (6, 2, 'Weyland-Yutani', 'Severnyy', 'Kildare', 619, 2999, 4.84491114701131, 12, '2017-11-26 00:00:00', '1234-22-0987');
INSERT INTO `inTransit` (`transitID`, `clientID`, `clientName`, `origin`, `destination`, `miles`, `rate`, `ratePerMile`, `weight`, `dateListed`, `CDL`) VALUES (7, 2, 'Weyland-Yutani', 'Tenggina Daya', 'Anoek', 2399, 4583, 1.91037932471863, 10, '2018-06-07 00:00:00', '5402-99-5134');
INSERT INTO `inTransit` (`transitID`, `clientID`, `clientName`, `origin`, `destination`, `miles`, `rate`, `ratePerMile`, `weight`, `dateListed`, `CDL`) VALUES (8, 2, 'Weyland-Yutani', 'Morioh', 'Wenping', 1960, 2421, 1.23520408163265, 6, '2018-11-11 00:00:00', '5555-55-5555');
INSERT INTO `inTransit` (`transitID`, `clientID`, `clientName`, `origin`, `destination`, `miles`, `rate`, `ratePerMile`, `weight`, `dateListed`, `CDL`) VALUES (9, 1, 'Wang Enterprises', 'Meaux', 'Giorno', 387, 3873, 10.0077519379845, 8, '2018-09-20 00:00:00', '1234-22-0987');
INSERT INTO `inTransit` (`transitID`, `clientID`, `clientName`, `origin`, `destination`, `miles`, `rate`, `ratePerMile`, `weight`, `dateListed`, `CDL`) VALUES (10, 1, 'Wang Enterprises', 'Xiejia', 'Shangshuai', 1884, 1234, .654989384288747, 10, '2017-11-28 00:00:00', '5555-55-5555');
# 5 records

#
# Table structure for table 'listing'
#

DROP TABLE IF EXISTS `listing`;

CREATE TABLE `listing` (
  `listingID` INTEGER AUTO_INCREMENT,
  `clientID` INTEGER,
  `clientName` VARCHAR(255),
  `origin` VARCHAR(255),
  `destination` VARCHAR(255),
  `miles` DOUBLE NULL,
  `rate` DOUBLE NULL,
  `ratePerMile` DOUBLE NULL,
  `weight` DOUBLE NULL,
  `dateListed` DATETIME,
  PRIMARY KEY (`listingID`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'listing'
#

INSERT INTO `listing` (`listingID`, `clientID`, `clientName`, `origin`, `destination`, `miles`, `rate`, `ratePerMile`, `weight`, `dateListed`) VALUES (1, 1, 'Wang Enterprises', 'Mulhouse', 'Capri', 344, 1692, 4.91860465116279, 1, '2018-05-14 00:00:00');
INSERT INTO `listing` (`listingID`, `clientID`, `clientName`, `origin`, `destination`, `miles`, `rate`, `ratePerMile`, `weight`, `dateListed`) VALUES (2, 3, 'Ares Macrotechnology', 'Sadananya', 'Calumpang', 1084, 2118, 1.95387453874539, 2, '2018-05-21 00:00:00');
INSERT INTO `listing` (`listingID`, `clientID`, `clientName`, `origin`, `destination`, `miles`, `rate`, `ratePerMile`, `weight`, `dateListed`) VALUES (3, 3, 'Ares Macrotechnology', 'Skreet', 'Rust 2', 573, 1480, 2.58289703315881, 6, '2017-12-07 00:00:00');
INSERT INTO `listing` (`listingID`, `clientID`, `clientName`, `origin`, `destination`, `miles`, `rate`, `ratePerMile`, `weight`, `dateListed`) VALUES (4, 3, 'Ares Macrotechnology', 'Jack Knife Edge Town', 'Mesquite', 702, 3469, 4.94159544159544, 13, '2018-09-04 00:00:00');
INSERT INTO `listing` (`listingID`, `clientID`, `clientName`, `origin`, `destination`, `miles`, `rate`, `ratePerMile`, `weight`, `dateListed`) VALUES (5, 3, 'Ares Macrotechnology', 'Giovanna', 'Gaomi', 554, 4876, 8.8014440433213, 1, '2017-12-26 00:00:00');
# 5 records

#
# Table structure for table 'needApproval'
#

DROP TABLE IF EXISTS `needApproval`;

CREATE TABLE `needApproval` (
  `modID` INTEGER NOT NULL AUTO_INCREMENT,
  `clientID` INTEGER,
  `clientName` VARCHAR(255),
  `origin` VARCHAR(255),
  `destination` VARCHAR(255),
  `miles` DOUBLE NULL,
  `rate` DOUBLE NULL,
  `ratePerMile` DOUBLE NULL,
  `weight` DOUBLE NULL,
  `dateListed` DATETIME,
  INDEX (`clientID`),
  PRIMARY KEY (`modID`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'needApproval'
#

INSERT INTO `needApproval` (`modID`, `clientID`, `clientName`, `origin`, `destination`, `miles`, `rate`, `ratePerMile`, `weight`, `dateListed`) VALUES (1, 1, 'Wang Enterprises', 'Mulhouse', 'Capri', 344, 1000, 2.90697674418605, 1, '2018-05-14 00:00:00');
INSERT INTO `needApproval` (`modID`, `clientID`, `clientName`, `origin`, `destination`, `miles`, `rate`, `ratePerMile`, `weight`, `dateListed`) VALUES (2, 3, 'Ares Macrotechnology', 'Sadananya', 'Calumpang', 1084, 1500, 1.38376383763838, 2, '2018-05-21 00:00:00');
INSERT INTO `needApproval` (`modID`, `clientID`, `clientName`, `origin`, `destination`, `miles`, `rate`, `ratePerMile`, `weight`, `dateListed`) VALUES (3, 3, 'Ares Macrotechnology', 'Skreet', 'Rust 2', 573, 2390, 4.17102966841187, 6, '2017-12-07 00:00:00');
INSERT INTO `needApproval` (`modID`, `clientID`, `clientName`, `origin`, `destination`, `miles`, `rate`, `ratePerMile`, `weight`, `dateListed`) VALUES (4, 3, 'Ares Macrotechnology', 'Jack Knife Edge Town', 'Mesquite', 702, 2222, 3.16524216524217, 13, '2018-09-04 00:00:00');
INSERT INTO `needApproval` (`modID`, `clientID`, `clientName`, `origin`, `destination`, `miles`, `rate`, `ratePerMile`, `weight`, `dateListed`) VALUES (5, 3, 'Ares Macrotechnology', 'Giovanna', 'Gaomi', 554, 1256, 2.26714801444043, 1, '2017-12-26 00:00:00');
# 5 records

#
# Table structure for table 'trucker'
#

DROP TABLE IF EXISTS `trucker`;

CREATE TABLE `trucker` (
  `CDL` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255),
  `password` VARCHAR(255),
  `firstName` VARCHAR(255),
  `lastName` VARCHAR(255),
  `city` VARCHAR(255),
  `state` VARCHAR(255),
  PRIMARY KEY (`CDL`)
) ENGINE=myisam DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'trucker'
#

INSERT INTO `trucker` (`CDL`, `email`, `password`, `firstName`, `lastName`, `city`, `state`) VALUES ('1234-22-0987', 'wang@vt.edu', 'trucker', 'Alan', 'Wang', 'Blacksburg', 'Virginia');
INSERT INTO `trucker` (`CDL`, `email`, `password`, `firstName`, `lastName`, `city`, `state`) VALUES ('5402-99-5134', 'kyesinin4@microsoft.com', 'trucker', 'Karyn', 'Whistan', 'Memphis', 'Tennessee');
INSERT INTO `trucker` (`CDL`, `email`, `password`, `firstName`, `lastName`, `city`, `state`) VALUES ('5555-55-5555', 'hbarmby5@jiathis.com', 'trucker', 'Lynea', 'Minards', 'Washington', 'District of Columbia');
# 3 records
