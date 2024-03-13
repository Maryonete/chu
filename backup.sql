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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendar`
--

LOCK TABLES `calendar` WRITE;
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
INSERT INTO `calendar` VALUES (21,22,101,'Olivier Boutin','2024-03-06 09:00:00','2024-03-13 14:00:00','Et suscipit inventore ut ut veniam aut ut.'),(22,22,102,'Olivier Boutin','2023-03-06 09:00:00','2022-04-06 14:00:00','Vel dolor modi voluptatem quam facere cum laudantium.'),(23,22,103,'Olivier Boutin','2023-05-06 09:00:00','2022-08-06 14:00:00','Et voluptatem laudantium sunt nihil eveniet consequuntur.'),(24,22,104,'Olivier Boutin','2024-04-06 09:00:00','2024-05-18 14:00:00','Natus odio est eos beatae dolor dolorum.'),(25,22,105,'Raymond Berger','2024-03-06 10:00:00','2024-03-13 15:00:00','Id omnis dolorem ut molestias fugit.'),(26,22,106,'Raymond Berger','2023-03-06 10:00:00','2022-04-06 15:00:00','Ut unde vel atque reiciendis quas.'),(27,22,107,'Raymond Berger','2023-05-06 10:00:00','2022-08-06 15:00:00','Voluptas tenetur reiciendis tempore dolor quis.'),(28,22,108,'Raymond Berger','2024-04-06 10:00:00','2024-05-18 15:00:00','Exercitationem excepturi laudantium omnis.'),(29,22,109,'Laure Launay','2024-03-06 11:00:00','2024-03-13 16:00:00','Delectus ab neque velit id harum nisi.'),(30,22,110,'Laure Launay','2023-03-06 11:00:00','2022-04-06 16:00:00','Natus fuga accusantium quis id.'),(31,22,111,'Laure Launay','2023-05-06 11:00:00','2022-08-06 16:00:00','Ut voluptatibus atque aspernatur autem aut inventore modi.'),(32,22,112,'Laure Launay','2024-04-06 11:00:00','2024-05-18 16:00:00','Odio pariatur dignissimos voluptatem accusantium at quia ad.'),(33,22,113,'Olivie Foucher','2024-03-06 12:00:00','2024-03-13 17:00:00','Accusamus fuga neque dolorem facere quis in.'),(34,22,114,'Olivie Foucher','2023-03-06 12:00:00','2022-04-06 17:00:00','Placeat eligendi rerum et ipsa dolor.'),(35,22,115,'Olivie Foucher','2023-05-06 12:00:00','2022-08-06 17:00:00','Repellendus tempora architecto dolores voluptate.'),(36,22,116,'Olivie Foucher','2024-04-06 12:00:00','2024-05-18 17:00:00','Sed quidem ut commodi nemo ea.'),(37,22,117,'Audrey Neveu','2024-03-06 13:00:00','2024-03-13 18:00:00','Aut rem qui optio quia officia ut occaecati.'),(38,22,118,'Audrey Neveu','2023-03-06 13:00:00','2022-04-06 18:00:00','Aut voluptatem voluptas illum voluptas.'),(39,22,119,'Audrey Neveu','2023-05-06 13:00:00','2022-08-06 18:00:00','Aut harum quas aliquid nemo nostrum tenetur ea.'),(40,22,120,'Audrey Neveu','2024-04-06 13:00:00','2024-05-18 18:00:00','Est similique qui sunt dolorum distinctio dolor corporis corrupti.');
/*!40000 ALTER TABLE `calendar` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drugs`
--

LOCK TABLES `drugs` WRITE;
/*!40000 ALTER TABLE `drugs` DISABLE KEYS */;
INSERT INTO `drugs` VALUES (7,'Doliprane'),(8,'Peniciline'),(9,'Vitamine'),(10,'Maalox'),(11,'Ibuprofène'),(12,'Amoxicilline');
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medecin`
--

LOCK TABLES `medecin` WRITE;
/*!40000 ALTER TABLE `medecin` DISABLE KEYS */;
INSERT INTO `medecin` VALUES (12,29),(13,30),(14,31),(15,32),(16,33),(17,34),(18,35),(19,36),(20,37),(21,38),(22,49);
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
INSERT INTO `medecin_speciality` VALUES (12,24),(12,25),(13,23),(14,17),(14,19),(14,25),(14,28),(14,30),(15,20),(16,20),(16,22),(17,18),(17,24),(17,25),(17,27),(18,22),(18,23),(18,24),(18,28),(19,26),(19,28),(19,29),(19,30),(20,16),(20,27),(20,28),(21,20),(21,24),(22,16),(22,17),(22,18),(22,19),(22,20),(22,21);
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
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medication`
--

LOCK TABLES `medication` WRITE;
/*!40000 ALTER TABLE `medication` DISABLE KEYS */;
INSERT INTO `medication` VALUES (63,7,23,'At cupiditate occaecati ea facere.'),(64,8,23,'Dolorum similique ducimus voluptates dolor enim assumenda aliquam.'),(65,9,23,'Cupiditate id asperiores magnam impedit.'),(66,7,24,'Est et eos consectetur.'),(67,8,24,'Eum numquam commodi voluptatum reiciendis quasi fugit aut dignissimos.'),(68,9,24,'Nobis occaecati quo quia corrupti adipisci quia quo sed.'),(69,7,25,'Non qui cumque maiores praesentium.'),(70,8,25,'Ut quod aliquam qui voluptas alias.'),(71,9,25,'Rerum rerum illum magni dicta saepe eius quas.'),(72,7,26,'In incidunt numquam totam neque consequatur omnis vel.'),(73,8,26,'Libero accusamus voluptatem repudiandae id et quas deleniti.'),(74,9,26,'Dolores similique similique similique beatae reprehenderit non corporis.'),(75,7,27,'Iure reprehenderit voluptas voluptatibus.'),(76,8,27,'Illum quisquam eius laboriosam perferendis atque molestiae laboriosam aspernatur.'),(77,9,27,'Placeat voluptas quam reprehenderit enim debitis.'),(78,7,28,'Aut debitis aut dignissimos quos eum ipsa aut.'),(79,8,28,'Molestiae aspernatur praesentium non corporis velit vitae.'),(80,9,28,'Voluptatum esse aliquid nam sit non est ullam quia.'),(81,7,29,'Id alias sequi facilis dolore magni.'),(82,8,29,'Molestiae qui esse quis deserunt ratione quaerat provident.'),(83,9,29,'Magnam praesentium est impedit omnis ducimus qui perferendis id.'),(84,7,30,'Enim quod ut repellat est placeat iste.'),(85,8,30,'Cupiditate distinctio ad eum vel.'),(86,9,30,'Qui est dolores nisi fugiat assumenda deserunt.'),(87,7,31,'Ea est ut id.'),(88,8,31,'Sed cum quasi aliquam.'),(89,9,31,'Enim voluptatem odio non aliquam.'),(90,7,32,'Voluptas eos qui repellat vel commodi.'),(91,8,32,'Officiis et natus voluptas vitae aut.'),(92,9,32,'Aut nesciunt incidunt aut quibusdam similique corrupti provident.'),(93,7,33,'Ipsa quidem reiciendis dolorem accusantium impedit rerum.'),(94,8,33,'Consectetur quia optio accusantium vitae inventore esse consequatur.'),(95,9,33,'Magni dignissimos quia reiciendis et et omnis.'),(96,7,34,'Mollitia facilis porro aut.'),(97,8,34,'Dignissimos sint nam optio veniam.'),(98,9,34,'Pariatur non quibusdam minima et dolorum.'),(99,7,35,'Sit eveniet iste voluptatem magnam aliquam repellat sed.'),(100,8,35,'Perspiciatis enim enim aut dolorum.'),(101,9,35,'Facere in sit suscipit.'),(102,7,36,'Sint et iusto dolor exercitationem doloremque.'),(103,8,36,'Odit sint a soluta autem quis deleniti.'),(104,9,36,'Et deserunt aperiam et molestiae dolorem commodi unde.'),(105,7,37,'Corrupti enim voluptas harum.'),(106,8,37,'Reiciendis aut eos magnam beatae sunt quod.'),(107,9,37,'Non ad illo dolorum et temporibus consequatur.'),(108,7,38,'Velit dolorem et ea quae deserunt.'),(109,8,38,'Soluta placeat at itaque architecto doloribus.'),(110,9,38,'Nostrum sunt harum fugit at.'),(111,7,39,'Quibusdam odit aut assumenda suscipit dicta voluptatem molestias.'),(112,8,39,'Harum porro alias quidem temporibus numquam.'),(113,9,39,'Et dolore maxime quasi rerum aut.'),(114,7,40,'Omnis ipsum dolorem dolor laboriosam pariatur officiis.'),(115,8,40,'Molestiae amet est qui aut.'),(116,9,40,'Ratione sit et magni numquam harum voluptatem est.'),(117,7,41,'Possimus maxime sequi perferendis hic.'),(118,8,41,'Nesciunt quo rerum excepturi dolor at aut quam.'),(119,9,41,'Reprehenderit et soluta et ullam.'),(120,7,42,'Modi repellendus quia aliquam culpa et explicabo.'),(121,8,42,'Explicabo dolores optio voluptas omnis molestiae ut.'),(122,9,42,'Cupiditate modi ipsam ex dolores et vel.');
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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opinions`
--

LOCK TABLES `opinions` WRITE;
/*!40000 ALTER TABLE `opinions` DISABLE KEYS */;
INSERT INTO `opinions` VALUES (26,26,22,'Vel cumque laborum quam harum fuga praesentium.','2024-03-13','Laudantium omnis at velit sunt eligendi ullam. Et qui aut quibusdam fugit facere. Quaerat cupiditate est et quae. Vel perspiciatis natus aut deserunt consequatur doloremque aut perspiciatis. Nesciunt fuga perspiciatis veniam et.'),(27,26,22,'Est hic deserunt suscipit vero tempore repellat.','2024-03-20','Cumque eum nihil esse sed velit ipsa autem. Officiis vel molestiae repudiandae ullam qui modi. Alias veniam sed laudantium necessitatibus id. Eius ut ut fugit.'),(28,26,22,'Vero et quaerat ea sequi sit id.','2024-03-20','Quod non et tenetur in atque. Voluptatem officia animi officia repudiandae. Et qui eius temporibus deserunt.'),(29,26,22,'Autem magnam tempore reprehenderit dolorum molestiae cumque.','2024-03-13','Voluptatum ea est perspiciatis sed aspernatur delectus molestiae. Cupiditate qui sunt explicabo veniam et autem accusantium reprehenderit. Rem distinctio et molestiae. Sit quo ut et ut.'),(30,27,22,'Ut ipsam id eius et corrupti qui.','2024-03-10','In mollitia officiis rem occaecati non fugiat et. Tempora voluptatem facilis culpa dolorem inventore facere. Voluptate sequi nostrum sed qui sunt aspernatur. Id dolores nisi illum et.'),(31,27,22,'Incidunt placeat deserunt et qui tempore dicta earum.','2024-03-07','Veniam consequatur velit autem rerum. Voluptatem exercitationem eaque necessitatibus qui sequi magnam nam. Et distinctio molestiae sapiente.'),(32,27,22,'Aspernatur eum eius eos adipisci.','2024-03-18','Autem quisquam commodi ut consequatur consequatur nobis dolorem. Quae saepe in at aut omnis. Incidunt qui eos sit voluptatem eaque iste ullam. Qui pariatur magni omnis minima.'),(33,27,22,'Nemo consequatur eum voluptas cupiditate eos.','2024-03-20','In necessitatibus deleniti voluptatibus neque facilis. Corporis amet aut alias est molestiae ipsam porro.'),(34,28,22,'Aut laborum vel magni odit voluptatum.','2024-03-10','Voluptas amet ea maxime iusto. Consequuntur facere dignissimos voluptates perferendis optio eum. Id perspiciatis tempora rerum optio explicabo.'),(35,28,22,'Eius delectus nesciunt quam minima.','2024-03-17','Et natus magnam adipisci. Dolore harum laborum veritatis voluptatum incidunt. Et nihil expedita accusamus perferendis atque qui nihil ab. In dolore qui illum autem provident sint corporis.'),(36,28,22,'Architecto id aliquid et hic quidem aut.','2024-03-07','Ut non et est aut et. Quo pariatur quos ut magnam voluptas voluptatem.'),(37,28,22,'Debitis est facilis cumque est.','2024-03-09','Incidunt eos dolor ab quae nulla nostrum aut. Error qui suscipit ipsa magnam accusamus. Repellat quasi veniam quis est quaerat tempora omnis. Est sequi labore sed facere ea quia quibusdam occaecati.'),(38,29,22,'Architecto aut dolorum id hic.','2024-03-16','Excepturi et aperiam corrupti ut consectetur. Labore omnis explicabo quos porro.'),(39,29,22,'Nulla voluptates qui totam voluptatem.','2024-03-10','Et nobis et consequatur reprehenderit quis. A aut et delectus earum et delectus illum ut.'),(40,29,22,'Corrupti provident non nobis.','2024-03-19','Non est similique voluptatem quis repellat. Aperiam temporibus delectus atque laudantium consequatur ea est quidem. Minima soluta illum et quidem culpa praesentium et.'),(41,29,22,'Quo quis aliquid tenetur beatae odio.','2024-03-14','Dolorem debitis qui ut. Deleniti quae et earum accusamus odit odio. Velit molestiae facilis dolore maxime.'),(42,30,22,'Et ratione rem illo doloremque sit consequatur fugiat.','2024-03-18','Minus est praesentium ducimus molestias maiores. Odio et dolor occaecati nesciunt nobis non. Dolor esse dolorum quasi quis quia. Ipsum laborum occaecati perferendis quis voluptatem.'),(43,30,22,'Est quis cum commodi eos.','2024-03-20','Totam beatae consequuntur ducimus quos. Eum omnis libero molestiae odio perferendis distinctio. Aliquid reprehenderit velit aut.'),(44,30,22,'Neque ex debitis distinctio ipsum quia sit asperiores.','2024-03-10','Et et asperiores dolores sed delectus quidem dolores voluptates. Sit doloribus deleniti quam veniam magnam dolorum ipsum. Minima sed magni natus vero nulla harum explicabo beatae.'),(45,30,22,'Cumque odio qui labore qui illum qui commodi molestias.','2024-03-19','Distinctio id fuga nemo suscipit. Illo natus fugit laborum dolores. Non molestias quo aliquid rerum eaque est voluptatibus.');
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES (16,39,'52, rue Carpentier','77380','Brunet-les-Bains','FR'),(17,40,'10, rue de Tanguy','22538','Hardy','FR'),(18,41,'99, rue de Dos Santos','82671','Salmon','FR'),(19,42,'62, rue Meunier','40116','CosteVille','FR'),(20,43,'27, rue de Albert','59501','Grondin','FR'),(21,44,'71, rue de Godard','11020','Lenoir','FR'),(22,45,'55, impasse de Devaux','34299','LeleuBourg','FR'),(23,46,'930, boulevard Gabriel Ferrand','33628','Lefevre','FR'),(24,47,'4, boulevard Marques','16926','Rochenec','FR'),(25,48,'327, rue de Lambert','50688','NavarroVille','FR'),(26,50,'chemin Pires','49133','Gregoire','FR'),(27,51,'chemin Pages','49137','Lopes','FR'),(28,52,'8, chemin de Gros','49239','Maillot','FR'),(29,53,'47, avenue Nathalie Marechal','44864','Imbert','FR'),(30,54,'33, impasse de Roux','04252','Ribeiro','FR');
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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prescription`
--

LOCK TABLES `prescription` WRITE;
/*!40000 ALTER TABLE `prescription` DISABLE KEYS */;
INSERT INTO `prescription` VALUES (23,22,26,'2024-03-06','2024-03-15'),(24,22,26,'2024-03-06','2024-03-19'),(25,22,26,'2024-03-06','2024-03-11'),(26,22,26,'2024-03-06','2024-03-11'),(27,22,27,'2024-03-06','2024-03-18'),(28,22,27,'2024-03-06','2024-03-20'),(29,22,27,'2024-03-06','2024-03-08'),(30,22,27,'2024-03-06','2024-03-14'),(31,22,28,'2024-03-06','2024-03-16'),(32,22,28,'2024-03-06','2024-03-18'),(33,22,28,'2024-03-06','2024-03-17'),(34,22,28,'2024-03-06','2024-03-14'),(35,22,29,'2024-03-06','2024-03-15'),(36,22,29,'2024-03-06','2024-03-10'),(37,22,29,'2024-03-06','2024-03-13'),(38,22,29,'2024-03-06','2024-03-17'),(39,22,30,'2024-03-06','2024-03-18'),(40,22,30,'2024-03-06','2024-03-15'),(41,22,30,'2024-03-06','2024-03-12'),(42,22,30,'2024-03-06','2024-03-17');
/*!40000 ALTER TABLE `prescription` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `speciality`
--

LOCK TABLES `speciality` WRITE;
/*!40000 ALTER TABLE `speciality` DISABLE KEYS */;
INSERT INTO `speciality` VALUES (16,'Biologie','Aliquid asperiores fugiat quis est. Et earum dolores provident. Quos pariatur cupiditate natus aut nisi quia ipsa. Qui ad voluptas beatae veniam soluta excepturi et non.\n\nOptio voluptas recusandae non. Incidunt in commodi mollitia voluptatem est inventore. Repellat consequatur quasi aut quisquam aut et consequuntur. Repellendus quibusdam commodi recusandae sed similique est qui quasi.\n\nVelit iure facere perspiciatis omnis eos aut. Id quia illum voluptatibus veritatis quae qui. Et ratione ratione rerum nemo.\n\nUnde voluptatibus eum temporibus mollitia in. Voluptas est non asperiores commodi officiis.\n\nOmnis debitis dolorum eaque qui rerum ut ipsum. Minima doloremque officiis adipisci est quisquam laudantium. Praesentium consequatur necessitatibus repudiandae. Dolorem ducimus non ea et cumque.'),(17,'Cardiologie et Maladies Vasculaires','Sit ad excepturi maxime nesciunt facere sunt in ipsam. Nihil cupiditate est nostrum maiores doloribus. Error dignissimos necessitatibus voluptatem atque quo est architecto.\n\nRerum ut fugit doloremque dolore ut molestiae. Consequatur impedit consequuntur nihil dolorem voluptatem temporibus necessitatibus.\n\nConsectetur odio esse explicabo quidem ipsa dolores autem a. Ad necessitatibus dolore et temporibus dolorem ut labore est. Et magni et similique nam iure molestiae repellendus. Sint labore quae beatae et vero.\n\nUt adipisci iusto maiores voluptatem. Et voluptatibus et quo. Ipsa quasi tempora qui mollitia dolorum consequuntur et quis.\n\nQui odio repellendus aliquam possimus accusantium provident recusandae quo. Ipsam unde et dolorem qui impedit non. Sint repudiandae vitae hic odit iure expedita nisi esse. Enim quis quia voluptatem doloremque aliquam vel quisquam.'),(18,'Chirurgie Dentaire','Veniam saepe consequatur quod similique quia sunt iusto. Voluptatem molestiae repudiandae consectetur consequatur. Nihil sunt dolor est aut vel non.\n\nEnim aut enim sunt molestiae. Est corporis est eaque sed voluptas ea. Qui exercitationem dolorem ipsam quidem.\n\nConsectetur pariatur vero architecto quae ut sed quod. Pariatur natus dolorem consequatur excepturi eos officia sunt. Dicta dolorum non ipsum dolores. Rerum deleniti consequatur reprehenderit illum libero culpa voluptatibus nostrum.\n\nDolore praesentium aut architecto molestiae. Rem qui modi sed excepturi aut.\n\nCommodi eveniet veniam nam sit omnis et vel voluptatem. Nisi sit et ipsam ut excepturi ut sed quaerat. Quasi illum maiores temporibus aut sed.'),(19,'Chirurgie Ophtalmologique','Illo ipsam numquam vero consequatur. Rerum eos excepturi illum a. Reiciendis ut consectetur exercitationem quis eum.\n\nNon beatae impedit ut sed est. Molestias expedita voluptatum enim enim sunt dolorem qui. Dolores perferendis aperiam necessitatibus amet impedit. Odio ut eaque sit voluptatibus id dolorum aut.\n\nSed aut mollitia voluptatem sequi molestiae dolor doloribus. Minus aut est est dolore quisquam reprehenderit. Et alias pariatur labore est qui excepturi libero.\n\nAd ut adipisci ad numquam placeat aut. Et ut odit minus saepe. Quis id non dolorum sit.\n\nEt laborum voluptas commodi sit saepe qui. Ut quisquam et sunt qui adipisci ut. Consequatur repellat eos ut voluptatem. Nesciunt et nesciunt qui occaecati unde et.'),(20,'Chirurgie ORL','Adipisci omnis qui quaerat rerum. Modi non natus aliquam minus mollitia aut provident at. Sint animi nihil qui. Voluptas ducimus culpa sit provident quod odio rem.\n\nEt est dignissimos repudiandae. Ex nihil fugiat consequatur molestias quia veniam enim. Quasi est ut quaerat voluptas esse non et fugiat.\n\nAutem molestias et non dolor sapiente possimus. Consequatur tenetur autem et nisi ut. Tempora deleniti eius animi explicabo repudiandae.\n\nUt perferendis nulla sint quia. Et voluptatem ea quia repudiandae doloremque reiciendis exercitationem. Ratione voluptatem et sit provident magni.\n\nEos reprehenderit praesentium occaecati minus inventore dolor. Est recusandae est laborum corrupti delectus eveniet adipisci.'),(21,'Chirurgie Orthopédique','Fugit quaerat cum aliquam dolores nesciunt in dolorem consectetur. Neque possimus aut pariatur dolor magni voluptatem dolor hic. Harum officiis ullam est fuga. Amet nostrum omnis labore alias nihil molestiae fugit.\n\nQuae eos repudiandae voluptatem nostrum. Dolore provident dolorum commodi sunt quisquam consequatur. Officiis tempore iusto consequuntur consequatur. Voluptatem rerum eum possimus optio quam optio.\n\nCommodi harum sed illo et. Autem facilis quis iure accusantium quo eos voluptas. Laboriosam distinctio ipsa neque ducimus.\n\nUllam in saepe eum aut recusandae. Quidem commodi aut omnis fugiat at ducimus tempore. Id harum dolor dolores.\n\nDolorum ea autem molestias quos eum incidunt. Sit alias rerum quasi quidem. Qui expedita aut tempore voluptatem voluptas quia.'),(22,'Chirurgie Pédiatrique','Consequuntur aut dolorem alias enim nostrum id. Earum vitae deserunt maiores nemo placeat doloremque. Quaerat iusto ipsa deserunt eum nobis voluptate. Sit aut et voluptatem cum.\n\nDignissimos vel quia esse saepe. Aperiam magnam consequatur incidunt aliquam quae vitae. Et dolores asperiores neque ea reprehenderit. Nemo consequatur architecto ut est eum nostrum.\n\nQuo aut voluptatum dignissimos sint quia sit impedit. Magni voluptatem nemo omnis sit minima. Dolor est corrupti qui ipsum ut amet. Architecto est architecto molestias fuga.\n\nAssumenda vero et facilis id voluptas. Voluptatibus eaque et vel rerum reprehenderit. Maiores neque ab magnam sapiente incidunt. Ut quo exercitationem delectus eaque enim cupiditate nostrum. Pariatur rem quis consequuntur eaque rerum dolore.\n\nUt necessitatibus eum perferendis. Et et quaerat sit assumenda aspernatur.'),(23,'Chirurgie Vasculaire','Ipsa unde et dolore cum laboriosam nemo dolores et. Ut rem illo et sit eius iusto vero.\n\nPlaceat fuga eum at sint occaecati repellat. Dolorem animi nostrum sunt enim blanditiis debitis doloremque excepturi. Dolor voluptates in ut recusandae. Quam beatae voluptate nisi molestias aut.\n\nEt autem voluptatem et ut tempora iste. Autem sint perspiciatis aliquam quis mollitia. Veniam magnam repudiandae quia tenetur ut qui sed. Exercitationem pariatur ut sint sequi.\n\nEsse natus eum sequi qui molestias eligendi unde. Dolores soluta quia quis ipsam ut. Est soluta est animi assumenda omnis. Similique quibusdam ullam odio sit provident.\n\nQui totam reprehenderit consequuntur. Debitis aliquid quaerat excepturi ipsa molestias unde. Dignissimos at iusto illum facere autem.'),(24,'Gastro-entérologie et proctologie','Asperiores omnis doloribus ipsam sit. Ad aspernatur et quo. Velit laborum ut cumque quis recusandae.\n\nCumque saepe accusamus aut. Iusto quae aperiam laboriosam et. Error et et consequuntur esse omnis sunt.\n\nIllo exercitationem nam vitae quis. Ut voluptatibus ipsa unde aut. Quaerat dolores cum veniam at non suscipit. Dolorem deserunt vel a reprehenderit provident et rerum.\n\nQuam iusto non consequatur labore temporibus. Harum voluptates commodi corporis ea voluptatem et. Expedita non sed voluptates est quidem voluptatem.\n\nOdio culpa voluptatem quam similique quam. Nemo minima ipsa voluptas eos ex eaque voluptate quisquam. Pariatur quia aut quidem sed aut. Quaerat amet eligendi explicabo hic.'),(25,'Institut du pied','Quaerat repellat sed commodi ad quidem eveniet. Eos omnis facilis dolor asperiores est velit omnis reprehenderit. Ab nesciunt nesciunt fugit provident aut veritatis. Asperiores maxime accusamus eius et laboriosam.\n\nRerum at et qui. Labore velit alias veritatis magni ut. Distinctio dignissimos error assumenda alias.\n\nDolorem ad nulla esse blanditiis reiciendis dolor autem quasi. Consequatur rem rerum sed veritatis voluptatum. Quibusdam dignissimos expedita ut ducimus quo dolor omnis.\n\nAnimi sit incidunt nisi magni. Quia rem odit dolore. Magni nihil et autem amet.\n\nAssumenda a quia voluptatem veritatis culpa. Qui iure qui et beatae. Sequi cupiditate earum tempore. Quasi accusamus inventore consequuntur commodi accusamus.'),(26,'Médecine et Gérontologie','Eum consequatur ut quia sed in in consequatur hic. Dolor at voluptas quo libero totam debitis in. Nihil sunt est quibusdam mollitia velit. Placeat earum sunt nam temporibus saepe ducimus.\n\nVoluptas praesentium libero numquam ullam. Enim eos nulla voluptate nobis possimus quaerat qui. Sunt dicta ea quos. Blanditiis voluptatem earum id.\n\nEst dolorem soluta quia sint nesciunt ut. Laborum odit dolorem maxime at. Repellat repellendus vero eos quibusdam nostrum provident. Dolore minima sint magni aut aut.\n\nCumque beatae quisquam vitae nulla blanditiis sequi porro qui. Consequatur sapiente facilis aperiam autem dolore in. Necessitatibus possimus qui in ullam in autem.\n\nQuia mollitia eum consequatur ut. Non voluptas labore fuga sit non quas. Repellendus doloremque ex et corrupti nulla.'),(27,'Orthopédie','Et maxime repudiandae voluptatem iste. Neque dolor minima maxime totam ad. Sed consequatur porro laborum quod consequatur sed.\n\nBlanditiis optio dolorem odio ut debitis. Repudiandae nulla sunt voluptatem molestiae et maiores. Facere voluptatibus modi quia. Ut perferendis soluta consequatur nihil quis ipsam et. A ipsam et aliquam aut.\n\nAt dolores assumenda perspiciatis omnis quia ea aperiam dolor. Non accusantium dolore eum maxime deleniti expedita amet. Quis qui consequatur quis dolorem officia vel laboriosam. Iure rerum vero expedita labore aut.\n\nRecusandae et nihil voluptatem. Unde voluptatem eos officiis autem exercitationem magnam occaecati aperiam. Quo exercitationem autem voluptatibus quaerat fugit aliquid. Iusto magnam qui animi omnis.\n\nA perspiciatis inventore quas tempore ut vel in quo. Sed velit illum adipisci hic occaecati assumenda. Saepe qui explicabo sit et quis tempore. Eum fugit aliquam distinctio veniam perspiciatis aut eum asperiores.'),(28,'Pneumologie','Dolorem eum quam aut occaecati qui consequuntur. Est aut dolor debitis omnis reiciendis. Fuga repudiandae recusandae occaecati reiciendis nam nam aut. Aliquid sunt dolore voluptatem qui consequatur quia dolorem.\n\nQuae iure molestias ut rerum facilis. Ut rerum porro molestiae quia enim. Quae voluptas sint soluta neque odio.\n\nOmnis occaecati fugit odio maiores. Vel corporis harum ut ut consequuntur. Consequatur doloribus explicabo dolores sint. Porro voluptatem qui nostrum aut odio magnam.\n\nSit voluptatem possimus aliquid omnis et modi dolore qui. Nihil ea dolore provident provident error sequi. Accusamus dolor nulla quae officiis aut est.\n\nVitae recusandae minus laudantium et id. Porro quisquam repellat iure rerum nulla. Deserunt excepturi accusantium est quae iure. Nulla cumque enim qui odit.'),(29,'Radiologie','Similique est quis quia et. Impedit illum animi consequuntur autem nihil harum. Temporibus nostrum quia consequatur a magni culpa.\n\nEaque omnis tempora nisi laudantium ipsam. Voluptas accusamus quo modi excepturi pariatur. Quia non quas tempora eaque dignissimos voluptatem sit. Quisquam qui repellendus quia distinctio et voluptatum repellat.\n\nUnde deserunt illo iure quos modi. Enim cupiditate qui esse et iure sed blanditiis. Maxime corporis veritatis consequatur incidunt et natus.\n\nEt magnam sint ut excepturi et ipsa voluptas aut. Eum expedita quia in dolore quia. Eligendi et voluptate suscipit repudiandae commodi inventore. Iure omnis rerum velit omnis molestias.\n\nQuam nisi est occaecati ut. Qui nemo quibusdam voluptas commodi. Excepturi vitae totam at nihil tempora expedita aliquid in.'),(30,'Urgences Adulte et Enfant','Accusantium sed laboriosam omnis. Cum optio tenetur consequatur sit. Voluptas inventore quos ullam sint iusto.\n\nAd sint consequatur modi delectus et. Assumenda molestiae quidem voluptates inventore modi. Facilis qui esse est id et omnis vero voluptatem.\n\nAdipisci quas autem doloremque ipsam sunt eum fugit. Velit ut et nostrum quam reprehenderit soluta aliquid. Voluptas libero sint deleniti accusamus. Non fugiat unde cupiditate aliquid et dolorum.\n\nRerum vel nihil dolores voluptatem quo nihil vel. Repellendus ut aperiam est voluptatem non aliquid. Amet nihil tempora et quaerat et sed.\n\nProvident voluptatem dolore dicta dolores ut fugit. Similique eum repellat cum sit aliquam quia. Nulla in et rerum hic aspernatur est.');
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
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stay`
--

LOCK TABLES `stay` WRITE;
/*!40000 ALTER TABLE `stay` DISABLE KEYS */;
INSERT INTO `stay` VALUES (61,25,16,21,'Magni commodi quo praesentium modi quis repellendus.','Dolorum ut sint vel odio porro ipsa impedit. Et veritatis vel doloribus ea. Eveniet et porro voluptas omnis.','2024-04-15','2023-04-15',1),(62,21,16,14,'Mollitia maiores quis et doloribus velit ullam.','Ut ut possimus ratione veritatis modi. Nisi iste ut fugit autem officiis ea. Qui voluptatem eligendi officia minima dolor et ut. Vel voluptatem qui at quia voluptas sed.','2024-12-16','2023-07-06',1),(63,23,16,17,'Reprehenderit autem qui placeat cum.','Rerum cupiditate facilis veniam odit. Praesentium optio rem molestiae quaerat doloremque et iusto. Officia consequuntur repellendus voluptates dolorem velit ab velit placeat.','2024-11-19','2024-03-11',0),(64,25,16,15,'Aut blanditiis ut sit aut nulla cumque quidem.','Quod necessitatibus et soluta molestiae. Sapiente consequatur cupiditate dolore voluptas aliquam ut expedita aut. Illum eligendi repellat ut.','2024-01-28','2024-11-24',1),(65,21,17,13,'Dolorum possimus ratione id sed sint in enim.','Corporis dolorum voluptas ducimus consectetur voluptatem pariatur in commodi. Saepe odit vel temporibus amet est.','2024-05-31','2024-08-27',0),(66,16,17,16,'Dignissimos quod ea placeat fugit error.','Perferendis culpa quia enim hic voluptates incidunt facere. Explicabo non assumenda et. Delectus repellat beatae et maiores pariatur enim quis. Nulla velit neque earum nesciunt quos eveniet in.','2024-08-28','2024-10-06',0),(67,29,17,19,'Et non sit libero inventore eum.','Porro ea ea modi non dolor recusandae molestias. Omnis expedita omnis deleniti dolor. Provident vero ad voluptas aliquam temporibus quas doloribus. Quod impedit distinctio sunt cumque fugit.','2023-04-02','2024-12-18',1),(68,26,17,17,'Odit esse nesciunt sunt ipsam.','Explicabo cumque aut esse earum quod et cumque qui. Quo et impedit nihil dolores et atque voluptatem vero. Animi consequatur tenetur labore.','2023-10-17','2024-09-20',1),(69,18,18,16,'Facilis ullam et ut sed.','Et modi aut sed ad velit provident ducimus consectetur. Beatae iusto nihil omnis est eligendi. Ratione vero quaerat esse ea. Occaecati voluptatem ut dolores totam ipsa eum.','2024-04-14','2023-07-29',1),(70,22,18,18,'Voluptatem aut unde natus.','Iste pariatur quia illum molestiae modi. Voluptas est sint eligendi consequatur mollitia. Dolores suscipit perferendis et et ex beatae qui.','2025-02-09','2024-10-14',0),(71,20,18,15,'Animi veritatis et eveniet doloribus occaecati animi ut quia.','Vel repellat nostrum est ea tenetur. Repudiandae facilis assumenda quidem aut id ut dolores non. Nulla non nisi dolores doloremque aperiam. Et animi qui voluptate qui aut placeat laudantium animi.','2023-04-07','2023-07-01',1),(72,29,18,12,'Omnis ex laboriosam mollitia.','Dolorum ut est in est. Autem id ipsa voluptatibus in eaque aut ab. Repellat expedita dolorem aut tempora cumque perspiciatis. A qui ut voluptatum eum asperiores eligendi omnis.','2024-03-05','2025-01-15',1),(73,22,19,18,'Occaecati unde sit et nam eligendi ab.','Aut enim doloremque quis aut. Quisquam veritatis esse eum atque est non molestias.','2025-02-05','2023-10-17',1),(74,25,19,18,'Architecto similique cum veniam iusto ullam blanditiis aut illum.','Dicta eos et sunt accusamus. Qui dolores aut voluptas rem et qui reiciendis. Eos ut possimus quia. Non sit non et.','2024-11-24','2024-04-29',0),(75,21,19,19,'Et minima qui deleniti quia.','Voluptatem labore sit numquam mollitia. Omnis vel itaque non quis. Sunt dolore voluptatem est ut mollitia rem.','2023-12-13','2023-05-22',1),(76,27,19,14,'Ipsa quos maxime eos amet et laudantium ullam ullam.','Corporis tempore facilis iusto nemo. Consequatur qui fugiat quae aut ea.','2023-09-16','2024-05-23',1),(77,30,20,13,'Aut ratione culpa laborum illum totam voluptas et et.','Et doloremque sed ut dolorum ab. Voluptatibus similique itaque placeat et id et consequatur. Quia libero velit et voluptatum maiores.','2024-06-15','2025-02-02',0),(78,25,20,13,'Quo velit id dolores ad reiciendis officia sed.','Modi eius culpa vitae id occaecati fugiat. Magni delectus tempora provident sint.','2024-10-11','2024-01-17',1),(79,19,20,18,'Laborum cumque repellendus quam maxime modi.','Omnis eaque voluptas nihil. Porro sequi odit voluptas. Enim labore qui ea laudantium numquam. Facere sed explicabo dolorem et sapiente quos occaecati.','2023-05-04','2024-10-16',1),(80,16,20,18,'Aut necessitatibus consequuntur odit impedit ut.','Sit tempora vel tempora ipsa qui. Deleniti qui laboriosam molestiae. Possimus qui sint excepturi voluptatibus voluptatem ipsum.','2024-03-04','2024-09-25',1),(81,19,21,17,'Beatae et dolores numquam eos autem.','Optio autem sapiente numquam rerum. Illum non perferendis ea voluptatibus dolorum aut dolorum. Rem rerum velit officia expedita qui dignissimos. Dicta aut amet rerum cumque praesentium voluptates non eius.','2024-07-10','2023-09-30',1),(82,20,21,20,'Error eaque quia quos laboriosam.','Placeat dolorum est quia optio esse omnis. Assumenda numquam quos amet voluptatem at quis. Alias explicabo voluptas ut aut facilis architecto dicta. Cupiditate possimus voluptatibus fugiat fugit ut voluptate.','2024-05-09','2025-02-11',0),(83,20,21,15,'Impedit temporibus ea qui aliquam aut autem.','Tenetur et debitis illo. Ut sapiente eligendi et laboriosam sunt vel ut. Facere voluptatibus aut error perspiciatis fuga. Voluptate rerum sunt autem totam.','2023-11-06','2024-08-08',1),(84,30,21,13,'Quia eum tempora sit itaque doloribus et.','Quisquam facilis asperiores est numquam quam. Similique debitis fuga quisquam praesentium eligendi. Dignissimos rerum cupiditate repellendus aliquid dolor.','2025-02-03','2024-02-05',1),(85,20,22,20,'Dolor numquam est fugit exercitationem nisi.','Architecto in vitae cum alias enim voluptas. Tempore tempore est illum sit assumenda placeat repellat. Consequatur ex iste ut itaque.','2025-03-03','2024-12-28',0),(86,28,22,18,'Ex consequatur autem tempora eveniet quidem expedita.','Assumenda voluptatibus voluptatibus id et rerum quibusdam et. Qui quibusdam quaerat iusto et eius. Temporibus nemo eos aperiam incidunt consequatur quia. Consequatur incidunt nostrum est perferendis quia delectus doloremque cupiditate.','2024-12-14','2024-03-08',0),(87,20,22,20,'Enim ut nemo est dolor.','Enim vel voluptatem est reiciendis rerum cum accusantium dolor. Quia magni nihil aliquid. Neque ea ea mollitia exercitationem eaque nam. Sequi et rerum nisi et iste nostrum itaque assumenda.','2023-05-23','2023-08-23',1),(88,29,22,21,'Ullam molestiae ad ut voluptas veniam neque.','Deleniti aut consequatur asperiores soluta quidem. Sit vitae maxime minima quaerat veniam sapiente eum. Repellat modi explicabo voluptatem odit et repudiandae natus a. Sunt ut et sunt explicabo incidunt qui id.','2023-05-17','2023-12-06',1),(89,17,23,16,'Dolor ea dolore est ipsam aperiam.','Dignissimos alias quis quos exercitationem quam id optio. Non ut odio ducimus et. Ut impedit quis praesentium nihil dolores reprehenderit voluptas. Voluptas quos odit deleniti rerum aliquid et.','2024-09-29','2023-08-27',1),(90,30,23,13,'Tempora error ut consequuntur vel et.','Est sequi aut nam molestiae esse quidem accusamus dolores. Praesentium ratione inventore et aperiam. Dolor quos ut repellat.','2024-04-11','2024-07-11',0),(91,30,23,17,'Eos ducimus asperiores voluptate ut aliquid ab.','Est porro dolorem minima illum eum quia. Quo accusantium debitis atque voluptatem facilis est neque. Ut voluptatem quas deleniti eveniet.','2024-04-01','2024-06-05',0),(92,27,23,12,'Reiciendis est reiciendis esse libero veritatis ut deleniti provident.','Laboriosam enim ut qui illum. Eos eos quia molestiae vel rerum. Voluptatem quidem voluptatem voluptatem ipsam molestiae non repellat officia. Reprehenderit rerum eum modi consequuntur dolor.','2024-07-13','2024-02-11',1),(93,18,24,17,'Mollitia quis consequatur libero tempore adipisci nostrum consequatur eius.','Est rem repudiandae sint quia porro ea. Aut aut ipsa magni inventore officiis. Dolor eligendi rem culpa enim. Enim sed modi incidunt.','2024-12-20','2023-04-27',1),(94,24,24,17,'Placeat blanditiis autem repellat ut quo.','Corrupti unde blanditiis facilis qui quia ut. Soluta illo ipsa in eum rerum eos. Consequatur illo optio hic enim a. Tenetur et et qui velit fuga ut rerum.','2025-01-03','2024-01-22',1),(95,19,24,20,'Quasi molestiae ex officiis sint dolores.','Labore iusto vel quasi labore aspernatur aut labore. Incidunt a blanditiis ducimus officiis dolorem fugiat quia amet.','2024-04-16','2023-07-28',1),(96,27,24,12,'Magnam maiores quod qui aut vitae.','Labore doloremque ut molestias quo illo distinctio. Exercitationem quas non vero vero quas eum nobis quidem. Doloribus tempore ipsum aut eos impedit officia. Quas nulla nulla explicabo temporibus non.','2023-07-14','2023-12-03',1),(97,19,25,16,'Recusandae dolores repellat reprehenderit consequatur ut deserunt animi.','Sed consequuntur in minus corporis. Aperiam nisi aspernatur et dignissimos soluta.','2024-07-06','2024-11-07',0),(98,17,25,14,'Quo et veritatis temporibus quae voluptatem tempora reiciendis quod.','Temporibus et at vel et ab est laboriosam eos. Dolores quis quo molestiae eveniet quia. Ut odio sint ipsa rerum. Ut iure aut ut incidunt. Temporibus sequi deleniti eos qui magni.','2024-05-11','2024-10-31',0),(99,27,25,18,'Eveniet et earum voluptas.','Accusamus consectetur nulla illum id. Vero eos exercitationem est non reprehenderit dolore laborum iste. Aspernatur debitis placeat blanditiis error rerum.','2024-06-11','2024-03-18',0),(100,30,25,21,'Dolore cupiditate exercitationem velit soluta aperiam blanditiis.','Numquam non blanditiis ratione eligendi pariatur aut. Voluptas mollitia iure optio sed hic. Error mollitia eveniet enim voluptas tempora. Suscipit dolore aut assumenda laboriosam et.','2024-09-03','2023-03-07',1),(101,21,26,22,'Et suscipit inventore ut ut veniam aut ut.','Cumque enim qui ab enim voluptatem accusamus. Odit distinctio accusamus ducimus sed. Dolore excepturi aut ut amet modi.','2024-03-06','2024-03-13',1),(102,16,26,22,'Vel dolor modi voluptatem quam facere cum laudantium.','Neque vel commodi nemo quos sint. Saepe est qui odio quod omnis dicta corporis. Aliquam et sint maxime ut. Et neque aspernatur suscipit. Voluptate voluptatem fugiat ut quod.','2023-03-06','2022-04-06',0),(103,19,26,22,'Et voluptatem laudantium sunt nihil eveniet consequuntur.','Nihil accusantium sint adipisci dolorum. Voluptate dolore qui voluptas qui id doloremque. Omnis adipisci ipsa quia omnis quae eos.','2023-05-06','2022-08-06',0),(104,21,26,22,'Natus odio est eos beatae dolor dolorum.','Adipisci maxime est id deleniti. Quia sint dolore velit iste officiis fugiat. Temporibus saepe at laudantium distinctio voluptatem.','2024-04-06','2024-05-18',1),(105,20,27,22,'Id omnis dolorem ut molestias fugit.','Voluptatem ex excepturi repellendus magni in exercitationem quis. Deleniti ipsa ut alias natus nemo. Incidunt quia nostrum necessitatibus autem facilis.','2024-03-06','2024-03-13',1),(106,16,27,22,'Ut unde vel atque reiciendis quas.','Qui ut id ratione ut odit impedit cupiditate. Velit assumenda voluptas cumque minus expedita. Necessitatibus totam quia eius eum vel eos et. Aliquam quaerat voluptas nobis.','2023-03-06','2022-04-06',0),(107,18,27,22,'Voluptas tenetur reiciendis tempore dolor quis.','Iste ipsa corporis assumenda itaque optio temporibus. Iusto alias porro exercitationem est qui sed. Quia totam ea a error voluptatem quis vel. Est ipsa libero excepturi corrupti deleniti.','2023-05-06','2022-08-06',0),(108,18,27,22,'Exercitationem excepturi laudantium omnis.','Neque sequi reiciendis cum unde velit dolores. Quia provident ex quis fugiat.','2024-04-06','2024-05-18',1),(109,16,28,22,'Delectus ab neque velit id harum nisi.','Voluptatibus officia omnis vero dolorem eum. Necessitatibus id voluptas possimus rem. Corrupti labore deleniti ratione qui. Iusto autem repellat laboriosam voluptas.','2024-03-06','2024-03-13',1),(110,21,28,22,'Natus fuga accusantium quis id.','Eum dicta magnam quod ut numquam odit. Dolore reprehenderit quis libero consequatur omnis. Rerum optio sapiente a sed nobis et optio ullam. Omnis illo voluptatem assumenda est.','2023-03-06','2022-04-06',0),(111,20,28,22,'Ut voluptatibus atque aspernatur autem aut inventore modi.','Aut debitis amet iure in quae et. Quia officiis reiciendis beatae omnis accusantium a quo. Quis harum et porro id soluta est laboriosam.','2023-05-06','2022-08-06',0),(112,19,28,22,'Odio pariatur dignissimos voluptatem accusantium at quia ad.','Et dolore ut id alias. Quis fugit cum tempore commodi optio possimus. Quod labore quo eos nostrum.','2024-04-06','2024-05-18',1),(113,20,29,22,'Accusamus fuga neque dolorem facere quis in.','Quia voluptas quidem voluptatem enim aut minima aut. Rerum sit ut rerum aspernatur totam molestiae debitis in. Officia odio quia libero asperiores autem ea necessitatibus. Quod iste cupiditate facere sunt quia est rerum.','2024-03-06','2024-03-13',1),(114,20,29,22,'Placeat eligendi rerum et ipsa dolor.','Autem quia totam alias ut qui corrupti. Necessitatibus facilis iusto harum eum voluptas numquam. Iure odit deserunt voluptas exercitationem exercitationem eius eligendi enim.','2023-03-06','2022-04-06',0),(115,20,29,22,'Repellendus tempora architecto dolores voluptate.','Accusamus nesciunt omnis cupiditate dolores rerum consequuntur et. Aut itaque eligendi omnis dicta ut ut occaecati. Aut aut nulla odio.','2023-05-06','2022-08-06',0),(116,21,29,22,'Sed quidem ut commodi nemo ea.','Et deserunt consequatur aliquam totam adipisci. Est placeat quos nemo nulla consequatur possimus. Et similique ratione qui iste magnam facilis. Alias facere dolores harum dignissimos reprehenderit iste sequi.','2024-04-06','2024-05-18',1),(117,16,30,22,'Aut rem qui optio quia officia ut occaecati.','Ut ut eos saepe hic provident eligendi. Hic sit consequatur veritatis laboriosam distinctio. Ea enim nulla eum voluptas. Qui omnis labore unde ut.','2024-03-06','2024-03-13',1),(118,17,30,22,'Aut voluptatem voluptas illum voluptas.','Error dolore qui ut modi quis. Eum necessitatibus excepturi et quia quisquam consequuntur. Qui eveniet voluptas animi molestias necessitatibus corporis eos reprehenderit. Veniam quia cum consectetur illo veritatis.','2023-03-06','2022-04-06',0),(119,16,30,22,'Aut harum quas aliquid nemo nostrum tenetur ea.','Dolore iure vero corrupti voluptatem eum delectus occaecati inventore. Voluptate facilis iste autem nesciunt deserunt molestiae amet. Sit quo ut enim voluptatibus tempora accusantium ratione. Non possimus non quo est dolorem est.','2023-05-06','2022-08-06',0),(120,18,30,22,'Est similique qui sunt dolorum distinctio dolor corporis corrupti.','Vel sed et delectus libero ullam. Mollitia doloribus fugit ipsa explicabo adipisci est iure. Magnam quae nemo facere. Dicta quo et reprehenderit nobis debitis voluptate cupiditate. Ex odio nobis mollitia non quas et modi.','2024-04-06','2024-05-18',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (28,'admin@studi.fr','[\"ROLE_ADMIN\"]','$2y$13$kJ/MBKQqXWaMgd25LzI6v.t.UIIlTfaHFDX3T4MyKoetXn3xHeiFS','Admin','Admin'),(29,'oleroux@louis.com','[\"ROLE_MEDECIN\"]','$2y$13$OduURkaQUccPrW7vsmimNO/rQkjBbb4viOpXQeI.BK9OI0ImYd2Pq','Marcel','Rossi'),(30,'olesage@guillon.org','[\"ROLE_MEDECIN\"]','$2y$13$GivkMHkZNMbdy9FDxGDiROaii5oHC8PyRJpkOTHJpYIf3Iu5y5FG6','Robert','Lacroix'),(31,'benjamin24@free.fr','[\"ROLE_MEDECIN\"]','$2y$13$4Ujx6VKkvnkcn2.v.yCHaO5qQs.lTl1HAzMLHIoY.NwDftXv0C/ai','Louis','Albert'),(32,'lorraine.dumas@wanadoo.fr','[\"ROLE_MEDECIN\"]','$2y$13$C7EbOHat4Fvpa55czUdbk.PQtUZt0Ekx4/XFPyykrzRQg.J33/3hi','Adrien','Denis'),(33,'therese.grenier@yahoo.fr','[\"ROLE_MEDECIN\"]','$2y$13$HSg4v5fDnYGUswVHoJR02OI2.rEcgymEPHJ3lwntZP2LkxzaPGT8y','René','Merle'),(34,'laporte.marthe@free.fr','[\"ROLE_MEDECIN\"]','$2y$13$/iHw6Whg3Hc3EpZweZIdgOHX6uYsHY9Wv4xKLxUs534UxUjqEywSm','Patrick','Guichard'),(35,'jeanne51@tele2.fr','[\"ROLE_MEDECIN\"]','$2y$13$PDglB5H.H8Kp7VtOd8jBHO8lEt66edFrSpOw4pWAW/Pqsp03uHgBm','Christiane','Legrand'),(36,'adrien91@rossi.com','[\"ROLE_MEDECIN\"]','$2y$13$Xrh95qK9M2MoW7xCxnBzSew9JGJCHO0S8UIYM4qDANJy4S3JQdKnC','Michelle','Boucher'),(37,'charles54@live.com','[\"ROLE_MEDECIN\"]','$2y$13$IJe0TST66fPwfHcomhFZ7Or5.aZYJCZqVg5Vw2CSLeeOhWMg/EFQK','Monique','Remy'),(38,'henri.barbier@club-internet.fr','[\"ROLE_MEDECIN\"]','$2y$13$GFTi7Ddv483GtSar2edoNOyjw97INcAcASOGrL9fbPygCLv5D5UQ2','Chantal','Duhamel'),(39,'coste.aurore@texier.fr','[\"ROLE_USER\"]','$2y$13$gvSedWCOELaptWyWpouob.BRpbTWpSHT83lFSH4/BTZ43kc0uPKRK','Geneviève','Gilbert'),(40,'henriette.auger@live.com','[\"ROLE_USER\"]','$2y$13$g/ld6OvzWqbADAFS/6VOV.Gsr3A/z3zpLBXy2HoP4bAtVSmXZdYLu','Margot','Sanchez'),(41,'cgomes@dbmail.com','[\"ROLE_USER\"]','$2y$13$kySXRDVK2jqfw8mR1gW8XO4kVp/8HZVKuFASQFWYzSFSoGrKN4my2','Clémence','Vallet'),(42,'seguin.odette@wanadoo.fr','[\"ROLE_USER\"]','$2y$13$dIUS4uI/UAlds8fpELjZ/OfbkiAQlXV9jix25XRw7CLkq4ojqcAgq','Gabrielle','David'),(43,'jacqueline13@duval.net','[\"ROLE_USER\"]','$2y$13$lFcXzFwDosLtpfTRoyF1O.uNrk38mnIY9hvt3thXSIy6qVake2qBW','Matthieu','Langlois'),(44,'anne46@club-internet.fr','[\"ROLE_USER\"]','$2y$13$g.4rVgnf2te3ExLIlsaOxuUuTHvs8lviv7IyIl560Q1hTOItdxSCC','Alexandrie','Charrier'),(45,'huet.marc@gmail.com','[\"ROLE_USER\"]','$2y$13$t7dtt.g.pNjHsujeO3/LeedcDJ/1PpCxB/5CLHXSptE217hzvn6Am','Simone','Roy'),(46,'valentine48@simon.org','[\"ROLE_USER\"]','$2y$13$mKcLhU0npTZ1HCkbLxCIiOx2eBHKPYFTvM7lTS25E55LMCN1tGKy.','Benjamin','Chartier'),(47,'desousa.bertrand@live.com','[\"ROLE_USER\"]','$2y$13$FEAO9dJPMKtMwUUvViudXef/ZZAJWHAIOZ3AuWHo4OAsvqU8.GXbi','Dorothée','Leroux'),(48,'pbenard@humbert.fr','[\"ROLE_USER\"]','$2y$13$/eUSutBMficLKavA8670.u8TWcEu5sLOaEjhAmlJ6yC4yyUpazvXe','Odette','Peltier'),(49,'medecin@studi.fr','[\"ROLE_MEDECIN\"]','$2y$13$bbLYA5bSichp6En2X1WseOAneOXgWeAZVQ0MdQtEEfdLuuTQJUo96','Alexandre','Bigot'),(50,'john.do@test.fr','[\"ROLE_USER\"]','$2y$13$IxLlWWExvg/qIr8zZAtAa.08vnmkBMRjXzs.4qZP4SK6QhUX9oyxW','Olivier','Boutin'),(51,'gilles.giraud@dbmail.com','[\"ROLE_USER\"]','$2y$13$LG9HFdNLWeZ8eitHTKdQAejTyzcAcH11epFuDx6cJ5b2KVlcaUvHe','Raymond','Berger'),(52,'hcosta@lopez.net','[\"ROLE_USER\"]','$2y$13$FFz1b2ZT.Y9XdgR6GI9.ZeewiLqxvESFhXtb9HyVaqchLaruPN9/6','Laure','Launay'),(53,'joseph.perrier@deoliveira.com','[\"ROLE_USER\"]','$2y$13$T9TzND4Jeo.MGx7wqbJWneULQp4Rtjqeey/a96RROY/FFkl5iDLAC','Olivie','Foucher'),(54,'xrenault@hotmail.fr','[\"ROLE_USER\"]','$2y$13$lLNsmP/SKufdeAPg/EG15eJzj9UwACnLsjx9ugEAyrc6917Dphuny','Audrey','Neveu');
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

-- Dump completed on 2024-03-06 17:08:02
