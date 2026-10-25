CREATE DATABASE sa_ferrorama1;
USE sa_ferrorama1;

CREATE TABLE usuarios (
id_usuario INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
email VARCHAR(100) NOT NULL,
senha VARCHAR(255) NOT NULL,
telefone VARCHAR(20) NOT NULL,
nome VARCHAR(100) NOT NULL,
endereco VARCHAR(200) NOT NULL,
cpf VARCHAR(20) NOT NULL,
data_nascimento DATE NOT NULL,
cargo ENUM('usuário', 'administrador') NOT NULL,
status_usuario ENUM('ativo', 'inativo') NOT NULL
);

CREATE TABLE trens (
id_trem INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
modelo VARCHAR(50) NOT NULL,
velocidade VARCHAR(50) NOT NULL,
linha INT NOT NULL,
carga VARCHAR(50) NOT NULL,
usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuario)
);

CREATE TABLE sensores (
id_sensor INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nome VARCHAR(50) NOT NULL,
localizacao VARCHAR(50) NOT NULL,
descricao_localizacao VARCHAR(100) NOT NULL,
dado_monitorado VARCHAR(50) NOT NULL
);

CREATE TABLE rotas (
id_rota INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nome VARCHAR(50) NOT NULL, 
estacao_origem VARCHAR(50) NOT NULL, 
estacao_destino VARCHAR(50) NOT NULL,
distancia_total VARCHAR(50) NOT NULL,
descricao VARCHAR(200),
duracao TIME,
data_criacao DATETIME CURRENT_TIMESTAMP,
trem_id INT,

FOREIGN KEY (trem_id) REFERENCES trens(id_trem)
);

<<<<<<< HEAD
ALTER TABLE rotas 
ADD descricao VARCHAR(200),
ADD duracao time,
ADD trem_id INT,
ADD data_criacao DATETIME; 
=======
INSERT INTO usuarios (email, senha, telefone, nome, endereco, cpf, data_nascimento, cargo, status_usuario) VALUES
('ana.silva@email.com', 'senha123', '(11) 99999-1001', 'Ana Silva', 'Rua A, 101', '111.111.111-01', '1990-01-15', 'usuário', 'ativo'),
('bruno.oliveira@email.com', 'senha123', '(11) 99999-1002', 'Bruno Oliveira', 'Rua B, 202', '111.111.111-02', '1988-02-20', 'administrador', 'ativo'),
('carla.mendes@email.com', 'senha123', '(11) 99999-1003', 'Carla Mendes', 'Rua C, 303', '111.111.111-03', '1995-03-10', 'usuário', 'ativo'),
('daniel.pereira@email.com', 'senha123', '(11) 99999-1004', 'Daniel Pereira', 'Rua D, 404', '111.111.111-04', '1987-04-18', 'administrador', 'inativo'),
('eduarda.ramos@email.com', 'senha123', '(11) 99999-1005', 'Eduarda Ramos', 'Rua E, 505', '111.111.111-05', '1993-05-25', 'usuário', 'ativo'),
('felipe.novaes@email.com', 'senha123', '(11) 99999-1006', 'Felipe Novaes', 'Rua F, 606', '111.111.111-06', '1989-06-12', 'usuário', 'inativo'),
('gabriela.costa@email.com', 'senha123', '(11) 99999-1007', 'Gabriela Costa', 'Rua G, 707', '111.111.111-07', '1994-07-08', 'administrador', 'ativo'),
('henrique.lima@email.com', 'senha123', '(11) 99999-1008', 'Henrique Lima', 'Rua H, 808', '111.111.111-08', '1991-08-17', 'usuário', 'ativo'),
('isabela.souza@email.com', 'senha123', '(11) 99999-1009', 'Isabela Souza', 'Rua I, 909', '111.111.111-09', '1996-09-30', 'usuário', 'ativo'),
('joao.cardoso@email.com', 'senha123', '(11) 99999-1010', 'João Cardoso', 'Rua J, 1010', '111.111.111-10', '1985-10-22', 'administrador', 'inativo');

INSERT INTO trens (modelo, velocidade, linha, carga, usuario_id) VALUES
('Series 100', '80 km/h', 1, '500 t', 1),
('Series 200', '90 km/h', 2, '650 t', 2),
('Series 300', '70 km/h', 3, '480 t', 3),
('Series 400', '110 km/h', 4, '700 t', 4),
('Series 500', '95 km/h', 5, '620 t', 5),
('Series 600', '85 km/h', 6, '540 t', 6),
('Series 700', '100 km/h', 7, '750 t', 7),
('Series 800', '105 km/h', 8, '680 t', 8),
('Series 900', '75 km/h', 9, '510 t', 9),
('Series 1000', '120 km/h', 10, '800 t', 10);

INSERT INTO sensores (nome, localizacao, descricao_localizacao, dado_monitorado) VALUES
('Sensor A1', 'Estação Central', 'Ponto de monitoramento principal', 'Temperatura'),
('Sensor A2', 'Viga Norte', 'Monitoramento da estrutura', 'Vibração'),
('Sensor A3', 'Túnel 01', 'Acesso ao túnel', 'Pressão'),
('Sensor B1', 'Linha 1', 'Trecho inicial da linha', 'Velocidade'),
('Sensor B2', 'Linha 2', 'Curva do segmento', 'Aceleração'),
('Sensor C1', 'Plataforma Sul', 'Área de embarque', 'Umidade'),
('Sensor C2', 'Plataforma Norte', 'Área de desembarque', 'Temperatura'),
('Sensor D1', 'Manutenção', 'Setor de manutenção', 'Corrente elétrica'),
('Sensor D2', 'Trem 9', 'Carro de passageiros', 'Rpm'),
('Sensor E1', 'Estação Leste', 'Ponto de controle', 'Frequência');

INSERT INTO rotas (nome, estacao_origem, estacao_destino, distancia_total, descricao, duracao, data_criacao, trem_id) VALUES
('Linha Centro', 'Estação Central', 'Estação Norte', '22 km', 'Rota principal da linha central', '00:35:00', '2026-01-10 08:00:00', 1),
('Linha Sul', 'Estação Sul', 'Estação Centro', '18 km', 'Conexão rápida para o centro', '00:28:00', '2026-01-11 09:15:00', 2),
('Linha Leste', 'Estação Leste', 'Estação Terminal', '30 km', 'Rota longa com alta demanda', '00:50:00', '2026-01-12 10:20:00', 3),
('Linha Oeste', 'Estação Oeste', 'Estação Central', '24 km', 'Rota de acesso ao centro', '00:40:00', '2026-01-13 11:45:00', 4),
('Linha Norte', 'Estação Norte', 'Estação Leste', '26 km', 'Rota de ligação entre bairros', '00:42:00', '2026-01-14 12:30:00', 5),
('Linha Expresso', 'Estação Terminal', 'Estação Centro', '15 km', 'Trecho expresso sem paradas', '00:22:00', '2026-01-15 14:00:00', 6),
('Linha Verde', 'Estação Jardim', 'Estação Central', '19 km', 'Trecho verde para o casco urbano', '00:31:00', '2026-01-16 15:10:00', 7),
('Linha Azul', 'Estação Azul', 'Estação Norte', '27 km', 'Rota de passageiros diários', '00:44:00', '2026-01-17 16:25:00', 8),
('Linha Rosa', 'Estação Rosa', 'Estação Sul', '21 km', 'Percurso urbano com boa demanda', '00:33:00', '2026-01-18 17:55:00', 9),
('Linha Diamante', 'Estação Diamante', 'Estação Central', '29 km', 'Rota de ligação rápida e direta', '00:47:00', '2026-01-19 18:40:00', 10);

>>>>>>> 7742b69a780279f42c3b198ef1b6c808d0f44e1d
