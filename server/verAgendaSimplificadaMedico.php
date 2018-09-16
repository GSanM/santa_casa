<?php   
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once "database/LogicaMedico.php";
    require_once "database/LogicaAtendente.php";

    $lMedico = new LogicaMedico();
    $lMedico->veAgendaTodos();


?>