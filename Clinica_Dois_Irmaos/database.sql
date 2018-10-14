CREATE DATABASE clinical_system;
USE clinical_system;

#Cria tabela clinica
CREATE TABLE clinica (	cnpj VARCHAR(20),
						nome VARCHAR(50),
                        nome_gerente VARCHAR(50),
                        endereco VARCHAR(100),
                        telefone VARCHAR(50),
						PRIMARY KEY (cnpj)
);	

#Cria tabela paciente
CREATE TABLE paciente (	cpf VARCHAR(14),
						nome VARCHAR(50),
                        data_nas DATE,
                        email VARCHAR(150),
                        endereco VARCHAR(100),
                        telefone VARCHAR(50),
                        usuario VARCHAR(256) NOT NULL UNIQUE,
                        senha VARCHAR(256),
						PRIMARY KEY (cpf)
);

#Cria tabela medico
CREATE TABLE medico (	crm VARCHAR(15),
						cpf VARCHAR(14),
						nome VARCHAR(50),
                        data_nas DATE,
                        email VARCHAR(150),
                        endereco VARCHAR(100),
                        telefone VARCHAR(50),
                        especialidade VARCHAR(30),
                        usuario VARCHAR(256) NOT NULL UNIQUE,
                        senha VARCHAR(256),
						PRIMARY KEY (crm)
);

#Cria tabela atendente
CREATE TABLE atendente (cpf VARCHAR(14),
						nome VARCHAR(50),
                        email VARCHAR(100),
                        data_nas DATE,
                        endereco VARCHAR(100),
                        telefone VARCHAR(50),
                        usuario VARCHAR(256) NOT NULL,
                        senha VARCHAR(256),
                        cnpj_clinica VARCHAR(20),
						PRIMARY KEY (cpf, cnpj_clinica),
                        FOREIGN KEY (cnpj_clinica) REFERENCES clinica(cnpj)
);

#Cria tabela de consultas
CREATE TABLE consulta ( crm_medico VARCHAR(15),
                        cpf_paciente VARCHAR(14),
                        horario TIME,
                        data DATE,
                        cnpj_clinica VARCHAR(20),
                        diagnostico VARCHAR(100),
                        receita VARCHAR(128),
                        PRIMARY KEY (data, horario),
                        FOREIGN KEY (crm_medico) REFERENCES medico(crm),
                        FOREIGN KEY (cpf_paciente) REFERENCES paciente(cpf),
                        FOREIGN KEY (cnpj_clinica) REFERENCES clinica(cnpj)
);

CREATE TABLE consulta_pendente (crm_medico VARCHAR(15),
								cpf_paciente VARCHAR(14),
								horario TIME,
								data DATE,
								cnpj_clinica VARCHAR(20),
								PRIMARY KEY (data, horario),
								FOREIGN KEY (crm_medico) REFERENCES medico(crm),
								FOREIGN KEY (cpf_paciente) REFERENCES paciente(cpf),
								FOREIGN KEY (cnpj_clinica) REFERENCES clinica(cnpj)
);

#Cria tabela admin
CREATE TABLE admin (	id INT NOT NULL AUTO_INCREMENT,
						usuario VARCHAR(30) NOT NULL UNIQUE,
						senha VARCHAR(30),
                        PRIMARY KEY (id)
);


#Cria tabela de horarios para consulta
CREATE TABLE horarios_consulta (id INTEGER NOT NULL AUTO_INCREMENT,
								crm_medico VARCHAR(15),
								seg8  BIT  DEFAULT NULL, ter8  BIT  DEFAULT NULL, qua8  BIT  DEFAULT NULL, qui8  BIT  DEFAULT NULL, sex8  BIT  DEFAULT NULL,
								seg9  BIT  DEFAULT NULL, ter9  BIT  DEFAULT NULL, qua9  BIT  DEFAULT NULL, qui9  BIT  DEFAULT NULL, sex9  BIT  DEFAULT NULL,
								seg10 BIT  DEFAULT NULL, ter10 BIT  DEFAULT NULL, qua10 BIT  DEFAULT NULL, qui10 BIT  DEFAULT NULL, sex10 BIT  DEFAULT NULL,
								seg11 BIT  DEFAULT NULL, ter11 BIT  DEFAULT NULL, qua11 BIT  DEFAULT NULL, qui11 BIT  DEFAULT NULL, sex11 BIT  DEFAULT NULL,
								seg12 BIT  DEFAULT NULL, ter12 BIT  DEFAULT NULL, qua12 BIT  DEFAULT NULL, qui12 BIT  DEFAULT NULL, sex12 BIT  DEFAULT NULL,
								seg13 BIT  DEFAULT NULL, ter13 BIT  DEFAULT NULL, qua13 BIT  DEFAULT NULL, qui13 BIT  DEFAULT NULL, sex13 BIT  DEFAULT NULL,
								seg14 BIT  DEFAULT NULL, ter14 BIT  DEFAULT NULL, qua14 BIT  DEFAULT NULL, qui14 BIT  DEFAULT NULL, sex14 BIT  DEFAULT NULL,
								seg15 BIT  DEFAULT NULL, ter15 BIT  DEFAULT NULL, qua15 BIT  DEFAULT NULL, qui15 BIT  DEFAULT NULL, sex15 BIT  DEFAULT NULL,
								seg16 BIT  DEFAULT NULL, ter16 BIT  DEFAULT NULL, qua16 BIT  DEFAULT NULL, qui16 BIT  DEFAULT NULL, sex16 BIT  DEFAULT NULL,
								seg17 BIT  DEFAULT NULL, ter17 BIT  DEFAULT NULL, qua17 BIT  DEFAULT NULL, qui17 BIT  DEFAULT NULL, sex17 BIT  DEFAULT NULL,
								seg18 BIT  DEFAULT NULL, ter18 BIT  DEFAULT NULL, qua18 BIT  DEFAULT NULL, qui18 BIT  DEFAULT NULL, sex18 BIT  DEFAULT NULL,
								PRIMARY KEY(id),
								FOREIGN KEY (crm_medico) REFERENCES medico(crm)
);

#Cria tabela que relaciona medico com clinica
CREATE TABLE medico_clinica (   crm_medico   VARCHAR(15),
                                cnpj_clinica VARCHAR(20),
                                seg8  BIT  DEFAULT NULL, ter8  BIT  DEFAULT NULL, qua8  BIT  DEFAULT NULL, qui8  BIT  DEFAULT NULL, sex8  BIT  DEFAULT NULL,
                                seg9  BIT  DEFAULT NULL, ter9  BIT  DEFAULT NULL, qua9  BIT  DEFAULT NULL, qui9  BIT  DEFAULT NULL, sex9  BIT  DEFAULT NULL,
                                seg10 BIT  DEFAULT NULL, ter10 BIT  DEFAULT NULL, qua10 BIT  DEFAULT NULL, qui10 BIT  DEFAULT NULL, sex10 BIT  DEFAULT NULL,
                                seg11 BIT  DEFAULT NULL, ter11 BIT  DEFAULT NULL, qua11 BIT  DEFAULT NULL, qui11 BIT  DEFAULT NULL, sex11 BIT  DEFAULT NULL,
                                seg12 BIT  DEFAULT NULL, ter12 BIT  DEFAULT NULL, qua12 BIT  DEFAULT NULL, qui12 BIT  DEFAULT NULL, sex12 BIT  DEFAULT NULL,
                                seg13 BIT  DEFAULT NULL, ter13 BIT  DEFAULT NULL, qua13 BIT  DEFAULT NULL, qui13 BIT  DEFAULT NULL, sex13 BIT  DEFAULT NULL,
                                seg14 BIT  DEFAULT NULL, ter14 BIT  DEFAULT NULL, qua14 BIT  DEFAULT NULL, qui14 BIT  DEFAULT NULL, sex14 BIT  DEFAULT NULL,
                                seg15 BIT  DEFAULT NULL, ter15 BIT  DEFAULT NULL, qua15 BIT  DEFAULT NULL, qui15 BIT  DEFAULT NULL, sex15 BIT  DEFAULT NULL,
                                seg16 BIT  DEFAULT NULL, ter16 BIT  DEFAULT NULL, qua16 BIT  DEFAULT NULL, qui16 BIT  DEFAULT NULL, sex16 BIT  DEFAULT NULL,
                                seg17 BIT  DEFAULT NULL, ter17 BIT  DEFAULT NULL, qua17 BIT  DEFAULT NULL, qui17 BIT  DEFAULT NULL, sex17 BIT  DEFAULT NULL,
                                seg18 BIT  DEFAULT NULL, ter18 BIT  DEFAULT NULL, qua18 BIT  DEFAULT NULL, qui18 BIT  DEFAULT NULL, sex18 BIT  DEFAULT NULL,
                                PRIMARY KEY (crm_medico, cnpj_clinica),
                                FOREIGN KEY (crm_medico)   REFERENCES medico(crm),
                                FOREIGN KEY (cnpj_clinica) REFERENCES clinica(cnpj)
) ENGINE=InnoDB;