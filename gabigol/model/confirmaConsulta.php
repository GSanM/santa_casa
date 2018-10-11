<?php

require_once "../controller/LogicaAtendente.php";

$atendente = new Atendente();

$horario = $_POST['horario'];
$data = $_POST['data_'];

return $atendente->confirmaConsulta($horario, $data);

?>