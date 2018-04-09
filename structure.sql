-- MySQL dump 10.16  Distrib 10.1.31-MariaDB, for Linux (x86_64)
--
-- Host: 108.255.70.130    Database: netman
-- ------------------------------------------------------
-- Server version	10.1.32-MariaDB

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
-- Table structure for table `MSCHAPv2`
--

DROP TABLE IF EXISTS `MSCHAPv2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MSCHAPv2` (
  `SSID` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `KEY_MGMT` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EAP` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IDENTITY` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PASSWORD` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PHASE1` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PHASE2` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MSCHAPv2`
--

LOCK TABLES `MSCHAPv2` WRITE;
/*!40000 ALTER TABLE `MSCHAPv2` DISABLE KEYS */;
/*!40000 ALTER TABLE `MSCHAPv2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UNSECUREDCONNECTION`
--

DROP TABLE IF EXISTS `UNSECUREDCONNECTION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UNSECUREDCONNECTION` (
  `SSID` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `KEY_MGMT` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UNSECUREDCONNECTION`
--

LOCK TABLES `UNSECUREDCONNECTION` WRITE;
/*!40000 ALTER TABLE `UNSECUREDCONNECTION` DISABLE KEYS */;
INSERT INTO `UNSECUREDCONNECTION` VALUES ('akknetwork','NONE');
/*!40000 ALTER TABLE `UNSECUREDCONNECTION` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `WPA_PSK`
--

DROP TABLE IF EXISTS `WPA_PSK`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WPA_PSK` (
  `SSID` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PSK` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `WPA_PSK`
--

LOCK TABLES `WPA_PSK` WRITE;
/*!40000 ALTER TABLE `WPA_PSK` DISABLE KEYS */;
INSERT INTO `WPA_PSK` VALUES ('two','nx2i4q853qac');
/*!40000 ALTER TABLE `WPA_PSK` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-04  9:44:40
