CREATE DATABASE  IF NOT EXISTS `babysitter` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `babysitter`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: babysitter
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity_table`
--

DROP TABLE IF EXISTS `activity_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity` varchar(255) NOT NULL,
  `is_parent` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `child_id` int(11) NOT NULL,
  `day` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `activityfk_idx` (`user_id`),
  CONSTRAINT `activityfk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_table`
--

LOCK TABLES `activity_table` WRITE;
/*!40000 ALTER TABLE `activity_table` DISABLE KEYS */;
INSERT INTO `activity_table` VALUES (1,'sdfsaf',0,4,6,4,'2019-01-06 00:00:00'),(2,'gdsfgdf',0,4,6,4,'2019-01-06 00:00:00'),(3,'asdasd',0,4,51,4,'2019-01-06 00:00:00'),(4,'Ð½Ð°Ñ…Ñ€Ð°Ð½ÐµÐ½Ð¾',0,4,7,4,'2019-01-06 00:00:00'),(5,'Ð½Ð°Ñ…Ñ€Ð°Ð½ÐµÐ½Ð¾',0,4,7,4,'2019-01-06 00:00:00'),(6,'Ð´Ð¾Ð¹Ð´Ð¾Ñ…',0,4,6,5,'2019-01-06 00:00:00'),(7,'Ð½Ð°Ñ…Ñ€Ð°Ð½ÐµÐ½Ð¾ Ðµ ',0,4,6,5,'2019-01-06 00:00:00'),(8,'1521',1,5,6,4,'2019-01-06 00:00:00'),(9,'vcbcxvb',1,5,6,4,'2019-01-06 00:00:00'),(10,'mnogo dobre',1,5,7,4,'2019-01-06 00:00:00'),(11,'test',1,5,6,4,'2019-01-19 00:00:00');
/*!40000 ALTER TABLE `activity_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `children`
--

DROP TABLE IF EXISTS `children`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `children` (
  `id_child` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `age` varchar(45) NOT NULL,
  PRIMARY KEY (`id_child`),
  KEY `id_idx` (`parent_id`),
  CONSTRAINT `id` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `children`
--

LOCK TABLES `children` WRITE;
/*!40000 ALTER TABLE `children` DISABLE KEYS */;
INSERT INTO `children` VALUES (1,3,'Kiki','21'),(2,3,'Nesi','28'),(3,3,'Tito','12'),(4,5,'Kiko','21'),(5,5,'Nesi','28'),(6,6,'kiril','12');
/*!40000 ALTER TABLE `children` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hired_babysitters`
--

DROP TABLE IF EXISTS `hired_babysitters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hired_babysitters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `babysitter_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_parent_idx` (`parent_id`),
  KEY `fk_babysiter_idx` (`babysitter_id`),
  CONSTRAINT `fk_babysiter` FOREIGN KEY (`babysitter_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_parent` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hired_babysitters`
--

LOCK TABLES `hired_babysitters` WRITE;
/*!40000 ALTER TABLE `hired_babysitters` DISABLE KEYS */;
INSERT INTO `hired_babysitters` VALUES (2,3,1,'2019-01-06 00:00:00'),(3,5,4,'2019-01-06 00:00:00'),(4,5,4,'2019-01-19 00:00:00'),(5,6,4,'2019-01-19 00:00:00');
/*!40000 ALTER TABLE `hired_babysitters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `second_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `tel` varchar(45) NOT NULL,
  `is_parent` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Kirilcho','Kirilov','Dragomirov','sdfdsfgsdfg','123456',0,'kiril97','$2y$10$NQPUV4rFsRT3MYkeDpgRU.DeADcrk41ryPGgpIbLWdw5RFWF8smm2','kiril.dragomirov@upnetix.com'),(2,'Vanessa','Kirilova','Dragomirova','123456','123456',1,'vanessa90','$2y$10$ajCM.02SWPsUSvZI.K.ym.0rQjwUxXd32lEC9fXRkXM7ZOO1ST5uG','nesenceto_05@abv.bg'),(3,'Kirilchoooo','Kirilov','Dragomirovvadfdsf','jdfgjdklfgdsfg','111111',1,'kirilkn','$2y$10$EkRi9u/7/5/.ZprBTB.1veAWm3BDxRkAouz0ulQMUwzL9GklLoi3K','kiril.dragomirov@upnetix.com'),(4,'Pesho','Petrov','Todorov','sfhsdjgh','22655',0,'kiril9977','$2y$10$upMULgZBsMnPhwNFR2vY7.8Q1qJ2.t/uy6AuT3e7MFn58e3lHKlRi','kiril.dragomirov@upnetix.com'),(5,'Milena','Angelova','Dragomirova','dfgdsfg','123456',1,'test_parent','$2y$10$oPRY0jdYc2WQdzviy0ASNewZFSRrE2Aamee6ZNSmoIzvtJ4ZedO8i','kiril.dragomirov@upnetix.com'),(6,'Kiril','Kirilov','Dragomirov','dsjhgjkfghk','123456',1,'test_parent_2','$2y$10$ZFZWGbRGJuHWgSQ5rwYDGeTj5qmlA1PhxnvBmtGlvdA1elLUOPP32','kkdd@abv.bg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-27 15:09:45
