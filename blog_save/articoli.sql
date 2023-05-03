CREATE TABLE utenti (
  username varchar(50) PRIMARY KEY NOT NULL,
  email varchar(50) DEFAULT NULL,
  password varchar(255) DEFAULT NULL,
  ruolo varchar(255) DEFAULT 'BASE'
);

CREATE TABLE immagini (
  id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nome varchar(255) DEFAULT NULL,
  logo bool DEFAULT 0
);

CREATE TABLE articoli (
  id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  titolo varchar(255) DEFAULT NULL,
  descrizione text DEFAULT NULL,
  giorno datetime DEFAULT NULL,
  logo int(11) DEFAULT -1,
  utente varchar(50) DEFAULT NULL,
  visualizzazioni int(11) DEFAULT 0,
  FOREIGN KEY (utente) REFERENCES utenti (username),
  FOREIGN KEY (logo) REFERENCES immagini (id)
);

CREATE TABLE paragrafi (
  id int(11) NOT NULL AUTO_INCREMENT,
  articolo int(11) NOT NULL,
  titolo varchar(255) DEFAULT NULL,
  contenuto text DEFAULT NULL,
  stile int DEFAULT 0,
  PRIMARY KEY (id, articolo),
  FOREIGN KEY (articolo) REFERENCES articoli (id)
);

CREATE TABLE immaginiDiParagrafi (
  idParagrafo int(11) NOT NULL,
  idArticolo int(11) NOT NULL,
  idInput int(11) NOT NULL,
  idImmagine int(11) NOT NULL,
  PRIMARY KEY (idParagrafo, idArticolo, idInput),
  FOREIGN KEY (idParagrafo, idArticolo) REFERENCES paragrafi (id, articolo),
  FOREIGN KEY (idImmagine) REFERENCES immagini (id)
);
--
-- Dump dei dati per la tabella articoli
--

INSERT INTO utenti (username, email, password, ruolo) VALUES
("Bardo","michele.bardotti04@gmail.com","$2y$10$MXbLJYcqDAUmsBAiS0DCLeWC/nQxGJxSqGRaaFg5uIq7QJ8S9dmdG", "ADMIN");

INSERT INTO immagini (id, nome, logo) VALUES
(-1,"no_image.gif",1);

INSERT INTO immagini (nome, logo) VALUES
("BM-21_Grad.jpg",1),
("abrams.jpeg",1),
("leopard.jpg",1),
("Mi17.jpg",1),
("t-14.jpg",1),
("t-72.jpg",1);

INSERT INTO articoli (titolo, descrizione, giorno, logo, utente, visualizzazioni) VALUES
("BM-21 Grad","Il BM-21, conosciuto anche come Grad, è un lanciarazzi a 40 tubi che può colpire bersagli fino a 40 km di distanza. Utilizzato in vari conflitti, è stato esportato in tutto il mondo.","2023-02-28 21:20:00",1,"Bardo", 10),
("M1 Abrams","L\'M1 Abrams è un carro armato da combattimento di terza generazione, utilizzato principalmente dalle forze armate degli Stati Uniti e di altri paesi.","2023-03-08 10:28:00",2,"Bardo", 2),
("leopard","Il Leopard è uno dei più avanzati carri armati da combattimento in circolazione, caratterizzato da un cannone ad alta velocità, un motore a turbina a gas e una corazzatura avanzata.","2023-03-01 08:30:00",3,"Bardo", 5),
("Mi17","Il Mi-17, anche noto come Mi-8MTV, è un elicottero da trasporto militare russo-americano, molto versatile e utilizzato in molte parti del mondo. È di trasporto fino a 24 soldati","2023-03-01 08:40:00",4,"Bardo", 40),
("T-14","Il T-14 Armata è un carro armato da combattimento di quinta generazione sviluppato in Russia. È uno dei sistemi d\'arma più avanzati al mondo","2023-03-02 09:40:00",5,"Bardo", 15),
("T-72","Il T-72 è un carro armato da combattimento russo sviluppato negli anni \'70. Caratterizzato da un cannone ad alta velocità da 125 mm e una corazzatura avanzata, è stato utilizzato ed esportato in diversi paesi.","2023-03-14 10:03:53",6,"Bardo", 30);

INSERT INTO paragrafi (articolo, titolo, contenuto) VALUES
(6,'test','questo è un test'),
(6,'test2','questo è un test');

INSERT INTO immaginiDiParagrafi (idParagrafo, idArticolo, idInput, idImmagine) VALUES
(1,6,11,1),
(1,6,12,2),
(2,6,21,3);

INSERT INTO `paragrafi` (`id`, `articolo`, `titolo`, `contenuto`, `stile`) VALUES
(1, 6, 'introduzione', 'Il T-72 è un carro armato da combattimento russo sviluppato negli anni \'70 come successore del T-62. Il suo cannone ad alta velocità da 125 mm e la corazzatura avanzata lo hanno reso un sistema d\'arma altamente letale e affidabile, utilizzato in molti conflitti nel mondo.', 0),
(2, 6, 'caratteristiche', 'Il T-72 è stato progettato per essere un carro armato versatile, in grado di svolgere un\'ampia gamma di compiti. Grazie alla sua mobilità e capacità di attraversare terreni difficili, è in grado di spostarsi rapidamente sul campo di battaglia. La sua corazzatura è in grado di resistere ai proiettili delle armi leggere e ai frammenti di granate, offrendo una protezione efficace ai membri dell\'equipaggio.', 1);
