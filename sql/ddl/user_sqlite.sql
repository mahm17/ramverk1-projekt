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
    "activity" INTEGER
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
    "user" INTEGER,
    "published" DATETIME DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS Svar;
CREATE TABLE Svar (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "content" TEXT,
    "questionId" INTEGER,
    "user" INTEGER
);

DROP TABLE IF EXISTS Comment;
CREATE TABLE Comment (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "content" TEXT,
    "questionId" INTEGER,
    "user" INTEGER
);

DROP TABLE IF EXISTS AnswerComment;
CREATE TABLE AnswerComment (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "content" TEXT,
    "answerId" INTEGER,
    "user" INTEGER
);
