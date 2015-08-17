-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 17 aug 2015 om 17:10
-- Serverversie: 5.6.24
-- PHP-versie: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `php2dezit`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbladmin`
--

CREATE TABLE IF NOT EXISTS `tbladmin` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'Shane', 'Rymenams', 'shanerymenams@gmail.com', '$2y$11$HY7IdLqls9YWz8OSxXAWZe2bzu2EjSTboyaDbadlCo.5BuIBwsp9u');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblprojects`
--

CREATE TABLE IF NOT EXISTS `tblprojects` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `up` int(255) NOT NULL,
  `down` int(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tblprojects`
--

INSERT INTO `tblprojects` (`id`, `title`, `description`, `up`, `down`) VALUES
(1, 'testing', 'testing 123', 5, 2),
(2, 'testing', 'testing 123', 10, 1),
(3, 'Test 2', 'Testing this one too', 10, 1),
(4, 'dfhg', 'dfhdfhdfh', 5, 1),
(5, 'wxcvgbqdfg', 'qdfgqdfg', 5, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblusers`
--

CREATE TABLE IF NOT EXISTS `tblusers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tblusers`
--

INSERT INTO `tblusers` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'Shane', 'Rymenams', 'shanerymenams@gmail.com', '$2y$11$HY7IdLqls9YWz8OSxXAWZe2bzu2EjSTboyaDbadlCo.5BuIBwsp9u');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblvotingip`
--

CREATE TABLE IF NOT EXISTS `tblvotingip` (
  `ip_id` int(11) NOT NULL,
  `project_id_fk` int(11) NOT NULL,
  `ip_add` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tblvotingip`
--

INSERT INTO `tblvotingip` (`ip_id`, `project_id_fk`, `ip_add`) VALUES
(1, 4, '127.0.0.1'),
(2, 3, '127.0.0.1'),
(3, 2, '127.0.0.1'),
(4, 5, '127.0.0.1'),
(5, 1, '127.0.0.1');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexen voor tabel `tblprojects`
--
ALTER TABLE `tblprojects`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexen voor tabel `tblvotingip`
--
ALTER TABLE `tblvotingip`
  ADD PRIMARY KEY (`ip_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `tblprojects`
--
ALTER TABLE `tblprojects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `tblvotingip`
--
ALTER TABLE `tblvotingip`
  MODIFY `ip_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
