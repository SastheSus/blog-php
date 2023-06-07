-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 07, 2023 alle 12:04
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
(1, 'BM-21 Grad', 'Il BM-21, conosciuto anche come Grad, è un lanciarazzi a 40 tubi che può colpire bersagli fino a 40 km di distanza. Utilizzato in vari conflitti, è stato esportato in tutto il mondo.', '2023-02-28 21:20:00', 1, 'Bardo', 24),
(2, 'M1 Abrams', 'L\'M1 Abrams è un carro armato da combattimento di terza generazione, utilizzato principalmente dalle forze armate degli Stati Uniti e di altri paesi.', '2023-03-08 10:28:00', 2, 'Bardo', 4),
(3, 'leopard 2', 'il leopard 2 è uno dei più avanzati carri armati da combattimento in circolazione, caratterizzato da un cannone ad alta velocità, un motore a turbina a gas e una corazzatura avanzata.', '2023-03-01 08:30:00', 3, 'Bardo', 15),
(4, 'Mi17', 'Il Mi-17, anche noto come Mi-8MTV, è un elicottero da trasporto militare russo-americano, molto versatile e utilizzato in molte parti del mondo. È di trasporto fino a 24 soldati', '2023-03-01 08:40:00', 4, 'Bardo', 44),
(5, 'T-14', 'Il T-14 Armata è un carro armato da combattimento di quinta generazione sviluppato in Russia. È uno dei sistemi d\'arma più avanzati al mondo', '2023-03-02 09:40:00', 5, 'Bardo', 18),
(6, 'T-72', 'Il T-72 è un carro armato da combattimento russo sviluppato negli anni \'70. Caratterizzato da un cannone ad alta velocità da 125 mm e una corazzatura avanzata, è stato utilizzato ed esportato in diversi paesi.', '2023-03-14 10:03:53', 6, 'Bardo', 82);

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
(48, 'BM-21_Grad.jpg', 0),
(49, 't-72.jpg', 0),
(50, 'abrams.jpeg', 0),
(51, 'BM-21_Grad.jpg', 0),
(52, 't-72.jpg', 0),
(53, 'abrams.jpeg', 0),
(54, 'ballo-liscio-all-ecofesta-di-sciarborasca-292989.large.jpg', 1),
(55, 'okey.PNG', 0),
(56, 'okey2.PNG', 0),
(57, 'okey.PNG', 0),
(58, 'okey2.PNG', 0),
(59, 'okey.PNG', 0),
(60, 'okey2.PNG', 0),
(61, 'BM-21_Grad.jpg', 0),
(62, 'BM-21_Grad.jpg', 0),
(63, 'grad.gif', 0),
(64, 'BM-21_Grad.jpg', 0),
(65, 'grad.gif', 0),
(66, 'BM-21Ural-375D.jpg', 0),
(67, 'BM-21_Grad.jpg', 0),
(68, 'grad.gif', 0),
(69, 'BM-21Ural-375D.jpg', 0),
(70, 'BM-21_Grad.jpg', 0),
(71, 'grad.gif', 0),
(72, 'BM-21Ural-375D.jpg', 0),
(73, 'leopard.jpg', 0),
(74, 'Leopard-2-A4-3.jpg', 0),
(75, 'leopard.jpg', 0),
(76, 'Leopard-2-A4-3.jpg', 0),
(77, 'leopard.jpg', 0),
(78, 'Leopard-2-A4-3.jpg', 0),
(79, 'AR2008-Z110-04-e1515665258129.jpg', 0),
(80, 'abrams.jpeg', 0),
(81, 'M1A1_USMC_T.png', 0),
(82, 'Defense.gov_News_Photo_000201-M-5802T-006.jpg', 0),
(83, 'Mi17.jpg', 0),
(84, '3l-image-70.jpg', 0),
(85, '360826973.jpg', 0),
(86, 't-14.jpg', 0),
(87, '270415armata (2).jpg', 0),
(88, 'download.jfif', 0);

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
(1, 2, 1, 35),
(2, 6, 1, 35),
(1, 1, 1, 36),
(1, 6, 1, 36),
(1, 6, 2, 37),
(2, 1, 1, 63),
(4, 1, 1, 66),
(1, 3, 1, 73),
(2, 3, 1, 74),
(4, 3, 1, 79),
(2, 2, 1, 81),
(4, 2, 1, 82),
(1, 4, 1, 83),
(2, 4, 1, 84),
(5, 4, 1, 85),
(1, 5, 1, 86),
(2, 5, 1, 87),
(4, 5, 1, 88);

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
(1, 1, 'introduzione', 'il bm-21 grad è un sistema di lancio multiplo di razzi (mlrs) sviluppato in unione sovietica negli anni \'60. è uno dei sistemi di artiglieria più ampiamente utilizzati al mondo ed è stato impiegato in numerosi conflitti in tutto il globo.', 0),
(1, 2, 'introduzione', 'il m1 abrams è un carro armato da combattimento sviluppato e utilizzato dagli stati uniti. è entrato in servizio negli anni \'80 ed è ancora considerato uno dei carri armati più potenti e avanzati al mondo. prende il nome dal generale creighton abrams, ex capo dello stato maggiore dell\'esercito degli stati uniti.', 0),
(1, 3, 'introduzione', 'il leopard 2 è un carro armato da combattimento di origine tedesca. è entrato in servizio negli anni \'70 ed è considerato uno dei migliori carri armati al mondo. il leopard 2 è stato sviluppato come sostituto del leopard 1, introducendo importanti miglioramenti in termini di protezione, potenza di fuoco e mobilità.', 0),
(1, 4, 'introduzione', 'il mi-17 è un elicottero da trasporto medio sviluppato dall\'unione sovietica negli anni \'70. è una versione migliorata del mi-8, uno dei modelli di elicotteri più diffusi al mondo. l\'mi-17 è stato prodotto in grandi quantità e ha trovato impiego in numerosi paesi per scopi civili e militari.', 0),
(1, 5, 'introduzione', 'il t-14 armata è un carro armato da combattimento di nuova generazione sviluppato in russia. è stato introdotto nel 2015 e rappresenta una significativa evoluzione rispetto ai carri armati precedenti, combinando tecnologie avanzate, protezione superiore e capacità di combattimento potenti.', 0),
(1, 6, 'introduzione', 'il t-72 è un carro armato da combattimento russo sviluppato negli anni \'70 come successore del t-62. il suo cannone ad alta velocità da 125 mm e la corazzatura avanzata lo hanno reso un sistema d\'arma altamente letale e affidabile, utilizzato in molti conflitti nel mondo.', 0),
(2, 1, 'aspetti tecnici', 'dal punto di vista tecnico, il bm-21 grad è montato su un telaio di veicolo cingolato, che fornisce la mobilità necessaria per un rapido spostamento sul campo di battaglia. il sistema di lancio consiste in una serie di tubi verticali, ognuno dei quali può ospitare un razzo non guidato. la versione base del grad è equipaggiata con 40 tubi di lancio, anche se esistono varianti con un numero diverso di tubi.', 0),
(2, 2, 'aspetti tecnici', 'dal punto di vista tecnico, l\'m1 abrams è caratterizzato da un\'armatura pesante che offre un\'elevata protezione balistica contro proiettili e schegge. il carro armato è equipaggiato con un cannone principale da 120 mm che può sparare proiettili perforanti, esplosivi e missili anticarro. la sua elevata precisione e gittata lo rendono efficace sia nel combattimento contro altri carri armati che nel supporto di fanteria.', 0),
(2, 3, 'aspetti', 'dal punto di vista tecnico, il leopard 2 è caratterizzato da un\'armatura composita che offre un\'elevata protezione contro proiettili e schegge. il suo cannone principale è un rheinmetall 120 mm, che può sparare una vasta gamma di munizioni, inclusi proiettili perforanti, esplosivi e missili anticarro. è anche dotato di mitragliatrici per la difesa a corto raggio.', 0),
(2, 4, 'aspetti', 'dal punto di vista tecnico, il mi-17 è un elicottero biturbina con una configurazione classica a rotore principale e rotore di coda. ha una capacità di trasporto di circa 30 soldati o una combinazione di truppe e carico utile. è dotato di motori potenti che gli consentono di operare in ambienti ad alta quota e in condizioni climatiche difficili.', 0),
(2, 5, 'aspetti tecnici', 'dal punto di vista tecnico, il t-14 armata è caratterizzato da un\'armatura composita che fornisce una maggiore protezione balistica rispetto ai suoi predecessori. è dotato di un cannone principale da 125 mm con capacità di caricamento automatico, che consente un rapido e continuo fuoco. la sua configurazione modulare consente l\'installazione di una varietà di armi e sistemi di difesa attiva.', 0),
(2, 6, 'caratteristiche', 'il t-72 è stato progettato per essere un carro armato versatile, in grado di svolgere un\'ampia gamma di compiti. grazie alla sua mobilità e capacità di attraversare terreni difficili, è in grado di spostarsi rapidamente sul campo di battaglia. la sua corazzatura è in grado di resistere ai proiettili delle armi leggere e ai frammenti di granate, offrendo una protezione efficace ai membri dell\'equipaggio.', 1),
(3, 1, '', 'i razzi utilizzati dal bm-21 grad hanno un diametro di 122 millimetri e possono essere equipaggiati con testate esplosive ad alto potenziale, frammentazione o chimiche. la gittata massima del sistema è di circa 20 chilometri, anche se possono essere raggiunte distanze più corte o più lunghe in base al tipo di munizioni utilizzate.', 0),
(3, 2, '', 'l\'m1 abrams è dotato di un motore a turbina a gas che gli conferisce una notevole potenza e una velocità massima di oltre 60 chilometri all\'ora su strada. questo lo rende uno dei carri armati più veloci in servizio. la sua configurazione a cingoli gli conferisce una buona mobilità su terreni variabili, consentendo di superare ostacoli e terreni difficili.', 0),
(3, 3, '', 'il leopard 2 è alimentato da un motore a turbina a gas che gli conferisce una notevole potenza e una velocità massima di oltre 70 km/h su strada. ha una configurazione a cingoli che gli permette di superare ostacoli e terreni difficili. è anche dotato di un sistema di controllo del fuoco avanzato e di sistemi di difesa attiva per aumentare la sua capacità di sopravvivenza sul campo di battaglia.', 0),
(3, 4, '', 'l\'mi-17 ha un\'autonomia di volo di diverse centinaia di chilometri e una velocità massima di circa 250 km/h. è in grado di atterrare e decollare da superfici non preparate, come campi o terreni accidentati, il che lo rende adatto per operazioni in aree remote o in zone di conflitto.', 0),
(3, 5, '', 'il t-14 è alimentato da un motore potente e altamente efficiente, che fornisce una buona mobilità su vari terreni. ha una velocità massima di circa 80 km/h su strada e può attraversare ostacoli come fossati e superare pendenze ripide. è anche dotato di un sistema di controllo del fuoco avanzato, che aumenta la precisione dei colpi e la capacità di ingaggio multiplo.', 0),
(4, 1, 'impiego', 'il bm-21 grad è stato ampiamente impiegato in vari conflitti, dimostrandosi un\'arma efficace per l\'artiglieria di fuoco di sbarramento. grazie alla sua mobilità, il sistema può essere rapidamente dispiegato sul campo di battaglia e fornire un fuoco di saturazione su una vasta area. questo lo rende particolarmente adatto per supportare le truppe durante le operazioni offensive o difensive.', 1),
(4, 2, 'impiego', 'l\'m1 abrams è stato ampiamente impiegato dalle forze armate degli stati uniti in diversi conflitti. è stato utilizzato nella guerra del golfo nel 1991, dimostrando una notevole superiorità contro i carri armati iracheni. ha partecipato anche ad altre operazioni, come la guerra in iraq e l\'afghanistan.', 1),
(4, 3, 'impiego', 'il leopard 2 è stato impiegato da diverse nazioni in tutto il mondo. è stato utilizzato in diversi conflitti e missioni internazionali. il suo impiego più noto è stato nelle forze armate tedesche, ma è stato anche esportato in altri paesi, tra cui paesi bassi, grecia, turchia e molti altri.', 1),
(4, 4, '', 'il mi-17 è spesso equipaggiato con una serie di armamenti difensivi, come mitragliatrici o lanciagranate, per fornire una certa protezione durante le missioni militari. può anche essere configurato per missioni di ricerca e soccorso o per il trasporto di carichi pesanti o materiali.', 0),
(4, 5, 'impiego', 'l\'impiego del t-14 armata è principalmente di natura militare. è stato sviluppato per sostituire i carri armati precedenti nell\'esercito russo e migliorare le capacità di combattimento sul campo di battaglia moderno. il t-14 è stato impiegato in esercitazioni militari e dimostrazioni, mostrando la sua potenza di fuoco e la sua protezione avanzata.', 1),
(5, 1, '', 'il grad è stato utilizzato in molti conflitti, tra cui la guerra in afghanistan, la guerra in iraq, la guerra in siria e il conflitto ucraino. la sua capacità di lanciare razzi in modo rapido e continuo lo rende un\'arma temibile e può causare danni significativi alle truppe nemiche e alle infrastrutture.', 0),
(5, 2, '', 'oltre agli stati uniti, l\'m1 abrams è stato esportato in diversi paesi e ha partecipato a conflitti in tutto il mondo. la sua potenza di fuoco, la protezione e la mobilità lo rendono un carro armato versatile e adatto a una varietà di scenari operativi.', 0),
(5, 3, '', 'il leopard 2 ha dimostrato la sua efficacia sul campo di battaglia, combinando una potente potenza di fuoco, una protezione avanzata e una buona mobilità. è stato impiegato in missioni di combattimento, supporto alle operazioni di pace e missioni di addestramento. la sua presenza sul campo di battaglia è stata spesso considerata un deterrente per le forze nemiche a causa delle sue eccellenti capacità.', 0),
(5, 4, 'impiego', 'l\'mi-17 è stato ampiamente impiegato in tutto il mondo per una varietà di scopi. a livello civile, viene utilizzato per il trasporto di passeggeri e merci, soprattutto in aree remote o scarsamente accessibili. ha dimostrato di essere un mezzo affidabile per le missioni di soccorso durante calamità naturali o in situazioni di emergenza.', 1),
(5, 5, '', 'il suo impiego effettivo in conflitti reali è limitato, poiché il t-14 armata è ancora in fase di produzione limitata e distribuzione agli eserciti. tuttavia, il suo sviluppo e la sua introduzione indicano l\'impegno della russia nella modernizzazione delle sue forze armate e nella creazione di una piattaforma di combattimento altamente avanzata.', 0),
(6, 1, '', 'tuttavia, è importante sottolineare che il bm-21 grad è un sistema di artiglieria non guidata, il che significa che la precisione dei suoi colpi è limitata rispetto ai sistemi di lancio di razzi guidati. ciò comporta un rischio maggiore di danni collaterali e la necessità di un\'accurata pianificazione dell\'impiego per ridurre al minimo gli effetti negativi sulla popolazione civile e sulle infrastrutture non militari.', 0),
(6, 2, '', 'tuttavia, è importante sottolineare che l\'m1 abrams è un veicolo costoso e richiede una manutenzione accurata. è vulnerabile a minacce come i missili anticarro e richiede un adeguato supporto logistico per garantire la sua efficienza sul campo di battaglia. inoltre, la sua grande dimensione può rappresentare una sfida in ambienti urbani o in terreni stretti. pertanto, l\'impiego dell\'m1 abrams richiede una pianificazione adeguata e la cooperazione con altre unità per massimizzare la sua efficacia e minimizzare i rischi.', 0),
(6, 3, '', 'tuttavia, è importante notare che il leopard 2 richiede un costante aggiornamento e manutenzione per rimanere al passo con le minacce moderne. come tutti i carri armati, ha le sue limitazioni e può essere vulnerabile a munizioni avanzate o a minacce come i missili anticarro. pertanto, l\'impiego del leopard 2 richiede una pianificazione adeguata, una strategia operativa efficace e il supporto di altre unità per massimizzare la sua efficacia sul campo di battaglia.', 0),
(6, 4, '', 'nel contesto militare, l\'mi-17 è stato utilizzato per il trasporto di truppe, evacuazione medica, supporto alle operazioni di combattimento e ricognizione. è stato coinvolto in conflitti come la guerra in afghanistan, la guerra in siria e il conflitto ucraino.', 0),
(6, 5, '', 'si prevede che il t-14 armata abbia un ruolo importante nel futuro delle operazioni militari terrestri, offrendo una maggiore protezione per l\'equipaggio, una potenza di fuoco superiore e una migliore capacità di sopravvivenza sul campo di battaglia.', 0),
(7, 4, '', 'la versatilità, la robustezza e la capacità di operare in vari ambienti hanno reso l\'mi-17 una scelta popolare per molti eserciti e organizzazioni di tutto il mondo. è un elicottero affidabile e ampiamente utilizzato che ha dimostrato la sua efficacia in numerose situazioni operative.', 0);

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
('author', 'author@author.com', '$2y$10$9nokgv7UwR4b3nrFDpko9.6kHu0w6K9h8Sqbvqxxws4NGCmFfgzKi', 'AUTHOR'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT per la tabella `immagini`
--
ALTER TABLE `immagini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT per la tabella `paragrafi`
--
ALTER TABLE `paragrafi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
