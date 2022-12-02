-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour mayssem_medical
CREATE DATABASE IF NOT EXISTS `medical` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `medical`;

-- Listage de la structure de la table mayssem_medical. fiches
CREATE TABLE IF NOT EXISTS `fiches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medecin_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `joined_at` date DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `note_medecin` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table mayssem_medical.fiches : ~0 rows (environ)
/*!40000 ALTER TABLE `fiches` DISABLE KEYS */;
/*!40000 ALTER TABLE `fiches` ENABLE KEYS */;

-- Listage de la structure de la table mayssem_medical. medecins
CREATE TABLE IF NOT EXISTS `medecins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table mayssem_medical.medecins : ~0 rows (environ)
/*!40000 ALTER TABLE `medecins` DISABLE KEYS */;
/*!40000 ALTER TABLE `medecins` ENABLE KEYS */;

-- Listage de la structure de la table mayssem_medical. patients
CREATE TABLE IF NOT EXISTS `patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_prenom` varchar(255) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `sexe` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table mayssem_medical.patients : ~7 rows (environ)
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;

-- Listage de la structure de la table mayssem_medical. personnels
CREATE TABLE IF NOT EXISTS `personnels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table mayssem_medical.personnels : ~4 rows (environ)
/*!40000 ALTER TABLE `personnels` DISABLE KEYS */;
/*!40000 ALTER TABLE `personnels` ENABLE KEYS */;

-- Listage de la structure de la table mayssem_medical. services
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_service` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Listage des données de la table mayssem_medical.services : ~4 rows (environ)
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` (`id`, `nom_service`, `description`) VALUES
	(1, 'Cardiologie', 'cardiologie'),
	(2, 'Dermatologie', 'dermatologie'),
	(3, 'medecine generale', NULL),
	(4, 'radiologie', 'radiologie'),
	(5, 'pneumologie', 'pneumologie');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
