SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `banco` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;
USE `banco`;

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido1` varchar(100) NOT NULL,
  `apellido2` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=285 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

CREATE TABLE IF NOT EXISTS `cuentas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `tipo` enum('Cuenta Corriente','Cuenta Ahorros') NOT NULL,
  `saldo` decimal(10,2) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `libreta` tinyint(1) DEFAULT NULL,
  `bonificacion` decimal(10,3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=590 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

CREATE TABLE IF NOT EXISTS `operaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cuenta_id` int(11) NOT NULL,
  `tipo` enum('ingreso','debito') NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cuenta_id` (`cuenta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1797 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;


ALTER TABLE `cuentas`
  ADD CONSTRAINT `cuentas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);

ALTER TABLE `operaciones`
  ADD CONSTRAINT `operaciones_ibfk_1` FOREIGN KEY (`cuenta_id`) REFERENCES `cuentas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
