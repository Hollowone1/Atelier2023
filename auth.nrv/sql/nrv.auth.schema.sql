-- Adminer 4.8.1 MySQL 5.5.5-10.3.11-MariaDB-1:10.3.11+maria~bionic dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE Utilisateur
(
    idUtilisateur                      VARCHAR(255) NOT NULL PRIMARY KEY,
    prenom                             VARCHAR(255)       NOT NULL,
    nom                                VARCHAR(255)       NOT NULL,
    email                              VARCHAR(255)       NOT NULL,
    password                           VARCHAR(255)       NOT NULL,
    dateInscription                    DATE               NOT NULL,
    active                             TINYINT(4)         NOT NULL DEFAULT 0,
    activation_token                   VARCHAR(64)                 DEFAULT NULL,
    activation_token_expiration_date   TIMESTAMP          NULL     DEFAULT NULL,
    refresh_token                      VARCHAR(64)                 DEFAULT NULL,
    refresh_token_expiration_date      TIMESTAMP          NULL     DEFAULT NULL,
    reset_passwd_token                 VARCHAR(64)                 DEFAULT NULL,
    reset_passwd_token_expiration_date TIMESTAMP          NULL     DEFAULT NULL,
    role                               INT(11)            NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;