#Popula Clinica
USE clinical_system;

#Insere Clinicas
INSERT INTO clinica VALUES ('123456789101112', 'Clinica São Sebastião', 'Robervaldo Moura', 'Rua das Pederneiras, 111', '5330311101');
INSERT INTO clinica VALUES ('123456789101113', 'Clinica Santa Casa-SP', 'Carlos Silva', 'Av. Paulista, 203', '5330311102');
INSERT INTO clinica VALUES ('123456789101114', 'Clinica Unimed Litoral Sul-RS', 'Joelson Muller', 'Rua das Pitangueiras, 333', '5330311103');

#Insere Atendente
INSERT INTO atendente VALUES ('00000000000', 'Jamile Souza', 'jami_souza@gmail.com', '1994-10-12','Rua da Jamile, 123', '5300000000', 'jal', 'admin', '123456789101112');

#Insere Medicos
INSERT INTO medico VALUES ('1111', '12300012301', 'Robervildson Silveira', '1973-12-06', 'robervilds@gmail.com', 'Rua do Rober, 123', '53987665781', 'Odontologista', 'rob', 'rob');
INSERT INTO medico VALUES ('2222', '12300012302', 'Adilson Moreira', '1975-10-09', 'ad_moreira@gmail.com', 'Rua do Adilson, 123', '53987665782', 'Cardiologista', 'adi', 'adi');
INSERT INTO medico VALUES ('3333', '12300012303', 'Maria da Silva', '1987-06-15', 'msilva@gmail.com', 'Rua da Maria, 123', '53987665783', 'Pediatra', 'maria', 'maria');

#Insere Pacientes
INSERT INTO paciente VALUES ('11111111111', 'Jacinto Manto', '1991-01-01', 'paciente1@gmail.com', 'Rua dos Penteca, 111', '5311111111', 'jac', 'jac');
INSERT INTO paciente VALUES ('22222222222', 'Martins Almiro dos Santos', '1992-02-02', 'martins@gmail.com', 'Rua Santos Dumont, 222', '5322222222', 'tim', 'tim');
INSERT INTO paciente VALUES ('33333333333', 'Jair Jesus Bolsomito', '1993-03-03', 'bolsomito@gmail.com', 'Rua do Fuzil, 333', '5333333333', 'mito', 'mito');

#Insere Consultas
INSERT INTO consulta VALUES ('1111', '22222222222', '10:00:00', '2018-09-21', '123456789101112', NULL, NULL);
INSERT INTO consulta VALUES ('2222', '33333333333', '08:00:00', '2018-10-02', '123456789101113', NULL, NULL);
INSERT INTO consulta VALUES ('3333', '11111111111', '14:00:00', '2018-12-25', '123456789101114', NULL, NULL);

#Insere admin
INSERT INTO admin VALUES (1, 'admin', 'admin');

#Insere no medico_clinica

INSERT INTO `medico_clinica` (`crm_medico`, `cnpj_clinica`, `seg8`, `ter8`, `qua8`, `qui8`, `sex8`, `seg9`, `ter9`, `qua9`, `qui9`, `sex9`, `seg10`, `ter10`, `qua10`, `qui10`, `sex10`, `seg11`, `ter11`, `qua11`, `qui11`, `sex11`, `seg12`, `ter12`, `qua12`, `qui12`, `sex12`, `seg13`, `ter13`, `qua13`, `qui13`, `sex13`, `seg14`, `ter14`, `qua14`, `qui14`, `sex14`, `seg15`, `ter15`, `qua15`, `qui15`, `sex15`, `seg16`, `ter16`, `qua16`, `qui16`, `sex16`, `seg17`, `ter17`, `qua17`, `qui17`, `sex17`, `seg18`, `ter18`, `qua18`, `qui18`, `sex18`) VALUES ('1111', '123456789101113', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0');
INSERT INTO medico_clinica (`crm_medico`, `cnpj_clinica`, `seg8`, `ter8`, `qua8`, `qui8`, `sex8`, `seg9`, `ter9`, `qua9`, `qui9`, `sex9`, `seg10`, `ter10`, `qua10`, `qui10`, `sex10`, `seg11`, `ter11`, `qua11`, `qui11`, `sex11`, `seg12`, `ter12`, `qua12`, `qui12`, `sex12`, `seg13`, `ter13`, `qua13`, `qui13`, `sex13`, `seg14`, `ter14`, `qua14`, `qui14`, `sex14`, `seg15`, `ter15`, `qua15`, `qui15`, `sex15`, `seg16`, `ter16`, `qua16`, `qui16`, `sex16`, `seg17`, `ter17`, `qua17`, `qui17`, `sex17`, `seg18`, `ter18`, `qua18`, `qui18`, `sex18`) VALUES ('1111', '123456789101114', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0');
INSERT INTO medico_clinica (`crm_medico`, `cnpj_clinica`, `seg8`, `ter8`, `qua8`, `qui8`, `sex8`, `seg9`, `ter9`, `qua9`, `qui9`, `sex9`, `seg10`, `ter10`, `qua10`, `qui10`, `sex10`, `seg11`, `ter11`, `qua11`, `qui11`, `sex11`, `seg12`, `ter12`, `qua12`, `qui12`, `sex12`, `seg13`, `ter13`, `qua13`, `qui13`, `sex13`, `seg14`, `ter14`, `qua14`, `qui14`, `sex14`, `seg15`, `ter15`, `qua15`, `qui15`, `sex15`, `seg16`, `ter16`, `qua16`, `qui16`, `sex16`, `seg17`, `ter17`, `qua17`, `qui17`, `sex17`, `seg18`, `ter18`, `qua18`, `qui18`, `sex18`) VALUES ('2222', '123456789101113', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0');
INSERT INTO medico_clinica (`crm_medico`, `cnpj_clinica`, `seg8`, `ter8`, `qua8`, `qui8`, `sex8`, `seg9`, `ter9`, `qua9`, `qui9`, `sex9`, `seg10`, `ter10`, `qua10`, `qui10`, `sex10`, `seg11`, `ter11`, `qua11`, `qui11`, `sex11`, `seg12`, `ter12`, `qua12`, `qui12`, `sex12`, `seg13`, `ter13`, `qua13`, `qui13`, `sex13`, `seg14`, `ter14`, `qua14`, `qui14`, `sex14`, `seg15`, `ter15`, `qua15`, `qui15`, `sex15`, `seg16`, `ter16`, `qua16`, `qui16`, `sex16`, `seg17`, `ter17`, `qua17`, `qui17`, `sex17`, `seg18`, `ter18`, `qua18`, `qui18`, `sex18`) VALUES ('3333', '123456789101113', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0');

INSERT INTO consulta_pendente VALUES ('1111', '22222222222', '10:00:00', '2018-09-21', '123456789101112');
INSERT INTO consulta_pendente VALUES ('2222', '33333333333', '08:00:00', '2018-10-02', '123456789101113');
INSERT INTO consulta_pendente VALUES ('3333', '11111111111', '14:00:00', '2018-12-25', '123456789101114');
