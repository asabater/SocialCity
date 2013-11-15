-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 15-11-2013 a las 12:52:03
-- Versión del servidor: 5.5.29
-- Versión de PHP: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `DBuser6`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AMIGO`
--

CREATE TABLE IF NOT EXISTS `AMIGO` (
  `ID_AMIGO` int(9) NOT NULL AUTO_INCREMENT,
  `NOM_AMIGO` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID_AMIGO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CIUDAD`
--

CREATE TABLE IF NOT EXISTS `CIUDAD` (
  `ID_CIUDAD` int(9) NOT NULL AUTO_INCREMENT,
  `NOM_CIUDAD` varchar(50) COLLATE utf8_bin NOT NULL,
  `LINK_CIUDAD` varchar(200) COLLATE utf8_bin NOT NULL,
  `COMM_CIUDAD` varchar(300) COLLATE utf8_bin NOT NULL,
  `PAGE_ID_CIUDAD` varchar(10) COLLATE utf8_bin NOT NULL,
  `LIKE_CIUDAD` int(10) NOT NULL,
  PRIMARY KEY (`ID_CIUDAD`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `COMENTARIO`
--

CREATE TABLE IF NOT EXISTS `COMENTARIO` (
  `ID_COMENTARIO` int(9) NOT NULL AUTO_INCREMENT,
  `COM_TEXT` varchar(250) COLLATE utf8_bin NOT NULL,
  `ID_AMIGO` int(9) NOT NULL,
  PRIMARY KEY (`ID_COMENTARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `VISITA`
--

CREATE TABLE IF NOT EXISTS `VISITA` (
  `ID_VISITA` int(9) NOT NULL AUTO_INCREMENT,
  `FECHA_VISITA` date DEFAULT NULL,
  `LIKE_VISITA` int(10) DEFAULT NULL,
  `ID_CIUDAD` int(9) NOT NULL,
  PRIMARY KEY (`ID_VISITA`),
  KEY `FK_CIUDAD_VISITA` (`ID_CIUDAD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `VISITA-AMIGO`
--

CREATE TABLE IF NOT EXISTS `VISITA-AMIGO` (
  `ID_VISITA-AMIGO` int(9) NOT NULL,
  `ID_VISITA` int(9) NOT NULL,
  `ID_AMIGO` int(9) NOT NULL,
  PRIMARY KEY (`ID_VISITA-AMIGO`),
  KEY `ID_VISITA` (`ID_VISITA`),
  KEY `ID_AMIGO` (`ID_AMIGO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `COMENTARIO`
--
ALTER TABLE `COMENTARIO`
  ADD CONSTRAINT `FK_COMENTARIO_AMIGO` FOREIGN KEY (`ID_COMENTARIO`) REFERENCES `AMIGO` (`ID_AMIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `VISITA`
--
ALTER TABLE `VISITA`
  ADD CONSTRAINT `FK_CIUDAD_VISITA` FOREIGN KEY (`ID_CIUDAD`) REFERENCES `CIUDAD` (`ID_CIUDAD`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `VISITA-AMIGO`
--
ALTER TABLE `VISITA-AMIGO`
  ADD CONSTRAINT `visita@002damigo_ibfk_2` FOREIGN KEY (`ID_AMIGO`) REFERENCES `AMIGO` (`ID_AMIGO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visita@002damigo_ibfk_1` FOREIGN KEY (`ID_VISITA`) REFERENCES `VISITA` (`ID_VISITA`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
