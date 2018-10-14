<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("LogicaAtendente.php");

$atendente = new Atendente();
/*
$nome_paciente    = "Jacinto Manto";
$nome_medico      = "Robervildson Silveira";
$data_antiga      = "2020-10-05";
$horario_antigo   = "22:00";
$data_nova        = "2020-10-05";
$horario_novo     = "11:00";
$nome_medico_novo = "Robervildson Silveira";

if( $atendente->alteraConsulta($nome_paciente, $nome_medico, $data_antiga, $horario_antigo, $data_nova, $horario_novo, $nome_medico_novo) ) {
    echo "<p><br>Agendamento realizado com sucesso.</p>";
} else {
    echo "<p><br>Erro. Não foi possivel agendar a consulta.</p>";
}
*/
$nome_paciente    = "Jacinto Manto";
$nome_medico      = "Robervildson Silveira";
$atendente->buscarConsulta($nome_paciente, $nome_medico)

?>