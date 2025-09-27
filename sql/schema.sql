-- Banco e tabelas para o projeto Manutenção
CREATE DATABASE IF NOT EXISTS manutencao CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE manutencao;

CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario VARCHAR(50) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL
);

INSERT IGNORE INTO usuarios (usuario, senha) VALUES ('admin','1234');

CREATE TABLE IF NOT EXISTS clientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(150) NOT NULL,
  contato VARCHAR(100),
  endereco VARCHAR(200)
);

CREATE TABLE IF NOT EXISTS maquinas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tipo VARCHAR(100),
  modelo VARCHAR(100),
  ultima_manutencao DATE,
  cliente_id INT,
  FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS servicos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tipo ENUM('Preventiva','Corretiva') DEFAULT 'Corretiva',
  descricao TEXT,
  data_servico DATE,
  status ENUM('Pendente','Finalizado') DEFAULT 'Pendente',
  cliente_id INT,
  maquina_id INT,
  FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE SET NULL,
  FOREIGN KEY (maquina_id) REFERENCES maquinas(id) ON DELETE SET NULL
);

ALTER TABLE servicos ADD COLUMN IF NOT EXISTS status ENUM('Pendente','Finalizado') DEFAULT 'Pendente';
