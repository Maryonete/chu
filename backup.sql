-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 05 mars 2024 à 15:20
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `soignemoi`
--
CREATE DATABASE IF NOT EXISTS `soignemoi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `soignemoi`;

-- --------------------------------------------------------

--
-- Structure de la table `calendar`
--

DROP TABLE IF EXISTS `calendar`;
CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medecin_id` int(11) NOT NULL,
  `stay_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `description` longtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6EA9A146FB3AF7D6` (`stay_id`),
  KEY `IDX_6EA9A1464F31A84` (`medecin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `calendar`
--

INSERT INTO `calendar` (`id`, `medecin_id`, `stay_id`, `title`, `start`, `end`, `description`) VALUES
(1, 11, 41, 'Marianne Rocher', '2024-03-05 09:00:00', '2024-03-12 14:00:00', 'Quibusdam repellendus voluptas voluptatem est.'),
(2, 11, 42, 'Marianne Rocher', '2023-03-05 09:00:00', '2022-04-05 14:00:00', 'Sit tenetur possimus consequatur dicta.'),
(3, 11, 43, 'Marianne Rocher', '2023-05-05 09:00:00', '2022-08-05 14:00:00', 'Nostrum illo distinctio qui nostrum quae.'),
(4, 11, 44, 'Marianne Rocher', '2024-04-05 09:00:00', '2024-05-17 14:00:00', 'Impedit ipsam reprehenderit reprehenderit delectus minima ad in.'),
(5, 11, 45, 'Eugène Nguyen', '2024-03-05 10:00:00', '2024-03-12 15:00:00', 'Reiciendis neque qui placeat est cum debitis ipsam.'),
(6, 11, 46, 'Eugène Nguyen', '2023-03-05 10:00:00', '2022-04-05 15:00:00', 'Aut repellat numquam a autem.'),
(7, 11, 47, 'Eugène Nguyen', '2023-05-05 10:00:00', '2022-08-05 15:00:00', 'Voluptas optio sint in quo veniam mollitia quasi.'),
(8, 11, 48, 'Eugène Nguyen', '2024-04-05 10:00:00', '2024-05-17 15:00:00', 'Qui est incidunt aut et fugiat tempora est.'),
(9, 11, 49, 'Yves Brun', '2024-03-05 11:00:00', '2024-03-12 16:00:00', 'Sequi incidunt quas officia culpa.'),
(10, 11, 50, 'Yves Brun', '2023-03-05 11:00:00', '2022-04-05 16:00:00', 'Quas quasi est rerum libero error dolor et laboriosam.'),
(11, 11, 51, 'Yves Brun', '2023-05-05 11:00:00', '2022-08-05 16:00:00', 'Cupiditate omnis rerum consequatur molestiae qui sed laudantium.'),
(12, 11, 52, 'Yves Brun', '2024-04-05 11:00:00', '2024-05-17 16:00:00', 'Sed nobis consequuntur quas maiores.'),
(13, 11, 53, 'Thibault Gaudin', '2024-03-05 12:00:00', '2024-03-12 17:00:00', 'Eaque debitis cum porro reprehenderit.'),
(14, 11, 54, 'Thibault Gaudin', '2023-03-05 12:00:00', '2022-04-05 17:00:00', 'Illum sit quis natus sunt qui est.'),
(15, 11, 55, 'Thibault Gaudin', '2023-05-05 12:00:00', '2022-08-05 17:00:00', 'Odio consectetur cum nostrum exercitationem.'),
(16, 11, 56, 'Thibault Gaudin', '2024-04-05 12:00:00', '2024-05-17 17:00:00', 'Eius quia quas nam alias ipsam.'),
(17, 11, 57, 'Catherine Regnier', '2024-03-05 13:00:00', '2024-03-12 18:00:00', 'Sed aut amet quia itaque iusto eos.'),
(18, 11, 58, 'Catherine Regnier', '2023-03-05 14:00:00', '2022-04-05 19:00:00', 'Explicabo sint harum aut consectetur porro repudiandae.'),
(19, 11, 59, 'Catherine Regnier', '2023-05-05 14:00:00', '2022-08-05 19:00:00', 'Molestiae cum exercitationem reiciendis quibusdam ullam.'),
(20, 11, 60, 'Catherine Regnier', '2024-04-05 14:00:00', '2024-05-17 19:00:00', 'Mollitia vero quo temporibus aliquid voluptates ipsum sunt.');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240305110913', '2024-03-05 12:09:25', 859);

-- --------------------------------------------------------

--
-- Structure de la table `drugs`
--

DROP TABLE IF EXISTS `drugs`;
CREATE TABLE IF NOT EXISTS `drugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `drugs`
--

INSERT INTO `drugs` (`id`, `name`) VALUES
(1, 'Doliprane'),
(2, 'Peniciline'),
(3, 'Vitamine'),
(4, 'Maalox'),
(5, 'Ibuprofène'),
(6, 'Amoxicilline');

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

DROP TABLE IF EXISTS `medecin`;
CREATE TABLE IF NOT EXISTS `medecin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1BDA53C6A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`id`, `user_id`) VALUES
(1, 2),
(2, 3),
(3, 4),
(4, 5),
(5, 6),
(6, 7),
(7, 8),
(8, 9),
(9, 10),
(10, 11),
(11, 22);

-- --------------------------------------------------------

--
-- Structure de la table `medecin_speciality`
--

DROP TABLE IF EXISTS `medecin_speciality`;
CREATE TABLE IF NOT EXISTS `medecin_speciality` (
  `medecin_id` int(11) NOT NULL,
  `speciality_id` int(11) NOT NULL,
  PRIMARY KEY (`medecin_id`,`speciality_id`),
  KEY `IDX_2B5B6D544F31A84` (`medecin_id`),
  KEY `IDX_2B5B6D543B5A08D7` (`speciality_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `medecin_speciality`
--

INSERT INTO `medecin_speciality` (`medecin_id`, `speciality_id`) VALUES
(1, 1),
(1, 5),
(1, 10),
(1, 14),
(2, 6),
(2, 7),
(2, 10),
(2, 15),
(3, 7),
(3, 9),
(3, 12),
(3, 13),
(4, 12),
(5, 3),
(6, 1),
(6, 11),
(7, 6),
(7, 8),
(7, 10),
(7, 13),
(7, 14),
(8, 1),
(8, 2),
(8, 6),
(8, 11),
(8, 12),
(9, 10),
(9, 12),
(9, 13),
(10, 3),
(10, 15),
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(11, 5),
(11, 6);

-- --------------------------------------------------------

--
-- Structure de la table `medication`
--

DROP TABLE IF EXISTS `medication`;
CREATE TABLE IF NOT EXISTS `medication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `drug_id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `dosage` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5AEE5B70AABCA765` (`drug_id`),
  KEY `IDX_5AEE5B7093DB413D` (`prescription_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `medication`
--

INSERT INTO `medication` (`id`, `drug_id`, `prescription_id`, `dosage`) VALUES
(1, 1, 1, 'Est quis occaecati repellat dolores voluptatem sint similique.'),
(2, 2, 1, 'Nostrum sapiente illum non repellendus sit quia distinctio.'),
(3, 3, 1, 'Ut dolorem omnis voluptatem voluptas perferendis ipsam reprehenderit delectus.'),
(4, 1, 2, 'Nihil exercitationem quae quis modi aut amet aut hic.'),
(5, 2, 2, 'Ea molestias iusto dolores aut impedit aut.'),
(6, 3, 2, 'Voluptas quo aut quia perferendis itaque aut deserunt nostrum.'),
(7, 1, 3, 'Unde aperiam repellat ea sed.'),
(8, 2, 3, 'Iusto voluptatem distinctio dolore id recusandae saepe.'),
(9, 3, 3, 'Temporibus consequatur nemo adipisci alias laudantium corporis.'),
(10, 1, 4, 'Omnis facilis facere reprehenderit dolor assumenda illo qui.'),
(11, 2, 4, 'Reprehenderit dicta odit eligendi quod et nam dolor.'),
(12, 3, 4, 'Modi provident iure saepe natus et nisi.'),
(13, 1, 5, 'Quibusdam ducimus aliquam minima libero vitae placeat.'),
(14, 2, 5, 'Sunt laudantium in id explicabo laudantium voluptatem voluptas.'),
(15, 3, 5, 'Nulla veniam commodi sunt impedit iusto beatae sint.'),
(16, 1, 6, 'Ad et illum blanditiis dolor qui labore.'),
(17, 2, 6, 'Est eos amet sit.'),
(18, 3, 6, 'Eum a dolorem non non non blanditiis.'),
(19, 1, 7, 'Non adipisci iusto dolore eius autem.'),
(20, 2, 7, 'Et excepturi qui et sequi illum blanditiis mollitia harum.'),
(21, 3, 7, 'Ea ducimus et eius nemo fugiat.'),
(22, 1, 8, 'Qui accusamus velit est.'),
(23, 2, 8, 'Dicta veritatis hic nihil.'),
(24, 3, 8, 'Quo est pariatur minus sed excepturi.'),
(25, 1, 9, 'Impedit voluptas ut distinctio nostrum numquam.'),
(26, 2, 9, 'Sed aut dolorem ab.'),
(27, 3, 9, 'Vitae blanditiis quod soluta delectus.'),
(28, 1, 10, 'Quae nobis distinctio totam.'),
(29, 2, 10, 'Eos omnis dolores debitis eos modi earum a.'),
(30, 3, 10, 'Sit iste sequi et cumque vero.'),
(31, 1, 11, 'Corrupti molestiae odio eaque ipsum nostrum est.'),
(32, 2, 11, 'Repellat quos consequatur excepturi voluptas.'),
(33, 3, 11, 'Quaerat consequatur magni deserunt corrupti cumque vel.'),
(34, 1, 12, 'Saepe voluptatem voluptas quo ipsum hic voluptas ut.'),
(35, 2, 12, 'Omnis nemo ipsa ea.'),
(36, 3, 12, 'Perferendis error modi sint sit neque repellat inventore qui.'),
(37, 1, 13, 'Corporis atque ratione doloribus iusto atque suscipit aut.'),
(38, 2, 13, 'Numquam fugit error ipsum doloribus ut facere esse.'),
(39, 3, 13, 'Optio corrupti odit aut.'),
(40, 1, 14, 'Rem temporibus quo qui est molestiae dolorem.'),
(41, 2, 14, 'Consequuntur est et et iure repellat ducimus sed.'),
(42, 3, 14, 'Repellat cum at ea necessitatibus occaecati dolorem eos.'),
(43, 1, 15, 'Odio eos qui repellendus occaecati.'),
(44, 2, 15, 'Aliquid itaque dicta omnis consequatur quibusdam.'),
(45, 3, 15, 'Non dolorum qui vel quia commodi.'),
(46, 1, 16, 'Beatae dolore ea fugit neque.'),
(47, 2, 16, 'Possimus fugit et nam at rerum necessitatibus asperiores.'),
(48, 3, 16, 'Iure magnam accusamus quia vitae cumque odio debitis.'),
(49, 1, 17, 'Libero similique at ea tempora rem nulla.'),
(50, 2, 17, 'Est laudantium voluptatem reiciendis qui atque.'),
(51, 3, 17, 'Inventore inventore et cupiditate ab architecto.'),
(52, 1, 18, 'Eos et inventore incidunt exercitationem explicabo molestiae.'),
(53, 2, 18, 'Officia nam et pariatur.'),
(54, 3, 18, 'Consequatur magni quia impedit voluptatibus non provident.'),
(55, 1, 19, 'Et id adipisci aut ullam delectus iure quia.'),
(56, 2, 19, 'Iste non est iusto voluptatibus voluptatem et sed veritatis.'),
(57, 3, 19, 'Quia omnis et quod modi sit qui ea.'),
(58, 1, 20, 'Et dignissimos numquam repudiandae iusto doloribus.'),
(59, 2, 20, 'Incidunt ut nihil voluptatem.'),
(60, 3, 20, 'A ipsum ipsam quo quia saepe repellat voluptatum.'),
(61, 6, 21, 'fvhh'),
(62, 1, 22, 'ettt');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
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

-- --------------------------------------------------------

--
-- Structure de la table `opinions`
--

DROP TABLE IF EXISTS `opinions`;
CREATE TABLE IF NOT EXISTS `opinions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `medecin_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BEAF78D06B899279` (`patient_id`),
  KEY `IDX_BEAF78D04F31A84` (`medecin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `opinions`
--

INSERT INTO `opinions` (`id`, `patient_id`, `medecin_id`, `title`, `date`, `description`) VALUES
(1, 11, 11, 'Provident quo aut atque.', '2024-03-08', 'Voluptatem velit molestias eos excepturi corrupti. Tenetur pariatur iure quisquam sapiente. Nam tenetur magnam voluptatem et.'),
(2, 11, 11, 'Aut repellat necessitatibus quia ipsam quo pariatur deleniti.', '2024-03-11', 'Vel cum veniam eos mollitia perspiciatis repellat et. Rerum molestiae consequatur et alias nostrum rerum similique laudantium. Suscipit non quasi voluptatem et. Tenetur quis excepturi est exercitationem at eum.'),
(3, 11, 11, 'Magni sunt dolore eum esse.', '2024-03-06', 'Id soluta libero est illo. Quos aut itaque et itaque veniam optio tenetur. Tenetur quis dolores voluptas consectetur unde aut.'),
(4, 11, 11, 'Dignissimos enim deleniti qui officiis atque et molestias cum.', '2024-03-13', 'Ex ea delectus incidunt laborum. Enim qui blanditiis ut vitae sed cumque asperiores. Expedita et in ab. Mollitia sit natus sunt fuga reiciendis.'),
(5, 12, 11, 'Consequuntur laudantium ipsa consequuntur reprehenderit possimus.', '2024-03-09', 'Aut sequi laudantium consectetur. Quia consectetur exercitationem debitis facilis sunt vel. Architecto voluptatem enim molestiae debitis dolorum numquam maiores. Nam quia sint molestias voluptas necessitatibus sunt et.'),
(6, 12, 11, 'Numquam deleniti aspernatur ut.', '2024-03-16', 'Molestiae harum enim aut quia voluptatem voluptatem illo. Laborum quis et totam quia. Exercitationem non libero exercitationem.'),
(7, 12, 11, 'Et facere excepturi voluptatem iusto temporibus.', '2024-03-06', 'Atque veniam accusamus sit iusto saepe dignissimos necessitatibus. Hic et asperiores quis qui voluptatum id aspernatur.'),
(8, 12, 11, 'Voluptatum facilis non et non dolores.', '2024-03-19', 'Ut dicta aut nam expedita dolorem. Consectetur libero error impedit distinctio. Sunt ab dignissimos natus ut mollitia incidunt est.'),
(9, 13, 11, 'Alias perferendis iusto et ipsam tenetur mollitia ex.', '2024-03-08', 'Nulla autem possimus nobis odio. Praesentium illum possimus similique earum. Dicta corporis dignissimos doloremque labore non laborum totam. Quisquam illum optio quia suscipit hic.'),
(10, 13, 11, 'Tempore occaecati quia aliquam autem eius similique eum ad.', '2024-03-13', 'Necessitatibus dignissimos quas officia exercitationem placeat eaque culpa. Perspiciatis vitae deserunt et est et nulla omnis. Eius impedit ex nesciunt iste illum.'),
(11, 13, 11, 'Officia labore rerum qui dolorem et aspernatur corrupti maiores.', '2024-03-13', 'Et reiciendis doloremque aut repudiandae voluptas et omnis. Qui perferendis et aut. Est quo minima voluptatem similique.'),
(12, 13, 11, 'Cupiditate qui accusamus voluptatem debitis odio distinctio at.', '2024-03-09', 'Quo aut velit ut in ex rem. Cumque voluptas quia et eos dolores perferendis libero.'),
(13, 14, 11, 'Ad a eligendi quia.', '2024-03-11', 'Totam ipsum qui esse sint. Laboriosam eveniet totam aperiam dignissimos. Qui nam facilis velit nihil recusandae. Officiis sed tempore velit voluptate consequatur architecto ad necessitatibus.'),
(14, 14, 11, 'Sint ut laborum doloribus iusto eius tempore.', '2024-03-07', 'Autem nesciunt necessitatibus non sint. Ex nam cupiditate fuga et aliquam. Molestias eaque quia culpa placeat dolores voluptatem a officia.'),
(15, 14, 11, 'Et cum fugit non officia ut fugiat.', '2024-03-15', 'Et animi ut debitis ipsum. Quis libero quibusdam nulla laboriosam qui. Cupiditate quidem delectus maiores ea et eos reprehenderit. Minima beatae a quas ipsam aliquid.'),
(16, 14, 11, 'Quia mollitia qui in cumque quidem blanditiis.', '2024-03-10', 'Non iure sed iusto modi voluptatum. A facere aliquam autem id. Ipsum veniam accusamus voluptatibus et quod tempore cum.'),
(17, 15, 11, 'Deserunt tempore at esse quia aliquid rerum magni soluta.', '2024-03-18', 'Molestias vero at autem consequuntur. Et consequatur omnis maiores ex. Sint est et consectetur nisi sed nisi. Sed vel cumque porro error occaecati sed velit.'),
(18, 15, 11, 'Optio consequatur magnam ut.', '2024-03-13', 'Maxime fugiat molestiae magni iste laborum ut facilis nulla. Et vel est consequatur aut. Iste qui accusamus aut fugit. Explicabo ut et molestias doloribus iure.'),
(19, 15, 11, 'Sapiente voluptatem officia explicabo ut eligendi corporis ipsam.', '2024-03-08', 'Provident et est qui. Nam sit hic reiciendis assumenda sunt ut.'),
(20, 15, 11, 'Dolorem perspiciatis magni repudiandae fuga.', '2024-03-19', 'Impedit dolorem aut in omnis quasi. Exercitationem autem accusantium aut iusto mollitia voluptas aliquam assumenda. Sunt est magnam dolore odit rem. Ut atque nemo qui optio.'),
(21, 15, 11, 'xhxhxjfu', '2024-03-05', 'fghhbj tgv yhbbh '),
(22, 15, 11, 'eeree', '2024-03-05', 'gghh'),
(23, 11, 11, 'fggh', '2024-03-05', 'vbjjj'),
(24, 11, 11, 'fghh', '2024-03-05', 'vbjj'),
(25, 11, 11, 'dgg', '2024-03-05', 'ghj');

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `adlibelle` longtext NOT NULL,
  `adcp` varchar(10) NOT NULL,
  `adcity` varchar(100) NOT NULL,
  `adcountry` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D567EE77A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id`, `user_id`, `adlibelle`, `adcp`, `adcity`, `adcountry`) VALUES
(1, 12, '3, boulevard Édouard Thomas', '74988', 'Guichard-sur-Gonzalez', 'FR'),
(2, 13, '60, avenue Tessier', '01338', 'Leroy', 'FR'),
(3, 14, '743, impasse de Morel', '40215', 'Mariedan', 'FR'),
(4, 15, '2, rue Franck Rocher', '68779', 'TraoreVille', 'FR'),
(5, 16, '50, place Maillard', '14593', 'Guilbert-sur-Costa', 'FR'),
(6, 17, '4, impasse Alain Gregoire', '51865', 'Clercnec', 'FR'),
(7, 18, '78, place Julien', '39689', 'Begueboeuf', 'FR'),
(8, 19, 'boulevard de Chevallier', '89177', 'GrondinVille', 'FR'),
(9, 20, '30, rue Olivier Huet', '62823', 'Germain', 'FR'),
(10, 21, '1, place Da Silva', '07103', 'Grondin', 'FR'),
(11, 23, '47, impasse de Perrier', '27558', 'FouquetVille', 'FR'),
(12, 24, 'rue de Diallo', '19761', 'Nguyen-sur-Pelletier', 'FR'),
(13, 25, '274, boulevard Richard', '15927', 'Leduc', 'FR'),
(14, 26, '140, avenue Thibaut Leleu', '91740', 'Jourdandan', 'FR'),
(15, 27, '63, boulevard Leduc', '45327', 'Leger-sur-Jacquot', 'FR');

-- --------------------------------------------------------

--
-- Structure de la table `prescription`
--

DROP TABLE IF EXISTS `prescription`;
CREATE TABLE IF NOT EXISTS `prescription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medecin_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1FBFB8D94F31A84` (`medecin_id`),
  KEY `IDX_1FBFB8D96B899279` (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `prescription`
--

INSERT INTO `prescription` (`id`, `medecin_id`, `patient_id`, `start_date`, `end_date`) VALUES
(1, 11, 11, '2024-03-05', '2024-03-14'),
(2, 11, 11, '2024-03-05', '2024-03-09'),
(3, 11, 11, '2024-03-05', '2024-03-11'),
(4, 11, 11, '2024-03-05', '2024-03-07'),
(5, 11, 12, '2024-03-05', '2024-03-13'),
(6, 11, 12, '2024-03-05', '2024-03-10'),
(7, 11, 12, '2024-03-05', '2024-03-18'),
(8, 11, 12, '2024-03-05', '2024-03-10'),
(9, 11, 13, '2024-03-05', '2024-03-10'),
(10, 11, 13, '2024-03-05', '2024-03-16'),
(11, 11, 13, '2024-03-05', '2024-03-17'),
(12, 11, 13, '2024-03-05', '2024-03-13'),
(13, 11, 14, '2024-03-05', '2024-03-10'),
(14, 11, 14, '2024-03-05', '2024-03-17'),
(15, 11, 14, '2024-03-05', '2024-03-12'),
(16, 11, 14, '2024-03-05', '2024-03-19'),
(17, 11, 15, '2024-03-05', '2024-03-12'),
(18, 11, 15, '2024-03-05', '2024-03-16'),
(19, 11, 15, '2024-03-05', '2024-03-08'),
(20, 11, 15, '2024-03-05', '2024-03-15'),
(21, 11, 11, '2024-03-07', '2024-03-15'),
(22, 11, 11, '2024-03-07', '2024-03-09');

-- --------------------------------------------------------

--
-- Structure de la table `speciality`
--

DROP TABLE IF EXISTS `speciality`;
CREATE TABLE IF NOT EXISTS `speciality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `speciality`
--

INSERT INTO `speciality` (`id`, `name`, `description`) VALUES
(1, 'Biologie', 'Quia ratione veniam quidem id. Qui qui ut doloribus deleniti. Velit sint perferendis qui.\n\nEst beatae dolorem veritatis natus molestiae non aspernatur. Qui quidem est non officia dolor dolore deleniti. Maxime libero provident et. Et pariatur non dolore nemo debitis sed sunt.\n\nQuibusdam aperiam in dolorem enim dolore. Similique ab at recusandae neque ex praesentium voluptates. Ex minus et dicta saepe recusandae necessitatibus itaque. Voluptas facilis quam laboriosam minima est tenetur consequatur. Ratione dolor et saepe unde.\n\nEnim beatae et commodi nemo et. Iure aut distinctio labore necessitatibus dolore quia. Enim sed consequuntur facere tempora sed reprehenderit autem. Animi at maiores consequatur repudiandae est sint.\n\nDolore quo est quam eos aliquid eaque ratione. Fugiat officiis et quia a. Ut ut consequuntur fuga autem error.'),
(2, 'Cardiologie et Maladies Vasculaires', 'Minus est et dicta esse accusantium quibusdam quis corrupti. Distinctio expedita nihil consequatur voluptate molestiae. Ut qui adipisci quia quibusdam aut aperiam. Iste excepturi possimus maiores repudiandae id voluptates quidem.\n\nError et ipsam iusto aut qui temporibus architecto tenetur. Consequatur quia consequuntur sapiente rem aliquam. Quaerat et illo facilis eum est fugit.\n\nExercitationem aut perferendis nam a quos. Et dolore magnam necessitatibus. Non cupiditate nobis porro libero et eius dolor. Natus optio amet voluptatem ducimus voluptas quasi dolores.\n\nAsperiores magnam fugiat perferendis impedit ratione quo. Dolores sequi dolorum molestias velit.\n\nQuasi eos quis aliquam harum praesentium inventore soluta. Facilis velit debitis aut possimus saepe ut dolores esse. Voluptas necessitatibus vitae voluptatibus. Quis rerum esse iure ex praesentium.'),
(3, 'Chirurgie Dentaire', 'Est ab id consequuntur aspernatur. Soluta iure reiciendis mollitia repudiandae fuga. Perspiciatis ea odit qui rem dolorem. Et non sequi est aut.\n\nEt omnis ut recusandae quod. Odit asperiores culpa et aut modi. Fugit quae nostrum aspernatur et enim minima delectus. Placeat unde quaerat vero laborum veniam est.\n\nAperiam est rerum corrupti dolor molestias porro. Corrupti quis et doloremque eius at. Sint ut voluptas enim ullam reiciendis amet.\n\nQuo doloremque ratione ipsam unde aliquam. Aliquid quibusdam maiores corporis rem accusantium pariatur. Neque est delectus non corrupti.\n\nAd ut ut sunt libero distinctio et. Dicta repellendus facilis neque doloremque. Doloribus eaque aut id. Inventore animi qui reprehenderit eligendi.'),
(4, 'Chirurgie Ophtalmologique', 'Nam excepturi omnis facilis aliquam porro quae quos. Aut excepturi blanditiis officiis molestiae quis et repellat dolor. Magni corporis maiores et enim quis nobis voluptatibus. Harum libero nihil ut labore.\n\nExplicabo voluptatem esse tempora iure alias sequi. Asperiores quis perferendis dignissimos sapiente vitae. Delectus explicabo perspiciatis a sunt eum est rerum. Pariatur harum recusandae error at.\n\nQui rerum dignissimos dignissimos sed. Rerum rerum at accusamus nihil occaecati voluptate. Commodi sed non odio laboriosam deserunt. Et qui reprehenderit fugit omnis impedit ipsa.\n\nRepudiandae ad animi sint aut odio. Et sunt optio ea placeat qui. Consectetur eum sunt ipsam. Et quis minus eligendi omnis dolor facere.\n\nEt sunt minus nam dolores enim. Ipsa aliquid ut ab ut dicta. Rem assumenda eligendi laborum alias. Id voluptatem corrupti optio ad porro.'),
(5, 'Chirurgie ORL', 'Quis facere aliquid ex. Quas vero modi et sapiente quidem.\n\nNon est earum eum impedit maiores et magnam. Sed vitae est deleniti ea provident sit voluptas. Magni consectetur consequatur rerum.\n\nOccaecati eligendi et quidem praesentium laborum minus tenetur. Debitis blanditiis nemo aut ullam doloremque. Nisi ut quia magnam exercitationem. Et expedita rerum vel magni hic error.\n\nNecessitatibus quod et provident eos. Rem velit porro odit.\n\nAperiam necessitatibus assumenda rerum qui minus tempora et laudantium. Quia ut dolorem ut ut. Esse accusantium non quia.'),
(6, 'Chirurgie Orthopédique', 'Libero nobis nihil assumenda qui quam ut autem. Esse dolorum voluptatem nemo recusandae tempora nisi sint. Quia non vitae nesciunt eaque aut.\n\nQuis est quisquam temporibus sint. Ut rerum tempore fuga est animi nihil minus est. Consequuntur vitae rem voluptas doloremque ab quas ducimus rerum. Quam quas molestiae eligendi quisquam.\n\nMolestiae eligendi quisquam velit harum et sed atque. Iste dignissimos fuga veniam rerum quam totam explicabo. Quis nemo ea velit reprehenderit iste voluptates recusandae. Laborum enim libero veniam soluta eos voluptas deserunt. Voluptatum possimus quae id et consequatur hic dolorem.\n\nSaepe atque vitae nisi aut placeat culpa. Dignissimos est praesentium et. Facilis adipisci in debitis necessitatibus rem quaerat. Sunt magnam exercitationem odio sequi magnam.\n\nQuasi ex vel porro sequi natus eveniet eveniet rerum. Quia expedita facilis maiores dolor nisi quasi provident. Laudantium velit alias sit non rerum.'),
(7, 'Chirurgie Pédiatrique', 'Quasi culpa alias et sequi temporibus quis. Voluptatem minus quia debitis tenetur rerum ut. Odio rerum aperiam distinctio iste facilis.\n\nInventore architecto dolorem autem voluptatibus. Sapiente illum nam commodi impedit molestias temporibus vitae. Iusto ut quia quasi sint dolore nemo quod.\n\nAut possimus quibusdam blanditiis esse. Magni ut commodi aut eligendi neque sit numquam. Optio quae saepe voluptatum est magni. Amet quae vero neque perspiciatis necessitatibus ipsam. Exercitationem expedita iusto cupiditate nesciunt totam.\n\nUt repudiandae quo et. Voluptatibus neque sed quaerat qui sunt delectus. Laudantium facilis ab natus facilis est nihil. Modi qui consectetur ex laboriosam dolorem.\n\nSimilique aut quo voluptate voluptas. Ut necessitatibus minus quidem officiis. Nesciunt fugiat est asperiores eum voluptatem dolorum.'),
(8, 'Chirurgie Vasculaire', 'Dicta non natus quia cupiditate. Dolorem aut architecto labore unde quidem et. Veritatis nihil et a quos enim. Autem officiis nam odio fugit.\n\nNisi pariatur impedit facilis vero inventore inventore. Error sed perspiciatis et et nesciunt nostrum. Sit minus id sunt.\n\nOccaecati sapiente asperiores dolores odit voluptas laboriosam laudantium quasi. Fuga esse non rerum.\n\nIn dolor et veritatis. Iusto qui optio in assumenda suscipit in qui. Aut maxime aut delectus velit qui. Nisi voluptates fugiat itaque laudantium.\n\nVoluptatem earum est laboriosam harum voluptatem quia. Similique occaecati nihil expedita sit. Esse non minus eligendi fuga quis id eius.'),
(9, 'Gastro-entérologie et proctologie', 'Ipsum et quis nostrum ratione rerum hic beatae. Molestiae facere aut totam accusamus maiores. Et neque perspiciatis hic eius enim. Sint ullam rerum laudantium recusandae nam exercitationem natus.\n\nPerferendis ducimus amet libero consequatur similique. Enim perspiciatis sunt quae eligendi. Sint porro corrupti aut ut aut facilis neque.\n\nCumque optio impedit est ut autem aut animi minus. Quis voluptatem id ad laudantium modi natus. Culpa consequatur ab at hic.\n\nNihil nulla ad maiores deserunt atque aut adipisci. Quibusdam qui quia non sed quisquam.\n\nPariatur est dolorem exercitationem quas. Culpa quis neque maxime itaque rem sed iste. Quis qui eligendi enim. Consequatur veritatis labore labore animi veritatis pariatur.'),
(10, 'Institut du pied', 'Cum praesentium ut atque animi sint minima nesciunt. Ipsum repudiandae voluptatem repellendus illo. Eum maiores dignissimos non eligendi suscipit beatae. Tempore ut commodi qui voluptas eveniet facere facilis.\n\nSapiente atque aut facilis sit quidem iure accusantium deserunt. Et et eum excepturi sit doloribus dolor rem deleniti. Et numquam et nostrum praesentium in culpa.\n\nVel omnis consequatur harum possimus. Omnis corporis autem voluptatem deleniti doloribus animi culpa. Qui voluptatem minus eligendi explicabo. Odio ut omnis placeat eos.\n\nUt minus id alias sed iste. Odit occaecati id odit et officia fugiat. Et cumque aliquam explicabo et cum.\n\nMaiores dolores ad ab neque. Aut unde doloremque eius autem maiores maiores recusandae. A totam at quia impedit sint quis ut distinctio.'),
(11, 'Médecine et Gérontologie', 'Qui velit sunt quia quibusdam velit ex aperiam. Ducimus est facilis ut assumenda reiciendis necessitatibus. Est ut non qui. Ea et sunt fuga et.\n\nIn quibusdam officia rem. Iure est ab quod facilis voluptas neque. Ut suscipit tempora delectus repellendus qui aut. Sunt aut ex accusantium quo.\n\nOmnis sed itaque et. Qui non non totam quos. Sit inventore quidem consequatur qui.\n\nRem excepturi laborum voluptatem at vel aliquam et. Ut harum quia et. Sit illo rerum iusto impedit et enim et.\n\nCulpa dignissimos quia qui animi voluptatibus fugit. Molestiae et labore veniam qui eaque et. Et sed corrupti neque est nulla sint. Aut ut qui iusto vel sit quasi modi.'),
(12, 'Orthopédie', 'Ullam nulla et impedit esse. Aspernatur qui qui dolores et. Perspiciatis ut fuga amet qui. Incidunt quo a in officiis saepe.\n\nQuo adipisci et assumenda est voluptatem. Ut quod exercitationem possimus. Iste qui eos rem aut debitis nisi voluptatem. Placeat eum vitae perferendis vitae earum.\n\nEx quis aut omnis a nemo odio. Nulla aliquam perferendis aut molestias quis sunt id. Sit aliquid ipsum aliquam fugit.\n\nAtque velit ullam nostrum voluptatem laborum hic placeat. Omnis enim autem quam officiis quasi. Eum in aspernatur molestiae dolore nam ex. Minima officiis ad aperiam odit placeat.\n\nEaque unde ut esse distinctio dolores vel. Et vel et iusto in tenetur sunt. Et voluptatem sed architecto dignissimos dicta libero porro veritatis.'),
(13, 'Pneumologie', 'Ut omnis earum consequatur optio id esse illo quo. A accusantium cum nostrum ut est asperiores similique molestiae. Dolores eligendi laborum alias tempora ad assumenda aut.\n\nDoloremque quae praesentium aspernatur illum unde aliquid similique. Ut fuga exercitationem non tempora. Consequatur perferendis dicta non ipsam excepturi et. Vel omnis nobis asperiores explicabo.\n\nRerum voluptas nihil dolorem dolorem non et expedita voluptas. Amet ut earum sunt aliquam non laboriosam perspiciatis. Blanditiis nostrum sed illum sunt est sit. Architecto consectetur in quia ut. Cumque dignissimos sapiente impedit quia.\n\nOmnis eligendi qui iusto sint fugit recusandae et. Ut corrupti et illo tempore reiciendis. Rerum aliquid itaque qui eaque nobis maxime. Totam voluptate reprehenderit iure debitis numquam.\n\nDolores ut error cumque et beatae suscipit animi eum. Doloremque a laborum cumque exercitationem. Iusto neque in impedit quis. Culpa quia ea sit rerum ea.'),
(14, 'Radiologie', 'Aspernatur aut ea ut adipisci ullam et. Numquam aut dolorem sunt optio modi quo quam. Explicabo architecto dignissimos ipsam qui at magni molestiae voluptatem. Temporibus et in magni sed impedit nihil placeat.\n\nEt repellat itaque labore eum. Labore cum esse beatae soluta dicta. Non eos consequatur odit dolores sed occaecati ut.\n\nEnim architecto nihil omnis qui deleniti. Accusamus eligendi culpa ea officia nostrum non inventore. Cumque autem molestiae et veritatis.\n\nQuia quo consequatur cum incidunt repellat sapiente ea. Beatae nulla possimus saepe deleniti aut esse. Qui at et aut debitis.\n\nQuia natus minima vel fugit aut beatae et. Id et officiis vitae culpa odio non est. Velit sapiente quisquam nihil aperiam vero rerum et.'),
(15, 'Urgences Adulte et Enfant', 'Illum rerum adipisci numquam iusto. Laboriosam fugiat quia commodi ipsum. Quo unde reiciendis consequuntur eum nisi veniam. Iure iure magni odit officia fugiat nulla.\n\nError tempora aliquam et inventore quos. Cumque non sed eveniet a. Culpa quia qui dicta laboriosam quia dicta. Ipsa omnis autem quidem ipsa dolores est.\n\nExpedita velit hic sit occaecati. Quos vitae totam incidunt ut quia quia. Mollitia nihil delectus consequatur corporis.\n\nItaque harum similique nulla ullam. Non itaque nemo sapiente eum et. Fuga molestiae ea ipsa voluptas et inventore. Eius odit rerum deserunt officia impedit eaque et.\n\nLabore minus voluptatem culpa delectus ipsa assumenda aliquam. Rem et laborum ullam. Blanditiis recusandae et qui facere nulla. Voluptatibus fuga reprehenderit doloremque sint in aliquid.');

-- --------------------------------------------------------

--
-- Structure de la table `stay`
--

DROP TABLE IF EXISTS `stay`;
CREATE TABLE IF NOT EXISTS `stay` (
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
  KEY `IDX_5E09839C4F31A84` (`medecin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stay`
--

INSERT INTO `stay` (`id`, `speciality_id`, `patient_id`, `medecin_id`, `reason`, `description`, `start_date`, `end_date`, `validate`) VALUES
(1, 10, 1, 7, 'Dolorem expedita sit est totam asperiores laborum.', 'Voluptas id provident qui placeat est qui. Nihil eveniet quisquam veniam quam assumenda tenetur quo. Nihil quas ut consequatur ipsa eum et.', '2024-09-28', '2023-04-08', 1),
(2, 5, 1, 3, 'Occaecati consequatur iusto eius eius quis pariatur.', 'Dolore suscipit rerum enim et ut. Quisquam autem nihil ex maxime impedit rerum et enim. Qui amet suscipit voluptas consequatur in officiis.', '2024-09-14', '2023-09-26', 1),
(3, 5, 1, 6, 'Maxime totam velit quia perspiciatis.', 'Consectetur saepe est ad illo qui commodi facere. Est quasi est sunt nihil quia quia. Ex quis quae et a eos molestiae ipsa.', '2023-03-12', '2024-11-11', 1),
(4, 7, 1, 3, 'Est sed vero voluptatibus quia eum enim.', 'Natus eaque quas perspiciatis optio illo esse pariatur in. Tempora explicabo autem pariatur commodi accusantium fugiat voluptatem repellendus. Velit ut molestiae fugiat deleniti et commodi corrupti. Tempore hic fugiat et soluta suscipit omnis dolores.', '2024-08-07', '2023-05-17', 1),
(5, 8, 2, 2, 'Hic voluptas et exercitationem aliquam aliquid cum.', 'Sunt est aut officiis quibusdam. Ipsum harum ab quia voluptatum alias provident et distinctio. Qui libero facere id. Velit accusantium accusantium quibusdam velit aut.', '2024-12-12', '2024-12-13', 0),
(6, 13, 2, 8, 'Unde dolorum ipsam similique sint ullam.', 'Expedita voluptas qui distinctio officia. Consectetur sunt cumque provident est non excepturi. Cum atque assumenda cupiditate perferendis perferendis consectetur molestias est. Nobis non tenetur velit repudiandae modi aut rerum.', '2024-08-18', '2025-02-21', 0),
(7, 6, 2, 1, 'Eum et dolor voluptatem.', 'Voluptate quod minima dolores earum. Qui hic dolor maiores aut sapiente sint quibusdam. Nobis sit praesentium ut velit ea sunt. Commodi quibusdam nam facere.', '2024-04-09', '2023-09-01', 1),
(8, 14, 2, 4, 'Vitae maiores quasi blanditiis nam voluptas omnis harum.', 'Et corporis dolore eaque eligendi veniam aliquam labore hic. Officiis ut et eveniet architecto rem.', '2023-11-24', '2025-03-03', 1),
(9, 12, 3, 1, 'Sunt voluptas architecto provident at ut nostrum sed.', 'Consectetur consequatur exercitationem esse aut. Quia aspernatur debitis et quo. Et ut est facere aliquam labore fugit. Velit sunt cum magnam culpa.', '2024-11-05', '2023-08-22', 1),
(10, 12, 3, 8, 'Distinctio et et dolorem.', 'Cum est rerum corporis autem ad quaerat. Ut quibusdam et dolores et et repellendus. Vel earum cum nihil voluptas. Aliquam voluptatibus et in quia.', '2025-01-09', '2025-01-31', 0),
(11, 5, 3, 9, 'Ea minima amet molestiae voluptas et.', 'Nemo ad harum dolore deserunt cupiditate. Labore voluptatem officiis pariatur quasi et laboriosam ea. Pariatur aspernatur est eum autem amet. Placeat tenetur et voluptas consequatur nesciunt.', '2023-07-25', '2023-07-29', 1),
(12, 6, 3, 10, 'Illum quidem rem et laborum veniam porro.', 'Aliquam ab modi non quibusdam voluptas nihil et. Qui culpa voluptates sit.', '2023-05-20', '2024-08-17', 1),
(13, 8, 4, 2, 'Ad vitae reprehenderit eius quo dolorem.', 'Necessitatibus porro cum odit rerum unde laboriosam eligendi tempora. Et nisi incidunt quod ab ea nisi dolores ut. Aut quo a dolores et.', '2024-08-15', '2023-04-28', 1),
(14, 4, 4, 4, 'Sint non debitis animi iste voluptas error reprehenderit amet.', 'Non aspernatur veritatis unde. Qui aut esse dolor magni deserunt. Praesentium a a beatae ut id.', '2024-07-28', '2023-09-14', 1),
(15, 8, 4, 7, 'Fuga est velit ad culpa incidunt sit qui consequatur.', 'Molestias iusto consequatur voluptas qui. Autem fugiat nihil natus accusamus quis iste eligendi optio.', '2023-06-04', '2023-05-16', 1),
(16, 14, 4, 5, 'Provident voluptatem similique nostrum consequatur tempore.', 'Libero exercitationem ullam officia optio fuga minima. Quo nam adipisci vero. Dolorum molestiae sint sit recusandae.', '2024-09-25', '2024-07-27', 0),
(17, 13, 5, 5, 'Sed est corrupti itaque.', 'Non ut omnis vitae et. Iure blanditiis sint vitae quis et.', '2024-06-08', '2023-06-18', 1),
(18, 12, 5, 9, 'Architecto quod dolor ratione eius eum.', 'Ratione qui autem beatae ut ab doloremque. Recusandae omnis recusandae suscipit libero necessitatibus et nulla. Minus aut vero quia est magni corporis. Dolor quidem neque aut labore dignissimos repudiandae perspiciatis. Et dolores earum sequi eaque et dolores.', '2024-04-27', '2024-04-27', 0),
(19, 6, 5, 7, 'Sit nesciunt beatae at assumenda.', 'Natus rerum aliquid et consequatur sint. Nobis vel dolorem suscipit placeat quibusdam eum est et. Non ut voluptatum enim aliquid.', '2024-01-01', '2023-08-13', 1),
(20, 5, 5, 7, 'Suscipit velit voluptatem aut sit sunt voluptas quas.', 'Et neque cumque consequatur rerum rerum ad. Veritatis quia dicta repellendus in. Neque temporibus quos autem alias in voluptas.', '2024-04-14', '2023-04-16', 1),
(21, 4, 6, 10, 'Nisi corporis quo culpa explicabo ex ad sed et.', 'Vel quia ea tenetur eaque nulla consequuntur maiores. Dolorem dolorum nulla totam libero odit nihil autem culpa. Aut fuga recusandae modi aliquid. Maiores est unde aliquam autem.', '2025-03-03', '2025-02-18', 0),
(22, 2, 6, 8, 'Rerum voluptatem saepe ab dolorem.', 'Voluptatem ratione officia ipsum incidunt quod et. Rerum exercitationem et temporibus deleniti. Omnis molestiae eveniet itaque ullam et aut. Corporis odio quo distinctio ut et voluptate maxime. Adipisci nemo nemo enim harum omnis consequatur eos.', '2025-02-03', '2024-01-11', 1),
(23, 13, 6, 7, 'Dolorem officia optio et non consequatur.', 'Ratione earum est dolorem ea voluptas. Qui assumenda consequatur ratione nemo sapiente autem. Consequatur voluptate sit non laboriosam molestiae aut veniam voluptates. Ex et consequatur sunt excepturi.', '2023-11-05', '2024-06-27', 1),
(24, 12, 6, 6, 'Excepturi ad consectetur illo.', 'Magni vel consequuntur molestiae maxime nulla quia rerum. Dolores dicta nemo ut qui quia voluptatem. Et est ipsam dolor minima voluptas minima eum. Et consectetur voluptatum aut cupiditate nam sit omnis.', '2024-05-12', '2024-06-28', 0),
(25, 6, 7, 5, 'Vitae rem optio earum hic et voluptas.', 'Qui fuga facere dolor qui dolor modi. Officiis laboriosam accusamus vel corrupti necessitatibus facere. Eos iure aut rerum beatae quis eius. Laboriosam atque aliquam ipsam tempora.', '2024-04-14', '2023-04-26', 1),
(26, 12, 7, 5, 'Et reprehenderit debitis doloremque voluptas suscipit qui ut repellendus.', 'Voluptatum exercitationem ut autem recusandae. Similique enim eligendi quae. Incidunt quibusdam culpa ducimus nihil accusantium illo harum voluptatem. Minima temporibus non vel non consequatur quia.', '2024-07-23', '2024-09-28', 0),
(27, 6, 7, 8, 'Velit sit saepe rem fugiat consequatur est quia.', 'Commodi nemo quasi consequatur inventore iste et excepturi qui. Illum recusandae in qui quibusdam et sit corporis eius. Illo animi aut aut saepe. Similique nemo et in iure veritatis maiores sed.', '2023-08-28', '2023-07-18', 1),
(28, 13, 7, 10, 'Vero quasi illum id nihil vel vel eligendi.', 'Quia iusto sint odio id molestias ipsa. Quia cumque qui consequatur nihil ratione. Ut consequuntur et hic vel voluptates cumque. Quia aut molestiae soluta eius quas et.', '2025-03-03', '2023-05-09', 1),
(29, 4, 8, 9, 'Eum nostrum est voluptatum.', 'Dolores adipisci ut eveniet eius. Et facilis sit dolorum. Dolores iure voluptas omnis id officiis deserunt sed. Non placeat dolor eius quia.', '2024-12-23', '2023-03-07', 1),
(30, 5, 8, 3, 'Dolor voluptas tempore debitis aliquid est odio omnis.', 'Laborum optio sunt libero explicabo et culpa. Id et animi quo deserunt aut consequatur consequatur molestiae. Debitis quam voluptatem voluptas aut rem tempora non. Omnis sequi qui totam qui quisquam illo omnis. Sit qui dolore eos est odio nam.', '2024-08-30', '2023-03-10', 1),
(31, 6, 8, 3, 'Hic quae maiores nemo cum inventore aut vel.', 'Nobis eos incidunt laboriosam ea voluptas atque consequatur. Temporibus harum id aut doloremque et. Molestias qui consequatur omnis.', '2024-11-14', '2023-07-15', 1),
(32, 10, 8, 1, 'Exercitationem aut consequatur inventore at consequatur sed cupiditate.', 'Sequi quia non corporis laudantium. A et sit autem dolor doloremque sit explicabo.', '2023-04-05', '2024-09-02', 1),
(33, 9, 9, 8, 'Quasi eius sed non.', 'Sed qui laudantium modi et ut. Eveniet eos cum officia perferendis debitis ipsam. Eius distinctio pariatur dolorum enim officia asperiores tempore. Consectetur consequatur incidunt sequi voluptatum dolor eos.', '2024-12-14', '2025-02-25', 0),
(34, 6, 9, 4, 'Porro suscipit id eius quaerat.', 'Dolor quidem aspernatur sed fugit doloremque. Aspernatur odio non error quo nostrum deleniti distinctio. Consequatur atque nesciunt sed provident veniam. Tempora cum explicabo vel temporibus officiis vitae.', '2024-11-24', '2024-12-25', 0),
(35, 4, 9, 2, 'Ea voluptas at saepe.', 'Consequatur eos sequi consequuntur sunt ea voluptates ea iure. Id aut sed dolorem iure atque adipisci suscipit. Et aspernatur non sunt. Expedita nihil tempora quasi architecto.', '2024-07-03', '2023-03-12', 1),
(36, 14, 9, 3, 'Rerum expedita tenetur et eos at accusantium.', 'Nihil sint voluptatem laboriosam ipsum rerum. Ut vel autem inventore atque quis est corrupti. Incidunt ducimus odit reprehenderit minima minus. Sit perferendis ut sit quas.', '2025-02-10', '2023-07-18', 1),
(37, 8, 10, 8, 'Officia magnam nemo distinctio dolore cum voluptatem.', 'Nobis voluptatem aperiam nemo qui. Recusandae est ut ratione in placeat deserunt. Possimus ea ipsa atque ea laboriosam et autem. Quae laborum tempora velit sit dolor.', '2024-08-21', '2023-04-14', 1),
(38, 14, 10, 8, 'Cum tenetur voluptas quae vel quidem necessitatibus.', 'Quaerat labore error et iure fugiat sunt. Nemo aut minima quisquam quisquam doloremque nobis. Est optio molestiae qui voluptate.', '2024-08-23', '2025-02-03', 0),
(39, 5, 10, 10, 'Enim sed est cumque.', 'Ut asperiores quia qui ad. Neque culpa et voluptatem et qui et voluptatem. Perferendis est aliquam doloremque voluptas dignissimos.', '2023-11-22', '2023-04-29', 1),
(40, 11, 10, 7, 'Quia vel quod et iure sit et.', 'Aperiam nam quas possimus. Expedita et dicta dolorem perspiciatis amet delectus. In est quibusdam aut.', '2023-03-23', '2024-02-17', 1),
(41, 5, 11, 11, 'Quibusdam repellendus voluptas voluptatem est.', 'Nisi autem quas officia et. Debitis enim commodi debitis id commodi molestiae officiis. Laborum temporibus laborum et maiores. Dolores dolores fugiat molestiae neque nam rerum.', '2024-03-05', '2024-03-12', 1),
(42, 2, 11, 11, 'Sit tenetur possimus consequatur dicta.', 'Eos inventore dolorem ratione id dolores. Ut enim aut est reprehenderit ratione. Est nobis inventore sed ea.', '2023-03-05', '2022-04-05', 0),
(43, 6, 11, 11, 'Nostrum illo distinctio qui nostrum quae.', 'Dolor omnis modi nostrum voluptatem ea voluptatem ut omnis. Officia omnis magni minus sequi tenetur cumque repellendus. Repellendus dolor quo aut officia autem.', '2023-05-05', '2022-08-05', 0),
(44, 2, 11, 11, 'Impedit ipsam reprehenderit reprehenderit delectus minima ad in.', 'Officia rerum ex deserunt deleniti omnis error. Dolorum aut officiis est mollitia exercitationem ad qui id. Voluptates eligendi quia illum voluptatem officia accusantium fugiat. Earum et impedit et voluptatem voluptas nihil.', '2024-04-05', '2024-05-17', 1),
(45, 4, 12, 11, 'Reiciendis neque qui placeat est cum debitis ipsam.', 'Nihil omnis accusamus iure delectus quis odio consectetur velit. Odio officia est voluptates molestias illo reprehenderit commodi. Quia dolores et deleniti modi necessitatibus molestias. Distinctio recusandae labore iure.', '2024-03-05', '2024-03-12', 1),
(46, 6, 12, 11, 'Aut repellat numquam a autem.', 'Tempore numquam eius cumque velit et voluptatem. Ipsa asperiores voluptatem et corporis. Quia molestiae iusto autem beatae totam non.', '2023-03-05', '2022-04-05', 0),
(47, 1, 12, 11, 'Voluptas optio sint in quo veniam mollitia quasi.', 'Repellat nesciunt reiciendis recusandae delectus eligendi tenetur voluptatem. Possimus modi sit aut voluptatem iste dolor eos. Provident quidem soluta non reprehenderit beatae explicabo eligendi.', '2023-05-05', '2022-08-05', 0),
(48, 6, 12, 11, 'Qui est incidunt aut et fugiat tempora est.', 'Qui sit ea tenetur. Id doloremque nisi beatae quia. Deleniti voluptates facere officiis aut exercitationem maxime.', '2024-04-05', '2024-05-17', 1),
(49, 5, 13, 11, 'Sequi incidunt quas officia culpa.', 'Ipsum repellat distinctio cumque nihil. Asperiores aliquam delectus magni est in sint consectetur. Ut eligendi aliquid nesciunt qui id. Tempore quisquam perspiciatis vitae doloremque ut iusto dignissimos. Ipsam molestiae qui natus fugiat vitae.', '2024-03-05', '2024-03-12', 1),
(50, 3, 13, 11, 'Quas quasi est rerum libero error dolor et laboriosam.', 'Labore iusto expedita facilis fugiat quo. Optio hic quasi et quis consectetur. Accusantium qui itaque quia.', '2023-03-05', '2022-04-05', 0),
(51, 2, 13, 11, 'Cupiditate omnis rerum consequatur molestiae qui sed laudantium.', 'Ut consectetur fugiat nesciunt facere laborum enim laboriosam. Ipsam sint vitae odio sint dolores corporis commodi. Qui sed rerum nobis ut ut.', '2023-05-05', '2022-08-05', 0),
(52, 4, 13, 11, 'Sed nobis consequuntur quas maiores.', 'Deserunt ut excepturi eaque libero soluta aliquid vel. Quod sapiente qui voluptatem. Vitae et non fugit voluptatem sequi.', '2024-04-05', '2024-05-17', 1),
(53, 4, 14, 11, 'Eaque debitis cum porro reprehenderit.', 'Est illum labore impedit laborum dicta recusandae quasi et. Quo nulla ipsam et et id commodi. Beatae dolores non et voluptate aliquid. Corrupti nesciunt numquam ipsum pariatur dolores sequi.', '2024-03-05', '2024-03-12', 1),
(54, 2, 14, 11, 'Illum sit quis natus sunt qui est.', 'Ipsam modi ut sunt et voluptate natus. Unde autem dicta accusantium ratione maiores. Nihil sit incidunt ducimus eaque nihil voluptatibus. Eum doloremque doloribus numquam occaecati excepturi itaque tempora.', '2023-03-05', '2022-04-05', 0),
(55, 6, 14, 11, 'Odio consectetur cum nostrum exercitationem.', 'Qui officiis sit in voluptates aspernatur. Nemo rem pariatur sapiente ea.', '2023-05-05', '2022-08-05', 0),
(56, 5, 14, 11, 'Eius quia quas nam alias ipsam.', 'Eos veritatis aut saepe molestias quo quidem molestias. Quo laboriosam molestiae et molestias. Ducimus deleniti aspernatur non sequi consequatur. Est distinctio debitis impedit quos qui ad et.', '2024-04-05', '2024-05-17', 1),
(57, 2, 15, 11, 'Sed aut amet quia itaque iusto eos.', 'Dolorem vero dolores quia. Aut dolores commodi recusandae voluptate ipsam amet quia.', '2024-03-05', '2024-03-12', 1),
(58, 4, 15, 11, 'Explicabo sint harum aut consectetur porro repudiandae.', 'Omnis amet praesentium provident esse. Rerum labore quis est fugiat laboriosam.', '2023-03-05', '2022-04-05', 0),
(59, 5, 15, 11, 'Molestiae cum exercitationem reiciendis quibusdam ullam.', 'Vero voluptatem quas repellendus qui sit officiis dolor. Nihil et aut velit tempore vel.', '2023-05-05', '2022-08-05', 0),
(60, 6, 15, 11, 'Mollitia vero quo temporibus aliquid voluptates ipsum sunt.', 'Occaecati sit tenetur non non dicta vitae pariatur. Ipsa vel enim illo similique enim assumenda et quae.', '2024-04-05', '2024-05-17', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`) VALUES
(1, 'admin@studi.fr', '[\"ROLE_ADMIN\"]', '$2y$13$WiAYXk8m36F3nQQo5qoyOOvrf77GHgJOJnbOt31oW3IAKNS6k30jO', 'Admin', 'Admin'),
(2, 'bbodin@hotmail.fr', '[\"ROLE_MEDECIN\"]', '$2y$13$MR4vZ6nfmqJaKlkM7i2XueU.lfdtziXHb2X4yweimj2x99SdI/ahm', 'Mathilde', 'Lejeune'),
(3, 'thomas11@orange.fr', '[\"ROLE_MEDECIN\"]', '$2y$13$b0v6i2WUfbSxUanI.SCrJengDUJUUE4cYcYVL0HxAx9iF3HeuSvhq', 'Dominique', 'Gillet'),
(4, 'patricia84@techer.fr', '[\"ROLE_MEDECIN\"]', '$2y$13$19pUo5jAEqlncUzSph0mlOoMjuszzhWQ.EFJqodLDuBQAY7RonKJK', 'Franck', 'Riou'),
(5, 'marc.rousset@dbmail.com', '[\"ROLE_MEDECIN\"]', '$2y$13$VgSjsQo8WPyl1B/J0GKCmuNryctVHql3LGi51b4DW5WL31N5wjCD6', 'Adrien', 'David'),
(6, 'olivier99@tele2.fr', '[\"ROLE_MEDECIN\"]', '$2y$13$Tu8ivwuuXh6JOpJq8ksuNeMf5cMKgb6vdFbMg586qK4txm6lvclba', 'Michelle', 'Chauvet'),
(7, 'marine81@henry.fr', '[\"ROLE_MEDECIN\"]', '$2y$13$/iAf8cntfAb7zRvSuCMvBOR0noJ3jNdtz3t9x6lrChBg4ep9xIp/C', 'Margot', 'Giraud'),
(8, 'margot.fontaine@benoit.com', '[\"ROLE_MEDECIN\"]', '$2y$13$7OxOliIsBHQB.kw0revxVednki6PCs5UVJhg2q5Upiv5FDnpTmlJy', 'Marine', 'Noel'),
(9, 'timothee14@orange.fr', '[\"ROLE_MEDECIN\"]', '$2y$13$/p2MaOOcoWzSovfaLD6g0eHdVB9idrQzj/WHfbK8mNWMPuU8ixRyK', 'Patrick', 'Lacombe'),
(10, 'chuet@gonzalez.com', '[\"ROLE_MEDECIN\"]', '$2y$13$1f3j7g6cVt5U53m7blF0aeQ6Iif/YgVXhapG6MdFblGY0ZjwYgeFG', 'Marine', 'Leclerc'),
(11, 'chauvin.veronique@godard.fr', '[\"ROLE_MEDECIN\"]', '$2y$13$7Uha87eh3751Iee9nFxpVOcnrah6m1rEcmMGBaqKtolln3L54m5zq', 'Luc', 'Toussaint'),
(12, 'garcia.manon@club-internet.fr', '[\"ROLE_USER\"]', '$2y$13$i3M90duFWsx0eI.VfSv9ouNauUlkVmOQYBFMNGBlCKddxL6fPwHlG', 'Michelle', 'Delaunay'),
(13, 'bernard.pons@regnier.com', '[\"ROLE_USER\"]', '$2y$13$Hd0WwOmLQukbW6U9JjGbuerYzeaomMIbhik64XKiwYnYRLkrCal16', 'Gilles', 'Marion'),
(14, 'philippe19@letellier.net', '[\"ROLE_USER\"]', '$2y$13$vB939JZndfnIK52bXurc6eBkEoP3frVPpdKqLZiq80/wIRPNtSmYu', 'Michelle', 'Charrier'),
(15, 'ppottier@sfr.fr', '[\"ROLE_USER\"]', '$2y$13$VHbFP.N8zWJqM2KPSjgxlOQAPzXJARmI9yD0XLluk12scalziZ07G', 'Henri', 'Evrard'),
(16, 'lenoir.andree@lebrun.org', '[\"ROLE_USER\"]', '$2y$13$TI/Guiw8VVv3xLOoVZSUPu2tAZ1rqkXgKJe8baxiDtGRqxAAQD98i', 'Juliette', 'Henry'),
(17, 'arnaude.dacosta@noos.fr', '[\"ROLE_USER\"]', '$2y$13$264vznYGon.csMQzOatWPuw9tdHs3V2ruKKfoUubnij8/Fybl61O6', 'Marine', 'Sanchez'),
(18, 'lcoulon@dupre.com', '[\"ROLE_USER\"]', '$2y$13$JLFrhHWfohpqhgjAgTse/ea7l1K4e8gdVyll8RB9siSXEdGUp9bxW', 'Aimé', 'Pierre'),
(19, 'martins.audrey@dubois.fr', '[\"ROLE_USER\"]', '$2y$13$X3uSxJvNiQXwVOch/ZfFiO64kkjP6/92EJxCrK5.2AJGuUUPdoSHy', 'Matthieu', 'Leclercq'),
(20, 'uhamel@gaillard.net', '[\"ROLE_USER\"]', '$2y$13$PDNo9LRkMDtOU02AmmeEFu5D/TgwBpPhDWPXIO4mOkrSc2vgUMqZq', 'Brigitte', 'Wagner'),
(21, 'bodin.marcelle@dbmail.com', '[\"ROLE_USER\"]', '$2y$13$F/RC40Sgo0GnmwGBiyv2L.S73dMQwoMQrslBc5xoEsZEznq1fDHv.', 'Gilles', 'Simon'),
(22, 'medecin@studi.fr', '[\"ROLE_MEDECIN\"]', '$2y$13$TLHgRCX1CJdxjSuV3zQVuuQ.5yjYAZ997csAhyIQswljWkdQr.Csa', 'René', 'Grenier'),
(23, 'john.do@test.fr', '[\"ROLE_USER\"]', '$2y$13$kX728nv6jyoOAe4PXwQVgu4TnUx4lvdCt7e6hXxn7o5Xg/B21.OcG', 'Marianne', 'Rocher'),
(24, 'idelattre@hotmail.fr', '[\"ROLE_USER\"]', '$2y$13$oC16//S/u0E2bWsQArKXO.1RRrf5PLBrhZMTCmQLlnnCd.wmusnEy', 'Eugène', 'Nguyen'),
(25, 'peltier.raymond@laposte.net', '[\"ROLE_USER\"]', '$2y$13$mcV/nja3uCRyEuoYpNJwcewcSzkhCHfacb55RndMk8mMRkT2ITox6', 'Yves', 'Brun'),
(26, 'lucie.imbert@gmail.com', '[\"ROLE_USER\"]', '$2y$13$pQ1palT7LqRAXF46ek9qJOsqZN2zvTyXN09tGqx7/xIt1yhseLUwm', 'Thibault', 'Gaudin'),
(27, 'zgillet@robin.fr', '[\"ROLE_USER\"]', '$2y$13$tqDf7HLY04EoXy5ScnTvpuyQh7w8hQNNF0C66.nCey2y/CQ7Zvmmy', 'Catherine', 'Regnier');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `calendar`
--
ALTER TABLE `calendar`
  ADD CONSTRAINT `FK_6EA9A1464F31A84` FOREIGN KEY (`medecin_id`) REFERENCES `medecin` (`id`),
  ADD CONSTRAINT `FK_6EA9A146FB3AF7D6` FOREIGN KEY (`stay_id`) REFERENCES `stay` (`id`);

--
-- Contraintes pour la table `medecin`
--
ALTER TABLE `medecin`
  ADD CONSTRAINT `FK_1BDA53C6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `medecin_speciality`
--
ALTER TABLE `medecin_speciality`
  ADD CONSTRAINT `FK_2B5B6D543B5A08D7` FOREIGN KEY (`speciality_id`) REFERENCES `speciality` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2B5B6D544F31A84` FOREIGN KEY (`medecin_id`) REFERENCES `medecin` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `medication`
--
ALTER TABLE `medication`
  ADD CONSTRAINT `FK_5AEE5B7093DB413D` FOREIGN KEY (`prescription_id`) REFERENCES `prescription` (`id`),
  ADD CONSTRAINT `FK_5AEE5B70AABCA765` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`);

--
-- Contraintes pour la table `opinions`
--
ALTER TABLE `opinions`
  ADD CONSTRAINT `FK_BEAF78D04F31A84` FOREIGN KEY (`medecin_id`) REFERENCES `medecin` (`id`),
  ADD CONSTRAINT `FK_BEAF78D06B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`);

--
-- Contraintes pour la table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `FK_D567EE77A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `FK_1FBFB8D94F31A84` FOREIGN KEY (`medecin_id`) REFERENCES `medecin` (`id`),
  ADD CONSTRAINT `FK_1FBFB8D96B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`);

--
-- Contraintes pour la table `stay`
--
ALTER TABLE `stay`
  ADD CONSTRAINT `FK_5E09839C3B5A08D7` FOREIGN KEY (`speciality_id`) REFERENCES `speciality` (`id`),
  ADD CONSTRAINT `FK_5E09839C4F31A84` FOREIGN KEY (`medecin_id`) REFERENCES `medecin` (`id`),
  ADD CONSTRAINT `FK_5E09839C6B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
