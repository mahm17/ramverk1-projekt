--
-- Creating a User table.
--



--
-- Table User
--
DROP TABLE IF EXISTS User;
CREATE TABLE User (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "username" TEXT UNIQUE NOT NULL,
    "password" TEXT,
    "email" TEXT,
    "created" TIMESTAMP,
    "updated" DATETIME,
    "deleted" DATETIME,
    "active" DATETIME
);

--
-- Forum table
--
DROP TABLE IF EXISTS Forum;
CREATE TABLE Forum (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "title" TEXT UNIQUE NOT NULL,
    "content" TEXT,
    "tag" TEXT,
    "user" INTEGER
);

DROP TABLE IF EXISTS Svar;
CREATE TABLE Svar (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "content" TEXT,
    "question_id" INTEGER,
    "user" INTEGER
);
