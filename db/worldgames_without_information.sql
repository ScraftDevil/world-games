-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-05-2016 a las 11:58:54
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `worldgames`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrator`
--

CREATE TABLE `administrator` (
  `ID_Administrator` int(11) NOT NULL,
  `Username` char(50) DEFAULT NULL,
  `Password` char(45) DEFAULT NULL,
  `Email` char(45) DEFAULT NULL,
  `BannedTime` float DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `Shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrator_has_report`
--

CREATE TABLE `administrator_has_report` (
  `Report_ID` int(11) NOT NULL,
  `Administrator_ID` int(11) NOT NULL,
  `Registered_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

CREATE TABLE `comment` (
  `ID_Comment` int(11) NOT NULL,
  `Game_ID` int(11) NOT NULL,
  `Text` text,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `complaint`
--

CREATE TABLE `complaint` (
  `ID_Complaint` int(11) NOT NULL,
  `Reason` char(45) DEFAULT NULL,
  `Text` text,
  `Date` datetime DEFAULT NULL,
  `Status` char(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `country`
--

CREATE TABLE `country` (
  `ID_Country` int(11) NOT NULL,
  `Name` char(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `game`
--

CREATE TABLE `game` (
  `ID_Game` int(11) NOT NULL,
  `Title` varchar(45) DEFAULT NULL,
  `Price` float DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL,
  `Platform_ID` int(11) NOT NULL,
  `Offer_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `game_has_complaint`
--

CREATE TABLE `game_has_complaint` (
  `Game_ID` int(11) NOT NULL,
  `Complaint_ID` int(11) NOT NULL,
  `Registered_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `game_has_genre`
--

CREATE TABLE `game_has_genre` (
  `Game_ID` int(11) NOT NULL,
  `Genre_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `game_has_shopping`
--

CREATE TABLE `game_has_shopping` (
  `Game_ID` int(11) NOT NULL,
  `Shopping_ID` int(11) NOT NULL,
  `Registered_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `game_has_valoration`
--

CREATE TABLE `game_has_valoration` (
  `Game_ID` int(11) NOT NULL,
  `Valoration_ID` int(11) NOT NULL,
  `Registered_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genre`
--

CREATE TABLE `genre` (
  `ID_Genre` int(11) NOT NULL,
  `Name` char(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message`
--

CREATE TABLE `message` (
  `ID_Message` int(11) NOT NULL,
  `Content` text,
  `Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `offer`
--

CREATE TABLE `offer` (
  `ID_Offer` int(11) NOT NULL,
  `Discount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platform`
--

CREATE TABLE `platform` (
  `ID_Platform` int(11) NOT NULL,
  `Name` char(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professional`
--

CREATE TABLE `professional` (
  `ID_Professional` int(11) NOT NULL,
  `Username` char(45) DEFAULT NULL,
  `Password` char(45) DEFAULT NULL,
  `Email` char(45) DEFAULT NULL,
  `BannedTime` float DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `Telephone` varchar(45) DEFAULT NULL,
  `Shop_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professional_has_report`
--

CREATE TABLE `professional_has_report` (
  `Professional_ID` int(11) NOT NULL,
  `Report_ID` int(11) NOT NULL,
  `Registered_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registered`
--

CREATE TABLE `registered` (
  `ID_Registered` int(11) NOT NULL,
  `Username` char(45) DEFAULT NULL,
  `Password` char(45) DEFAULT NULL,
  `Email` char(45) DEFAULT NULL,
  `BannedTime` float DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `PaypalAccount` char(70) DEFAULT NULL,
  `AvatarURL` char(70) DEFAULT NULL,
  `Shop_ID` int(11) NOT NULL,
  `Country_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registered_has_comment`
--

CREATE TABLE `registered_has_comment` (
  `Registered_ID` int(11) NOT NULL,
  `Comment_ID` int(11) NOT NULL,
  `Game_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registered_has_game`
--

CREATE TABLE `registered_has_game` (
  `Registered_ID` int(11) NOT NULL,
  `Game_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registered_has_message`
--

CREATE TABLE `registered_has_message` (
  `Registered_ID` int(11) NOT NULL,
  `Receiver_ID` int(11) NOT NULL,
  `Message_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `report`
--

CREATE TABLE `report` (
  `ID_Report` int(11) NOT NULL,
  `Status` char(50) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `Reason` text,
  `Text` text,
  `Registered_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shop`
--

CREATE TABLE `shop` (
  `ID_Shop` int(11) NOT NULL,
  `Name` char(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shopping`
--

CREATE TABLE `shopping` (
  `ID_Shopping` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `TotalPrice` float DEFAULT NULL,
  `Tax` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoration`
--

CREATE TABLE `valoration` (
  `ID_Valoration` int(11) NOT NULL,
  `Valoration` char(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`ID_Administrator`,`Shop_id`),
  ADD KEY `fk_Admistrador_Shop1_idx` (`Shop_id`);

--
-- Indices de la tabla `administrator_has_report`
--
ALTER TABLE `administrator_has_report`
  ADD PRIMARY KEY (`Report_ID`,`Administrator_ID`,`Registered_ID`),
  ADD KEY `fk_Admistrador_has_Report_Report1_idx` (`Report_ID`),
  ADD KEY `fk_Admistrador_has_Report_Admistrador1_idx` (`Administrator_ID`),
  ADD KEY `fk_Admistrador_has_Report_Registered1_idx` (`Registered_ID`);

--
-- Indices de la tabla `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`ID_Comment`,`Game_ID`),
  ADD KEY `fk_Comment_Game1_idx` (`Game_ID`);

--
-- Indices de la tabla `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`ID_Complaint`);

--
-- Indices de la tabla `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`ID_Country`);

--
-- Indices de la tabla `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`ID_Game`,`Platform_ID`,`Offer_ID`) USING BTREE,
  ADD KEY `fk_Game_Plataform1_idx` (`Platform_ID`),
  ADD KEY `fk_Game_Offer1_idx` (`Offer_ID`);

--
-- Indices de la tabla `game_has_complaint`
--
ALTER TABLE `game_has_complaint`
  ADD PRIMARY KEY (`Game_ID`,`Complaint_ID`,`Registered_ID`) USING BTREE,
  ADD KEY `fk_Game_has_Complaint_Complaint1_idx` (`Complaint_ID`),
  ADD KEY `fk_Game_has_Complaint_Game1_idx` (`Game_ID`),
  ADD KEY `fk_Game_has_Complaint_Registered1_idx` (`Registered_ID`) USING BTREE;

--
-- Indices de la tabla `game_has_genre`
--
ALTER TABLE `game_has_genre`
  ADD PRIMARY KEY (`Game_ID`,`Genre_ID`),
  ADD KEY `fk_Game_has_Genre_Genre1_idx` (`Genre_ID`),
  ADD KEY `fk_Game_has_Genre_Game1_idx` (`Game_ID`);

--
-- Indices de la tabla `game_has_shopping`
--
ALTER TABLE `game_has_shopping`
  ADD PRIMARY KEY (`Game_ID`,`Shopping_ID`,`Registered_ID`),
  ADD KEY `fk_Game_has_Shopping_Shopping1_idx` (`Shopping_ID`),
  ADD KEY `fk_Game_has_Shopping_Game1_idx` (`Game_ID`),
  ADD KEY `fk_Game_has_Shopping_Registered1_idx` (`Registered_ID`);

--
-- Indices de la tabla `game_has_valoration`
--
ALTER TABLE `game_has_valoration`
  ADD PRIMARY KEY (`Game_ID`,`Valoration_ID`,`Registered_ID`),
  ADD KEY `fk_Game_has_Valoration_Valoration1_idx` (`Valoration_ID`),
  ADD KEY `fk_Game_has_Valoration_Game1_idx` (`Game_ID`),
  ADD KEY `fk_Game_has_Valoration_Registered1_idx` (`Registered_ID`);

--
-- Indices de la tabla `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`ID_Genre`);

--
-- Indices de la tabla `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`ID_Message`);

--
-- Indices de la tabla `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`ID_Offer`) USING BTREE;

--
-- Indices de la tabla `platform`
--
ALTER TABLE `platform`
  ADD PRIMARY KEY (`ID_Platform`);

--
-- Indices de la tabla `professional`
--
ALTER TABLE `professional`
  ADD PRIMARY KEY (`ID_Professional`,`Shop_ID`),
  ADD KEY `fk_Professional_Shop1_idx` (`Shop_ID`);

--
-- Indices de la tabla `professional_has_report`
--
ALTER TABLE `professional_has_report`
  ADD PRIMARY KEY (`Professional_ID`,`Report_ID`,`Registered_ID`),
  ADD KEY `fk_Professional_has_Report_Report1_idx` (`Report_ID`),
  ADD KEY `fk_Professional_has_Report_Professional1_idx` (`Professional_ID`),
  ADD KEY `fk_Professional_has_Report_Registered1_idx` (`Registered_ID`);

--
-- Indices de la tabla `registered`
--
ALTER TABLE `registered`
  ADD PRIMARY KEY (`ID_Registered`,`Shop_ID`,`Country_ID`),
  ADD KEY `fk_Registered_Shop1_idx` (`Shop_ID`),
  ADD KEY `fk_Registered_Country1_idx` (`Country_ID`);

--
-- Indices de la tabla `registered_has_comment`
--
ALTER TABLE `registered_has_comment`
  ADD PRIMARY KEY (`Registered_ID`,`Comment_ID`,`Game_ID`),
  ADD KEY `fk_Registered_has_Comment_Comment1_idx` (`Comment_ID`),
  ADD KEY `fk_Registered_has_Comment_Registered1_idx` (`Registered_ID`),
  ADD KEY `fk_Registered_has_Comment_Game1_idx` (`Game_ID`);

--
-- Indices de la tabla `registered_has_game`
--
ALTER TABLE `registered_has_game`
  ADD PRIMARY KEY (`Registered_ID`,`Game_ID`),
  ADD KEY `fk_Registered_has_Game_Game1_idx` (`Game_ID`),
  ADD KEY `fk_Registered_has_Game_Registered1_idx` (`Registered_ID`);

--
-- Indices de la tabla `registered_has_message`
--
ALTER TABLE `registered_has_message`
  ADD PRIMARY KEY (`Registered_ID`,`Message_ID`,`Receiver_ID`) USING BTREE,
  ADD KEY `fk_Registered_has_Message_Message1_idx` (`Message_ID`),
  ADD KEY `fk_Registered_has_Message_Registered1_idx` (`Registered_ID`),
  ADD KEY `fk_Registered_has_Message_Receiver1` (`Receiver_ID`) USING BTREE;

--
-- Indices de la tabla `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`ID_Report`,`Registered_ID`),
  ADD KEY `fk_Report_Registered1_idx` (`Registered_ID`);

--
-- Indices de la tabla `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`ID_Shop`);

--
-- Indices de la tabla `shopping`
--
ALTER TABLE `shopping`
  ADD PRIMARY KEY (`ID_Shopping`);

--
-- Indices de la tabla `valoration`
--
ALTER TABLE `valoration`
  ADD PRIMARY KEY (`ID_Valoration`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrator`
--
ALTER TABLE `administrator`
  MODIFY `ID_Administrator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `administrator_has_report`
--
ALTER TABLE `administrator_has_report`
  MODIFY `Report_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `comment`
--
ALTER TABLE `comment`
  MODIFY `ID_Comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `complaint`
--
ALTER TABLE `complaint`
  MODIFY `ID_Complaint` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `country`
--
ALTER TABLE `country`
  MODIFY `ID_Country` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `game`
--
ALTER TABLE `game`
  MODIFY `ID_Game` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `genre`
--
ALTER TABLE `genre`
  MODIFY `ID_Genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `message`
--
ALTER TABLE `message`
  MODIFY `ID_Message` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `offer`
--
ALTER TABLE `offer`
  MODIFY `ID_Offer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `platform`
--
ALTER TABLE `platform`
  MODIFY `ID_Platform` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `professional`
--
ALTER TABLE `professional`
  MODIFY `ID_Professional` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `registered`
--
ALTER TABLE `registered`
  MODIFY `ID_Registered` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `report`
--
ALTER TABLE `report`
  MODIFY `ID_Report` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `shop`
--
ALTER TABLE `shop`
  MODIFY `ID_Shop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `shopping`
--
ALTER TABLE `shopping`
  MODIFY `ID_Shopping` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `valoration`
--
ALTER TABLE `valoration`
  MODIFY `ID_Valoration` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `fk_Admistrador_Shop1` FOREIGN KEY (`Shop_id`) REFERENCES `shop` (`ID_Shop`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `administrator_has_report`
--
ALTER TABLE `administrator_has_report`
  ADD CONSTRAINT `fk_Admistrador_has_Report_Admistrador1` FOREIGN KEY (`Administrator_ID`) REFERENCES `administrator` (`ID_Administrator`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Admistrador_has_Report_Registered1` FOREIGN KEY (`Registered_ID`) REFERENCES `registered` (`ID_Registered`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Admistrador_has_Report_Report1` FOREIGN KEY (`Report_ID`) REFERENCES `report` (`ID_Report`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_Comment_Game1` FOREIGN KEY (`Game_ID`) REFERENCES `game` (`ID_Game`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `fk_Game_Plataform1` FOREIGN KEY (`Platform_ID`) REFERENCES `platform` (`ID_Platform`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `game_has_complaint`
--
ALTER TABLE `game_has_complaint`
  ADD CONSTRAINT `fk_Game_has_Complaint_Complaint1` FOREIGN KEY (`Complaint_ID`) REFERENCES `complaint` (`ID_Complaint`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Game_has_Complaint_Game1` FOREIGN KEY (`Game_ID`) REFERENCES `game` (`ID_Game`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `game_has_genre`
--
ALTER TABLE `game_has_genre`
  ADD CONSTRAINT `fk_Game_has_Genre_Game1` FOREIGN KEY (`Game_ID`) REFERENCES `game` (`ID_Game`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Game_has_Genre_Genre1` FOREIGN KEY (`Genre_ID`) REFERENCES `genre` (`ID_Genre`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `game_has_shopping`
--
ALTER TABLE `game_has_shopping`
  ADD CONSTRAINT `fk_Game_has_Shopping_Game1` FOREIGN KEY (`Game_ID`) REFERENCES `game` (`ID_Game`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Game_has_Shopping_Registered1` FOREIGN KEY (`Registered_ID`) REFERENCES `registered` (`ID_Registered`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Game_has_Shopping_Shopping1` FOREIGN KEY (`Shopping_ID`) REFERENCES `shopping` (`ID_Shopping`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `game_has_valoration`
--
ALTER TABLE `game_has_valoration`
  ADD CONSTRAINT `fk_Game_has_Valoration_Game1` FOREIGN KEY (`Game_ID`) REFERENCES `game` (`ID_Game`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Game_has_Valoration_Registered1` FOREIGN KEY (`Registered_ID`) REFERENCES `registered` (`ID_Registered`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Game_has_Valoration_Valoration1` FOREIGN KEY (`Valoration_ID`) REFERENCES `valoration` (`ID_Valoration`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `professional`
--
ALTER TABLE `professional`
  ADD CONSTRAINT `fk_Professional_Shop1` FOREIGN KEY (`Shop_ID`) REFERENCES `shop` (`ID_Shop`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `professional_has_report`
--
ALTER TABLE `professional_has_report`
  ADD CONSTRAINT `fk_Professional_has_Report_Professional1` FOREIGN KEY (`Professional_ID`) REFERENCES `professional` (`ID_Professional`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Professional_has_Report_Registered1` FOREIGN KEY (`Registered_ID`) REFERENCES `registered` (`ID_Registered`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Professional_has_Report_Report1` FOREIGN KEY (`Report_ID`) REFERENCES `report` (`ID_Report`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `registered`
--
ALTER TABLE `registered`
  ADD CONSTRAINT `fk_Registered_Country1` FOREIGN KEY (`Country_ID`) REFERENCES `country` (`ID_Country`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Registered_Shop1` FOREIGN KEY (`Shop_ID`) REFERENCES `shop` (`ID_Shop`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `registered_has_comment`
--
ALTER TABLE `registered_has_comment`
  ADD CONSTRAINT `fk_Registered_has_Comment_Comment1` FOREIGN KEY (`Comment_ID`) REFERENCES `comment` (`ID_Comment`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Registered_has_Comment_Game1` FOREIGN KEY (`Game_ID`) REFERENCES `game` (`ID_Game`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Registered_has_Comment_Registered1` FOREIGN KEY (`Registered_ID`) REFERENCES `registered` (`ID_Registered`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `registered_has_game`
--
ALTER TABLE `registered_has_game`
  ADD CONSTRAINT `fk_Registered_has_Game_Game1` FOREIGN KEY (`Game_ID`) REFERENCES `game` (`ID_Game`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Registered_has_Game_Registered1` FOREIGN KEY (`Registered_ID`) REFERENCES `registered` (`ID_Registered`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `registered_has_message`
--
ALTER TABLE `registered_has_message`
  ADD CONSTRAINT `fk_Registered_has_Message_Message1` FOREIGN KEY (`Message_ID`) REFERENCES `message` (`ID_Message`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Registered_has_Message_Registered1` FOREIGN KEY (`Registered_ID`) REFERENCES `registered` (`ID_Registered`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `fk_Report_Registered1` FOREIGN KEY (`Registered_ID`) REFERENCES `registered` (`ID_Registered`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
