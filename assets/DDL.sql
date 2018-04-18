DROP DATABASE IF EXISTS testemvc;
CREATE DATABASE testemvc;
USE testemvc;

CREATE TABLE usuario(
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  senha VARCHAR(32) NOT NULL,
  telefone VARCHAR(30)
);

CREATE TABLE categoria(
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL
);

CREATE TABLE anuncio(
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  usuario_id INTEGER,
  FOREIGN KEY(usuario_id) REFERENCES usuario(id),
  categoria_id INTEGER,
  FOREIGN KEY(categoria_id) REFERENCES usuario(id),
  titulo VARCHAR(100),
  imgsrc VARCHAR(50),
  descricao TEXT,
  valor FLOAT,
  estado INTEGER
);