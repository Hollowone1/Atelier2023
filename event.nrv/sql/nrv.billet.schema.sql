-- Adminer 4.8.1 MySQL 5.5.5-10.3.11-MariaDB-1:10.3.11+maria~bionic dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `billet`;
CREATE TABLE Billet
(
    idBillet      INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    codeQR        VARCHAR(255)       NOT NULL,
    idUtilisateur INT                NOT NULL,
    idSoiree      INT                NOT NULL,
    FOREIGN KEY (idUtilisateur) REFERENCES Utilisateur (idUtilisateur),
    FOREIGN KEY (idSoiree) REFERENCES Soiree (idSoiree)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;