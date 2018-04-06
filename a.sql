-- CREATE DATABASE teste;
USE teste;
CREATE TABLE usuario (
    id INTEGER PRIMARY KEY,
    nome VARCHAR(80) NOT NULL,
    senha VARCHAR(32) NOT NULL,
    email VARCHAR(80) NOT NULL,
    nivel integer,
    UNIQUE (email)
);

-- SELECT * FROM usuario;
