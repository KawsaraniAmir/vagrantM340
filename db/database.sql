-- Creazione del Database
CREATE DATABASE IF NOT EXISTS `ProgettoM151`;
USE `ProgettoM151`;

-- Rimozione delle tabelle se esistono
DROP TABLE IF EXISTS Activity;
DROP TABLE IF EXISTS UserProject;
DROP TABLE IF EXISTS Project;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Type;

-- Creazione della tabella Type
CREATE TABLE Type (
    name        VARCHAR(255) PRIMARY KEY,
    description TEXT
);

-- Creazione della tabella User
CREATE TABLE User (
    username VARCHAR(255) PRIMARY KEY,
    password VARCHAR(255),
    name     VARCHAR(255),
    surname  VARCHAR(255),
    city     VARCHAR(255),
    role     ENUM('Admin', 'User')
);

-- Inserisci un utente speciale per rappresentare utenti eliminati
INSERT INTO User (username, password, name, surname, city, role) 
VALUES ('deleted_user', '', 'Deleted', 'User', '', 'User');

-- Creazione della tabella Project
CREATE TABLE Project (
    id           INT PRIMARY KEY AUTO_INCREMENT,
    name         VARCHAR(255),
    startingDate DATE,
    author       VARCHAR(255),
    description  TEXT,
    state        VARCHAR(255),
    type         VARCHAR(255),
    FOREIGN KEY (author) REFERENCES User (username)
        ON UPDATE CASCADE
        ON DELETE SET NULL,
    FOREIGN KEY (type) REFERENCES Type (name)
        ON UPDATE CASCADE
        ON DELETE SET NULL
);

-- Creazione della tabella Activity
CREATE TABLE Activity (
    id           INT PRIMARY KEY AUTO_INCREMENT,
    startingDate DATE,
    endingDate   DATE,
    hours        INT,
    description  TEXT,
    state        VARCHAR(255),
    author       VARCHAR(255),
    projectId    INT,
    FOREIGN KEY (projectId) REFERENCES Project (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY (author) REFERENCES User (username)
        ON UPDATE CASCADE
        ON DELETE SET NULL
);

-- Creazione della tabella UserProject (tabella ponte)
CREATE TABLE UserProject (
    id        INT PRIMARY KEY AUTO_INCREMENT,
    userName  VARCHAR(255),
    projectId INT,
    FOREIGN KEY (userName) REFERENCES User (username)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY (projectId) REFERENCES Project (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

-- Trigger per aggiornare il valore di author in Project
DELIMITER //
CREATE TRIGGER update_author_in_project
BEFORE DELETE ON User
FOR EACH ROW
BEGIN
    UPDATE Project
    SET author = 'deleted_user'
    WHERE author = OLD.username;
END;
//
DELIMITER ;

-- Trigger per aggiornare il valore di author in Activity
DELIMITER //
CREATE TRIGGER update_author_in_activity
BEFORE DELETE ON User
FOR EACH ROW
BEGIN
    UPDATE Activity
    SET author = 'deleted_user'
    WHERE author = OLD.username;
END;
//
DELIMITER ;

-- Inserimento dati nella tabella User
INSERT INTO User (username, password, name, surname, city, role)
VALUES ('admin', '749f09bade8aca755660eeb17792da880218d4fbdc4e25fbec279d7fe9f65d70', 'Admin', 'Admin', 'City1', 'Admin'), -- Password: adminpassword
       ('user1', 'a4e4570c263dbfe7e7b01c451f5121f025c7bba885bb3c373ba4a578b4a7dca4', 'User1', 'User1', 'City2', 'User'),  -- Password: user1password
       ('user2', '3572d6025a6a37430c17cbd8356d53a3a1d394ded158811d973018f4b2d15f3b', 'User2', 'User2', 'City3', 'User'); -- Password:  user2password

-- Inserimento dati nella tabella Type
INSERT INTO Type (name, description)
VALUES ('Default', 'Default type'),
	   ('Type4', 'Description for Type4'),
       ('Type5', 'Description for Type5'),
       ('Type6', 'Description for Type6'),
       ('Type7', 'Description for Type7'),
       ('Type8', 'Description for Type8'),
       ('Type9', 'Description for Type9'),
       ('Type10', 'Description for Type10'),
       ('Type11', 'Description for Type11'),
       ('Type12', 'Description for Type12'),
       ('Type13', 'Description for Type13');

-- Inserimento dati nella tabella Project
INSERT INTO Project (name, startingDate, author, description, state, type)
VALUES ('Project4', '2024-01-01', 'admin', 'Description for Project4', 'Active', 'Type4'),
       ('Project5', '2024-01-02', 'admin', 'Description for Project5', 'Active', 'Type5'),
       ('Project6', '2024-01-03', 'admin', 'Description for Project6', 'Inactive', 'Type6'),
       ('Project7', '2024-01-04', 'admin', 'Description for Project7', 'Active', 'Type7'),
       ('Project8', '2024-01-05', 'admin', 'Description for Project8', 'Active', 'Type8'),
       ('Project9', '2024-01-06', 'admin', 'Description for Project9', 'Inactive', 'Type9'),
       ('Project10', '2024-01-07', 'admin', 'Description for Project10', 'Active', 'Type10'),
       ('Project11', '2024-01-08', 'admin', 'Description for Project11', 'Active', 'Type11'),
       ('Project12', '2024-01-09', 'admin', 'Description for Project12', 'Inactive', 'Type12'),
       ('Project13', '2024-01-10', 'admin', 'Description for Project13', 'Active', 'Type13');

-- Inserimento dei dati nella tabella Activity
INSERT INTO Activity (startingDate, endingDate, hours, description, state, author, projectId)
VALUES 
-- User1
('2024-01-01', '2024-01-02', 8, 'Activity 1 for Project14', 'Completed', 'user1', 1),
('2024-05-08', '2024-05-19', 6, 'Activity 2 for Project14', 'InProgress', 'user1', 1),
('2024-01-03', '2024-01-04', 4, 'Activity 1 for Project15', 'Completed', 'user1', 2),
('2024-01-04', '2024-01-05', 10, 'Activity 1 for Project16', 'InProgress', 'user1', 3),
('2024-01-05', '2024-01-06', 8, 'Activity 1 for Project17', 'Completed', 'user1', 4),
('2024-01-06', '2024-01-07', 6, 'Activity 1 for Project18', 'InProgress', 'user1', 5),
('2024-01-07', '2024-01-08', 4, 'Activity 1 for Project19', 'Completed', 'user1', 6),
('2024-01-08', '2024-01-09', 10, 'Activity 1 for Project20', 'InProgress', 'user1', 7),
('2024-01-09', '2024-01-10', 8, 'Activity 1 for Project21', 'Completed', 'user1', 8),
('2024-01-10', '2024-01-11', 6, 'Activity 1 for Project22', 'InProgress', 'user1', 9),
-- User2
('2024-01-11', '2024-01-12', 8, 'Activity 1 for Project23', 'Completed', 'user2', 1),
('2024-01-12', '2024-01-13', 6, 'Activity 2 for Project23', 'InProgress', 'user2', 1),
('2024-01-13', '2024-01-14', 4, 'Activity 1 for Project24', 'Completed', 'user2', 2),
('2024-01-14', '2024-01-15', 10, 'Activity 1 for Project25', 'InProgress', 'user2', 3),
('2024-01-15', '2024-01-16', 8, 'Activity 1 for Project26', 'Completed', 'user2', 4),
('2024-01-16', '2024-01-17', 6, 'Activity 1 for Project27', 'InProgress', 'user2', 5),
('2024-01-17', '2024-01-18', 4, 'Activity 1 for Project28', 'Completed', 'user2', 6),
('2024-01-18', '2024-01-19', 10, 'Activity 1 for Project29', 'InProgress', 'user2', 7),
('2024-01-19', '2024-01-20', 8, 'Activity 1 for Project30', 'Completed', 'user2', 8),
('2024-01-20', '2024-01-21', 6, 'Activity 1 for Project31', 'InProgress', 'user2', 9),
-- Admin
('2024-01-21', '2024-01-22', 8, 'Activity 1 for Project32', 'Completed', 'admin', 1),
('2024-01-22', '2024-01-23', 6, 'Activity 2 for Project32', 'InProgress', 'admin', 1),
('2024-01-23', '2024-01-24', 4, 'Activity 1 for Project33', 'Completed', 'admin', 2),
('2024-01-24', '2024-01-25', 10, 'Activity 1 for Project34', 'InProgress', 'admin', 3),
('2024-01-25', '2024-01-26', 8, 'Activity 1 for Project35', 'Completed', 'admin', 4),
('2024-01-26', '2024-01-27', 6, 'Activity 1 for Project36', 'InProgress', 'admin', 5),
('2024-01-27', '2024-01-28', 4, 'Activity 1 for Project37', 'Completed', 'admin', 6),
('2024-01-28', '2024-01-29', 10, 'Activity 1 for Project38', 'InProgress', 'admin', 7),
('2024-01-29', '2024-01-30', 8, 'Activity 1 for Project39', 'Completed', 'admin', 8),
('2024-01-30', '2024-01-31', 6, 'Activity 1 for Project40', 'InProgress', 'admin', 9);

-- Inserimento dei dati nella tabella UserProject per User1
INSERT INTO UserProject (userName, projectId) VALUES
('user1', 1),
('user1', 2),
('user1', 3),
('user1', 4),
('user1', 6),
('user1', 8),
('user1', 10);

-- Inserimento dei dati nella tabella UserProject per User2
INSERT INTO UserProject (userName, projectId) VALUES
('user2', 1),
('user2', 2),
('user2', 3),
('user2', 4),
('user2', 5),
('user2', 7),
('user2', 9);



SELECT * FROM Project;
