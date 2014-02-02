-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 02-02-2014 a las 12:42:33
-- Versión del servidor: 5.5.25
-- Versión de PHP: 5.3.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `SocialCityDB`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigo`
--

CREATE TABLE `amigo` (
  `ID_AMIGO` int(9) NOT NULL AUTO_INCREMENT,
  `NOM_AMIGO` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID_AMIGO`),
  UNIQUE KEY `NOM_AMIGO` (`NOM_AMIGO`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `amigo`
--

INSERT INTO `amigo` (`ID_AMIGO`, `NOM_AMIGO`) VALUES
(3, 'Jaime'),
(4, 'Joan'),
(2, 'Juan'),
(1, 'Pedro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `ID_CIUDAD` int(9) NOT NULL AUTO_INCREMENT,
  `NOM_CIUDAD` varchar(50) CHARACTER SET utf8 NOT NULL,
  `LINK_CIUDAD` varchar(200) CHARACTER SET utf8 NOT NULL,
  `COMM_CIUDAD` varchar(300) CHARACTER SET utf8 NOT NULL,
  `PAGE_ID_CIUDAD` varchar(10) CHARACTER SET utf8 NOT NULL,
  `LIKE_CIUDAD` int(10) NOT NULL,
  PRIMARY KEY (`ID_CIUDAD`),
  UNIQUE KEY `NOM_CIUDAD` (`NOM_CIUDAD`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`ID_CIUDAD`, `NOM_CIUDAD`, `LINK_CIUDAD`, `COMM_CIUDAD`, `PAGE_ID_CIUDAD`, `LIKE_CIUDAD`) VALUES
(1, 'Madrid', 'http://es.wikipedia.org/wiki/Madrid', 'Vaya mierda ciudad', '', -1),
(2, 'Barcelona', 'http', 'Es bona si la bossa sona', '1234', 10),
(3, 'Maracaibo', 'http://es.wikipedia.org/wiki/Maracaibo', 'Maracaibo es una ciudad que goza de un clima ideal, altas temperaturas todo el año. Las marabinas son muy simpáticas y  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tristique sapien dolor, sed consequat ante convallis sagittis. Phasellus convallis elit eu porta tincidunt. Curab', 'PageId', 99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `ID_COMENTARIO` int(9) NOT NULL AUTO_INCREMENT,
  `COM_TEXT` varchar(250) CHARACTER SET utf8 NOT NULL,
  `ID_AMIGO` int(9) NOT NULL,
  `ID_VISITA` int(9) NOT NULL,
  `FECHA_COMENTARIO` datetime DEFAULT NULL,
  `COM_LIKEs` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_COMENTARIO`),
  KEY `ID_AMIGO` (`ID_AMIGO`),
  KEY `ID_VISITA` (`ID_VISITA`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`ID_COMENTARIO`, `COM_TEXT`, `ID_AMIGO`, `ID_VISITA`, `FECHA_COMENTARIO`, `COM_LIKEs`) VALUES
(1, 'Vaya rollo de ciudad', 2, 1, '2014-01-21 00:00:00', 8),
(2, 'No saben tirar cañas en esta ciudad', 1, 2, '2014-02-20 00:00:00', 99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita`
--

CREATE TABLE `visita` (
  `ID_VISITA` int(9) NOT NULL AUTO_INCREMENT,
  `DESC_VISITA` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `FECHA_VISITA` datetime DEFAULT NULL,
  `LIKE_VISITA` int(5) DEFAULT '0',
  `ID_CIUDAD` int(9) NOT NULL,
  PRIMARY KEY (`ID_VISITA`),
  KEY `FK_CIUDAD_VISITA` (`ID_CIUDAD`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `visita`
--

INSERT INTO `visita` (`ID_VISITA`, `DESC_VISITA`, `FECHA_VISITA`, `LIKE_VISITA`, `ID_CIUDAD`) VALUES
(1, NULL, '2014-01-12 00:00:00', 14, 1),
(2, NULL, '2014-01-05 00:00:00', 11, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita_amigo`
--

CREATE TABLE `visita_amigo` (
  `ID_VISITA_AMIGO` int(9) NOT NULL AUTO_INCREMENT,
  `ID_VISITA` int(9) NOT NULL,
  `ID_AMIGO` int(9) NOT NULL,
  PRIMARY KEY (`ID_VISITA_AMIGO`),
  KEY `ID_VISITA` (`ID_VISITA`),
  KEY `ID_AMIGO` (`ID_AMIGO`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `visita_amigo`
--

INSERT INTO `visita_amigo` (`ID_VISITA_AMIGO`, `ID_VISITA`, `ID_AMIGO`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 2, 1);

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
