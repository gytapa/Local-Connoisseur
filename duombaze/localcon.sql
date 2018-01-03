-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2017 at 05:58 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `localcon`
--

-- --------------------------------------------------------

--
-- Table structure for table `aplankyta_vieta`
--

CREATE TABLE `aplankyta_vieta` (
  `id` int(20) NOT NULL,
  `komentaras` varchar(1000) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `data` DATE NOT NULL,
  `fk_VARTOTOJASid` int(20) NOT NULL,
  `fk_LANKYTINA_VIETAid` varchar(100) COLLATE utf8_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `itraukta_vieta`
--

CREATE TABLE `itraukta_vieta` (
  `id` int(20) NOT NULL,
  `aprasymas` varchar(300) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `fk_LANKYTINA_VIETAid` varchar(100) COLLATE utf8_lithuanian_ci NOT NULL,
  `fk_SARASASid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komentaras`
--

CREATE TABLE `komentaras` (
  `id` int(20) NOT NULL,
  `tema` varchar(100)  COLLATE utf8_lithuanian_ci NOT NULL,
  `tekstas` varchar(1000) COLLATE utf8_lithuanian_ci NOT NULL,
  `laikas` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_adresas` varchar(15) COLLATE utf8_lithuanian_ci NOT NULL,
  `fk_VARTOTOJASid` int(20) NOT NULL,
  `fk_LANKYTINA_VIETAid` varchar(100) COLLATE utf8_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

-- --------------------------------------------------------

CREATE TABLE `blokuotis` (
  `id` int(20) NOT NULL,
  `priezastis` varchar(100)  COLLATE utf8_lithuanian_ci NOT NULL,
  `laikas` DATE NOT NULL ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` DATETIME NOT NULL ,
  `fk_VARTOTOJASid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komentaro_vertinimas`
--

CREATE TABLE `komentaro_vertinimas` (
  `id` int(20) NOT NULL,
  `vertinimas` int(1) NOT NULL,
  `fk_VARTOTOJASid` int(20) NOT NULL,
  `fk_KOMENTARASid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lankytina_vieta`
--

CREATE TABLE `lankytina_vieta` (
  `id` varchar(100) COLLATE utf8_lithuanian_ci NOT NULL,
  `pavadinimas` varchar(50) COLLATE utf8_lithuanian_ci NOT NULL,
  `miestas` varchar(20) COLLATE utf8_lithuanian_ci NOT NULL,
  `adresas` varchar(100) COLLATE utf8_lithuanian_ci NOT NULL,
  `tipas` int(2) NOT NULL,
  `nuotrauka` varchar(800) COLLATE utf8_lithuanian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lankytios_vietos_tipai`
--

CREATE TABLE `lankytios_vietos_tipai` (
  `id_LANKYTIOS_VIETOS_TIPAI` int(2) NOT NULL,
  `name` char(8) COLLATE utf8_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sarasas`
--

CREATE TABLE `sarasas` (
  `id` int(20) NOT NULL,
  `pavadinimas` varchar(50) COLLATE utf8_lithuanian_ci NOT NULL,
  `aprasymas` varchar(500) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `sukurimo_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fk_VARTOTOJASid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sertifikatas`
--

CREATE TABLE `sertifikatas` (
  `id` int(20) NOT NULL,
  `pavadinimas` varchar(50) COLLATE utf8_lithuanian_ci NOT NULL,
  `aprasymas` varchar(500) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `fk_VARTOTOJASid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `el_pastas` varchar(40) COLLATE utf8_lithuanian_ci NOT NULL,
  `pavarde` varchar(20) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `vardas` varchar(20) COLLATE utf8_lithuanian_ci NOT NULL,
  `role` int(5) NOT NULL,
  `paskutinis_prisijungimas` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `miestas` varchar(20) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `adresas` varchar(20) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `slaptazodis` varchar(255) COLLATE utf8_lithuanian_ci NOT NULL,
  `ar_patvirtinta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `el_pastas`, `pavarde`, `vardas`, `role`, `paskutinis_prisijungimas`, `miestas`, `adresas`, `slaptazodis`, `ar_patvirtinta`) VALUES
(6, 'gytis718293@gmail.com', 'Apanavičius', 'Gytis', 0, '2017-12-04 20:39:38', 'Vievis', 'Žvejų g. 2', '$2y$10$jVNoMvutw4vkmNisEmFXmOr9RCA6g7ybIq3cejHynXSCsPNFuylqG', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vietos_vertinimas`
--

CREATE TABLE `vietos_vertinimas` (
  `id` int(20) NOT NULL,
  `vertinimas` int(1) NOT NULL,
  `fk_VARTOTOJASid` int(20) NOT NULL,
  `fk_LANKYTINA_VIETAid` varchar(100) COLLATE utf8_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aplankyta_vieta`
--
ALTER TABLE `aplankyta_vieta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test3` (`fk_VARTOTOJASid`),
  ADD KEY `tampa` (`fk_LANKYTINA_VIETAid`);

--
-- Indexes for table `itraukta_vieta`
--
ALTER TABLE `itraukta_vieta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test4` (`fk_LANKYTINA_VIETAid`),
  ADD KEY `sudarytas` (`fk_SARASASid`);

--
-- Indexes for table `komentaras`
--
ALTER TABLE `komentaras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `raso` (`fk_VARTOTOJASid`),
  ADD KEY `gauna` (`fk_LANKYTINA_VIETAid`);

--
-- Indexes for table `blokuoti`
--
ALTER TABLE `blokuotis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blokuotas` (`fk_VARTOTOJASid`);

--
-- Indexes for table `komentaro_vertinimas`
--
ALTER TABLE `komentaro_vertinimas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test2` (`fk_VARTOTOJASid`),
  ADD KEY `priklauso` (`fk_KOMENTARASid`);

--
-- Indexes for table `lankytina_vieta`
--
ALTER TABLE `lankytina_vieta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipas` (`tipas`);

--
-- Indexes for table `lankytios_vietos_tipai`
--
ALTER TABLE `lankytios_vietos_tipai`
  ADD PRIMARY KEY (`id_LANKYTIOS_VIETOS_TIPAI`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sarasas`
--
ALTER TABLE `sarasas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kuria` (`fk_VARTOTOJASid`);

--
-- Indexes for table `sertifikatas`
--
ALTER TABLE `sertifikatas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ikelia` (`fk_VARTOTOJASid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vietos_vertinimas`
--
ALTER TABLE `vietos_vertinimas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test` (`fk_VARTOTOJASid`),
  ADD KEY `turi` (`fk_LANKYTINA_VIETAid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komentaras`
--
ALTER TABLE `komentaras`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
--
-- AUTO_INCREMENT for table `blokuoti`
--
ALTER TABLE `blokuotis`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lankytios_vietos_tipai`
--
ALTER TABLE `lankytios_vietos_tipai`
  MODIFY `id_LANKYTIOS_VIETOS_TIPAI` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sarasas`
--
ALTER TABLE `sarasas`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sertifikatas`
--
ALTER TABLE `sertifikatas`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--

ALTER TABLE `vietos_vertinimas`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `komentaro_vertinimas`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `aplankyta_vieta`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `itraukta_vieta`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `aplankyta_vieta`
--
ALTER TABLE `aplankyta_vieta`
  ADD CONSTRAINT `mato` FOREIGN KEY (`fk_VARTOTOJASid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tampa` FOREIGN KEY (`fk_LANKYTINA_VIETAid`) REFERENCES `lankytina_vieta` (`id`);

--
-- Constraints for table `itraukta_vieta`
--
ALTER TABLE `itraukta_vieta`
  ADD CONSTRAINT `pasidaro` FOREIGN KEY (`fk_LANKYTINA_VIETAid`) REFERENCES `lankytina_vieta` (`id`),
  ADD CONSTRAINT `sudarytas` FOREIGN KEY (`fk_SARASASid`) REFERENCES `sarasas` (`id`);

--
-- Constraints for table `komentaras`
--
ALTER TABLE `komentaras`
  ADD CONSTRAINT `gauna` FOREIGN KEY (`fk_LANKYTINA_VIETAid`) REFERENCES `lankytina_vieta` (`id`),
  ADD CONSTRAINT `raso` FOREIGN KEY (`fk_VARTOTOJASid`) REFERENCES `users` (`id`);

--
-- Constraints for table `blokuoti`
--
ALTER TABLE `blokuotis`
  ADD CONSTRAINT `blokuotas` FOREIGN KEY (`fk_VARTOTOJASid`) REFERENCES `users` (`id`);


--
-- Constraints for table `komentaro_vertinimas`
--
ALTER TABLE `komentaro_vertinimas`
  ADD CONSTRAINT `priklauso` FOREIGN KEY (`fk_KOMENTARASid`) REFERENCES `komentaras` (`id`),
  ADD CONSTRAINT `vertina2` FOREIGN KEY (`fk_VARTOTOJASid`) REFERENCES `users` (`id`);

--
-- Constraints for table `lankytina_vieta`
--
ALTER TABLE `lankytina_vieta`
  ADD CONSTRAINT `lankytina_vieta_ibfk_1` FOREIGN KEY (`tipas`) REFERENCES `lankytios_vietos_tipai` (`id_LANKYTIOS_VIETOS_TIPAI`);

--
-- Constraints for table `sarasas`
--
ALTER TABLE `sarasas`
  ADD CONSTRAINT `kuria` FOREIGN KEY (`fk_VARTOTOJASid`) REFERENCES `users` (`id`);

--
-- Constraints for table `sertifikatas`
--
ALTER TABLE `sertifikatas`
  ADD CONSTRAINT `ikelia` FOREIGN KEY (`fk_VARTOTOJASid`) REFERENCES `users` (`id`);

--
-- Constraints for table `vietos_vertinimas`
--
ALTER TABLE `vietos_vertinimas`
  ADD CONSTRAINT `turi` FOREIGN KEY (`fk_LANKYTINA_VIETAid`) REFERENCES `lankytina_vieta` (`id`),
  ADD CONSTRAINT `vertina` FOREIGN KEY (`fk_VARTOTOJASid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
