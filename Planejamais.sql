CREATE DATABASE Planejamais;
USE Planejamais;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- Criar tabela de usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NULL, -- Campo opcional
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user' -- Campo para diferenciar entre admin e usuário comum
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Inserir usuário inicial (Admin)
INSERT INTO usuarios (nome, telefone, email, senha, role) 
VALUES ('Admin', NULL, 'admin@example.com', MD5('123456'), 'admin');

-- Criar tabela de agendamentos
CREATE TABLE agendamentos (
    id INT NOT NULL AUTO_INCREMENT,
    usuario_id INT NOT NULL, -- Relacionado ao usuário
    nome VARCHAR(220) NOT NULL,
    telefone VARCHAR(20) NULL, -- Opcional
    tarefas VARCHAR(220) NOT NULL,
    data DATETIME NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) 
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Verificar se o usuário existe antes de inserir agendamentos
SELECT * FROM usuarios;

-- Inserir agendamentos de exemplo
INSERT INTO agendamentos (usuario_id, nome, telefone, tarefas, data) 
VALUES
(1, 'admin', '000000', 'tarefa ', '2018-01-11 23:55:00');

-- Finalizar a transação
COMMIT;
