#Popula Clinica
USE clinical_system;

#Insere Clinicas
INSERT INTO clinica VALUES (123456789101112, 'Clinica 1', 'Robervaldo Moura', 'Rua da Clinica 1, 111', '5330311101');
INSERT INTO clinica VALUES (123456789101113, 'Clinica 2', 'Carlos Silva', 'Rua da Clinica 2, 222', '5330311102');
INSERT INTO clinica VALUES (123456789101114, 'Clinica 3', 'Joelson Muller', 'Rua da Clinica 3, 333', '5330311103');

#Insere Atendente
INSERT INTO atendente VALUES (00000000000, 'Jamile Souza', 'jami_souza@gmail.com', 'Rua da Jamile, 123', '5300000000', 'admin');

#Insere Medicos
INSERT INTO medico VALUES (1111, 12300012301, 'Robervildson Silveira', '1973-12-06', 'robervilds@gmail.com', 'Rua do Rober, 123', '53987665781', 'Odontologista', 'med', 'robervilds123');
INSERT INTO medico VALUES (2222, 12300012302, 'Adilson Moreira', '1975-10-09', 'ad_moreira@gmail.com', 'Rua do Adilson, 123', '53987665782', 'Cardiologista', 'med', 'adilsao000');
INSERT INTO medico VALUES (3333, 12300012303, 'Maria da Silva', '1987-06-15', 'msilva@gmail.com', 'Rua da Maria, 123', '53987665783', 'Pediatra', 'med', 'maria123');

#Insere Pacientes
INSERT INTO paciente VALUES (11111111111, 'Paciente 1', '1991-01-01', 'paciente1@gmail.com', 'Rua do Paciente 1, 111', '5311111111', 'pac', 'paciente1');
INSERT INTO paciente VALUES (22222222222, 'Paciente 2', '1992-02-02', 'paciente2@gmail.com', 'Rua do Paciente 2, 222', '5322222222', 'pac', 'paciente2');
INSERT INTO paciente VALUES (33333333333, 'Paciente 3', '1993-03-03', 'paciente3@gmail.com', 'Rua do Paciente 3, 333', '5333333333', 'pac', 'paciente3');

#Insere Consultas
INSERT INTO consulta VALUES (1111, 22222222222, '10:00:00', '2018-09-21', 123456789101112, NULL, NULL);
INSERT INTO consulta VALUES (2222, 33333333333, '08:00:00', '2018-10-02', 123456789101113, NULL, NULL);
INSERT INTO consulta VALUES (3333, 11111111111, '14:00:00', '2018-12-25', 123456789101114, NULL, NULL);