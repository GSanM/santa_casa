<?php   
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once "database/LogicaMedico.php";
    require_once "database/LogicaAtendente.php";

    $lAtendente = new LogicaAtendente();
    $lAtendente->verTodosMedicos();

?>