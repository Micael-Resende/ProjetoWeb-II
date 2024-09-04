CREATE DATABASE formulario; -- CHARACTER SET utf8mb4;
use formulario;

CREATE TABLE usuarios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefone VARCHAR(100) NOT NULL
);

CREATE TABLE materia (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome_materia VARCHAR(100) NOT NULL
);

CREATE TABLE presenca (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT UNSIGNED NOT NULL,
    id_materia INT UNSIGNED NOT NULL,
    data_presenca DATE NOT NULL,
    status VARCHAR(50) NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_materia) REFERENCES materia(id)
);

CREATE TABLE cursos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome_curso VARCHAR(100) NOT NULL,
    id_materia INT UNSIGNED NOT NULL,
    descricao TEXT,
    FOREIGN KEY (id_materia) REFERENCES materia(id)
);





-- data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
SELECT * FROM usuarios;
SELECT * FROM usuarios ORDER BY id DESC;


SHOW VARIABLES LIKE 'sql_mode';
SET GLOBAL sql_mode = '';
DESCRIBE usuarios;

INSERT INTO usuarios (nome, email, telefone, sexo, data_nasc, cidade, estado, endereco, senha) 
VALUES ('João Silva', 'joao.silva@example.com', '123456789', 'masculino', '1990-01-01', 'São Paulo', 'SP', 'Rua Exemplo, 123', 'senha123');


-- Teste de inserção
INSERT INTO usuarios (nome, email, telefone, senha) VALUES
('admin', 'admin.sistema', '(34) 99961-1989', '12345'),
('João Silva', 'joao.silva@example.com', '(12) 9345-6789'),
('Maria Oliveira', 'maria.oliveira@example.com', '(34) 9876-4321'),
('Pedro Santos', 'pedro.santos@example.com', '(51) 9211-1456'),
('Ana Costa', 'ana.costa@example.com', '(43) 9555-6541');



DELETE FROM usuarios WHERE id IN (26, 27, 28, 29);
DROP TABLE usuarios;
DROP DATABASE formulario;