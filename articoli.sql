-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 04, 2023 alle 23:14
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `articoli`
--

CREATE TABLE `articoli` (
  `id` int(11) NOT NULL,
  `titolo` varchar(255) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `giorno` datetime DEFAULT NULL,
  `logo` int(11) DEFAULT -1,
  `utente` varchar(50) DEFAULT NULL,
  `visualizzazioni` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `articoli`
--

INSERT INTO `articoli` (`id`, `titolo`, `descrizione`, `giorno`, `logo`, `utente`, `visualizzazioni`) VALUES
(1, 'BM-21 Grad', 'Il BM-21, conosciuto anche come Grad, è un lanciarazzi a 40 tubi che può colpire bersagli fino a 40 km di distanza. Utilizzato in vari conflitti, è stato esportato in tutto il mondo.', '2023-02-28 21:20:00', 1, 'Bardo', 10),
(2, 'M1 Abrams', 'L\'M1 Abrams è un carro armato da combattimento di terza generazione, utilizzato principalmente dalle forze armate degli Stati Uniti e di altri paesi.', '2023-03-08 10:28:00', 2, 'Bardo', 2),
(3, 'leopard', 'Il Leopard è uno dei più avanzati carri armati da combattimento in circolazione, caratterizzato da un cannone ad alta velocità, un motore a turbina a gas e una corazzatura avanzata.', '2023-03-01 08:30:00', 3, 'Bardo', 9),
(4, 'Mi17', 'Il Mi-17, anche noto come Mi-8MTV, è un elicottero da trasporto militare russo-americano, molto versatile e utilizzato in molte parti del mondo. È di trasporto fino a 24 soldati', '2023-03-01 08:40:00', 4, 'Bardo', 40),
(5, 'T-14', 'Il T-14 Armata è un carro armato da combattimento di quinta generazione sviluppato in Russia. È uno dei sistemi d\'arma più avanzati al mondo', '2023-03-02 09:40:00', 5, 'Bardo', 15),
(6, 'T-72', 'Il T-72 è un carro armato da combattimento russo sviluppato negli anni \'70. Caratterizzato da un cannone ad alta velocità da 125 mm e una corazzatura avanzata, è stato utilizzato ed esportato in diversi paesi.', '2023-03-14 10:03:53', 6, 'Bardo', 37);

-- --------------------------------------------------------

--
-- Struttura della tabella `commenti`
--

CREATE TABLE `commenti` (
  `id` int(11) NOT NULL,
  `idArticolo` int(11) NOT NULL,
  `contenuto` text DEFAULT NULL,
  `giorno` datetime DEFAULT NULL,
  `utente` varchar(50) DEFAULT NULL,
  `idRisposta` int(11) DEFAULT NULL,
  `idArticoloRis` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `immagini`
--

CREATE TABLE `immagini` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `logo` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `immagini`
--

INSERT INTO `immagini` (`id`, `nome`, `logo`) VALUES
(-1, 'no_image.gif', 1),
(1, 'BM-21_Grad.jpg', 1),
(2, 'abrams.jpeg', 1),
(3, 'leopard.jpg', 1),
(4, 'Mi17.jpg', 1),
(5, 't-14.jpg', 1),
(6, 't-72.jpg', 1),
(35, 'abrams.jpeg', 0),
(36, 'BM-21_Grad.jpg', 0),
(37, 't-72.jpg', 0),
(38, 't-72.jpg', 0),
(39, 't-72.jpg', 0),
(40, 't-72.jpg', 0),
(41, 't-72.jpg', 0),
(42, 'abrams.jpeg', 0),
(43, 't-72.jpg', 0),
(44, 'abrams.jpeg', 0),
(45, 'BM-21_Grad.jpg', 0),
(46, 't-72.jpg', 0),
(47, 'abrams.jpeg', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `immaginidiparagrafi`
--

CREATE TABLE `immaginidiparagrafi` (
  `idParagrafo` int(11) NOT NULL,
  `idArticolo` int(11) NOT NULL,
  `idInput` int(11) NOT NULL,
  `idImmagine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `immaginidiparagrafi`
--

INSERT INTO `immaginidiparagrafi` (`idParagrafo`, `idArticolo`, `idInput`, `idImmagine`) VALUES
(2, 6, 1, 35),
(1, 6, 1, 36),
(1, 6, 2, 37);

-- --------------------------------------------------------

--
-- Struttura della tabella `paragrafi`
--

CREATE TABLE `paragrafi` (
  `id` int(11) NOT NULL,
  `articolo` int(11) NOT NULL,
  `titolo` varchar(255) DEFAULT NULL,
  `contenuto` text DEFAULT NULL,
  `stile` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `paragrafi`
--

INSERT INTO `paragrafi` (`id`, `articolo`, `titolo`, `contenuto`, `stile`) VALUES
(1, 6, 'introduzione', 'il t-72 è un carro armato da combattimento russo sviluppato negli anni \'70 come successore del t-62. il suo cannone ad alta velocità da 125 mm e la corazzatura avanzata lo hanno reso un sistema d\'arma altamente letale e affidabile, utilizzato in molti conflitti nel mondo.', 0),
(2, 6, 'caratteristiche', 'il t-72 è stato progettato per essere un carro armato versatile, in grado di svolgere un\'ampia gamma di compiti. grazie alla sua mobilità e capacità di attraversare terreni difficili, è in grado di spostarsi rapidamente sul campo di battaglia. la sua corazzatura è in grado di resistere ai proiettili delle armi leggere e ai frammenti di granate, offrendo una protezione efficace ai membri dell\'equipaggio.', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `username` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `ruolo` varchar(255) DEFAULT 'BASE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`username`, `email`, `password`, `ruolo`) VALUES
('admin', 'admin@admin.com', '$2y$10$7udcUigain4jmk5y5RtIAOOSzcCulTVmK0mleLTMOiNuPvh2r9OXW', 'ADMIN'),
('author', 'author@author.com', '$2y$10$9nokgv7UwR4b3nrFDpko9.6kHu0w6K9h8Sqbvqxxws4NGCmFfgzKi', 'ADMIN'),
('Bardo', 'michele.bardotti04@gmail.com', '$2y$10$MXbLJYcqDAUmsBAiS0DCLeWC/nQxGJxSqGRaaFg5uIq7QJ8S9dmdG', 'ADMIN'),
('base', 'base@base.com', '$2y$10$Rsy40xVvYeJdKxeDXThzouUhASwo4Z/d3EJuhUmbhYebfToUfLpWO', 'BASE');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `articoli`
--
ALTER TABLE `articoli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utente` (`utente`),
  ADD KEY `logo` (`logo`);

--
-- Indici per le tabelle `commenti`
--
ALTER TABLE `commenti`
  ADD PRIMARY KEY (`id`,`idArticolo`),
  ADD KEY `idArticolo` (`idArticolo`),
  ADD KEY `utente` (`utente`),
  ADD KEY `idRisposta` (`idRisposta`,`idArticoloRis`);

--
-- Indici per le tabelle `immagini`
--
ALTER TABLE `immagini`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `immaginidiparagrafi`
--
ALTER TABLE `immaginidiparagrafi`
  ADD PRIMARY KEY (`idParagrafo`,`idArticolo`,`idInput`),
  ADD KEY `idImmagine` (`idImmagine`);

--
-- Indici per le tabelle `paragrafi`
--
ALTER TABLE `paragrafi`
  ADD PRIMARY KEY (`id`,`articolo`),
  ADD KEY `articolo` (`articolo`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `articoli`
--
ALTER TABLE `articoli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT per la tabella `immagini`
--
ALTER TABLE `immagini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT per la tabella `paragrafi`
--
ALTER TABLE `paragrafi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `articoli`
--
ALTER TABLE `articoli`
  ADD CONSTRAINT `articoli_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utenti` (`username`),
  ADD CONSTRAINT `articoli_ibfk_2` FOREIGN KEY (`logo`) REFERENCES `immagini` (`id`);

--
-- Limiti per la tabella `commenti`
--
ALTER TABLE `commenti`
  ADD CONSTRAINT `commenti_ibfk_1` FOREIGN KEY (`idArticolo`) REFERENCES `articoli` (`id`),
  ADD CONSTRAINT `commenti_ibfk_2` FOREIGN KEY (`utente`) REFERENCES `utenti` (`username`),
  ADD CONSTRAINT `commenti_ibfk_3` FOREIGN KEY (`idRisposta`,`idArticoloRis`) REFERENCES `commenti` (`id`, `idArticolo`);

--
-- Limiti per la tabella `immaginidiparagrafi`
--
ALTER TABLE `immaginidiparagrafi`
  ADD CONSTRAINT `immaginidiparagrafi_ibfk_1` FOREIGN KEY (`idParagrafo`,`idArticolo`) REFERENCES `paragrafi` (`id`, `articolo`),
  ADD CONSTRAINT `immaginidiparagrafi_ibfk_2` FOREIGN KEY (`idImmagine`) REFERENCES `immagini` (`id`);

--
-- Limiti per la tabella `paragrafi`
--
ALTER TABLE `paragrafi`
  ADD CONSTRAINT `paragrafi_ibfk_1` FOREIGN KEY (`articolo`) REFERENCES `articoli` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
