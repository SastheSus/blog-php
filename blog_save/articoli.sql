SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `articoli` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(255),
  `descrizione` mediumtext,
  `giorno` datetime,
  `logo` varchar(255),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `articoli` (`Id`, `titolo`, `descrizione`, `giorno`, `logo`) VALUES
(2, 'M1 Abrams', 'L\'M1 Abrams è un carro armato da combattimento di terza generazione, utilizzato principalmente dalle forze armate degli Stati Uniti e di altri paesi.', '2023-03-08 10:28:00', 'abrams.jpeg'),
(1, 'BM-21 Grad', 'Il BM-21, conosciuto anche come Grad, è un lanciarazzi a 40 tubi che può colpire bersagli fino a 40 km di distanza. Utilizzato in vari conflitti, è stato esportato in tutto il mondo.', '2023-02-28 21:20:00', 'BM-21_Grad.jpg'),
(3, 'leopard', 'Il Leopard è uno dei più avanzati carri armati da combattimento in circolazione, caratterizzato da un cannone ad alta velocità, un motore a turbina a gas e una corazzatura avanzata. ', '2023-03-01 08:30:00', 'leopard.jpg'),
(4, 'Mi17', 'Il Mi-17, anche noto come Mi-8MTV, è un elicottero da trasporto militare russo-americano, molto versatile e utilizzato in molte parti del mondo. È di trasporto fino a 24 soldati', '2023-03-01 08:40:00', 'Mi17.jpg'),
(5, 'T-14', 'Il T-14 Armata è un carro armato da combattimento di quinta generazione sviluppato in Russia. È uno dei sistemi d\'arma più avanzati al mondo', '2023-03-02 09:40:00', 't-14.jpg');


CREATE TABLE `utenti` (
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `utenti` (`email`, `username`, `password`) VALUES
(NULL, NULL, '$2y$10$J/Nm0h3TXSwaNBZzACc66e0vhycJWpMD/PylCN7TSFE.vbsvA0VCC'),
('a', 'a', '$2y$10$7vnqQl0KX.4HkKDwMMupjuDgpmx/AQAik3x24R4At6Ha4ByfqRvpe');
COMMIT;
