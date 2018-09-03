CREATE DATABASE santa_casa;
USE santa_casa;

#Cria tabela clinica
CREATE TABLE clinica (	id INT NOT NULL AUTO_INCREMENT,
						nome VARCHAR(50),
                        endereco VARCHAR(100),
                        telefone VARCHAR(50),
						PRIMARY KEY (id)
					);	

#Cria tabela cliente
CREATE TABLE cliente (	cpf VARCHAR(15),
						nome VARCHAR(50),
                        email VARCHAR(100),
                        endereco VARCHAR(100),
                        telefone VARCHAR(50),
                        id_clinica INT,
						PRIMARY KEY (cpf),
                        FOREIGN KEY (id_clinica) REFERENCES clinica(id)
);

#Cria tabela medico
CREATE TABLE medico (	cremers VARCHAR(15),
						nome VARCHAR(50),
                        email VARCHAR(100),
                        endereco VARCHAR(100),
                        telefone VARCHAR(50),
                        id_clinica INT,
						PRIMARY KEY (cremers),
                        FOREIGN KEY (id_clinica) REFERENCES clinica(id)
);

#Cria tabela atendente
CREATE TABLE atendente (cpf VARCHAR(15),
						nome VARCHAR(50),
                        email VARCHAR(100),
                        endereco VARCHAR(100),
                        telefone VARCHAR(50),
                        id_clinica INT,
						PRIMARY KEY (cpf),
                        FOREIGN KEY (id_clinica) REFERENCES clinica(id)
);