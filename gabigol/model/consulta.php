<?php

require_once "../controller/LogicaMedico.php";

$medico = new LogicaMedico();

session_start();

$data = $_POST[''];
$hora = $_POST[''];
$receita = $_POST['receita'];
$diagnostico = $_POST['diagnostico'];

$medico->receitar($receita, $hora, $data);
$medico->diagnosticar($diagnostico, $hora, $data);

?>