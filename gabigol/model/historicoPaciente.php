<?php

require_once "../controller/LogicaMedico.php";

$medico = new LogicaMedico();

session_start();

$cpf = $_POST['patient-name'];

$medico->veHistoricoPaciente(preg_replace('/[^A-Za-z0-9]/', '', $cpf));

?>