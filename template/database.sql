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
								seg8  BIT  DEFAULT 0, ter8  BIT  DEFAULT 0, qua8  BIT  DEFAULT 0, qui8  BIT  DEFAULT 0, sex8  BIT  DEFAULT 0,
								seg9  BIT  DEFAULT 0, ter9  BIT  DEFAULT 0, qua9  BIT  DEFAULT 0, qui9  BIT  DEFAULT 0, sex9  BIT  DEFAULT 0,
								seg10 BIT  DEFAULT 0, ter10 BIT  DEFAULT 0, qua10 BIT  DEFAULT 0, qui10 BIT  DEFAULT 0, sex10 BIT  DEFAULT 0,
								seg11 BIT  DEFAULT 0, ter11 BIT  DEFAULT 0, qua11 BIT  DEFAULT 0, qui11 BIT  DEFAULT 0, sex11 BIT  DEFAULT 0,
								seg12 BIT  DEFAULT 0, ter12 BIT  DEFAULT 0, qua12 BIT  DEFAULT 0, qui12 BIT  DEFAULT 0, sex12 BIT  DEFAULT 0,
								seg13 BIT  DEFAULT 0, ter13 BIT  DEFAULT 0, qua13 BIT  DEFAULT 0, qui13 BIT  DEFAULT 0, sex13 BIT  DEFAULT 0,
								seg14 BIT  DEFAULT 0, ter14 BIT  DEFAULT 0, qua14 BIT  DEFAULT 0, qui14 BIT  DEFAULT 0, sex14 BIT  DEFAULT 0,
								seg15 BIT  DEFAULT 0, ter15 BIT  DEFAULT 0, qua15 BIT  DEFAULT 0, qui15 BIT  DEFAULT 0, sex15 BIT  DEFAULT 0,
								seg16 BIT  DEFAULT 0, ter16 BIT  DEFAULT 0, qua16 BIT  DEFAULT 0, qui16 BIT  DEFAULT 0, sex16 BIT  DEFAULT 0,
								seg17 BIT  DEFAULT 0, ter17 BIT  DEFAULT 0, qua17 BIT  DEFAULT 0, qui17 BIT  DEFAULT 0, sex17 BIT  DEFAULT 0,
								seg18 BIT  DEFAULT 0, ter18 BIT  DEFAULT 0, qua18 BIT  DEFAULT 0, qui18 BIT  DEFAULT 0, sex18 BIT  DEFAULT 0,
								PRIMARY KEY(id),
								FOREIGN KEY (crm_medico) REFERENCES medico(crm)
);

#Cria tabela que relaciona medico com clinica
CREATE TABLE medico_clinica (   crm_medico   VARCHAR(15),
                                cnpj_clinica VARCHAR(20),
                                seg8  BIT  DEFAULT 0, ter8  BIT  DEFAULT 0, qua8  BIT  DEFAULT 0, qui8  BIT  DEFAULT 0, sex8  BIT  DEFAULT 0,
                                seg9  BIT  DEFAULT 0, ter9  BIT  DEFAULT 0, qua9  BIT  DEFAULT 0, qui9  BIT  DEFAULT 0, sex9  BIT  DEFAULT 0,
                                seg10 BIT  DEFAULT 0, ter10 BIT  DEFAULT 0, qua10 BIT  DEFAULT 0, qui10 BIT  DEFAULT 0, sex10 BIT  DEFAULT 0,
                                seg11 BIT  DEFAULT 0, ter11 BIT  DEFAULT 0, qua11 BIT  DEFAULT 0, qui11 BIT  DEFAULT 0, sex11 BIT  DEFAULT 0,
                                seg12 BIT  DEFAULT 0, ter12 BIT  DEFAULT 0, qua12 BIT  DEFAULT 0, qui12 BIT  DEFAULT 0, sex12 BIT  DEFAULT 0,
                                seg13 BIT  DEFAULT 0, ter13 BIT  DEFAULT 0, qua13 BIT  DEFAULT 0, qui13 BIT  DEFAULT 0, sex13 BIT  DEFAULT 0,
                                seg14 BIT  DEFAULT 0, ter14 BIT  DEFAULT 0, qua14 BIT  DEFAULT 0, qui14 BIT  DEFAULT 0, sex14 BIT  DEFAULT 0,
                                seg15 BIT  DEFAULT 0, ter15 BIT  DEFAULT 0, qua15 BIT  DEFAULT 0, qui15 BIT  DEFAULT 0, sex15 BIT  DEFAULT 0,
                                seg16 BIT  DEFAULT 0, ter16 BIT  DEFAULT 0, qua16 BIT  DEFAULT 0, qui16 BIT  DEFAULT 0, sex16 BIT  DEFAULT 0,
                                seg17 BIT  DEFAULT 0, ter17 BIT  DEFAULT 0, qua17 BIT  DEFAULT 0, qui17 BIT  DEFAULT 0, sex17 BIT  DEFAULT 0,
                                seg18 BIT  DEFAULT 0, ter18 BIT  DEFAULT 0, qua18 BIT  DEFAULT 0, qui18 BIT  DEFAULT 0, sex18 BIT  DEFAULT 0,
                                PRIMARY KEY (crm_medico, cnpj_clinica),
                                FOREIGN KEY (crm_medico)   REFERENCES medico(crm),
                                FOREIGN KEY (cnpj_clinica) REFERENCES clinica(cnpj)
) ENGINE=InnoDB;