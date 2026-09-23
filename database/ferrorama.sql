CREATE DATABASE sa_ferrorama1;
USE sa_ferrorama1;

CREATE TABLE usuarios (
id_usuario INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
email VARCHAR(100) NOT NULL,
senha VARCHAR(50) NOT NULL
);

CREATE TABLE trens (
id_trem INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
modelo VARCHAR(50) NOT NULL,
velocidade VARCHAR(50) NOT NULL,
linha INT NOT NULL,
carga VARCHAR(50) NOT NULL
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
sensor_id INT,
    FOREIGN KEY (sensor_id) REFERENCES sensores(id_sensor)
);

