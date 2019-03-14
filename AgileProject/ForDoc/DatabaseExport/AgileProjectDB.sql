CREATE DATABASE  IF NOT EXISTS `AgileProject` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `AgileProject`;
-- MySQL dump 10.13  Distrib 8.0.13, for macos10.14 (x86_64)
--
-- Host: localhost    Database: AgileProject
-- ------------------------------------------------------
-- Server version	8.0.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admins_user_id_foreign` (`user_id`),
  CONSTRAINT `admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (2,25,NULL,NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `answers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `answer` int(11) NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `answers_question_id_foreign` (`question_id`),
  KEY `answers_user_id_foreign` (`user_id`),
  CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  CONSTRAINT `answers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coaches`
--

DROP TABLE IF EXISTS `coaches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `coaches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `project_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coaches_user_id_foreign` (`user_id`),
  CONSTRAINT `coaches_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coaches`
--

LOCK TABLES `coaches` WRITE;
/*!40000 ALTER TABLE `coaches` DISABLE KEYS */;
INSERT INTO `coaches` VALUES (42,1,12),(43,2,NULL),(45,4,12);
/*!40000 ALTER TABLE `coaches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fixed_questions`
--

DROP TABLE IF EXISTS `fixed_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `fixed_questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fixed_questions`
--

LOCK TABLES `fixed_questions` WRITE;
/*!40000 ALTER TABLE `fixed_questions` DISABLE KEYS */;
INSERT INTO `fixed_questions` VALUES (1,'How cool is the project?'),(2,'How easy was the project?'),(3,'How hard was the project?'),(4,'How much hard work?'),(5,'Rate the project from 1 to 5?'),(6,'This is a question'),(7,'Well how about another'),(8,'How many questions are there');
/*!40000 ALTER TABLE `fixed_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2013_02_11_160630_create_positions_table',1),(2,'2013_02_11_160635_create_fixed_questions_table',1),(3,'2014_10_12_000000_create_users_table',1),(4,'2014_10_12_100000_create_password_resets_table',1),(5,'2019_02_11_160642_create_questionnaires_table',1),(6,'2019_02_11_160704_create_projects_table',1),(7,'2019_02_11_161031_create_coaches_table',1),(8,'2019_02_11_161420_create_questions_table',1),(9,'2019_02_11_161458_create_answers_table',1),(10,'2019_02_11_161539_create_teams_table',1),(11,'2019_02_11_161615_create_team_members_table',1),(12,'2019_02_13_231026_create_questionnaire_receivers_table',1),(13,'2019_02_14_220726_create_admins_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
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
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `positions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `positions`
--

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
INSERT INTO `positions` VALUES (1,'Product Owner'),(2,'Scrum Master'),(3,'Developer'),(4,'Analyst'),(5,'Designer');
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questionnaire_receivers`
--

DROP TABLE IF EXISTS `questionnaire_receivers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `questionnaire_receivers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `questionnaire_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questionnaire_receivers_questionnaire_id_foreign` (`questionnaire_id`),
  KEY `questionnaire_receivers_user_id_foreign` (`user_id`),
  CONSTRAINT `questionnaire_receivers_questionnaire_id_foreign` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaires` (`id`),
  CONSTRAINT `questionnaire_receivers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questionnaire_receivers`
--

LOCK TABLES `questionnaire_receivers` WRITE;
/*!40000 ALTER TABLE `questionnaire_receivers` DISABLE KEYS */;
/*!40000 ALTER TABLE `questionnaire_receivers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questionnaires`
--

DROP TABLE IF EXISTS `questionnaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `questionnaires` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questionnaires`
--

LOCK TABLES `questionnaires` WRITE;
/*!40000 ALTER TABLE `questionnaires` DISABLE KEYS */;
/*!40000 ALTER TABLE `questionnaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fixed_question_id` int(10) unsigned NOT NULL,
  `questionnaire_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_fixed_question_id_foreign` (`fixed_question_id`),
  KEY `questions_questionnaire_id_foreign` (`questionnaire_id`),
  CONSTRAINT `questions_fixed_question_id_foreign` FOREIGN KEY (`fixed_question_id`) REFERENCES `fixed_questions` (`id`),
  CONSTRAINT `questions_questionnaire_id_foreign` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaires` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_members`
--

DROP TABLE IF EXISTS `team_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `team_members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `team_members_team_id_foreign` (`team_id`),
  KEY `team_members_user_id_foreign` (`user_id`),
  CONSTRAINT `team_members_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`),
  CONSTRAINT `team_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_members`
--

LOCK TABLES `team_members` WRITE;
/*!40000 ALTER TABLE `team_members` DISABLE KEYS */;
/*!40000 ALTER TABLE `team_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coach_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `teams_coach_id_foreign` (`coach_id`),
  CONSTRAINT `teams_coach_id_foreign` FOREIGN KEY (`coach_id`) REFERENCES `coaches` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position_id` int(10) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_position_id_foreign` (`position_id`),
  CONSTRAINT `users_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ali','Rahal','alirahal22','alirahal_22@outlook.com','03727679','$2y$10$629pZtVxGF6l0N/w/76Le.GmoiHSVYmm0SDbtznWScxT.WDWOAPIC',3,'Gx3euWZOYZpoVo0X6olqXpQCCRd92kLdg1tVzvhiK6y8DGs8Aq5lFbv10Vis','2019-02-14 13:43:39','2019-02-14 13:43:39'),(2,'Reem','Atwi','reematwi2','reem_atwi@hotmail.co.uk','71208402','$2y$10$LOVVvhZZ2K.d1l0OxJ.NjOhJkr7E.F25AftURGr/6EGjQAJbEkZl2',4,'PuXRFrqoFtPOi7B8jPN8GUzlxhO253Vt4V2ffKwlYYWenTdDSArmfvF0Vhpt','2019-02-14 13:54:12','2019-02-14 13:54:12'),(3,'Janna','Santry','jsantry0','jsantry0@java.com','840-572-4409','DA6UlG',2,NULL,NULL,NULL),(4,'Noll','Limmer','nlimmer1','nlimmer1@theguardian.com','845-410-8989','xCyHswAp',4,NULL,NULL,NULL),(5,'Zedekiah','Heindl','zheindl2','zheindl2@cafepress.com','352-847-1269','cs5K5P6nW1',2,NULL,NULL,NULL),(6,'Sindee','Legrice','slegrice3','slegrice3@acquirethisname.com','396-826-0556','IXK5Iwjb6f3',3,NULL,NULL,NULL),(7,'Gill','Seal','gseal4','gseal4@bloomberg.com','260-674-9228','rQBUpq',3,NULL,NULL,NULL),(8,'Linea','Mateos','lmateos5','lmateos5@indiatimes.com','893-932-6440','Y1os8poxbR',2,NULL,NULL,NULL),(9,'Robinett','Silverlock','rsilverlock6','rsilverlock6@home.pl','992-498-0996','KnSPBGVNYWa',1,NULL,NULL,NULL),(10,'Karee','Roddam','kroddam7','kroddam7@elegantthemes.com','887-932-3175','aUepJhV',2,NULL,NULL,NULL),(11,'Brok','Polson','bpolson8','bpolson8@i2i.jp','663-870-6739','fuEfZVCPV',5,NULL,NULL,NULL),(12,'Haleigh','Atterbury','hatterbury9','hatterbury9@china.com.cn','687-542-4146','00LbyZI5c9lT',2,NULL,NULL,NULL),(13,'Val','Reuven','vreuvena','vreuvena@meetup.com','306-215-1899','23h9ypCSz',4,NULL,NULL,NULL),(14,'Penny','Brunon','pbrunonb','pbrunonb@auda.org.au','916-379-7936','LxwDDq',1,NULL,NULL,NULL),(15,'Zandra','Arndell','zarndellc','zarndellc@un.org','663-992-6283','4XEnKddSHSgt',5,NULL,NULL,NULL),(16,'Robbyn','Selby','rselbyd','rselbyd@opensource.org','234-547-8490','BhEjclInh17J',1,NULL,NULL,NULL),(17,'Felice','Slimon','fslimone','fslimone@tiny.cc','659-648-9561','J2ziBU',4,NULL,NULL,NULL),(18,'Frederik','Cazalet','fcazaletf','fcazaletf@wix.com','991-560-6870','vsMHd7lZ',5,NULL,NULL,NULL),(19,'Clarinda','Moorwood','cmoorwoodg','cmoorwoodg@epa.gov','911-915-2319','iaS7VTvAgB',2,NULL,NULL,NULL),(20,'Ossie','Oene','ooeneh','ooeneh@addthis.com','664-354-1798','BnFJa7',5,NULL,NULL,NULL),(21,'Elly','Turnock','eturnocki','eturnocki@nhs.uk','465-536-7201','4X8l2GK',1,NULL,NULL,NULL),(22,'Uriel','Stothart','ustothartj','ustothartj@fda.gov','568-909-6121','jn7W4Rsc5e',5,NULL,NULL,NULL),(23,'Siham','Rahal','sihamrahal','siham@rahal.com','81273645','$2y$10$ZeFcCWIsH1Ij0ZpluJFDeuRoWoPmBoxcs.7uLAv2FC8RG0CCaltUa',3,'S8KuZj6jvpHvTx3SLzV1qOPQSJDjuM4vUIsO7YVTOjBm0vOnR0EjWR92Zx2L','2019-02-14 15:31:02','2019-02-14 15:31:02'),(24,'hassan','badran','hasan','hassan@badran.com','124235134','$2y$10$6Ib3zlZHRnq.kZCtfdWIMu87fUx9BajnCO0a.c.hFMNeDGsgZUOCa',5,'IwRS6O9876YkwqrOFuQnKota31uoLE8kkxCDrt2oD24ALF9LGXzqWXpUsoxo','2019-02-14 22:12:33','2019-02-14 22:12:33'),(25,'admin','admin','admin1','admin@admin.com','13425245','$2y$10$scEcUOO1siQPJ3nZ3MGZ3OtRkQweg8x9ADzMq4O.8W.NsKYuCKv/u',1,'nscmmoxuckWQZrJRszB6Q7pwGJruNQY3IK98xgADyEIMaJT4dsTkAM45VLP8','2019-02-14 22:15:01','2019-02-14 22:15:01');
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

-- Dump completed on 2019-02-15  4:54:00
