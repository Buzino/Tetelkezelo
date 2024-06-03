START TRANSACTION;

CREATE DATABASE IF NOT EXISTS `tetelkezelo` CHARACTER SET utf8 COLLATE utf8_hungarian_ci;

USE `tetelkezelo`;

CREATE TABLE IF NOT EXISTS `targyak` (
	`id`  INT(10) PRIMARY KEY,
	`nev` VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS `tetelek` (
	id			INT(10) PRIMARY KEY,
	tantargyid 	INT(10),
	sorszam    	INT(10),
	cim        	TEXT,
	vazlat     	LONGTEXT,
	kidolgozas 	LONGTEXT,
	FOREIGN KEY (`tantargyid`) REFERENCES `targyak`(`id`)
);

COMMIT;