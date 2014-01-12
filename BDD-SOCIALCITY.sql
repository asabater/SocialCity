-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-12-2013 a las 17:23:56
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `SocialCityDB`
--
CREATE DATABASE IF NOT EXISTS `SocialCityDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `SocialCityDB`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigo`
--

CREATE TABLE IF NOT EXISTS `amigo` (
  `ID_AMIGO` int(9) NOT NULL AUTO_INCREMENT,
  `NOM_AMIGO` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID_AMIGO`),
  UNIQUE KEY `NOM_AMIGO` (`NOM_AMIGO`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE IF NOT EXISTS `ciudad` (
  `ID_CIUDAD` int(9) NOT NULL AUTO_INCREMENT,
  `NOM_CIUDAD` varchar(50) CHARACTER SET utf8 NOT NULL,
  `LINK_CIUDAD` varchar(200) CHARACTER SET utf8 NOT NULL,
  `COMM_CIUDAD` varchar(300) CHARACTER SET utf8 NOT NULL,
  `PAGE_ID_CIUDAD` varchar(10) CHARACTER SET utf8 NOT NULL,
  `LIKE_CIUDAD` int(10) NOT NULL,
  PRIMARY KEY (`ID_CIUDAD`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`ID_CIUDAD`, `NOM_CIUDAD`, `LINK_CIUDAD`, `COMM_CIUDAD`, `PAGE_ID_CIUDAD`, `LIKE_CIUDAD`) VALUES
(1, 'Madrid', '', '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `ID_COMENTARIO` int(9) NOT NULL AUTO_INCREMENT,
  `COM_TEXT` varchar(250) CHARACTER SET utf8 NOT NULL,
  `ID_AMIGO` int(9) NOT NULL,
  `ID_VISITA` int(9) NOT NULL,
  `COM_LIKEs` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_COMENTARIO`),
  KEY `ID_AMIGO` (`ID_AMIGO`),
  KEY `ID_VISITA` (`ID_VISITA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita`
--

CREATE TABLE IF NOT EXISTS `visita` (
  `ID_VISITA` int(9) NOT NULL AUTO_INCREMENT,
  `FECHA_VISITA` date DEFAULT NULL,
  `LIKE_VISITA` int(5) DEFAULT '0',
  `ID_CIUDAD` int(9) NOT NULL,
  PRIMARY KEY (`ID_VISITA`),
  KEY `FK_CIUDAD_VISITA` (`ID_CIUDAD`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita_amigo`
--

CREATE TABLE IF NOT EXISTS `visita_amigo` (
  `ID_VISITA_AMIGO` int(9) NOT NULL AUTO_INCREMENT,
  `ID_VISITA` int(9) NOT NULL,
  `ID_AMIGO` int(9) NOT NULL,
  PRIMARY KEY (`ID_VISITA_AMIGO`),
  KEY `ID_VISITA` (`ID_VISITA`),
  KEY `ID_AMIGO` (`ID_AMIGO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `FK_COMENTARIO_AMIGO` FOREIGN KEY (`ID_AMIGO`) REFERENCES `amigo` (`ID_AMIGO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_COMENTARIO_VISITA` FOREIGN KEY (`ID_VISITA`) REFERENCES `visita` (`ID_VISITA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `visita`
--
ALTER TABLE `visita`
  ADD CONSTRAINT `FK_CIUDAD_VISITA` FOREIGN KEY (`ID_CIUDAD`) REFERENCES `ciudad` (`ID_CIUDAD`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `visita_amigo`
--
ALTER TABLE `visita_amigo`
  ADD CONSTRAINT `visita_amigo_ibfk_1` FOREIGN KEY (`ID_VISITA`) REFERENCES `visita` (`ID_VISITA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visita_amigo_ibfk_2` FOREIGN KEY (`ID_AMIGO`) REFERENCES `amigo` (`ID_AMIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
