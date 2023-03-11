CREATE TABLE articoli (
  id int(11),
  titolo varchar(255),
  descrizione varchar(255),
  giorno datetime,
  logo varchar(255)
);

CREATE TABLE utenti (
  email varchar(50),
  username varchar(50),
  password varchar (255)
);