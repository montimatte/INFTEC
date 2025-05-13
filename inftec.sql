-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 13, 2025 alle 18:30
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

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
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_ritirante` int(11) NOT NULL,
  `peso` double(6,2) NOT NULL,
  `id_polizza` int(11) NOT NULL,
  `stato` enum('accettato','rifiutato','in attesa','usato') NOT NULL DEFAULT 'in attesa',
  `dataOraApprovazione` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `buono`
--

INSERT INTO `buono` (`id`, `id_cliente`, `id_ritirante`, `peso`, `id_polizza`, `stato`, `dataOraApprovazione`) VALUES
(5, 1, 4, 150.00, 2, 'accettato', '2025-05-13 17:14:11'),
(6, 1, 4, 213.00, 1, 'rifiutato', NULL),
(7, 1, 1, 500.00, 2, 'usato', '2025-05-01 17:13:46');

-- --------------------------------------------------------

--
-- Struttura della tabella `camion`
--

CREATE TABLE `camion` (
  `targa` varchar(32) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `camion`
--

INSERT INTO `camion` (`targa`, `id_cliente`) VALUES
('AA000AA', 1),
('BB000BB', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `fattura`
--

CREATE TABLE `fattura` (
  `id` int(11) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `importo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `fattura`
--

INSERT INTO `fattura` (`id`, `id_registro`, `importo`) VALUES
(1, 6, 78);

-- --------------------------------------------------------

--
-- Struttura della tabella `nave`
--

CREATE TABLE `nave` (
  `id` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `nave`
--

INSERT INTO `nave` (`id`, `nome`) VALUES
(1, 'abba');

-- --------------------------------------------------------

--
-- Struttura della tabella `polizza`
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
-- Dump dei dati per la tabella `polizza`
--

INSERT INTO `polizza` (`id`, `id_viaggio`, `tipologiaMerce`, `peso`, `fornitore`, `giorniMagazzinaggio`, `tariffa`) VALUES
(1, 1, 'legname', 3500.00, 'fghdfhdfh', 3, 10.50),
(2, 1, 'ferraglia', 5000.00, 'MetalCo', 4, 13.00);

-- --------------------------------------------------------

--
-- Struttura della tabella `porto`
--

CREATE TABLE `porto` (
  `id` int(11) NOT NULL,
  `nazionalita` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `porto`
--

INSERT INTO `porto` (`id`, `nazionalita`) VALUES
(1, 'usa'),
(2, 'canada');

-- --------------------------------------------------------

--
-- Struttura della tabella `registro`
--

CREATE TABLE `registro` (
  `id` int(11) NOT NULL,
  `dataOraRitiro` datetime NOT NULL DEFAULT current_timestamp(),
  `id_buono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `registro`
--

INSERT INTO `registro` (`id`, `dataOraRitiro`, `id_buono`) VALUES
(4, '2025-05-11 11:43:05', 5),
(6, '2025-05-13 18:02:17', 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `ritirante`
--

CREATE TABLE `ritirante` (
  `id` int(11) NOT NULL,
  `id_camion` varchar(32) NOT NULL,
  `id_conducente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `ritirante`
--

INSERT INTO `ritirante` (`id`, `id_camion`, `id_conducente`) VALUES
(1, 'AA000AA', 3),
(4, 'BB000BB', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `ruolo` enum('cliente','personale','autotrasportatore') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id`, `username`, `password`, `ruolo`) VALUES
(1, 'c1', 'a9f7e97965d6cf799a529102a973b8b9', 'cliente'),
(3, 'a1', '8a8bb7cd343aa2ad99b7d762030857a2', 'autotrasportatore'),
(4, 'p1', 'ec6ef230f1828039ee794566b9c58adc', 'personale'),
(5, 'c2', '9ab62b5ef34a985438bfdf7ee0102229', 'cliente');

-- --------------------------------------------------------

--
-- Struttura della tabella `viaggio`
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
-- Dump dei dati per la tabella `viaggio`
--

INSERT INTO `viaggio` (`id`, `id_nave`, `id_portoPartenza`, `dataPartenza`, `id_portoArrivo`, `dataAllibbramento`, `linea`) VALUES
(1, 1, 1, '2025-05-08', 2, '2025-05-09', 5);

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
  ADD PRIMARY KEY (`targa`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indici per le tabelle `fattura`
--
ALTER TABLE `fattura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_registro` (`id_registro`);

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
  ADD KEY `id_camion` (`id_buono`);

--
-- Indici per le tabelle `ritirante`
--
ALTER TABLE `ritirante`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_camion_2` (`id_camion`,`id_conducente`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `fattura`
--
ALTER TABLE `fattura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `nave`
--
ALTER TABLE `nave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `polizza`
--
ALTER TABLE `polizza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `porto`
--
ALTER TABLE `porto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `ritirante`
--
ALTER TABLE `ritirante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `viaggio`
--
ALTER TABLE `viaggio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `buono`
--
ALTER TABLE `buono`
  ADD CONSTRAINT `buono_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `utente` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `buono_ibfk_2` FOREIGN KEY (`id_polizza`) REFERENCES `polizza` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `buono_ibfk_3` FOREIGN KEY (`id_ritirante`) REFERENCES `ritirante` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `camion`
--
ALTER TABLE `camion`
  ADD CONSTRAINT `camion_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `utente` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `fattura`
--
ALTER TABLE `fattura`
  ADD CONSTRAINT `fattura_ibfk_1` FOREIGN KEY (`id_registro`) REFERENCES `registro` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `polizza`
--
ALTER TABLE `polizza`
  ADD CONSTRAINT `polizza_ibfk_1` FOREIGN KEY (`id_viaggio`) REFERENCES `viaggio` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `registro_ibfk_2` FOREIGN KEY (`id_buono`) REFERENCES `buono` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `ritirante`
--
ALTER TABLE `ritirante`
  ADD CONSTRAINT `ritirante_ibfk_1` FOREIGN KEY (`id_camion`) REFERENCES `camion` (`targa`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ritirante_ibfk_2` FOREIGN KEY (`id_conducente`) REFERENCES `utente` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `viaggio`
--
ALTER TABLE `viaggio`
  ADD CONSTRAINT `viaggio_ibfk_1` FOREIGN KEY (`id_nave`) REFERENCES `nave` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `viaggio_ibfk_2` FOREIGN KEY (`id_portoPartenza`) REFERENCES `porto` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `viaggio_ibfk_3` FOREIGN KEY (`id_portoArrivo`) REFERENCES `porto` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
