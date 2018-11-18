-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: tesis_db
-- ------------------------------------------------------
-- Server version	5.7.17

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
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendance` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `user_has_courses_id` int(11) NOT NULL,
  `option_date` datetime DEFAULT NULL,
  `option_status` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_increment`,`user_has_courses_id`),
  KEY `fk_assistance_user_has_courses1_idx` (`user_has_courses_id`),
  CONSTRAINT `fk_assistance_user_has_courses1` FOREIGN KEY (`user_has_courses_id`) REFERENCES `user_has_courses` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` VALUES (57,6,'2017-04-19 17:54:39','1',NULL,NULL,1),(58,8,'2017-04-19 17:54:39','2',NULL,NULL,1),(59,6,'2017-04-19 17:55:01','1',NULL,NULL,1),(60,8,'2017-04-19 17:55:02','2',NULL,NULL,1),(61,6,'2017-04-18 17:55:03','1',NULL,NULL,1),(62,8,'2017-04-19 17:55:03','2',NULL,NULL,1),(63,6,'2017-04-19 18:34:01','0',NULL,NULL,1),(64,8,'2017-04-19 18:34:01','2',NULL,NULL,1);
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `communication`
--

DROP TABLE IF EXISTS `communication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `communication` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `user_has_courses_id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `message_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_increment`,`user_has_courses_id`),
  KEY `fk_communication_user_has_courses1_idx` (`user_has_courses_id`),
  CONSTRAINT `fk_communication_user_has_courses1` FOREIGN KEY (`user_has_courses_id`) REFERENCES `user_has_courses` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `communication`
--

LOCK TABLES `communication` WRITE;
/*!40000 ALTER TABLE `communication` DISABLE KEYS */;
INSERT INTO `communication` VALUES (1,2,'soy gato','3',NULL,NULL,NULL,NULL),(2,2,'soy gato','3',NULL,NULL,NULL,NULL),(3,2,'yyujkk','2',NULL,NULL,NULL,NULL),(4,2,'uyyh','3',NULL,NULL,NULL,NULL),(5,2,'jjkgghhhh','2',NULL,NULL,NULL,NULL),(6,1,'ey3727','1',NULL,NULL,NULL,NULL),(7,2,'hola \n','2',NULL,NULL,NULL,NULL),(8,1,'jejejhdhd','3',NULL,NULL,NULL,NULL),(9,3,'666\n','3',NULL,NULL,NULL,NULL),(10,2,'soy gato','3',NULL,'2017-05-06 11:57:16',NULL,NULL);
/*!40000 ALTER TABLE `communication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'Matemática',NULL,NULL,1),(2,'Lenguaje',NULL,NULL,1),(3,'Religión',NULL,NULL,1),(4,'Física',NULL,NULL,1),(5,'Química',NULL,NULL,1),(6,'Personal Social',NULL,NULL,1),(7,'Ciencia y Ambiente',NULL,NULL,1),(8,'Educación Física',NULL,NULL,1),(9,'Tutoría',NULL,NULL,1),(10,'Computación',NULL,NULL,1),(11,'Inglés',NULL,NULL,1);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grades` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `user_has_courses_id` int(11) NOT NULL,
  `bimester` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note_monthly` int(11) DEFAULT NULL,
  `note_bimonthly` int(11) DEFAULT NULL,
  `note_teacher` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_increment`,`user_has_courses_id`),
  KEY `fk_notes_user_has_courses1_idx` (`user_has_courses_id`),
  CONSTRAINT `fk_notes_user_has_courses1` FOREIGN KEY (`user_has_courses_id`) REFERENCES `user_has_courses` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grades`
--

LOCK TABLES `grades` WRITE;
/*!40000 ALTER TABLE `grades` DISABLE KEYS */;
INSERT INTO `grades` VALUES (1,4,'1',10,15,2,NULL,NULL,1),(2,4,'1',10,15,2,NULL,NULL,1),(3,7,'3',6,7,8,NULL,NULL,1),(4,7,'3',12,2,3,NULL,NULL,1),(5,7,'3',12,2,3,NULL,NULL,1),(6,4,'1',10,15,2,NULL,NULL,1),(7,5,'4',20,2,8,NULL,NULL,1),(8,5,'4',6,3,7,NULL,NULL,1),(9,5,'2',2,5,3,NULL,NULL,1),(10,5,'2',2,5,3,NULL,NULL,1);
/*!40000 ALTER TABLE `grades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_permission` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_permission_tag` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` VALUES (1,'',NULL,NULL,'ROLE_TEACHER','2017-10-10 17:35:39',NULL,1),(2,NULL,NULL,NULL,'ROLE_FATHER','2017-10-10 17:35:39',NULL,1),(3,NULL,NULL,NULL,'ROLE_STUDENT','2017-10-10 17:35:39',NULL,1);
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,'Profesor','2017-10-10 17:35:39',NULL,NULL),(2,'Padre familia','2017-10-10 17:35:39',NULL,NULL),(3,'Alumno','2017-10-10 17:35:39',NULL,NULL);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_has_permission`
--

DROP TABLE IF EXISTS `profile_has_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile_has_permission` (
  `profile_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`profile_id`,`permission_id`),
  KEY `IDX_9D41AA2CCCFA12B8` (`profile_id`),
  KEY `IDX_9D41AA2CFED90CCA` (`permission_id`),
  CONSTRAINT `FK_9D41AA2CCCFA12B8` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id_increment`),
  CONSTRAINT `FK_9D41AA2CFED90CCA` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id_increment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_has_permission`
--

LOCK TABLES `profile_has_permission` WRITE;
/*!40000 ALTER TABLE `profile_has_permission` DISABLE KEYS */;
INSERT INTO `profile_has_permission` VALUES (1,1),(2,2),(3,3);
/*!40000 ALTER TABLE `profile_has_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_increment`),
  UNIQUE KEY `UNIQ_D044D5D4A76ED395` (`user_id`),
  CONSTRAINT `FK_D044D5D4A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user_project` (`id_increment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session`
--

LOCK TABLES `session` WRITE;
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
/*!40000 ALTER TABLE `session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `user_has_courses_id` int(11) NOT NULL,
  `tarea` text COLLATE utf8_unicode_ci,
  `fecha_entrega` datetime DEFAULT NULL,
  `nota` int(11) DEFAULT NULL,
  `estado` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_increment`,`user_has_courses_id`),
  KEY `fk_task_user_has_courses1_idx` (`user_has_courses_id`),
  CONSTRAINT `fk_task_user_has_courses1` FOREIGN KEY (`user_has_courses_id`) REFERENCES `user_has_courses` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (1,2,'soy gato','2017-05-05 00:00:00',3,NULL,'2017-05-10 20:39:46',NULL,1),(2,2,'soy gato','2017-05-05 00:00:00',3,'pendiente','2017-05-12 19:55:15',NULL,1),(3,3,'788i9','2017-05-02 00:00:00',3,NULL,'2017-05-10 20:54:15',NULL,1),(4,2,'soy gato','2017-05-05 00:00:00',3,'pendiente','2017-05-11 19:14:07',NULL,1),(5,3,'jjgfgjkk','2017-05-05 00:00:00',3,'pendiente','2017-05-12 19:31:22',NULL,1),(6,3,'jjgfgjkk','2017-05-05 00:00:00',3,'pendiente','2017-05-12 19:31:26',NULL,1),(7,3,'úuuuuu','2017-05-09 00:00:00',3,'pendiente','2017-05-12 19:31:50',NULL,1),(8,3,'iiiii','2017-05-05 00:00:00',3,'pendiente','2017-05-12 19:37:01',NULL,1),(9,2,'soy gato','2017-05-05 00:00:00',3,'pendiente','2017-05-12 19:55:32',NULL,1),(10,3,'soy gato','2017-05-05 00:00:00',3,'pendiente','2017-05-12 19:57:03',NULL,1),(11,3,'óoooo','2018-04-26 00:00:00',8,'no_pendiente','2017-05-13 10:58:47',NULL,1),(12,3,'uuuu','2017-05-10 00:00:00',4,'no_pendiente','2017-05-13 11:55:03',NULL,1),(13,1,'hola 33','2017-05-08 00:00:00',5,'no_pendiente','2017-05-13 12:00:11',NULL,1);
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_has_courses`
--

DROP TABLE IF EXISTS `user_has_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_has_courses` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `courses_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_increment`),
  KEY `fk_user_project_has_courses_courses1_idx` (`courses_id`),
  KEY `fk_user_project_has_courses_user_project1_idx` (`user_id`),
  CONSTRAINT `fk_user_project_has_courses_courses1` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_project_has_courses_user_project1` FOREIGN KEY (`user_id`) REFERENCES `user_project` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_has_courses`
--

LOCK TABLES `user_has_courses` WRITE;
/*!40000 ALTER TABLE `user_has_courses` DISABLE KEYS */;
INSERT INTO `user_has_courses` VALUES (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,5,2),(6,5,3),(7,6,2),(8,6,3),(9,6,4),(10,7,4),(11,7,3),(12,8,3),(13,9,3),(14,10,3),(15,11,3),(16,12,3),(17,13,3),(18,14,3),(19,15,3);
/*!40000 ALTER TABLE `user_has_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_project`
--

DROP TABLE IF EXISTS `user_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_project` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `username` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salt` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dni` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_father` tinyint(1) DEFAULT NULL,
  `last_access` datetime DEFAULT NULL,
  `registration_id` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id_increment`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `dni_UNIQUE` (`dni`),
  KEY `FK_8D93D649CCFA12B8` (`profile_id`),
  KEY `fk_user_project_user_project1_idx` (`user_id`),
  CONSTRAINT `FK_3ABBC1D7CCFA12B8` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id_increment`),
  CONSTRAINT `fk_user_project_user_project1` FOREIGN KEY (`user_id`) REFERENCES `user_project` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_project`
--

LOCK TABLES `user_project` WRITE;
/*!40000 ALTER TABLE `user_project` DISABLE KEYS */;
INSERT INTO `user_project` VALUES (1,NULL,1,'ta123',NULL,NULL,'123',NULL,NULL,'Bryson Cortez, Julian',NULL,NULL,NULL,'bryson@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,'cDfy3yyovu4:APA91bHStuyBGEhAFDJaUeVwLxA1U1KeG5GquB9IctUAJ36nu0H-hEf_XhogszI1c8KLaZRhf2Qo89WcgzQw8YG0joXLhGVaPZnltGwGX0ydbMGapmBrwFKL-aCnO8ZY2u1yrVSWMkgs'),(2,NULL,1,'aflordina',NULL,NULL,'123',NULL,NULL,'Alvan Sullón, Flordina',NULL,NULL,NULL,'flordina@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL),(3,NULL,2,'pa123',NULL,NULL,'123',NULL,NULL,'Honorio Quispe, Miky',NULL,NULL,NULL,'dddd@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,'cDfy3yyovu4:APA91bHStuyBGEhAFDJaUeVwLxA1U1KeG5GquB9IctUAJ36nu0H-hEf_XhogszI1c8KLaZRhf2Qo89WcgzQw8YG0joXLhGVaPZnltGwGX0ydbMGapmBrwFKL-aCnO8ZY2u1yrVSWMkgs'),(4,NULL,2,'pb123',NULL,NULL,'123',NULL,NULL,'Alvino Ruiz, Alejandro',NULL,NULL,NULL,'cccc@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL),(5,3,3,'sa123',NULL,NULL,'123',NULL,NULL,'Honorio Quispe, Miky',NULL,NULL,NULL,'yyyyyc@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL),(6,3,3,'sb123',NULL,NULL,'123',NULL,NULL,'Alvino Gutierrez, Bryan José',NULL,NULL,NULL,'nnnnnn@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL),(7,3,3,'sc123',NULL,NULL,'123',NULL,NULL,'Sabastizaga Vasquez, Ramiro Juan',NULL,NULL,NULL,'1alumno@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL),(8,2,3,'sd123',NULL,NULL,'123',NULL,NULL,'Cerron Salas, Luis Alberto',NULL,NULL,NULL,'2alumno@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL),(9,2,3,'se123',NULL,NULL,'123',NULL,NULL,'Torrin Sanchez, Pabel Yuri',NULL,NULL,NULL,'3alumno@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL),(10,2,3,'sf123',NULL,NULL,'123',NULL,NULL,'Jimenez Alanya, Karen Jimena',NULL,NULL,NULL,'4alumno@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL),(11,2,3,'sg123',NULL,NULL,'123',NULL,NULL,'Zamora Sullón, Natalia',NULL,NULL,NULL,'5alumno@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL),(12,2,3,'sh123',NULL,NULL,'123',NULL,NULL,'Ruiz Solano, Jesús Alberto',NULL,NULL,NULL,'6alumno@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL),(13,2,3,'si123',NULL,NULL,'123',NULL,NULL,'Ruiz Solanos, Lionel Andrés',NULL,NULL,NULL,'7alumno@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL),(14,2,3,'sj123',NULL,NULL,'123',NULL,NULL,'Chirinos Mejía, Pedro Alfredo',NULL,NULL,NULL,'8alumno@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL),(15,2,3,'sk123',NULL,NULL,'123',NULL,NULL,'Moya Correa, Diego Alfredo',NULL,NULL,NULL,'9alumno@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL),(16,NULL,1,'qrony',NULL,NULL,'123',NULL,NULL,'Quispe Santillan, Rony',NULL,NULL,NULL,'ddd4d@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL),(17,NULL,1,'amaravi',NULL,NULL,'123',NULL,NULL,'Maraví Perez, Ana',NULL,NULL,NULL,'ddd34d@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL),(18,NULL,1,'tbejarano',NULL,NULL,'123',NULL,NULL,'Bejarano Maliz, Tito',NULL,NULL,NULL,'ddd42d@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL),(19,NULL,1,'rapolinario',NULL,NULL,'123',NULL,NULL,'Apolinario Parra, Reynaldo',NULL,NULL,NULL,'dd6d4d@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL),(20,NULL,1,'jvasquez',NULL,NULL,'123',NULL,NULL,'Vasquez Hilo, José',NULL,NULL,NULL,'ddd54d@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL),(21,NULL,1,'maguirre',NULL,NULL,'123',NULL,NULL,'Aguirre Zubia, Marisol',NULL,NULL,NULL,'dd1d4d@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL),(22,NULL,1,'rpalacios',NULL,NULL,'123',NULL,NULL,'Palacios Salas, Robert',NULL,NULL,NULL,'ddd4d5@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL),(23,NULL,1,'dpizarro',NULL,NULL,'123',NULL,NULL,'Pizarro Carranza, Daniela',NULL,NULL,NULL,'ddd334d@gmail.com',NULL,NULL,'2017-10-10 17:35:39',NULL,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `user_project` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-13 13:12:35
