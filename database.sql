CREATE DATABASE clinical_system;
USE clinical_system;

#Cria tabela clinica
CREATE TABLE clinica (	cnpj BIGINT,
						nome VARCHAR(50),
                        nome_gerente VARCHAR(50),
                        endereco VARCHAR(100),
                        telefone VARCHAR(50),
						PRIMARY KEY (cnpj)
);	

#Cria tabela paciente
CREATE TABLE paciente (	cpf BIGINT,
						nome VARCHAR(50),
                        data_nas DATE,
                        email VARCHAR(150),
                        endereco VARCHAR(100),
                        telefone VARCHAR(50),
                        senha VARCHAR(256),
						PRIMARY KEY (cpf)
);

#Cria tabela medico
CREATE TABLE medico (	crm BIGINT,
						cpf BIGINT,
						nome VARCHAR(50),
                        data_nas DATE,
                        email VARCHAR(150),
                        endereco VARCHAR(100),
                        telefone VARCHAR(50),
                        especialidade VARCHAR(30),
                        senha VARCHAR(256),
						PRIMARY KEY (crm)
);

#Cria tabela atendente
CREATE TABLE atendente (cpf BIGINT,
						nome VARCHAR(50),
                        email VARCHAR(100),
                        endereco VARCHAR(100),
                        telefone VARCHAR(50),
                        senha VARCHAR(256),
						PRIMARY KEY (cpf)
);

#Cria tabela de consultas
CREATE TABLE consulta ( crm_medico BIGINT,
                        cpf_paciente BIGINT,
                        horario TIME,
                        data DATE,
                        cnpj_clinica BIGINT,
                        diagnostico VARCHAR(100),
                        receita VARCHAR(128),
                        PRIMARY KEY (data, horario),
                        FOREIGN KEY (crm_medico) REFERENCES medico(crm),
                        FOREIGN KEY (cpf_paciente) REFERENCES paciente(cpf),
                        FOREIGN KEY (cnpj_clinica) REFERENCES clinica(cnpj)
);

#Cria tabela admin
CREATE TABLE admin (	id INT NOT NULL AUTO_INCREMENT,
						usuario VARCHAR(30),
						senha VARCHAR(30),
                        PRIMARY KEY (id)
);

#Cria tabela de horarios
CREATE TABLE horarios ( id INTEGER NOT NULL AUTO_INCREMENT,
						crm_medico BIGINT,
						seg8  BIT, ter8  BIT, qua8  BIT, qui8  BIT, sex8  BIT,
                        seg9  BIT, ter9  BIT, qua9  BIT, qui9  BIT, sex9  BIT,
                        seg10 BIT, ter10 BIT, qua10 BIT, qui10 BIT, sex10 BIT,
                        seg11 BIT, ter11 BIT, qua11 BIT, qui11 BIT, sex11 BIT,
                        seg12 BIT, ter12 BIT, qua12 BIT, qui12 BIT, sex12 BIT,
                        seg13 BIT, ter13 BIT, qua13 BIT, qui13 BIT, sex13 BIT,
                        seg14 BIT, ter14 BIT, qua14 BIT, qui14 BIT, sex14 BIT,
                        seg15 BIT, ter15 BIT, qua15 BIT, qui15 BIT, sex15 BIT,
                        seg16 BIT, ter16 BIT, qua16 BIT, qui16 BIT, sex16 BIT,
                        seg17 BIT, ter17 BIT, qua17 BIT, qui17 BIT, sex17 BIT,
                        seg18 BIT, ter18 BIT, qua18 BIT, qui18 BIT, sex18 BIT,
                        PRIMARY KEY(id),
                        FOREIGN KEY (crm_medico) REFERENCES medico(crm)
);