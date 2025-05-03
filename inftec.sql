-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Mag 03, 2025 alle 09:58
-- Versione del server: 8.0.40
-- Versione PHP: 8.4.2

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
-- Struttura della tabella `buono`
--

CREATE TABLE `buono` (
  `id` int NOT NULL,
  `id_cliente` int NOT NULL,
  `id_ritirante` int NOT NULL,
  `peso` double(6,2) NOT NULL,
  `id_polizza` int NOT NULL,
  `stato` enum('accettato','rifiutato','in attesa') NOT NULL DEFAULT 'in attesa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struttura della tabella `camion`
--

CREATE TABLE `camion` (
  `targa` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struttura della tabella `nave`
--

CREATE TABLE `nave` (
  `id` int NOT NULL,
  `nome` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struttura della tabella `polizza`
--

CREATE TABLE `polizza` (
  `id` int NOT NULL,
  `id_viaggio` int NOT NULL,
  `tipologiaMerce` varchar(32) NOT NULL,
  `peso` double(6,2) NOT NULL,
  `fornitore` varchar(32) NOT NULL,
  `giorniMagazzinaggio` int NOT NULL,
  `tariffa` double(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struttura della tabella `porto`
--

CREATE TABLE `porto` (
  `id` int NOT NULL,
  `nazionalita` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struttura della tabella `registro`
--

CREATE TABLE `registro` (
  `id` int NOT NULL,
  `id_ritirante` int NOT NULL,
  `dataOraRitiro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_buono` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struttura della tabella `ritirante`
--

CREATE TABLE `ritirante` (
  `id` int NOT NULL,
  `id_camion` varchar(32) NOT NULL,
  `id_conducente` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `id` int NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `ruolo` enum('cliente','personale','ritirante') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struttura della tabella `viaggio`
--

CREATE TABLE `viaggio` (
  `id` int NOT NULL,
  `id_nave` int NOT NULL,
  `id_portoPartenza` int NOT NULL,
  `dataPartenza` date NOT NULL,
  `id_portoArrivo` int NOT NULL,
  `dataAllibbramento` date NOT NULL,
  `linea` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `buono`
--
ALTER TABLE `buono`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_polizza` (`id_polizza`),
  ADD KEY `id_ritirante` (`id_ritirante`);

--
-- Indici per le tabelle `camion`
--
ALTER TABLE `camion`
  ADD PRIMARY KEY (`targa`);

--
-- Indici per le tabelle `nave`
--
ALTER TABLE `nave`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `polizza`
--
ALTER TABLE `polizza`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_viaggio` (`id_viaggio`);

--
-- Indici per le tabelle `porto`
--
ALTER TABLE `porto`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ritirante` (`id_ritirante`),
  ADD KEY `id_camion` (`id_buono`);

--
-- Indici per le tabelle `ritirante`
--
ALTER TABLE `ritirante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_camion` (`id_camion`),
  ADD KEY `id_ritirante` (`id_conducente`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indici per le tabelle `viaggio`
--
ALTER TABLE `viaggio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nave` (`id_nave`),
  ADD KEY `id_portoPartenza` (`id_portoPartenza`),
  ADD KEY `id_portoArrivo` (`id_portoArrivo`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `buono`
--
ALTER TABLE `buono`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `nave`
--
ALTER TABLE `nave`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `polizza`
--
ALTER TABLE `polizza`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `porto`
--
ALTER TABLE `porto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ritirante`
--
ALTER TABLE `ritirante`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `viaggio`
--
ALTER TABLE `viaggio`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `buono`
--
ALTER TABLE `buono`
  ADD CONSTRAINT `buono_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `utente` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `buono_ibfk_2` FOREIGN KEY (`id_polizza`) REFERENCES `polizza` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `buono_ibfk_3` FOREIGN KEY (`id_ritirante`) REFERENCES `utente` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Limiti per la tabella `polizza`
--
ALTER TABLE `polizza`
  ADD CONSTRAINT `polizza_ibfk_1` FOREIGN KEY (`id_viaggio`) REFERENCES `viaggio` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Limiti per la tabella `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `registro_ibfk_1` FOREIGN KEY (`id_ritirante`) REFERENCES `ritirante` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `registro_ibfk_2` FOREIGN KEY (`id_buono`) REFERENCES `buono` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Limiti per la tabella `ritirante`
--
ALTER TABLE `ritirante`
  ADD CONSTRAINT `ritirante_ibfk_1` FOREIGN KEY (`id_camion`) REFERENCES `camion` (`targa`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `ritirante_ibfk_2` FOREIGN KEY (`id_conducente`) REFERENCES `utente` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Limiti per la tabella `viaggio`
--
ALTER TABLE `viaggio`
  ADD CONSTRAINT `viaggio_ibfk_1` FOREIGN KEY (`id_nave`) REFERENCES `nave` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `viaggio_ibfk_2` FOREIGN KEY (`id_portoPartenza`) REFERENCES `porto` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `viaggio_ibfk_3` FOREIGN KEY (`id_portoArrivo`) REFERENCES `porto` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
