-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: soignemoi
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account_emailaddress`
--

DROP TABLE IF EXISTS `account_emailaddress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account_emailaddress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `primary` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_emailaddress_user_id_email_987c8728_uniq` (`user_id`,`email`),
  CONSTRAINT `account_emailaddress_user_id_2c513194_fk_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_emailaddress`
--

LOCK TABLES `account_emailaddress` WRITE;
/*!40000 ALTER TABLE `account_emailaddress` DISABLE KEYS */;
/*!40000 ALTER TABLE `account_emailaddress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `account_emailconfirmation`
--

DROP TABLE IF EXISTS `account_emailconfirmation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account_emailconfirmation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime(6) NOT NULL,
  `sent` datetime(6) DEFAULT NULL,
  `key` varchar(64) NOT NULL,
  `email_address_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `account_emailconfirm_email_address_id_5b7f8c58_fk_account_e` (`email_address_id`),
  CONSTRAINT `account_emailconfirm_email_address_id_5b7f8c58_fk_account_e` FOREIGN KEY (`email_address_id`) REFERENCES `account_emailaddress` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_emailconfirmation`
--

LOCK TABLES `account_emailconfirmation` WRITE;
/*!40000 ALTER TABLE `account_emailconfirmation` DISABLE KEYS */;
/*!40000 ALTER TABLE `account_emailconfirmation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_group`
--

DROP TABLE IF EXISTS `auth_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_group`
--

LOCK TABLES `auth_group` WRITE;
/*!40000 ALTER TABLE `auth_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_group_permissions`
--

DROP TABLE IF EXISTS `auth_group_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_group_permissions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `auth_group_permissions_group_id_permission_id_0cd325b0_uniq` (`group_id`,`permission_id`),
  KEY `auth_group_permissio_permission_id_84c5c92e_fk_auth_perm` (`permission_id`),
  CONSTRAINT `auth_group_permissio_permission_id_84c5c92e_fk_auth_perm` FOREIGN KEY (`permission_id`) REFERENCES `auth_permission` (`id`),
  CONSTRAINT `auth_group_permissions_group_id_b120cbf9_fk_auth_group_id` FOREIGN KEY (`group_id`) REFERENCES `auth_group` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_group_permissions`
--

LOCK TABLES `auth_group_permissions` WRITE;
/*!40000 ALTER TABLE `auth_group_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_group_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_permission`
--

DROP TABLE IF EXISTS `auth_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content_type_id` int(11) NOT NULL,
  `codename` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `auth_permission_content_type_id_codename_01ab375a_uniq` (`content_type_id`,`codename`),
  CONSTRAINT `auth_permission_content_type_id_2f476e4b_fk_django_co` FOREIGN KEY (`content_type_id`) REFERENCES `django_content_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_permission`
--

LOCK TABLES `auth_permission` WRITE;
/*!40000 ALTER TABLE `auth_permission` DISABLE KEYS */;
INSERT INTO `auth_permission` VALUES (1,'Can add log entry',1,'add_logentry'),(2,'Can change log entry',1,'change_logentry'),(3,'Can delete log entry',1,'delete_logentry'),(4,'Can view log entry',1,'view_logentry'),(5,'Can add permission',2,'add_permission'),(6,'Can change permission',2,'change_permission'),(7,'Can delete permission',2,'delete_permission'),(8,'Can view permission',2,'view_permission'),(9,'Can add group',3,'add_group'),(10,'Can change group',3,'change_group'),(11,'Can delete group',3,'delete_group'),(12,'Can view group',3,'view_group'),(13,'Can add user',4,'add_user'),(14,'Can change user',4,'change_user'),(15,'Can delete user',4,'delete_user'),(16,'Can view user',4,'view_user'),(17,'Can add content type',5,'add_contenttype'),(18,'Can change content type',5,'change_contenttype'),(19,'Can delete content type',5,'delete_contenttype'),(20,'Can view content type',5,'view_contenttype'),(21,'Can add session',6,'add_session'),(22,'Can change session',6,'change_session'),(23,'Can delete session',6,'delete_session'),(24,'Can view session',6,'view_session'),(25,'Can add email address',7,'add_emailaddress'),(26,'Can change email address',7,'change_emailaddress'),(27,'Can delete email address',7,'delete_emailaddress'),(28,'Can view email address',7,'view_emailaddress'),(29,'Can add email confirmation',8,'add_emailconfirmation'),(30,'Can change email confirmation',8,'change_emailconfirmation'),(31,'Can delete email confirmation',8,'delete_emailconfirmation'),(32,'Can view email confirmation',8,'view_emailconfirmation'),(33,'Can add social account',9,'add_socialaccount'),(34,'Can change social account',9,'change_socialaccount'),(35,'Can delete social account',9,'delete_socialaccount'),(36,'Can view social account',9,'view_socialaccount'),(37,'Can add social application',10,'add_socialapp'),(38,'Can change social application',10,'change_socialapp'),(39,'Can delete social application',10,'delete_socialapp'),(40,'Can view social application',10,'view_socialapp'),(41,'Can add social application token',11,'add_socialtoken'),(42,'Can change social application token',11,'change_socialtoken'),(43,'Can delete social application token',11,'delete_socialtoken'),(44,'Can view social application token',11,'view_socialtoken');
/*!40000 ALTER TABLE `auth_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_user`
--

DROP TABLE IF EXISTS `auth_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(128) NOT NULL,
  `last_login` datetime(6) DEFAULT NULL,
  `is_superuser` tinyint(1) NOT NULL,
  `username` varchar(150) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(254) NOT NULL,
  `is_staff` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `date_joined` datetime(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_user`
--

LOCK TABLES `auth_user` WRITE;
/*!40000 ALTER TABLE `auth_user` DISABLE KEYS */;
INSERT INTO `auth_user` VALUES (1,'pbkdf2_sha256$720000$Bl3QCJP53CEz4hKBYhQ4y5$9aFTICHDGbuSwtcqt/spZmsPc1Xhh+ADyRLhp88CktA=','2024-03-18 09:10:55.688757',1,'admin','','','admin@studi.fr',1,1,'2024-03-16 07:20:05.196641');
/*!40000 ALTER TABLE `auth_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_user_groups`
--

DROP TABLE IF EXISTS `auth_user_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_user_groups` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `auth_user_groups_user_id_group_id_94350c0c_uniq` (`user_id`,`group_id`),
  KEY `auth_user_groups_group_id_97559544_fk_auth_group_id` (`group_id`),
  CONSTRAINT `auth_user_groups_group_id_97559544_fk_auth_group_id` FOREIGN KEY (`group_id`) REFERENCES `auth_group` (`id`),
  CONSTRAINT `auth_user_groups_user_id_6a12ed8b_fk_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_user_groups`
--

LOCK TABLES `auth_user_groups` WRITE;
/*!40000 ALTER TABLE `auth_user_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_user_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_user_user_permissions`
--

DROP TABLE IF EXISTS `auth_user_user_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_user_user_permissions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `auth_user_user_permissions_user_id_permission_id_14a6b632_uniq` (`user_id`,`permission_id`),
  KEY `auth_user_user_permi_permission_id_1fbb5f2c_fk_auth_perm` (`permission_id`),
  CONSTRAINT `auth_user_user_permi_permission_id_1fbb5f2c_fk_auth_perm` FOREIGN KEY (`permission_id`) REFERENCES `auth_permission` (`id`),
  CONSTRAINT `auth_user_user_permissions_user_id_a95ead1b_fk_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_user_user_permissions`
--

LOCK TABLES `auth_user_user_permissions` WRITE;
/*!40000 ALTER TABLE `auth_user_user_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_user_user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calendar`
--

DROP TABLE IF EXISTS `calendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medecin_id` int(11) NOT NULL,
  `stay_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `description` longtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6EA9A146FB3AF7D6` (`stay_id`),
  KEY `IDX_6EA9A1464F31A84` (`medecin_id`),
  CONSTRAINT `FK_6EA9A1464F31A84` FOREIGN KEY (`medecin_id`) REFERENCES `medecin` (`id`),
  CONSTRAINT `FK_6EA9A146FB3AF7D6` FOREIGN KEY (`stay_id`) REFERENCES `stay` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=901 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendar`
--

LOCK TABLES `calendar` WRITE;
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
INSERT INTO `calendar` VALUES (841,314,1921,'Colette Delorme','2024-03-19 09:00:00','2024-03-26 14:00:00','Occaecati est et iusto culpa facere ducimus.'),(842,314,1922,'Colette Delorme','2023-03-19 09:00:00','2022-04-19 14:00:00','Reprehenderit dolorem deleniti molestiae recusandae occaecati dolore velit.'),(843,314,1923,'Colette Delorme','2024-03-05 09:00:00','2024-02-27 14:00:00','Odio esse illum dolores error modi.'),(844,314,1924,'Colette Delorme','2024-04-19 09:00:00','2024-05-31 14:00:00','Non quaerat maxime veniam architecto ut.'),(845,314,1925,'Grégoire Fontaine','2024-03-19 10:00:00','2024-03-26 15:00:00','Consequatur necessitatibus aut aut sit.'),(846,314,1926,'Grégoire Fontaine','2023-03-19 10:00:00','2022-04-19 15:00:00','Non impedit repudiandae est sit voluptatibus.'),(847,314,1927,'Grégoire Fontaine','2024-03-05 10:00:00','2024-02-27 15:00:00','Praesentium aliquid quia est sapiente facilis vel nihil.'),(848,314,1928,'Grégoire Fontaine','2024-04-19 10:00:00','2024-05-31 15:00:00','Animi distinctio officia facilis blanditiis delectus et fugit.'),(849,314,1929,'Zacharie Mathieu','2024-03-19 11:00:00','2024-03-26 16:00:00','Magnam porro in eligendi aliquid eos id vel.'),(850,314,1930,'Zacharie Mathieu','2023-03-19 11:00:00','2022-04-19 16:00:00','Rem et voluptatem consequuntur voluptas.'),(851,314,1931,'Zacharie Mathieu','2024-03-05 11:00:00','2024-02-27 16:00:00','Rerum quia rem dolor qui minus eveniet.'),(852,314,1932,'Zacharie Mathieu','2024-04-19 11:00:00','2024-05-31 16:00:00','Harum est tempora illo perferendis qui.'),(853,314,1933,'Dorothée Schneider','2024-03-19 12:00:00','2024-03-26 17:00:00','Omnis omnis ut officiis et.'),(854,314,1934,'Dorothée Schneider','2023-03-19 12:00:00','2022-04-19 17:00:00','Aspernatur ut tempora et assumenda unde aliquid voluptatem.'),(855,314,1935,'Dorothée Schneider','2024-03-05 12:00:00','2024-02-27 17:00:00','Ipsum perspiciatis eos quibusdam dignissimos autem dolorem.'),(856,314,1936,'Dorothée Schneider','2024-04-19 12:00:00','2024-05-31 17:00:00','Adipisci velit assumenda impedit culpa illum quia et.'),(857,314,1937,'Lucie Guyon','2024-03-19 13:00:00','2024-03-26 18:00:00','Sit quis veniam velit nobis natus.'),(858,314,1938,'Lucie Guyon','2023-03-19 13:00:00','2022-04-19 18:00:00','Quia ut quo facere iusto vel iusto exercitationem officia.'),(859,314,1939,'Lucie Guyon','2024-03-05 13:00:00','2024-02-27 18:00:00','Ea nobis officiis aut voluptates ex occaecati possimus est.'),(860,314,1940,'Lucie Guyon','2024-04-19 13:00:00','2024-05-31 18:00:00','Aut ipsa quis similique voluptatem.'),(861,315,1941,'Émilie Morel','2024-03-17 09:00:00','2024-03-24 14:00:00','Sed nisi aut optio aut doloribus id dolor.'),(862,315,1942,'Émilie Morel','2023-03-19 09:00:00','2022-04-19 14:00:00','Cupiditate ut illum est sit minus.'),(863,315,1943,'Émilie Morel','2024-03-12 09:00:00','2024-03-19 14:00:00','Delectus eos quia eaque non enim magni.'),(864,315,1944,'Émilie Morel','2024-04-19 09:00:00','2024-05-31 14:00:00','Quis est quas ut suscipit nobis atque enim.'),(865,315,1945,'Jacques Jourdan','2024-03-17 10:00:00','2024-03-24 15:00:00','Tempora consequatur eum enim accusantium error.'),(866,315,1946,'Jacques Jourdan','2023-03-19 10:00:00','2022-04-19 15:00:00','Adipisci et in aut.'),(867,315,1947,'Jacques Jourdan','2024-03-12 10:00:00','2024-03-19 15:00:00','Facilis ut distinctio aut ea tenetur aut.'),(868,315,1948,'Jacques Jourdan','2024-04-19 10:00:00','2024-05-31 15:00:00','Illum explicabo quia et.'),(869,315,1949,'Jeanne Germain','2024-03-17 11:00:00','2024-03-24 16:00:00','Est quam labore magni accusantium sed est sint.'),(870,315,1950,'Jeanne Germain','2023-03-19 11:00:00','2022-04-19 16:00:00','Repellat aut molestiae assumenda illum dicta.'),(871,315,1951,'Jeanne Germain','2024-03-12 11:00:00','2024-03-19 16:00:00','Mollitia temporibus commodi dolores animi est corporis earum.'),(872,315,1952,'Jeanne Germain','2024-04-19 11:00:00','2024-05-31 16:00:00','Accusamus itaque voluptatum quo suscipit sit eaque saepe.'),(873,315,1953,'Danielle Fouquet','2024-03-17 12:00:00','2024-03-24 17:00:00','Reiciendis aut et et.'),(874,315,1954,'Danielle Fouquet','2023-03-19 12:00:00','2022-04-19 17:00:00','Nostrum quas facere nesciunt quidem deleniti hic.'),(875,315,1955,'Danielle Fouquet','2024-03-12 12:00:00','2024-03-19 17:00:00','Sed vel aliquid velit doloribus omnis ut.'),(876,315,1956,'Danielle Fouquet','2024-04-19 12:00:00','2024-05-31 17:00:00','Quae vero quidem qui nisi tempore laudantium.'),(877,315,1957,'Antoine Hamon','2024-03-17 13:00:00','2024-03-24 18:00:00','Dolores consequatur neque a id.'),(878,315,1958,'Antoine Hamon','2023-03-19 13:00:00','2022-04-19 18:00:00','Optio nesciunt eligendi sed autem ea possimus.'),(879,315,1959,'Antoine Hamon','2024-03-12 13:00:00','2024-03-19 18:00:00','Quo hic eveniet quia facere eveniet ab.'),(880,315,1960,'Antoine Hamon','2024-04-19 13:00:00','2024-05-31 18:00:00','Est dolorem id quia adipisci quia in.'),(881,316,1961,'Alex Chevallier','2024-03-19 09:00:00','2024-03-26 14:00:00','Repellendus quo ullam minima.'),(882,316,1962,'Alex Chevallier','2023-03-19 09:00:00','2022-04-19 14:00:00','Odio consequatur aut inventore nemo.'),(883,316,1963,'Alex Chevallier','2024-03-05 09:00:00','2024-02-27 14:00:00','Est quia ad dicta aspernatur in repellat aspernatur.'),(884,316,1964,'Alex Chevallier','2024-04-19 09:00:00','2024-05-31 14:00:00','Nihil repellendus voluptatem doloremque ut quam.'),(885,316,1965,'Agnès Riviere','2024-03-19 10:00:00','2024-03-26 15:00:00','Illo dolorem repellendus consequatur repellat sit.'),(886,316,1966,'Agnès Riviere','2023-03-19 10:00:00','2022-04-19 15:00:00','Et numquam nemo sint placeat debitis consequatur in.'),(887,316,1967,'Agnès Riviere','2024-03-05 10:00:00','2024-02-27 15:00:00','Sed quos nobis id quo unde inventore voluptas.'),(888,316,1968,'Agnès Riviere','2024-04-19 10:00:00','2024-05-31 15:00:00','Officia ea quo accusantium delectus et.'),(889,316,1969,'Benoît De Oliveira','2024-03-19 11:00:00','2024-03-26 16:00:00','Neque expedita dolore cumque est illo et.'),(890,316,1970,'Benoît De Oliveira','2023-03-19 11:00:00','2022-04-19 16:00:00','Laboriosam nulla officia natus saepe.'),(891,316,1971,'Benoît De Oliveira','2024-03-05 11:00:00','2024-02-27 16:00:00','Cupiditate et nostrum ipsa autem qui voluptatem deserunt nulla.'),(892,316,1972,'Benoît De Oliveira','2024-04-19 11:00:00','2024-05-31 16:00:00','Voluptatem minus voluptatem ut et dolorum alias.'),(893,316,1973,'Dorothée Buisson','2024-03-19 12:00:00','2024-03-26 17:00:00','Officia odio magnam fuga numquam ea debitis iste.'),(894,316,1974,'Dorothée Buisson','2023-03-19 12:00:00','2022-04-19 17:00:00','Sed quis ad quam iure nihil iure.'),(895,316,1975,'Dorothée Buisson','2024-03-05 12:00:00','2024-02-27 17:00:00','Odio reiciendis eos accusantium molestiae ut incidunt magnam.'),(896,316,1976,'Dorothée Buisson','2024-04-19 12:00:00','2024-05-31 17:00:00','Dolores omnis voluptas ipsa qui aut eligendi veniam.'),(897,316,1977,'Emmanuelle Roy','2024-03-19 13:00:00','2024-03-26 18:00:00','Voluptatem inventore et rerum omnis vitae eum doloremque.'),(898,316,1978,'Emmanuelle Roy','2023-03-19 13:00:00','2022-04-19 18:00:00','Corrupti minus voluptate dolore inventore aut quisquam id.'),(899,316,1979,'Emmanuelle Roy','2024-03-05 13:00:00','2024-02-27 18:00:00','Ad nihil dolore aut voluptatem.'),(900,316,1980,'Emmanuelle Roy','2024-04-19 13:00:00','2024-05-31 18:00:00','Id natus architecto aut occaecati quibusdam aut et.');
/*!40000 ALTER TABLE `calendar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `django_admin_log`
--

DROP TABLE IF EXISTS `django_admin_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `django_admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_time` datetime(6) NOT NULL,
  `object_id` longtext DEFAULT NULL,
  `object_repr` varchar(200) NOT NULL,
  `action_flag` smallint(5) unsigned NOT NULL CHECK (`action_flag` >= 0),
  `change_message` longtext NOT NULL,
  `content_type_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `django_admin_log_content_type_id_c4bce8eb_fk_django_co` (`content_type_id`),
  KEY `django_admin_log_user_id_c564eba6_fk_auth_user_id` (`user_id`),
  CONSTRAINT `django_admin_log_content_type_id_c4bce8eb_fk_django_co` FOREIGN KEY (`content_type_id`) REFERENCES `django_content_type` (`id`),
  CONSTRAINT `django_admin_log_user_id_c564eba6_fk_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `django_admin_log`
--

LOCK TABLES `django_admin_log` WRITE;
/*!40000 ALTER TABLE `django_admin_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `django_admin_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `django_content_type`
--

DROP TABLE IF EXISTS `django_content_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `django_content_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_label` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `django_content_type_app_label_model_76bd3d3b_uniq` (`app_label`,`model`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `django_content_type`
--

LOCK TABLES `django_content_type` WRITE;
/*!40000 ALTER TABLE `django_content_type` DISABLE KEYS */;
INSERT INTO `django_content_type` VALUES (7,'account','emailaddress'),(8,'account','emailconfirmation'),(1,'admin','logentry'),(3,'auth','group'),(2,'auth','permission'),(4,'auth','user'),(5,'contenttypes','contenttype'),(6,'sessions','session'),(9,'socialaccount','socialaccount'),(10,'socialaccount','socialapp'),(11,'socialaccount','socialtoken');
/*!40000 ALTER TABLE `django_content_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `django_migrations`
--

DROP TABLE IF EXISTS `django_migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `django_migrations` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `app` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `applied` datetime(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `django_migrations`
--

LOCK TABLES `django_migrations` WRITE;
/*!40000 ALTER TABLE `django_migrations` DISABLE KEYS */;
INSERT INTO `django_migrations` VALUES (1,'contenttypes','0001_initial','2024-03-16 06:58:02.406043'),(2,'auth','0001_initial','2024-03-16 06:58:02.877913'),(3,'account','0001_initial','2024-03-16 06:58:03.029061'),(4,'account','0002_email_max_length','2024-03-16 06:58:03.045442'),(5,'account','0003_alter_emailaddress_create_unique_verified_email','2024-03-16 06:58:03.083405'),(6,'account','0004_alter_emailaddress_drop_unique_email','2024-03-16 06:58:03.635223'),(7,'account','0005_emailaddress_idx_upper_email','2024-03-16 06:58:03.647996'),(8,'admin','0001_initial','2024-03-16 06:58:03.771731'),(9,'admin','0002_logentry_remove_auto_add','2024-03-16 06:58:03.779729'),(10,'admin','0003_logentry_add_action_flag_choices','2024-03-16 06:58:03.792543'),(11,'contenttypes','0002_remove_content_type_name','2024-03-16 06:58:03.853281'),(12,'auth','0002_alter_permission_name_max_length','2024-03-16 06:58:03.909432'),(13,'auth','0003_alter_user_email_max_length','2024-03-16 06:58:03.925031'),(14,'auth','0004_alter_user_username_opts','2024-03-16 06:58:03.935823'),(15,'auth','0005_alter_user_last_login_null','2024-03-16 06:58:03.972694'),(16,'auth','0006_require_contenttypes_0002','2024-03-16 06:58:03.975968'),(17,'auth','0007_alter_validators_add_error_messages','2024-03-16 06:58:03.989699'),(18,'auth','0008_alter_user_username_max_length','2024-03-16 06:58:04.004801'),(19,'auth','0009_alter_user_last_name_max_length','2024-03-16 06:58:04.021003'),(20,'auth','0010_alter_group_name_max_length','2024-03-16 06:58:04.038229'),(21,'auth','0011_update_proxy_permissions','2024-03-16 06:58:04.047195'),(22,'auth','0012_alter_user_first_name_max_length','2024-03-16 06:58:04.065724'),(23,'sessions','0001_initial','2024-03-16 06:58:04.097527'),(24,'socialaccount','0001_initial','2024-03-16 06:58:04.368689'),(25,'socialaccount','0002_token_max_lengths','2024-03-16 06:58:04.404694'),(26,'socialaccount','0003_extra_data_default_dict','2024-03-16 06:58:04.413271'),(27,'socialaccount','0004_app_provider_id_settings','2024-03-16 06:58:04.529874'),(28,'socialaccount','0005_socialtoken_nullable_app','2024-03-16 06:58:04.674392'),(29,'socialaccount','0006_alter_socialaccount_extra_data','2024-03-16 06:58:04.726134');
/*!40000 ALTER TABLE `django_migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `django_session`
--

DROP TABLE IF EXISTS `django_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `django_session` (
  `session_key` varchar(40) NOT NULL,
  `session_data` longtext NOT NULL,
  `expire_date` datetime(6) NOT NULL,
  PRIMARY KEY (`session_key`),
  KEY `django_session_expire_date_a5c62663` (`expire_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `django_session`
--

LOCK TABLES `django_session` WRITE;
/*!40000 ALTER TABLE `django_session` DISABLE KEYS */;
INSERT INTO `django_session` VALUES ('2yzorcw2z1zhc35lwaflb2u5olr59map','.eJxlUNFuhCAQ_Jd9NgYUBXxq-xtNQ_ZgiaSKF8G0zeX-vXL1xd7bZmd2ZnZugNYuW8wGtzxSzMFiDks0M-VxcQmG9xv8zTDAFVP6WlYHFWCGgUvOZMdayWole6b6pgKaMUw7Fd0c4kvKmwu1X_eDLdEacaZn7P5RwcPeFI4JxYnDaXdB-0mxADhNZV0fsesH54BT_Xp64u24OkmNmMZdRwllsW067TpuNSPmhGfCeeGQpO9UK3r0SjcKiSmhW3nxVnMuNTnSTvSlgufmyJl_xWgmWqblHiFRSqVZ-r6G9QcGdv8FtH9-tQ:1rm8Ju:sZYMrLpQMslugDTP4vw4lLRy8zyRvKrv28LQbCNOPTw','2024-04-01 08:26:10.905906');
/*!40000 ALTER TABLE `django_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20240305110913','2024-03-05 12:09:25',859);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drugs`
--

DROP TABLE IF EXISTS `drugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drugs`
--

LOCK TABLES `drugs` WRITE;
/*!40000 ALTER TABLE `drugs` DISABLE KEYS */;
INSERT INTO `drugs` VALUES (157,'Doliprane'),(158,'Peniciline'),(159,'Vitamine'),(160,'Maalox'),(161,'Ibuprofène'),(162,'Amoxicilline');
/*!40000 ALTER TABLE `drugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medecin`
--

DROP TABLE IF EXISTS `medecin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medecin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1BDA53C6A76ED395` (`user_id`),
  CONSTRAINT `FK_1BDA53C6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=317 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medecin`
--

LOCK TABLES `medecin` WRITE;
/*!40000 ALTER TABLE `medecin` DISABLE KEYS */;
INSERT INTO `medecin` VALUES (304,820),(305,821),(306,822),(307,823),(308,824),(309,825),(310,826),(311,827),(312,828),(313,829),(314,840),(315,846),(316,852);
/*!40000 ALTER TABLE `medecin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medecin_speciality`
--

DROP TABLE IF EXISTS `medecin_speciality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medecin_speciality` (
  `medecin_id` int(11) NOT NULL,
  `speciality_id` int(11) NOT NULL,
  PRIMARY KEY (`medecin_id`,`speciality_id`),
  KEY `IDX_2B5B6D544F31A84` (`medecin_id`),
  KEY `IDX_2B5B6D543B5A08D7` (`speciality_id`),
  CONSTRAINT `FK_2B5B6D543B5A08D7` FOREIGN KEY (`speciality_id`) REFERENCES `speciality` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_2B5B6D544F31A84` FOREIGN KEY (`medecin_id`) REFERENCES `medecin` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medecin_speciality`
--

LOCK TABLES `medecin_speciality` WRITE;
/*!40000 ALTER TABLE `medecin_speciality` DISABLE KEYS */;
INSERT INTO `medecin_speciality` VALUES (304,393),(304,398),(304,401),(304,402),(305,394),(306,393),(306,395),(306,398),(306,402),(307,400),(307,401),(307,403),(307,404),(307,405),(308,396),(308,399),(308,400),(308,404),(309,391),(309,400),(310,393),(310,394),(310,404),(311,393),(311,394),(311,396),(311,400),(312,397),(312,398),(312,400),(312,405),(313,404),(314,391),(314,392),(314,393),(314,394),(314,395),(314,396),(315,391),(315,392),(315,393),(315,394),(315,395),(315,396),(316,391),(316,392),(316,393),(316,394),(316,395),(316,396);
/*!40000 ALTER TABLE `medecin_speciality` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medication`
--

DROP TABLE IF EXISTS `medication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `drug_id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `dosage` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5AEE5B70AABCA765` (`drug_id`),
  KEY `IDX_5AEE5B7093DB413D` (`prescription_id`),
  CONSTRAINT `FK_5AEE5B7093DB413D` FOREIGN KEY (`prescription_id`) REFERENCES `prescription` (`id`),
  CONSTRAINT `FK_5AEE5B70AABCA765` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2703 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medication`
--

LOCK TABLES `medication` WRITE;
/*!40000 ALTER TABLE `medication` DISABLE KEYS */;
INSERT INTO `medication` VALUES (2523,157,843,'Cum aut praesentium aliquid occaecati.'),(2524,158,843,'Debitis quasi aliquid sunt dolorem officia.'),(2525,159,843,'Voluptatem laudantium nisi rem.'),(2526,157,844,'Eos repellat provident eveniet praesentium est itaque cum.'),(2527,158,844,'Est fugiat voluptas sed dolor.'),(2528,159,844,'Sequi voluptates incidunt in quisquam.'),(2529,157,845,'Velit provident numquam quidem pariatur nihil reprehenderit.'),(2530,158,845,'Et minus placeat voluptates molestiae quaerat.'),(2531,159,845,'Pariatur culpa quia exercitationem eveniet autem.'),(2532,157,846,'Voluptate quam facilis nulla non enim eum sit in.'),(2533,158,846,'Consequatur modi eligendi aut sunt quis perferendis magni.'),(2534,159,846,'Et voluptatum ullam repudiandae molestias dolore ut et.'),(2535,157,847,'Rerum et voluptatem ad consectetur eum velit libero.'),(2536,158,847,'Itaque ut incidunt occaecati iure velit.'),(2537,159,847,'Earum et ipsa deleniti autem fuga nesciunt iure.'),(2538,157,848,'Et deserunt quod et nihil provident nam.'),(2539,158,848,'Dolore quos possimus aut rerum enim iusto quia.'),(2540,159,848,'Blanditiis voluptatum in doloremque dolore explicabo sint similique.'),(2541,157,849,'Asperiores quia voluptatem qui sint est neque dolorem id.'),(2542,158,849,'Facere aut eos tempora sit qui rerum.'),(2543,159,849,'Possimus maiores temporibus itaque fuga maiores sint aspernatur.'),(2544,157,850,'Exercitationem consequatur dolorum a necessitatibus dolorem.'),(2545,158,850,'Sit aspernatur maxime hic et ipsam.'),(2546,159,850,'Sunt optio omnis consequatur at.'),(2547,157,851,'Et facere pariatur harum.'),(2548,158,851,'Perferendis inventore tenetur aut non exercitationem.'),(2549,159,851,'Id est molestiae qui aut beatae voluptas.'),(2550,157,852,'Saepe cum itaque consequatur quas quae autem.'),(2551,158,852,'Hic assumenda et eveniet non aut dolorem nemo aliquam.'),(2552,159,852,'Nemo non tempore facilis beatae.'),(2553,157,853,'Suscipit porro recusandae molestiae in.'),(2554,158,853,'Commodi labore cumque non.'),(2555,159,853,'Repellendus odio ea accusamus maxime consectetur consequatur consequatur.'),(2556,157,854,'Perferendis consectetur maiores fuga repellat.'),(2557,158,854,'Facilis molestiae iusto praesentium voluptas.'),(2558,159,854,'Aut voluptatem expedita laborum ducimus.'),(2559,157,855,'Ab veniam aut praesentium ab molestiae ut.'),(2560,158,855,'Minima expedita illo esse animi.'),(2561,159,855,'Nihil repellendus modi aut aut iste.'),(2562,157,856,'Velit ut incidunt aut expedita reiciendis accusantium qui aliquid.'),(2563,158,856,'Quo et earum voluptatibus qui et doloremque eos.'),(2564,159,856,'Error amet qui consequatur eos cumque possimus qui.'),(2565,157,857,'Et consequatur quia qui cupiditate atque.'),(2566,158,857,'Expedita nisi veniam ut laudantium.'),(2567,159,857,'Nesciunt animi repellat est occaecati suscipit nesciunt eos.'),(2568,157,858,'Molestias corrupti dignissimos consectetur est dicta non quia consequatur.'),(2569,158,858,'Adipisci nostrum doloremque eveniet autem nam modi ut.'),(2570,159,858,'Et quidem amet tenetur et doloribus modi nesciunt quisquam.'),(2571,157,859,'Atque ut consequatur aliquid eum temporibus accusantium.'),(2572,158,859,'Expedita dolorem dolor quo accusantium.'),(2573,159,859,'In illum omnis natus ex sunt.'),(2574,157,860,'Perferendis voluptatibus sunt ex perspiciatis quia voluptates.'),(2575,158,860,'Consequuntur qui non perferendis assumenda velit odio facere.'),(2576,159,860,'Aut assumenda labore ipsa est.'),(2577,157,861,'Ipsam debitis quo rem.'),(2578,158,861,'Voluptatibus consequatur nam numquam et unde consectetur accusamus.'),(2579,159,861,'Omnis officia molestias similique rerum quo hic ratione reiciendis.'),(2580,157,862,'Laborum odio non ipsa repellendus animi.'),(2581,158,862,'Similique et velit sit consequuntur deserunt at reiciendis.'),(2582,159,862,'Labore dolorem aliquid tenetur sint minus ad fuga.'),(2583,157,863,'Qui ex qui fugiat temporibus asperiores iste occaecati.'),(2584,158,863,'Cupiditate odio ut est cupiditate.'),(2585,159,863,'Vel pariatur et perferendis molestias voluptatem voluptates.'),(2586,157,864,'Similique ut blanditiis tempore quaerat dolor et.'),(2587,158,864,'Perferendis id praesentium vitae velit eum.'),(2588,159,864,'Aut reiciendis qui reiciendis quidem eveniet eos ducimus.'),(2589,157,865,'Sequi magni dolorem magni provident rerum et explicabo.'),(2590,158,865,'Velit numquam et ducimus iste.'),(2591,159,865,'Cupiditate magni et quaerat delectus.'),(2592,157,866,'Quam ut quia nam.'),(2593,158,866,'Blanditiis placeat quisquam dolorum cum pariatur.'),(2594,159,866,'Iste laudantium perferendis ut corporis nihil ea mollitia.'),(2595,157,867,'At alias suscipit dolorem vero omnis labore nostrum.'),(2596,158,867,'Est voluptatem facere dolore ut culpa.'),(2597,159,867,'In nihil dolorem ea reiciendis incidunt veritatis quis et.'),(2598,157,868,'Ducimus dolor minus mollitia quia deleniti.'),(2599,158,868,'Fugiat cumque mollitia nam qui quaerat voluptatibus ea consequuntur.'),(2600,159,868,'Vero eaque assumenda illum quibusdam excepturi.'),(2601,157,869,'Non officia non nihil.'),(2602,158,869,'Odit nostrum nesciunt quia id alias voluptas.'),(2603,159,869,'Possimus consequatur accusamus laboriosam magnam qui cum est.'),(2604,157,870,'Fuga est repudiandae harum non necessitatibus dolorum tempore.'),(2605,158,870,'In autem animi animi consequatur.'),(2606,159,870,'Aut facere sit nemo ad voluptatem.'),(2607,157,871,'In eos officiis et et aut ut.'),(2608,158,871,'Dolor dolor atque aut quia.'),(2609,159,871,'Dicta blanditiis est repudiandae incidunt.'),(2610,157,872,'Suscipit veritatis similique voluptatem omnis.'),(2611,158,872,'Vel rerum et non voluptatum optio vero eum nihil.'),(2612,159,872,'Nulla sapiente nihil rem.'),(2613,157,873,'Unde sed vero sint rem est ut.'),(2614,158,873,'Architecto omnis minima et pariatur natus ipsum.'),(2615,159,873,'Inventore doloremque exercitationem eius.'),(2616,157,874,'Dolor dolorum quasi eveniet tenetur mollitia ut.'),(2617,158,874,'Velit non unde totam eum ex fugit.'),(2618,159,874,'Eligendi molestiae recusandae dolores.'),(2619,157,875,'Nesciunt non molestiae dolores consequatur beatae qui neque.'),(2620,158,875,'Quam delectus voluptatem omnis aperiam.'),(2621,159,875,'Voluptatem aperiam magnam vel necessitatibus beatae officiis doloribus.'),(2622,157,876,'Est et non est quod eligendi.'),(2623,158,876,'Aut voluptas nostrum minima temporibus fugiat.'),(2624,159,876,'Et corrupti fugiat quibusdam unde et atque laudantium.'),(2625,157,877,'Natus quisquam vel voluptate suscipit et voluptatum.'),(2626,158,877,'Deserunt nisi nemo odio odit perspiciatis.'),(2627,159,877,'Placeat et rerum eos optio et dolorum rerum at.'),(2628,157,878,'Culpa aut aliquam sit repudiandae expedita ipsa tempora.'),(2629,158,878,'Velit quibusdam expedita sit non.'),(2630,159,878,'Dolor veniam ut distinctio facere illo.'),(2631,157,879,'Voluptas consequatur aperiam odio tempore.'),(2632,158,879,'Recusandae laboriosam inventore rerum eaque.'),(2633,159,879,'Deleniti corrupti nam repudiandae aut sed.'),(2634,157,880,'Alias ut ut accusantium rerum atque.'),(2635,158,880,'Quo eum sit iste omnis sint temporibus sit ducimus.'),(2636,159,880,'Ut cupiditate nam nihil accusantium sed esse deserunt.'),(2637,157,881,'Fuga numquam provident enim et consectetur molestiae.'),(2638,158,881,'Aspernatur repellendus et doloribus quibusdam deleniti.'),(2639,159,881,'Sint ut qui nobis eligendi id.'),(2640,157,882,'Veniam occaecati dignissimos suscipit esse et.'),(2641,158,882,'Accusamus et laborum ipsam ab voluptas corporis.'),(2642,159,882,'Voluptatem qui aperiam beatae vitae alias quis ipsa.'),(2643,157,883,'Magni accusamus consectetur aut magnam iusto.'),(2644,158,883,'Totam esse hic earum saepe sunt aspernatur distinctio possimus.'),(2645,159,883,'Nostrum et ab dolores debitis.'),(2646,157,884,'Ex quo ut possimus soluta dolores.'),(2647,158,884,'Optio enim voluptatem accusantium rerum ut voluptas.'),(2648,159,884,'Et fuga et adipisci voluptate odit velit.'),(2649,157,885,'Incidunt voluptas ipsam modi.'),(2650,158,885,'Et omnis et cum esse.'),(2651,159,885,'Ipsum nobis in sint magni deleniti architecto.'),(2652,157,886,'In sit numquam dignissimos in.'),(2653,158,886,'Quisquam qui explicabo eius adipisci quod voluptas sint magnam.'),(2654,159,886,'Dolores est voluptatem ea assumenda ducimus tempora.'),(2655,157,887,'Doloribus sunt ut in vel.'),(2656,158,887,'Et qui quia adipisci accusamus voluptatum cupiditate est.'),(2657,159,887,'Molestias autem est iure reiciendis sed dicta at.'),(2658,157,888,'Totam dignissimos velit neque fuga earum.'),(2659,158,888,'Accusamus minima debitis at eum.'),(2660,159,888,'Quia molestias similique consequatur eum architecto illum.'),(2661,157,889,'Qui totam qui et nesciunt aut expedita.'),(2662,158,889,'Ut ipsa est sapiente aut delectus eos.'),(2663,159,889,'Quam sint autem officiis aliquam expedita enim.'),(2664,157,890,'Eum est occaecati iusto nulla dignissimos.'),(2665,158,890,'Ea autem mollitia quia quasi.'),(2666,159,890,'Suscipit qui qui eum quos impedit voluptatibus ut.'),(2667,157,891,'Consectetur et iste iusto sit nesciunt et.'),(2668,158,891,'Doloremque vitae reprehenderit nostrum autem pariatur nulla.'),(2669,159,891,'Quaerat placeat totam nostrum iure minus vel error.'),(2670,157,892,'Facere est nihil expedita cum debitis officia.'),(2671,158,892,'Perspiciatis sit ipsam pariatur velit soluta.'),(2672,159,892,'Adipisci consequatur quis atque nemo accusantium facilis.'),(2673,157,893,'Nihil eius et quisquam excepturi.'),(2674,158,893,'Molestiae reiciendis quod nemo sed quaerat quis ut.'),(2675,159,893,'Iure eos voluptatem soluta in magnam esse.'),(2676,157,894,'Aspernatur natus nisi adipisci esse a delectus.'),(2677,158,894,'Atque tenetur fugiat aut saepe veniam corporis.'),(2678,159,894,'Est quod molestiae numquam.'),(2679,157,895,'Et explicabo veniam repudiandae officia omnis sequi magni impedit.'),(2680,158,895,'Nostrum vero ratione repudiandae et eaque voluptatem eius ipsum.'),(2681,159,895,'Assumenda officiis culpa ratione sed consequatur fugit reiciendis.'),(2682,157,896,'Voluptatibus aut modi ducimus sit et cum.'),(2683,158,896,'Occaecati amet tempore est delectus dolor quos error.'),(2684,159,896,'Facere et animi incidunt et atque tenetur rerum.'),(2685,157,897,'Et delectus in et sunt repudiandae assumenda minus.'),(2686,158,897,'Eum nobis placeat corporis aliquid iure voluptatem.'),(2687,159,897,'Sed voluptates suscipit magnam eveniet qui.'),(2688,157,898,'Ut molestiae ut quos tenetur.'),(2689,158,898,'Aspernatur ab architecto perspiciatis dolorem.'),(2690,159,898,'Debitis deleniti distinctio quas expedita commodi.'),(2691,157,899,'Rerum maxime voluptatibus eum consequuntur.'),(2692,158,899,'Sequi excepturi et voluptatem tenetur.'),(2693,159,899,'Eos magni distinctio non voluptas.'),(2694,157,900,'Ex sint et quo qui.'),(2695,158,900,'Culpa in amet molestias.'),(2696,159,900,'Distinctio ullam omnis nisi qui qui.'),(2697,157,901,'Minima ducimus eveniet quia earum debitis accusantium aut eos.'),(2698,158,901,'Consectetur amet ipsa quia fugit dolores et minima.'),(2699,159,901,'Velit pariatur asperiores ut nemo sunt sapiente soluta qui.'),(2700,157,902,'Nemo cum esse officiis rerum expedita qui.'),(2701,158,902,'Nulla voluptatem minima qui et accusantium voluptatum.'),(2702,159,902,'Earum amet molestias atque sed non distinctio at.');
/*!40000 ALTER TABLE `medication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opinions`
--

DROP TABLE IF EXISTS `opinions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opinions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `medecin_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BEAF78D06B899279` (`patient_id`),
  KEY `IDX_BEAF78D04F31A84` (`medecin_id`),
  CONSTRAINT `FK_BEAF78D04F31A84` FOREIGN KEY (`medecin_id`) REFERENCES `medecin` (`id`),
  CONSTRAINT `FK_BEAF78D06B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=906 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opinions`
--

LOCK TABLES `opinions` WRITE;
/*!40000 ALTER TABLE `opinions` DISABLE KEYS */;
INSERT INTO `opinions` VALUES (846,481,314,'Expedita sint velit enim.','2024-03-23','Laudantium ipsam repellendus voluptatem velit perferendis delectus. Iusto ea placeat error doloremque id aliquam. Nisi possimus vitae debitis officiis.'),(847,481,314,'Ipsam aut nostrum laudantium praesentium.','2024-03-25','Omnis hic sint asperiores vero. Quam beatae dolorum est provident magnam. Earum labore nemo dolorem consequuntur. Sequi aut ratione omnis eum.'),(848,481,314,'Atque placeat commodi enim quia.','2024-03-21','Cupiditate amet voluptates sequi ipsam necessitatibus pariatur. Nesciunt vel porro placeat tempora. Molestiae nulla maiores voluptatibus omnis dolore recusandae iste. Dolor sit nisi non dolores rerum iure. Amet dolor voluptatem repellendus porro corporis fuga.'),(849,481,314,'Veritatis voluptate odit eius.','2024-03-24','Incidunt accusantium optio quod asperiores vitae beatae ea. Nam tenetur iure voluptas sed sapiente. Tenetur quia odit voluptatem alias et eveniet. Aut aut odio a quibusdam ipsam incidunt.'),(850,482,314,'Enim sint hic et aperiam voluptas.','2024-03-30','Illum deserunt et quis distinctio culpa accusantium reiciendis. Corporis numquam at soluta sed provident esse. Reiciendis qui sed quod in iusto.'),(851,482,314,'Iste animi est voluptas laudantium sunt pariatur delectus ut.','2024-03-26','Animi eos et sapiente sint deleniti dolorem. Alias deleniti ut illo explicabo dicta. Velit molestiae ut quo sunt id dolor.'),(852,482,314,'Dignissimos beatae unde ea molestias.','2024-03-21','Sunt corrupti ut quia. Aut officiis aut est iste.'),(853,482,314,'Minus ut minima occaecati qui voluptas exercitationem corrupti.','2024-03-24','Et saepe nulla est exercitationem ut. Molestias accusantium molestiae et. Id deleniti laudantium illum. Ex libero voluptatem asperiores maxime nesciunt.'),(854,483,314,'Occaecati maxime dicta ratione.','2024-03-20','Quae facere possimus est est. Tempora qui perspiciatis dolor occaecati non et suscipit quisquam. Autem explicabo at tempora laborum sed. Aut eos consectetur quibusdam sit id. Nihil ea tempore et tenetur libero quo quia.'),(855,483,314,'Minus tempora adipisci corrupti illum sed.','2024-03-28','Optio culpa velit deleniti rerum consequatur sunt ratione. Facere hic est temporibus laboriosam nam neque. Ipsa incidunt ut suscipit porro hic at quos necessitatibus. Necessitatibus molestiae aliquam a ut dolorum. Quaerat pariatur omnis velit voluptas.'),(856,483,314,'Eos consequatur magni repellat ducimus blanditiis corporis sit illum.','2024-03-22','Quaerat assumenda est aspernatur temporibus rerum necessitatibus neque. Quod aut recusandae quibusdam. In aliquam alias nisi recusandae et assumenda sint.'),(857,483,314,'Ipsum dolor incidunt nulla consectetur nisi.','2024-04-01','Iste asperiores optio repellendus. Vel recusandae dolores dolores molestiae. Voluptatem explicabo commodi aut sequi cum labore. Tempora architecto quod dolor ut labore enim. Voluptas debitis doloremque saepe voluptatem fuga vel harum.'),(858,484,314,'Recusandae omnis modi in quas.','2024-03-22','Minima sunt non quod in. A et aut sequi omnis excepturi id. Est quis aliquid consequuntur laborum voluptates earum ea. Eveniet officia voluptatem rerum quia ullam molestias velit sed. Repellat et magnam optio dolorem porro.'),(859,484,314,'Doloremque consequatur quidem voluptas molestias quaerat.','2024-03-28','Rerum perferendis ut est porro in. Asperiores nisi dignissimos quo dolorem. Molestias omnis beatae ipsam beatae. Maxime explicabo nihil sunt.'),(860,484,314,'Quia iusto voluptatem et ipsam aut amet tenetur.','2024-03-21','Voluptate ipsum sit laborum animi quos quidem incidunt. Unde commodi qui voluptatem praesentium nobis. Odit commodi consequuntur recusandae facere fugit.'),(861,484,314,'Iure ratione facere eveniet dolorem eum est est.','2024-03-28','Nobis veniam impedit excepturi aliquam sit ex qui autem. Non et mollitia earum repellat eius enim fugit nulla. Et quia inventore suscipit nemo autem nemo repudiandae. Adipisci adipisci sed totam sed id et.'),(862,485,314,'Dolores pariatur ex impedit ea ipsam doloribus et.','2024-03-30','Dolorum quod quaerat vitae ut. Ab quo earum autem culpa voluptatem cum nesciunt. Aut reprehenderit error aut quisquam et fugiat sint asperiores.'),(863,485,314,'Nihil ducimus aspernatur suscipit consequuntur sit eum earum.','2024-03-30','Deleniti quis tempora ea veritatis. Deserunt voluptatum ut velit omnis quo voluptas.'),(864,485,314,'Sapiente aut autem magni quisquam qui delectus non.','2024-03-23','Dolorem eum perferendis sint quos. Ducimus nisi sit omnis accusamus qui rerum. Quis voluptatum ut aut qui.'),(865,485,314,'Non aut iusto beatae quia reprehenderit nihil voluptas.','2024-03-28','Corrupti voluptas qui dignissimos officiis in aut culpa. Unde delectus necessitatibus et tenetur. Architecto fugit est voluptatem aperiam nesciunt provident. Veritatis quam quod temporibus distinctio et tenetur quia.'),(866,486,315,'Et et cupiditate mollitia quam quia.','2024-03-30','Quod voluptatem impedit officiis et. Dolores ut voluptatum ut illo dolor sit. Sint quia consectetur accusantium exercitationem. Soluta nobis rem quos facere ipsum delectus.'),(867,486,315,'Quia neque atque sequi praesentium dolorem expedita ratione rerum.','2024-03-26','Voluptatibus debitis deleniti doloremque rerum autem tenetur eos. Alias odio minima suscipit similique. Eum eveniet et aut minus qui.'),(868,486,315,'Est consequatur quo sit dignissimos aut.','2024-03-28','Rerum asperiores facere aperiam. Ab et dicta et. Exercitationem consequatur illum laboriosam. Voluptatem optio sequi itaque voluptatum aliquam et accusantium.'),(869,486,315,'Sint ipsum voluptas sed aliquam cumque.','2024-03-27','Dolores quis qui eligendi provident iusto. Repellendus qui aut placeat excepturi et minima earum eligendi. Nam aut hic minima repellendus.'),(870,487,315,'Odit quia dolore voluptatem nihil quos totam et vero.','2024-03-31','Qui nulla eos est ab. Occaecati iure quisquam expedita ratione repudiandae facilis perferendis ea. Consequatur eum eaque voluptas delectus quasi eum sint. Et rerum nulla quibusdam velit.'),(871,487,315,'Vitae voluptates modi provident aliquid provident.','2024-03-22','Nihil repellendus et voluptatem. Natus et possimus doloremque dolor quibusdam repellat enim minus.'),(872,487,315,'Rerum dolores aliquid sunt voluptatem.','2024-03-21','Fugit maiores recusandae et provident accusamus fuga unde. Aliquid sit optio ratione consectetur. Non dolore nemo minima autem.'),(873,487,315,'Et nemo et distinctio ut.','2024-03-21','Rerum distinctio ex ut quia. Nobis autem aut at explicabo eum velit atque. Consequuntur quibusdam dolor quia aut ullam ad dolores rerum.'),(874,488,315,'Doloremque similique enim necessitatibus qui et.','2024-03-30','Iusto sed aut perspiciatis exercitationem voluptas quae. Ullam cupiditate eos eveniet rerum non. Aut tempora nemo sed dolore. Ea cupiditate explicabo dolorum.'),(875,488,315,'Recusandae qui et ipsa qui sunt iure quo.','2024-03-27','Vero minima qui consequatur in molestias. Perferendis et cum qui quia et qui. Neque quod sed assumenda consectetur eos labore.'),(876,488,315,'Molestiae distinctio ipsum maiores corporis earum temporibus ut et.','2024-03-26','Dolores doloremque veniam dolorem sunt. Dolores dolores aliquid laudantium. Occaecati dignissimos dignissimos alias maiores reiciendis perspiciatis. Et distinctio amet unde.'),(877,488,315,'Omnis aperiam explicabo aut tempore est dignissimos.','2024-03-25','Dolor ipsa soluta aut quia. Rerum vero praesentium aliquid inventore. Ducimus non quia pariatur explicabo qui.'),(878,489,315,'Dolores rerum hic et neque et expedita et.','2024-03-20','Pariatur quia excepturi rerum inventore id ut. Quia delectus veritatis commodi sed. Necessitatibus officiis quisquam quae perspiciatis cum omnis deleniti vel. Beatae nisi sit doloremque at minus.'),(879,489,315,'Saepe voluptate omnis id ut aspernatur qui quia.','2024-03-28','Magni vel ab qui aut nihil est mollitia. Corporis ea ut deleniti eius. Ducimus ullam eum qui autem.'),(880,489,315,'Aliquid perspiciatis voluptas ipsum explicabo.','2024-04-01','Et dolorem sapiente corporis in quia dolores. Atque ipsa beatae quia. Ducimus quo ea voluptatem vel animi et.'),(881,489,315,'Eum harum quidem a.','2024-03-29','Praesentium consequatur non hic eveniet esse consectetur. Inventore iusto in facilis iusto quo fuga a. Aut sint voluptatem culpa laboriosam vitae alias.'),(882,490,315,'Laboriosam autem praesentium qui mollitia.','2024-03-30','Totam ex similique aut dignissimos repellat magnam labore laudantium. Enim aspernatur quaerat aut dolores. Excepturi magni non consequatur. Voluptatem perferendis eum occaecati voluptatem fugit.'),(883,490,315,'Ut iste cupiditate labore enim.','2024-03-25','Ipsum id tempora corporis est. Asperiores qui pariatur quidem animi ea enim enim aut. Quo eum molestiae autem qui non voluptas. Voluptas minus nam repudiandae iste dignissimos consequuntur labore.'),(884,490,315,'Quas laboriosam dolor occaecati et soluta tempora.','2024-03-20','Cumque dolor temporibus deserunt neque itaque. Sunt omnis praesentium hic perspiciatis dolorum.'),(885,490,315,'Magnam sapiente voluptatem non laboriosam id necessitatibus.','2024-03-30','Voluptatem aut itaque tempore et ea ipsa. Ipsam reiciendis est corporis possimus vero. Dolor ut non ullam omnis repellat. Itaque tempore fugiat rerum et.'),(886,491,316,'Animi aut fuga unde.','2024-03-23','Sed labore delectus veritatis cumque. Libero ratione voluptas vero. Expedita aut et tempore et.'),(887,491,316,'Voluptatem dolorum minus est hic nihil magni et.','2024-03-23','Corporis enim quibusdam velit est harum aut. Quo mollitia qui harum et. Possimus tenetur quidem in ea fuga.'),(888,491,316,'Sint sit quisquam tempore voluptatibus vero.','2024-03-27','Necessitatibus asperiores fuga dolore quia sunt. Vitae accusamus aut fugit asperiores velit odit repellat. Rerum aut hic sit distinctio unde et.'),(889,491,316,'Ipsa enim id odio exercitationem nostrum ratione commodi.','2024-03-26','Et possimus a officia et. Animi laboriosam magni qui nostrum. Accusamus autem aut soluta vel. Nulla voluptatem accusantium consequatur eum similique quasi voluptatum.'),(890,492,316,'Odit minus veritatis natus.','2024-03-20','Impedit ut est voluptatum consequatur. Sapiente aut voluptatem enim ut a vero unde. Aut atque nobis rerum eos placeat. Ipsam ut nostrum dicta nihil voluptatem nostrum.'),(891,492,316,'Reiciendis aliquid ipsum cum voluptatum et tempore.','2024-03-21','Sequi voluptatem possimus cumque. Ut illo iste ut ut expedita natus sit nam. Qui eum consequatur expedita eos.'),(892,492,316,'Non non tempora quasi at.','2024-03-23','Est beatae explicabo ipsam rerum dolores hic et. Mollitia dolorem aspernatur et libero maxime dolorem non aut. Dicta distinctio itaque qui.'),(893,492,316,'Veritatis error cum quam earum consequuntur vel accusamus.','2024-03-20','Accusamus consequatur nihil beatae repudiandae reiciendis rerum vitae quod. Et perspiciatis illum magni deleniti sunt et at. Amet quod ipsam incidunt sunt voluptatum optio culpa odit. Distinctio harum laudantium ut doloribus.'),(894,493,316,'Molestias labore non autem repellat culpa.','2024-03-21','Non molestiae saepe voluptatibus facere quaerat. Deleniti delectus accusamus sit ipsam dolor quae. Dicta blanditiis error ut mollitia recusandae quia molestiae soluta. Id commodi ab aliquam.'),(895,493,316,'Sit quam temporibus omnis architecto incidunt delectus unde.','2024-03-31','Non fuga sed repudiandae voluptas sunt cum. Ratione quis vel ea corporis eaque omnis. Sit numquam ut magnam. Velit atque enim recusandae.'),(896,493,316,'Aut quas et corporis et illum ratione.','2024-03-21','Quae blanditiis corporis et iusto quis. Tenetur qui et sed. Fugit cumque est voluptatem iste eos sit.'),(897,493,316,'Eligendi et illo non impedit.','2024-03-28','Officia fuga sunt ipsa atque et quaerat quia. Rerum repellat nam laboriosam et voluptates a et. Tenetur minus aut quaerat quia et totam enim.'),(898,494,316,'Perferendis cupiditate dolorem maiores ullam dolores libero.','2024-04-01','Vel praesentium ab fuga aut quas modi. Laudantium aut earum rem ullam nam. Quis sapiente et hic possimus adipisci et excepturi. Vel veniam expedita sed culpa.'),(899,494,316,'Voluptates corporis atque ipsum beatae voluptates velit.','2024-03-21','Esse quos omnis et omnis. Voluptatem alias esse neque dolorem. Odio et perspiciatis ullam libero tempore et voluptatem. Id consequuntur numquam quae ut reiciendis ad.'),(900,494,316,'Error non facilis autem molestiae sint itaque.','2024-03-22','Odit quaerat adipisci aut molestias. Aut eaque qui et aspernatur blanditiis quidem sit. Maxime neque reprehenderit nihil et. Vitae et doloremque vero repellat vero.'),(901,494,316,'Tenetur rerum cumque quo praesentium nihil fugit et perspiciatis.','2024-03-27','Dolores eum quia eum molestiae. Dolores possimus magnam vel nesciunt ut commodi perferendis. Eaque facere mollitia reiciendis ex eligendi. Et qui non officiis voluptatem molestias dolores maxime impedit.'),(902,495,316,'Est ad animi sed repellat dolor repudiandae.','2024-03-25','Aut aut eos quisquam earum est voluptas. Aut minima occaecati placeat minima. Nemo amet neque enim commodi.'),(903,495,316,'Ullam eum fuga blanditiis corporis ipsa nemo.','2024-03-27','Ex architecto in ab laudantium optio ut dolorum. Est ex voluptatem quisquam nulla voluptatem. Dolores tempore porro temporibus libero soluta vero. Quas dolorem quod iure ut.'),(904,495,316,'Libero dolore minima non vitae non.','2024-03-24','Ex eos rerum omnis vel dignissimos. Corporis laboriosam ipsum omnis nam veniam amet et.'),(905,495,316,'In qui odio neque et reprehenderit dolore cupiditate.','2024-03-21','Neque voluptate quia et doloremque voluptatem. Modi officiis velit minima sunt quia in consequatur. Dolorum in sapiente non numquam iste sunt voluptas. Voluptatibus ab minima unde quidem necessitatibus.');
/*!40000 ALTER TABLE `opinions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `adlibelle` longtext NOT NULL,
  `adcp` varchar(10) NOT NULL,
  `adcity` varchar(100) NOT NULL,
  `adcountry` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D567EE77A76ED395` (`user_id`),
  CONSTRAINT `FK_D567EE77A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=496 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES (471,830,'9, boulevard de Gonzalez','73283','Deschamps-sur-Boucher','FR'),(472,831,'avenue Vaillant','34280','Lopes','FR'),(473,832,'366, chemin Emmanuel Lebrun','48004','Malletboeuf','FR'),(474,833,'chemin Éléonore Marques','46132','Leclerc','FR'),(475,834,'3, boulevard Maillard','18818','Giraudnec','FR'),(476,835,'avenue David Jacquet','10613','Guyot-sur-Blot','FR'),(477,836,'27, rue de Mendes','55666','Riviere','FR'),(478,837,'196, impasse Margot Robert','45270','Dubois','FR'),(479,838,'14, avenue de Benoit','89339','Torres','FR'),(480,839,'chemin Benjamin Mahe','26643','Perrin-sur-Hamon','FR'),(481,841,'place de Lemaitre','25210','Delannoy-la-Forêt','FR'),(482,842,'78, boulevard Isaac Marchal','21180','ChartierVille','FR'),(483,843,'boulevard Rodriguez','27710','Bouvier','FR'),(484,844,'5, impasse Langlois','03759','Ollivier-sur-Baron','FR'),(485,845,'rue de Pineau','02440','DevauxBourg','FR'),(486,847,'20, place Dorothée Bouvier','16507','Gauthier-sur-Mer','FR'),(487,848,'33, rue de Le Goff','59338','Thibault-les-Bains','FR'),(488,849,'757, place Da Costa','28892','Aubert','FR'),(489,850,'89, impasse Marchand','00634','Fleurydan','FR'),(490,851,'17, rue de Perrier','40611','Dumont','FR'),(491,853,'rue Grégoire Garcia','98328','Fleury','FR'),(492,854,'13, impasse de Toussaint','32777','Rouxdan','FR'),(493,855,'chemin de Pascal','66031','Carre','FR'),(494,856,'8, rue de Leroy','40490','Allain','FR'),(495,857,'place Vincent Coulon','52034','Lemonnier-sur-Aubry','FR');
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prescription`
--

DROP TABLE IF EXISTS `prescription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prescription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medecin_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1FBFB8D94F31A84` (`medecin_id`),
  KEY `IDX_1FBFB8D96B899279` (`patient_id`),
  CONSTRAINT `FK_1FBFB8D94F31A84` FOREIGN KEY (`medecin_id`) REFERENCES `medecin` (`id`),
  CONSTRAINT `FK_1FBFB8D96B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=903 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prescription`
--

LOCK TABLES `prescription` WRITE;
/*!40000 ALTER TABLE `prescription` DISABLE KEYS */;
INSERT INTO `prescription` VALUES (843,314,481,'2024-03-19','2024-04-02'),(844,314,481,'2024-03-19','2024-03-30'),(845,314,481,'2024-03-19','2024-03-22'),(846,314,481,'2024-03-19','2024-03-26'),(847,314,482,'2024-03-19','2024-03-28'),(848,314,482,'2024-03-19','2024-03-29'),(849,314,482,'2024-03-19','2024-03-23'),(850,314,482,'2024-03-19','2024-03-23'),(851,314,483,'2024-03-19','2024-03-29'),(852,314,483,'2024-03-19','2024-04-02'),(853,314,483,'2024-03-19','2024-04-01'),(854,314,483,'2024-03-19','2024-04-02'),(855,314,484,'2024-03-19','2024-03-26'),(856,314,484,'2024-03-19','2024-04-02'),(857,314,484,'2024-03-19','2024-03-21'),(858,314,484,'2024-03-19','2024-03-24'),(859,314,485,'2024-03-19','2024-03-20'),(860,314,485,'2024-03-19','2024-03-29'),(861,314,485,'2024-03-19','2024-04-01'),(862,314,485,'2024-03-19','2024-03-29'),(863,315,486,'2024-03-19','2024-03-31'),(864,315,486,'2024-03-19','2024-03-22'),(865,315,486,'2024-03-19','2024-04-01'),(866,315,486,'2024-03-19','2024-03-27'),(867,315,487,'2024-03-19','2024-03-21'),(868,315,487,'2024-03-19','2024-03-26'),(869,315,487,'2024-03-19','2024-03-29'),(870,315,487,'2024-03-19','2024-03-28'),(871,315,488,'2024-03-19','2024-03-21'),(872,315,488,'2024-03-19','2024-03-20'),(873,315,488,'2024-03-19','2024-03-30'),(874,315,488,'2024-03-19','2024-03-25'),(875,315,489,'2024-03-19','2024-04-01'),(876,315,489,'2024-03-19','2024-03-20'),(877,315,489,'2024-03-19','2024-03-27'),(878,315,489,'2024-03-19','2024-03-25'),(879,315,490,'2024-03-19','2024-03-20'),(880,315,490,'2024-03-19','2024-03-24'),(881,315,490,'2024-03-19','2024-03-31'),(882,315,490,'2024-03-19','2024-04-02'),(883,316,491,'2024-03-19','2024-03-30'),(884,316,491,'2024-03-19','2024-03-30'),(885,316,491,'2024-03-19','2024-04-02'),(886,316,491,'2024-03-19','2024-03-30'),(887,316,492,'2024-03-19','2024-03-29'),(888,316,492,'2024-03-19','2024-03-22'),(889,316,492,'2024-03-19','2024-04-02'),(890,316,492,'2024-03-19','2024-03-25'),(891,316,493,'2024-03-19','2024-03-21'),(892,316,493,'2024-03-19','2024-03-29'),(893,316,493,'2024-03-19','2024-04-02'),(894,316,493,'2024-03-19','2024-03-31'),(895,316,494,'2024-03-19','2024-03-30'),(896,316,494,'2024-03-19','2024-03-30'),(897,316,494,'2024-03-19','2024-03-24'),(898,316,494,'2024-03-19','2024-04-02'),(899,316,495,'2024-03-19','2024-03-20'),(900,316,495,'2024-03-19','2024-03-30'),(901,316,495,'2024-03-19','2024-03-21'),(902,316,495,'2024-03-19','2024-04-01');
/*!40000 ALTER TABLE `prescription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socialaccount_socialaccount`
--

DROP TABLE IF EXISTS `socialaccount_socialaccount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `socialaccount_socialaccount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provider` varchar(200) NOT NULL,
  `uid` varchar(191) NOT NULL,
  `last_login` datetime(6) NOT NULL,
  `date_joined` datetime(6) NOT NULL,
  `extra_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`extra_data`)),
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `socialaccount_socialaccount_provider_uid_fc810c6e_uniq` (`provider`,`uid`),
  KEY `socialaccount_socialaccount_user_id_8146e70c_fk_auth_user_id` (`user_id`),
  CONSTRAINT `socialaccount_socialaccount_user_id_8146e70c_fk_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `socialaccount_socialaccount`
--

LOCK TABLES `socialaccount_socialaccount` WRITE;
/*!40000 ALTER TABLE `socialaccount_socialaccount` DISABLE KEYS */;
/*!40000 ALTER TABLE `socialaccount_socialaccount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socialaccount_socialapp`
--

DROP TABLE IF EXISTS `socialaccount_socialapp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `socialaccount_socialapp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provider` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `client_id` varchar(191) NOT NULL,
  `secret` varchar(191) NOT NULL,
  `key` varchar(191) NOT NULL,
  `provider_id` varchar(200) NOT NULL,
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`settings`)),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `socialaccount_socialapp`
--

LOCK TABLES `socialaccount_socialapp` WRITE;
/*!40000 ALTER TABLE `socialaccount_socialapp` DISABLE KEYS */;
/*!40000 ALTER TABLE `socialaccount_socialapp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socialaccount_socialtoken`
--

DROP TABLE IF EXISTS `socialaccount_socialtoken`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `socialaccount_socialtoken` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` longtext NOT NULL,
  `token_secret` longtext NOT NULL,
  `expires_at` datetime(6) DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `app_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `socialaccount_socialtoken_app_id_account_id_fca4e0ac_uniq` (`app_id`,`account_id`),
  KEY `socialaccount_social_account_id_951f210e_fk_socialacc` (`account_id`),
  CONSTRAINT `socialaccount_social_account_id_951f210e_fk_socialacc` FOREIGN KEY (`account_id`) REFERENCES `socialaccount_socialaccount` (`id`),
  CONSTRAINT `socialaccount_social_app_id_636a42d7_fk_socialacc` FOREIGN KEY (`app_id`) REFERENCES `socialaccount_socialapp` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `socialaccount_socialtoken`
--

LOCK TABLES `socialaccount_socialtoken` WRITE;
/*!40000 ALTER TABLE `socialaccount_socialtoken` DISABLE KEYS */;
/*!40000 ALTER TABLE `socialaccount_socialtoken` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `speciality`
--

DROP TABLE IF EXISTS `speciality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `speciality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=406 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `speciality`
--

LOCK TABLES `speciality` WRITE;
/*!40000 ALTER TABLE `speciality` DISABLE KEYS */;
INSERT INTO `speciality` VALUES (391,'Biologie','Doloremque et temporibus vitae aut illum odio praesentium. Iure nihil illo et nobis. Dolor ut ut minus facere non autem occaecati.\n\nNemo et qui ut voluptas illo suscipit. Qui quisquam id cum corporis. Explicabo explicabo quo vel tempora quam ducimus. Voluptatem amet autem perferendis aliquid.\n\nTempora alias voluptatem et dignissimos tempore. Esse sit dolorem culpa sit. Similique animi est consequatur illum sed culpa.\n\nEt illo sint minima exercitationem vitae dolores. Minima ad tempore laborum libero vel dolores consequatur. Distinctio tenetur ducimus nesciunt nihil est quam.\n\nQui et qui doloremque. Explicabo veniam ipsum harum aut.'),(392,'Cardiologie et Maladies Vasculaires','Quae porro deserunt quia amet omnis. Veniam aperiam cumque ea est sit. Similique ducimus iste sed dolor enim maxime et. Sunt tempore dolor velit doloribus qui est quaerat.\n\nDicta ratione omnis dolor similique voluptates aspernatur voluptate. Pariatur eius ut quod. Et maxime et consequuntur consequatur aut harum.\n\nVelit repudiandae esse fuga ex inventore dolorem. Consequatur sit eum sit doloribus nulla alias repellat. Nobis nemo at commodi cupiditate quis voluptatibus consequuntur. Delectus facere impedit fuga quaerat.\n\nMaiores veniam excepturi non quos impedit dolorem earum sed. Voluptas sapiente et saepe est. Temporibus temporibus et aut cum deserunt aperiam culpa. Quam dicta at atque quo occaecati natus a alias.\n\nNon dignissimos molestiae natus dignissimos quasi soluta consequatur eaque. Quis et doloribus quia ipsam eveniet. Quis mollitia molestias distinctio dolorem aspernatur voluptatum.'),(393,'Chirurgie Dentaire','Ducimus iure eum sed pariatur doloribus repellendus atque. Quo incidunt hic provident soluta amet ducimus fugiat. Doloribus sed dolores ea nemo et. Non dolore occaecati est deserunt ut.\n\nRecusandae sit neque et omnis velit modi cum. In dolores dicta eos exercitationem non. Laborum autem odio voluptatem ea. Eveniet assumenda dolorem voluptatum quae nemo et. Error ut dolore ea maxime fuga velit cupiditate.\n\nNostrum iure est ea animi ipsum natus. Fugiat doloribus ut velit eaque quidem. Rerum quis eligendi nisi voluptate ad numquam.\n\nOmnis autem quidem maiores itaque. Aperiam ut natus dolor impedit. Exercitationem saepe fugit et eius molestiae veritatis optio. Soluta eligendi ut rerum quisquam magnam cum nemo.\n\nPerspiciatis sit nostrum dolores eum. Sed accusamus vel debitis quae sed ipsum corrupti. Autem ipsa est quia officiis voluptas.'),(394,'Chirurgie Ophtalmologique','Non aliquam fugit vero fugit quia eligendi. Ipsa qui repudiandae atque atque aut sed ea. Ut ipsum accusamus quis a in facilis. Officiis accusamus esse ea reiciendis sit tempore.\n\nDolores dolor omnis quam est ullam. Ullam itaque alias fugit. Placeat excepturi aut velit. Nam vitae voluptatum ea est.\n\nDolorem distinctio quidem accusantium delectus. Repellat veritatis totam nostrum officia similique. Consequatur mollitia ex iure qui possimus. Eligendi accusamus est sunt sit quis.\n\nQuae maiores culpa eveniet dolor sit qui praesentium. Exercitationem saepe sit autem provident qui. Dolores et fuga odio harum ipsa et ab.\n\nCorporis pariatur qui dicta magni expedita eum velit fugit. Et modi autem quasi corporis. Autem possimus rerum quia natus. Quo maiores et vel aut et.'),(395,'Chirurgie ORL','Qui omnis odit tenetur. Aliquid amet molestiae quae velit qui at. Deleniti rerum ex quisquam ut omnis. Similique sint maxime quo. Repellendus molestiae omnis in rem saepe.\n\nTotam ipsum quia est eveniet voluptatem. Ea ut eius saepe ex. Quis dolor sapiente eaque nihil iste esse.\n\nEt debitis soluta minima ut. Est nobis aut et. Quod maiores iusto consequuntur quia. Sunt magni aperiam et animi earum dignissimos inventore.\n\nNon impedit molestias cum voluptatum dolorem at nam. Beatae qui laudantium sapiente at et.\n\nVelit sapiente laboriosam optio et nihil itaque itaque. Nulla ea perspiciatis provident iste aut voluptatem enim.'),(396,'Chirurgie Orthopédique','Atque ea ex quo eum dicta. Quod alias id illo consequatur doloremque perferendis dolorem voluptatem. Est nihil debitis tenetur accusantium. Sapiente deleniti sit molestias minus hic.\n\nExercitationem quo doloremque porro excepturi aut qui. Cum asperiores deserunt error in voluptatem. Sit est voluptatibus expedita quo excepturi distinctio exercitationem.\n\nEst ipsam amet doloremque sint illum. Esse quibusdam qui soluta vero voluptatem earum. Eum rerum aliquid nihil laudantium quod rerum perspiciatis. Nisi repellendus quia aliquid. Laudantium omnis aut iste.\n\nConsequatur soluta cumque repellat ut qui voluptatem. Aut perspiciatis eveniet ut fugiat veniam voluptas. Nostrum ullam sapiente sit ad possimus perferendis id. Voluptatum dignissimos minus autem fuga.\n\nEnim sint facilis vero iusto quod qui. Sit mollitia eos aspernatur et. Odit autem aliquid est vitae non.'),(397,'Chirurgie Pédiatrique','Voluptatum quis dolorem doloribus voluptas ipsa laborum. Laborum exercitationem sed distinctio totam et iste. Exercitationem voluptatum quia rerum esse voluptatem blanditiis ducimus.\n\nTotam commodi placeat vel enim praesentium atque velit. Ipsa est recusandae quia nobis commodi. Deleniti laboriosam cumque sunt veritatis est tempore.\n\nSimilique earum natus eos aut. Dolores perspiciatis distinctio iste suscipit nostrum. Et dolore incidunt assumenda provident consectetur dolores. Quis ab neque ullam maiores optio tempore maxime.\n\nSunt impedit nemo laudantium molestiae omnis dolor voluptatem. Ut quidem non rerum consectetur quis tenetur. Qui omnis dolor aut modi odio veritatis.\n\nId aut dolore perspiciatis illo. Totam pariatur molestiae quibusdam est reprehenderit voluptatem corporis est. Distinctio sunt occaecati itaque explicabo rerum nulla.'),(398,'Chirurgie Vasculaire','Eveniet est et autem eaque tenetur libero expedita. Et dolor maxime ut. Enim eum vel sunt in. Omnis sint ut et enim accusamus impedit.\n\nPariatur et delectus deserunt cum. Fugit perferendis dolorum nam ut. Nemo occaecati consectetur necessitatibus. Quidem aut impedit corrupti quidem et. Deleniti suscipit non sint laudantium quam ut.\n\nVoluptates ipsam tenetur fugit quis. Vero eos voluptatem itaque ut. Placeat laboriosam dicta ut.\n\nSuscipit rem ullam sapiente voluptatem et. Labore occaecati est nobis tempora. Tenetur praesentium veniam deserunt quidem dolores totam. Nemo adipisci in culpa alias totam sed cum.\n\nPerspiciatis ab illo qui accusamus et. Dolor tenetur qui qui sit numquam et. Magnam odit qui ullam quo sequi placeat occaecati.'),(399,'Gastro-entérologie et proctologie','Illum nihil molestiae ut voluptas. Repudiandae ipsam dolorum repellat. Ut voluptate quia ex consequatur sit fugiat rerum. Distinctio exercitationem debitis reiciendis libero adipisci consequuntur maxime.\n\nSoluta dicta numquam error provident qui fugit. Illum harum et sequi minima cupiditate aliquid voluptas est. Qui est doloremque id aliquam voluptates quaerat magni. Nisi consequatur voluptas incidunt dolor fugit consequatur eos sit.\n\nVeritatis architecto tempora porro et nobis. Est fuga eaque non recusandae et itaque est. Itaque aliquam aliquid reprehenderit non aliquid. Enim maiores dolores blanditiis unde id qui repellat.\n\nOmnis officiis neque suscipit aut neque rerum qui. Ea aut laudantium quisquam ipsa laborum ipsa dignissimos qui. Totam deleniti molestiae atque. Eaque omnis molestiae consequuntur.\n\nTempora sed quae magnam. Facere velit quia officiis autem accusamus odio. Quia voluptas autem officia quod nostrum qui. Amet est laborum nobis laborum facere fugit animi. Consectetur perspiciatis laborum et velit.'),(400,'Institut du pied','Ullam explicabo nulla dicta laudantium velit magni. Aut ratione ipsum odio sint odio odit unde ut. Ex voluptas autem fuga fugit nam. Eveniet nihil et dolore quidem hic laborum non libero.\n\nMollitia blanditiis esse ut quo enim ab. Quia sit corporis quo aut omnis.\n\nEt provident eligendi molestiae quod modi sunt. Sit rem eum maxime sint maiores molestias. Veniam quod magni quia saepe qui aperiam.\n\nDolor consequatur doloribus rerum animi id provident. Numquam qui reprehenderit placeat neque libero omnis. Veritatis minus dolores mollitia placeat dolore est numquam. Et sint voluptatem repellendus error qui non pariatur.\n\nMolestiae earum odit sint nam reprehenderit asperiores iure quasi. Culpa sint fugit pariatur sit sit sed quidem optio. Minima quis deleniti voluptatem in.'),(401,'Médecine et Gérontologie','Velit architecto dolores quis omnis minus. Ut molestiae et rerum quas. Et aspernatur neque eum est. Sed iste est tenetur.\n\nImpedit cupiditate voluptatum est pariatur et ea quibusdam. Quidem voluptatem et voluptates vitae. Quia qui ut magnam.\n\nAut quasi necessitatibus quibusdam nemo. Id est aut ut magni sed nulla. Omnis eaque et sit sit et quia. Voluptatem qui earum eaque minima.\n\nDebitis occaecati et repellendus reiciendis hic. Nobis debitis velit animi reprehenderit hic. Eum molestiae voluptatem cumque quis soluta animi voluptatem.\n\nIn cum saepe id ex. Impedit non iusto eum possimus quaerat laudantium iure. Et eum fuga repellat quo. Quam quasi quas ut neque ex culpa. Quidem rerum fugiat itaque nostrum iure libero.'),(402,'Orthopédie','Qui qui ipsum aliquid. Soluta error sequi ducimus. Qui atque ut ut quae iste. Et illo velit magnam sit praesentium.\n\nNon laborum deserunt vitae sint voluptatem. Ut voluptate minus dolores amet perferendis.\n\nImpedit rem aut alias ducimus ducimus reprehenderit velit. Suscipit consequatur aut optio totam a consequatur sit. Quos itaque sunt eum non. Cupiditate perferendis aperiam rerum quas.\n\nNecessitatibus qui ducimus doloribus qui dolorem excepturi. Sit amet dignissimos similique neque aliquam error quisquam. Ad deleniti quae officiis ratione ullam consectetur occaecati optio.\n\nAut optio dolores et quia incidunt est. Id nobis id sequi facilis magnam molestiae. Quia cumque est quia quia.'),(403,'Pneumologie','Doloribus eum amet et tempore in at magnam. Unde est consectetur aut et quod. Accusantium doloribus similique magni non. Qui est modi eum accusamus quo id eum. Quidem aliquam impedit tempora cum consectetur et et.\n\nVoluptatem dignissimos sed dolore soluta. Harum recusandae doloribus quidem error ea facilis aspernatur autem. Est aut similique itaque eveniet nemo aut. Et quis et officiis dolores dolores.\n\nMinus quia corrupti est fugiat illum rerum. Inventore id earum et iure delectus pariatur. Sapiente ea voluptatem ipsam aperiam. Voluptatum aut aliquid aliquam quibusdam inventore quia eum eum. Eaque sunt rem autem dolorem maiores ea id.\n\nNatus et quis architecto sequi sed. Deleniti exercitationem voluptas perspiciatis ab non. Non ipsam qui eius laborum.\n\nVoluptates vitae expedita voluptatibus aut perferendis eum. Perferendis voluptate qui et qui blanditiis vel dicta ut. Sit eum corrupti sit.'),(404,'Radiologie','Qui tempora sit sint error. Vero quam ullam aut qui dolor et sunt. Est ad est eos sed ex neque porro. Assumenda nihil necessitatibus est quibusdam. Voluptates et pariatur laborum.\n\nVeritatis sunt enim unde beatae qui consequatur dolores omnis. Ratione perferendis maxime magnam sequi distinctio a qui voluptatem. Atque dolorem nobis et perferendis. Maxime distinctio hic deleniti quas itaque perspiciatis eaque in.\n\nDolorum praesentium quo cum et suscipit numquam non. Molestiae rerum nihil atque minus quia accusantium nesciunt. Et iusto ipsam magnam modi est.\n\nVoluptas suscipit facilis voluptas culpa ex suscipit repellendus. Nostrum enim ratione quae rem totam sit. In suscipit ut quod dolor doloremque ea aut dolores.\n\nReiciendis inventore provident sunt eius molestiae. Corrupti libero quae aspernatur est nostrum ut incidunt. Iste ut quod autem quia. Qui omnis ipsum illo aut rerum error cum ex.'),(405,'Urgences Adulte et Enfant','Necessitatibus molestias maxime quis ex pariatur. Itaque voluptatem veritatis alias omnis eum. Repellendus assumenda autem neque labore voluptatibus. Quas velit deleniti quia fugiat a ut.\n\nHic eos culpa aut adipisci quia. Nostrum quidem aspernatur rerum libero vel et voluptatem. Impedit placeat ipsam illo est officia eligendi non quaerat.\n\nDoloremque deleniti consequuntur dolorum iste. Numquam voluptate ad repellendus voluptas omnis. Est quod praesentium veniam distinctio et aut. Doloremque rerum expedita et et laborum beatae molestiae. Dolores quisquam provident temporibus enim.\n\nNesciunt delectus sit dicta accusamus. Soluta quibusdam quia provident. At laborum consectetur itaque et quis sequi quae a.\n\nQuas occaecati quidem natus aut sequi enim. Deserunt aut temporibus alias dolores id. Aliquam qui nisi ab.');
/*!40000 ALTER TABLE `speciality` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stay`
--

DROP TABLE IF EXISTS `stay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `speciality_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `medecin_id` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `validate` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5E09839C3B5A08D7` (`speciality_id`),
  KEY `IDX_5E09839C6B899279` (`patient_id`),
  KEY `IDX_5E09839C4F31A84` (`medecin_id`),
  CONSTRAINT `FK_5E09839C3B5A08D7` FOREIGN KEY (`speciality_id`) REFERENCES `speciality` (`id`),
  CONSTRAINT `FK_5E09839C4F31A84` FOREIGN KEY (`medecin_id`) REFERENCES `medecin` (`id`),
  CONSTRAINT `FK_5E09839C6B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1981 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stay`
--

LOCK TABLES `stay` WRITE;
/*!40000 ALTER TABLE `stay` DISABLE KEYS */;
INSERT INTO `stay` VALUES (1881,395,471,312,'Nulla ut rerum accusamus vel laborum amet officiis.','Vero voluptatem suscipit illo voluptatem id molestias ad aliquid. A et provident beatae blanditiis nam veritatis eaque qui. Repellendus porro voluptatum cupiditate.','2024-06-30','2024-11-05',0),(1882,392,471,313,'Sit voluptatem dolores hic inventore quisquam illo molestias.','Ut consequatur sint nesciunt ea et. Autem deleniti dolorem laudantium quas consequatur quos. Deserunt nisi dolorem fugiat vel. Quia sequi accusantium et ipsa qui sapiente delectus.','2024-07-21','2023-11-11',1),(1883,396,471,306,'Amet in et mollitia soluta iste rerum.','Sint eaque quibusdam est voluptas dolor neque dolorem. Facilis quis hic nihil. Blanditiis facere qui ipsum impedit qui ea ea eos. Non tenetur sapiente rerum velit et sapiente veniam.','2024-06-14','2024-09-04',0),(1884,401,471,313,'Provident vel aut consequatur ut est repellat.','Expedita ipsam eum et. Quae molestiae error cupiditate distinctio sit veritatis qui. Mollitia recusandae voluptas incidunt in atque qui. Mollitia nobis deleniti voluptatem ut corporis delectus.','2024-03-11','2024-03-19',1),(1885,395,472,306,'Dolorem voluptatem mollitia quia et natus ducimus maiores.','Occaecati eius maiores illum pariatur magni. Odio voluptatibus quasi sint in.','2024-11-03','2025-02-15',0),(1886,404,472,311,'Doloribus aut rem voluptatem.','Dolore odio voluptas odit omnis voluptatum. Odit eligendi veniam ad architecto est in beatae. Quasi sed est ipsum quia.','2025-01-09','2024-07-31',0),(1887,398,472,304,'Non molestias itaque iure magnam repellendus facilis corrupti odio.','Mollitia omnis sed iste blanditiis vel et et. Omnis expedita commodi error impedit sed distinctio. Vero illo voluptatem quis error.','2023-03-25','2024-01-24',1),(1888,395,472,308,'Sit quo impedit delectus sint.','Maxime qui et illo ipsa. Sunt voluptate molestiae eaque et sit earum officiis. Possimus dignissimos ut a at quas perspiciatis praesentium excepturi.','2024-03-16','2024-03-19',1),(1889,398,473,306,'Veritatis dolor eos dicta sed sed labore occaecati.','Exercitationem dolores est in veritatis beatae dolor. Labore eaque atque nobis reiciendis porro ratione et exercitationem. Odio nemo nihil corrupti incidunt veritatis nisi consequatur. Cum nihil hic aspernatur itaque rerum magnam consectetur sed.','2024-07-24','2023-09-29',1),(1890,392,473,306,'Voluptatem quidem est itaque magnam in voluptas tempora.','Neque eaque ab consequuntur ipsa cum. Rerum dolores magni corporis provident. Dolorum voluptatem iste quidem molestias. Delectus error est omnis sit hic consequatur.','2025-03-04','2024-09-25',0),(1891,401,473,305,'Aut vel recusandae praesentium.','Nostrum accusantium fugit voluptate voluptatem. Dignissimos aliquid maiores animi quod et aut et. Nihil autem dolor et et quia facilis aut ex.','2024-03-11','2025-03-19',1),(1892,400,473,305,'Consequatur vitae aspernatur eveniet pariatur iusto expedita quas totam.','Quo saepe ullam sint consectetur quis consequatur. Accusamus minus non iste sit. Autem omnis aut rem voluptas dolore aut. Praesentium consequuntur sit deleniti nihil illo earum.','2024-03-10','2024-03-19',1),(1893,404,474,306,'Cupiditate iure architecto ea hic sit.','Non quos reiciendis facilis reiciendis hic. Omnis voluptas placeat labore consequuntur dolores ut dignissimos. Nam consequatur sunt exercitationem blanditiis omnis quasi id eos. Rerum molestias accusantium voluptatem architecto tempore.','2024-09-15','2023-05-26',1),(1894,394,474,310,'Autem aut quam et fugit sed.','Voluptas nam voluptate incidunt rerum perspiciatis. Tempore doloremque iusto ducimus ipsa.','2025-02-26','2025-01-30',0),(1895,398,474,313,'At animi numquam aut maiores incidunt dolorem nihil maiores.','Unde voluptates quia quam facilis cumque assumenda. Voluptatibus voluptatem nemo facilis impedit sint numquam commodi.','2023-09-22','2023-11-06',1),(1896,400,474,308,'Nostrum sint ducimus magni in reiciendis adipisci repudiandae consequatur.','Et quia molestiae et sunt aperiam inventore. Ipsam aut ut suscipit vero veritatis aut sequi sunt. Voluptatem sunt molestiae non quo saepe aperiam eaque labore. Aliquam qui ut laboriosam qui vero reiciendis. Repellendus cum corrupti in.','2024-03-15','2024-03-19',1),(1897,402,475,312,'Placeat consequatur ullam quidem sed officiis aut voluptatibus.','Repellat amet quia totam. Culpa veritatis et quia aliquid velit ab. Asperiores nihil voluptates minus eum. Fuga fugit nulla illo architecto temporibus aut sit.','2024-12-23','2023-08-10',1),(1898,395,475,310,'Ut sapiente et blanditiis perspiciatis nam.','Provident repellat debitis dolores aut. Blanditiis nemo et aut vero quia atque. Maxime nihil nisi architecto iusto rem non blanditiis.','2024-11-09','2023-08-04',1),(1899,392,475,309,'A consequatur recusandae et ipsa.','Officia perspiciatis sunt repudiandae aut. Labore et dolorem dicta et iure autem. Ut qui excepturi tempore esse pariatur perferendis. Veritatis molestias exercitationem a at necessitatibus. Dolor ut corporis et et nostrum saepe est ad.','2024-12-23','2024-01-01',1),(1900,398,475,312,'Sed repellat officia qui.','Ipsam voluptatibus consequatur corporis ea sunt ut. Qui similique quia quaerat dolor laudantium velit. Quia reprehenderit assumenda magnam ipsum rem odio. Eveniet et consequatur modi a voluptates nemo esse.','2024-03-13','2024-03-19',1),(1901,394,476,306,'Eos et debitis laboriosam optio.','Ab amet esse et nobis. Placeat sint omnis nam quaerat. Dolore dicta ipsam omnis est rem. Et et et quia minus qui.','2024-11-22','2023-05-09',1),(1902,397,476,309,'Dolorum minima unde quaerat consequatur deleniti dolorem.','Repellat placeat provident vitae sint quasi voluptatem. Maxime odio et dolorem natus. Sit molestiae totam adipisci iure. Autem iure eveniet perspiciatis delectus est dolorem. Cum culpa vel amet voluptas.','2025-02-01','2025-01-19',0),(1903,394,476,313,'Repellat dolorem itaque in.','Velit consequatur rerum ut est et. Ipsum labore quia doloremque iusto id qui. Totam aut est aperiam omnis temporibus.','2023-10-29','2025-01-12',1),(1904,397,476,312,'Et deserunt consequatur delectus sed.','Ipsa non eaque magni et aut distinctio accusantium debitis. Molestiae dolorum rerum distinctio vitae eligendi quam qui. Est voluptatum eligendi illo quibusdam sunt et.','2024-03-11','2024-03-19',1),(1905,401,477,308,'At omnis sed a voluptatem dolorem unde.','Et possimus est eos vitae fugit accusantium sequi. Et sed praesentium ad aliquid mollitia. Voluptatem totam veritatis ea facere quos. Ut ex qui neque.','2024-12-28','2023-09-12',1),(1906,395,477,304,'Est recusandae eligendi ex est dolore id.','Itaque itaque molestiae dolorem voluptatem ut. Quas soluta sit expedita dolor voluptas sequi. Magni quia quibusdam doloribus magnam magni excepturi voluptatem. Et eos voluptates quaerat tempore sed.','2024-09-23','2023-06-11',1),(1907,405,477,313,'Laborum similique et sed dolores.','Veniam libero hic magni aliquid. Laudantium assumenda ducimus enim neque blanditiis porro nihil. Accusamus aliquam eius a commodi et eveniet nihil. Consequuntur quo qui omnis dolorem.','2024-12-21','2024-06-11',0),(1908,403,477,307,'Aut ratione consequatur ut dolores.','Sint iusto labore et non non porro. Vel neque sunt sed exercitationem nihil exercitationem. Architecto excepturi ex unde tenetur voluptatem. Consectetur dolores voluptas qui et quo.','2024-03-10','2024-03-19',1),(1909,394,478,310,'Impedit ut ducimus vero quo omnis.','Et omnis voluptatibus enim. Sunt id temporibus nihil ullam dolores. Ducimus sunt et et quidem voluptatem occaecati eos reiciendis.','2024-10-30','2024-10-06',0),(1910,405,478,313,'Provident consequatur et aut.','Eius dolorum dolorem eum ut. Rerum sed quo facere earum ut placeat corrupti. Animi facilis sed eos corrupti dolor sit cupiditate adipisci. Quis soluta totam nisi dolores.','2024-07-06','2023-05-16',1),(1911,392,478,311,'Harum quas omnis vero quis.','Nihil eum inventore qui officia delectus. Aut impedit eaque aliquid omnis sequi. Incidunt eos enim nemo consequuntur error exercitationem.','2023-09-15','2023-09-22',1),(1912,398,478,306,'Hic aperiam et libero sint velit ducimus rem.','Eligendi expedita tempore id sint. Reprehenderit at quam voluptatibus veniam aut in. Accusamus eligendi dolorem et accusamus natus id. Nihil molestiae saepe eos nam ipsa fugiat.','2024-03-11','2024-03-19',1),(1913,401,479,309,'Et illo odit impedit molestiae qui modi voluptatem.','Ut aut sequi rem cum voluptatem. Dolor eius atque et et soluta ut. Quis at aut eius reprehenderit est aspernatur accusamus. Sit adipisci vitae ipsam maiores cumque sunt.','2024-10-18','2025-01-28',0),(1914,398,479,309,'Dolorem quia nostrum voluptatem iusto eveniet eos ipsa.','Eos fugiat sunt architecto reiciendis. Iusto quia et consectetur sit officia et. Impedit quaerat ipsam dolores quas facilis et illo. Qui fugiat magni eligendi dicta qui.','2025-03-15','2025-01-19',0),(1915,401,479,306,'Fugiat deleniti enim eius.','Provident doloribus enim ducimus explicabo provident consectetur. Maiores omnis temporibus maxime vel non vel soluta atque. Quia debitis quisquam aut magni aspernatur harum. Dolores ut natus sapiente ex iusto eum perspiciatis voluptatibus.','2025-01-02','2024-12-28',0),(1916,392,479,309,'Doloremque et eius voluptatem nisi provident fugiat qui.','Asperiores aperiam voluptas esse consectetur optio. Et neque aliquid et est incidunt. Quae nobis nulla magnam voluptatem eos esse. Minima nisi eligendi tempora magnam.','2024-03-13','2024-03-19',1),(1917,399,480,313,'Nesciunt dolore at impedit deleniti nobis eos et sit.','Modi in fugiat commodi aut qui. Nulla et et molestiae nulla consectetur ut ut at. Voluptates laudantium odio reprehenderit nemo eaque. Eveniet aut est est nemo dolorem voluptatem.','2025-02-11','2024-10-16',0),(1918,404,480,309,'Rerum ratione aliquam ea.','Quo ullam earum quibusdam ut. Harum nemo quod eum dolores tenetur et. Dolores numquam amet sapiente et.','2024-10-11','2023-04-25',1),(1919,397,480,309,'Magni maiores eaque recusandae odit.','Magni eum ullam voluptatem impedit ut sit eveniet. Dolor eligendi deserunt aperiam fugit. Ipsum nobis voluptatum qui at accusamus. Perferendis recusandae aliquam labore nihil magni.','2023-04-30','2024-07-05',1),(1920,391,480,313,'Eius unde nemo facilis sapiente.','Dolor sapiente velit ut iusto et. Nesciunt et voluptas quis est tempora et similique eum. Laborum sequi quod voluptatem eaque nisi. Occaecati fugiat non sunt quo sint sequi quam.','2024-03-13','2024-03-19',1),(1921,391,481,314,'Occaecati est et iusto culpa facere ducimus.','Aut praesentium commodi aut sint. Sit quis nihil autem saepe beatae omnis. Dolore sunt asperiores vitae voluptates similique et voluptatum. Et et at culpa omnis quos iusto. Et voluptas ut quaerat voluptatibus.','2024-03-19','2024-03-26',1),(1922,395,481,314,'Reprehenderit dolorem deleniti molestiae recusandae occaecati dolore velit.','Nemo in est a sit qui aut modi. Eos facere ducimus aut beatae officiis odio. Fugit vero qui consequatur eaque excepturi reprehenderit.','2023-03-19','2022-04-19',0),(1923,392,481,314,'Odio esse illum dolores error modi.','Est neque iste rerum ut cumque et autem et. Et rerum sint enim dolor totam at. Quisquam quia mollitia iste molestias.','2024-03-05','2024-02-27',1),(1924,395,481,314,'Non quaerat maxime veniam architecto ut.','Adipisci ipsa magnam quidem. Eos fugit aperiam voluptatem omnis placeat praesentium. Eaque repudiandae aut totam.','2024-04-19','2024-05-31',1),(1925,391,482,314,'Consequatur necessitatibus aut aut sit.','Et minus suscipit ea. Harum est impedit optio ducimus asperiores hic. Voluptates autem non saepe laudantium id. Quaerat dolor quia exercitationem a.','2024-03-19','2024-03-26',1),(1926,396,482,314,'Non impedit repudiandae est sit voluptatibus.','Et aut omnis nostrum quos voluptate a quia. Consectetur similique possimus error esse aspernatur.','2023-03-19','2022-04-19',0),(1927,393,482,314,'Praesentium aliquid quia est sapiente facilis vel nihil.','Dolor accusamus quisquam magni. Quia qui et error omnis qui ipsum. Architecto corporis ipsa ab inventore.','2024-03-05','2024-02-27',1),(1928,394,482,314,'Animi distinctio officia facilis blanditiis delectus et fugit.','Illum totam cumque voluptas placeat fugiat a aliquid. In qui facere omnis reiciendis iste dolores recusandae. Optio ad nostrum dicta.','2024-04-19','2024-05-31',1),(1929,394,483,314,'Magnam porro in eligendi aliquid eos id vel.','Quod sed atque non. Necessitatibus aut dicta sit aliquid. Sed sunt ut qui minus neque consectetur.','2024-03-19','2024-03-26',1),(1930,394,483,314,'Rem et voluptatem consequuntur voluptas.','Voluptate a dicta ad ratione velit saepe repellendus. Est et sed saepe rerum. Ipsum molestiae rerum nam architecto dicta sequi veritatis inventore. Tempore dolorum praesentium impedit impedit recusandae ullam esse. Tenetur cumque quaerat fuga dolore dolorum temporibus.','2023-03-19','2022-04-19',0),(1931,395,483,314,'Rerum quia rem dolor qui minus eveniet.','Et illum accusantium magnam ut voluptatibus est. Laboriosam non fugiat laudantium est quae. Tempora et sit voluptatibus minima necessitatibus esse. Et qui facilis autem recusandae ut architecto et.','2024-03-05','2024-02-27',1),(1932,393,483,314,'Harum est tempora illo perferendis qui.','Provident eius dolores distinctio corporis veritatis hic commodi. Sit alias veritatis odit qui ut non numquam.','2024-04-19','2024-05-31',1),(1933,393,484,314,'Omnis omnis ut officiis et.','Ut ducimus in eligendi. Ipsum exercitationem illo rerum fuga sit ut voluptatum. Aut sit itaque recusandae omnis est non. Mollitia omnis modi est dolor enim dolore quia.','2024-03-19','2024-03-26',1),(1934,395,484,314,'Aspernatur ut tempora et assumenda unde aliquid voluptatem.','Ut quia totam omnis nemo. Similique ut architecto dolorem aut dolores. Beatae tenetur similique ea consectetur eum dolorem dolor. Veniam sapiente dolorem repellat voluptas est.','2023-03-19','2022-04-19',0),(1935,394,484,314,'Ipsum perspiciatis eos quibusdam dignissimos autem dolorem.','Rerum porro enim fugiat aliquam. Assumenda temporibus eaque cupiditate sequi. Sint nemo dolores dignissimos omnis voluptatum. Quasi enim nam quidem aut numquam voluptas quia. Aliquid ipsum eos ratione similique error expedita.','2024-03-05','2024-02-27',1),(1936,392,484,314,'Adipisci velit assumenda impedit culpa illum quia et.','Aut aspernatur ad aliquid quaerat necessitatibus rerum illum dolores. Magni recusandae veritatis reprehenderit eum eum autem quia. Aut tempore voluptates quis iste. Amet magnam repellat doloribus facere culpa.','2024-04-19','2024-05-31',1),(1937,391,485,314,'Sit quis veniam velit nobis natus.','Minus nihil suscipit reprehenderit sed expedita quod. Amet non distinctio in ipsum. Tenetur ut ratione non enim quisquam occaecati.','2024-03-19','2024-03-26',1),(1938,393,485,314,'Quia ut quo facere iusto vel iusto exercitationem officia.','Voluptates asperiores dignissimos assumenda. Doloribus possimus consectetur omnis quidem a quaerat. Deserunt ducimus ut quis assumenda reiciendis delectus nobis rerum. Nobis et dolores assumenda autem est facilis eligendi sapiente.','2023-03-19','2022-04-19',0),(1939,396,485,314,'Ea nobis officiis aut voluptates ex occaecati possimus est.','Iure ratione repudiandae aut laudantium reiciendis. Omnis doloremque quam modi aut. Assumenda cupiditate id et et maxime. Et aut sunt maiores quos et earum vitae.','2024-03-05','2024-02-27',1),(1940,396,485,314,'Aut ipsa quis similique voluptatem.','Et architecto sapiente laudantium aliquam autem. Magni et eum quos hic reiciendis.','2024-04-19','2024-05-31',1),(1941,391,486,315,'Sed nisi aut optio aut doloribus id dolor.','Illum incidunt cupiditate autem culpa ab perferendis. Officia asperiores unde excepturi nihil at exercitationem. Quo tempora soluta consequatur magni quae sit.','2024-03-17','2024-03-24',1),(1942,394,486,315,'Cupiditate ut illum est sit minus.','Eum enim non est incidunt. Rerum ut eum sunt modi. Qui eum labore amet.','2023-03-19','2022-04-19',0),(1943,396,486,315,'Delectus eos quia eaque non enim magni.','Velit corrupti esse atque. Et dolor perferendis officia facere unde. Explicabo voluptatem sit aliquam magnam soluta.','2024-03-12','2024-03-19',1),(1944,392,486,315,'Quis est quas ut suscipit nobis atque enim.','Non quam odit facere voluptatibus. Corrupti est distinctio omnis. Voluptatibus accusamus nemo officia voluptatum quia quo consequuntur repellendus. Necessitatibus ut id ut asperiores dolore.','2024-04-19','2024-05-31',1),(1945,395,487,315,'Tempora consequatur eum enim accusantium error.','Culpa quo velit rerum reiciendis animi. Cumque minus aut voluptate ut at veritatis. Eum voluptatem nesciunt optio voluptatem sed animi officia.','2024-03-17','2024-03-24',1),(1946,394,487,315,'Adipisci et in aut.','Tempora omnis dolorem libero qui. Repellendus ex omnis in maxime. Non occaecati hic voluptates consequatur vel rem.','2023-03-19','2022-04-19',0),(1947,392,487,315,'Facilis ut distinctio aut ea tenetur aut.','Pariatur et nesciunt consequuntur molestias sunt. Soluta nostrum fugiat quia. Vel officia omnis voluptate adipisci ea modi.','2024-03-12','2024-03-19',1),(1948,396,487,315,'Illum explicabo quia et.','Repellat distinctio repellat et at magni qui expedita. Eligendi molestias dicta accusantium et molestias qui aut. Optio dignissimos assumenda doloremque voluptate sunt.','2024-04-19','2024-05-31',1),(1949,392,488,315,'Est quam labore magni accusantium sed est sint.','Doloremque ullam magni sunt ut. Qui dolor consequatur voluptatibus nisi id necessitatibus fugiat. Commodi laudantium culpa et consequatur. Aut et modi aut.','2024-03-17','2024-03-24',1),(1950,396,488,315,'Repellat aut molestiae assumenda illum dicta.','Dicta similique qui rerum libero. Qui quae dicta debitis possimus sed quis provident culpa. Aperiam inventore commodi autem.','2023-03-19','2022-04-19',0),(1951,394,488,315,'Mollitia temporibus commodi dolores animi est corporis earum.','Et ex aspernatur hic consequatur reiciendis est nam. Assumenda et ut amet non. Et necessitatibus dolorem nobis tenetur. Saepe cumque eaque molestias ullam id vel vel.','2024-03-12','2024-03-19',1),(1952,393,488,315,'Accusamus itaque voluptatum quo suscipit sit eaque saepe.','Quia eveniet numquam qui odio qui. Rem qui assumenda et et sint doloribus.','2024-04-19','2024-05-31',1),(1953,396,489,315,'Reiciendis aut et et.','Esse laudantium natus ut occaecati voluptate maxime. Autem rerum adipisci nemo dolorem et. Pariatur velit ut mollitia consequatur ex.','2024-03-17','2024-03-24',1),(1954,393,489,315,'Nostrum quas facere nesciunt quidem deleniti hic.','Amet officia adipisci iste autem quas voluptatibus minus quaerat. Et sint nihil dignissimos non neque. Necessitatibus iure aliquam quisquam itaque. Error et eveniet eum omnis.','2023-03-19','2022-04-19',0),(1955,391,489,315,'Sed vel aliquid velit doloribus omnis ut.','Provident doloribus rerum modi et nulla. Odio quae eaque officia non cupiditate molestiae eos quibusdam. Iure porro delectus veritatis sunt. Non tempore dolores qui sit velit repellendus quibusdam voluptas.','2024-03-12','2024-03-19',1),(1956,395,489,315,'Quae vero quidem qui nisi tempore laudantium.','Recusandae molestias ipsum est deserunt. Sapiente consequatur asperiores culpa eum corrupti blanditiis officiis.','2024-04-19','2024-05-31',1),(1957,391,490,315,'Dolores consequatur neque a id.','Culpa aut quo reiciendis. Consequatur illo ullam sit vel unde et. Quia similique quo fugit et.','2024-03-17','2024-03-24',1),(1958,393,490,315,'Optio nesciunt eligendi sed autem ea possimus.','Qui nostrum hic et iusto. Sunt laudantium similique quos nobis voluptatum et. Minus ad libero provident sint qui et asperiores.','2023-03-19','2022-04-19',0),(1959,394,490,315,'Quo hic eveniet quia facere eveniet ab.','Distinctio doloribus ut omnis eos sit. Odio repellat laborum dicta consequatur. Sunt vitae provident in. Quis voluptates odio rerum alias laborum.','2024-03-12','2024-03-19',1),(1960,396,490,315,'Est dolorem id quia adipisci quia in.','Consequuntur consectetur ea ad illum dolore aut tempore. Molestias velit eligendi et odit temporibus velit nesciunt dolorem. Vero ea facere unde. Porro ut voluptatem quo veritatis dolores ipsam.','2024-04-19','2024-05-31',1),(1961,395,491,316,'Repellendus quo ullam minima.','Repellat molestias exercitationem aut mollitia quae vel et. Ut architecto nesciunt aliquam vero voluptates a. Porro soluta doloribus quaerat est voluptatum impedit vitae aut.','2024-03-19','2024-03-26',1),(1962,396,491,316,'Odio consequatur aut inventore nemo.','Aperiam enim nihil dolores sunt. Mollitia est saepe ab occaecati et porro sit. Assumenda non voluptas ratione ut eligendi. Quidem et nam reprehenderit quo omnis eaque et.','2023-03-19','2022-04-19',0),(1963,395,491,316,'Est quia ad dicta aspernatur in repellat aspernatur.','Ut provident dolores blanditiis ex. Et temporibus rerum magni et et quia iusto. Fugiat et eos pariatur rerum nesciunt ea.','2024-03-05','2024-02-27',1),(1964,396,491,316,'Nihil repellendus voluptatem doloremque ut quam.','Harum aut ullam voluptatum est et accusamus. Ea excepturi dolor quaerat perferendis. Eum consectetur soluta at expedita facere.','2024-04-19','2024-05-31',1),(1965,392,492,316,'Illo dolorem repellendus consequatur repellat sit.','Iste et aliquam ut omnis et eveniet. Nemo quis commodi sunt quibusdam. Quis incidunt voluptatem molestiae blanditiis tenetur ea.','2024-03-19','2024-03-26',1),(1966,394,492,316,'Et numquam nemo sint placeat debitis consequatur in.','Similique doloremque accusamus ex asperiores. Tempore porro nam ea voluptates voluptas sed. Veniam inventore ipsa nostrum voluptas dolorem in. Quasi doloribus alias molestias aliquid vero. Maiores et qui aut voluptas maiores magnam saepe.','2023-03-19','2022-04-19',0),(1967,395,492,316,'Sed quos nobis id quo unde inventore voluptas.','Ut aut quaerat cum consequatur laudantium. Nostrum fugit quaerat et tempora iste voluptate iusto tenetur. Et eos labore totam explicabo rerum.','2024-03-05','2024-02-27',1),(1968,395,492,316,'Officia ea quo accusantium delectus et.','Nam laboriosam quibusdam sapiente sit aut incidunt qui. Id magnam impedit voluptatem qui quia.','2024-04-19','2024-05-31',1),(1969,394,493,316,'Neque expedita dolore cumque est illo et.','Consequatur fugiat qui sunt omnis ea debitis necessitatibus. Numquam qui saepe voluptatem ducimus distinctio omnis sunt. Autem qui debitis autem voluptatem quia enim eum ad. Est inventore nemo earum ea delectus nihil.','2024-03-19','2024-03-26',1),(1970,394,493,316,'Laboriosam nulla officia natus saepe.','Nisi et dolores odio qui et quis quia. Unde tenetur ex aspernatur aperiam ut eum animi explicabo. Iusto perferendis ut placeat et repellendus ut.','2023-03-19','2022-04-19',0),(1971,391,493,316,'Cupiditate et nostrum ipsa autem qui voluptatem deserunt nulla.','Velit nesciunt vitae voluptas voluptates eum a nihil. Ratione atque dolorum iure eaque dicta et. Vel reiciendis ut velit libero.','2024-03-05','2024-02-27',1),(1972,393,493,316,'Voluptatem minus voluptatem ut et dolorum alias.','Eos dolor laborum impedit autem. Quis eum omnis neque error. Est impedit aut saepe fugiat. Dolores aperiam at autem quia magnam.','2024-04-19','2024-05-31',1),(1973,392,494,316,'Officia odio magnam fuga numquam ea debitis iste.','Omnis qui fugit nostrum. Totam quod doloremque ea et iusto eum. Id explicabo blanditiis et nobis minima sit molestiae.','2024-03-19','2024-03-26',1),(1974,392,494,316,'Sed quis ad quam iure nihil iure.','Veniam nihil reiciendis magnam ex. Mollitia aperiam repellendus voluptate aut adipisci nostrum et. Aut ex incidunt facilis doloremque dolorem eligendi.','2023-03-19','2022-04-19',0),(1975,393,494,316,'Odio reiciendis eos accusantium molestiae ut incidunt magnam.','Quam a quia tempore nemo quo quasi. Sunt eius nobis consequatur sed natus accusamus.','2024-03-05','2024-02-27',1),(1976,395,494,316,'Dolores omnis voluptas ipsa qui aut eligendi veniam.','Maxime numquam sint et pariatur itaque praesentium provident. Aut cumque ad iure sint pariatur. Ducimus laborum distinctio veritatis corrupti vitae dolorem et.','2024-04-19','2024-05-31',1),(1977,396,495,316,'Voluptatem inventore et rerum omnis vitae eum doloremque.','Deserunt ullam autem occaecati hic. Sed voluptatem nisi maiores eligendi expedita sit. Repellat voluptas odio molestiae consequatur repellendus nihil. Iusto est totam et omnis odio.','2024-03-19','2024-03-26',1),(1978,393,495,316,'Corrupti minus voluptate dolore inventore aut quisquam id.','Consequatur impedit facilis nisi maxime quidem. Non sint mollitia aut minima doloribus. Enim exercitationem et ad ullam illum corrupti fuga sint. Facilis numquam porro beatae deserunt.','2023-03-19','2022-04-19',0),(1979,395,495,316,'Ad nihil dolore aut voluptatem.','Recusandae laboriosam doloremque fugiat vero iure itaque nesciunt. Ratione reprehenderit saepe ut atque fugiat expedita aliquam. Veniam quaerat voluptatum odio.','2024-03-05','2024-02-27',1),(1980,394,495,316,'Id natus architecto aut occaecati quibusdam aut et.','Sint quo accusantium voluptatem suscipit at. Aut facilis ab molestiae consequuntur. Aut et aut consequatur velit.','2024-04-19','2024-05-31',1);
/*!40000 ALTER TABLE `stay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=858 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (818,'admin@studi.fr','[\"ROLE_ADMIN\"]','$2y$13$38BgpMsBsGm4zM/emvuC3e/kPJjrj8Om/feIfc65pzkQmBrLwnap2','Admin','Admin'),(819,'staff@studi.fr','[\"ROLE_STAFF\"]','$2y$13$oBsScEahgaIjh6nfn5ZjXeoK1S2Qiv6ZuV6hhZimQ08N95sM8Hmhi','staff','Secretaire'),(820,'alfred.sauvage@jean.com','[\"ROLE_MEDECIN\"]','$2y$13$gzhbJflBT3Yw.aqDinr4Uev7ii0g5tYvTPg79Rmf1Szpp/3Zx.NXS','Agathe','Fabre'),(821,'rodrigues.catherine@weiss.com','[\"ROLE_MEDECIN\"]','$2y$13$8sTxfQiX11v1EVx7qLNnrOsQ/DATOeNQyiJb4ty9RtuQXXcq51pyS','Marie','Gillet'),(822,'renault.simone@boucher.fr','[\"ROLE_MEDECIN\"]','$2y$13$d8B0uKj7qSJS6E0aKZGUu.z8GWh8aLk1GoS3hvKrWcNkfb/Csb6YK','Louise','Marchal'),(823,'patricia37@renaud.net','[\"ROLE_MEDECIN\"]','$2y$13$dl3G.nkvQTdWUMMEjiqcR.Ex9.DOWq7B2mrFeZ9vxX9sd2FId37oa','Gilles','Pons'),(824,'andre78@hotmail.fr','[\"ROLE_MEDECIN\"]','$2y$13$A7/nqZP0djYU/DU7A/.Z5udVroh4r8HqAOXl7x4nsDWZF8QUcFUnG','Dominique','Guichard'),(825,'yleroux@orange.fr','[\"ROLE_MEDECIN\"]','$2y$13$JnjlwfL6e.nNEKpVoqviX.f/1amcjQQLVEvGCC5ElQDciiT.QHRIG','Eugène','Pierre'),(826,'klegrand@live.com','[\"ROLE_MEDECIN\"]','$2y$13$9qfkNi5YiM2sJ7JNf0eKGec.E1h6rmH9dsD0XMPd0fLeOKj0gF.AG','Pierre','Fournier'),(827,'bjacquet@dias.com','[\"ROLE_MEDECIN\"]','$2y$13$vn3/uYgdTun/DuoDQA0rrOtAT/yCvBt3WZ/JPAu6Ntn6qYfJSssMK','Honoré','Cousin'),(828,'eugene.deoliveira@fleury.fr','[\"ROLE_MEDECIN\"]','$2y$13$.9YowA49vcECU0H7gynyheYMmoWchCUnOzDNcalJpwD4Y33EF7q8m','Éric','Meyer'),(829,'josephine45@hotmail.fr','[\"ROLE_MEDECIN\"]','$2y$13$s3iLgfjHFLR3bp7kQTV8wuYjzWD/anuCti6BQ9eTFie2R/4UyWBPO','Luc','Leroux'),(830,'margot.delmas@bourgeois.com','[\"ROLE_USER\"]','$2y$13$.4NnhSpeQEIZ3CL/z618LOZr7vkV5Tt9SBvCEXjL1265cfgWmFZCu','Lucas','Raynaud'),(831,'hklein@monnier.org','[\"ROLE_USER\"]','$2y$13$6PiaKFFS7u4Vb6TAlciONebSMYCNeoFjf3i/4bQWTKTxFW2/oGuZW','Adrienne','Lebreton'),(832,'theophile.bertrand@hotmail.fr','[\"ROLE_USER\"]','$2y$13$HfmCrWma/jmV193SebQOruLMu0nj3/vuxtJR/lG31L3oQGc6pcaSS','Bertrand','Perrot'),(833,'zallain@live.com','[\"ROLE_USER\"]','$2y$13$zY.F7puC1VRok745jPklD.z7mMdpaSUbQ8mxYmPIYQgxzFwF.zEz6','Xavier','Allard'),(834,'lamy.laurence@orange.fr','[\"ROLE_USER\"]','$2y$13$eFMb2RHsksmYb5LSm5.RAeiv3KC0THiKz8QokAWbOi9KkKS8ajTvO','Pierre','Girard'),(835,'mjacquot@yahoo.fr','[\"ROLE_USER\"]','$2y$13$Qr01JleR0jMdFdQYYbHL2uqbjqxhMmIfXMf/NA7vxElRfRepg/2Lq','Marc','Robert'),(836,'achauvin@langlois.fr','[\"ROLE_USER\"]','$2y$13$fVxvHGwVwZJHikG/FVmRrO3hk.cLR5p.SZXZ0LExTjdp7wk/NtdWi','Benoît','Marty'),(837,'vimbert@wanadoo.fr','[\"ROLE_USER\"]','$2y$13$Nwx/caOu/QiV342hHACvRe/SA4rljI.Em8hlYop.lH/mkFL6sZOoC','Françoise','Chartier'),(838,'sfouquet@desousa.fr','[\"ROLE_USER\"]','$2y$13$b/8sx1WFMcGAqsNS4vtj1ehsIRP1p.7lQZ.FX0xK0Z0LMWNaPteWK','Vincent','Roche'),(839,'desousa.helene@free.fr','[\"ROLE_USER\"]','$2y$13$U4sHdk.fP/1lkYjuDoG9wu2Cu9jt/2Tq4hAJGGHkfazc6g9f7zWia','Emmanuel','Ramos'),(840,'medecin@studi.fr','[\"ROLE_MEDECIN\"]','$2y$13$IQjxwEJApfAoXihHQO6Lzeg7UgyXxpA1fWAKYMPJwZTp7/LONL3I6','Martin','Barbier'),(841,'john.do@test.fr','[\"ROLE_USER\"]','$2y$13$OJBIold2q90pghKDv1KPwOgDrDnc4RDnQRZUSkrxDIylXA958IqbK','Colette','Delorme'),(842,'laurent.olivie@maillard.fr','[\"ROLE_USER\"]','$2y$13$01rOyk5gIOtvIQdcr4opK.xgcy3pIdk4/IR/NE1h9zzr3n15.e2P6','Grégoire','Fontaine'),(843,'stephane.leger@guillon.com','[\"ROLE_USER\"]','$2y$13$IZVPpTNh8CC5cxN4zxVC1OBA728qCe14HdlANNphv9DyNTtwYJ2tS','Zacharie','Mathieu'),(844,'leon.denis@hoareau.com','[\"ROLE_USER\"]','$2y$13$zDz/OJErkCEk3So.GDJ2tu8ZZ2ob9koPGfK3f2pW7Eb3DEg1q.lJW','Dorothée','Schneider'),(845,'oboulay@hotmail.fr','[\"ROLE_USER\"]','$2y$13$nI.1n9c/WKw70PSygevkfeLG.0Am6r9qn9Zg4jFTFg73BC4JTaVGu','Lucie','Guyon'),(846,'1medecin@studi.fr','[\"ROLE_MEDECIN\"]','$2y$13$n0I8R3nGqr.tlRcGgxIik.3Jbrw9KsVKaBGDGqESwP7yCEWXC2/GG','Nathalie','Arnaud'),(847,'1john.do@test.fr','[\"ROLE_USER\"]','$2y$13$gQJEZ0/aVT6/BJRGAPps8.pI4EDmFY9U2.uL4jjAhhDqVPGjBQEfy','Émilie','Morel'),(848,'oclerc@guichard.com','[\"ROLE_USER\"]','$2y$13$DvvrogaBtd9sFwuuOHUaG.EI0JVHzSsPG2N/TW5kfyzfnf6Tu8XX6','Jacques','Jourdan'),(849,'olaporte@langlois.com','[\"ROLE_USER\"]','$2y$13$Td3hCovHwE0hPOmjM2NPnu9W3FASwliMjFzwm0cnpr.oZHzP/vFFO','Jeanne','Germain'),(850,'dominique40@marchal.com','[\"ROLE_USER\"]','$2y$13$mkSrjcJetUAuc5BR9TRPUelkq5vXx.ZsJ7Iva7me1SejS7BcV6T6m','Danielle','Fouquet'),(851,'andre63@club-internet.fr','[\"ROLE_USER\"]','$2y$13$V628d2zgBC.hIaN1L3Eqcu9JlNFK1YkGT1hiyx.3eEBjEInO.a5ey','Antoine','Hamon'),(852,'2medecin@studi.fr','[\"ROLE_MEDECIN\"]','$2y$13$6e0PZmJp5tJ9PzRu0asOFeLivM3u99uIx/67GMemUor2SWQkF9Qn.','Claudine','Pichon'),(853,'2john.do@test.fr','[\"ROLE_USER\"]','$2y$13$dazyXFDFTbMzFuji32LPtetULKf1FifazOGX.NPB5opQNapxA7Gt6','Alex','Chevallier'),(854,'morel.maggie@orange.fr','[\"ROLE_USER\"]','$2y$13$ArFa1/CJxVYF/vfCz2QJoOX.VCWim7uVq.AoGWp3ke0InnWJsP1qm','Agnès','Riviere'),(855,'agnes.ferrand@bazin.com','[\"ROLE_USER\"]','$2y$13$6n21iWsVRmC0hSwCK.EG8OB6Xjqmn7adorwPZTC8kKGpdYRltCdOK','Benoît','De Oliveira'),(856,'claude63@dbmail.com','[\"ROLE_USER\"]','$2y$13$TlnNBDY4XrCjmtiajDvfB.KzW8fTo5zg4ycIFyM4zf08pYFvdbIkC','Dorothée','Buisson'),(857,'dorothee31@wanadoo.fr','[\"ROLE_USER\"]','$2y$13$D4rQIdhDanC9UNoKxOnPXeDkxgYHE5jDIxD8Jwc1nL6T0NuhNSUES','Emmanuelle','Roy');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-19 14:47:03
