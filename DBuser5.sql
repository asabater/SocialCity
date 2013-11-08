-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-11-2013 a las 20:03:59
-- Versión del servidor: 5.5.29
-- Versión de PHP: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `DBuser5`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CIUDAD`
--

CREATE TABLE IF NOT EXISTS `CIUDAD` (
  `ID_CIUDAD` int(9) NOT NULL AUTO_INCREMENT,
  `NOM_CIUDAD` varchar(10) NOT NULL,
  `LINK_CIUDAD` varchar(10) NOT NULL,
  `COMM_CIUDAD` varchar(300) NOT NULL,
  `PAGE_ID_CIUDAD` varchar(10) NOT NULL,
  `LIKE_CIUDAD` int(10) NOT NULL,
  PRIMARY KEY (`ID_CIUDAD`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `CIUDAD`
--

INSERT INTO `CIUDAD` (`ID_CIUDAD`, `NOM_CIUDAD`, `LINK_CIUDAD`, `COMM_CIUDAD`, `PAGE_ID_CIUDAD`, `LIKE_CIUDAD`) VALUES
(1, 'Madrid', '', '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `VISITA`
--

CREATE TABLE IF NOT EXISTS `VISITA` (
  `ID_VISITA` int(10) NOT NULL AUTO_INCREMENT,
  `FECHA_VISITA` date DEFAULT NULL,
  `LIKE_VISITA` int(10) DEFAULT NULL,
  PRIMARY KEY (`ID_VISITA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
