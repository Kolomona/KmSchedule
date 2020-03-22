-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	5.7.29-0ubuntu0.18.04.1

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
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (13,'2014_10_12_000000_create_users_table',1),(14,'2014_10_12_100000_create_password_resets_table',1),(15,'2019_08_19_000000_create_failed_jobs_table',1),(16,'2020_03_10_183255_create_schedules_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `period_date` date NOT NULL,
  `schedule` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_draft` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedules`
--

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
INSERT INTO `schedules` VALUES (1,'2020-03-10 19:42:49','2020-03-10 19:42:49','2020-01-20','Jan.	Mon	Tues	Wed	Thur	Fri	Sat	Sun	Jan.\r\n-	20	21	22	23	24	25	26	-\r\nSarah	-	-	-	-	-	-	-	Sarah\r\nDanna	-	-	-	-	-	-	-	Danna\r\nKolomona	-	-	On	On	On	On	On	Kolomona\r\nAnthony	-	7:45-Cl	-	-	7:30-Cl	10-Cl	10-Cl	Anthony\r\nBarb	-	-	-	-	9-Cl	-	-	Barb\r\nLaura	-	-	-	-	9-Cl	-	-	Laura\r\nAdam	-	-	-	-	-	10-Cl	10	Adam\r\n-	Mon	Tues	Wed	Thur	Fri	Sat	Sun	-\r\nJosh	-	-	-	-	9-Cl	-	-	Josh\r\nCassidy	-	11-Cl	11-Cl	-	-	9-Cl	9-Cl	Cassidy\r\nElana	-	-	-	10:30-Cl	-	-	-	Elana\r\nOlivia	-	-	-	-	-	8:30-Cl	8:30-Cl	Olivia\r\nBeth	-	-	-	-	-	-	-	Beth\r\n								\r\n-	Mon	Tues	Wed	Thurs	Fri	Sat	Sun	-\r\nEvents	-	-	-	-	-	-	-	Events',1),(2,'2020-03-10 19:42:49','2020-03-10 19:42:49','2020-01-06','Jan	Mon	Tues	Wed	Thur	Fri	Sat	Sun	Jan\r\n-	13	14	15	16	17	18	19	-\r\nSarah	-	-	-	-	-	-	-	Sarah\r\nDanna	-	-	-	-	-	-	-	Danna\r\nKolomona	-	-	ON	ON	ON	ON	ON	Kolomona\r\nAnthony	-	7:45-Cl	-	-	7:30-1	10-Cl	10-Cl	Anthony\r\nBarb	-	-	-	-	9-Cl	-	-	Barb\r\nLaura	-	-	-	8-Cl	RO	-	-	Laura\r\n-	-	-	-	-	-	-	-	-\r\nBen	-	-	-	-	-	10-Cl	10-Cl	Ben\r\n-	Mon	Tues	Wed	Thur	Fri	Sat	Sun	-\r\nJosh	-	-	-	-	RO	-	-	Josh\r\nCassidy	-	-	-	11-Cl	9-Cl	9-Cl	9-Cl	Cassidy\r\nKelly		-	-	-	-	-	-	Kelly\r\nOlivia	-	-	-	-	-	8:30-Cl	8:30-Cl	Olivia\r\nPayton	-	11-Cl	11-Cl	-	-	-	-	Payton\r\nElsa	-	-	-	-	-	-	-	Elsa\r\n-	Mon	Tues	Wed	Thurs	Fri	Sat	Sun	-\r\nEvents	-	-	-	-	-	-	-	Events',1),(3,'2020-03-10 19:42:49','2020-03-10 19:42:49','2020-01-06','Jan	Mon	Tues	Wed	Thur	Fri	Sat	Sun	Jan\r\n-	6	7	8	9	10	11	12	-\r\nSarah	-	-	-	-	-	-	-	Sarah\r\nDanna	-	-	-	-	-	-	-	Danna\r\nKolomona	-	-	ON	ON	ON	ON	ON	Kolomona\r\nAnthony	-	-	-	-	7:30-Cl	10-Cl	10-Cl	Anthony\r\nBarb	-	-	-	-	9-Cl	-	-	Barb\r\nLaura	-	-	-	-	9-Cl	-	-	Laura\r\n-	-	-	-	-	-	-	-	-\r\nBen	-	-	-	-	-	10-Cl	10-Cl	Ben\r\n-	Mon	Tues	Wed	Thur	Fri	Sat	Sun	-\r\nJosh	-	-	-	-	9-Cl	-	-	Josh\r\nCassidy	-	-	11-Cl	11-Cl	-	12-Cl	9-Cl	Cassidy\r\nKelly		-	-	-	-	-	-	Kelly\r\nOlivia	-	-	-	-	-	9-Cl	9-Cl	Olivia\r\nPayton	-	-	-	-	-	8:45-Cl	?	Payton\r\nElsa	-	-	-	-	-	-	-	Elsa\r\n-	Mon	Tues	Wed	Thurs	Fri	Sat	Sun	-\r\nEvents	-	-	-	-	Milt B-Day	-	-	Events',0),(4,'2020-03-10 19:42:49','2020-03-10 19:42:49','2019-12-30','Jan	Mon	Tues	Wed	Thur	Fri	Sat	Sun	Jan\r\n-	30	31	1	2	3	4	5	-\r\nSarah	-	-	-	-	-	-	-	Sarah\r\nDanna	-	-	-	-	-	-	-	Danna\r\nKolomona	-	-	-	ON	ON	ON	ON	Kolomona\r\nAnthony	-	-	-	-	7:30-Cl	9-Cl	9-Cl	Anthony\r\nBarb	-	-	-	-	9-Cl	-	-	Barb\r\nLaura	-	-	-	-	9-Cl	-	-	Laura\r\n-	-	-	-	-	-	-	-	-\r\nBen	-	-	-	-	-	9-Cl	9-Cl	Ben\r\n-	Mon	Tues	Wed	Thur	Fri	Sat	Sun	-\r\nJosh	-	-	-	-	9-Cl	-	-	Josh\r\nCassidy	-	-	-	11-Cl	-	9-Cl	9-Cl	Cassidy\r\nKelly		-	-	-	-	-	-	Kelly\r\nOlivia	-	-	-	-	-	8:30-Cl	8:30-Cl	Olivia\r\nNiki	-	-	-	-	-	-	-	Niki\r\nElsa	-	-	-	-	-	-	-	Elsa\r\n-	Mon	Tues	Wed	Thurs	Fri	Sat	Sun	-\r\nEvents	-	-	New Years	-	-	-	-	Events',1),(5,'2020-03-10 19:42:49','2020-03-10 19:42:49','2020-01-06','Jan	Mon	Tues	Wed	Thur	Fri	Sat	Sun	Jan\r\n-	6	7	8	9	10	11	12	-\r\nSarah	-	-	-	-	-	-	-	Sarah\r\nDanna	-	-	-	-	-	-	-	Danna\r\nKolomona	-	-	ON	ON	ON	ON	ON	Kolomona\r\nAnthony	-	-	-	-	7:30-Cl	10-Cl	10-Cl	Anthony\r\nBarb	-	-	-	-	9-Cl	-	-	Barb\r\nLaura	-	-	-	-	9-Cl	-	-	Laura\r\n-	-	-	-	-	-	-	-	-\r\nBen	-	-	-	-	-	10-Cl	10-Cl	Ben\r\n-	Mon	Tues	Wed	Thur	Fri	Sat	Sun	-\r\nJosh	-	-	-	-	9-Cl	-	-	Josh\r\nCassidy	-	-	11-Cl	11-Cl	-	12-Cl	9-Cl	Cassidy\r\nKelly		-	-	-	-	-	-	Kelly\r\nOlivia	-	-	-	-	-	9-Cl	9-Cl	Olivia\r\nPayton	-	-	-	-	-	8:45-Cl	?	Payton\r\nElsa	-	-	-	-	-	-	-	Elsa\r\n-	Mon	Tues	Wed	Thurs	Fri	Sat	Sun	-\r\nEvents	-	-	-	-	Milt B-Day	-	-	Events',1),(6,'2020-03-10 19:42:49','2020-03-10 19:42:49','2019-12-23','Dec.	Mon	Tues	Wed	Thur	Fri	Sat	Sun	Dec.\r\n-	23	24	25	26	27	28	29	-\r\nSarah	-	-	-	-	-	-	-	Sarah\r\nDanna	-	-	-	-	-	-	-	Danna\r\nKolomona	-	-	-	-	ON	ON	ON	Kolomona\r\nAnthony	-	-	-	-	7:30-Cl	9-Cl	9-Cl	Anthony\r\nBarb	-	-	-	-	9-Cl	-	-	Barb\r\nLaura	-	-	-	-	9-Cl	-	-	Laura\r\n-	-	-	-	-	-	-	-	-\r\nBen	-	-	-	-	-	9-Cl	9-Cl	Ben\r\n-	Mon	Tues	Wed	Thur	Fri	Sat	Sun	-\r\nJosh	-	-	-	-	9-Cl	-	-	Josh\r\nCassidy	-	-	-	-	-	8:30-Cl	8:30-Cl	Cassidy\r\nKelly		-	-	-	-	-	-	Kelly\r\nOlivia	-	-	-	-	-	8:30-Cl	9-Cl	Olivia\r\nNiki	-	-	-	-	-	-	7:30-Cl	Niki\r\nElsa	-	-	-	-	-	-	-	Elsa\r\n-	Mon	Tues	Wed	Thurs	Fri	Sat	Sun	-\r\nEvents	-	-	-	-	-	-	-	Events\r\n',1);
/*!40000 ALTER TABLE `schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Kolomona','kolomona@kolomona.com',NULL,'$2y$10$gTB2SbicdWdE5qSUk0e5cOHN8OI/F4OIWzkdET4eBw8EGWhDxvc8m','rgPydvlkdcc3b8F9IO8xVoTUUiovZ5KWO7tWBxoRQmAByiBlHdGPJ4Phqxfa','2020-03-10 19:43:46','2020-03-10 19:43:46');
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

-- Dump completed on 2020-03-11 23:56:34
