CREATE DATABASE  IF NOT EXISTS `proiect` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `proiect`;
-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: proiect
-- ------------------------------------------------------
-- Server version	8.0.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `appointments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `medicid` int unsigned NOT NULL,
  `pacientid` int unsigned NOT NULL,
  `data` datetime DEFAULT NULL,
  `aprobareid` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `medicid` (`medicid`),
  KEY `pacientid` (`pacientid`),
  KEY `aprobareid` (`aprobareid`),
  KEY `id` (`id`,`medicid`,`pacientid`),
  CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`medicid`) REFERENCES `users` (`id`),
  CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`pacientid`) REFERENCES `users` (`id`),
  CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`aprobareid`) REFERENCES `tip_aprobare` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
INSERT INTO `appointments` VALUES (20,135,135,'2021-12-31 00:00:00',3),(21,136,135,'2022-01-20 00:00:00',3),(22,134,135,'2022-01-19 00:00:00',3),(23,136,135,'2022-01-21 00:00:00',2),(24,137,135,'2022-01-11 00:00:00',2),(25,134,135,'2022-01-18 00:00:00',2),(26,134,135,'2022-01-31 00:00:00',1),(27,136,135,'2022-01-27 00:00:00',2),(28,136,135,'2022-02-01 09:00:00',4),(29,136,135,'2022-02-02 10:00:00',2),(30,134,136,'2022-02-02 10:00:00',1),(31,136,136,'2022-02-02 10:00:00',1),(32,136,135,'2022-02-02 08:00:00',1),(33,136,135,'2022-02-02 13:00:00',3),(34,137,135,'2022-01-28 10:00:00',3),(35,136,135,'2022-01-21 12:00:00',1),(36,136,135,'2022-02-10 12:00:00',2),(37,139,140,'2022-01-14 11:00:00',1),(38,137,140,'2022-01-21 13:00:00',1),(39,139,140,'2022-01-27 12:00:00',3),(40,139,140,'2022-01-28 12:00:00',3),(41,139,140,'2022-01-28 10:00:00',4),(42,139,140,'2022-01-10 11:00:00',1),(43,139,140,'2022-01-12 12:00:00',1),(44,139,144,'2022-01-19 11:00:00',1),(45,146,147,'2022-01-28 11:00:00',1),(46,146,135,'2022-01-13 12:00:00',1),(47,137,135,'2022-01-20 10:00:00',1);
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `autori`
--

DROP TABLE IF EXISTS `autori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `autori` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nume` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autori`
--

LOCK TABLES `autori` WRITE;
/*!40000 ALTER TABLE `autori` DISABLE KEYS */;
INSERT INTO `autori` VALUES (1,'YUVAL NOAH HARARI'),(2,'DAVID A. SINCLAIR'),(3,'MARKUS ZUSAK'),(4,'GEORGE ORWELL'),(5,'JAMES CLEAR');
/*!40000 ALTER TABLE `autori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `autori_1`
--

DROP TABLE IF EXISTS `autori_1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `autori_1` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nume` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nume` (`nume`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autori_1`
--

LOCK TABLES `autori_1` WRITE;
/*!40000 ALTER TABLE `autori_1` DISABLE KEYS */;
INSERT INTO `autori_1` VALUES (2,'DAVID A. SINCLAIR'),(4,'GEORGE ORWELL'),(5,'JAMES CLEAR'),(3,'MARKUS ZUSAK'),(1,'YUVAL NOAH HARARI');
/*!40000 ALTER TABLE `autori_1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backupbib`
--

DROP TABLE IF EXISTS `backupbib`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `backupbib` (
  `id` int unsigned NOT NULL DEFAULT '0',
  `TITLU` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci DEFAULT NULL,
  `descriere` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci,
  `an_publicare` int unsigned NOT NULL,
  `autor_id` int unsigned NOT NULL,
  `limba_id` int unsigned NOT NULL,
  `original` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backupbib`
--

LOCK TABLES `backupbib` WRITE;
/*!40000 ALTER TABLE `backupbib` DISABLE KEYS */;
INSERT INTO `backupbib` VALUES (1,'Atomic Habits','O cale usoara si eficienta de a-ti forma obiceiuri bune si a scapa de cele proaste',2019,5,1,0),(2,'1984','Unul dintre romanele-cult ale secolului XX, 1984 figureaza si azi intre bestsellerurile internationale, iar aceasta constanta se datoreaza',1949,4,1,0),(3,'1984','Nineteen Eighty-Four (also stylised as 1984) is a dystopian social science fiction novel and cautionary tale',1949,4,2,2),(4,'Hotul de carti','Curaj mai presus de cuvinte',2007,3,1,0),(5,'The Book Thief','When Death has a story to tell, you listen.',2007,3,2,4),(6,'Lifespan','De ce imbatranim si cum sa nu o mai facem',2019,2,1,0),(7,'Lifespan','Why We Age and Why We Dont Have To',2019,2,2,6),(8,'Sapiens. Scurta istorie a omenirii','Acum 100.000 de ani, pe pamint existau cel putin sase specii de oameni. Astazi exista una singura: noi, Homo sapiens. Ce s-a intimplat cu celelalte?',2011,1,1,0),(9,'Sapiens: A Brief History of Humankind','Planet Earth is 4.5 billion years old. In just a fraction of that time, one species among countless others has conquered it. Us.',2011,1,2,8);
/*!40000 ALTER TABLE `backupbib` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `biblioteca_1`
--

DROP TABLE IF EXISTS `biblioteca_1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `biblioteca_1` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `TITLU` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci DEFAULT NULL,
  `descriere` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci,
  `an_publicare` int unsigned NOT NULL,
  `autor_id` int unsigned NOT NULL,
  `limba_id` int unsigned NOT NULL,
  `original` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biblioteca_1`
--

LOCK TABLES `biblioteca_1` WRITE;
/*!40000 ALTER TABLE `biblioteca_1` DISABLE KEYS */;
INSERT INTO `biblioteca_1` VALUES (1,'Atomic Habits','O cale usoara si eficienta de a-ti forma obiceiuri bune si a scapa de cele proaste',2019,5,1,0),(2,'1984','Unul dintre romanele-cult ale secolului XX, 1984 figureaza si azi intre bestsellerurile internationale, iar aceasta constanta se datoreaza',1949,4,1,0),(3,'1984','Nineteen Eighty-Four (also stylised as 1984) is a dystopian social science fiction novel and cautionary tale',1949,8,2,2),(4,'Hotul de carti','Curaj mai presus de cuvinte',2007,3,1,0),(5,'The Book Thief','When Death has a story to tell, you listen.',2007,3,2,4),(6,'Lifespan','De ce imbatranim si cum sa nu o mai facem',2019,2,1,0),(7,'Lifespan','Why We Age and Why We Dont Have To',2019,2,4,6),(8,'Sapiens. Scurta istorie a omenirii','Acum 100.000 de ani, pe pamint existau cel putin sase specii de oameni. Astazi exista una singura: noi, Homo sapiens. Ce s-a intimplat cu celelalte?',2011,1,1,0),(9,'Sapiens: A Brief History of Humankind','Planet Earth is 4.5 billion years old. In just a fraction of that time, one species among countless others has conquered it. Us.',2011,1,2,8);
/*!40000 ALTER TABLE `biblioteca_1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `biblioteca_2`
--

DROP TABLE IF EXISTS `biblioteca_2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `biblioteca_2` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `TITLU` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci DEFAULT NULL,
  `descriere` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci,
  `an_publicare` int unsigned NOT NULL,
  `autor_id` int unsigned NOT NULL,
  `limba_id` int unsigned NOT NULL,
  `original` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `autor_id` (`autor_id`),
  CONSTRAINT `biblioteca_2_ibfk_1` FOREIGN KEY (`autor_id`) REFERENCES `autori` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biblioteca_2`
--

LOCK TABLES `biblioteca_2` WRITE;
/*!40000 ALTER TABLE `biblioteca_2` DISABLE KEYS */;
INSERT INTO `biblioteca_2` VALUES (1,'Atomic Habits','O cale usoara si eficienta de a-ti forma obiceiuri bune si a scapa de cele proaste',2019,5,1,0),(2,'1984','Unul dintre romanele-cult ale secolului XX, 1984 figureaza si azi intre bestsellerurile internationale, iar aceasta constanta se datoreaza',1949,4,1,0),(3,'1984','Nineteen Eighty-Four (also stylised as 1984) is a dystopian social science fiction novel and cautionary tale',1949,8,2,2),(4,'Hotul de carti','Curaj mai presus de cuvinte',2007,3,1,0),(5,'The Book Thief','When Death has a story to tell, you listen.',2007,3,2,4),(6,'Lifespan','De ce imbatranim si cum sa nu o mai facem',2019,2,1,0),(7,'Lifespan','Why We Age and Why We Dont Have To',2019,2,4,6),(8,'Sapiens. Scurta istorie a omenirii','Acum 100.000 de ani, pe pamint existau cel putin sase specii de oameni. Astazi exista una singura: noi, Homo sapiens. Ce s-a intimplat cu celelalte?',2011,1,1,0),(9,'Sapiens: A Brief History of Humankind','Planet Earth is 4.5 billion years old. In just a fraction of that time, one species among countless others has conquered it. Us.',2011,1,2,8);
/*!40000 ALTER TABLE `biblioteca_2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `biblioteca_3`
--

DROP TABLE IF EXISTS `biblioteca_3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `biblioteca_3` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `TITLU` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci DEFAULT NULL,
  `descriere` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci,
  `an_publicare` int unsigned NOT NULL,
  `autor_id` int unsigned NOT NULL,
  `limba_id` int unsigned NOT NULL,
  `original` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `TITLU` (`TITLU`),
  KEY `FK_AutoriBiblioteca3` (`autor_id`),
  CONSTRAINT `FK_AutoriBiblioteca3` FOREIGN KEY (`autor_id`) REFERENCES `autori` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biblioteca_3`
--

LOCK TABLES `biblioteca_3` WRITE;
/*!40000 ALTER TABLE `biblioteca_3` DISABLE KEYS */;
INSERT INTO `biblioteca_3` VALUES (1,'Atomic Habits','O cale usoara si eficienta de a-ti forma obiceiuri bune si a scapa de cele proaste',2019,5,1,'0'),(2,'1984','Unul dintre romanele-cult ale secolului XX, 1984 figureaza si azi intre bestsellerurile internationale, iar aceasta constanta se datoreaza',1949,4,1,'0'),(3,'1984','Nineteen Eighty-Four (also stylised as 1984) is a dystopian social science fiction novel and cautionary tale',1949,8,2,'2'),(4,'Hotul de carti','Curaj mai presus de cuvinte',2007,3,1,'0'),(5,'The Book Thief','When Death has a story to tell, you listen.',2007,3,2,'4'),(6,'Lifespan','De ce imbatranim si cum sa nu o mai facem',2019,2,1,'0'),(7,'Lifespan','Why We Age and Why We Dont Have To',2019,2,4,'6'),(8,'Sapiens. Scurta istorie a omenirii','Acum 100.000 de ani, pe pamint existau cel putin sase specii de oameni. Astazi exista una singura: noi, Homo sapiens. Ce s-a intimplat cu celelalte?',2011,1,1,'0'),(9,'Sapiens: A Brief History of Humankind','Planet Earth is 4.5 billion years old. In just a fraction of that time, one species among countless others has conquered it. Us.',2011,1,2,'8');
/*!40000 ALTER TABLE `biblioteca_3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `biblioteca_4`
--

DROP TABLE IF EXISTS `biblioteca_4`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `biblioteca_4` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `TITLU` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci DEFAULT NULL,
  `descriere` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci,
  `an_publicare` int unsigned NOT NULL,
  `autor_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci DEFAULT NULL,
  `limba_id` int unsigned NOT NULL,
  `original` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `autor_id` (`autor_id`),
  CONSTRAINT `FK_AutoriBiblioteca4` FOREIGN KEY (`autor_id`) REFERENCES `autori_1` (`nume`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biblioteca_4`
--

LOCK TABLES `biblioteca_4` WRITE;
/*!40000 ALTER TABLE `biblioteca_4` DISABLE KEYS */;
INSERT INTO `biblioteca_4` VALUES (1,'Atomic Habits','O cale usoara si eficienta de a-ti forma obiceiuri bune si a scapa de cele proaste',2019,'5',1,0),(2,'1984','Unul dintre romanele-cult ale secolului XX, 1984 figureaza si azi intre bestsellerurile internationale, iar aceasta constanta se datoreaza',1949,'4',1,0),(3,'1984','Nineteen Eighty-Four (also stylised as 1984) is a dystopian social science fiction novel and cautionary tale',1949,'4',2,2),(4,'Hotul de carti','Curaj mai presus de cuvinte',2007,'3',1,0),(5,'The Book Thief','When Death has a story to tell, you listen.',2007,'3',2,4),(6,'Lifespan','De ce imbatranim si cum sa nu o mai facem',2019,'2',1,0),(7,'Lifespan','Why We Age and Why We Dont Have To',2019,'2',4,6),(8,'Sapiens. Scurta istorie a omenirii','Acum 100.000 de ani, pe pamint existau cel putin sase specii de oameni. Astazi exista una singura: noi, Homo sapiens. Ce s-a intimplat cu celelalte?',2011,'1',1,0),(9,'Sapiens: A Brief History of Humankind','Planet Earth is 4.5 billion years old. In just a fraction of that time, one species among countless others has conquered it. Us.',2011,'1',2,8);
/*!40000 ALTER TABLE `biblioteca_4` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `biblioteca_5`
--

DROP TABLE IF EXISTS `biblioteca_5`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `biblioteca_5` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `TITLU` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci DEFAULT NULL,
  `descriere` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci,
  `an_publicare` int unsigned NOT NULL,
  `autor_id` int unsigned NOT NULL,
  `limba_id` int unsigned NOT NULL,
  `original` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `TITLU` (`TITLU`,`an_publicare`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biblioteca_5`
--

LOCK TABLES `biblioteca_5` WRITE;
/*!40000 ALTER TABLE `biblioteca_5` DISABLE KEYS */;
INSERT INTO `biblioteca_5` VALUES (1,'Atomic Habits','O cale usoara si eficienta de a-ti forma obiceiuri bune si a scapa de cele proaste',2019,5,1,0),(2,'1984','Unul dintre romanele-cult ale secolului XX, 1984 figureaza si azi intre bestsellerurile internationale, iar aceasta constanta se datoreaza',1949,4,1,0),(3,'1984','Nineteen Eighty-Four (also stylised as 1984) is a dystopian social science fiction novel and cautionary tale',1949,8,2,2),(4,'Hotul de carti','Curaj mai presus de cuvinte',2007,3,1,0),(5,'The Book Thief','When Death has a story to tell, you listen.',2007,3,2,4),(6,'Lifespan','De ce imbatranim si cum sa nu o mai facem',2019,2,1,0),(7,'Lifespan','Why We Age and Why We Dont Have To',2019,2,4,6),(8,'Sapiens. Scurta istorie a omenirii','Acum 100.000 de ani, pe pamint existau cel putin sase specii de oameni. Astazi exista una singura: noi, Homo sapiens. Ce s-a intimplat cu celelalte?',2011,1,1,0),(9,'Sapiens: A Brief History of Humankind','Planet Earth is 4.5 billion years old. In just a fraction of that time, one species among countless others has conquered it. Us.',2011,1,2,8);
/*!40000 ALTER TABLE `biblioteca_5` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `biblioteca_6`
--

DROP TABLE IF EXISTS `biblioteca_6`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `biblioteca_6` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `TITLU` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci DEFAULT NULL,
  `descriere` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci,
  `an_publicare` int unsigned NOT NULL,
  `autor_id` int unsigned NOT NULL,
  `limba_id` int unsigned NOT NULL,
  `original` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `TITLU` (`TITLU`),
  KEY `FK_AutoriBiblioteca3` (`autor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biblioteca_6`
--

LOCK TABLES `biblioteca_6` WRITE;
/*!40000 ALTER TABLE `biblioteca_6` DISABLE KEYS */;
INSERT INTO `biblioteca_6` VALUES (1,'Atomic Habits','O cale usoara si eficienta de a-ti forma obiceiuri bune si a scapa de cele proaste',2019,5,1,'0'),(2,'1984','Unul dintre romanele-cult ale secolului XX, 1984 figureaza si azi intre bestsellerurile internationale, iar aceasta constanta se datoreaza',1949,4,1,'0'),(3,'1984','Nineteen Eighty-Four (also stylised as 1984) is a dystopian social science fiction novel and cautionary tale',1949,2,2,'2'),(4,'Hotul de carti','Curaj mai presus de cuvinte',2007,3,1,'0'),(5,'The Book Thief','When Death has a story to tell, you listen.',2007,3,2,'4'),(6,'Lifespan','De ce imbatranim si cum sa nu o mai facem',2019,2,1,'0'),(7,'Lifespan','Why We Age and Why We Dont Have To',2019,2,4,'6'),(8,'Sapiens. Scurta istorie a omenirii','Acum 100.000 de ani, pe pamint existau cel putin sase specii de oameni. Astazi exista una singura: noi, Homo sapiens. Ce s-a intimplat cu celelalte?',2011,1,1,'0'),(9,'Sapiens: A Brief History of Humankind','Planet Earth is 4.5 billion years old. In just a fraction of that time, one species among countless others has conquered it. Us.',2011,1,2,'8');
/*!40000 ALTER TABLE `biblioteca_6` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `biblioteca_7`
--

DROP TABLE IF EXISTS `biblioteca_7`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `biblioteca_7` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `TITLU` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci DEFAULT NULL,
  `descriere` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci,
  `an_publicare` int unsigned NOT NULL,
  `autor_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci DEFAULT NULL,
  `limba_id` int unsigned NOT NULL,
  `original` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `autor_id` (`autor_id`),
  CONSTRAINT `biblioteca_7_ibfk_1` FOREIGN KEY (`autor_id`) REFERENCES `autori_1` (`nume`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biblioteca_7`
--

LOCK TABLES `biblioteca_7` WRITE;
/*!40000 ALTER TABLE `biblioteca_7` DISABLE KEYS */;
INSERT INTO `biblioteca_7` VALUES (1,'Atomic Habits','O cale usoara si eficienta de a-ti forma obiceiuri bune si a scapa de cele proaste',2019,'5',1,0),(2,'1984','Unul dintre romanele-cult ale secolului XX, 1984 figureaza si azi intre bestsellerurile internationale, iar aceasta constanta se datoreaza',1949,'4',1,0),(3,'1984','Nineteen Eighty-Four (also stylised as 1984) is a dystopian social science fiction novel and cautionary tale',1949,'2',2,2),(4,'Hotul de carti','Curaj mai presus de cuvinte',2007,'3',1,0),(5,'The Book Thief','When Death has a story to tell, you listen.',2007,'3',2,4),(6,'Lifespan','De ce imbatranim si cum sa nu o mai facem',2019,'2',1,0),(7,'Lifespan','Why We Age and Why We Dont Have To',2019,'2',4,6),(8,'Sapiens. Scurta istorie a omenirii','Acum 100.000 de ani, pe pamint existau cel putin sase specii de oameni. Astazi exista una singura: noi, Homo sapiens. Ce s-a intimplat cu celelalte?',2011,'1',1,0),(9,'Sapiens: A Brief History of Humankind','Planet Earth is 4.5 billion years old. In just a fraction of that time, one species among countless others has conquered it. Us.',2011,'1',2,8);
/*!40000 ALTER TABLE `biblioteca_7` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `biblioteca_8`
--

DROP TABLE IF EXISTS `biblioteca_8`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `biblioteca_8` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `TITLU` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci DEFAULT NULL,
  `descriere` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci,
  `an_publicare` int unsigned NOT NULL,
  `autor_id` int unsigned NOT NULL,
  `limba_id` int unsigned NOT NULL,
  `original` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `TITLU` (`TITLU`,`an_publicare`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biblioteca_8`
--

LOCK TABLES `biblioteca_8` WRITE;
/*!40000 ALTER TABLE `biblioteca_8` DISABLE KEYS */;
INSERT INTO `biblioteca_8` VALUES (1,'Atomic Habits','O cale usoara si eficienta de a-ti forma obiceiuri bune si a scapa de cele proaste',2019,5,1,0),(2,'1984','Unul dintre romanele-cult ale secolului XX, 1984 figureaza si azi intre bestsellerurile internationale, iar aceasta constanta se datoreaza',1949,4,1,0),(3,'1984','Nineteen Eighty-Four (also stylised as 1984) is a dystopian social science fiction novel and cautionary tale',1949,4,2,2),(4,'Hotul de carti','Curaj mai presus de cuvinte',2007,3,1,0),(5,'The Book Thief','When Death has a story to tell, you listen.',2007,3,2,4),(6,'Lifespan','De ce imbatranim si cum sa nu o mai facem',2019,2,1,0),(7,'Lifespan','Why We Age and Why We Dont Have To',2019,2,4,6),(8,'Sapiens. Scurta istorie a omenirii','Acum 100.000 de ani, pe pamint existau cel putin sase specii de oameni. Astazi exista una singura: noi, Homo sapiens. Ce s-a intimplat cu celelalte?',2011,1,1,0),(9,'Sapiens: A Brief History of Humankind','Planet Earth is 4.5 billion years old. In just a fraction of that time, one species among countless others has conquered it. Us.',2011,1,2,8);
/*!40000 ALTER TABLE `biblioteca_8` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `limbi`
--

DROP TABLE IF EXISTS `limbi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `limbi` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `denumire_limba` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `limbi`
--

LOCK TABLES `limbi` WRITE;
/*!40000 ALTER TABLE `limbi` DISABLE KEYS */;
INSERT INTO `limbi` VALUES (1,'ROMANA'),(2,'ENGLEZA');
/*!40000 ALTER TABLE `limbi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logins`
--

DROP TABLE IF EXISTS `logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logins` (
  `userid` int unsigned NOT NULL,
  `data_expirare` date DEFAULT NULL,
  KEY `userid` (`userid`),
  CONSTRAINT `logins_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logins`
--

LOCK TABLES `logins` WRITE;
/*!40000 ALTER TABLE `logins` DISABLE KEYS */;
/*!40000 ALTER TABLE `logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tip_aprobare`
--

DROP TABLE IF EXISTS `tip_aprobare`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tip_aprobare` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `aprobare_nume` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tip_aprobare`
--

LOCK TABLES `tip_aprobare` WRITE;
/*!40000 ALTER TABLE `tip_aprobare` DISABLE KEYS */;
INSERT INTO `tip_aprobare` VALUES (1,'Neconfirmat'),(2,'Aprobat'),(3,'Anulat de pacient'),(4,'Refuzat de medic');
/*!40000 ALTER TABLE `tip_aprobare` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci NOT NULL,
  `nume` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci NOT NULL,
  `prenume` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci NOT NULL,
  `tel` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci DEFAULT NULL,
  `tipcont` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_romanian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique` (`user`),
  KEY `user_index` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (134,'ionut@toma.com','$2y$10$7G44TTbLUDh8rcvoX54yTutcOl/SlcKy/mUOA740fw.mIve9iGEIG','Toma','Ionut','0721000000','3'),(135,'pacient@toma.com','$2y$10$TRP7VEnLXb9sVkgRQGjUnO8aSKlmvpVZEeQVhgmVELen3KX4H7Aua','Pacient','Toma','0123456789','1'),(136,'medic@toma.com','$2y$10$bXmDDMykR9rKf.kV9PD.IuZLDiLfqI.MxshovgyKMvY4ydlQcSoIK','Medic','Toma','01234567890','2'),(137,'doctor1@toma.com','$2y$10$QpC7rihJ/bdNWpYBakySHeAzktlRPmibOUnkFRk.mmasHjYmJBDX.','Doctor1','Toma','01234567890','2'),(138,'alex@rosu.com','$2y$10$46NXTPESbbE3OFO7E7LOW.QVx8O51lruAvNhAT6tz5RVqL2xKBVdm','Rosu','Alexandru','0726000000','3'),(139,'medic1@toma.com','$2y$10$kyuXPEJEo9R4MDezdvWBPuUQRDZw44ui2zLD1EL8kZCpv7DIOna6y','Medic2','Medic','01234567890','2'),(140,'pacient2@toma.com','$2y$10$t3qGoV5qFGOj0rzAkX.xcO.sBVdV0Sq8vNnx6tLQdV3nFrSNMXdxe','Pacient2','Pacient','01234567890','1'),(141,'pacient3@toma.com','$2y$10$zDNK8NtpyvBGEjpfwCUna./8ibrFM9iAGfHZbsy1Bv6IyYj0tF8qu','Pacient3','Pacient','01234567890','1'),(142,'wew@weqe.com','$2y$10$tlGjvRsdlYBexxfVItRpl.3SEA8sBBQ9GAb3NYxuZul/jAYVwbAti','Nume','Prenume','2342424324324','1'),(143,'ewqe@wew.com','$2y$10$zbmE2.hdhc2ByjVbKopBj.kBhX1pJxnvoxDjtE1V0eGUqJ3CmotRy','Poakwdp','Poekqwe','34234324242','1'),(144,'eqweq@qweqw.com','$2y$10$XG38tA0broOAwxrJMqC3QON.JeW.V6H.p82oPrbxaXDewfF3Qkke.','Opaskdpo','Poqwke','43242343243243','1'),(145,'eqweq@wewq.com','$2y$10$7YY9/mvAQ4UvRXFx32Ud7e5q75rAuKNsYSpSyhUO.rVw1K/Xx/1va','Numele','Ewqeq','01234567890','1'),(146,'medic4@toma.com','$2y$10$LBWWokkc3GnNkFKuNEd.Xez4clrD5q43MwNhpRcFZSCt0V1SRj9pe','Medic','Medic4','23233123123213','2'),(147,'pacient6@toma.com','$2y$10$vf/NcvISEFnLtCEzEZrAHuDFn4Xruplz9xeoY5PeRAIkBlUGpn78q','Pacient','Pacinet6','232432434324','1');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'proiect'
--
/*!50003 DROP PROCEDURE IF EXISTS `modificare_foreign_key` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificare_foreign_key`(tabela varchar(64), coloana varchar(64), tabela_referinta varchar(64), coloana_referinta varchar(64), nume_constrangere varchar(64))
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SHOW ERRORS; 
        ROLLBACK;   
    END; 
    START TRANSACTION;
		SET @sterge_constrangere =CONCAT('ALTER TABLE ',tabela,' DROP FOREIGN KEY ', nume_constrangere);
		SET @modifica_coloana =CONCAT('ALTER TABLE ',tabela,' MODIFY ',coloana,' int UNSIGNED NOT NULL');
		SET @adauga_constrangere =CONCAT('ALTER TABLE ',tabela,' ADD FOREIGN KEY (',coloana,') REFERENCES ',tabela_referinta,' (',coloana_referinta,')');
          PREPARE statement_0 FROM @sterge_constrangere;
          EXECUTE statement_0;
          PREPARE statement_1 FROM @modifica_coloana;
          EXECUTE statement_1;
          PREPARE statement_2 FROM @adauga_constrangere;
          EXECUTE statement_2;
    COMMIT;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-01 11:27:50
