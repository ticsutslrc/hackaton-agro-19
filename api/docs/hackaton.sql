-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.9-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for hackaton19
CREATE DATABASE IF NOT EXISTS `hackaton19` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `hackaton19`;

-- Dumping structure for table hackaton19.jornadas
CREATE TABLE IF NOT EXISTS `jornadas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `referencia` varchar(50) DEFAULT NULL COMMENT 'datos parcela',
  `descripcion` varchar(300) DEFAULT NULL COMMENT 'datos parcela',
  `inicio` datetime DEFAULT NULL,
  `final` datetime DEFAULT NULL,
  `creada` datetime DEFAULT current_timestamp(),
  `idsupervisor` int(11) DEFAULT NULL,
  `idlote` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hackaton19.jornadas_jornaleros
CREATE TABLE IF NOT EXISTS `jornadas_jornaleros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idjornada` int(11) DEFAULT NULL,
  `idjornalero` int(11) DEFAULT NULL,
  `folio_inicial` int(11) DEFAULT NULL,
  `folio_final` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hackaton19.jornaleros
CREATE TABLE IF NOT EXISTS `jornaleros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) NOT NULL,
  `nacimiento` datetime NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hackaton19.jornaleros_contenedores
CREATE TABLE IF NOT EXISTS `jornaleros_contenedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folio` int(11) DEFAULT NULL,
  `completado` datetime DEFAULT NULL,
  `idjornalero` int(11) DEFAULT NULL,
  `idjornada` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hackaton19.lotes
CREATE TABLE IF NOT EXISTS `lotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `referencia` varchar(50) DEFAULT NULL,
  `idjornada` varchar(50) DEFAULT NULL,
  `creada` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hackaton19.supervisores
CREATE TABLE IF NOT EXISTS `supervisores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hackaton19.unidadtrabajo_jornadas
CREATE TABLE IF NOT EXISTS `unidadtrabajo_jornadas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idunidadtrabajo` int(11) DEFAULT NULL,
  `idjornadas` int(11) DEFAULT NULL,
  `creado` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table hackaton19.unidad_trabajo
CREATE TABLE IF NOT EXISTS `unidad_trabajo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `referencia` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `unidad` varchar(50) NOT NULL,
  `inicio` datetime NOT NULL,
  `final` datetime NOT NULL,
  `creada` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
