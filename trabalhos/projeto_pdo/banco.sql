-- Banco de dados
CREATE DATABASE IF NOT EXISTS sistema;
USE sistema;

-- Tabela de avaliações
CREATE TABLE IF NOT EXISTS avaliacao (
  id int(11) NOT NULL,
  nome varchar(100) NOT NULL,
  estrelas int(11) NOT NULL,
  comentario text NOT NULL
);

-- Tabela de usuários
CREATE TABLE IF NOT EXISTS usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    foto VARCHAR(255)
);

ALTER TABLE usuario
ADD COLUMN IF NOT EXISTS nivel ENUM('admin','usuario') NOT NULL DEFAULT 'usuario';

-- Tabela de serviços
CREATE TABLE IF NOT EXISTS servico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    foto VARCHAR(255)
);

-- Tabela de contatos
CREATE TABLE IF NOT EXISTS contato (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mensagem TEXT NOT NULL,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
 

INSERT INTO servico (titulo, descricao, foto) VALUES 
('Café & Terapia Felina', 'Sessões de relaxamento guiadas com a presença dos gatos. Ideal para aliviar o estresse, melhorar o humor e aproveitar o poder terapêutico do ronronar felino.', 'https://www.dailypaws.com/thmb/PeW3fJvhMo-z2XC-EZUTzG6XiCI=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/petting-tabby-cat-964442088-2000-d63df49433564c60b6292494e5ed52d5.jpg');

UPDATE usuario SET nivel = 'admin' WHERE email = 'adm@teste.com';