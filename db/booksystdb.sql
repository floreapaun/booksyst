-- MySQL dump 10.16  Distrib 10.1.33-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: booksystdb
-- ------------------------------------------------------
-- Server version	10.1.33-MariaDB

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
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room` (
  `room_id` int(5) NOT NULL AUTO_INCREMENT,
  `type` int(1) NOT NULL,
  `bath` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ac` int(1) NOT NULL,
  `pet` int(1) DEFAULT NULL,
  `available` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (1,1,'public',0,0,'1',70,NULL,NULL),(2,1,'public',0,0,'1',70,NULL,NULL),(3,1,'public',0,0,'1',70,NULL,NULL),(4,1,'public',0,0,'1',70,NULL,NULL),(5,1,'public',0,0,'0040721510023',70,'2018-08-31','2018-09-05'),(6,1,'public',0,0,'1',70,NULL,NULL),(7,1,'private',0,1,'1',120,NULL,NULL),(8,1,'private',0,1,'1',120,NULL,NULL),(9,2,'private',1,1,'1',180,NULL,NULL),(10,2,'private',1,1,'0040734245506',180,'2018-08-30','2018-09-06'),(11,2,'private',1,1,'1',180,NULL,NULL),(12,2,'private',1,1,'1',180,NULL,NULL),(13,3,'public',1,0,'1',350,NULL,NULL),(14,3,'public',1,0,'1',350,NULL,NULL),(15,3,'private',1,0,'1',380,NULL,NULL);
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-26 18:44:50
