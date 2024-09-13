-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-09-2024 a las 05:12:21
-- Versión del servidor: 8.2.0
-- Versión de PHP: 8.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `platform_appoinments`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `appoinments`
--

DROP TABLE IF EXISTS `appoinments`;
CREATE TABLE IF NOT EXISTS `appoinments` (
  `id_appoinment` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `date_appointment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_appoinment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id_company` int NOT NULL AUTO_INCREMENT,
  `name_company` varchar(50) DEFAULT NULL,
  `contact_company` varchar(50) DEFAULT NULL,
  `email_company` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_company`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `name_user` varchar(50) DEFAULT NULL,
  `email_user` varchar(100) DEFAULT NULL,
  `phone_user` varchar(50) DEFAULT NULL,
  `photo_user` longblob,
  `password_user` varchar(255) DEFAULT NULL,
  `company_user` int NOT NULL,
  `type_user` int NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `FK_User_Type` (`type_user`),
  KEY `FK_Company_Name` (`company_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_type`
--

DROP TABLE IF EXISTS `users_type`;
CREATE TABLE IF NOT EXISTS `users_type` (
  `id_type` int NOT NULL AUTO_INCREMENT,
  `name_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_Company_Name` FOREIGN KEY (`company_user`) REFERENCES `company` (`id_company`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_User_Type` FOREIGN KEY (`type_user`) REFERENCES `users_type` (`id_type`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
