-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 22. Aug 2023 um 10:49
-- Server-Version: 10.3.38-MariaDB-0ubuntu0.20.04.1
-- PHP-Version: 8.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `telefonbuch`
--
CREATE DATABASE IF NOT EXISTS `telefonbuch` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `telefonbuch`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `address_book`
--

CREATE TABLE `address_book` (
  `id` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `second_name` varchar(250) NOT NULL,
  `phone` int(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `address_book`
--

INSERT INTO `address_book` (`id`, `first_name`, `second_name`, `phone`) VALUES
(1, 'Max', 'Muster', 688),
(2, 'Eva', 'Muster', 1234567);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `address_book`
--
ALTER TABLE `address_book`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_2` (`phone`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `second_name` (`second_name`),
  ADD KEY `phone` (`phone`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `address_book`
--
ALTER TABLE `address_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
