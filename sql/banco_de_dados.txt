CREATE DATABASE livraria_db;

CREATE TABLE editora (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome_editora VARCHAR(255)
);

CREATE TABLE acervo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(255),
    foto VARCHAR(255),
    autor VARCHAR(255),
    ano VARCHAR(255),
    editora_id INT,
    preco VARCHAR(255),
    FOREIGN KEY (editora_id) REFERENCES editora(id)
);