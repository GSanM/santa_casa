<?php   
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once "model/LogicaMedico.php";
    require_once "model/LogicaAtendente.php";

    $lMedico = new LogicaMedico();
    $lMedico->veAgendaTodos();


?>