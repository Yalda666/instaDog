-- Create a new database called 'InstaDog'
CREATE DATABASE InstaDog
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci

CREATE USER root IDENTIFIED BY "root1234" 
IDENTIFIED WITH auth_plugin

-- Create a new table called 'Utilisateur'
CREATE TABLE Utilisateur
(
    id INT AUTO_INCREMENT NOT NULL  PRIMARY KEY, -- primary key column
    pseudo [NVARCHAR](50) NOT NULL,
    motPasse [NVARCHAR](50) NOT NULL,
    derniereConnexion DATETIME NOT NULL,
    email [NVARCHAR](50) NOT NULL
);

-- Create a new table called 'Animal'
CREATE TABLE Animal
(
    id INT NOT NULL PRIMARY KEY, -- primary key column
    idUtilisateur INT NOT NULL FOREIGN KEY REFERENCES Utilisateur(id), -- foreign key
    nom [NVARCHAR](50) NOT NULL,
    surnom [NVARCHAR](50) NOT NULL,
    cheminPhoto [NVARCHAR](250) NOT NULL,
    nomElevage [NVARCHAR](50) NOT NULL,
    dateNaissance DATE NOT NULL,
    sexe [NVARCHAR](50) NOT NULL,
    race [NVARCHAR](50) NOT NULL
);

-- Create a new table called 'Article' 
CREATE TABLE Article
(
    id INT NOT NULL PRIMARY KEY, -- primary key column
    idAnimal INT NOT NULL FOREIGN KEY REFERENCES Animal(id), -- foreign key
    texte TEXT NOT NULL,
    cheminPhoto [NVARCHAR](50) NOT NULL,
    datePublication DATETIME NOT NULL
);

-- Create a new table called 'Commentaire' 
CREATE TABLE Commentaire
(
    id INT NOT NULL PRIMARY KEY, -- primary key column
    idUtilisateur INT NOT NULL FOREIGN KEY REFERENCES Utilisateur(id), -- foreign key
    idAnimal INT NOT NULL FOREIGN KEY REFERENCES Animal(id), -- foreign key
    texte TINYTEXT NOT NULL,
    datePublication DATETIME NOT NULL
);

GO