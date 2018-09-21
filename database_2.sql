-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:7777
-- Generation Time: Sep 21, 2018 at 02:17 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `teste`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `senha` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `usuario`, `senha`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `atendente`
--

CREATE TABLE `atendente` (
  `cpf` bigint(20) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clinica`
--

CREATE TABLE `clinica` (
  `cnpj` bigint(20) NOT NULL,
  `nome_clinica` varchar(50) DEFAULT NULL,
  `nome_gerente` varchar(50) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clinica`
--

INSERT INTO `clinica` (`cnpj`, `nome_clinica`, `nome_gerente`, `endereco`, `telefone`) VALUES
(0, 'Clinica Chega Mais', 'Zé Piolho', '123', '94994'),
(123123, 'Clinica Dois Irmãos', 'Nardoni', 'Rua das Limoeiras, n 434', '18996751718'),
(912392031021, 'Clinincas Zezé', 'Zezé', 'Rua das Bolachas', '1233123123');

-- --------------------------------------------------------

--
-- Table structure for table `consulta`
--

CREATE TABLE `consulta` (
  `crm_medico` bigint(20) DEFAULT NULL,
  `cpf_paciente` bigint(20) DEFAULT NULL,
  `horario` time NOT NULL,
  `data` date NOT NULL,
  `cnpj_clinica` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `consulta`
--

INSERT INTO `consulta` (`crm_medico`, `cpf_paciente`, `horario`, `data`, `cnpj_clinica`) VALUES
(1, 81239812391, '16:00:00', '2018-09-26', 0),
(1, 33311144455, '05:00:00', '2018-11-10', 123123),
(1, 33311144455, '07:00:00', '2018-11-10', 123123),
(1, 32132132189, '01:00:00', '2019-01-05', 0),
(1, 32132132189, '12:00:00', '2020-01-15', 123123);

-- --------------------------------------------------------

--
-- Table structure for table `horarios`
--

CREATE TABLE `horarios` (
  `id` int(11) NOT NULL,
  `crm_medico` bigint(20) DEFAULT NULL,
  `seg8` bit(1) DEFAULT NULL,
  `ter8` bit(1) DEFAULT NULL,
  `qua8` bit(1) DEFAULT NULL,
  `qui8` bit(1) DEFAULT NULL,
  `sex8` bit(1) DEFAULT NULL,
  `seg9` bit(1) DEFAULT NULL,
  `ter9` bit(1) DEFAULT NULL,
  `qua9` bit(1) DEFAULT NULL,
  `qui9` bit(1) DEFAULT NULL,
  `sex9` bit(1) DEFAULT NULL,
  `seg10` bit(1) DEFAULT NULL,
  `ter10` bit(1) DEFAULT NULL,
  `qua10` bit(1) DEFAULT NULL,
  `qui10` bit(1) DEFAULT NULL,
  `sex10` bit(1) DEFAULT NULL,
  `seg11` bit(1) DEFAULT NULL,
  `ter11` bit(1) DEFAULT NULL,
  `qua11` bit(1) DEFAULT NULL,
  `qui11` bit(1) DEFAULT NULL,
  `sex11` bit(1) DEFAULT NULL,
  `seg12` bit(1) DEFAULT NULL,
  `ter12` bit(1) DEFAULT NULL,
  `qua12` bit(1) DEFAULT NULL,
  `qui12` bit(1) DEFAULT NULL,
  `sex12` bit(1) DEFAULT NULL,
  `seg13` bit(1) DEFAULT NULL,
  `ter13` bit(1) DEFAULT NULL,
  `qua13` bit(1) DEFAULT NULL,
  `qui13` bit(1) DEFAULT NULL,
  `sex13` bit(1) DEFAULT NULL,
  `seg14` bit(1) DEFAULT NULL,
  `ter14` bit(1) DEFAULT NULL,
  `qua14` bit(1) DEFAULT NULL,
  `qui14` bit(1) DEFAULT NULL,
  `sex14` bit(1) DEFAULT NULL,
  `seg15` bit(1) DEFAULT NULL,
  `ter15` bit(1) DEFAULT NULL,
  `qua15` bit(1) DEFAULT NULL,
  `qui15` bit(1) DEFAULT NULL,
  `sex15` bit(1) DEFAULT NULL,
  `seg16` bit(1) DEFAULT NULL,
  `ter16` bit(1) DEFAULT NULL,
  `qua16` bit(1) DEFAULT NULL,
  `qui16` bit(1) DEFAULT NULL,
  `sex16` bit(1) DEFAULT NULL,
  `seg17` bit(1) DEFAULT NULL,
  `ter17` bit(1) DEFAULT NULL,
  `qua17` bit(1) DEFAULT NULL,
  `qui17` bit(1) DEFAULT NULL,
  `sex17` bit(1) DEFAULT NULL,
  `seg18` bit(1) DEFAULT NULL,
  `ter18` bit(1) DEFAULT NULL,
  `qua18` bit(1) DEFAULT NULL,
  `qui18` bit(1) DEFAULT NULL,
  `sex18` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `medico`
--

CREATE TABLE `medico` (
  `crm` bigint(20) NOT NULL,
  `cpf` bigint(20) DEFAULT NULL,
  `nome_medico` varchar(50) DEFAULT NULL,
  `data_nas` date DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `especialidade` varchar(30) DEFAULT NULL,
  `senha` varchar(256) NOT NULL,
  `usuario` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medico`
--

INSERT INTO `medico` (`crm`, `cpf`, `nome_medico`, `data_nas`, `email`, `endereco`, `telefone`, `especialidade`, `senha`, `usuario`) VALUES
(1, 12312312345, 'Geraldo Alquimista da Silva', '1960-04-05', 'geraldo.alquimista@psdb.com', 'Rua das propinas, n 45', '(16) 9-7898-9900', 'Nutrição Infantil', '1', '1'),
(2, 2030495112, 'Coronel Ciro Tomes', '1965-01-20', 'ciraodamassa@yahoo.com', 'Rua dos Coroneis, n 30', '(19) 9-1929-1000', 'Cardiologista', 'foratemer', 'foratemer'),
(12553, 12321331231, 'Robervildo da Silva', '1985-12-06', 'robervildo@gmail.com', 'Rua Boa, 175', '555332312321', 'Odontologista', 'robb', 'robb'),
(300001, 33311144455, 'Antonio Vieira', '2010-10-02', 'antonio@yahoo.com', 'Rua das Madeixas', '(18) 9900009999', 'Ortopedista', 'senha123', 'antoniao98');

-- --------------------------------------------------------

--
-- Table structure for table `paciente`
--

CREATE TABLE `paciente` (
  `cpf` bigint(20) NOT NULL,
  `nome_paciente` varchar(50) DEFAULT NULL,
  `data_nas` date DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `senha` varchar(256) DEFAULT NULL,
  `usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paciente`
--

INSERT INTO `paciente` (`cpf`, `nome_paciente`, `data_nas`, `email`, `endereco`, `telefone`, `senha`, `usuario`) VALUES
(32132132189, 'Jair Jesus Bolsonaro', '1960-06-20', 'bolsonabo@psl.br', 'Rua da Metralhadora, n 17', '(17) 9-1888-9394', 'metraplhapt', 'bolsomito'),
(33311144455, 'Antonio Vieira', '2010-10-02', 'antonio@yahoo.com', 'Rua das Madeixas', '(18) 9900009999', '1', '1'),
(81239812391, 'Marilda Silva', '1900-01-01', 'marilda@bol.com', 'Asilo Bom Jesus, n 500', '(19) 18-8129-8992', 'marilda', 'marilda');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `atendente`
--
ALTER TABLE `atendente`
  ADD PRIMARY KEY (`cpf`);

--
-- Indexes for table `clinica`
--
ALTER TABLE `clinica`
  ADD PRIMARY KEY (`cnpj`);

--
-- Indexes for table `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`data`,`horario`),
  ADD KEY `crm_medico` (`crm_medico`),
  ADD KEY `cpf_paciente` (`cpf_paciente`),
  ADD KEY `clinica` (`cnpj_clinica`);

--
-- Indexes for table `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crm_medico` (`crm_medico`);

--
-- Indexes for table `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`crm`);

--
-- Indexes for table `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`cpf`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consulta`
--
ALTER TABLE `consulta`
  ADD CONSTRAINT `consulta_ibfk_1` FOREIGN KEY (`crm_medico`) REFERENCES `medico` (`crm`),
  ADD CONSTRAINT `consulta_ibfk_2` FOREIGN KEY (`cpf_paciente`) REFERENCES `paciente` (`cpf`),
  ADD CONSTRAINT `consulta_ibfk_3` FOREIGN KEY (`cnpj_clinica`) REFERENCES `clinica` (`cnpj`);

--
-- Constraints for table `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`crm_medico`) REFERENCES `medico` (`crm`);
