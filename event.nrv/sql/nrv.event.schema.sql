-- Adminer 4.8.1 MySQL 5.5.5-10.3.11-MariaDB-1:10.3.11+maria~bionic dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `spectacle`;
CREATE TABLE Spectacle
(
    idSpectacle       VARCHAR(255) NOT NULL PRIMARY KEY,
    titre             VARCHAR(255)       NOT NULL,
    description       VARCHAR(255)       NOT NULL,
    urlVideo          VARCHAR(255),
    horairePrevisionnel DATETIME,
    idSoiree          VARCHAR(255),
    idImg             INT,
    FOREIGN KEY (idSoiree) REFERENCES Soiree (idSoiree),
    FOREIGN KEY (idImg) REFERENCES ImgSpectacle (idImg)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `soiree`;
CREATE TABLE Soiree
(
    idSoiree     VARCHAR(255) NOT NULL PRIMARY KEY,
    nom          VARCHAR(255)       NOT NULL,
    theme        VARCHAR(255),
    date         DATE               NOT NULL,
    horaireDebut TIME               NOT NULL,
    tarifNormal  DECIMAL(10, 2)     NOT NULL,
    tarifReduit  DECIMAL(10, 2)     NOT NULL,
    idLieu       VARCHAR(255)       NOT NULL,
    FOREIGN KEY (idLieu) REFERENCES Lieu (idLieu)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `lieu`;
CREATE TABLE Lieu
(
    idLieu          VARCHAR(255) NOT NULL PRIMARY KEY,
    nom             VARCHAR(255)       NOT NULL,
    adresse         VARCHAR(255)       NOT NULL,
    nbPlacesAssises INT                NOT NULL,
    nbPlacesDebout  INT                NOT NULL
--     idImg           INT,
--     FOREIGN KEY (idImg) REFERENCES ImgLieu (idImg)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `artiste`;
CREATE TABLE Artiste
(
    idArtiste   VARCHAR(255) NOT NULL PRIMARY KEY,
    nom         VARCHAR(255)       NOT NULL,
    idSpectacle VARCHAR(255)       NOT NULL,
    FOREIGN KEY (idSpectacle) REFERENCES Spectacle (idSpectacle)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `imgSpectacle`;
CREATE TABLE ImgSpectacle
(
    idImg       INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    img         VARCHAR(255)       NOT NULL,
    idSpectacle VARCHAR(255)       NOT NULL,
    FOREIGN KEY (idSpectacle) REFERENCES Spectacle (idSpectacle)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `imgLieu`;
CREATE TABLE ImgLieu
(
    idImg  INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    img    VARCHAR(255)       NOT NULL,
    idLieu VARCHAR(255)       NOT NULL,
    FOREIGN KEY (idLieu) REFERENCES Lieu (idLieu)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;