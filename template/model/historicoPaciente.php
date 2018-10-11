<?php

require_once "../controller/LogicaMedico.php";
require_once "../controller/LogicaAtendente.php";

$medico = new LogicaMedico();
$atendente = new Atendente();

session_start();

$cpf = $atendente->get_cpf_patient_by_name($_POST['patient-name']);

$medico->veHistoricoPaciente(preg_replace('/[^A-Za-z0-9]/', '', $cpf));

?>