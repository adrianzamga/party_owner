-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2023 a las 03:09:20
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_party_owner`
--
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `invitados`
--
CREATE TABLE
  `invitados` (
    `idInvitado` varchar(50) NOT NULL,
    `nombreInvitado` varchar(50) NOT NULL,
    `telefonoInvitado` varchar(12) NOT NULL,
    `idInvitacion` varchar(10) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--
--
-- Indices de la tabla `invitados`
--
ALTER TABLE `invitados` ADD PRIMARY KEY (`idInvitado` (5));

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER TABLE `invitados` ADD CONSTRAINT `fk_invitacion` FOREIGN KEY (`idInvitacion`) REFERENCES `invitacion` (`idInvitacion`) ON DELETE RESTRICT ON UPDATE RESTRICT;