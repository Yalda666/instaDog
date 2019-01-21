-- Create a new database called 'InstaDog'
CREATE DATABASE InstaDog;


CREATE USER 'root' IDENTIFIED BY "digital2018"; 
GRANT SELECT, INSERT, UPDATE, DELETE ON InstaDog.* TO 'root'
         WITH GRANT OPTION;

-- Create a new table called 'Utilisateur'
CREATE TABLE Utilisateur
(
    id INT(100) AUTO_INCREMENT NOT NULL  PRIMARY KEY, -- primary key column
    pseudo VARCHAR(255) NOT NULL,
    motPasse VARCHAR(255) NOT NULL,
    derniereConnexion DATETIME NOT NULL,
    email VARCHAR(255) NOT NULL
);

-- Create a new table called 'Animal'
CREATE TABLE Animal
(
    id INT NOT NULL, -- primary key column
    idUtilisateur INT NOT NULL,
    nom VARCHAR(50) NOT NULL,
    surnom VARCHAR(50) NOT NULL,
    cheminPhoto VARCHAR(250) NOT NULL,
    nomElevage VARCHAR(50) NOT NULL,
    dateNaissance DATE NOT NULL,
    sexe VARCHAR(50) NOT NULL,
    race VARCHAR(50) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(idUtilisateur) REFERENCES Utilisateur(id)
);

-- Create a new table called 'Article' 
CREATE TABLE Article
(
    id INT NOT NULL, -- primary key column
    idAnimal INT NOT NULL, -- foreign key
    texte TEXT NOT NULL,
    cheminPhoto VARCHAR(50) NOT NULL,
    datePublication DATETIME NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(idAnimal) REFERENCES Animal(id)
);

-- Create a new table called 'Commentaire' 
CREATE TABLE Commentaire
(
    id INT NOT NULL, -- primary key column
    idUtilisateur INT NOT NULL, -- foreign key
    idAnimal INT NOT NULL, -- foreign key
    texte TINYTEXT NOT NULL,
    datePublication DATETIME NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(idUtilisateur) REFERENCES Utilisateur(id),
    FOREIGN KEY(idAnimal) REFERENCES Animal(id)
);
