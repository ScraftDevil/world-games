-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-05-2016 a las 19:57:41
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `worldgames`
--

--
-- Volcado de datos para la tabla `administrator`
--

INSERT INTO `administrator` (`ID_Administrator`, `Username`, `Password`, `Email`, `BannedTime`, `BirthDate`, `Shop_id_Shop`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', NULL, '2016-05-04', 1);

--
-- Volcado de datos para la tabla `country`
--

INSERT INTO `country` (`ID_Country`, `Name`) VALUES
(1, 'España'),
(2, 'Argentina');

--
-- Volcado de datos para la tabla `game`
--

INSERT INTO `game` (`ID_Game`, `Title`, `Price`, `Stock`) VALUES
(1, 'Grand Theft Auto V ROCKSTAR CD-KEY GLOBAL', 60, 1),
(2, 'Rocket League STEAM CD-KEY GLOBAL', 20, 1);

--
-- Volcado de datos para la tabla `genre`
--

INSERT INTO `genre` (`ID_Genre`, `Name`) VALUES
(1, 'Aventura'),
(2, 'Accion'),
(3, 'Arcade'),
(4, 'RPG');

--
-- Volcado de datos para la tabla `offer`
--

INSERT INTO `offer` (`ID_Offer`, `Discount`) VALUES
(1, 60),
(2, 30);

--
-- Volcado de datos para la tabla `plataform`
--

INSERT INTO `plataform` (`ID_Plataform`, `Name`) VALUES
(1, 'Origin'),
(2, 'Steam'),
(3, 'Xbox'),
(4, 'PSN');

--
-- Volcado de datos para la tabla `shop`
--

INSERT INTO `shop` (`ID_Shop`, `Name`) VALUES
(1, 'WorldGames');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
