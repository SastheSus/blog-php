
CREATE TABLE utenti (
  username varchar(50) PRIMARY KEY NOT NULL,
  email varchar(50) DEFAULT NULL,
  password varchar(255) DEFAULT NULL,
  ruolo varchar(255) DEFAULT 'BASE'
);

CREATE TABLE immagini (
  id int(11) PRIMARY KEY NOT NULL,
  nome varchar(255) DEFAULT NULL,
  logo bool DEFAULT 0
);

CREATE TABLE articoli (
  id int(11) PRIMARY KEY NOT NULL,
  titolo varchar(255) DEFAULT NULL,
  descrizione text DEFAULT NULL,
  giorno datetime DEFAULT NULL,
  logo varchar(255) DEFAULT NULL,
  utente varchar(50) DEFAULT NULL,
  visualizzazioni int(11) DEFAULT 0,
  FOREIGN KEY (utente) REFERENCES utenti (username),
  FOREIGN KEY (logo) REFERENCES immagini (id)
);

CREATE TABLE paragrafi (
  id int(11) NOT NULL,
  articolo int(11) NOT NULL,
  titolo varchar(255) DEFAULT NULL,
  contenuto text DEFAULT NULL,
  FOREIGN KEY (articolo) REFERENCES articoli (id),
  PRIMARY KEY (id, articolo)
);

CREATE TABLE immaginiDiParagrafi (
  idParagrafo int(11) NOT NULL,
  idImmagine int(11) NOT NULL,
  FOREIGN KEY (idParagrafo) REFERENCES paragrafi (id),
  FOREIGN KEY (idImmagine) REFERENCES immagini (id),
  PRIMARY KEY (idParagrafo, idImmagine)
);







--
-- Dump dei dati per la tabella articoli
--

INSERT INTO utenti (username, email, password, ruolo) VALUES
("Bardo","michele.bardotti04@gmail.com","$2y$10$MXbLJYcqDAUmsBAiS0DCLeWC/nQxGJxSqGRaaFg5uIq7QJ8S9dmdG", NULL);

INSERT INTO articoli (id, titolo, descrizione, giorno, logo, utente, visualizzazioni) VALUES
(1,"BM-21 Grad","Il BM-21, conosciuto anche come Grad, è un lanciarazzi a 40 tubi che può colpire bersagli fino a 40 km di distanza. Utilizzato in vari conflitti, è stato esportato in tutto il mondo.","2023-02-28 21:20:00","BM-21_Grad.jpg","Bardo", 10),
(2,"M1 Abrams","L\'M1 Abrams è un carro armato da combattimento di terza generazione, utilizzato principalmente dalle forze armate degli Stati Uniti e di altri paesi.","2023-03-08 10:28:00","abrams.jpeg","Bardo", 2),
(3,"leopard","Il Leopard è uno dei più avanzati carri armati da combattimento in circolazione, caratterizzato da un cannone ad alta velocità, un motore a turbina a gas e una corazzatura avanzata.","2023-03-01 08:30:00","leopard.jpg","Bardo", 5),
(4,"Mi17","Il Mi-17, anche noto come Mi-8MTV, è un elicottero da trasporto militare russo-americano, molto versatile e utilizzato in molte parti del mondo. È di trasporto fino a 24 soldati","2023-03-01 08:40:00","Mi17.jpg","Bardo", 40),
(5,"T-14","Il T-14 Armata è un carro armato da combattimento di quinta generazione sviluppato in Russia. È uno dei sistemi d\'arma più avanzati al mondo","2023-03-02 09:40:00","t-14.jpg","Bardo", 15),
(6,"T-72","Il T-72 è un carro armato da combattimento russo sviluppato negli anni \'70. Caratterizzato da un cannone ad alta velocità da 125 mm e una corazzatura avanzata, è stato utilizzato ed esportato in diversi paesi.","2023-03-14 10:03:53","t-72.jpg","Bardo", 30);

