-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 12 mei 2022 om 16:40
-- Serverversie: 5.7.36
-- PHP-versie: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-p4`
--
CREATE DATABASE IF NOT EXISTS `project-p4` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `project-p4`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `chatID` int(11) NOT NULL,
  `FromUserID` int(11) NOT NULL,
  `ToUserID` int(11) NOT NULL,
  `Message` varchar(2500) NOT NULL,
  UNIQUE KEY `chatID` (`chatID`),
  KEY `FromUserID` (`FromUserID`),
  KEY `ToUserID` (`ToUserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `chat`
--

INSERT INTO `chat` (`chatID`, `FromUserID`, `ToUserID`, `Message`) VALUES
(1, 1, 2, 'hihihiha');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `userprofile`
--

DROP TABLE IF EXISTS `userprofile`;
CREATE TABLE IF NOT EXISTS `userprofile` (
  `userID` int(11) NOT NULL,
  `profilePicture` varchar(500) DEFAULT NULL,
  `bio` varchar(2500) DEFAULT NULL,
  `backGroundImage` varchar(500) DEFAULT NULL,
  UNIQUE KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `userprofile`
--

INSERT INTO `userprofile` (`userID`, `profilePicture`, `bio`, `backGroundImage`) VALUES
(1, 'test', NULL, NULL),
(5, '', ' ', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `age` int(3) NOT NULL,
  `userrole` enum('root','admin','user','') NOT NULL DEFAULT 'user',
  `firstLogin` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`userID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `age`, `userrole`, `firstLogin`) VALUES
(1, 'admin', '$2y$10$UTdE/ZW40odlIgA601Om5uB68XH9aZzmxkNPAtVbzc8rp63z1/qha', 15, 'user', 0),
(2, 'user1', '$2y$10$vABaDSankh5GMOq9MarKpOodJc1Dsqil64L4RxWZ6rFRPnhFTZRAS', 16, 'user', 1),
(3, 'test123', '$2y$10$sa6kIDHNP1rEYAwWPbMcE.DrDi0YuHr/.BYXw3MDcs.1vsyG7bUsu', 16, 'user', 1),
(4, 'eee', '$2y$10$2s0GuwUMutxHNiGK8QYFn.MMjfNCMx2yxH/vVfzCKLmXwa1fYmMy2', 98, 'user', 1),
(5, 'a', '$2y$10$mw.eusCgY43HlsLuyZB/4OzHjUljdcs58p/Da6/VIlKK4OfRxLXPG', 1, 'user', 1);

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `fk_FromUserID` FOREIGN KEY (`FromUserID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ToUserID` FOREIGN KEY (`ToUserID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `userprofile`
--
ALTER TABLE `userprofile`
  ADD CONSTRAINT `fk_userID` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
