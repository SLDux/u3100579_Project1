CREATE DATABASE project_1;

USE project_1;

CREATE TABLE stories (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    storyname VARCHAR(100) NOT NULL, 
    storyuniverse VARCHAR(100),
    storytype VARCHAR(50),
    storygenre VARCHAR(50),
    booknumber VARCHAR(20),
    wip VARCHAR(10),
    about TEXT,
    mainrelationship VARCHAR(100),
    maincharacter VARCHAR(100),
    stage VARCHAR(50),
    date TIMESTAMP

);