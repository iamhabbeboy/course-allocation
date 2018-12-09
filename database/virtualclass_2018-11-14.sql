# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.24)
# Database: virtualclass
# Generation Time: 2018-11-13 23:53:46 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table allocation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `allocation`;

CREATE TABLE `allocation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dept` varchar(200) DEFAULT NULL,
  `level` varchar(100) DEFAULT NULL,
  `semester` varchar(20) DEFAULT NULL,
  `created_at` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table assignment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `assignment`;

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` varchar(100) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `question` text NOT NULL,
  `lecturer` varchar(100) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table assignment_answer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `assignment_answer`;

CREATE TABLE `assignment_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matric_no` varchar(20) NOT NULL,
  `assignID` int(11) NOT NULL,
  `answer` text NOT NULL,
  `datetime` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table courses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `courses`;

CREATE TABLE `courses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `created_at` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table lecturer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lecturer`;

CREATE TABLE `lecturer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table lectures
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lectures`;

CREATE TABLE `lectures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` varchar(100) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `handout` varchar(200) NOT NULL,
  `refree` text NOT NULL,
  `rating` varchar(11) NOT NULL,
  `lecturer` varchar(50) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table slots
# ------------------------------------------------------------

DROP TABLE IF EXISTS `slots`;

CREATE TABLE `slots` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `allocation_id` int(11) DEFAULT NULL,
  `slot_id` varchar(11) DEFAULT NULL,
  `lecturer` varchar(200) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `created_at` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table student
# ------------------------------------------------------------

DROP TABLE IF EXISTS `student`;

CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surname` varchar(50) NOT NULL,
  `othername` varchar(50) NOT NULL,
  `matric_no` varchar(20) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table student_question
# ------------------------------------------------------------

DROP TABLE IF EXISTS `student_question`;

CREATE TABLE `student_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matric_no` varchar(50) NOT NULL,
  `question` text NOT NULL,
  `lectID` int(11) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table student_reply
# ------------------------------------------------------------

DROP TABLE IF EXISTS `student_reply`;

CREATE TABLE `student_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matric_no` int(11) NOT NULL,
  `ans` text NOT NULL,
  `lectID` int(11) NOT NULL,
  `qID` int(11) NOT NULL,
  `datetime` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
