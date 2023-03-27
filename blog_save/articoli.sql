-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 27, 2023 alle 10:27
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.0.25

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
  `Id` int(11) NOT NULL,
  `titolo` varchar(255) DEFAULT NULL,
  `descrizione` mediumtext DEFAULT NULL,
  `giorno` datetime DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `emailUtente` varchar(50) DEFAULT NULL,
  `visualizzazioni` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `articoli`
--

INSERT INTO `articoli` (`Id`, `titolo`, `descrizione`, `giorno`, `logo`, `emailUtente`, `visualizzazioni`) VALUES
(1, 'BM-21 Grad', 'Il BM-21, conosciuto anche come Grad, è un lanciarazzi a 40 tubi che può colpire bersagli fino a 40 km di distanza. Utilizzato in vari conflitti, è stato esportato in tutto il mondo.', '2023-02-28 21:20:00', 'BM-21_Grad.jpg', 'michele.bardotti04@gmail.com', 10),
(2, 'M1 Abrams', 'L\'M1 Abrams è un carro armato da combattimento di terza generazione, utilizzato principalmente dalle forze armate degli Stati Uniti e di altri paesi.', '2023-03-08 10:28:00', 'abrams.jpeg', 'michele.bardotti04@gmail.com', 2),
(3, 'leopard', 'Il Leopard è uno dei più avanzati carri armati da combattimento in circolazione, caratterizzato da un cannone ad alta velocità, un motore a turbina a gas e una corazzatura avanzata. ', '2023-03-01 08:30:00', 'leopard.jpg', 'michele.bardotti04@gmail.com', 5),
(4, 'Mi17', 'Il Mi-17, anche noto come Mi-8MTV, è un elicottero da trasporto militare russo-americano, molto versatile e utilizzato in molte parti del mondo. È di trasporto fino a 24 soldati', '2023-03-01 08:40:00', 'Mi17.jpg', 'michele.bardotti04@gmail.com', 40),
(5, 'T-14', 'Il T-14 Armata è un carro armato da combattimento di quinta generazione sviluppato in Russia. È uno dei sistemi d\'arma più avanzati al mondo', '2023-03-02 09:40:00', 't-14.jpg', 'michele.bardotti04@gmail.com', 15),
(6, 'T-72', 'Il T-72 è un carro armato da combattimento russo sviluppato negli anni \'70. Caratterizzato da un cannone ad alta velocità da 125 mm e una corazzatura avanzata, è stato utilizzato ed esportato in diversi paesi.', '2023-03-14 10:03:53', 't-72.jpg', 'michele.bardotti04@gmail.com', 30);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `email` varchar(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`email`, `username`, `password`) VALUES
('michele.bardotti04@gmail.com', 'Bardo', '$2y$10$MXbLJYcqDAUmsBAiS0DCLeWC/nQxGJxSqGRaaFg5uIq7QJ8S9dmdG');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `articoli`
--
ALTER TABLE `articoli`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `emailUtente` (`emailUtente`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`email`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `articoli`
--
ALTER TABLE `articoli`
  ADD CONSTRAINT `articoli_ibfk_1` FOREIGN KEY (`emailUtente`) REFERENCES `utenti` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
