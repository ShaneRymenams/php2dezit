-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 18 aug 2015 om 11:00
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'Shane', 'Rymenams', 'shanerymenams@gmail.com', '$2y$11$6v4Z4viURaEBBTDMYCE3MOyW9jJbON5iX.Hl0EU7BM5EMdH5DcvMK'),
(5, 'Ad', 'Ministrator', 'admin@email.com', '$2y$11$XMuRaGcyY/veog.XBJtD0u59r1dyD544Iv6ehZYhEVGseYiU17f1K');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tblprojects`
--

INSERT INTO `tblprojects` (`id`, `title`, `description`, `up`, `down`) VALUES
(6, 'Test 1', 'dfhgdfhdsfgs sdgedghe erghergh ehrerhe hgerh', 1, 0),
(7, 'Test 2', 'ekjg aeiguj laekf laefhb aefhb efb', 0, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblusers`
--

CREATE TABLE IF NOT EXISTS `tblusers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tblusers`
--

INSERT INTO `tblusers` (`id`, `firstname`, `lastname`, `email`, `password`, `foto`) VALUES
(1, 'Shane', 'Rymenams', 'shanerymenams@gmail.com', '$2y$11$LUFi/KetF7WgdX0EI1.BHu.15XPp4U2ZEOaPFeg86MVufCM7AGuBu', ''),
(4, 'users', 'useruser', 'user@email.com', '$2y$11$RrbB6MHViTAZ1EKN3qNfh.QEcfxbahatS7eXJSEgyYH6o6c16qcOG', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblvotingip`
--

CREATE TABLE IF NOT EXISTS `tblvotingip` (
  `ip_id` int(11) NOT NULL,
  `project_id_fk` int(11) NOT NULL,
  `ip_add` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tblvotingip`
--

INSERT INTO `tblvotingip` (`ip_id`, `project_id_fk`, `ip_add`) VALUES
(1, 4, '127.0.0.1'),
(2, 3, '127.0.0.1'),
(3, 2, '127.0.0.1'),
(4, 5, '127.0.0.1'),
(5, 1, '127.0.0.1'),
(6, 6, '127.0.0.1'),
(7, 7, '127.0.0.1'),
(8, 8, '127.0.0.1');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `tblprojects`
--
ALTER TABLE `tblprojects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT voor een tabel `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `tblvotingip`
--
ALTER TABLE `tblvotingip`
  MODIFY `ip_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
