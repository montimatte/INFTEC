-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2025 at 01:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inftec`
--

-- --------------------------------------------------------

--
-- Table structure for table `buono`
--

CREATE TABLE `buono` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_ritirante` int(11) NOT NULL,
  `peso` double(6,2) NOT NULL,
  `id_polizza` int(11) NOT NULL,
  `stato` enum('accettato','rifiutato','in attesa','usato') NOT NULL DEFAULT 'in attesa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `buono`
--

INSERT INTO `buono` (`id`, `id_cliente`, `id_ritirante`, `peso`, `id_polizza`, `stato`) VALUES
(1, 1, 3, 2500.00, 1, 'rifiutato'),
(2, 1, 3, 100.00, 1, 'accettato');

-- --------------------------------------------------------

--
-- Table structure for table `camion`
--

CREATE TABLE `camion` (
  `targa` varchar(32) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nave`
--

CREATE TABLE `nave` (
  `id` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nave`
--

INSERT INTO `nave` (`id`, `nome`) VALUES
(1, 'abba');

-- --------------------------------------------------------

--
-- Table structure for table `polizza`
--

CREATE TABLE `polizza` (
  `id` int(11) NOT NULL,
  `id_viaggio` int(11) NOT NULL,
  `tipologiaMerce` varchar(32) NOT NULL,
  `peso` double(6,2) NOT NULL,
  `fornitore` varchar(32) NOT NULL,
  `giorniMagazzinaggio` int(11) NOT NULL,
  `tariffa` double(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `polizza`
--

INSERT INTO `polizza` (`id`, `id_viaggio`, `tipologiaMerce`, `peso`, `fornitore`, `giorniMagazzinaggio`, `tariffa`) VALUES
(1, 1, 'legname', 3500.00, 'fghdfhdfh', 3, 10.50);

-- --------------------------------------------------------

--
-- Table structure for table `porto`
--

CREATE TABLE `porto` (
  `id` int(11) NOT NULL,
  `nazionalita` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `porto`
--

INSERT INTO `porto` (`id`, `nazionalita`) VALUES
(1, 'usa'),
(2, 'canada');

-- --------------------------------------------------------

--
-- Table structure for table `registro`
--

CREATE TABLE `registro` (
  `id` int(11) NOT NULL,
  `id_ritirante` int(11) NOT NULL,
  `dataOraRitiro` datetime NOT NULL DEFAULT current_timestamp(),
  `id_buono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ritirante`
--

CREATE TABLE `ritirante` (
  `id` int(11) NOT NULL,
  `id_camion` varchar(32) NOT NULL,
  `id_conducente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

CREATE TABLE `utente` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `ruolo` enum('cliente','personale','autotrasportatore') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`id`, `username`, `password`, `ruolo`) VALUES
(1, 'c1', 'a9f7e97965d6cf799a529102a973b8b9', 'cliente'),
(3, 'a1', '8a8bb7cd343aa2ad99b7d762030857a2', 'autotrasportatore'),
(4, 'p1', 'ec6ef230f1828039ee794566b9c58adc', 'personale');

-- --------------------------------------------------------

--
-- Table structure for table `viaggio`
--

CREATE TABLE `viaggio` (
  `id` int(11) NOT NULL,
  `id_nave` int(11) NOT NULL,
  `id_portoPartenza` int(11) NOT NULL,
  `dataPartenza` date NOT NULL,
  `id_portoArrivo` int(11) NOT NULL,
  `dataAllibbramento` date NOT NULL,
  `linea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `viaggio`
--

INSERT INTO `viaggio` (`id`, `id_nave`, `id_portoPartenza`, `dataPartenza`, `id_portoArrivo`, `dataAllibbramento`, `linea`) VALUES
(1, 1, 1, '2025-05-08', 2, '2025-05-09', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buono`
--
ALTER TABLE `buono`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_polizza` (`id_polizza`),
  ADD KEY `id_ritirante` (`id_ritirante`);

--
-- Indexes for table `camion`
--
ALTER TABLE `camion`
  ADD PRIMARY KEY (`targa`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indexes for table `nave`
--
ALTER TABLE `nave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polizza`
--
ALTER TABLE `polizza`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_viaggio` (`id_viaggio`);

--
-- Indexes for table `porto`
--
ALTER TABLE `porto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ritirante` (`id_ritirante`),
  ADD KEY `id_camion` (`id_buono`);

--
-- Indexes for table `ritirante`
--
ALTER TABLE `ritirante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_camion` (`id_camion`),
  ADD KEY `id_ritirante` (`id_conducente`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `viaggio`
--
ALTER TABLE `viaggio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nave` (`id_nave`),
  ADD KEY `id_portoPartenza` (`id_portoPartenza`),
  ADD KEY `id_portoArrivo` (`id_portoArrivo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buono`
--
ALTER TABLE `buono`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nave`
--
ALTER TABLE `nave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `polizza`
--
ALTER TABLE `polizza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `porto`
--
ALTER TABLE `porto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ritirante`
--
ALTER TABLE `ritirante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utente`
--
ALTER TABLE `utente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `viaggio`
--
ALTER TABLE `viaggio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buono`
--
ALTER TABLE `buono`
  ADD CONSTRAINT `buono_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `utente` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `buono_ibfk_2` FOREIGN KEY (`id_polizza`) REFERENCES `polizza` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `buono_ibfk_3` FOREIGN KEY (`id_ritirante`) REFERENCES `utente` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `camion`
--
ALTER TABLE `camion`
  ADD CONSTRAINT `camion_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `utente` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `polizza`
--
ALTER TABLE `polizza`
  ADD CONSTRAINT `polizza_ibfk_1` FOREIGN KEY (`id_viaggio`) REFERENCES `viaggio` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `registro_ibfk_1` FOREIGN KEY (`id_ritirante`) REFERENCES `ritirante` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `registro_ibfk_2` FOREIGN KEY (`id_buono`) REFERENCES `buono` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ritirante`
--
ALTER TABLE `ritirante`
  ADD CONSTRAINT `ritirante_ibfk_1` FOREIGN KEY (`id_camion`) REFERENCES `camion` (`targa`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ritirante_ibfk_2` FOREIGN KEY (`id_conducente`) REFERENCES `utente` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `viaggio`
--
ALTER TABLE `viaggio`
  ADD CONSTRAINT `viaggio_ibfk_1` FOREIGN KEY (`id_nave`) REFERENCES `nave` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `viaggio_ibfk_2` FOREIGN KEY (`id_portoPartenza`) REFERENCES `porto` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `viaggio_ibfk_3` FOREIGN KEY (`id_portoArrivo`) REFERENCES `porto` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
