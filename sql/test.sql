CREATE DATABASE IF NOT EXISTS test;

USE test;

--
-- Creating a User table.
--



--
-- Table User
--
SET NAMES utf8;



--
-- Table User
--
DROP TABLE IF EXISTS User;
CREATE TABLE User (
    id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    acronym VARCHAR(80) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created DATETIME,
    updated DATETIME,
    deleted DATETIME,
    active DATETIME 
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

--
-- Forum table
--
DROP TABLE IF EXISTS Forum;
CREATE TABLE Forum (
    id INTEGER AUTO_INCREMENT NOT NULL,
    title VARCHAR(40) NOT NULL,
    content TEXT,
    tag TEXT,
    PRImARY KEY (id)
);

DROP TABLE IF EXISTS Svar;
CREATE TABLE Svar (
    id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    content VARCHAR(250),
    svar_id INT,
    FOREIGN KEY (svar_id) REFERENCES forum(id)
);

INSERT INTO Forum (title, content, tag)
VALUES
	('Test title', 'Detta är ett test inlägg', 'test'),
	('Viktig fråga', 'Detta är en mycket viktig fråga', 'fråga'),
    ('Viktig fråga hej', 'Detta är en mycket viktig fråga', 'fråga, två');
    
INSERT INTO Svar (content, svar_id)
VALUES
	('Här har du ett svar.', 1),
    ('Här har du ett svar till.', 2);

SELECT * FROM Forum;
SELECT * FROM Svar WHERE svar_id = 1;
SELECT * FROM Forum WHERE tag IN ('fråga');

