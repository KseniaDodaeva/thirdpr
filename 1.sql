CREATE DATABASE firstbd;

CREATE TABLE uploaded_text(
    ID int AUTO_INCREMENT,
    content text DEFAULT NULL,
    date date DEFAULT NULL,
    words_count int DEFAULT NULL,
    PRIMARY KEY(ID)
);

CREATE TABLE word(
    ID int AUTO_INCREMENT,
    text_id int DEFAULT NULL,
    word text DEFAULT NULL,
    count int DEFAULT NULL,
    PRIMARY KEY(ID)
);

