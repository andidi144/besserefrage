-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 27. Jan 2016 um 21:59
-- Server-Version: 5.6.24
-- PHP-Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `besserefragedb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `antworten`
--

CREATE TABLE IF NOT EXISTS `antworten` (
  `ID` int(11) NOT NULL,
  `Antwort` text NOT NULL,
  `Datum` datetime NOT NULL,
  `UserID` int(11) NOT NULL,
  `FrageID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `antworten`
--

INSERT INTO `antworten` (`ID`, `Antwort`, `Datum`, `UserID`, `FrageID`) VALUES
(1, 'Testantwort', '2016-01-27 21:22:36', 1, 2),
(2, 'LEL', '2016-01-27 21:30:30', 1, 2),
(3, 'fdsafdsa', '2016-01-27 21:30:43', 1, 2),
(4, 'Krass', '2016-01-27 21:34:25', 1, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fragen`
--

CREATE TABLE IF NOT EXISTS `fragen` (
  `ID` int(11) NOT NULL,
  `Titel` text NOT NULL,
  `Text` text NOT NULL,
  `KategorieID` int(11) NOT NULL,
  `Datum` datetime NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `fragen`
--

INSERT INTO `fragen` (`ID`, `Titel`, `Text`, `KategorieID`, `Datum`, `UserId`) VALUES
(2, 'Testtitel', 'Testfrage', 5, '2016-01-27 20:21:21', 1),
(3, 'fdsfdsaf', 'fdsafdsaf', 3, '2016-01-27 20:24:44', 1),
(4, 'ewqrewqrew', 'wqerewqrwq', 3, '2016-01-27 20:24:51', 1),
(5, 'Hilfe!!!!!', 'Hilfe mein Haus brennt', 4, '2016-01-27 21:48:23', 1),
(6, 'Will jemand chatten?', 'Hallo ich bjdkslÃ¶ahf jk sdajkflÃ¶hjsdjkla sdjdkjalfhsdjkalf hsdjkafh jskdafh jsdkh fjsdklaf hjsdkh fjsdkalh fjfksdah fjksdlah fjkdslah jfksdlh fjklsda', 3, '2016-01-27 21:49:30', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menupunkte`
--

CREATE TABLE IF NOT EXISTS `menupunkte` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Link` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `menupunkte`
--

INSERT INTO `menupunkte` (`ID`, `Name`, `Link`) VALUES
(1, 'Home', 'index.php'),
(2, 'Frage stellen!', 'index.php?site=fragestellen');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `startseitekategorien`
--

CREATE TABLE IF NOT EXISTS `startseitekategorien` (
  `ID` int(11) NOT NULL,
  `KategorieName` text NOT NULL,
  `Auswahl` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `startseitekategorien`
--

INSERT INTO `startseitekategorien` (`ID`, `KategorieName`, `Auswahl`) VALUES
(1, 'Neuste Fragen', 0),
(2, 'Unbeantwortete Fragen', 0),
(3, 'Finanzen', 1),
(4, 'Gesundheit', 1),
(5, 'Computer', 1),
(6, 'Ernaehrung', 1),
(7, 'Auto', 1),
(8, 'Beauty', 1),
(9, 'Sport', 1),
(10, 'Technik', 1),
(11, 'Musik', 1),
(12, 'Medizin', 1),
(13, 'Freizeit', 1),
(16, 'Internet', 1),
(100, 'Anderes', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL,
  `Username` text NOT NULL,
  `Password` text NOT NULL,
  `Email` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`ID`, `Username`, `Password`, `Email`) VALUES
(1, 'andidi144', '$2y$10$0FNDvlx8JnU/7Menf0c23uxg61kZrmaNM0y5NPxTPEzbM72dNXC6O', 'adrianbetschart@hotmail.ch');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `antworten`
--
ALTER TABLE `antworten`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `fragen`
--
ALTER TABLE `fragen`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `menupunkte`
--
ALTER TABLE `menupunkte`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `startseitekategorien`
--
ALTER TABLE `startseitekategorien`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `antworten`
--
ALTER TABLE `antworten`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `fragen`
--
ALTER TABLE `fragen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT für Tabelle `menupunkte`
--
ALTER TABLE `menupunkte`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `startseitekategorien`
--
ALTER TABLE `startseitekategorien`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
