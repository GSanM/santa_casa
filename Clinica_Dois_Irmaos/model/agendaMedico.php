<?php

require_once "../controller/LogicaMedico.php";

$medico = new LogicaMedico();

session_start();

$crm = $_SESSION['crm'];

$medico->veAgenda(preg_replace('/[^A-Za-z0-9]/', '', $crm));

?>