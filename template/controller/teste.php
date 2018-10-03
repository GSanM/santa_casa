<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("LogicaAtendente.php");

$atendente = new Atendente();

if( $atendente->adicionaConsulta("Adilson Moreira", "Jacinto Manto", "10:09:08", "2018-08-23", "123456789101114" ) ) {
    echo "<p><br>Agendamento realizado com sucesso.</p>";
} else {
    echo "<p><br>Erro. Não foi possivel agendar a consulta.</p>";
}


?>