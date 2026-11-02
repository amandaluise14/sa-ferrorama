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
data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
trem_id INT,

FOREIGN KEY (trem_id) REFERENCES trens(id_trem)
);

CREATE TABLE enderecos (
    id_endereco INT PRIMARY KEY AUTO_INCREMENT,
    cep VARCHAR(9) NOT NULL,
    logradouro VARCHAR(150) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    uf CHAR(2) NOT NULL
);

ALTER TABLE usuarios
ADD COLUMN id_endereco INT NULL,
ADD CONSTRAINT fk_usuario_endereco
FOREIGN KEY (id_endereco)
REFERENCES enderecos(id_endereco);