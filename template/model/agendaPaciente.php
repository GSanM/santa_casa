<?php

require_once "../controller/LogicaPaciente.php";

$paciente = new Paciente();

session_start();

$cpf = $_SESSION['cpf'];

$paciente->veAgenda(preg_replace('/[^A-Za-z0-9]/', '', $cpf));

?>