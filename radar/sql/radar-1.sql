-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 127.0.0.1    Database: radar
-- ------------------------------------------------------
-- Server version	5.7.21

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
-- Table structure for table `blip`
--

DROP TABLE IF EXISTS `blip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blip` (
  `blip_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ring_id` bigint(20) NOT NULL,
  PRIMARY KEY (`blip_id`),
  UNIQUE KEY `blip_blip_id_uindex` (`blip_id`),
  UNIQUE KEY `blip_name_uindex` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blip`
--

LOCK TABLES `blip` WRITE;
/*!40000 ALTER TABLE `blip` DISABLE KEYS */;
INSERT INTO `blip` VALUES (1,'pharout','PHAr HTTP routes.',2);
/*!40000 ALTER TABLE `blip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blip_update`
--

DROP TABLE IF EXISTS `blip_update`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blip_update` (
  `blip_update_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `blip_id` bigint(20) NOT NULL,
  `ring_id` bigint(20) NOT NULL,
  `summary` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`blip_update_id`),
  UNIQUE KEY `blip_update_blip_update_id_uindex` (`blip_update_id`),
  UNIQUE KEY `blip_update_blip_id_uindex` (`blip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blip_update`
--

LOCK TABLES `blip_update` WRITE;
/*!40000 ALTER TABLE `blip_update` DISABLE KEYS */;
INSERT INTO `blip_update` VALUES (1,1,2,'PHAr shows promise of increasing performance for our HTTP interfaces.','2018-06-14 22:31:40');
/*!40000 ALTER TABLE `blip_update` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ring`
--

DROP TABLE IF EXISTS `ring`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ring` (
  `ring_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `verb` varchar(255) NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`ring_id`),
  UNIQUE KEY `ring_ring_id_uindex` (`ring_id`),
  UNIQUE KEY `ring_verb_uindex` (`verb`),
  UNIQUE KEY `ring_number_uindex` (`number`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ring`
--

LOCK TABLES `ring` WRITE;
/*!40000 ALTER TABLE `ring` DISABLE KEYS */;
INSERT INTO `ring` VALUES (1,'adopt',0),(2,'trial',1),(3,'assess',2),(4,'hold',3);
/*!40000 ALTER TABLE `ring` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v1_mv_blip`
--

DROP TABLE IF EXISTS `v1_mv_blip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v1_mv_blip` (
  `v1_mv_blip_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `blip_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `ring_verb` varchar(255) NOT NULL,
  `ring_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`v1_mv_blip_id`),
  UNIQUE KEY `v1_blip_read_v1_blip_read_id_uindex` (`v1_mv_blip_id`),
  UNIQUE KEY `v1_mv_blip_blip_id_uindex` (`blip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v1_mv_blip`
--

LOCK TABLES `v1_mv_blip` WRITE;
/*!40000 ALTER TABLE `v1_mv_blip` DISABLE KEYS */;
INSERT INTO `v1_mv_blip` VALUES (1,1,'pharout','PHAr HTTP routes.','assess',3);
/*!40000 ALTER TABLE `v1_mv_blip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v1_mv_blip_update`
--

DROP TABLE IF EXISTS `v1_mv_blip_update`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v1_mv_blip_update` (
  `v1_mv_blip_update_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `blip_id` bigint(20) NOT NULL,
  `blip_name` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `created_at` datetime NOT NULL,
  `ring_verb` varchar(255) NOT NULL,
  `ring_number` int(11) NOT NULL,
  PRIMARY KEY (`v1_mv_blip_update_id`),
  UNIQUE KEY `v1_mv_blip_update_v1_mv_blip_update_id_uindex` (`v1_mv_blip_update_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v1_mv_blip_update`
--

LOCK TABLES `v1_mv_blip_update` WRITE;
/*!40000 ALTER TABLE `v1_mv_blip_update` DISABLE KEYS */;
INSERT INTO `v1_mv_blip_update` VALUES (1,1,'pharout','PHAr shows promise of increasing performance for our HTTP interfaces.','2018-06-14 22:31:40','assess',2);
/*!40000 ALTER TABLE `v1_mv_blip_update` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v2_mv_blip`
--

DROP TABLE IF EXISTS `v2_mv_blip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v2_mv_blip` (
  `v2_mv_blip_id` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`v2_mv_blip_id`),
  UNIQUE KEY `v2_mv_blip_v2_mv_blip_id_uindex` (`v2_mv_blip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v2_mv_blip`
--

LOCK TABLES `v2_mv_blip` WRITE;
/*!40000 ALTER TABLE `v2_mv_blip` DISABLE KEYS */;
/*!40000 ALTER TABLE `v2_mv_blip` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-14 18:24:27
